<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->string('fullname');
            $table->string('email');
            $table->string('phone');
            $table->text('address');
            $table->text('note');
            $table->enum('status', [1, 2, 3, 4])->default(1);

            $table->integer('discount')->default(0);
            $table->double('total_money')->default(0);

            $table->timestamp('delivered_date')->nullable();
            $table->foreignId('user_id')->constrained('users');

            $table->json('coupon_info')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
