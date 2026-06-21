<x-app-layout>
    <style>
        :root {
            --bg-main: #050505;
            --bg-card: #0d0d10;
            --bg-elevated: #15151a;
            --border-soft: #232329;
            --text-muted: #9ca3af;
            --accent: #ef4444;
            --accent-glow: rgba(239, 68, 68, 0.25);
        }

        #pedidos-container {
            background-color: var(--bg-main);
            min-height: 100vh;
            width: 100%;
            display: flex;
            flex-direction: column;
            font-family: 'Inter','Segoe UI', sans-serif;
            padding-bottom: 4rem;
            position: relative;
            z-index: 1;
        }

        #pedidos-container * { box-sizing: border-box; }

        .header-tienda {
            background-color: rgba(9,9,11,0.85); 
            border-bottom: 1px solid var(--border-soft);
            padding: 1.4rem 2rem; 
            position: sticky; 
            top: 0; 
            z-index: 10; 
            backdrop-filter: blur(10px);
        }

        .pedido-card {
            background-color: var(--bg-card);
            border: 1px solid var(--border-soft);
            border-radius: 1rem;
            padding: 2rem;
            display: flex;
            flex-direction: column;
            gap: 2rem;
            transition: border-color 0.2s ease;
        }
        .pedido-card:hover { border-color: var(--accent); }

        .badge-estado {
            display: inline-block;
            padding: 0.35rem 0.9rem;
            border-radius: 2rem;
            font-size: 0.75rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }
        .badge-pendiente { background-color: rgba(239,68,68,0.15); color: var(--accent); border: 1px solid rgba(239,68,68,0.3); }
        .badge-proceso { background-color: rgba(234,179,8,0.15); color: #eab308; border: 1px solid rgba(234,179,8,0.3); }
        .badge-completado { background-color: rgba(34,197,94,0.15); color: #22c55e; border: 1px solid rgba(34,197,94,0.3); }

        .pedido-imagen {
            width: 100%;
            max-width: 180px;
            border-radius: 0.6rem;
            border: 1px solid var(--border-soft);
            object-fit: contain;
            background-color: #000000;
        }

        .pedido-info-grid {
            display: grid;
            grid-template-columns: auto 1fr;
            gap: 2rem;
            align-items: center;
        }

        /* Animación sutil para la barra cuando está procesando */
        @keyframes pulsoGlow {
            0% { opacity: 0.6; }
            50% { opacity: 1; }
            100% { opacity: 0.6; }
        }
        .progreso-activo {
            animation: pulsoGlow 2s infinite ease-in-out;
        }

        @media (max-width: 768px) {
            .pedido-info-grid {
                grid-template-columns: 1fr;
                text-align: center;
            }
            .pedido-imagen {
                margin: 0 auto;
            }
        }

        @media (max-width: 640px) {
            .header-tienda { padding: 1rem 1.25rem; }
        }
    </style>

    <div id="pedidos-container">

        <div class="header-tienda">
            <div style="max-width: 1280px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                <h2 style="font-weight: 900; font-size: 1.6rem; text-transform: uppercase; color: #ffffff; margin: 0; letter-spacing: 0.02em;">
                    NowStyle <span style="color: var(--accent);">Store</span>
                </h2>
                <a href="{{ route('cliente.index') }}" style="background-color: var(--bg-elevated); border: 1px solid var(--border-soft); color: white; padding: 0.7rem 1.3rem; border-radius: 0.7rem; font-weight: 700; text-decoration: none; font-size: 0.85rem;">
                    ← Volver al catálogo
                </a>
            </div>
        </div>

        <div style="max-width: 1280px; width: 100%; margin: 2.5rem auto 0 auto; padding: 0 2rem; display: flex; flex-direction: column; gap: 1.5rem;">

            <h3 style="color: white; margin: 0; font-weight: 800; text-transform: uppercase; font-size: 1.3rem;">📦 Mis Pedidos</h3>

            @if($pedidos->isEmpty())
                <div style="background-color: var(--bg-card); border: 1px solid var(--border-soft); border-radius: 1rem; padding: 3rem 2rem; text-align: center;">
                    <p style="color: var(--text-muted); margin: 0; font-size: 0.95rem;">Aún no tienes pedidos. ¡Ve al catálogo y crea tu primera prenda personalizada!</p>
                </div>
            @else
                <div style="display: flex; flex-direction: column; gap: 2rem;">
                    @foreach($pedidos as $pedido)
                        <div class="pedido-card">
                            
                            <div class="pedido-info-grid">
                                <div>
                                    @if($pedido->imagen_personalizada)
                                        <img src="{{ asset('storage/' . $pedido->imagen_personalizada) }}" alt="Prenda Custom" class="pedido-imagen">
                                    @else
                                        <div class="pedido-imagen" style="height: 180px; display: flex; align-items: center; justify-content: center; color: var(--text-muted); font-size: 0.8rem;">
                                            Sin vista previa
                                        </div>
                                    @endif
                                </div>

                                <div style="display: flex; flex-direction: column; gap: 0.5rem; color: white;">
                                    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 0.5rem;">
                                        <span style="font-size: 1.1rem; font-weight: 800; color: #ffffff;">Pedido #{{ $pedido->id }}</span>
                                        
                                        @if(strtolower($pedido->estado ?? '') == 'pendiente')
                                            <span class="badge-estado badge-pendiente">En Cola</span>
                                        @elseif(strtolower($pedido->estado ?? '') == 'estampando' || strtolower($pedido->estado ?? '') == 'proceso')
                                            <span class="badge-estado badge-proceso">Estampando</span>
                                        @else
                                            <span class="badge-estado badge-completado">Listo</span>
                                        @endif
                                    </div>
                                    
                                    <hr style="border: 0; border-top: 1px solid var(--border-soft); margin: 0.5rem 0;">
                                    
                                    <p style="margin: 0; font-size: 0.95rem; color: var(--text-muted);">
                                        <strong style="color: white;">Prenda:</strong> {{ $pedido->producto->nombre ?? 'Camiseta Personalizada' }}
                                    </p>
                                    <p style="margin: 0; font-size: 0.95rem; color: var(--text-muted);">
                                        <strong style="color: white;">Cantidad:</strong> {{ $pedido->cantidad ?? 1 }} unidades
                                    </p>
                                    <p style="margin: 0; font-size: 1.1rem; font-weight: 700; color: #22c55e; margin-top: 0.5rem;">
                                        Total: ${{ number_format($pedido->total ?? ($pedido->precio * ($pedido->cantidad ?? 1)), 0, ',', '.') }}
                                    </p>
                                </div>
                            </div>

                            <div style="background-color: #050505; border: 1px solid var(--border-soft); border-radius: 0.75rem; padding: 1.5rem;">
                                @php
                                    $estadoActual = strtolower($pedido->estado ?? 'pendiente');
                                    
                                    // Configuración dinámica basada en el estado
                                    if($estadoActual == 'pendiente') {
                                        $porcentaje = 25;
                                        $textoSeguimiento = 'Tu pedido está en fila de espera para producción';
                                        $colorTexto = '#ef4444'; // Rojo
                                        $colorBarra = '#ef4444';
                                    } elseif($estadoActual == 'estampando' || $estadoActual == 'proceso') {
                                        $porcentaje = 65;
                                        $textoSeguimiento = 'Estamos personalizando y estampando tu prenda ahora mismo';
                                        $colorTexto = '#eab308'; // Amarillo
                                        $colorBarra = '#eab308';
                                    } else {
                                        $porcentaje = 100;
                                        $textoSeguimiento = '¡Tu pedido está terminado y listo para retirar!';
                                        $colorTexto = '#22c55e'; // Verde éxito
                                        $colorBarra = '#22c55e';
                                    }
                                @endphp

                                <div style="display: flex; flex-direction: column; gap: 0.8rem;">
                                    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 0.5rem;">
                                        <span style="font-size: 0.8rem; font-weight: 800; text-transform: uppercase; color: #ffffff; letter-spacing: 0.05em;">
                                            Progreso de Fabricación
                                        </span>
                                        <span style="font-size: 0.9rem; font-weight: 700; color: {{ $colorTexto }};">
                                            {{ $textoSeguimiento }}
                                        </span>
                                    </div>

                                    <div style="width: 100%; height: 8px; background-color: #18181b; border-radius: 10px; overflow: hidden; position: relative; border: 1px solid var(--border-soft);">
                                        <div class="{{ $porcentaje < 100 ? 'progreso-activo' : '' }}" 
                                             style="width: {{ $porcentaje }}%; height: 100%; background-color: {{ $colorBarra }}; border-radius: 10px; transition: width 0.6s cubic-bezier(0.4, 0, 0.2, 1); box-shadow: 0 0 12px {{ $colorBarra }}aa;">
                                        </div>
                                    </div>

                                    <div style="display: flex; justify-content: space-between; font-size: 0.7rem; font-weight: 700; text-transform: uppercase; color: #52525b; letter-spacing: 0.02em;">
                                        <span style="{{ $estadoActual == 'pendiente' ? 'color: #ffffff;' : '' }}">Recibido</span>
                                        <span style="{{ ($estadoActual == 'estampando' || $estadoActual == 'proceso') ? 'color: #ffffff;' : '' }}">En Taller</span>
                                        <span style="{{ ($porcentaje == 100) ? 'color: #ffffff;' : '' }}">Entregado</span>
                                    </div>
                                </div>
                            </div>
                            </div>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>