<x-app-layout>
    <style>
        #create-product-container h1, 
        #create-product-container label {
            color: #ffffff !important;
            font-family: sans-serif;
        }
        #create-product-container input[type="text"],
        #create-product-container input[type="number"],
        #create-product-container select,
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
            transition: all 0.2s ease;
        }
        #create-product-container input:focus, 
        #create-product-container select:focus, 
        #create-product-container textarea:focus {
            border-color: #dc2626 !important;
            box-shadow: 0 0 10px rgba(220, 38, 38, 0.15);
        }

        /* Contenedor de tallas en botones visuales */
        .tallas-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(55px, 1fr));
            gap: 0.5rem;
            margin-top: 0.2rem;
        }
        .talla-item {
            position: relative;
        }
        /* CORRECCIÓN: Ahora apunta a checkbox en lugar de radio */
        .talla-item input[type="checkbox"] {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }
        .talla-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #000000;
            border: 1px solid #27272a;
            color: #ffffff;
            padding: 0.7rem;
            border-radius: 0.5rem;
            font-weight: bold;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.2s ease;
            user-select: none;
        }
        /* CORRECCIÓN: Estilo de activación adaptado para checkboxes seleccionados */
        .talla-item input[type="checkbox"]:checked + .talla-btn {
            background-color: #dc2626;
            border-color: #dc2626;
            box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
        }
        .talla-btn:hover {
            border-color: #52525b;
            background-color: #121214;
        }
    </style>

    <div id="create-product-container" style="background-color: #000000; min-height: 100vh; width: 100%; display: flex; flex-direction: column; font-family: sans-serif; box-sizing: border-box; padding-bottom: 4rem;">
        
        <div style="background-color: #09090b; border-bottom: 1px solid #27272a; padding: 1.5rem 2rem;">
            <div style="max-width: 600px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center;">
                <h1 style="font-weight: 900; font-size: 1.5rem; text-transform: uppercase; color: #ffffff; margin: 0; letter-spacing: 0.05em;">
                    Nuevo Producto
                </h1>
                <a href="{{ url()->previous() }}" style="color: #a1a1aa; text-decoration: none; font-size: 0.85rem; font-weight: bold; text-transform: uppercase; letter-spacing: 0.05em; border: 1px solid #27272a; padding: 0.5rem 1rem; border-radius: 0.5rem; transition: all 0.2s;" onmouseover="this.style.color='#ffffff'; this.style.backgroundColor='#18181b'" onmouseout="this.style.color='#a1a1aa'; this.style.backgroundColor='transparent'">
                    Volver
                </a>
            </div>
        </div>

        <div style="max-width: 600px; width: 100%; margin: 2rem auto 0 auto; padding: 0 2rem; box-sizing: border-box;">
            
            <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data" style="background-color: #09090b; border: 1px solid #27272a; border-radius: 1rem; padding: 2.5rem; display: flex; flex-direction: column; gap: 1.5rem; box-shadow: 0 10px 30px -15px rgba(220, 38, 38, 0.15); margin: 0;">
                
                @csrf

                <div style="background-color: rgba(220, 38, 38, 0.03); border: 1px dashed rgba(220, 38, 38, 0.3); padding: 1.25rem; border-radius: 0.75rem; display: flex; flex-direction: column; gap: 0.5rem;">
                    <label style="font-size: 12px; font-weight: bold; text-transform: uppercase; color: #ef4444 !important; display: flex; align-items: center; gap: 0.3rem;">
                        📟 Código de Barras Real (SKU)
                    </label>
                    <input type="text" name="codigo_barras" id="codigo_barras" style="background-color: #121214; font-family: monospace; font-size: 1rem; font-weight: bold; letter-spacing: 0.05em;" placeholder="Haz clic aquí y pasa el escáner sobre la etiqueta" required autofocus>
                </div>

                <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                    <label style="font-size: 12px; font-weight: bold; text-transform: uppercase;">Nombre del Producto</label>
                    <input type="text" name="nombre" placeholder="Ej. Camiseta Oversize Black" required>
                </div>

                <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                    <label style="font-size: 12px; font-weight: bold; text-transform: uppercase;">Categoría de Prenda</label>
                    <select name="categoria" required>
                        <option value="" disabled selected style="color: #71717a;">Selecciona una categoría...</option>
                        <option value="camisas">👕 Camisas / Camisetas</option>
                        <option value="pantalones">👖 Pantalones</option>
                        <option value="pantalonetas">🩳 Pantalonetas</option>
                        <option value="buzos">🧥 Buzos / Hoodies</option>
                    </select>
                </div>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                        <label style="font-size: 12px; font-weight: bold; text-transform: uppercase;">Precio ($)</label>
                        <input type="number" name="precio" min="0" placeholder="45000" required>
                    </div>

                    <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                        <label style="font-size: 12px; font-weight: bold; text-transform: uppercase;">Stock Inicial</label>
                        <input type="number" name="stock" min="0" value="1" required>
                    </div>
                </div>

                <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                    <label style="font-size: 12px; font-weight: bold; text-transform: uppercase;">Tallas Comerciales Disponibles (Selecciona varias)</label>
                    <div class="tallas-grid">
                        @foreach(['XS', 'S', 'M', 'L', 'XL'] as $talla)
                            <div class="talla-item">
                                <input type="checkbox" name="tallas[]" id="talla-{{ $talla }}" value="{{ $talla }}">
                                <label for="talla-{{ $talla }}" class="talla-btn">{{ $talla }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                    <label style="font-size: 12px; font-weight: bold; text-transform: uppercase;">Descripción / Notas de Estampado</label>
                    <textarea name="descripcion" rows="3" style="resize: vertical;" placeholder="Detalles de composición de tela o espacio máximo para estampar..."></textarea>
                </div>

                <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                    <label style="font-size: 12px; font-weight: bold; text-transform: uppercase;">Fotografía Base de Prenda</label>
                    <div style="background-color: #000000; border: 1px dashed #27272a; border-radius: 0.75rem; padding: 1.25rem; text-align: center; transition: border-color 0.2s;" onmouseover="this.style.borderColor='#52525b'" onmouseout="this.style.borderColor='#27272a'">
                        <input type="file" name="imagen" accept="image/*" style="color: #a1a1aa; font-size: 0.85rem; cursor: pointer; width: 100%;">
                    </div>
                </div>

                <button type="submit" style="width: 100%; margin-top: 1rem; background-color: #dc2626; color: #ffffff; padding: 1rem; border: none; border-radius: 0.75rem; font-weight: 900; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.05em; cursor: pointer; transition: all 0.2s; box-shadow: 0 4px 14px rgba(220, 38, 38, 0.3);" onmouseover="this.style.backgroundColor='#ef4444'; this.style.transform='translateY(-1px)'" onmouseout="this.style.backgroundColor='#dc2626'; this.style.transform='none'">
                    💾 Guardar Producto
                </button>

            </form>
        </div>
    </div>

    <script>
        window.addEventListener('DOMContentLoaded', () => {
            const inputCodigo = document.getElementById('codigo_barras');
            if(inputCodigo) inputCodigo.focus();
        });
    </script>
</x-app-layout>