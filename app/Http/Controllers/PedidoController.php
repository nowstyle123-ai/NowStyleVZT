<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PedidoController extends Controller
{
    public function guardar(Request $request)
    {
        // 1. Validamos solo lo que sí tenemos en la base de datos
        $request->validate([
            'detalles' => 'required|string',
            'total' => 'required|numeric',
        ]);

        try {
            // PROTECCIÓN: Si el usuario no está logueado, frena el proceso antes de tocar la BD
            if (!auth()->check()) {
                return response()->json([
                    'success' => false,
                    'error' => 'Debes iniciar sesión para realizar un pedido.'
                ], 401);
            }

            $rutasImagenes = [];

            // 2. Procesar imágenes múltiples dinámicas (disenos_{id}[])
            foreach ($request->allFiles() as $key => $files) {
                if (str_starts_with($key, 'disenos_')) {
                    $fileArray = is_array($files) ? $files : [$files];
                    foreach ($fileArray as $file) {
                        if ($file->isValid()) {
                            $ruta = $file->store('disenos', 'public');
                            $rutasImagenes[] = $ruta;
                        }
                    }
                }
            }

            $stringRutas = !empty($rutasImagenes) ? implode(',', $rutasImagenes) : null;

            // 3. Creamos el registro usando EXACTAMENTE tus columnas actuales
            Pedido::create([
                'user_id'       => auth()->id(),
                'detalles'      => $request->input('detalles'),
                'diseno_imagen' => $stringRutas, 
                'total'         => $request->input('total'),
                'estado'        => 'pendiente', // Se guarda como pendiente para el empleado
            ]);

            return response()->json([
                'success' => true,
                'mensaje' => '¡Pedido guardado correctamente!',
            ]);

        } catch (\Exception $e) {
            // Si algo falla, esto se escribirá en storage/logs/laravel.log
            Log::error("Error crítico en PedidoController: " . $e->getMessage());

            return response()->json([
                'success' => false,
                'error' => 'Error interno: ' . $e->getMessage()
            ], 500);
        }
    }

    public function misPedidos()
    {
        $pedidos = Pedido::where('user_id', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('Usuario.pedidos', compact('pedidos'));
    }
    public function updateEstado(Request $request, $id)
    {
        // 1. Validamos que el estado sea uno de los permitidos
        $request->validate([
            'estado' => 'required|in:pendiente,completado',
        ]);

        // 2. Buscamos el pedido en la base de datos
        $pedido = Pedido::findOrFail($id);

        // 3. Actualizamos el estado
        $pedido->estado = $request->estado;
        $pedido->save();

        // 4. Regresamos al dashboard con un mensaje de éxito
        return redirect()->back()->with('success', '¡Estado actualizado correctamente!');
    }
}