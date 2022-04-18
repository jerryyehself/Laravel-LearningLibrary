<?php

namespace Database\Seeders;

use App\Models\Backgroundmodels\Sourcedomain;
use Illuminate\Database\Seeder;

class SourecdomainTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $target = new Sourcedomain;
        $target->domain_url = 'https://stackoverflow.com/';
        $target->domain_name = 'stackoverflow';
        $target->domain_logo = 'https://stackoverflow.design/assets/img/logos/so/logo-stackoverflow.svg';
        $target->save();
    }
}
