<x-app-layout>
    <style>
        #create-product-container h1, 
        #create-product-container label {
            color: #ffffff !important;
            font-family: sans-serif;
        }
        #create-product-container input[type="text"],
        #create-product-container input[type="number"],
        #create-product-container textarea {
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

    <div id="create-product-container" style="background-color: #000000; min-height: 100vh; width: 100%; display: flex; flex-direction: column; font-family: sans-serif; box-sizing: border-box; padding-bottom: 4rem;">
        
        <div style="background-color: #09090b; border-bottom: 1px solid #27272a; padding: 1.5rem 2rem;">
            <div style="max-width: 600px; margin: 0 auto;">
                <h1 style="font-weight: 900; font-size: 1.5rem; text-transform: uppercase; color: #ffffff; margin: 0; tracking: 0.05em;">
                    Nuevo Producto
                </h1>
            </div>
        </div>

        <div style="max-width: 600px; width: 100%; margin: 2rem auto 0 auto; padding: 0 2rem; box-sizing: border-box;">
            
            <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data" style="background-color: #09090b; border: 1px solid #27272a; border-radius: 1rem; padding: 2.5rem; display: flex; flex-direction: column; gap: 1.5rem; box-shadow: 0 10px 30px -15px rgba(220, 38, 38, 0.15); margin: 0;">
                
                @csrf

                <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                    <label style="font-size: 12px; font-weight: bold; text-transform: uppercase;">Nombre</label>
                    <input type="text" name="nombre">
                </div>

                <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                    <label style="font-size: 12px; font-weight: bold; text-transform: uppercase;">Descripción</label>
                    <textarea name="descripcion" rows="4" style="resize: vertical;"></textarea>
                </div>

                <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                    <label style="font-size: 12px; font-weight: bold; text-transform: uppercase;">Precio</label>
                    <input type="number" name="precio" min="0">
                </div>

                <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                    <label style="font-size: 12px; font-weight: bold; text-transform: uppercase;">Stock</label>
                    <input type="number" name="stock" min="0">
                </div>

                <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                    <label style="font-size: 12px; font-weight: bold; text-transform: uppercase;">Talla</label>
                    <input type="text" name="talla">
                </div>

                <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                    <label style="font-size: 12px; font-weight: bold; text-transform: uppercase;">Categoría</label>
                    <input type="text" name="categoria">
                </div>

                <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                    <label style="font-size: 12px; font-weight: bold; text-transform: uppercase;">Subir Foto</label>
                    <div style="background-color: #000000; border: 1px dashed #27272a; border-radius: 0.75rem; padding: 1rem;">
                        <input type="file" name="imagen" accept="image/*" style="color: #a1a1aa; font-size: 0.85rem; cursor: pointer;">
                    </div>
                </div>

                <button type="submit" style="width: 100%; margin-top: 1rem; background-color: #dc2626; color: #ffffff; padding: 0.9rem; border: none; border-radius: 0.75rem; font-weight: bold; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.1em; cursor: pointer;" onmouseover="this.style.backgroundColor='#b91c1c'" onmouseout="this.style.backgroundColor='#dc2626'">
                    Guardar Producto
                </button>

            </form>
        </div>
    </div>
</x-app-layout>