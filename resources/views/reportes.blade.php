<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Reportes | NowStyle Store</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background-color: #000000; color: #ffffff; padding: 2rem; }
        .dashboard-container { max-width: 1400px; margin: 0 auto; }
        .report-header { display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #1a1a1a; padding-bottom: 1.5rem; margin-bottom: 2.5rem; flex-wrap: wrap; gap: 1rem; }
        .report-title h1 { font-size: 2rem; font-weight: 900; text-transform: uppercase; letter-spacing: 0.05em; }
        .report-title h1 span { color: #dc2626; }
        .report-title p { color: #71717a; font-size: 0.9rem; margin-top: 0.2rem; }
        
        .header-actions { display: flex; gap: 0.75rem; align-items: center; }
        
        /* Botonera de navegación e impresión */
        .btn-secondary { background-color: #1c1c1e; border: 1px solid #27272a; color: #ffffff; padding: 0.75rem 1.5rem; border-radius: 0.5rem; font-weight: 700; font-size: 0.85rem; text-transform: uppercase; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem; transition: all 0.2s; }
        .btn-secondary:hover { background-color: #27272a; border-color: #3f3f46; transform: translateY(-1px); }
        .btn-export { background-color: #dc2626; color: #ffffff; padding: 0.75rem 1.5rem; border-radius: 0.5rem; font-weight: 700; font-size: 0.85rem; text-transform: uppercase; text-decoration: none; transition: all 0.2s; display: inline-flex; align-items: center; gap: 0.5rem; border: none; cursor: pointer; }
        .btn-export:hover { background-color: #b91c1c; box-shadow: 0 0 20px rgba(220, 38, 38, 0.4); transform: translateY(-1px); }
        
        .metrics-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.5rem; margin-bottom: 3rem; }
        .metric-card { background-color: #0b0b0c; border: 1px solid #18181b; border-radius: 0.75rem; padding: 1.5rem; display: flex; align-items: center; justify-content: space-between; }
        .metric-data h3 { font-size: 0.8rem; color: #71717a; text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.5rem; }
        .metric-data p { font-size: 1.75rem; font-weight: 900; color: #ffffff; }
        .metric-icon { width: 48px; height: 48px; background-color: rgba(220, 38, 38, 0.1); color: #dc2626; border-radius: 0.5rem; display: flex; align-items: center; justify-content: center; font-size: 1.3rem; }
        .report-section { background-color: #0b0b0c; border: 1px solid #18181b; border-radius: 0.75rem; padding: 2rem; }
        .section-title { font-size: 1.2rem; font-weight: 700; text-transform: uppercase; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem; }
        .report-table { width: 100%; border-collapse: collapse; text-align: left; }
        .report-table th { padding: 1rem; color: #71717a; font-size: 0.8rem; text-transform: uppercase; font-weight: 700; border-bottom: 1px solid #18181b; }
        .report-table td { padding: 1.2rem 1rem; border-bottom: 1px solid #18181b; font-size: 0.9rem; }
        .status-badge { padding: 0.25rem 0.5rem; border-radius: 0.25rem; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; }
        .status-success { background-color: rgba(16, 185, 129, 0.1); color: #10b981; }
        .status-pending { background-color: rgba(245, 158, 11, 0.1); color: #f59e0b; }

        /* Ocultar botones al imprimir */
        @media print {
            .header-actions { display: none !important; }
            body { padding: 0; }
        }
    </style>
</head>
<body>

    <div class="dashboard-container">
        <header class="report-header">
            <div class="report-title">
                <h1>Reportes de <span>Ventas</span></h1>
                <p>Bienvenido al panel, tienes sesión como: <strong>{{ ucfirst(Auth::user()->rol) }}</strong></p>
            </div>

            <div class="header-actions">
                <a href="{{ route('dashboard') }}" class="btn-secondary">
                    <i class="fa-solid fa-arrow-left"></i> Volver al Panel
                </a>

                @if(Auth::user()->rol === 'gerente')
                    <button class="btn-export" onclick="window.print()">
                        <i class="fa-solid fa-file-pdf"></i> Imprimir Reporte
                    </button>
                @endif
            </div>
        </header>

        <div class="metrics-grid">
            <div class="metric-card">
                <div class="metric-data">
                    <h3>Total Ingresos</h3>
                    <p>${{ number_format($totalIngresos ?? 0, 0, ',', '.') }}</p>
                </div>
                <div class="metric-icon"><i class="fa-solid fa-wallet"></i></div>
            </div>

            <div class="metric-card">
                <div class="metric-data">
                    <h3>Pedidos Totales</h3>
                    <p>{{ $totalPedidos ?? 0 }}</p>
                </div>
                <div class="metric-icon"><i class="fa-solid fa-bag-shopping"></i></div>
            </div>

            <div class="metric-card">
                <div class="metric-data">
                    <h3>Ticket Promedio</h3>
                    <p>${{ number_format($ticketPromedio ?? 0, 0, ',', '.') }}</p>
                </div>
                <div class="metric-icon"><i class="fa-solid fa-chart-line"></i></div>
            </div>

            <div class="metric-card">
                <div class="metric-data">
                    <h3>Clientes Totales</h3>
                    <p>{{ $totalClientes ?? 0 }}</p>
                </div>
                <div class="metric-icon"><i class="fa-solid fa-users"></i></div>
            </div>
        </div>

        <div class="report-section">
            <h2 class="section-title"><i class="fa-solid fa-clock-rotate-left" style="color: #dc2626;"></i> Historial de Pedidos Realizados</h2>
            
            <table class="report-table">
                <thead>
                    <tr>
                        <th>ID Pedido</th>
                        <th>Cliente</th>
                        <th>Fecha</th>
                        <th>Estado</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ultimasVentas ?? [] as $venta)
                    <tr>
                        <td style="font-weight: bold;">#{{ $venta->id }}</td>
                        <td>{{ $venta->cliente_nombre ?? 'Usuario General' }}</td>
                        <td>{{ date('d M Y', strtotime($venta->created_at)) }}</td>
                        <td>
                            @if(isset($venta->estado) && $venta->estado == 'completado')
                                <span class="status-badge status-success">Completado</span>
                            @else
                                <span class="status-badge status-pending">Pendiente</span>
                            @endif
                        </td>
                        <td style="color: #10b981; font-weight: bold;">${{ number_format($venta->total, 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="text-align: center; color: #71717a; padding: 3rem;">
                            No hay pedidos registrados en la base de datos todavía.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>