<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cook_recipes', function (Blueprint $table) {
            $table->id();
			$table->integer('id_user');
			$table->string('alias')->unique(); 
            $table->string('title')->unique();
			$table->string('preview');
			$table->text('introtext');
			$table->text('text');
			$table->integer('id_categories');
			$table->integer('id_child_categories');
			$table->integer('visible');			
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cook_recipes');
    }
};
