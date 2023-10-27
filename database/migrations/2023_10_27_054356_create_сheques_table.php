<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cheques', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shop_id');
            $table->string('check_datetime');
            $table->integer('sum');
            $table->timestamps();

            //IDX
            $table->index('shop_id', 'сheques_shops_idx');

            // FK
            $table->foreign('shop_id', 'сheques_shops_fk')->on('shops')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('сheques');
    }
};
