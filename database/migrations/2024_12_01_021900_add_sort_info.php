<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSortInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('central_pivot', function (Blueprint $table) {
            $table->text('sort_info')->after('object_id')->nullable()->comment('排序資訊');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('central_pivot', function (Blueprint $table) {
            $table->removeColumn('sort_info');
        });
    }
}
