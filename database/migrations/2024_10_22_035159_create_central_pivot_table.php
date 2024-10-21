<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCentralPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('central_pivot', function (Blueprint $table) {
            $table->id();
            $table->string('subject')->comment('關聯主詞');
            $table->string('subject_id')->comment('關聯主詞id');
            $table->string('object')->comment('關聯客詞');
            $table->string('object_id')->comment('關聯客詞id');

            $table->timestamps();
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
        Schema::dropIfExists('central_pivot');
    }
}
