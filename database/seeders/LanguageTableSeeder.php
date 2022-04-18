<?php

namespace Database\Seeders;

use App\Models\Problemmodels\Language;
use Illuminate\Database\Seeder;

class LanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $target = new Language;
        $target->language_name = 'PHP';
        $target->save();
    }
}
