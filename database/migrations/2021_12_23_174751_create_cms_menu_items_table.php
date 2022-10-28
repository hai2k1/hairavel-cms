<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsMenuItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_menu_items', function (Blueprint $table) {
            $table->increments('item_id');
            $table->integer('parent_id')->nullable()->index('parent_id')->comment('parent_id');
            $table->integer('menu_id')->default(0)->index('menu_id')->comment('menu_id');
            $table->char('name', 50)->nullable()->comment('menu name');
            $table->string('url', 255)->nullable()->comment('menu link');
            $table->integer('_lft')->default(0);
            $table->integer('_rgt')->default(0);
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
        Schema::dropIfExists('cms_menu_items');
    }
}
