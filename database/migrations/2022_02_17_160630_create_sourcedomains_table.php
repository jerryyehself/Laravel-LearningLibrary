<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSourcedomainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sourcedomains', function (Blueprint $table) {
            $table->increments('id');
            $table->string('domain_url', 127)->unique();
            $table->string('domain_name', 64)->unique();
            $table->string('domain_api', 127)->nullable()->unique();
            $table->string('domain_logo', 127)->nullable()->unique();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
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
        Schema::dropIfExists('sourcedomains');
    }
}
