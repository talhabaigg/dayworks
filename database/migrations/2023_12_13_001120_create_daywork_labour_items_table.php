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
        Schema::create('daywork_labour_items', function (Blueprint $table) {
            $table->id(); // Auto-incremental primary key
            $table->foreignId('daywork_order_id')->constrained('daywork_orders'); // Foreign key referencing id on daywork_orders table
            $table->string('labour_name');
            $table->string('date'); // Assuming a string data type for item_code, adjust as needed
            $table->integer('qty');
            $table->decimal('rate', 10, 2); // Assuming a decimal data type for rate, adjust as needed
            $table->decimal('total', 10, 2); // Assuming a decimal data type for total, adjust as needed
            $table->timestamps(); // Created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daywork_labour_items');
    }
};
