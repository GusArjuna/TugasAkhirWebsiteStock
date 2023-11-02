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
        Schema::create('fsntables', function (Blueprint $table) {
            $table->id();
            $table->String('kodeMaterial');
            $table->String('namaMaterial');
            $table->String('lokasi');
            $table->String('satuan');
            $table->String('peruntukan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fsntables');
    }
};
