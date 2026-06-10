<x-app-layout>
    <style>
        #gerente-container th, #gerente-container td {
            color: #ffffff !important;
            font-family: sans-serif;
        }
        #gerente-container select {
            background-color: #000000;
            border: 1px solid #27272a;
            color: #ffffff;
            padding: 0.5rem;
            border-radius: 0.5rem;
            outline: none;
        }
    </style>

    <div id="gerente-container" style="background-color: #000000; min-height: 100vh; width: 100%; display: flex; flex-direction: column; font-family: sans-serif; box-sizing: border-box; padding-bottom: 4rem;">
        
        <div style="background-color: #09090b; border-bottom: 1px solid #27272a; padding: 1.5rem 2rem;">
            <div style="max-width: 1280px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                <h2 style="font-weight: 900; font-size: 1.5rem; text-transform: uppercase; color: #ffffff; margin: 0; tracking: 0.05em;">
                    Inicio - Panel Gerente
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

        <div style="max-width: 1280px; width: 100%; margin: 2rem auto 0 auto; padding: 0 2rem; box-sizing: border-box; display: flex; flex-direction: column; gap: 2.5rem;">
            
            <div style="background-color: #09090b; border: 1px solid #27272a; border-radius: 1rem; box-shadow: 0 10px 30px -15px rgba(220, 38, 38, 0.3); overflow: hidden;">
                <div style="padding: 2rem; color: #ffffff; font-size: 1rem; font-weight: 600;">
                    {{ __("Has iniciado sesion señor Gerente") }}
                </div>
            </div>

            <div>
                <h3 style="color: #ffffff; font-size: 1.2rem; font-weight: 800; text-transform: uppercase; margin: 0 0 1rem 0; border-left: 4px solid #dc2626; padding-left: 0.5rem; tracking: 0.05em;">
                    Control de Roles y Personal
                </h3>
                
                <div style="background-color: #09090b; border: 1px solid #27272a; border-radius: 1rem; padding: 1.5rem; overflow-x: auto;">
                    <table style="width: 100%; border-collapse: collapse; text-align: left; min-width: 600px;">
                        <thead>
                            <tr style="border-bottom: 2px solid #27272a;">
                                <th style="padding: 1rem; font-size: 0.85rem; text-transform: uppercase; color: #a1a1aa;">Usuario</th>
                                <th style="padding: 1rem; font-size: 0.85rem; text-transform: uppercase; color: #a1a1aa;">Correo</th>
                                <th style="padding: 1rem; font-size: 0.85rem; text-transform: uppercase; color: #a1a1aa;">Rol Actual</th>
                                <th style="padding: 1rem; font-size: 0.85rem; text-transform: uppercase; color: #a1a1aa; text-align: center;">Asignar Nuevo Rol</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($usuarios as $usuario)
                            <tr style="border-bottom: 1px solid #18181b;">
                                <td style="padding: 1rem; font-weight: bold;">{{ $usuario->name }}</td>
                                <td style="padding: 1rem; color: #a1a1aa;">{{ $usuario->email }}</td>
                                <td style="padding: 1rem;">
                                    <span style="background-color: #1c1917; color: #dc2626; padding: 0.3rem 0.75rem; border-radius: 2rem; font-size: 0.75rem; font-weight: bold; text-transform: uppercase; border: 1px solid #27272a;">
                                        {{ $usuario->rol }}
                                    </span>
                                </td>
                                <td style="padding: 1rem; text-align: center;">
                                    <form action="{{ route('usuarios.updateRol', $usuario->id) }}" method="POST" style="margin: 0; display: inline-flex; gap: 0.5rem; align-items: center;">
                                        @csrf
                                        @method('PATCH')
                                        
                                        <select name="rol">
                                            <option value="cliente" {{ $usuario->rol == 'cliente' ? 'selected' : '' }}>Cliente</option>
                                            <option value="empleado" {{ $usuario->rol == 'empleado' ? 'selected' : '' }}>Empleado</option>
                                            <option value="gerente" {{ $usuario->rol == 'gerente' ? 'selected' : '' }}>Gerente</option>
                                        </select>

                                        <button type="submit" style="background-color: #27272a; color: white; border: 1px solid #3f3f46; padding: 0.5rem 0.75rem; border-radius: 0.5rem; font-weight: bold; cursor: pointer; font-size: 0.75rem; text-transform: uppercase;">
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

            <div>
                <h3 style="color: #ffffff; font-size: 1.2rem; font-weight: 800; text-transform: uppercase; margin: 0 0 1rem 0; border-left: 4px solid #dc2626; padding-left: 0.5rem; tracking: 0.05em;">
                    Inventario Global de Prendas
                </h3>

                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.5rem;">
                    @foreach($productos as $producto)
                        <div style="background-color: #09090b; border: 1px solid #27272a; border-radius: 1rem; padding: 1.5rem; display: flex; flex-direction: column; justify-content: space-between; position: relative; overflow: hidden;">
                            
                            <div style="position: absolute; top: 0; left: 0; width: 4px; height: 100%; background-color: #dc2626;"></div>

                            <div style="background-color: #000000; height: 160px; border-radius: 0.75rem; border: 1px solid #18181b; display: flex; align-items: center; justify-content: center; margin-bottom: 1rem; overflow: hidden;">
                                @if($producto->imagen)
                                    <img src="{{ asset('storage/' . $producto->imagen) }}" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                                @else
                                    <span style="color: #4b5563; font-size: 0.8rem; font-weight: bold; text-transform: uppercase;">Sin Foto</span>
                                @endif
                            </div>

                            <div>
                                <h4 style="color: #ffffff; font-size: 1.25rem; font-weight: 800; margin: 0 0 0.5rem 0; text-transform: uppercase;">
                                    {{ $producto->nombre }}
                                </h4>
                                <p style="font-size: 0.85rem; line-height: 1.4; color: #a1a1aa; margin: 0 0 1.5rem 0; min-height: 2.8rem;">
                                    {{ $producto->descripcion }}
                                </p>
                            </div>

                            <div style="border-top: 1px solid #18181b; padding-top: 1rem; display: flex; justify-content: space-between; align-items: center;">
                                <span style="color: #ffffff; font-size: 1.3rem; font-weight: 900;">
                                    COP ${{ number_format($producto->precio, 0, ',', '.') }}
                                </span>
                                <span style="color: #a1a1aa; font-size: 0.75rem; font-weight: bold; text-transform: uppercase; background-color: #18181b; padding: 0.35rem 0.75rem; border-radius: 2rem; border: 1px solid #27272a;">
                                    Stock: {{ $producto->stock }}
                                </span>
                            </div>

                            <div style="display: flex; gap: 0.5rem; margin-top: 1.25rem; padding-top: 1rem; border-top: 1px dashed #27272a;">
                                <a href="{{ route('productos.edit', $producto->id) }}" style="flex: 1; text-align: center; background-color: #27272a; color: #ffffff; padding: 0.6rem; border-radius: 0.5rem; font-weight: bold; font-size: 0.8rem; text-decoration: none; text-transform: uppercase;">
                                    Editar
                                </a>

                                <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" style="margin: 0; flex: 1;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" style="width: 100%; background-color: #dc2626; color: #ffffff; padding: 0.6rem; border-radius: 0.5rem; font-weight: bold; font-size: 0.8rem; border: none; cursor: pointer; text-transform: uppercase;">
                                        Eliminar
                                    </button>
                                </form>
                            </div>

                        </div>
                    @endforeach
                </div>

                @if($productos->isEmpty())
                    <div style="text-align: center; padding: 4rem 2rem; border: 1px dashed #27272a; border-radius: 1rem; background-color: #09090b; margin-top: 1rem;">
                        <p style="color: #71717a; margin: 0; font-size: 0.95rem;">No hay productos registrados.</p>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>