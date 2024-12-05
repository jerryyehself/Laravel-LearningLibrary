<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResourcesInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resources_infos', function (Blueprint $table) {
            $table->id();
            $table->text('resource_type')->comment('資源類型');
            $table->text('resource_name')->nullable()->comment('資源類型');
            $table->text('resource_url')->comment('url');
            $table->text('resource_description')->nullable()->comment('說明');
            $table->smallInteger('resource_status')->default(1)->comment('資源狀態');
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
        Schema::dropIfExists('resources_infos');
    }
}
