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
        Schema::create('table_certifs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tag_id')->unsigned();
            $table->string('title')->unique();
            $table->date('date');
            $table->text('goals')->nullable();
            $table->string('url')->nullable();
            $table->timestamps();

            $table->foreign('tag_id')
                        ->references('id')
                        ->on('table_tags')
                        ->restrictOnDelete()
                        ->restrictOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_certifs');
    }
};
