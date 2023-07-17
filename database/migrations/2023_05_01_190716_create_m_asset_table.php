<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('m_asset', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->string('asset_name');
            $table->string('asset_detail');
            $table->string('asset_pict')->nullable();
            $table->unsignedBigInteger('used_by')->nullable();
            $table->unsignedBigInteger('rent_by')->nullable();
            $table->boolean('is_available')->default(false);
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('m_category_asset');
            $table->foreign('used_by')->references('id')->on('users');
            $table->foreign('rent_by')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('m_asset');
    }
};
