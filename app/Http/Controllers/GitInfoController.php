<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class GitInfoController extends Controller
{
    public function getReposInfo()
    {
        $repos = Http::withToken('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')
            ->get('https://api.github.com/user/repos')
            ->json();

        $data = collect($repos)->where('private', false)->map(function ($repo) {
            if ($repo['name'] != 'jerryyehself')
                return Arr::only($repo, ['html_url', 'name']);
        });

        return $data;
    }
}
