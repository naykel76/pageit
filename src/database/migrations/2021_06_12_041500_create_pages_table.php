<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('pages')) {
            Schema::create('pages', function (Blueprint $table) {
                $table->id();
                $table->string('slug')->unique()->nullable();
                $table->string('title');
                $table->boolean('show_title')->default(true);
                $table->string('headline')->nullable();
                $table->longText('description')->nullable();
                $table->longText('body')->nullable();
                $table->string('image_name')->nullable();
                $table->string('thumbnail')->nullable();
                $table->string('template')->nullable();
                $table->string('layout_type')->nullable();
                $table->integer('order')->nullable()->default(0);
                $table->dateTime('published_at')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
