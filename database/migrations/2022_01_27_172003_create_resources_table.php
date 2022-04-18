<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->foreignId('domain_id');
            $table->string('title', 128);
            $table->string('location', 128);
            $table->string('content_language', 32);
            $table->timestamp('creation_date');
            $table->timestamp('last_answer_date');
            // $table->text('note')->nullable();
            $table->integer('usage')->default(1);
            //$table->boolean('useful')->default(1);
            $table->softDeletes();
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
