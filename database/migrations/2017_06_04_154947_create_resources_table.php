<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resources', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('name')->unique();
            $table->string('url')->unique();
            $table->text('description');
            $table->boolean('is_published')->default(false);
            $table->timestamps();
        });

       Schema::table('resources', function($table) {
           $table->foreign('user_id')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
       });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resources');
    }
}
