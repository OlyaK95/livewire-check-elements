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
        Schema::create("element_module_type", function (Blueprint $table) {
            $table->id();
            $table->foreignId("element_id")->constrained();
            $table->foreignId("module_type_id")->constrained();
            $table->integer("sort");
            $table->integer("quantity");
            $table->string("ref_des")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("element_module_type");
    }
};
