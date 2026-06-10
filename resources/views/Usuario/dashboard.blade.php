<x-app-layout>
    <style>
        #catalogo-container th, #catalogo-container td { color: #ffffff !important; font-family: sans-serif; }
        
        /* Cuadrícula de productos responsiva */
        .grid-productos {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.5rem;
        }
        
        /* Barra lateral del Carrito */
        #carrito-sidebar {
            position: fixed; top: 0; right: -400px; width: 350px; height: 100vh;
            background-color: #09090b; border-left: 1px solid #27272a;
            transition: right 0.3s ease; z-index: 9999; padding: 2rem; box-sizing: border-box;
            display: flex; flex-direction: column;
        }
        #carrito-sidebar.active { right: 0; }

        /* 🚪 VENTANA FLOTANTE (MODAL) PARA PERSONALIZAR CLANDESTINO */
        #modal-personalizar {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background-color: rgba(0, 0, 0, 0.85); /* Fondo oscuro transparente */
            display: none; justify-content: center; align-items: center; z-index: 10000;
            padding: 1rem; box-sizing: border-box;
        }

        /* Botones de categorías */
        .btn-categoria {
            background-color: #09090b; border: 1px solid #27272a; color: #a1a1aa;
            padding: 0.5rem 1.2rem; border-radius: 2rem; cursor: pointer; font-weight: bold; font-size: 0.85rem; text-transform: uppercase;
        }
        .btn-categoria.active, .btn-categoria:hover {
            background-color: #dc2626; color: white; border-color: #dc2626;
        }
    </style>

    <div id="catalogo-container" style="background-color: #000000; min-height: 100vh; width: 100%; display: flex; flex-direction: column; font-family: sans-serif; box-sizing: border-box; padding-bottom: 4rem;">
        
        <div style="background-color: #09090b; border-bottom: 1px solid #27272a; padding: 1.5rem 2rem;">
            <div style="max-width: 1280px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                
                <h2 style="font-weight: 900; font-size: 1.5rem; text-transform: uppercase; color: #ffffff; margin: 0;">
                    NowStyle <span style="color: #dc2626;">Store</span>
                </h2>

                <div style="display: flex; gap: 1rem; align-items: center;">
                    <button onclick="toggleCarrito()" style="background-color: #000000; border: 1px solid #27272a; color: white; padding: 0.7rem 1.25rem; border-radius: 0.75rem; font-weight: bold; cursor: pointer;">
                        🛒 Carrito (<span id="carrito-contador" style="color: #dc2626;">0</span>)
                    </button>

@if(auth()->user()->rol === 'gerente')
    <a href="{{ route('gerente.index') }}" style="background-color: #27272a; border: 1px solid #3f3f46; color: #ffffff; padding: 0.7rem 1.25rem; border-radius: 0.75rem; font-weight: bold; text-decoration: none; font-size: 0.8rem;">⚙️ PANEL GERENTE</a>
@endif

@if(auth()->user()->rol === 'empleado')
    <a href="{{ route('empleado.index') }}" style="background-color: #27272a; border: 1px solid #3f3f46; color: #ffffff; padding: 0.7rem 1.25rem; border-radius: 0.75rem; font-weight: bold; text-decoration: none; font-size: 0.8rem;">👕 PANEL EMPLEADO</a>
