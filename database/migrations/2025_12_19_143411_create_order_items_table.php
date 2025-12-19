<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();

            $table->foreignId('pizza_id')->nullable()->constrained()->nullOnDelete();

            $table->string('type'); // fixed|custom
            $table->string('name_snapshot');
            $table->integer('unit_price_minor');
            $table->integer('qty')->default(1);
            $table->integer('line_total_minor');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
