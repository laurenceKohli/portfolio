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
        Schema::create('table_imgs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->unsigned();
            $table->string('img_path')->unique();
            $table->text('desc')->nullable();
            $table->timestamps();

            $table->foreign('project_id')
                        ->references('id')
                        ->on('table_projects')
                        ->restrictOnDelete()
                        ->restrictOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_imgs');
    }
};