@endif
                </div>

            </div>
        </div>

        <div style="max-width: 1280px; width: 100%; margin: 2rem auto 0 auto; padding: 0 2rem; box-sizing: border-box; display: flex; flex-direction: column; gap: 1.5rem;">
            
            <div style="text-align: center; background-color: #09090b; border: 1px solid #27272a; padding: 2rem; border-radius: 1rem;">
                <h3 style="color: white; margin: 0 0 0.5rem 0; font-weight: 800; text-transform: uppercase; font-size: 1.3rem;">¿Quieres algo único?</h3>
                <p style="color: #a1a1aa; margin: 0 0 1.5rem 0; font-size: 0.9rem;">Personaliza tu ropa con tus propias frases, colores y estampados.</p>
                
                <button onclick="toggleModal(true)" style="background-color: #dc2626; color: white; border: none; padding: 0.8rem 2rem; border-radius: 0.5rem; font-weight: 900; font-size: 1rem; cursor: pointer; text-transform: uppercase; letter-spacing: 0.05em;">
                    ✨ ¡Crea tu ropa aquí!
                </button>
            </div>

            <div>
                <p style="color: #a1a1aa; font-size: 0.8rem; font-weight: bold; text-transform: uppercase; margin-bottom: 0.5rem;">Filtrar catálogo:</p>
                <div style="display: flex; gap: 0.5rem; overflow-x: auto; padding-bottom: 0.5rem;">
                    <button class="btn-categoria active" onclick="filtrarCategoria('todas', this)">Todas</button>
                    @foreach($productos->pluck('categoria')->unique() as $cat)
                        @if($cat)
                            <button class="btn-categoria" onclick="filtrarCategoria('{{ $cat }}', this)">{{ $cat }}</button>
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="grid-productos">
                @foreach($productos as $producto)
                    <div class="producto-card" data-categoria="{{ $producto->categoria }}" style="background-color: #09090b; border: 1px solid #27272a; border-radius: 1rem; padding: 1.5rem; display: flex; flex-direction: column; justify-content: space-between;">
                        
                        <div style="background-color: #000000; height: 180px; border-radius: 0.75rem; border: 1px solid #18181b; display: flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                            @if($producto->imagen)
                                <img src="{{ asset('storage/' . $producto->imagen) }}" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                            @else
                                <span style="color: #4b5563; font-size: 0.8rem; font-weight: bold;">SIN FOTO</span>
                            @endif
                        </div>

                        <div>
                            <h4 style="color: #ffffff; font-size: 1.15rem; font-weight: 800; margin: 0 0 0.5rem 0; text-transform: uppercase;">{{ $producto->nombre }}</h4>
                            <p style="font-size: 0.85rem; color: #a1a1aa; margin: 0 0 1rem 0; min-height: 2.5rem;">{{ $producto->descripcion }}</p>
                        </div>

                        <div style="border-top: 1px solid #18181b; padding-top: 1rem; display: flex; justify-content: space-between; align-items: center;">
                            <span style="color: #ffffff; font-weight: 900;">$ {{ number_format($producto->precio, 0, ',', '.') }}</span>
                            <button onclick="agregarAlCarrito('{{ $producto->id }}', '{{ $producto->nombre }}', {{ $producto->precio }})" style="background-color: #27272a; color: white; padding: 0.5rem 1rem; border-radius: 0.5rem; border: none; font-weight: bold; cursor: pointer; font-size: 0.8rem;">
                                + Carrito
                            </button>
                        </div>

                    </div>
                @endforeach
            </div>

        </div>
    </div>

    <div id="modal-personalizar">
        <div style="background-color: #09090b; border: 1px solid #27272a; width: 100%; max-width: 500px; border-radius: 1rem; padding: 2rem; box-sizing: border-box; position: relative;">
            
            <button onclick="toggleModal(false)" style="position: absolute; top: 15px; right: 20px; background: none; border: none; color: #a1a1aa; font-size: 1.5rem; cursor: pointer;">&times;</button>

            <h3 style="color: white; margin: 0 0 1.5rem 0; font-weight: 900; text-transform: uppercase;">🎨 Configura tu Estampado</h3>

            <div style="display: flex; flex-direction: column; gap: 1.25rem;">
                <div>
                    <label style="color: white; font-size: 0.8rem; font-weight: bold; display: block; margin-bottom: 0.5rem; text-transform: uppercase;">1. Escribe tu frase:</label>
                    <input type="text" id="custom-texto" style="background-color: #000000; border: 1px solid #27272a; color: white; padding: 0.75rem; border-radius: 0.5rem; width: 100%; box-sizing: border-box;" placeholder="Ej: Estilo Urbano 2026">
                </div>

                <div>
                    <label style="color: white; font-size: 0.8rem; font-weight: bold; display: block; margin-bottom: 0.5rem; text-transform: uppercase;">2. Color de la tinta:</label>
                    <select id="custom-color" style="background-color: #000000; border: 1px solid #27272a; color: white; padding: 0.75rem; border-radius: 0.5rem; width: 100%;">
                        <option value="Blanco">Blanco Matte</option>
                        <option value="Negro">Negro Profundo</option>
                        <option value="Dorado">Dorado Brillante</option>
                    </select>
                </div>

                <div>
                    <label style="color: white; font-size: 0.8rem; font-weight: bold; display: block; margin-bottom: 0.5rem; text-transform: uppercase;">3. Ubicación en la prenda:</label>
                    <select id="custom-ubicacion" style="background-color: #000000; border: 1px solid #27272a; color: white; padding: 0.75rem; border-radius: 0.5rem; width: 100%;">
                        <option value="Pecho">En el Pecho</option>
                        <option value="Espalda">En la Espalda (Grande)</option>
                    </select>
                </div>

                <div style="background-color: #000000; border: 1px solid #27272a; padding: 1rem; border-radius: 0.5rem; text-align: center; color: white; font-weight: bold;">
                    Precio Base Estampado: <span style="color: #dc2626;">$65.000 COP</span>
                </div>

                <button onclick="agregarPersonalizadoAlCarrito()" style="background-color: #ffffff; color: black; border: none; padding: 0.8rem; border-radius: 0.5rem; font-weight: 900; text-transform: uppercase; cursor: pointer; width: 100%;">
                    🎯 Añadir Mi Diseño al Carrito
                </button>
            </div>

        </div>
    </div>

    <div id="carrito-sidebar">
        <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #27272a; padding-bottom: 1rem; margin-bottom: 1rem;">
            <h3 style="color: white; margin: 0; text-transform: uppercase; font-weight: 900;">Tu Carrito</h3>
            <button onclick="toggleCarrito()" style="background: none; border: none; color: #a1a1aa; font-size: 1.5rem; cursor: pointer;">&times;</button>
        </div>
        <div id="carrito-items" style="flex-grow: 1; overflow-y: auto; display: flex; flex-direction: column; gap: 1rem;"></div>
        <div style="border-top: 1px solid #27272a; padding-top: 1rem; margin-top: 1rem;">
            <div style="display: flex; justify-content: space-between; color: white; font-weight: bold; margin-bottom: 1rem;">
                <span>TOTAL:</span> <span id="carrito-total">$0</span>
            </div>
            <button onclick="procesarCompra()" style="width: 100%; background-color: #dc2626; color: white; border: none; padding: 0.8rem; border-radius: 0.5rem; font-weight: bold; text-transform: uppercase; cursor: pointer;">Finalizar Compra</button>
        </div>
    </div>

    <script>
        let carrito = [];

        // Muestra u oculta la ventana flotante de diseño
        function toggleModal(show) {
            document.getElementById('modal-personalizar').style.display = show ? 'flex' : 'none';
        }

        // Muestra u oculta el carrito
        function toggleCarrito() {
            document.getElementById('carrito-sidebar').classList.toggle('active');
        }

        // Filtro de categorías clásico
        function filtrarCategoria(categoria, boton) {
            document.querySelectorAll('.btn-categoria').forEach(btn => btn.classList.remove('active'));
            boton.classList.add('active');
            document.querySelectorAll('.producto-card').forEach(card => {
                card.style.display = (categoria === 'todas' || card.getAttribute('data-categoria') === categoria) ? 'flex' : 'none';
            });
        }

        // Agregar prenda del catálogo al carrito
        function agregarAlCarrito(id, nombre, precio) {
            const existe = carrito.find(item => item.id === id);
            if (existe) { 
                existe.cantidad++; 
            } else { 
                carrito.push({ id, nombre, precio, cantidad: 1 }); 
            }
            actualizarCarritoHTML();
        }

        // Agregar prenda personalizada creada desde la ventana flotante
        function agregarPersonalizadoAlCarrito() {
            const txt = document.getElementById('custom-texto').value.trim() || 'Diseño Libre';
            const col = document.getElementById('custom-color').value;
            const ubi = document.getElementById('custom-ubicacion').value;

            carrito.push({
                id: 'custom-' + Date.now(),
                nombre: `👕 Personalizado: "${txt}" (${ubi} - ${col})`,
                precio: 65000,
                cantidad: 1
            });

            actualizarCarritoHTML();
            toggleModal(false); 
            document.getElementById('custom-texto').value = ''; 
            alert('¡Tu prenda personalizada se guardó en el carrito!');
        }

        // Eliminar del carrito
        function eliminarDelCarrito(id) {
            carrito = carrito.filter(item => item.id !== id);
            actualizarCarritoHTML();
        }

        // Pintar los datos en el carrito
        function actualizarCarritoHTML() {
            const contenedor = document.getElementById('carrito-items');
            const contador = document.getElementById('carrito-contador');
            const totalHTML = document.getElementById('carrito-total');
            
            contenedor.innerHTML = '';
            let total = 0; 
            let totalItems = 0;

            carrito.forEach(item => {
                total += item.precio * item.cantidad;
                totalItems += item.cantidad;
                contenedor.innerHTML += `
                    <div style="background-color: #000000; border: 1px solid #27272a; padding: 0.75rem; border-radius: 0.5rem; display: flex; justify-content: space-between; align-items: center;">
                        <div style="max-width: 80%;">
                            <p style="color: white; margin: 0; font-weight: bold; font-size: 0.85rem; text-transform: uppercase;">${item.nombre}</p>
                            <p style="color: #a1a1aa; margin: 0; font-size: 0.8rem;">${item.cantidad}x - $${item.precio.toLocaleString('co')}</p>
                        </div>
                        <button onclick="eliminarDelCarrito('${item.id}')" style="background: none; border: none; color: #dc2626; font-weight: bold; cursor: pointer;">X</button>
                    </div>
                `;
            });

            contador.innerText = totalItems;
            totalHTML.innerText = '$' + total.toLocaleString('co');
        }

        // Procesar e insertar en la base de datos de Laravel
        function procesarCompra() {
            if (carrito.length === 0) { 
                alert('El carrito está vacío.'); 
                return; 
            }

            let detallesPedido = carrito.map(item => `${item.nombre} (Cant: ${item.cantidad})`).join(' | ');
            let totalFinal = carrito.reduce((sum, item) => sum + (item.precio * item.cantidad), 0);

            fetch("{{ route('pedido.guardar') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    detalles: detallesPedido,
                    total: totalFinal
                })
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    alert('¡Orden y diseño de estampado enviados con éxito al Empleado! 🚀🎉');
                    carrito = [];
                    actualizarCarritoHTML();
                    toggleCarrito();
                }
            })
            .catch(error => {
                alert('Hubo un error al enviar el pedido.');
                console.error(error);
            });
        }
    </script>
</x-app-layout>