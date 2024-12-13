<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCreatedIdToPlatformsTable extends Migration
{
    public function up()
    {
        Schema::table('platforms', function (Blueprint $table) {
            $table->foreignId('created_id')->constrained('createds')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('platforms', function (Blueprint $table) {
            $table->dropForeign(['created_id']); 
            $table->dropColumn('created_id');   
        });
    }
}
