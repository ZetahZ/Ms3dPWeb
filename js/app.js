document.addEventListener('DOMContentLoaded', () => {
    const inputBusqueda = document.getElementById('inputBusqueda');
    const contenedorResultados = document.getElementById('resultados');

    if (inputBusqueda) {
        inputBusqueda.addEventListener('input', async (e) => {
            const query = e.target.value.trim();
            
            try {
                const response = await fetch(`api/buscar_productos.php?q=${encodeURIComponent(query)}`);
                
                if (!response.ok) {
                    throw new Error(`Error HTTP: ${response.status}`);
                }
                
                const res = await response.json();
                
                if (res.status === 'success') {
                    renderizarResultados(res.data);
                }
            } catch (error) {
                console.error("Error al realizar la petición:", error);
            }
        });
    }

    function renderizarResultados(productos) {
        contenedorResultados.innerHTML = '';

        if (productos.length === 0) {
            contenedorResultados.innerHTML = '<div class="alert alert-secondary text-center py-4 bg-black border-secondary text-muted">No se encontraron productos.</div>';
            return;
        }

        let htmlGrid = '<div class="row g-3">';
        productos.forEach(producto => {
            // Construir la URL de la imagen de Supabase Storage igual que en PHP
            let urlImagen = "https://via.placeholder.com/300x200?text=Sin+Foto";
            if (producto.imagen && producto.imagen.trim() !== "") {
                if (producto.imagen.startsWith('http')) {
                    urlImagen = producto.imagen;
                } else {
                    urlImagen = `https://kumddrxatpazhdqtqjwt.supabase.co/storage/v1/object/public/productos/${producto.imagen}`;
                }
            }

            htmlGrid += `
                <div class="col-md-4">
                    <div class="card bg-dark text-light border-secondary shadow-sm p-3 h-100">
                        <img src="${urlImagen}" class="card-img-top mb-2 rounded" alt="Producto" style="height: 180px; object-fit: cover;">
                        <h5 class="text-info">${producto.nombre}</h5>
                        <p class="text-muted mb-0">Precio: <span class="text-light fw-bold">$${producto.precio}</span></p>
                    </div>
                </div>
            `;
        });
        htmlGrid += '</div>';

        contenedorResultados.innerHTML = htmlGrid;
    }
});