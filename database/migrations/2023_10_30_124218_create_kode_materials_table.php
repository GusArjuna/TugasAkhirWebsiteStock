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
        Schema::create('kode_materials', function (Blueprint $table) {
            $table->id();
            $table->String('kodeMaterial')->unique();
            $table->String('namaMaterial');
            $table->String('satuan');
            $table->String('peruntukan');
            $table->String('stok')->nullable();
            $table->String('frekuensi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kode_materials');
    }
};
