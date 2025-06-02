<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('shoes', function (Blueprint $table) {
            $table->unsignedBigInteger('service_id')->after('order_id');
            $table->foreign('service_id')->references('id')->on('services');
        });
    }

    public function down()
    {
        Schema::table('shoes', function (Blueprint $table) {
            $table->dropForeign(['service_id']);
            $table->dropColumn('service_id');
        });
    }
};
