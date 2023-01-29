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
        if (!Schema::hasTable('page_blocks')) {
            Schema::create('page_blocks', function (Blueprint $table) {
                $table->id();
                $table->string('title')->nullable();
                $table->text('body');
                $table->text('zzzzzzzzzz')->nullable();
                $table->string('type');
                $table->foreignId('page_id')->on('pages');
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
        Schema::dropIfExists('page_blocks');
    }
};
