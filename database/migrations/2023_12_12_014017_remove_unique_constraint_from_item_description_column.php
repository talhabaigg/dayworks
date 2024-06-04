<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('item_master_data', function (Blueprint $table) {
            $table->dropUnique('item_master_data_item_description_unique');
        });
    }

    public function down()
    {
        // This is optional and can be used to rollback the changes if needed
        Schema::table('item_master_data', function (Blueprint $table) {
            $table->unique('item_description');
        });
    }
};
