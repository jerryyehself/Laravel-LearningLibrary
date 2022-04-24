<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Database\Eloquent\Relations\Relation;

use App\Models\Backgroundmodels\Project;
use App\Models\Languageusage;
use App\Models\Problemmodels\Environment;
use App\Models\Problemmodels\Language;
use App\Models\Problemmodels\Framework;
use App\Models\Problemmodels\Packagetool;
use Illuminate\Support\Facades\DB;

use App\Models\Resourcemodels\Resource;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (App::environment('production')) {
            URL::forceScheme('https');
        }

        DB::listen(function ($query) {

            $query->sql;
            $query->bindings;
            $query->time;
        });
    }
}
