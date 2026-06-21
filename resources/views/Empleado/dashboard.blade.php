<x-app-layout>
<div id="empleado-container" style="background-color: #000000; min-height: 100vh; width: 100%; display: flex; flex-direction: column; font-family: sans-serif; box-sizing: border-box; padding-bottom: 4rem;">
    
    <div style="background-color: #09090b; border-bottom: 1px solid #27272a; padding: 1.5rem 2rem;">
        <div style="max-width: 1280px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
            <h2 style="font-weight: 900; font-size: 1.5rem; text-transform: uppercase; color: #ffffff; margin: 0; letter-spacing: 0.05em;">
                Inicio - Panel Empleado
            </h2>
            
            <div style="display: flex; gap: 1rem; align-items: center;">
                <a href="{{ route('cliente.index') }}" style="background-color: #27272a; border: 1px solid #3f3f46; color: #ffffff; padding: 0.7rem 1.25rem; border-radius: 0.75rem; font-weight: bold; font-size: 0.8rem; text-transform: uppercase; text-decoration: none; display: flex; align-items: center; gap: 0.5rem;">
                    <span>🛒</span> Ir a la Tienda
                </a>

                <a href="{{ route('productos.create') }}" style="background-color: #dc2626; color: #ffffff; padding: 0.7rem 1.25rem; border-radius: 0.75rem; font-weight: bold; font-size: 0.8rem; text-transform: uppercase; text-decoration: none; box-shadow: 0 4px 12px rgba(220, 38, 38, 0.2);">
                    Crear Producto
                </a>
            </div>
        </div>
    </div>
    <div id="toast-container" style="position: fixed; top: 2rem; right: 2rem; z-index: 9999; display: flex; flex-direction: column; gap: 1rem;"></div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <div style="background-color: #000000; min-height: 100vh; width: 100%; font-family: sans-serif; box-sizing: border-box; padding: 2rem; color: white;">
        <div style="max-width: 1280px; margin: 0 auto; display: flex; flex-direction: column; gap: 3rem;">
            
            @if(session('success'))
                <div style="background-color: #16a34a; color: white; padding: 1rem; border-radius: 0.5rem; font-weight: bold; text-transform: uppercase; font-size: 0.85rem;">
                    {{ session('success') }}
                </div>
            @endif

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-bottom: 1rem;">
                
                <div style="background-color: #09090b; border: 1px solid #27272a; border-radius: 1rem; padding: 1.5rem; position: relative; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.3);">
                    <div style="color: #71717a; font-size: 0.75rem; font-weight: 900; text-transform: uppercase; letter-spacing: 0.05em;">Cola de Producción</div>
                    <div style="font-size: 2rem; font-weight: 900; color: #ffffff; margin-top: 0.5rem;">{{ $pedidos->count() }}</div>
                    <div style="color: #dc2626; font-size: 0.75rem; font-weight: bold; margin-top: 0.5rem;">🔥 Diseños por estampar</div>
                    <div style="position: absolute; right: 1.5rem; bottom: 1rem; font-size: 2.5rem; opacity: 0.15;">⚡</div>
                </div>

                <div style="background-color: #09090b; border: 1px solid #27272a; border-radius: 1rem; padding: 1.5rem; position: relative; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.3);">
                    <div style="color: #71717a; font-size: 0.75rem; font-weight: 900; text-transform: uppercase; letter-spacing: 0.05em;">Inventario Global</div>
                    <div style="font-size: 2rem; font-weight: 900; color: #ffffff; margin-top: 0.5rem;">{{ $productos->count() }}</div>
                    <div style="color: #25d366; font-size: 0.75rem; font-weight: bold; margin-top: 0.5rem;">📦 Referencias activas</div>
                    <div style="position: absolute; right: 1.5rem; bottom: 1rem; font-size: 2.5rem; opacity: 0.15;">👕</div>
                </div>

                <div style="background-color: #09090b; border: 1px solid #27272a; border-radius: 1rem; padding: 1.5rem; position: relative; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.3);">
                    <div style="color: #71717a; font-size: 0.75rem; font-weight: 900; text-transform: uppercase; letter-spacing: 0.05em;">Valor Comercial</div>
                    <div style="font-size: 2rem; font-weight: 900; color: #25d366; margin-top: 0.5rem;">
                        ${{ number_format($productos->sum('precio'), 0, ',', '.') }}
                    </div>
                    <div style="color: #a1a1aa; font-size: 0.75rem; font-weight: bold; margin-top: 0.5rem;">💰 Activos en tienda</div>
                    <div style="position: absolute; right: 1.5rem; bottom: 1rem; font-size: 2.5rem; opacity: 0.15;">💵</div>
                </div>

            </div>

            <div style="background-color: #09090b; border: 1px solid #27272a; border-radius: 1rem; padding: 2rem; display: flex; flex-direction: column; align-items: center;">
                <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1.5rem; width: 100%;">
                    <span style="font-size: 1.3rem;">📊</span>
                    <h3 style="text-transform: uppercase; font-size: 1.2rem; font-weight: 900; color: #ffffff; margin: 0;">Distribución de Inventario por Categoría</h3>
                </div>
                
                <div style="width: 100%; max-width: 320px; position: relative;">
                    <canvas id="graficaCategorias"></canvas>
                </div>
            </div>

            <div>
                <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem;">
                    <span style="font-size: 1.3rem;">⚡</span>
                    <h3 style="text-transform: uppercase; font-size: 1.2rem; font-weight: 900; color: #ffffff; margin: 0;">Cola de Estampados Personalizados</h3>
                </div>

                @if($pedidos->isEmpty())
                    <div style="background-color: #09090b; border: 1px dashed #27272a; border-radius: 1rem; padding: 3rem; text-align: center; color: #71717a;">
                        <p style="margin: 0; font-size: 0.95rem; text-transform: uppercase; font-weight: bold;">😎 ¡No hay designs pendientes por estampar!</p>
                    </div>
                @else
                    <div style="background-color: #09090b; border: 1px solid #27272a; border-radius: 1rem; overflow: hidden;">
                        <table style="width: 100%; border-collapse: collapse; text-align: left;">
                            <thead>
                                <tr style="background-color: #18181b; border-bottom: 1px solid #27272a; text-transform: uppercase; font-size: 0.75rem; color: #a1a1aa;">
                                    <th style="padding: 1rem 1.5rem;">Orden</th>
                                    <th style="padding: 1rem 1.5rem;">Cliente</th>
                                    <th style="padding: 1rem 1.5rem;">Diseño</th>
                                    <th style="padding: 1rem 1.5rem;">Instrucciones Especiales del Diseño</th>
                                    <th style="padding: 1rem 1.5rem;">Total</th>
                                    <th style="padding: 1rem 1.5rem; text-align: center;">Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($pedidos as $pedido)
                                    <tr style="border-bottom: 1px solid #27272a; font-size: 0.9rem;">
                                        <td style="padding: 1.5rem; font-weight: bold; color: #71717a;">#{{ $pedido->id }}</td>
                                        <td style="padding: 1.5rem; font-weight: bold;">{{ $pedido->user->name ?? 'Cliente' }}</td>
                                        <td style="padding: 1.5rem;">
                                            @if($pedido->diseno_imagen)
                                                <a href="{{ asset('storage/' . $pedido->diseno_imagen) }}" target="_blank">
                                                    <img src="{{ asset('storage/' . $pedido->diseno_imagen) }}" style="height: 60px; width: 60px; object-fit: cover; border-radius: 0.35rem; border: 1px solid #27272a;">
                                                </a>
                                            @else
                                                <span style="color: #71717a; font-size: 0.75rem;">Sin imagen</span>
                                            @endif
                                        </td>
                                        <td style="padding: 1.5rem; color: #e4e4e7; line-height: 1.4;">
                                            {!! str_replace('Personalizado:', '<span style="color: #dc2626; font-weight:900;">🔥 Personalizado:</span>', e($pedido->detalles)) !!}
                                        </td>
                                        <td style="padding: 1.5rem; font-weight: 900; color: #25d366;">${{ number_format($pedido->total, 0, ',', '.') }}</td>
                                        <td style="padding: 1.5rem; text-align: center;">
                                            <form action="{{ route('pedido.completar', $pedido->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" style="background-color: #ffffff; color: black; border: none; padding: 0.5rem 1rem; border-radius: 0.35rem; font-weight: 900; text-transform: uppercase; font-size: 0.75rem; cursor: pointer;">
                                                    ✓ Listo
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

            <div style="background-color: #09090b; border: 1px solid #27272a; border-radius: 1rem; padding: 2rem;">
                <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem;">
                    <span style="font-size: 1.3rem;">🎯</span>
                    <h3 style="text-transform: uppercase; font-size: 1.2rem; font-weight: 900; color: #ffffff; margin: 0;">Registro Rápido de Caja</h3>
                </div>
                <p style="color: #71717a; font-size: 0.85rem; margin-top: 0; margin-bottom: 1.5rem;">Haz clic dentro del cuadro inferior y pasa el escáner sobre la etiqueta real de la prenda para agregarla al pedido del cliente actual.</p>
                
                <input type="text" id="lector-barra" placeholder="🚀 Pasa el escáner por la prenda aquí..." autofocus
                       style="width: 100%; background-color: #18181b; border: 1px solid #27272a; color: white; padding: 1rem; border-radius: 0.5rem; font-size: 1rem; outline: none; box-sizing: border-box; font-weight: bold; transition: border-color 0.2s;"
                       onfocus="this.style.borderColor='#dc2626'" onblur="this.style.borderColor='#27272a'">
            </div>

            <div>
                <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem;">
                    <span style="font-size: 1.3rem;">👕</span>
                    <h3 style="text-transform: uppercase; font-size: 1.2rem; font-weight: 900; color: #ffffff; margin: 0;">Catálogo General de Ropa</h3>
                </div>

                <div style="background-color: #09090b; border: 1px solid #27272a; border-radius: 1rem; overflow: hidden;">
                    <table style="width: 100%; border-collapse: collapse; text-align: left;">
                        <thead>
                            <tr style="background-color: #18181b; border-bottom: 1px solid #27272a; text-transform: uppercase; font-size: 0.75rem; color: #a1a1aa;">
                                <th style="padding: 1rem 1.5rem;">Prenda</th>
                                <th style="padding: 1rem 1.5rem;">Categoría</th>
                                <th style="padding: 1rem 1.5rem;">Talla</th>
                                <th style="padding: 1rem 1.5rem;">Precio Unitario</th>
                                <th style="padding: 1rem 1.5rem; text-align: center;">Estado Inventario</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($productos as $producto)
                                <tr style="border-bottom: 1px solid #27272a; font-size: 0.9rem;">
                                    <td style="padding: 1.25rem 1.5rem; font-weight: bold; color: white;">
                                        {{ $producto->nombre }}
                                    </td>
                                    <td style="padding: 1.25rem 1.5rem; color: #a1a1aa; text-transform: uppercase; font-size: 0.8rem;">
                                        <span style="background-color: #18181b; padding: 0.25rem 0.6rem; border-radius: 0.25rem; border: 1px solid #27272a;">
                                            {{ $producto->categoria ?? 'General' }}
                                        </span>
                                    </td>
                                    <td style="padding: 1.25rem 1.5rem; font-weight: bold;">
                                        {{ $producto->talla ?? 'Única' }}
                                    </td>
                                    <td style="padding: 1.25rem 1.5rem; font-weight: bold; color: #a1a1aa;">
                                        ${{ number_format($producto->precio, 0, ',', '.') }}
                                    </td>
                                    <td style="padding: 1.25rem 1.5rem; text-align: center;">
                                        <span style="color: #25d366; background-color: rgba(37, 211, 102, 0.1); padding: 0.3rem 0.75rem; border-radius: 1rem; font-size: 0.75rem; font-weight: bold; text-transform: uppercase;">
                                            ● Disponible en Tienda
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div>
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem;">
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <span style="font-size: 1.3rem;">📦</span>
                        <h3 style="text-transform: uppercase; font-size: 1.2rem; font-weight: 900; color: #ffffff; margin: 0;">Gestión de Inventario (Catálogo)</h3>
                    </div>
                    
                    <a href="{{ route('productos.create') }}" style="background-color: #dc2626; color: white; padding: 0.7rem 1.5rem; border-radius: 0.5rem; font-weight: bold; text-decoration: none; text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.05em;">
                        ➕ Añadir Nuevo Producto
                    </a>
                </div>

                @if($productos->isEmpty())
                    <div style="background-color: #09090b; border: 1px dashed #27272a; border-radius: 1rem; padding: 3rem; text-align: center; color: #71717a;">
                        <p style="margin: 0; font-size: 0.95rem; text-transform: uppercase; font-weight: bold;">📦 No hay productos en el catálogo comercial.</p>
                    </div>
                @else
                    <div style="background-color: #09090b; border: 1px solid #27272a; border-radius: 1rem; overflow: hidden;">
                        <table style="width: 100%; border-collapse: collapse; text-align: left;">
                            <thead>
                                <tr style="background-color: #18181b; border-bottom: 1px solid #27272a; text-transform: uppercase; font-size: 0.75rem; color: #a1a1aa;">
                                    <th style="padding: 1rem 1.5rem;">Imagen</th>
                                    <th style="padding: 1rem 1.5rem;">Nombre</th>
                                    <th style="padding: 1rem 1.5rem;">Categoría</th>
                                    <th style="padding: 1rem 1.5rem;">Precio</th>
                                    <th style="padding: 1rem 1.5rem; text-align: center;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody style="color: #e4e4e7; font-size: 0.9rem;">
                                @foreach($productos as $producto)
                                    <tr style="border-bottom: 1px solid #18181b;">
                                        <td style="padding: 1rem 1.5rem;">
                                            @if($producto->imagen)
                                                <img src="{{ asset('storage/' . $producto->imagen) }}" style="height: 50px; width: 50px; object-fit: cover; border-radius: 0.35rem; border: 1px solid #27272a;">
                                            @else
                                                <span style="color: #71717a; font-size: 0.75rem;">Sin foto</span>
                                            @endif
                                        </td>
                                        <td style="padding: 1rem 1.5rem; font-weight: bold; color: #ffffff;">{{ $producto->nombre }}</td>
                                        <td style="padding: 1rem 1.5rem;"><span style="background-color: #27272a; padding: 0.2rem 0.6rem; border-radius: 1rem; font-size: 0.8rem;">{{ $producto->categoria ?? 'General' }}</span></td>
                                        <td style="padding: 1rem 1.5rem; font-weight: bold; color: #25d366;">$ {{ number_format($producto->precio, 0, ',', '.') }}</td>
                                        <td style="padding: 1rem 1.5rem; text-align: center;">
                                            <div style="display: flex; gap: 0.5rem; justify-content: center;">
                                                <a href="{{ route('productos.edit', $producto->id) }}" style="background-color: #27272a; color: #ffffff; padding: 0.4rem 0.8rem; border-radius: 0.35rem; text-decoration: none; font-size: 0.8rem; font-weight: bold; border: 1px solid #3f3f46;">
                                                    Editar
                                                </a>

                                                <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este producto?')" style="margin: 0;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" style="background-color: rgba(220, 38, 38, 0.1); color: #dc2626; border: 1px solid #dc2626; padding: 0.4rem 0.8rem; border-radius: 0.35rem; font-size: 0.8rem; font-weight: bold; cursor: pointer;">
                                                        Borrar
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>

        </div>
    </div>

    <script>
        // --- 1. FUNCIÓN PARA LAS NOTIFICACIONES FLOTANTES (TOASTS) ---
        function mostrarNotificacion(mensaje, tipo = 'success') {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');
            
            const colorBorde = tipo === 'success' ? '#25d366' : '#dc2626';
            const fondo = '#09090b';

            toast.style.cssText = `
                background-color: ${fondo};
                color: white;
                padding: 1rem 1.5rem;
                border-left: 4px solid ${colorBorde};
                border-radius: 0.35rem;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5), 0 0 10px ${colorBorde}33;
                font-weight: bold;
                font-family: sans-serif;
                font-size: 0.9rem;
                text-transform: uppercase;
                min-width: 250px;
                opacity: 0;
                transform: translateX(50px);
                transition: all 0.4s ease;
            `;
            
            toast.innerText = mensaje;
            container.appendChild(toast);

            setTimeout(() => {
                toast.style.opacity = '1';
                toast.style.transform = 'translateX(0)';
            }, 50);

            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transform = 'translateX(50px)';
                setTimeout(() => toast.remove(), 400);
            }, 3000);
        }

        // --- 2. EVENTO DEL LECTOR DE CÓDIGO DE BARRAS REAL ---
        document.getElementById('lector-barra').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                let codigo = this.value.trim();
                if (codigo === '') return;

                fetch(`/buscar-producto/${codigo}`)
                    .then(response => response.json())
                    .then(producto => {
                        if (producto.success) {
                            mostrarNotificacion(`👕 ${producto.nombre} agregado ($${producto.precio})`, 'success');
                            document.getElementById('lector-barra').value = ''; 
                        } else {
                            mostrarNotificacion('⚠ El producto no está registrado', 'error');
                            document.getElementById('lector-barra').value = '';
                        }
                    })
                    .catch(error => {
                        console.error(error);
                        mostrarNotificacion('Error en el servidor', 'error');
                    });
            }
        });

        // --- 3. PROCESAMIENTO Y GENERACIÓN DE LA GRÁFICA (CHART.JS) ---
        @php
            $categoriasAgrupadas = $productos->groupBy('categoria');
            $nombresCategorias = [];
            $cantidadesCategorias = [];

            foreach($categoriasAgrupadas as $cat => $prods) {
                $nombresCategorias[] = $cat ? strtoupper($cat) : 'GENERAL';
                $cantidadesCategorias[] = $prods->count();
            }
        @endphp

        const etiquetas = {!! json_encode($nombresCategorias) !!};
        const datos = {!! json_encode($cantidadesCategorias) !!};

        const ctx = document.getElementById('graficaCategorias').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: etiquetas,
                datasets: [{
                    data: datos,
                    backgroundColor: [
                        '#dc2626', // Rojo NowStyle
                        '#25d366', // Verde Neón
                        '#3b82f6', // Azul Eléctrico
                        '#a855f7', // Morado Cyber
                        '#eab308'  // Amarillo Fuego
                    ],
                    borderColor: '#09090b',
                    borderWidth: 3
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#a1a1aa',
                            font: {
                                weight: 'bold',
                                family: 'sans-serif'
                              },
                            padding: 15
                        }
                    }
                },
                cutout: '70%'
            }
        });
    </script>
</x-app-layout>