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
    if (!Schema::hasTable('movies')) {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->text('synopsis')->nullable();
            $table->foreignId('category_id')->constrained();
            $table->year('year');
            $table->text('actors')->nullable();
            $table->string('cover_image')->nullable();
            $table->timestamps();
        });
    }
}

     
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
