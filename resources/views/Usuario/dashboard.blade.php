<x-app-layout>
    <style>
        :root {
            --bg-main: #000000;
            --bg-card: #09090b;
            --bg-elevated: #15151a;
            --border-soft: #27272a;
            --text-muted: #a1a1aa;
            --accent: #dc2626;
            --accent-glow: rgba(220, 38, 38, 0.25);
        }

        #catalogo-container th, #catalogo-container td {
            color: #ffffff !important;
            font-family: 'Inter', sans-serif;
        }
        
        #catalogo-container * { box-sizing: border-box; }

        .grid-productos {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.5rem;
            padding: 0 2rem;
        }

        .producto-card {
            background-color: var(--bg-card);
            border: 1px solid var(--border-soft);
            border-radius: 1rem;
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: transform 0.25s ease, border-color 0.25s ease, box-shadow 0.25s ease;
        }
        .producto-card:hover {
            transform: translateY(-4px);
            border-color: var(--accent);
            box-shadow: 0 12px 30px -10px var(--accent-glow);
        }
        
        #carrito-sidebar {
            position: fixed; top: 0; right: -400px; width: 380px; height: 100vh;
            background-color: var(--bg-card); border-left: 1px solid var(--border-soft);
            transition: right 0.3s ease; z-index: 9999; padding: 1.5rem; box-sizing: border-box;
            display: flex; flex-direction: column;
            box-shadow: -10px 0 40px rgba(0,0,0,0.6);
        }
        #carrito-sidebar.active { right: 0; }

        /* SIDEBAR DE FILTROS */
        #filtros-sidebar {
            position: fixed; top: 0; left: -320px; width: 300px; height: 100vh;
            background-color: var(--bg-card); border-right: 1px solid var(--border-soft);
            transition: left 0.3s ease; z-index: 9999; padding: 1.5rem; box-sizing: border-box;
            display: flex; flex-direction: column;
            box-shadow: 10px 0 40px rgba(0,0,0,0.6);
        }
        #filtros-sidebar.active { left: 0; }

        .filtro-seccion {
            border-bottom: 1px solid var(--border-soft);
            padding: 1rem 0;
        }
        .filtro-titulo {
            display: flex; justify-content: space-between; align-items: center;
            color: white; font-weight: bold; font-size: 0.95rem; cursor: pointer;
            user-select: none;
        }
        .filtro-contenido {
            margin-top: 0.75rem; display: none; flex-direction: column; gap: 0.6rem;
        }
        .filtro-contenido.open { display: flex; }

        #carrito-items::-webkit-scrollbar { width: 5px; }
        #carrito-items::-webkit-scrollbar-thumb { background: var(--border-soft); border-radius: 10px; }
        #carrito-items::-webkit-scrollbar-thumb:hover { background: var(--accent); }

        #modal-personalizar {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background-color: rgba(0, 0, 0, 0.85);
            display: none; justify-content: center; align-items: center; z-index: 10000;
            padding: 1rem; box-sizing: border-box;
            backdrop-filter: blur(3px);
        }

        .btn-categoria {
            background-color: var(--bg-card); border: 1px solid var(--border-soft); color: var(--text-muted);
            padding: 0.5rem 1.2rem; border-radius: 2rem; cursor: pointer; font-weight: bold; font-size: 0.85rem; text-transform: uppercase;
            transition: all 0.2s ease;
        }
        .btn-categoria.active, .btn-categoria:hover {
            background-color: var(--accent); color: white; border-color: var(--accent);
        }

        .input-glow {
            background-color: #000000 !important; border: 1px solid var(--border-soft); color: #ffffff !important;
            padding: 0.75rem; border-radius: 0.5rem; width: 100%; font-size: 0.95rem;
            transition: border-color 0.2s ease;
        }
        .input-glow:focus { outline: none; border-color: var(--accent); }

        /* FORZADO DE COLORES PARA LOS MENÚS DESPLEGABLES */
        select, select option, .input-glow, .input-glow option, #ordenar-select option, #selector-envio option, #custom-ubicacion option {
            background-color: #09090b !important;
            color: #ffffff !important;
        }

        .btn-qty {
            background-color: #27272a; color: white; border: none;
            width: 28px; height: 28px; border-radius: 0.25rem;
            font-weight: bold; cursor: pointer; display: flex;
            align-items: center; justify-content: center; transition: background 0.2s;
        }
        .btn-qty:hover { background-color: var(--accent); }

        .btn-delete-cart {
            background-color: transparent; color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.2);
            width: 28px; height: 28px; border-radius: 0.25rem; cursor: pointer;
            display: flex; align-items: center; justify-content: center; transition: all 0.2s;
        }
        .btn-delete-cart:hover { background-color: #ef4444; color: white; border-color: #ef4444; }

        .preview-badge-container {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(100px, 1fr)); gap: 0.5rem; margin-top: 0.5rem;
        }
        .preview-box {
            background: #000; border: 1px solid var(--border-soft); border-radius: 0.5rem; padding: 0.5rem; text-align: center; position: relative;
        }
        .preview-box img { max-width: 100%; height: 60px; object-fit: contain; border-radius: 0.25rem; }
        .btn-remove-img { background: var(--accent); color: white; border: none; font-size: 0.7rem; cursor: pointer; border-radius: 0.25rem; padding: 0.2rem 0.4rem; margin-top: 0.25rem; display: inline-block; }
    </style>

    <div id="catalogo-container" style="background-color: var(--bg-main); min-height: 100vh; width: 100%; display: flex; flex-direction: column; font-family: sans-serif; padding-bottom: 4rem;">
        
        <div style="background-color: var(--bg-card); border-bottom: 1px solid var(--border-soft); padding: 1.5rem 2rem; margin-bottom: 2rem;">
            <div style="max-width: 1280px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
                <h2 style="font-weight: 900; font-size: 1.5rem; text-transform: uppercase; color: #ffffff; margin: 0;">
                    NowStyle <span style="color: var(--accent);">Store</span>
                </h2>
                <div style="display: flex; gap: 0.75rem; align-items: center; flex-wrap: wrap;">
                    <button onclick="toggleCarrito()" style="background-color: #000000; border: 1px solid var(--border-soft); color: white; padding: 0.7rem 1.25rem; border-radius: 0.75rem; font-weight: bold; cursor: pointer;">
                        🛒 Carrito (<span id="carrito-contador" style="color: var(--accent);">0</span>)
                    </button>
                    <a href="{{ route('pedido.index') }}" style="background-color: var(--bg-elevated); border: 1px solid var(--border-soft); color: #ffffff; padding: 0.7rem 1.25rem; border-radius: 0.75rem; font-weight: bold; text-decoration: none; font-size: 0.8rem; display: inline-flex; align-items: center;">
                        📦 MIS PEDIDOS
                    </a>
                    @if(auth()->user()->rol === 'empleado')
                        <a href="{{ route('empleado.index') }}" style="background-color: #27272a; border: 1px solid #3f3f46; color: #ffffff; padding: 0.7rem 1.25rem; border-radius: 0.75rem; font-weight: bold; text-decoration: none; font-size: 0.8rem;">⚙️ PANEL</a>
                    @elseif(auth()->user()->rol === 'gerente')
                        <a href="{{ route('gerente.index') }}" style="background-color: #27272a; border: 1px solid #3f3f46; color: #ffffff; padding: 0.7rem 1.25rem; border-radius: 0.75rem; font-weight: bold; text-decoration: none; font-size: 0.8rem;">⚙️ PANEL</a>
                    @endif
                </div>
            </div>
        </div>

        <div style="padding: 0 2rem; margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid var(--border-soft); padding-bottom: 1rem;">
            <button onclick="toggleFiltros(true)" style="background: none; border: none; color: #ffffff; display: flex; align-items: center; gap: 0.6rem; cursor: pointer; font-family: 'Inter', sans-serif; font-size: 0.95rem; font-weight: bold; text-transform: uppercase; letter-spacing: 0.05em;">
                <span style="font-size: 1.1rem; color: var(--accent);">⌥</span> Mostrar Filtros
            </button>

            <div style="display: flex; align-items: center; gap: 1.5rem;">
                <span style="color: var(--text-muted); font-size: 0.9rem;">
                    <strong id="contador-productos" style="color: #ffffff;">{{ $productos->count() }}</strong> Productos
                </span>
                
                <div style="display: flex; align-items: center; gap: 0.5rem;">
                    <label style="color: var(--text-muted); font-size: 0.85rem; font-weight: bold; text-transform: uppercase;">Ordenar por:</label>
                    <select id="ordenar-select" onchange="ordenarProductos()" style="background-color: var(--bg-card); border: 1px solid var(--border-soft); color: white; padding: 0.4rem 1rem; border-radius: 0.5rem; font-size: 0.85rem; font-weight: bold; cursor: pointer; outline: none; border-color: rgba(220, 38, 38, 0.3);">
                        <option value="predeterminado">Predeterminado</option>
                        <option value="menor-precio">Menor Precio</option>
                        <option value="mayor-precio">Mayor Precio</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="grid-productos">
            @foreach($productos as $producto)
                <div class="producto-card" data-categoria="{{ $producto->categoria }}">
                    <div style="background-color: #000000; height: 180px; border-radius: 0.75rem; border: 1px solid #18181b; display: flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                        @if($producto->imagen)
                            <img src="{{ asset('storage/' . $producto->imagen) }}" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                        @else
                            <span style="color: #4b5563; font-size: 0.8rem; font-weight: bold;">SIN FOTO</span>
                        @endif
                    </div>
                    <div>
                        <h4 style="color: #ffffff; font-size: 1.15rem; font-weight: 800; margin: 0 0 0.5rem 0; text-transform: uppercase;">{{ $producto->nombre }}</h4>
                        <p style="font-size: 0.85rem; color: var(--text-muted); margin: 0 0 1rem 0; min-height: 2.5rem;">{{ $producto->descripcion }}</p>
                    </div>

                    <div style="margin-bottom: 1rem;">
                        <label style="color: var(--text-muted); font-size: 0.75rem; font-weight: bold; display: block; margin-bottom: 0.4rem;">TALLA DISPONIBLE:</label>
