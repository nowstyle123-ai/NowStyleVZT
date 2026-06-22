<x-app-layout>
    <style>
        #edit-product-container h1, 
        #edit-product-container label {
            color: #ffffff !important;
            font-family: sans-serif;
        }
        #edit-product-container input[type="text"],
        #edit-product-container input[type="number"],
        #edit-product-container select,
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
            transition: all 0.2s ease;
        }
        #edit-product-container input:focus, 
        #edit-product-container select:focus, 
        #edit-product-container textarea:focus {
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
        .talla-item input[type="radio"] {
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
        .talla-item input[type="radio"]:checked + .talla-btn {
            background-color: #dc2626;
            border-color: #dc2626;
            box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
        }
        .talla-btn:hover {
            border-color: #52525b;
            background-color: #121214;
        }
    </style>

    <div id="edit-product-container" style="background-color: #000000; min-height: 100vh; width: 100%; display: flex; flex-direction: column; font-family: sans-serif; box-sizing: border-box; padding-bottom: 4rem;">
        
        <!-- Encabezado con Cancelar estilizado -->
        <div style="background-color: #09090b; border-bottom: 1px solid #27272a; padding: 1.5rem 2rem;">
            <div style="max-width: 600px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center;">
                <h1 style="font-weight: 900; font-size: 1.5rem; text-transform: uppercase; color: #ffffff; margin: 0; tracking: 0.05em;">
                    Editar Producto
                </h1>
                <a href="{{ route('productos.index') }}" style="color: #a1a1aa; text-decoration: none; font-size: 0.85rem; font-weight: bold; text-transform: uppercase; letter-spacing: 0.05em; border: 1px solid #27272a; padding: 0.5rem 1rem; border-radius: 0.5rem; transition: all 0.2s;" onmouseover="this.style.color='#ffffff'; this.style.backgroundColor='#18181b'" onmouseout="this.style.color='#a1a1aa'; this.style.backgroundColor='transparent'">
                    &larr; Cancelar
                </a>
            </div>
        </div>

        <!-- Cuerpo del Formulario -->
        <div style="max-width: 600px; width: 100%; margin: 2rem auto 0 auto; padding: 0 2rem; box-sizing: border-box;">
            
            <form action="{{ route('productos.update', $producto->id) }}" method="POST" enctype="multipart/form-data" style="background-color: #09090b; border: 1px solid #27272a; border-radius: 1rem; padding: 2.5rem; display: flex; flex-direction: column; gap: 1.5rem; box-shadow: 0 10px 30px -15px rgba(220, 38, 38, 0.15); margin: 0;">
                
                @csrf
                @method('PUT')

                <!-- 📟 CÓDIGO DE BARRAS (Para edición o corrección rápida) -->
                <div style="background-color: rgba(220, 38, 38, 0.03); border: 1px dashed rgba(220, 38, 38, 0.3); padding: 1.25rem; border-radius: 0.75rem; display: flex; flex-direction: column; gap: 0.5rem;">
                    <label style="font-size: 12px; font-weight: bold; text-transform: uppercase; color: #ef4444 !important; display: flex; align-items: center; gap: 0.3rem;">
                        📟 Código de Barras Real (SKU)
                    </label>
                    <input type="text" name="codigo_barras" id="codigo_barras" value="{{ old('codigo_barras', $producto->codigo_barras) }}" style="background-color: #121214; font-family: monospace; font-size: 1rem; font-weight: bold; letter-spacing: 0.05em;" placeholder="Escanea para cambiar el código de barras...">
                </div>

                <!-- Nombre -->
                <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                    <label style="font-size: 12px; font-weight: bold; text-transform: uppercase;">Nombre del Producto</label>
                    <input type="text" name="nombre" value="{{ old('nombre', $producto->nombre) }}" required>
                </div>

                <!-- Categoría Predefinida (Con detección automática de la actual) -->
                <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                    <label style="font-size: 12px; font-weight: bold; text-transform: uppercase;">Categoría de Prenda</label>
                    <select name="categoria" required>
                        <option value="" disabled style="color: #71717a;">Selecciona una categoría...</option>
                        <option value="camisas" {{ old('categoria', $producto->categoria) == 'camisas' ? 'selected' : '' }}>👕 Camisas / Camisetas</option>
                        <option value="pantalones" {{ old('categoria', $producto->categoria) == 'pantalones' ? 'selected' : '' }}>👖 Pantalones</option>
                        <option value="pantalonetas" {{ old('categoria', $producto->categoria) == 'pantalonetas' ? 'selected' : '' }}>🩳 Pantalonetas</option>
                        <option value="buzos" {{ old('categoria', $producto->categoria) == 'buzos' ? 'selected' : '' }}>🧥 Buzos / Hoodies</option>
                    </select>
                </div>

                <!-- Distribución en fila para Precio y Stock -->
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                        <label style="font-size: 12px; font-weight: bold; text-transform: uppercase;">Precio (COP $)</label>
                        <input type="number" name="precio" value="{{ old('precio', $producto->precio) }}" min="0" required>
                    </div>

                    <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                        <label style="font-size: 12px; font-weight: bold; text-transform: uppercase;">Stock Actual</label>
                        <input type="number" name="stock" value="{{ old('stock', $producto->stock) }}" min="0" required>
                    </div>
                </div>

                <!-- Talla (Botones visuales - Muestra marcada la talla que ya tiene el producto) -->
                <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                    <label style="font-size: 12px; font-weight: bold; text-transform: uppercase;">Talla Comercial</label>
                    <div class="tallas-grid">
                        @foreach(['XS', 'S', 'M', 'L', 'XL', 'ÚNICA'] as $talla)
                            <div class="talla-item">
                                <input type="radio" name="talla" id="talla-{{ $talla }}" value="{{ $talla }}" {{ old('talla', $producto->talla) == $talla ? 'checked' : '' }}>
                                <label for="talla-{{ $talla }}" class="talla-btn">{{ $talla }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Descripción -->
                <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                    <label style="font-size: 12px; font-weight: bold; text-transform: uppercase;">Descripción / Notas de Estampado</label>
                    <textarea name="descripcion" rows="4" style="resize: vertical;" placeholder="Detalles del estampado...">{{ old('descripcion', $producto->descripcion) }}</textarea>
                </div>

                <!-- Subir Foto Estilizado -->
                <div style="display: flex; flex-direction: column; gap: 0.4rem;">
                    <label style="font-size: 12px; font-weight: bold; text-transform: uppercase;">Cambiar Foto (Opcional)</label>
                    <div style="background-color: #000000; border: 1px dashed #27272a; border-radius: 0.75rem; padding: 1.25rem; text-align: center; transition: border-color 0.2s;" onmouseover="this.style.borderColor='#52525b'" onmouseout="this.style.borderColor='#27272a'">
                        <input type="file" name="imagen" accept="image/*" style="color: #a1a1aa; font-size: 0.85rem; cursor: pointer; width: 100%;">
                    </div>
                </div>

                <!-- Botón de Actualizar premium -->
                <button type="submit" style="width: 100%; margin-top: 1rem; background-color: #dc2626; color: #ffffff; padding: 1rem; border: none; border-radius: 0.75rem; font-weight: 900; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.05em; cursor: pointer; transition: all 0.2s; box-shadow: 0 4px 14px rgba(220, 38, 38, 0.3);" onmouseover="this.style.backgroundColor='#ef4444'; this.style.transform='translateY(-1px)'" onmouseout="this.style.backgroundColor='#dc2626'; this.style.transform='none'">
                    ⚡ Actualizar Cambios
                </button>

            </form>
        </div>
    </div>
</x-app-layout>