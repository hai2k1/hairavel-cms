<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsPageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_page', function (Blueprint $table) {
            $table->increments('page_id');
            $table->char('name', 50)->nullable()->comment('page name');
            $table->string('keywords')->nullable()->comment('page keywords');
            $table->string('description')->nullable()->comment('page description');
            $table->string('tpl')->nullable()->comment('template name');
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
        Schema::dropIfExists('cms_page');
    }
}
