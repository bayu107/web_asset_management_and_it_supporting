<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('report_trouble', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_report_id');
            $table->string('report_detail');
            $table->string('report_pict')->nullable();
            $table->unsignedBigInteger('report_by');
            $table->unsignedBigInteger('handle_by')->nullable();
            $table->boolean('isdone')->default(false);
            $table->timestamps();

            $table->foreign('category_report_id')->references('id')->on('m_category_report');
            $table->foreign('report_by')->references('id')->on('users');
            $table->foreign('handle_by')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('report_trouble');
    }
};
