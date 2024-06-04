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
        Schema::create('daywork_orders', function (Blueprint $table) {
            $table->id(); // Auto-incremental primary key
            $table->string('daywork_order_date'); // Using string type for date column
            $table->foreignId('issued_by')->constrained('users'); // Foreign key referencing user_id on users table
            $table->foreignId('project_id')->constrained('projects'); // Foreign key referencing id on projects table
            $table->string('daywork_ref_no');
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daywork_orders');
    }
};
