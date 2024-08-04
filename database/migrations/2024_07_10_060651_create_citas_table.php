<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitasTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('citas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_paciente_citas')->constrained('pacientes');
            $table->foreignId('id_servicio_citas')->constrained('servicios');
            $table->date('fecha');
            $table->float('peso'); 
            $table->float('estatura'); 
            $table->float('temperatura'); 
            $table->float('frecuencia_cardiaca'); 
            $table->text('tension'); 
            $table->float('oxigeno'); 
            $table->text('motivo_consulta');
            $table->foreignId('id_producto_citas')->constrained('productos');
            $table->integer('cantidad');  
            $table->text('frecuencia'); 
            $table->text('duracion');
            $table->text('nota');
            $table->decimal('total', 8, 2);
            $table->enum('estado', ['No pagado', 'Pagado'])->default('No pagado');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('citas');
    }
}


