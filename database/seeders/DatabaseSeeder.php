<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Creamos el usuario con rol Gerente
        $gerente = User::create([
            'name' => 'Gerente de Tienda',
            'email' => 'gerente@tienda.com',
            'username' => 'gerente1',
            'password' => Hash::make('password'), // Contraseña: password
            'rol' => 'gerente',
        ]);

        // 2. Creamos un usuario de prueba común (Cliente)
        $cliente = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'username' => 'testuser',
            'password' => Hash::make('password'),
            'rol' => 'usuario',
        ]);

        // 3. Creamos el pedido de prueba incluyendo el campo 'detalles' que pide tu base de datos
        DB::table('pedidos')->insert([
            'user_id' => $cliente->id,
            'total' => 120000,
            'detalles' => 'Compra de prueba de pantalones baggy', // <-- CORRECCIÓN: Agregamos este campo obligatorio
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}