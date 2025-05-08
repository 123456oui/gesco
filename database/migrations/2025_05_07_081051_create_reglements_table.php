<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReglementsTable extends Migration
{
    public function up(): void
    {
        Schema::create('reglements', function (Blueprint $table) {
            $table->id();
            $table->string('id_eleve', 255)->collation('utf8mb4_0900_ai_ci');
            $table->Integer('id_banque');
            $table->double('montant');
            $table->double('cumule');
            $table->timestamps();

            $table->foreign('id_eleve')
                ->references('Matricule')
                ->on('eleves')
                ->onDelete('cascade');

            $table->foreign('id_banque')
                ->references('id')
                ->on('banques')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('reglements');
    }
}

