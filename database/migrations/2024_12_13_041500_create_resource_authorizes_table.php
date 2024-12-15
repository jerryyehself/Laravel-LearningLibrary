<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResourceAuthorizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resource_authorizes', function (Blueprint $table) {
            $table->id();
            $table->string('resource_domain_url', 128)->comment('資源網域url');
            $table->string('resource_domain_name', 64)->nullable()->comment('資源網域名稱');
            $table->text('resource_domain_note')->nullable()->comment('資源網域註記');
            $table->tinyInteger('resource_domain_status')->default(1)->comment('資源網域狀態');
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
        Schema::dropIfExists('resource_authorizes');
    }
}
