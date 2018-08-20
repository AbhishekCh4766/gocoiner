<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_items', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->unsignedInteger('parent_id')->default(0);
            $table->boolean('active')->default(true);
            $table->string('name');
            $table->unsignedInteger('order')->default(0);
            $table->text('link')->nullable();
            $table->boolean('nofollow')->default(false);
            $table->boolean('target_blank')->default(false);
            $table->unsignedInteger('page_id')->nullable();
            $table->timestamps();

            $table->foreign('page_id')
                ->references('id')
                ->on('pages')
                ->onDelete('set null');

            $table->index(['active', 'parent_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_items');
    }
}
