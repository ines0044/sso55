<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameClientIdToUsernameInPlatformsTable extends Migration
{
    public function up()
    {
        Schema::table('platforms', function (Blueprint $table) {
            $table->renameColumn('client_id', 'username');
        });
    }

    public function down()
    {
        Schema::table('platforms', function (Blueprint $table) {
            $table->renameColumn('username', 'client_id');
        });
    }
}
