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
        Schema::create('table_formations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('school');
            $table->string('location');
            $table->text('desc')->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->string('url')->nullable();
            $table->timestamps(); 
            
            $table->unique(['title', 'start_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_formations');
    }
};
