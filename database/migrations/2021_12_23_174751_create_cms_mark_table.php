<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsMarkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_mark', function (Blueprint $table) {
            $table->increments('mark_id');
            $table->char('name', 255)->nullable()->comment('name');
            $table->char('type', 20)->comment('type');
            $table->text('content')->nullable()->comment('content');
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
        Schema::dropIfExists('cms_mark');
    }
}
