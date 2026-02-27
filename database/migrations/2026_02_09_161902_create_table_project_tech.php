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
        Schema::create('table_project_tech', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id')->unsigned();
            $table->integer('tech_id')->unsigned();

            $table->foreign('project_id')->references('id')->on('table_projects')
                ->restrictOnDelete()
                ->restrictOnUpdate();
            $table->foreign('tech_id')->references('id')->on('table_techs')
                ->restrictOnDelete()
                ->restrictOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_project_tech');
    }
};
