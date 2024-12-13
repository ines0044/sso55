<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePlatformsTableMakeNameUnique extends Migration
{
    public function up()
    {
        Schema::table('platforms', function (Blueprint $table) {
            $table->string('name')->unique()->change();
        });
    }

    public function down()
    {
        Schema::table('platforms', function (Blueprint $table) {
            $table->string('name')->change(); // Retirer l'unicité si nécessaire
        });
    }
}
