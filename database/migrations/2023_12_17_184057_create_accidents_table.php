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
        Schema::create('accidents', function (Blueprint $table) {
            $table->id();
            $table->string('quadkey', 24)
                ->collation("C") // use COLLATE "C" for quadkey
                ->index();
            $table->string('lonlat1', 12)->nullable()->index();
            $table->decimal('latitude', 9, 6)->nullable()->index();
            $table->decimal('longitude', 9, 6)->nullable()->index();
            $table->foreignId('severity_id')->index()->constrained()->onUpdate('cascade');
            $table->unsignedSmallInteger('year')->index();
            $table->dateTime('datetime')->index();
            $table->foreignId('region_id')->index()->constrained()->onUpdate('cascade');
            $table->foreignId('subregion_id')->index()->constrained()->onUpdate('cascade');
            $table->foreignId('accident_category_id')->index()->constrained()->onUpdate('cascade');

            // statistics and charts columns
            $table->unsignedInteger('dead_count')->nullable();
            $table->unsignedInteger('injured_count')->nullable();
            $table->unsignedInteger('participants_count')->nullable();
            $table->foreignId('light_conditions_id')->index()->constrained()->onUpdate('cascade');

            // group by columns
            $table->string('year-month',8)->index();
            $table->unsignedTinyInteger('weekday')->index();
            $table->unsignedTinyInteger('hour')->index();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accidents');
    }
};
