<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('master_item_kategori_item', function (Blueprint $table) {
            $table->foreignId('master_item_id')->constrained('master_items');
            $table->foreignId('kategori_items_id')->constrained('kategori_items');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('master_item_kategori_item');
    }
};
