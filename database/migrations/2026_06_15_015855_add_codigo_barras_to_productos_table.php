<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('productos', function (Blueprint $table) {
        // Guardamos el código como string porque puede empezar con 0 y no queremos que se borre
        $table->string('codigo_barras')->unique()->nullable()->after('id');
    });
}

public function down()
{
    Schema::table('productos', function (Blueprint $table) {
        $table->dropColumn('codigo_barras');
    });
}
};
