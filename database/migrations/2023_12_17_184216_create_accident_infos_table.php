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
        Schema::create('accident_infos', function (Blueprint $table) {
            $table->foreignId('accident_id')
                ->primary()
                ->constrained()
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->jsonb('info');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accident_infos');
    }
};
