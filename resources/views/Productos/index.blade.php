<x-app-layout>
    <style>
        #products-container h1, 
        #products-container h2, 
        #products-container h3 {
            color: #ffffff !important;
            font-family: sans-serif;
        }
        #products-container p, 
        #products-container span {
            color: #a1a1aa !important;
            font-family: sans-serif;
        }
    </style>

    <div id="products-container" style="background-color: #000000; min-height: 100vh; width: 100%; display: flex; flex-direction: column; font-family: sans-serif; box-sizing: border-box; padding-bottom: 4rem;">
        
        <div style="background-color: #09090b; border-bottom: 1px solid #27272a; padding: 1.5rem 2rem;">
            <div style="max-width: 1280px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; gap: 1rem; flex-wrap: wrap;">
                
                <h1 style="font-weight: 900; font-size: 1.5rem; text-transform: uppercase; color: #ffffff; margin: 0; tracking: 0.05em;">
                    Lista de Productos
                </h1>

                <a href="{{ route('productos.create') }}" style="background-color: #dc2626; color: #ffffff; padding: 0.7rem 1.25rem; border-radius: 0.75rem; font-weight: bold; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.05em; text-decoration: none; box-shadow: 0 4px 12px rgba(220, 38, 38, 0.2); transition: background 0.2s;" onmouseover="this.style.backgroundColor='#b91c1c'" onmouseout="this.style.backgroundColor='#dc2626'">
                    Crear Producto
                </a>

            </div>
        </div>

        <div style="max-width: 1280px; width: 100%; margin: 2rem auto 0 auto; padding: 0 2rem; box-sizing: border-box;">
            
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.5rem;">
                
                @foreach($productos as $producto)
                    <div style="background-color: #09090b; border: 1px solid #27272a; border-radius: 1rem; padding: 1.5rem; display: flex; flex-direction: column; justify-content: space-between; position: relative; overflow: hidden; box-shadow: 0 10px 25px -15px rgba(0,0,0,0.5); transition: border-color 0.2s;" onmouseover="this.style.borderColor='#dc2626'" onmouseout="this.style.borderColor='#27272a'">
                        
                        <div style="position: absolute; top: 0; left: 0; width: 4px; height: 100%; background-color: #dc2626;"></div>

                        <div style="background-color: #000000; height: 180px; border-radius: 0.75rem; border: 1px solid #18181b; display: flex; align-items: center; justify-content: center; margin-bottom: 1rem; overflow: hidden;">
                            @if($producto->imagen)
                                <img src="{{ asset('storage/' . $producto->imagen) }}" alt="Imagen del producto" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                            @else
                                <span style="color: #4b5563; font-size: 0.8rem; font-weight: bold; text-transform: uppercase;">Sin Foto</span>
                            @endif
                        </div>

                        <div style="padding-left: 0.5rem;">
                            <h3 style="font-size: 1.25rem; font-weight: 800; margin: 0 0 0.5rem 0; text-transform: uppercase; tracking: 0.02em; color: #ffffff;">
                                {{ $producto->nombre }}
                            </h3>

                            <p style="font-size: 0.85rem; line-height: 1.4; color: #a1a1aa; margin: 0 0 1.5rem 0; min-height: 2.8rem;">
                                {{ $producto->descripcion }}
                            </p>
                        </div>

                        <div style="padding-left: 0.5rem; border-top: 1px solid #18181b; padding-top: 1rem; display: flex; flex-direction: column; gap: 0.75rem;">
                            
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span style="font-size: 1.3rem; font-weight: 900; color: #ffffff;">
                                    COP ${{ number_format($producto->precio, 0, ',', '.') }}
                                </span>
                            </div>

                            <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                                <span style="font-size: 0.75rem; font-weight: bold; text-transform: uppercase; background-color: #18181b; padding: 0.35rem 0.75rem; border-radius: 2rem; border: 1px solid #27272a; color: #ffffff;">
                                    Tallas: {{ is_array($producto->tallas) ? implode(', ', $producto->tallas) : $producto->tallas }}
                                </span>

                                <span style="font-size: 0.75rem; font-weight: bold; text-transform: uppercase; background-color: #18181b; padding: 0.35rem 0.75rem; border-radius: 2rem; border: 1px solid #27272a; color: #a1a1aa;">
                                    Stock: {{ $producto->stock }}
                                </span>
                            </div>
                        </div>

                        <div style="display: flex; gap: 0.5rem; margin-top: 1.25rem; padding-top: 1rem; border-top: 1px dashed #27272a;">
                            <a href="{{ route('productos.edit', $producto->id) }}" style="flex: 1; text-align: center; background-color: #27272a; color: #ffffff; padding: 0.6rem; border-radius: 0.5rem; font-weight: bold; font-size: 0.8rem; text-decoration: none; text-transform: uppercase; tracking: 0.05em;" onmouseover="this.style.backgroundColor='#3f3f46'" onmouseout="this.style.backgroundColor='#27272a'">
                                Editar
                            </a>

                            <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" style="margin: 0; flex: 1;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="width: 100%; background-color: #dc2626; color: #ffffff; padding: 0.6rem; border-radius: 0.5rem; font-weight: bold; font-size: 0.8rem; border: none; cursor: pointer; text-transform: uppercase; tracking: 0.05em;" onmouseover="this.style.backgroundColor='#b91c1c'" onmouseout="this.style.backgroundColor='#dc2626'">
                                    Eliminar
                                </button>
                            </form>
                        </div>

                    </div>
                @endforeach

            </div>

            @if($productos->isEmpty())
                <div style="text-align: center; padding: 4rem 2rem; border: 1px dashed #27272a; border-radius: 1rem; background-color: #09090b;">
                    <p style="color: #71717a; margin: 0; font-size: 0.95rem;">No hay productos disponibles en este momento.</p>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>