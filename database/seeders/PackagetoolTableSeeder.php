<?php

namespace Database\Seeders;

use App\Models\Problemmodels\Packagetool;
use Illuminate\Database\Seeder;

class PackagetoolTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $target = new Packagetool;
        $target->packagetool_name = 'jquery';
        $target->save();
    }
}
