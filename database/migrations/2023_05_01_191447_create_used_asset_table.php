<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('used_asset', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('asset_id');
            $table->unsignedBigInteger('used_by');
            $table->boolean('is_acc')->default(false);
            $table->unsignedBigInteger('acc_by')->nullable();
            $table->date('use_start_date');
            $table->timestamps();

            $table->foreign('used_by')->references('id')->on('users');
            $table->foreign('asset_id')->references('id')->on('m_asset');
            $table->foreign('acc_by')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('used_asset');
    }
};
