<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->constrained('invoices')->onDelete('cascade'); // Relacion con la tabla de facturas
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // Relacion con la tabla de productos
            $table->integer('quantity');
            $table->decimal('price', 10, 2); // Para almacenar precios con decimales
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('details');
    }
};