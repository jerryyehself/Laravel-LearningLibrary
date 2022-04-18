<?php

namespace Database\Seeders;

use App\Models\Problemmodels\Framework;
use Illuminate\Database\Seeder;

class FrameworkTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $target = new Framework;
        $target->framework_name = 'Laravel';
        $target->save();
    }
}