<select id="talla-{{ $producto->id }}" class="input-glow" style="padding: 0.4rem; font-size: 0.8rem; font-weight: bold; text-transform: uppercase; border-color: rgba(220, 38, 38, 0.4);" required>
    @php
        // 1. Forzamos la lectura del texto puro de la base de datos
        $tallaPura = $producto->getRawOriginal('talla') ?? $producto->getRawOriginal('tallas') ?? '';

        // 2. Limpieza total: Quitamos comillas dobles, comillas simples, corchetes y espacios extras
        $tallaLimpia = str_replace(['"', "'", '[', ']', ' '], '', $tallaPura);

        // 3. Convertimos en array usando el separador de guiones
        $tallasArray = !empty($tallaLimpia) ? explode('-', $tallaLimpia) : [];
    @endphp

    @if(count($tallasArray) > 0)
        {{-- Al NO poner la opción "Talla..." estática, el select mostrará de una vez la primera opción del array --}}
        @foreach($tallasArray as $tallaIndividual)
            @if(trim($tallaIndividual) !== '')
                <option value="{{ trim($tallaIndividual) }}">{{ trim($tallaIndividual) }}</option>
            @endif
        @endforeach
    @else
        <option value="" disabled selected>Sin tallas</option>
    @endif
</select>
                    </div>

                    @if($producto->stock <= 10)
                        <div style="margin-bottom: 1rem; background-color: rgba(234, 179, 8, 0.1); border: 1px solid rgba(234, 179, 8, 0.3); color: #eab308; padding: 0.4rem; border-radius: 0.5rem; font-size: 0.7rem; font-weight: bold; text-align: center; text-transform: uppercase; letter-spacing: 0.05em;">
                            ⚠️ ¡Últimas {{ $producto->stock }} unidades!
                        </div>
                    @endif

                    <div style="border-top: 1px solid #18181b; padding-top: 1rem; display: flex; justify-content: space-between; align-items: center;">
                        <span style="color: #ffffff; font-weight: 900;">$ {{ number_format($producto->precio, 0, ',', '.') }}</span>
                        <button onclick="prepararAgregarCarrito('{{ $producto->id }}', '{{ $producto->nombre }}', {{ $producto->precio }}, '{{ $producto->categoria }}')" style="background-color: var(--accent); color: white; padding: 0.5rem 1rem; border-radius: 0.5rem; border: none; font-weight: bold; cursor: pointer; font-size: 0.8rem;">
                            + Carrito
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div id="filtros-sidebar">
        <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid var(--border-soft); padding-bottom: 1rem; margin-bottom: 1rem;">
            <h3 style="color: white; margin: 0; text-transform: uppercase; font-weight: 900; font-size: 1.1rem; display: flex; align-items: center; gap: 0.5rem;">
                <span onclick="toggleFiltros(false)" style="cursor: pointer; font-size: 1.5rem; line-height: 1; color: var(--text-muted); margin-right: 0.2rem;">&times;</span> Ocultar Filtros
            </h3>
        </div>

        <div style="margin-bottom: 1rem;">
            <button onclick="limpiarTodosLosFiltros()" style="background-color: var(--bg-elevated); border: 1px solid var(--border-soft); color: white; padding: 0.4rem; border-radius: 0.25rem; font-size: 0.75rem; font-weight: bold; cursor: pointer; width: 100%; text-transform: uppercase;">
                Limpiar filtros
            </button>
        </div>

        <div class="filtro-seccion">
            <div class="filtro-titulo" onclick="toggleAcordeon(this)">
                <span>► Categoría</span>
            </div>
            <div class="filtro-contenido">
                @foreach(['camisas', 'pantalones', 'pantalonetas', 'buzos'] as $catFija)
                    <label style="color: var(--text-muted); font-size: 0.85rem; display: flex; align-items: center; gap: 0.6rem; cursor: pointer; text-transform: uppercase; font-weight: bold; padding: 0.2rem 0;">
                        <input type="checkbox" class="chk-categoria" value="{{ $catFija }}" onchange="filtrarCatalogoCompleto()" style="accent-color: var(--accent); width: 15px; height: 15px; cursor: pointer;">
                        {{ $catFija }}
                    </label>
                @endforeach
            </div>
        </div>
    </div>

    <div id="modal-personalizar">
        <div style="background-color: var(--bg-card); border: 1px solid var(--border-soft); width: 100%; max-width: 500px; border-radius: 1rem; padding: 2rem; box-sizing: border-box; position: relative; max-height: 95vh; overflow-y: auto;">
            <button onclick="toggleModal(false)" style="position: absolute; top: 15px; right: 20px; background: none; border: none; color: var(--text-muted); font-size: 1.5rem; cursor: pointer;">&times;</button>
            <h3 style="color: white; margin: 0 0 0.25rem 0; font-weight: 900; text-transform: uppercase;">🎨 Añadir Estampado</h3>
            <p id="prenda-seleccionada-texto" style="color: var(--text-muted); font-size: 0.85rem; margin-bottom: 1.5rem;"></p>
            <div style="display: flex; flex-direction: column; gap: 1.25rem;">
                <div>
                    <label style="color: white; font-size: 0.8rem; font-weight: bold; display: block; margin-bottom: 0.5rem; text-transform: uppercase;">1. Ubicación en la prenda:</label>
                    <select id="custom-ubicacion" class="input-glow" onchange="adaptarCamposDeTexto(); calcularPrecioEstampado();"></select>
                </div>
                <div>
                    <label style="color: white; font-size: 0.8rem; font-weight: bold; display: block; margin-bottom: 0.5rem; text-transform: uppercase;">2. Sube tus diseños (Máx 3 imágenes):</label>
                    <input type="file" id="custom-imagen" accept="image/png, image/jpeg, image/webp" class="input-glow" multiple onchange="manejarSeleccionImagenes(event)">
                    <div id="preview-imagenes-contenedor" class="preview-badge-container"></div>
                </div>
                <div>
                    <label style="color: white; font-size: 0.8rem; font-weight: bold; display: block; margin-bottom: 0.5rem; text-transform: uppercase;">3. Frase del estampado (opcional):</label>
                    <div id="campo-texto-unico"><input type="text" id="custom-texto-simple" class="input-glow" placeholder="Ej: Estilo Urbano 2026" oninput="calcularPrecioEstampado()"></div>
                    <div id="campos-texto-doble" style="display: none; flex-direction: column; gap: 0.75rem;">
                        <div><span id="label-lado-a" style="color: var(--text-muted); font-size: 0.75rem; display:block; margin-bottom: 0.25rem;">Lado Izquierdo / Adelante:</span><input type="text" id="custom-texto-ladoA" class="input-glow" placeholder="Frase para esta zona" oninput="calcularPrecioEstampado()"></div>
                        <div><span id="label-lado-b" style="color: var(--text-muted); font-size: 0.75rem; display:block; margin-bottom: 0.25rem;">Lado Derecho / Atrás:</span><input type="text" id="custom-texto-ladoB" class="input-glow" placeholder="Frase para la otra zona" oninput="calcularPrecioEstampado()"></div>
                    </div>
                    <div id="campos-texto-cuadruple" style="display: none; flex-direction: column; gap: 0.75rem;">
                        <div style="margin-bottom: 0.25rem;"><span style="color: var(--text-muted); font-size: 0.75rem; display:block; margin-bottom: 0.25rem;">Frase Adelante (Pecho):</span><input type="text" id="custom-texto-todos-adelante" class="input-glow" placeholder="Texto para el frente" oninput="calcularPrecioEstampado()"></div>
                        <div style="margin-bottom: 0.25rem;"><span style="color: var(--text-muted); font-size: 0.75rem; display:block; margin-bottom: 0.25rem;">Frase Atrás (Espalda):</span><input type="text" id="custom-texto-todos-atras" class="input-glow" placeholder="Texto para la espalda" oninput="calcularPrecioEstampado()"></div>
                        <div style="margin-bottom: 0.25rem;"><span style="color: var(--text-muted); font-size: 0.75rem; display:block; margin-bottom: 0.25rem;">Frase Manga Izquierda:</span><input type="text" id="custom-texto-todos-mangaIzg" class="input-glow" placeholder="Texto manga izquierda" oninput="calcularPrecioEstampado()"></div>
                        <div><span style="color: var(--text-muted); font-size: 0.75rem; display:block; margin-bottom: 0.25rem;">Frase Manga Derecha:</span><input type="text" id="custom-texto-todos-mangaDer" class="input-glow" placeholder="Texto manga derecha" oninput="calcularPrecioEstampado()"></div>
                    </div>
                </div>
                <div>
                    <label style="color: white; font-size: 0.8rem; font-weight: bold; display: block; margin-bottom: 0.5rem; text-transform: uppercase;">4. Color de la tinta:</label>
                    <select id="custom-color" class="input-glow">
                        <option value="Blanco">Blanco Matte</option>
                        <option value="Negro">Negro Profundo</option>
                        <option value="Dorado">Dorado Brillante</option>
                    </select>
                </div>
                <div>
                    <label style="color: white; font-size: 0.8rem; font-weight: bold; display: block; margin-bottom: 0.5rem; text-transform: uppercase;">5. Información o instrucciones adicionales:</label>
                    <textarea id="custom-notas" class="input-glow" rows="3" placeholder="Ej: Quiero que el logo esté ligeramente inclinado..." style="resize: none; font-family: sans-serif;"></textarea>
                </div>
                <div style="background-color: #000000; border: 1px solid var(--border-soft); padding: 1rem; border-radius: 0.5rem; text-align: center; color: white; font-weight: bold;">Precio Adicional Estampado: <span id="precio-estampado-dinamico" style="color: var(--accent);">$0 COP</span></div>
                <button onclick="guardarEstampadoEnItem()" style="background-color: #ffffff; color: black; border: none; padding: 0.8rem; border-radius: 0.5rem; font-weight: 900; text-transform: uppercase; cursor: pointer; width: 100%;">🎯 Vincular Estampado a la Prenda</button>
            </div>
        </div>
    </div>

    <div id="carrito-sidebar">
        <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid var(--border-soft); padding-bottom: 1rem; margin-bottom: 1rem;">
            <h3 style="color: white; margin: 0; text-transform: uppercase; font-weight: 900;">Tu Carrito</h3>
            <button onclick="toggleCarrito()" style="background: none; border: none; color: var(--text-muted); font-size: 1.5rem; cursor: pointer;">&times;</button>
        </div>
        <div id="carrito-items" style="flex-grow: 1; overflow-y: auto; display: flex; flex-direction: column; gap: 1rem; margin-bottom: 1rem;"></div>
        
        <div style="background-color: #000000; border: 1px solid var(--border-soft); padding: 1rem; border-radius: 0.5rem; display: flex; flex-direction: column; gap: 0.75rem; margin-bottom: 1rem;">
            <div>
                <label style="color: #71717a; font-size: 0.75rem; font-weight: bold; display: block; margin-bottom: 0.25rem;">CIUDAD DE ENVÍO:</label>
                <select id="selector-envio" onchange="actualizarCarritoHTML()" style="background-color: #09090b; border: 1px solid var(--border-soft); color: white; padding: 0.4rem; border-radius: 0.25rem; width: 100%; font-size: 0.8rem;">
                    <option value="bogota">Bogotá ($6.000)</option>
                    <option value="otras">Otras Ciudades ($12.000)</option>
                </select>
            </div>
            
            <div>
                <label style="color: #71717a; font-size: 0.75rem; font-weight: bold; display: block; margin-bottom: 0.25rem;">DIRECCIÓN DE ENVÍO:</label>
                <input type="text" id="input-direccion" placeholder="Ej: Calle 45 # 12-34 Apto 301" required style="background-color: #09090b; border: 1px solid var(--border-soft); color: white; padding: 0.4rem; border-radius: 0.25rem; width: 100%; font-size: 0.8rem; box-sizing: border-box;">
            </div>

            <div style="border-top: 1px solid #18181b; padding-top: 0.75rem; margin-top: 0.25rem;">
                <label style="color: #71717a; font-size: 0.75rem; font-weight: bold; display: block; margin-bottom: 0.25rem;">¿TIENES UN CUPÓN?</label>
                <div style="display: flex; gap: 0.5rem;">
                    <input type="text" id="input-cupon" placeholder="Código" style="background-color: #09090b; border: 1px solid var(--border-soft); color: white; padding: 0.4rem; border-radius: 0.25rem; flex-grow: 1; font-size: 0.8rem; text-transform: uppercase;">
                    <button onclick="aplicarCupon()" style="background-color: #ffffff; color: black; border: none; padding: 0 0.75rem; border-radius: 0.25rem; font-weight: bold; font-size: 0.75rem; cursor: pointer;">Aplicar</button>
                </div>
                <div id="mensaje-cupon" style="font-size: 0.7rem; margin-top: 0.25rem; display: none;"></div>
            </div>
        </div>

        <div style="border-top: 1px solid var(--border-soft); padding-top: 1rem;">
            <div style="display: flex; justify-content: space-between; color: white; font-weight: bold; font-size: 1.1rem; margin-bottom: 1rem;"><span>TOTAL:</span> <span id="carrito-total">$0</span></div>
            <button onclick="procesarCompra()" style="width: 100%; background-color: var(--accent); color: white; border: none; padding: 0.8rem; border-radius: 0.5rem; font-weight: bold; text-transform: uppercase; cursor: pointer;">Finalizar Compra</button>
        </div>
    </div>

    <script>
        let carrito = [];
        let imagenesDisenoActuales = []; 
        let itemIdParaEstampar = null;
        let descuentoPorcentaje = 0;
        let cuponAplicadoCodigo = "";

        function toggleFiltros(show) {
            const sidebar = document.getElementById('filtros-sidebar');
            if (show) sidebar.classList.add('active');
            else sidebar.classList.remove('active');
        }

        function toggleAcordeon(elemento) {
            const contenido = elemento.nextElementSibling;
            contenido.classList.toggle('open');
            const tituloSpan = elemento.querySelector('span');
            if (contenido.classList.contains('open')) {
                tituloSpan.innerText = "▼ Categoría";
            } else {
                tituloSpan.innerText = "► Categoría";
            }
        }

        function filtrarCatalogoCompleto() {
            const seleccionadas = Array.from(document.querySelectorAll('.chk-categoria:checked')).map(cb => cb.value);
            let visibles = 0;

            document.querySelectorAll('.producto-card').forEach(card => {
                const catCard = card.getAttribute('data-categoria').toLowerCase().trim();
                
                if (seleccionadas.length === 0 || seleccionadas.includes(catCard)) {
                    card.style.display = 'flex';
                    visibles++;
                } else {
                    card.style.display = 'none';
                }
            });

            document.getElementById('contador-productos').innerText = visibles;
        }

        function ordenarProductos() {
            const criterio = document.getElementById('ordenar-select').value;
            const grid = document.querySelector('.grid-productos');
            const tarjetas = Array.from(grid.querySelectorAll('.producto-card'));

            if (criterio === 'predeterminado') return;

            tarjetas.sort((a, b) => {
                const btnA = a.querySelector("button[onclick^='prepararAgregarCarrito']");
                const btnB = b.querySelector("button[onclick^='prepararAgregarCarrito']");
                
                if (!btnA || !btnB) return 0;

                const matchesA = btnA.getAttribute('onclick').match(/,\s*([0-9.]+),/);
                const matchesB = btnB.getAttribute('onclick').match(/,\s*([0-9.]+),/);

                const precioA = matchesA ? parseFloat(matchesA[1]) : 0;
                const precioB = matchesB ? parseFloat(matchesB[1]) : 0;

                if (criterio === 'menor-precio') return precioA - precioB;
                if (criterio === 'mayor-precio') return precioB - precioA;
                return 0;
            });

            tarjetas.forEach(tarjeta => grid.appendChild(tarjeta));
        }

        function limpiarTodosLosFiltros() {
            document.querySelectorAll('.chk-categoria').forEach(cb => cb.checked = false);
            document.getElementById('ordenar-select').value = 'predeterminado';
            filtrarCatalogoCompleto();
            ordenarProductos();
        }

        function toggleModal(show) { document.getElementById('modal-personalizar').style.display = show ? 'flex' : 'none'; }
        function toggleCarrito() { document.getElementById('carrito-sidebar').classList.toggle('active'); }
        function prepararAgregarCarrito(id, nombre, precio, categoria) {
            const selectorTalla = document.getElementById(`talla-${id}`);
            const tallaSeleccionada = selectorTalla ? selectorTalla.value : 'M';
            agregarAlCarrito(id, nombre, precio, categoria, tallaSeleccionada);
        }
        function agregarAlCarrito(id, nombre, precio, categoria, talla) {
            const cartItemId = `${id}-${talla}`;
            const existe = carrito.find(item => item.cartItemId === cartItemId);
            if (existe) { existe.cantidad++; } else { carrito.push({ cartItemId: cartItemId, id: id, nombre: nombre, precio: precio, categoria: categoria || '', cantidad: 1, talla: talla, estampado: null }); }
            actualizarCarritoHTML();
        }
        function cambiarCantidad(cartItemId, cambio) {
            const item = carrito.find(i => i.cartItemId === cartItemId);
            if (item) { item.cantidad += cambio; if (item.cantidad <= 0) eliminarDelCarrito(cartItemId); }
            actualizarCarritoHTML();
        }
        function eliminarDelCarrito(cartItemId) { carrito = carrito.filter(item => item.cartItemId !== cartItemId); actualizarCarritoHTML(); }
        function esUbicacionDoble() { const ubi = document.getElementById('custom-ubicacion').value; return (ubi === 'Adelante y Atras' || ubi === 'Ambas Mangas' || ubi === 'Ambas Piernas' || ubi === 'Ambos Lados'); }
        function esUbicacionCuadruple() { const ubi = document.getElementById('custom-ubicacion').value; return (ubi === 'Todos los lados'); }
        
        function adaptarCamposDeTexto() {
            const ubi = document.getElementById('custom-ubicacion').value;
            const containerUnico = document.getElementById('campo-texto-unico');
            const containerDoble = document.getElementById('campos-texto-doble');
            const containerCuadruple = document.getElementById('campos-texto-cuadruple');
            const labelA = document.getElementById('label-lado-a');
            const labelB = document.getElementById('label-lado-b');
            containerUnico.style.display = 'none'; containerDoble.style.display = 'none'; containerCuadruple.style.display = 'none';
            if (esUbicacionCuadruple()) { containerCuadruple.style.display = 'flex'; } else if (esUbicacionDoble()) { containerDoble.style.display = 'flex'; if (ubi === 'Adelante y Atras' || ubi === 'Ambos Lados') { labelA.innerText = "Frase delantera (Adelante/Pecho):"; labelB.innerText = "Frase trasera (Atrás):"; } else if (ubi === 'Ambas Mangas') { labelA.innerText = "Frase Manga Izquierda:"; labelB.innerText = "Frase Manga Derecha:"; } else if (ubi === 'Ambas Piernas') { labelA.innerText = "Frase Pierna Izquierda:"; labelB.innerText = "Frase Pierna Derecha:"; } } else { containerUnico.style.display = 'block'; }
        }
        function calcularPrecioEstampado() {
            let tieneTexto = false;
            if (esUbicacionCuadruple()) { tieneTexto = document.getElementById('custom-texto-todos-adelante').value.trim().length > 0 || document.getElementById('custom-texto-todos-atras').value.trim().length > 0 || document.getElementById('custom-texto-todos-mangaIzg').value.trim().length > 0 || document.getElementById('custom-texto-todos-mangaDer').value.trim().length > 0; } else if (esUbicacionDoble()) { tieneTexto = document.getElementById('custom-texto-ladoA').value.trim().length > 0 || document.getElementById('custom-texto-ladoB').value.trim().length > 0; } else { tieneTexto = document.getElementById('custom-texto-simple').value.trim().length > 0; }
            const totalFotos = imagenesDisenoActuales.length; let costo = 0; if (totalFotos > 0) costo += 8000 * totalFotos; if (tieneTexto) { if (esUbicacionCuadruple()) { costo += 24000; } else { costo += esUbicacionDoble() ? 12000 : 8000; } }
            document.getElementById('precio-estampado-dinamico').innerText = `$${costo.toLocaleString('co')} COP`; return costo;
        }
        function abrirModalEstampado(cartItemId) {
            const item = carrito.find(i => i.cartItemId === cartItemId); if (!item) return;
            itemIdParaEstampar = cartItemId; document.getElementById('prenda-seleccionada-texto').innerText = `Aplicando a: ${item.nombre} (Talla ${item.talla})`;
            
            const selectUbicacion = document.getElementById('custom-ubicacion'); 
            selectUbicacion.innerHTML = '';
            
            const nombreLower = item.nombre.toLowerCase(); const catLower = item.categoria.toLowerCase(); let opciones = [];
            if (nombreLower.includes('buzo') || nombreLower.includes('hoodie') || catLower.includes('buzo')) { opciones = [{ val: 'Adelante', txt: 'Solo Adelante' }, { val: 'Atras', txt: 'Solo Atrás' }, { val: 'Adelante y Atras', txt: 'Atrás y Adelante (Doble)' }, { val: 'Manga Derecha', txt: 'Solo Manga Derecha' }, { val: 'Manga Izquierda', txt: 'Solo Manga Izquierda' }, { val: 'Ambas Mangas', txt: 'Derecha e Izquierda (Mangas Doble)' }, { val: 'Todos los lados', txt: '🔥 Full Estampado (Todos los lados)' }]; } else if (nombreLower.includes('pantalon') || nombreLower.includes('jeans') || nombreLower.includes('jogger') || catLower.includes('pantalon')) { opciones = [{ val: 'Pierna Izquierda', txt: 'Pierna Izquierda' }, { val: 'Pierna Derecha', txt: 'Pierna Derecha' }, { val: 'Ambas Piernas', txt: 'Ambas Piernas (Doble)' }]; } else { opciones = [{ val: 'Pecho', txt: 'Estampado en el Pecho' }, { val: 'Atras', txt: 'Estampado Atrás' }, { val: 'Ambos Lados', txt: 'Pecho y Atrás (Ambos Doble)' }]; }
            
            opciones.forEach(opt => { 
                const el = document.createElement('option'); 
                el.value = opt.val; 
                el.textContent = opt.txt; 
                el.style.backgroundColor = "#09090b";
                el.style.color = "#ffffff";
                selectUbicacion.appendChild(el); 
            });
            
            imagenesDisenoActuales = []; document.getElementById('custom-texto-simple').value = ''; document.getElementById('custom-texto-ladoA').value = ''; document.getElementById('custom-texto-ladoB').value = ''; document.getElementById('custom-texto-todos-adelante').value = ''; document.getElementById('custom-texto-todos-atras').value = ''; document.getElementById('custom-texto-todos-mangaIzg').value = ''; document.getElementById('custom-texto-todos-mangaDer').value = ''; document.getElementById('custom-notas').value = '';
            if (item.estampado) {
                document.getElementById('custom-ubicacion').value = item.estampado.ubicacion; adaptarCamposDeTexto();
                if (esUbicacionCuadruple()) { document.getElementById('custom-texto-todos-adelante').value = item.estampado.textoTodosAdelante || ''; document.getElementById('custom-texto-todos-atras').value = item.estampado.textoTodosAtras || ''; document.getElementById('custom-texto-todos-mangaIzg').value = item.estampado.textoTodosMangaIzg || ''; document.getElementById('custom-texto-todos-mangaDer').value = item.estampado.textoTodosMangaDer || ''; } else if (esUbicacionDoble()) { document.getElementById('custom-texto-ladoA').value = item.estampado.textoLadoA || ''; document.getElementById('custom-texto-ladoB').value = item.estampado.textoLadoB || ''; } else { document.getElementById('custom-texto-simple').value = item.estampado.texto || ''; }
                document.getElementById('custom-color').value = item.estampado.color; document.getElementById('custom-notas').value = item.estampado.notas || ''; imagenesDisenoActuales = item.estampado.imagenes || [];
            } else { adaptarCamposDeTexto(); }
            renderizarVistasPrevias(); calcularPrecioEstampado(); toggleModal(true);
        }
        function manejarSeleccionImagenes(event) {
            const archivos = Array.from(event.target.files); if (imagenesDisenoActuales.length + archivos.length > 3) { alert("Puedes subir como máximo 3 fotos por prenda."); return; }
            archivos.forEach(archivo => { imagenesDisenoActuales.push(archivo); }); renderizarVistasPrevias(); calcularPrecioEstampado(); document.getElementById('custom-imagen').value = ''; 
        }
        function renderizarVistasPrevias() {
            const contenedor = document.getElementById('preview-imagenes-contenedor'); contenedor.innerHTML = '';
            imagenesDisenoActuales.forEach((file, index) => {
                const box = document.createElement('div'); box.className = 'preview-box'; const img = document.createElement('img');
                if (file instanceof File) { const reader = new FileReader(); reader.onload = function(e) { img.src = e.target.result; }; reader.readAsDataURL(file); } else { img.src = file; }
                const btnEliminar = document.createElement('button'); btnEliminar.className = 'btn-remove-img'; btnEliminar.innerHTML = '🗑️ Borrar'; btnEliminar.onclick = function() { eliminarFotoIndividual(index); };
                box.appendChild(img); box.appendChild(btnEliminar); contenedor.appendChild(box);
            });
        }
        function eliminarFotoIndividual(index) { imagenesDisenoActuales.splice(index, 1); renderizarVistasPrevias(); calcularPrecioEstampado(); }
        function guardarEstampadoEnItem() {
            if (!itemIdParaEstampar) return;
            const ubi = document.getElementById('custom-ubicacion').value; const col = document.getElementById('custom-color').value; const notasTxt = document.getElementById('custom-notas').value.trim(); const costoCalculado = calcularPrecioEstampado();
            if (costoCalculado === 0 && notasTxt.length === 0) { alert('Por favor, escribe una frase, agrega notas o sube imágenes para procesar el estampado.'); return; }
            let dataEstampado = { ubicacion: ubi, color: col, costoExtra: costoCalculado, notas: notasTxt || 'Sin notas adicionales', imagenes: [...imagenesDisenoActuales] };
            if (esUbicacionCuadruple()) { dataEstampado.textoTodosAdelante = document.getElementById('custom-texto-todos-adelante').value.trim() || 'Sin texto'; dataEstampado.textoTodosAtras = document.getElementById('custom-texto-todos-atras').value.trim() || 'Sin texto'; dataEstampado.textoTodosMangaIzg = document.getElementById('custom-texto-todos-mangaIzg').value.trim() || 'Sin texto'; dataEstampado.textoTodosMangaDer = document.getElementById('custom-texto-todos-mangaDer').value.trim() || 'Sin texto'; dataEstampado.texto = `Frente: ${dataEstampado.textoTodosAdelante} | Espalda: ${dataEstampado.textoTodosAtras} | M. Izq: ${dataEstampado.textoTodosMangaIzg} | M. Der: ${dataEstampado.textoTodosMangaDer}`; } else if (esUbicacionDoble()) { dataEstampado.textoLadoA = document.getElementById('custom-texto-ladoA').value.trim() || 'Sin texto'; dataEstampado.textoLadoB = document.getElementById('custom-texto-ladoB').value.trim() || 'Sin texto'; dataEstampado.texto = `Lado A: ${dataEstampado.textoLadoA} | Lado B: ${dataEstampado.textoLadoB}`; } else { dataEstampado.texto = document.getElementById('custom-texto-simple').value.trim() || 'Sin Frase'; }
            const item = carrito.find(i => i.cartItemId === itemIdParaEstampar); if (item) item.estampado = dataEstampado;
            actualizarCarritoHTML(); toggleModal(false); itemIdParaEstampar = null; alert('¡Estampado configurado con éxito!');
        }
        function aplicarCupon() {
            const codigo = document.getElementById('input-cupon').value.trim().toUpperCase(); const contenedorMsg = document.getElementById('mensaje-cupon');
            if(!codigo) { alert("Ingresa un código de cupón válido."); return; }
            if(codigo === "NOW10") { descuentoPorcentaje = 0.10; cuponAplicadoCodigo = "NOW10"; contenedorMsg.style.color = "#22c55e"; contenedorMsg.innerText = "¡Cupón NOW10 aplicado! 10% de descuento."; } else if(codigo === "NOW20") { descuentoPorcentaje = 0.20; cuponAplicadoCodigo = "NOW20"; contenedorMsg.style.color = "#22c55e"; contenedorMsg.innerText = "¡Cupón NOW20 aplicado! 20% de descuento."; } else { descuentoPorcentaje = 0; cuponAplicadoCodigo = ""; contenedorMsg.style.color = "#ef4444"; contenedorMsg.innerText = "Cupón inválido o expirado."; }
            contenedorMsg.style.display = "block"; actualizarCarritoHTML();
        }
        function actualizarCarritoHTML() {
            const contenedor = document.getElementById('carrito-items'); const contador = document.getElementById('carrito-contador'); const totalHTML = document.getElementById('carrito-total');
            contenedor.innerHTML = ''; let subtotal = 0; let totalItems = 0;
            carrito.forEach(item => {
                let precioItemTotal = item.precio; let infoEstampadoHTML = '';
                if (item.estampado) { precioItemTotal += item.estampado.costoExtra; const totalFotosCargadas = item.estampado.imagenes ? item.estampado.imagenes.length : 0; infoEstampadoHTML = `<div style="background-color: var(--bg-elevated); padding: 0.5rem; border-radius: 0.25rem; margin-top: 0.5rem; font-size: 0.75rem; color: #f4f4f5; border-left: 2px solid var(--accent);">🎨 <strong>Zonas:</strong> ${item.estampado.ubicacion} (${item.estampado.color})<br>📝 <strong>Frase:</strong> ${item.estampado.texto}<br>📌 <strong>Notas:</strong> ${item.estampado.notes}<br>🖼️ <strong>Fotos añadidas:</strong> ${totalFotosCargadas} de 3</div>`; }
                subtotal += precioItemTotal * item.cantidad; totalItems += item.cantidad;
                contenedor.innerHTML += `<div style="background-color: #000000; border: 1px solid var(--border-soft); padding: 0.85rem; border-radius: 0.5rem; display: flex; flex-direction: column; gap: 0.5rem;"><div style="display: flex; justify-content: space-between; align-items: flex-start;"><div style="max-width: 60%;"><p style="color: white; margin: 0; font-weight: bold; font-size: 0.85rem; text-transform: uppercase;">${item.nombre}</p><p style="color: var(--accent); margin: 0; font-size: 0.75rem; font-weight: 800;">Talla: ${item.talla}</p><p style="color: var(--text-muted); margin: 0.2rem 0 0 0; font-size: 0.8rem;">Und: $${precioItemTotal.toLocaleString('co')}</p></div><div style="display: flex; align-items: center; gap: 0.4rem;"><button onclick="cambiarCantidad('${item.cartItemId}', -1)" class="btn-qty">-</button><span style="color: white; font-weight: bold; font-size: 0.9rem; min-width: 15px; text-align: center;">${item.cantidad}</span><button onclick="cambiarCantidad('${item.cartItemId}', 1)" class="btn-qty">+</button><button onclick="eliminarDelCarrito('${item.cartItemId}')" class="btn-delete-cart" title="Eliminar del carrito">🗑️</button></div></div>${infoEstampadoHTML}<div style="text-align: right; margin-top: 0.2rem;"><button onclick="abrirModalEstampado('${item.cartItemId}')" style="background: none; border: none; color: #38bdf8; font-size: 0.75rem; font-weight: bold; cursor: pointer; text-transform: uppercase; padding: 0;">${item.estampado ? '✏️ Modificar Diseño' : '🎨 Configurar Estampados'}</button></div></div>`;
            });
            let valorDescuento = subtotal * descuentoPorcentaje; let subtotalConDescuento = subtotal - valorDescuento; let costoEnvio = subtotal > 0 ? (document.getElementById('selector-envio').value === 'bogota' ? 6000 : 12000) : 0;
            totalHTML.innerText = '$' + (subtotalConDescuento + costoEnvio).toLocaleString('co'); contador.innerText = totalItems;
        }
        
        // 📍 FUNCIÓN DE COMPRA COMPLETAMENTE ACTUALIZADA CON DIRECCIÓN DE ENVÍO
        function procesarCompra() {
            if (carrito.length === 0) { alert('El carrito está vacío.'); return; }
            
            // Validamos que se ingrese la dirección
            const direccionInput = document.getElementById('input-direccion').value.trim();
            if (direccionInput === "") { 
                alert('Por favor, ingresa tu dirección de envío para saber a dónde despachar tu pedido.'); 
                document.getElementById('input-direccion').focus();
                return; 
            }

            const formData = new FormData();
            
            // Obtenemos el texto de la ciudad seleccionada
            const selectCiudad = document.getElementById('selector-envio');
            const ciudadTexto = selectCiudad.options[selectCiudad.selectedIndex].text;

            // Almacenamos la ubicación completa al inicio del string 'detalles'
            let detallesPedido = `📍 ENVÍO A: ${ciudadTexto} - DIRECCIÓN: ${direccionInput} | `;
            
            // Añadimos los productos del carrito
            detallesPedido += carrito.map(item => { 
                let estInfo = item.estampado ? ` [Ubicación: ${item.estampado.ubicacion}, Detalles: ${item.estampado.texto}, Notas: ${item.estampado.notas}]` : ''; 
                return `${item.nombre} (Talla: ${item.talla})${estInfo} x${item.cantidad}`; 
            }).join(' | ');

            let subtotalCalculado = 0; 
            carrito.forEach(item => { subtotalCalculado += (item.precio + (item.estampado ? item.estampado.costoExtra : 0)) * item.cantidad; });
            
            let valorDescuento = subtotalCalculado * descuentoPorcentaje; 
            let subtotalConDescuento = subtotalCalculado - valorDescuento; 
            let costoEnvio = document.getElementById('selector-envio').value === 'bogota' ? 6000 : 12000;
            
            if (cuponAplicadoCodigo !== "") { detallesPedido += ` | [Cupón Aplicado: ${cuponAplicadoCodigo}]`; }
            
            formData.append('detalles', detallesPedido); 
            formData.append('total', subtotalConDescuento + costoEnvio);
            
            carrito.forEach((item) => { 
                if (item.estampado && item.estampado.imagenes) { 
                    item.estampado.imagenes.forEach((imagen) => { 
                        if (imagen instanceof File) { formData.append(`disonos_${item.id}[]`, imagen); } 
                    }); 
                } 
            });
            
            fetch('/pedidos', { method: "POST", headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" }, body: formData })
            .then(res => { if (!res.ok) { throw new Error("HTTP error " + res.status); } return res.json(); })
            .then(data => { 
                if (data.success) { 
                    alert('¡Su orden avanzada fue enviada a NowStyle! 🚀🔥'); 
                    carrito = []; 
                    actualizarCarritoHTML(); 
                    document.getElementById('input-direccion').value = ""; // Limpiamos el campo
                    window.location.href = "{{ route('pedido.index') }}"; 
                } else { 
                    alert('Error del servidor al guardar orden: ' + data.error); 
                } 
            })
            .catch((error) => { console.error("Fallo:", error); alert('Error real: ' + error.message); });
        }
    </script>
</x-app-layout>