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
    Schema::table('reglements', function (Blueprint $table) {
        $table->string('ticketbanque')->nullable()->after('montant'); // ajuste le champ précédent si besoin
    });
}

public function down()
{
    Schema::table('reglements', function (Blueprint $table) {
        $table->dropColumn('ticketbanque');
    });
}

};
