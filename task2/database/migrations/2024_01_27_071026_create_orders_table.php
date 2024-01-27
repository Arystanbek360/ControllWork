<?php

use App\Models\Order;
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
            $table->foreignId('acquiring_client_id')->constrained('acquiring_clients');
            $table->string('order_number')->unique();
            $table->json('data');
            $table->enum('status', ['paid', 'waiting', 'failed'])->default(Order::STATUS_WAITING);
            $table->json('card');
            $table->timestamp('date');
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
