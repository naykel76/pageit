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
        if (!Schema::hasTable('pages')) {
            Schema::create('pages', function (Blueprint $table) {
                $table->id();
                $table->string('route_prefix')->nullable();
                $table->boolean('is_category')->nullable()->default(0);
                $table->string('title');
                $table->boolean('hide_title')->nullable()->default(0);
                $table->mediumText('headline')->nullable();
                $table->string('slug');
                $table->longText('body')->nullable();
                $table->string('image')->nullable();
                $table->string('type')->nullable();
                $table->string('layout')->nullable();
                $table->integer('sort_order')->nullable()->default(0);
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
};
