<x-app-layout>
    <style>
        #edit-product-container h1, 
        #edit-product-container label {
            color: #ffffff !important;
            font-family: sans-serif;
        }
        #edit-product-container input[type="text"],
        #edit-product-container input[type="number"],
        #edit-product-container textarea {
            width: 100%;
            padding: 0.75rem 1rem;
            border-radius: 0.75rem;
            background-color: #000000;
            border: 1px solid #27272a;
            color: #ffffff;
            font-size: 0.875rem;
            box-sizing: border-box;
            outline: none;
        }
    </style>

    <div id="edit-product-container" style="background-color: #000000; min-height: 100vh; width: 100%; display: flex; flex-direction: column; font-family: sans-serif; box-sizing: border-box; padding-bottom: 4rem;">
        
        <div style="background-color: #09090b; border-bottom: 1px solid #27272a; padding: 1.5rem 2rem;">
            <div style="max-width: 600px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center;">
                <h1 style="font-weight: 900; font-size: 1.5rem; text-transform: uppercase; color: #ffffff; margin: 0; tracking: 0.05em;">
                    Editar Producto
                </h1>
                <a href="{{ route('productos.index') }}" style="color: #a1a1aa; text-decoration: none; font-size: 0.85rem; font-weight: bold; text-transform: uppercase;" onmouseover="this.style.color='#dc2626'" onmouseout="this.style.color='#a1a1aa'">
                    &larr; Cancelar
                </a>
            </div>
        </div>

        <div style="max-width: 600px; width: 100%; margin: 2rem auto 0 auto; padding: 0 2rem; box-sizing: border-box;">
            
            <form action="{{ route('productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data" style="background-color: #09090b; border: 1px solid #27272a; border-radius: 1rem; padding: 2.5rem; display: flex; flex-direction: column; gap: 1.5rem; box-shadow: 0 10px 30px -15px rgba(220, 38, 38, 0.15); margin: 0;">
                
                @csrf
                @method('PUT') <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                    <label style="font-size: 12px; font-weight: bold; text-transform: uppercase;">Nombre</label>
                    <input type="text" name="nombre" value="{{ $producto->nombre }}">
                </div>

                <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                    <label style="font-size: 12px; font-weight: bold; text-transform: uppercase;">Descripción</label>
                    <textarea name="descripcion" rows="4" style="resize: vertical;">{{ $producto->descripcion }}</textarea>
                </div>

                <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                    <label style="font-size: 12px; font-weight: bold; text-transform: uppercase;">Precio (COP $)</label>
                    <input type="number" name="precio" value="{{ $producto->precio }}" min="0">
                </div>

                <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                    <label style="font-size: 12px; font-weight: bold; text-transform: uppercase;">Stock</label>
                    <input type="number" name="stock" value="{{ $producto->stock }}" min="0">
                </div>

                <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                    <label style="font-size: 12px; font-weight: bold; text-transform: uppercase;">Talla</label>
                    <input type="text" name="talla" value="{{ $producto->talla }}">
                </div>

                <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                    <label style="font-size: 12px; font-weight: bold; text-transform: uppercase;">Categoría</label>
                    <input type="text" name="categoria" value="{{ $producto->categoria }}">
                </div>

                <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                    <label style="font-size: 12px; font-weight: bold; text-transform: uppercase;">Cambiar Foto (Opcional)</label>
                    <div style="background-color: #000000; border: 1px dashed #27272a; border-radius: 0.75rem; padding: 1rem;">
                        <input type="file" name="imagen" accept="image/*" style="color: #a1a1aa; font-size: 0.85rem; cursor: pointer;">
                    </div>
                </div>

                <button type="submit" style="width: 100%; margin-top: 1rem; background-color: #dc2626; color: #ffffff; padding: 0.9rem; border: none; border-radius: 0.75rem; font-weight: bold; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.1em; cursor: pointer;" onmouseover="this.style.backgroundColor='#b91c1c'" onmouseout="this.style.backgroundColor='#dc2626'">
                    Actualizar Cambios
                </button>

            </form>
        </div>
    </div>
</x-app-layout>