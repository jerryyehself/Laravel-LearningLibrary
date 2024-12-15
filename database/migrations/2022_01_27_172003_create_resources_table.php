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
            $table->foreignId('resource_domain_id')->nullable()->comment('來源網域id');
            $table->string('resource_title', 128)->nullable()->comment('資源名稱');
            $table->text('resource_note')->nullable()->comment('資源附註');
            $table->string('resource_location', 128)->nullable()->comment('資源uri參數');
            $table->string('resource_content_language', 32)->default('eng')->comment('資源語言');
            $table->smallInteger('resource_status')->default(1)->comment('資源狀態');
            $table->timestamp('resource_creation_date')->nullable()->comment('資源內容建立時間');
            $table->timestamp('resource_updated_date')->nullable()->comment('資源內容最後更新時間');
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
        Schema::dropIfExists('resources');
    }
}
