<x-app-layout>
    <div id="empleado-container" style="background-color: #000000; min-height: 100vh; width: 100%; display: flex; flex-direction: column; font-family: 'Inter', system-ui, sans-serif; box-sizing: border-box; color: #ffffff; padding-bottom: 5rem;">
        
        <style>
            /* Sistema de Pestañas (Tabs) */
            .tab-nav {
                display: flex;
                gap: 1rem;
                background-color: #09090b;
                padding: 0.75rem 1.5rem;
                border-radius: 0.75rem;
                border: 1px solid #1c1c1e;
                margin-bottom: 2rem;
                flex-wrap: wrap;
            }
            .tab-button {
                background: transparent;
                border: none;
                color: #71717a;
                padding: 0.75rem 1.25rem;
                border-radius: 0.5rem;
                font-weight: 700;
                font-size: 0.85rem;
                text-transform: uppercase;
                cursor: pointer;
                transition: all 0.25s ease;
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
            }
            .tab-button:hover {
                color: #ffffff;
                background-color: #121214;
            }
            .tab-button.active {
                color: #ffffff;
                background-color: #dc2626;
                box-shadow: 0 4px 12px rgba(220, 38, 38, 0.25);
            }
            .tab-content {
                display: none;
                animation: fadeIn 0.35s ease forwards;
            }
            .tab-content.active {
                display: block;
            }

            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(8px); }
                to { opacity: 1; transform: translateY(0); }
            }

            /* Botonera y Componentes del Sistema */
            .btn-secondary {
                background-color: #1c1c1e;
                border: 1px solid #27272a;
                color: #ffffff;
                padding: 0.75rem 1.5rem;
                border-radius: 0.5rem;
                font-weight: 700;
                font-size: 0.8rem;
                text-transform: uppercase;
                text-decoration: none;
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                transition: all 0.2s ease;
            }
            .btn-secondary:hover {
                background-color: #27272a;
                border-color: #3f3f46;
                transform: translateY(-1px);
            }
            .btn-primary {
                background-color: #dc2626;
                color: #ffffff;
                padding: 0.75rem 1.5rem;
                border-radius: 0.5rem;
                font-weight: 700;
                font-size: 0.8rem;
                text-transform: uppercase;
                text-decoration: none;
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                box-shadow: 0 4px 12px rgba(220, 38, 38, 0.2);
                transition: all 0.2s ease;
                border: none;
                cursor: pointer;
            }
            .btn-primary:hover {
                background-color: #ef4444;
                box-shadow: 0 6px 16px rgba(220, 38, 38, 0.35);
                transform: translateY(-1px);
            }
            .btn-success {
                background-color: #ffffff;
                color: #000000;
                border: none;
                padding: 0.5rem 1.25rem;
                border-radius: 0.375rem;
                font-weight: 900;
                text-transform: uppercase;
                font-size: 0.75rem;
                cursor: pointer;
                transition: all 0.2s ease;
                display: inline-flex;
                align-items: center;
                gap: 0.25rem;
            }
            .btn-success:hover {
                background-color: #e4e4e7;
                transform: translateY(-1px);
            }
            .btn-danger-outline {
                background-color: rgba(220, 38, 38, 0.08);
                color: #ef4444;
                border: 1px solid rgba(220, 38, 38, 0.3);
                padding: 0.5rem 1rem;
                border-radius: 0.375rem;
                font-size: 0.8rem;
                font-weight: 700;
                cursor: pointer;
                text-transform: uppercase;
                transition: all 0.2s ease;
            }
            .btn-danger-outline:hover {
                background-color: #dc2626;
                color: #ffffff;
                border-color: #dc2626;
            }
            .card-panel {
                background-color: #09090b;
                border: 1px solid #1c1c1e;
                border-radius: 1rem;
                padding: 1.5rem;
                box-shadow: 0 4px 24px rgba(0,0,0,0.4);
                position: relative;
                overflow: hidden;
            }
            .table-nowstyle th {
                background-color: #0c0c0e;
                padding: 1rem 1.5rem;
                text-transform: uppercase;
                font-size: 0.75rem;
                color: #71717a;
                letter-spacing: 0.05em;
                border-bottom: 1px solid #1c1c1e;
            }
            .table-nowstyle td {
                padding: 1.25rem 1.5rem;
                border-bottom: 1px solid #1c1c1e;
            }
            .product-card {
                background: #09090b;
                border: 1px solid #1c1c1e;
                border-radius: 0.75rem;
                padding: 1.25rem;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                transition: border-color 0.2s ease, transform 0.2s ease;
            }
            .product-card:hover {
                border-color: #27272a;
                transform: translateY(-2px);
            }
        </style>

        <div style="background-color: #09090b; border-bottom: 1px solid #1c1c1e; padding: 1.25rem 2rem;">
            <div style="max-width: 1280px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <span style="background-color: rgba(220, 38, 38, 0.1); color: #dc2626; padding: 0.5rem; border-radius: 0.5rem; font-weight: bold; font-size: 1.1rem;">🛠️</span>
                    <h2 style="font-weight: 900; font-size: 1.35rem; text-transform: uppercase; color: #ffffff; margin: 0; letter-spacing: 0.03em;">
                        Panel de Control Empleado
                    </h2>
                </div>
                
                <div style="display: flex; gap: 0.75rem; align-items: center;">
                    <a href="{{ route('cliente.index') }}" class="btn-secondary">
                        🛒 Ir a la Tienda
                    </a>
                    <a href="{{ route('productos.create') }}" class="btn-primary">
                        ➕ Crear Producto
                    </a>
                </div>
            </div>
        </div>

        <div id="toast-container" style="position: fixed; top: 2rem; right: 2rem; z-index: 9999; display: flex; flex-direction: column; gap: 1rem;"></div>

        <div style="max-width: 1280px; margin: 0 auto; width: 100%; padding: 2rem; box-sizing: border-box;">
            <div style="display: flex; flex-direction: column;">
                
                @if(session('success'))
                    <div style="background-color: rgba(37, 211, 102, 0.1); border-left: 4px solid #25d366; color: #25d366; padding: 1rem 1.5rem; border-radius: 0.5rem; font-weight: bold; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.02em; margin-bottom: 1.5rem;">
                        🚀 {{ session('success') }}
                    </div>
                @endif

               <div class="tab-nav">
                  <button class="tab-button active" onclick="cambiarPestaña('pestaña-metricas', this)">
                      📊 Métricas y Caja
                  </button>
                  <button class="tab-button" onclick="cambiarPestaña('pestaña-estampados', this)">
                      ⚡ Cola de Estampados ({{ $pedidos->count() }})
                  </button>
                  <button class="tab-button" onclick="cambiarPestaña('pestaña-catalogo', this)">
                      👕 Catálogo Comercial ({{ $productos->count() }})
                  </button>
    
                  @if(Auth::user()->rol === 'gerente' || Auth::user()->rol === 'empleado')
                      <button class="tab-button" onclick="cambiarPestaña('pestaña-reportes', this)" style="border-left: 2px solid #dc2626; padding-left: 1rem;">
                          📈 Reportes de Ventas
                      </button>
                  @endif
               </div>

                <div id="pestaña-metricas" class="tab-content active">
                    <div style="display: flex; flex-direction: column; gap: 2.5rem;">
                        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem;">
                            <div class="card-panel">
                                <div style="color: #71717a; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.05em;">Cola de Producción</div>
                                <div style="font-size: 2.5rem; font-weight: 900; color: #ffffff; margin-top: 0.25rem; line-height: 1;">{{ $pedidos->count() }}</div>
                                <div style="color: #dc2626; font-size: 0.75rem; font-weight: 700; margin-top: 0.5rem; display: flex; align-items: center; gap: 0.25rem;">
                                    <span>🔥</span> Diseños por estampar
                                </div>
                                <div style="position: absolute; right: 1.25rem; bottom: 0.75rem; font-size: 2.5rem; opacity: 0.08; user-select: none;">⚡</div>
                            </div>

                            <div class="card-panel">
                                <div style="color: #71717a; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.05em;">Inventario Global</div>
                                <div style="font-size: 2.5rem; font-weight: 900; color: #ffffff; margin-top: 0.25rem; line-height: 1;">{{ $productos->count() }}</div>
                                <div style="color: #25d366; font-size: 0.75rem; font-weight: 700; margin-top: 0.5rem; display: flex; align-items: center; gap: 0.25rem;">
                                    <span>📦</span> Referencias activas
                                </div>
                                <div style="position: absolute; right: 1.25rem; bottom: 0.75rem; font-size: 2.5rem; opacity: 0.08; user-select: none;">👕</div>
                            </div>

                            <div class="card-panel">
                                <div style="color: #71717a; font-size: 0.75rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.05em;">Valor Comercial</div>
                                <div style="font-size: 2.5rem; font-weight: 900; color: #25d366; margin-top: 0.25rem; line-height: 1;">
                                    ${{ number_format($productos->sum('precio'), 0, ',', '.') }}
                                </div>
                                <div style="color: #a1a1aa; font-size: 0.75rem; font-weight: 700; margin-top: 0.5rem; display: flex; align-items: center; gap: 0.25rem;">
                                    <span>💰</span> Activos en tienda
                                </div>
                                <div style="position: absolute; right: 1.25rem; bottom: 0.75rem; font-size: 2.5rem; opacity: 0.08; user-select: none;">💵</div>
                            </div>
                        </div>

                        <div style="display: grid; grid-template-columns: 1fr 340px; gap: 1.5rem; align-items: start;" class="responsive-layout-row">
                            <style>
                                @media (max-width: 900px) {
                                    .responsive-layout-row { grid-template-columns: 1fr !important; }
                                }
                            </style>
                            
                            <div class="card-panel" style="height: 100%; display: flex; flex-direction: column; justify-content: center; padding: 2rem;">
                                <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 0.75rem;">
                                    <span style="font-size: 1.2rem; color: #dc2626;">🎯</span>
                                    <h3 style="text-transform: uppercase; font-size: 1.05rem; font-weight: 900; color: #ffffff; margin: 0; letter-spacing: 0.02em;">Registro Rápido de Caja</h3>
                                </div>
                                <p style="color: #71717a; font-size: 0.85rem; margin-top: 0; margin-bottom: 1.5rem; line-height: 1.5;">
                                    Haz clic dentro del cuadro inferior y pasa el escáner sobre la etiqueta física de la prenda para guardarla al pedido activo de manera inmediata.
                                </p>
                                
                                <div style="position: relative; width: 100%;">
                                    <input type="text" id="lector-barra" placeholder="🚀 Pasa el escáner por la prenda aquí..." autofocus
                                           style="width: 100%; background-color: #121214; border: 1px solid #27272a; color: white; padding: 1.1rem 1.25rem; border-radius: 0.5rem; font-size: 0.95rem; outline: none; box-sizing: border-box; font-weight: bold; transition: all 0.2s ease; box-shadow: inset 0 2px 4px rgba(0,0,0,0.6);"
                                           onfocus="this.style.borderColor='#dc2626'; this.style.boxShadow='0 0 12px rgba(220,38,38,0.15), inset 0 2px 4px rgba(0,0,0,0.6)'" 
                                           onblur="this.style.borderColor='#27272a'; this.style.boxShadow='inset 0 2px 4px rgba(0,0,0,0.6)'">
                                    <span style="position: absolute; right: 1.25rem; top: 1.15rem; opacity: 0.4; font-size: 1rem;">📟</span>
                                </div>
                            </div>

                            <div class="card-panel" style="display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 1.5rem;">
                                <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1.25rem; width: 100%; justify-content: center;">
                                    <span style="font-size: 1.1rem;">📊</span>
                                    <h3 style="text-transform: uppercase; font-size: 0.85rem; font-weight: 900; color: #a1a1aa; margin: 0; text-align: center; letter-spacing: 0.02em;">Inventario por Categoría</h3>
                                </div>
                                <div style="width: 100%; max-width: 210px; position: relative; margin: 0 auto;">
                                    <canvas id="graficaCategorias"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="pestaña-estampados" class="tab-content">
                    <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1.5rem;">
                        <span style="font-size: 1.2rem; color: #dc2626;">⚡</span>
                        <h3 style="text-transform: uppercase; font-size: 1.1rem; font-weight: 900; color: #ffffff; margin: 0; letter-spacing: 0.03em;">Cola de Estampados Pendientes</h3>
                    </div>

                    @if($pedidos->isEmpty())
                        <div style="background-color: #09090b; border: 1px dashed #27272a; border-radius: 1rem; padding: 3.5rem; text-align: center; color: #71717a;">
                            <span style="font-size: 2rem; display: block; margin-bottom: 0.5rem;">😎</span>
                            <p style="margin: 0; font-size: 0.9rem; text-transform: uppercase; font-weight: 800; letter-spacing: 0.03em;">¡Buen trabajo! No hay diseños pendientes por estampar</p>
                        </div>
                    @else
                        <div style="background-color: #09090b; border: 1px solid #1c1c1e; border-radius: 0.75rem; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.3);">
                            <table class="table-nowstyle" style="width: 100%; border-collapse: collapse; text-align: left;">
                                <thead>
                                    <tr>
                                        <th>Orden</th>
                                        <th>Cliente</th>
                                        <th>Diseño</th>
                                        <th>Instrucciones Especiales del Diseño</th>
                                        <th>Total</th>
                                        <th style="text-align: center;">Acción</th>
                                    </tr>
                                </thead>
                                <tbody style="font-size: 0.88rem;">
                                    @foreach($pedidos as $pedido)
                                        <tr style="transition: background-color 0.15s ease;">
                                            <td style="font-weight: 800; color: #3f3f46;">#{{ $pedido->id }}</td>
                                            <td style="font-weight: 700; color: #ffffff;">{{ $pedido->user->name ?? 'Cliente' }}</td>
                                            <td>
                                                @if($pedido->diseno_imagen)
                                                    <a href="{{ asset('storage/' . $pedido->diseno_imagen) }}" target="_blank" style="display: inline-block; line-height: 0;">
                                                        <img src="{{ asset('storage/' . $pedido->diseno_imagen) }}" style="height: 52px; width: 52px; object-fit: cover; border-radius: 0.5rem; border: 1px solid #27272a; transition: transform 0.2s;" onmouseover="this.style.transform='scale(1.08)'" onmouseout="this.style.transform='scale(1)'">
                                                    </a>
                                                @else
                                                    <span style="color: #52525b; font-size: 0.75rem; background-color: #121214; padding: 0.25rem 0.5rem; border-radius: 0.25rem;">Sin imagen</span>
                                                @endif
                                            </td>
                                            <td style="color: #d4d4d8; line-height: 1.5; max-width: 350px;">
                                                {!! str_replace('Personalizado:', '<span style="color: #dc2626; font-weight:900; text-transform:uppercase; font-size:0.75rem; background: rgba(220,38,38,0.1); padding: 0.15rem 0.4rem; border-radius:0.25rem;">🔥 Personalizado:</span>', e($pedido->detalles)) !!}
                                            </td>
                                            <td style="font-weight: 900; color: #25d366; font-size: 0.95rem;">${{ number_format($pedido->total, 0, ',', '.') }}</td>
                                            <td style="text-align: center;">
                                                <form action="{{ route('pedido.completar', $pedido->id) }}" method="POST" style="margin: 0;">
                                                    @csrf
                                                    <button type="submit" class="btn-success">
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

                <div id="pestaña-catalogo" class="tab-content">
                    <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1.5rem;">
                        <span style="font-size: 1.2rem; color: #dc2626;">👕</span>
                        <h3 style="text-transform: uppercase; font-size: 1.1rem; font-weight: 900; color: #ffffff; margin: 0; letter-spacing: 0.03em;">Catálogo de Ropa Comercial</h3>
                    </div>

                    @if($productos->isEmpty())
                        <div style="background-color: #09090b; border: 1px dashed #27272a; border-radius: 1rem; padding: 3.5rem; text-align: center; color: #71717a;">
                            <span style="font-size: 2rem; display: block; margin-bottom: 0.5rem;">📦</span>
                            <p style="margin: 0; font-size: 0.9rem; text-transform: uppercase; font-weight: 800;">No hay productos registrados en el catálogo comercial</p>
                        </div>
                    @else
                        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(290px, 1fr)); gap: 1.25rem;">
                            @foreach($productos as $producto)
                                <div class="product-card">
                                    <div style="display: flex; gap: 1rem; align-items: flex-start; margin-bottom: 1rem;">
                                        <div>
                                            @if($producto->imagen)
                                                <img src="{{ asset('storage/' . $producto->imagen) }}" style="height: 64px; width: 64px; object-fit: cover; border-radius: 0.5rem; border: 1px solid #1c1c1e; background-color: #121214;">
                                            @else
                                                <div style="height: 64px; width: 64px; background-color: #121214; border: 1px dashed #27272a; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; color: #52525b; font-size: 0.65rem; text-transform: uppercase; font-weight: bold; text-align: center; padding: 0.25rem; box-sizing: border-box;">
                                                    Sin foto
                                                </div>
                                            @endif
                                        </div>
                                        
                                        <div style="display: flex; flex-direction: column; gap: 0.25rem; flex: 1;">
                                            <h4 style="margin: 0; font-size: 0.95rem; font-weight: 800; color: #ffffff; line-height: 1.3;">{{ $producto->nombre }}</h4>
                                            
                                            <div style="display: flex; gap: 0.4rem; align-items: center; flex-wrap: wrap; margin-top: 0.15rem;">
                                                <span style="background-color: #121214; padding: 0.2rem 0.5rem; border-radius: 0.25rem; border: 1px solid #1c1c1e; color: #a1a1aa; font-size: 0.68rem; text-transform: uppercase; font-weight: 700;">
                                                    {{ $producto->categoria ?? 'General' }}
                                                </span>
                                                <span style="background-color: rgba(255,255,255,0.04); padding: 0.2rem 0.4rem; border-radius: 0.25rem; color: #ffffff; font-size: 0.7rem; font-weight: 800;">
                                                    Talla: {{ $producto->talla ?? 'Única' }}
                                                </span>
                                                <span style="background-color: rgba(255,255,255,0.04); padding: 0.2rem 0.4rem; border-radius: 0.25rem; color: #a1a1aa; font-size: 0.7rem; font-weight: 800;">
                                                    Stock: {{ $producto->stock ?? 0 }} uds
                                                </span>
                                            </div>

                                            @if(isset($producto->stock) && $producto->stock <= 10)
                                                <div style="margin-top: 0.35rem; display: inline-flex; align-items: center; gap: 0.25rem; color: #ef4444; background: rgba(239, 68, 68, 0.1); padding: 0.25rem 0.5rem; border-radius: 0.375rem; font-size: 0.68rem; font-weight: 800; text-transform: uppercase; width: fit-content; border: 1px solid rgba(239, 68, 68, 0.2);">
                                                    ⚠️ ¡Stock Crítico!
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div style="display: flex; justify-content: space-between; align-items: center; background-color: #121214; padding: 0.75rem 1rem; border-radius: 0.5rem; border: 1px solid #1c1c1e; margin-top: auto;">
                                        <div style="display: flex; flex-direction: column;">
                                            <span style="font-size: 0.65rem; color: #52525b; text-transform: uppercase; font-weight: 800; letter-spacing: 0.02em;">Precio Unitario</span>
                                            <span style="font-weight: 900; color: #25d366; font-size: 1.05rem;">${{ number_format($producto->precio, 0, ',', '.') }}</span>
                                        </div>

                                        <div style="display: flex; gap: 0.35rem; align-items: center;">
                                            <a href="{{ route('productos.edit', $producto->id) }}" style="background-color: #1c1c1e; color: #ffffff; padding: 0.45rem 0.75rem; border-radius: 0.375rem; text-decoration: none; font-size: 0.75rem; font-weight: bold; border: 1px solid #27272a; text-transform: uppercase; transition: all 0.15s;" onmouseover="this.style.backgroundColor='#27272a'" onmouseout="this.style.backgroundColor='#1c1c1e'">
                                                Editar
                                            </a>

                                            <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" onsubmit="return confirm('¿Seguro que deseas eliminar este producto del catálogo comercial?')" style="margin: 0; display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-danger-outline">
                                                    Borrar
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div id="pestaña-reportes" class="tab-content">
                    <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1.5rem;">
                        <span style="font-size: 1.2rem; color: #dc2626;">📈</span>
                        <h3 style="text-transform: uppercase; font-size: 1.1rem; font-weight: 900; color: #ffffff; margin: 0; letter-spacing: 0.03em;">
                            Historial Global de Ventas y Pedidos
                        </h3>
                    </div>

                    <div class="card-panel" style="padding: 2rem;">
                        <div style="overflow-x: auto;">
                            <table class="table-nowstyle" style="width: 100%; border-collapse: collapse; text-align: left;">
                                <thead>
                                    <tr>
                                        <th>ID Pedido</th>
                                        <th>Cliente</th>
                                        <th>Fecha</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody style="font-size: 0.88rem; color: #ffffff;">
                                    @forelse($ultimasVentas as $venta)
                                        <tr style="transition: background-color 0.15s ease;">
                                            <td style="font-weight: 800; color: #3f3f46;">#{{ $venta->id }}</td>
                                            <td style="font-weight: 700; color: #ffffff;">{{ $venta->cliente_nombre }}</td>
                                            <td style="color: #71717a;">{{ date('d M Y', strtotime($venta->created_at)) }}</td>
                                            <td style="font-weight: 900; color: #25d366; font-size: 0.95rem;">
                                                ${{ number_format($venta->total, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" style="text-align: center; color: #71717a; padding: 3.5rem;">
                                                <span style="font-size: 2rem; display: block; margin-bottom: 0.5rem;">📊</span>
                                                <p style="margin: 0; font-size: 0.9rem; text-transform: uppercase; font-weight: 800;">No hay ventas registradas en la base de datos</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // --- 1. CONTROLADOR DE CAMBIO DE PESTAÑAS (TABS) ---
        function cambiarPestaña(idPestaña, botonActivo) {
            const contenidos = document.querySelectorAll('.tab-content');
            contenidos.forEach(content => content.classList.remove('active'));

            const botones = document.querySelectorAll('.tab-button');
            botones.forEach(btn => btn.classList.remove('active'));

            const target = document.getElementById(idPestaña);
            if(target) {
                target.classList.add('active');
            }
            botonActivo.classList.add('active');
        }

        // --- 2. FUNCIÓN PARA LAS NOTIFICACIONES FLOTANTES (TOASTS) ---
        function mostrarNotificacion(mensaje, tipo = 'success') {
            const container = document.getElementById('toast-container');
            if(!container) return;
            
            const toast = document.createElement('div');
            const colorBorde = tipo === 'success' ? '#25d366' : '#dc2626';
            const fondo = '#09090b';

            toast.style.cssText = `
                background-color: ${fondo};
                color: white;
                padding: 1rem 1.5rem;
                border-left: 4px solid ${colorBorde};
                border-radius: 0.5rem;
                box-shadow: 0 10px 30px rgba(0,0,0,0.5), 0 0 15px ${colorBorde}22;
                font-weight: bold;
                font-family: sans-serif;
                font-size: 0.85rem;
                text-transform: uppercase;
                letter-spacing: 0.03em;
                min-width: 280px;
                opacity: 0;
                transform: translateX(50px);
                transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
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
                setTimeout(() => toast.remove(), 350);
            }, 3500);
        }

        // --- 3. EVENTO DEL LECTOR DE CÓDIGO DE BARRAS REAL ---
        const lector = document.getElementById('lector-barra');
        if(lector) {
            lector.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    let codigo = this.value.trim();
                    if (codigo === '') return;

                    fetch(`/buscar-producto/${codigo}`)
                        .then(response => response.json())
                        .then(producto => {
                            if (producto.success) {
                                const precioFormateado = new Intl.NumberFormat('es-CO', { style: 'currency', currency: 'COP', maximumFractionDigits: 0 }).format(producto.precio);
                                mostrarNotificacion(`👕 ${producto.nombre} agregado (${precioFormateado})`, 'success');
                                lector.value = ''; 
                                
                                setTimeout(() => location.reload(), 1000);
                            } else {
                                mostrarNotificacion('⚠ El producto no está registrado', 'error');
                                lector.value = '';
                            }
                        })
                        .catch(error => {
                            console.error(error);
                            mostrarNotificacion('Error de red en el servidor', 'error');
                        });
                }
            });
        }

        // --- 4. PROCESAMIENTO Y GENERACIÓN DE LA GRÁFICA (CHART.JS) ---
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

        const canvas = document.getElementById('graficaCategorias');
        if(canvas) {
            const ctx = canvas.getContext('2d');
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: etiquetas,
                    datasets: [{
                        data: datos,
                        backgroundColor: [
                            '#dc2626', 
                            '#25d366', 
                            '#3b82f6', 
                            '#a855f7', 
                            '#eab308'  
                        ],
                        borderColor: '#09090b',
                        borderWidth: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                color: '#71717a',
                                boxWidth: 10,
                                boxHeight: 10,
                                padding: 10,
                                font: {
                                    weight: 'bold',
                                size: 10,
                                    family: 'sans-serif'
                                }
                            }
                        }
                    },
                    cutout: '75%'
                }
            });
        }

        // --- 5. ALERTA AUTOMÁTICA DE BAJO STOCK ---
        document.addEventListener("DOMContentLoaded", function() {
            @foreach($productos as $producto)
                @if(isset($producto->stock) && $producto->stock <= 10)
                    mostrarNotificacion("⚠ BAJO STOCK: El producto '{{ addslashes($producto->nombre) }}' tiene solo {{ $producto->stock }} unidades.", "error");
                @endif
            @endforeach
        });
    </script>
</x-app-layout>