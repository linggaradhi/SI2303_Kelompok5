<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('shoes', function (Blueprint $table) {
            $table->dropColumn('layanan');
        });
    }
    public function down()
    {
        Schema::table('shoes', function (Blueprint $table) {
            $table->string('layanan')->nullable();
        });
    }
};
