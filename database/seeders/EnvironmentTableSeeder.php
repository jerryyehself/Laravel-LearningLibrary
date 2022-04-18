<?php

namespace Database\Seeders;

use App\Models\Problemmodels\Environment;
use Illuminate\Database\Seeder;

class EnvironmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $target = new Environment;
        $target->environment_name = 'Docker';
        $target->save();
    }
}
