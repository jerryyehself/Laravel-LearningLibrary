<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyModelTypeField extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('central_pivot', function (Blueprint $table) {
            $table->renameColumn('subject', 'subject_type');
            $table->renameColumn('object', 'object_type');
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
            $table->renameColumn('subject_type', 'subject');
            $table->renameColumn('object_type', 'object');
        });
    }
}
