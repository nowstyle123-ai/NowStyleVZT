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
            }
            .tab-content.active {
                display: block;
                animation: fadeIn 0.3s ease-in-out forwards;
            }

            /* Botonera Estilizada */
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
            .btn-action-dark {
                background-color: #1c1c1e;
                color: #ffffff;
                border: 1px solid #27272a;
                padding: 0.45rem 0.75rem;
                border-radius: 0.375rem;
                text-decoration: none;
                font-size: 0.75rem;
                font-weight: bold;
                text-transform: uppercase;
                transition: all 0.15s;
                cursor: pointer;
            }
            .btn-action-dark:hover {
                background-color: #27272a;
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

            /* Tablas Estilizadas */
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
                color: #ffffff !important;
            }

            /* Selectores Estilo Form */
            #empleado-container select {
                background-color: #121214;
                border: 1px solid #27272a;
                color: #ffffff;
                padding: 0.45rem 2rem 0.45rem 0.75rem;
                border-radius: 0.375rem;
                outline: none;
                font-size: 0.75rem;
                font-weight: 700;
                cursor: pointer;
                transition: all 0.2s ease;
                appearance: none;
                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2371717a'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'/%3E%3C/svg%3E");
                background-repeat: no-repeat;
                background-position: right 0.5rem center;
                background-size: 0.85rem;
            }
            #empleado-container select:focus {
                border-color: #dc2626;
            }

            /* Tarjetas de Producto Compactas */
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

            /* Animaciones */
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(6px); }
                to { opacity: 1; transform: translateY(0); }
            }

            /* Contenedor Flotante de Notificaciones */
            #notification-container {
                position: fixed;
                bottom: 2rem;
                right: 2rem;
                display: flex;
                flex-direction: column;
                gap: 0.75rem;
                z-index: 9999;
                max-width: 420px;
            }
            .notification {
                background-color: #09090b;
                border: 1px solid #1c1c1e;
                padding: 1.25rem 1.5rem;
                border-radius: 0.75rem;
                box-shadow: 0 10px 30px rgba(0,0,0,0.6);
                display: flex;
                align-items: center;
                gap: 0.85rem;
                animation: slideIn 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275) forwards;
                color: #ffffff;
                font-size: 0.85rem;
                font-weight: 600;
                line-height: 1.4;
            }
            .notification.error { border-left: 4px solid #dc2626; }
            .notification.success { border-left: 4px solid #25d366; }
            @keyframes slideIn {
                from { transform: translateX(100%); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
        </style>

        <!-- Barra de Navegación / Encabezado Superior -->
        <div style="background-color: #09090b; border-bottom: 1px solid #1c1c1e; padding: 1.25rem 2rem;">
            <div style="max-width: 1280px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                <div style="display: flex; align-items: center; gap: 0.75rem;">
                    <span style="background-color: rgba(220, 38, 38, 0.1); color: #dc2626; padding: 0.5rem; border-radius: 0.5rem; font-weight: bold; font-size: 1.1rem;">💼</span>
                    <h2 style="font-weight: 900; font-size: 1.35rem; text-transform: uppercase; color: #ffffff; margin: 0; letter-spacing: 0.03em;">
                        Inicio - Panel Gerente
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

        <!-- Contenedor del Cuerpo Principal -->
        <div style="max-width: 1280px; margin: 2rem auto 0 auto; width: 100%; padding: 0 2rem; box-sizing: border-box; display: flex; flex-direction: column;">
            
            <!-- Notificación de Alerta de Sesión Activa -->
            <div style="background-color: rgba(37, 211, 102, 0.1); border-left: 4px solid #25d366; color: #25d366; padding: 1rem 1.5rem; border-radius: 0.5rem; font-weight: bold; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.02em; margin-bottom: 2rem;">
                🚀 @if(session('success')) {{ session('success') }} @else Has iniciado sesión como Administrador General @endif
            </div>

            <!-- Sistema de Navegación de Pestañas (Tabs) -->
            <div class="tab-nav">
                <button class="tab-button active" onclick="switchTab(event, 'roles')">🛡️ Control de Roles</button>
                <button class="tab-button" onclick="switchTab(event, 'analiticas')">📊 Analíticas Generales</button>
                <button class="tab-button" onclick="switchTab(event, 'inventario')">👕 Inventario Global</button>
                <button class="tab-button" onclick="switchTab(event, 'pedidos')">📦 Pedidos del Sistema</button>
            </div>

            <!-- PESTAÑA 1: CONTROL DE ROLES -->
            <div id="roles" class="tab-content active">
                <div style="background-color: #09090b; border: 1px solid #1c1c1e; border-radius: 0.75rem; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.3);">
                    <table class="table-nowstyle" style="width: 100%; border-collapse: collapse; text-align: left; min-width: 600px;">
                        <thead>
                            <tr>
                                <th>Usuario</th>
                                <th>Correo Electrónico</th>
                                <th>Rol Actual</th>
                                <th style="text-align: center;">Asignar Nuevo Rol</th>
                            </tr>
                        </thead>
                        <tbody style="font-size: 0.88rem;">
                            @foreach($usuarios as $usuario)
                            <tr style="transition: background-color 0.15s ease;">
                                <td style="font-weight: 700; color: #ffffff;">{{ $usuario->name }}</td>
                                <td style="color: #a1a1aa;">{{ $usuario->email }}</td>
                                <td>
                                    <span style="background-color: rgba(220, 38, 38, 0.1); color: #dc2626; padding: 0.25rem 0.6rem; border-radius: 0.25rem; font-size: 0.75rem; font-weight: 900; text-transform: uppercase; border: 1px solid rgba(220, 38, 38, 0.2);">
                                        {{ $usuario->rol }}
                                    </span>
                                </td>
                                <td style="text-align: center;">
                                    <form action="{{ route('usuarios.updateRol', $usuario->id) }}" method="POST" style="margin: 0; display: inline-flex; gap: 0.5rem; align-items: center;">
                                        @csrf
                                        @method('PATCH')
                                        
                                        <!-- Ajustado a opción 'usuario' -->
                                        <select name="rol">
                                            <option value="usuario" {{ $usuario->rol == 'usuario' ? 'selected' : '' }}>Usuario</option>
                                            <option value="empleado" {{ $usuario->rol == 'empleado' ? 'selected' : '' }}>Empleado</option>
                                            <option value="gerente" {{ $usuario->rol == 'gerente' ? 'selected' : '' }}>Gerente</option>
                                        </select>

                                        <button type="submit" class="btn-action-dark">
                                            Cambiar
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- PESTAÑA 2: ANALÍTICAS GENERALES -->
            <div id="analiticas" class="tab-content">
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.5rem; margin-bottom: 2.5rem;">
                    <div style="background-color: #09090b; border: 1px solid #1c1c1e; padding: 1.5rem; border-radius: 0.75rem; display: flex; align-items: center; gap: 1rem;">
                        <span style="font-size: 2rem; background-color: rgba(37, 211, 102, 0.1); padding: 0.5rem; border-radius: 0.5rem;">💰</span>
                        <div>
                            <p style="margin: 0; color: #71717a; font-size: 0.75rem; font-weight: bold; text-transform: uppercase;">Ingresos Totales</p>
                            <h3 style="margin: 0; font-size: 1.5rem; font-weight: 900; color: #25d366;">${{ number_format($totalVentas ?? 0, 0, ',', '.') }}</h3>
                        </div>
                    </div>
                    <div style="background-color: #09090b; border: 1px solid #1c1c1e; padding: 1.5rem; border-radius: 0.75rem; display: flex; align-items: center; gap: 1rem;">
                        <span style="font-size: 2rem; background-color: rgba(59, 130, 246, 0.1); padding: 0.5rem; border-radius: 0.5rem;">Box</span>
                        <div>
                            <p style="margin: 0; color: #71717a; font-size: 0.75rem; font-weight: bold; text-transform: uppercase;">Pedidos Procesados</p>
                            <h3 style="margin: 0; font-size: 1.5rem; font-weight: 900; color: #3b82f6;">{{ $totalPedidos ?? 0 }} Órdenes</h3>
                        </div>
                    </div>
                    <div style="background-color: #09090b; border: 1px solid #1c1c1e; padding: 1.5rem; border-radius: 0.75rem; display: flex; align-items: center; gap: 1rem;">
                        <span style="font-size: 2rem; background-color: rgba(220, 38, 38, 0.1); padding: 0.5rem; border-radius: 0.5rem;">⚠</span>
                        <div>
                            <p style="margin: 0; color: #71717a; font-size: 0.75rem; font-weight: bold; text-transform: uppercase;">Productos Bajo Stock</p>
                            <h3 style="margin: 0; font-size: 1.5rem; font-weight: 900; color: #dc2626;">{{ $productosBajoStock ?? 0 }} Alertas</h3>
                        </div>
                    </div>
                </div>

                <!-- Control y Mapeo del Personal Corporativo -->
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 2rem; margin-bottom: 2.5rem; align-items: start;">
                    
                    <div style="background-color: #09090b; border: 1px solid #1c1c1e; padding: 2rem; border-radius: 0.75rem; height: 100%; box-sizing: border-box;">
                        <h4 style="margin: 0 0 1.25rem 0; font-size: 0.85rem; font-weight: bold; text-transform: uppercase; color: #71717a; letter-spacing: 0.05em; border-bottom: 1px solid #1c1c1e; padding-bottom: 0.75rem;">
                            👥 Estructura del Personal & Usuarios
                        </h4>
                        
                        <div style="display: flex; flex-direction: column; gap: 1rem; margin-top: 1.25rem;">
                            <div style="display: flex; justify-content: space-between; align-items: center; background-color: #121214; padding: 1rem; border-radius: 0.5rem; border: 1px solid #1c1c1e;">
                                <div style="display: flex; align-items: center; gap: 0.75rem;">
                                    <span style="font-size: 1.25rem; background-color: rgba(168, 85, 247, 0.1); padding: 0.4rem; border-radius: 0.375rem;">🛠</span>
                                    <span style="font-size: 0.85rem; font-weight: 700; color: #ffffff;">Empleados Activos</span>
                                </div>
                                <span style="font-size: 1.25rem; font-weight: 900; color: #a855f7;">
                                    {{ $usuarios->where('rol', 'empleado')->count() }}
                                </span>
                            </div>

                            <div style="display: flex; justify-content: space-between; align-items: center; background-color: #121214; padding: 1rem; border-radius: 0.5rem; border: 1px solid #1c1c1e;">
                                <div style="display: flex; align-items: center; gap: 0.75rem;">
                                    <span style="font-size: 1.25rem; background-color: rgba(234, 179, 8, 0.1); padding: 0.4rem; border-radius: 0.375rem;">👑</span>
                                    <span style="font-size: 0.85rem; font-weight: 700; color: #ffffff;">Cuerpo de Gerencia</span>
                                </div>
                                <span style="font-size: 1.25rem; font-weight: 900; color: #eab308;">
                                    {{ $usuarios->where('rol', 'gerente')->count() }}
                                </span>
                            </div>

                            <!-- Corregido a Usuarios en Base -->
                            <div style="display: flex; justify-content: space-between; align-items: center; background-color: #121214; padding: 1rem; border-radius: 0.5rem; border: 1px solid #1c1c1e;">
                                <div style="display: flex; align-items: center; gap: 0.75rem;">
                                    <span style="font-size: 1.25rem; background-color: rgba(59, 130, 246, 0.1); padding: 0.4rem; border-radius: 0.375rem;">🛍</span>
                                    <span style="font-size: 0.85rem; font-weight: 700; color: #ffffff;">Usuarios en Base</span>
                                </div>
                                <span style="font-size: 1.25rem; font-weight: 900; color: #3b82f6;">
                                    {{ $usuarios->where('rol', 'usuario')->count() }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div style="background-color: #09090b; border: 1px solid #1c1c1e; padding: 2rem; border-radius: 0.75rem; text-align: center; height: 100%; box-sizing: border-box;">
                        <h4 style="margin: 0 0 1.5rem 0; font-size: 0.85rem; font-weight: bold; text-transform: uppercase; color: #71717a; letter-spacing: 0.05em;">Distribución por Categorías</h4>
                        <div style="position: relative; width: 100%; max-width: 200px; margin: 0 auto;">
                            <canvas id="graficaCategorias"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PESTAÑA 3: INVENTARIO GLOBAL -->
            <div id="inventario" class="tab-content">
                @if($productos->isEmpty())
                    <div style="background-color: #09090b; border: 1px dashed #27272a; border-radius: 1rem; padding: 3.5rem; text-align: center; color: #71717a;">
                        <span style="font-size: 2rem; display: block; margin-bottom: 0.5rem;">📦</span>
                        <p style="margin: 0; font-size: 0.9rem; text-transform: uppercase; font-weight: 800;">No hay productos registrados</p>
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
                                                Stock: {{ $producto->stock ?? 0 }} uds
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div style="display: flex; justify-content: space-between; align-items: center; background-color: #121214; padding: 0.75rem 1rem; border-radius: 0.5rem; border: 1px solid #1c1c1e; margin-top: auto;">
                                    <div style="display: flex; flex-direction: column;">
                                        <span style="font-size: 0.65rem; color: #52525b; text-transform: uppercase; font-weight: 800; letter-spacing: 0.02em;">Precio Unitario</span>
                                        <span style="font-weight: 900; color: #25d366; font-size: 1.05rem;">${{ number_format($producto->precio, 0, ',', '.') }}</span>
                                    </div>

                                    <div style="display: flex; gap: 0.35rem; align-items: center;">
                                        <a href="{{ route('productos.edit', $producto->id) }}" class="btn-action-dark">Editar</a>
                                        <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" onsubmit="return confirm('¿Eliminar producto?')" style="margin: 0;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-danger-outline" style="padding: 0.45rem 0.75rem; font-size: 0.75rem;">Borrar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- PESTAÑA 4: PEDIDOS DEL SISTEMA -->
            <div id="pedidos" class="tab-content">
                @if(isset($pedidos) && !$pedidos->isEmpty())
                    <div style="background-color: #09090b; border: 1px solid #1c1c1e; border-radius: 0.75rem; overflow: hidden;">
                        <table class="table-nowstyle" style="width: 100%; border-collapse: collapse; text-align: left;">
                            <thead>
                                <tr>
                                    <th>ID Pedido</th>
                                    <th>Usuario</th>
                                    <th>Método Pago</th>
                                    <th>Total Pago</th>
                                    <th>Estado</th>
                                    <th style="text-align: center;">Acción</th>
                                </tr>
                            </thead>
                            <tbody style="font-size: 0.85rem;">
                                @foreach($pedidos as $pedido)
                                    <tr>
                                        <td style="font-weight: bold;">#{{ $pedido->id }}</td>
                                        <td>{{ $pedido->user->name ?? 'Usuario General' }}</td>
                                        <td style="text-transform: uppercase; color: #a1a1aa;">{{ $pedido->metodo_pago }}</td>
                                        <td style="color: #25d366; font-weight: bold;">${{ number_format($pedido->total, 0, ',', '.') }}</td>
                                        <td>
                                            <span style="background-color: #121214; border: 1px solid #27272a; padding: 0.25rem 0.5rem; border-radius: 0.25rem; font-size: 0.7rem; font-weight: bold; text-transform: uppercase;">
                                                {{ $pedido->estado ?? 'Pendiente' }}
                                            </span>
                                        </td>
                                        <td style="text-align: center;">
                                            <form action="{{ route('pedidos.updateEstado', $pedido->id) }}" method="POST" style="margin: 0; display: inline-flex; gap: 0.4rem;">
                                                @csrf
                                                @method('PATCH')
                                                <select name="estado">
                                                    <option value="pendiente" {{ $pedido->estado == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                                                    <option value="completado" {{ $pedido->estado == 'completado' ? 'selected' : '' }}>Completado</option>
                                                </select>
                                                <button type="submit" class="btn-action-dark">OK</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div style="background-color: #09090b; border: 1px dashed #27272a; border-radius: 1rem; padding: 3.5rem; text-align: center; color: #71717a;">
                        <span style="font-size: 2rem; display: block; margin-bottom: 0.5rem;">📦</span>
                        <p style="margin: 0; font-size: 0.9rem; text-transform: uppercase; font-weight: 800;">No hay pedidos registrados</p>
                    </div>
                @endif
            </div>

        </div>
    </div>

    <div id="notification-container"></div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        function switchTab(event, tabId) {
            if(event) event.preventDefault();
            document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));
            document.querySelectorAll('.tab-button').forEach(button => button.classList.remove('active'));
            
            const targetContent = document.getElementById(tabId);
            if(targetContent) targetContent.classList.add('active');
            if(event && event.currentTarget) event.currentTarget.classList.add('active');
        }

        function mostrarNotificacion(mensaje, tipo = 'success') {
            const container = document.getElementById('notification-container');
            if(!container) return;

            const div = document.createElement('div');
            div.className = `notification ${tipo}`;
            div.innerHTML = `<span style="font-size: 1.2rem;">${tipo === 'success' ? '🚀' : '🚨'}</span> <div>${mensaje}</div>`;
            container.appendChild(div);

            setTimeout(() => {
                div.style.transition = "all 0.3s ease";
                div.style.transform = "translateX(120%)";
                div.style.opacity = "0";
                setTimeout(() => div.remove(), 300);
            }, 6000);
        }

        document.addEventListener("DOMContentLoaded", function() {
            const etiquetas = {!! json_encode(array_keys($cantidadesCategorias ?? [])) !!};
            const datos = {!! json_encode(array_values($cantidadesCategorias ?? [])) !!};
            const canvasElement = document.getElementById('graficaCategorias');

            if(canvasElement && etiquetas.length > 0) {
                const ctx = canvasElement.getContext('2d');
                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: etiquetas,
                        datasets: [{
                            data: datos,
                            backgroundColor: ['#dc2626', '#25d366', '#3b82f6', '#a855f7', '#eab308'],
                            borderColor: '#09090b',
                            borderWidth: 4
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: { legend: { position: 'bottom', labels: { color: '#71717a', font: { size: 10 } } } },
                        cutout: '75%'
                    }
                });
            }

            // --- CORRECCIÓN DE LA CONDICIÓN DE STOCK CRÍTICO (<= 10) ---
            @if(isset($productos))
                @foreach($productos as $producto)
                    @if(isset($producto->stock) && $producto->stock <= 10)
                        mostrarNotificacion("<strong>ALERTA DE STOCK CRÍTICO:</strong> El artículo '{{ $producto->nombre }}' está por agotarse. Quedan solo <strong>{{ $producto->stock }}</strong> unidades.", "error");
                    @endif
                @endforeach
            @endif
        });
    </script>
</x-app-layout>