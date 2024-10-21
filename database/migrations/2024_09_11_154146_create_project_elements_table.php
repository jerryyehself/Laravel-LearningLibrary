<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectElementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_elements', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id')->comment('專案id');
            $table->string('element_name')->comment('專案組成內容');
            $table->string('element_ver')->comment('組成內容版本')->nullable();
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
        Schema::dropIfExists('project_elements');
    }
}
