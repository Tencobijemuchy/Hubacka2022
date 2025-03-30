<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_type_id');
            $table->unsignedBigInteger('manufacturer_id'); // upravené na unsignedBigInteger
            $table->string('name')->unique();
            $table->string('description');

            $table->string('img1')->nullable();
            $table->string('img2')->nullable();
            $table->string('img3')->nullable();
            $table->string('img4')->nullable();
            $table->decimal('price', 6, 2);
            $table->timestamps();

            // Cudzie kľúče
            $table->foreign('product_type_id')
                ->references('id')->on('product_types')
                ->onDelete('cascade');

            $table->foreign('manufacturer_id')
                ->references('id')->on('manufacturers')
                ->onDelete('cascade'); // voliteľne môžeš zmeniť aj na set null
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

