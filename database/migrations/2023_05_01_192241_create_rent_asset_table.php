<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('rent_asset', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('asset_id');
            $table->dateTime('rent_date');
            $table->dateTime('rent_due_date');
            $table->unsignedBigInteger('used_by');
            $table->timestamps();

            $table->foreign('asset_id')->references('id')->on('m_asset');
            $table->foreign('used_by')->references('id')->on('users');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('rent_asset');
    }
};
