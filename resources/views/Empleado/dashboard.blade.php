<x-app-layout>
    <div style="background-color: #000000; min-height: 100vh; width: 100%; font-family: sans-serif; box-sizing: border-box; padding: 2rem; color: white;">
        
        <div style="max-width: 1280px; margin: 0 auto 2rem auto; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #27272a; padding-bottom: 1rem; flex-wrap: wrap; gap: 1rem;">
            <div>
                <span style="background-color: #dc2626; color: white; font-size: 0.7rem; font-weight: 900; padding: 0.3rem 0.6rem; border-radius: 0.25rem; text-transform: uppercase;">Estación de Control NowStyle</span>
                <h2 style="font-weight: 900; font-size: 1.8rem; text-transform: uppercase; margin: 0.5rem 0 0 0;">
                    🛠️ Panel General del <span style="color: #dc2626;">Empleado</span>
                </h2>
            </div>
            <a href="/usuario" style="background-color: #27272a; color: white; border: 1px solid #3f3f46; padding: 0.6rem 1.25rem; border-radius: 0.5rem; font-weight: bold; text-decoration: none; font-size: 0.85rem; text-transform: uppercase;">🛒 Ir a la Tienda</a>
        </div>

        <div style="max-width: 1280px; margin: 0 auto; display: flex; flex-direction: column; gap: 3rem;">
            
            @if(session('success'))
                <div style="background-color: #16a34a; color: white; padding: 1rem; border-radius: 0.5rem; font-weight: bold; text-transform: uppercase; font-size: 0.85rem;">
                    {{ session('success') }}
                </div>
            @endif

            <div>
                <div style="display: flex; align-items: center; gap: 0.5rem; margin-bottom: 1rem;">
                    <span style="font-size: 1.3rem;">⚡</span>
                    <h3 style="text-transform: uppercase; font-size: 1.2rem; font-weight: 900; color: #ffffff; margin: 0;">Cola de Estampados Personalizados</h3>
                </div>

                @if($pedidos->isEmpty())
                    <div style="background-color: #09090b; border: 1px dashed #27272a; border-radius: 1rem; padding: 3rem; text-align: center; color: #71717a;">
                        <p style="margin: 0; font-size: 0.95rem; uppercase; font-weight: bold;">😎 ¡No hay diseños pendientes por estampar!</p>
                    </div>
                @else
                    <div style="background-color: #09090b; border: 1px solid #27272a; border-radius: 1rem; overflow: hidden;">
                        <table style="width: 100%; border-collapse: collapse; text-align: left;">
                            <thead>
                                <tr style="background-color: #18181b; border-bottom: 1px solid #27272a; text-transform: uppercase; font-size: 0.75rem; color: #a1a1aa;">
                                    <th style="padding: 1rem 1.5rem;">Orden</th>
                                    <th style="padding: 1rem 1.5rem;">Cliente</th>
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
<div style="margin-top: 3rem;">
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
            <p style="margin: 0; font-size: 0.95rem; uppercase; font-weight: bold;">📦 No hay productos en el catálogo comercial.</p>
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
</x-app-layout>