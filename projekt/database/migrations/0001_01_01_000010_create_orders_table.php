<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->decimal('total_price', 8, 2);
            $table->date('order_date');
            
            $table->string('shipment_method');
            $table->string('payment_method');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('city');
            $table->string('address');
            $table->string('postal_code');
            $table->string('phone_number');
            $table->string('email');
            $table->string('status')->default('pending');

            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
