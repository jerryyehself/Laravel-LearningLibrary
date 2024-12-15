<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstantiationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instantiations', function (Blueprint $table) {
            $table->id();
            $table->morphs('instantiated');
            $table->string('instance_type', 32)->comment('實例化類型');
            $table->smallInteger('instance_id')->comment('實例化客體id');
            $table->smallInteger('sort_info')->nullable()->comment('排序資訊');
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
        Schema::dropIfExists('instantiations');
    }
}
