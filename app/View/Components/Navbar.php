<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Request;
use Illuminate\View\Component;

class Navbar extends Component
{
    public $currentPage;
    public $title = '網頁開發學習資源資料庫';
    public $navBar = [
        '' => [
            'label' => '查詢資源',
            'url' => '/',
            'route' => 'home'
        ],
        'collections' => [
            'label' => '瀏覽資源',
            'url' => 'collections/',
            'route' => 'collections'
        ],
        'statics' => [
            'label' => '統計資料',
            'url' => 'statics/',
            'route' => 'statics'
        ],
        'setting' => [
            'label' => '相關設定',
            'url' => 'setting/',
            'route' => 'sourcesites.*'
        ]
    ];

    public $navClass = [
        'navbar',
        'navbar-expand-lg',
        'navbar-dark',
        'bg-dark',
        'primary-100'
    ];

    public $divClass = [
        'collapse',
        'navbar-collapse',
        'flex-row-reverse',
        'fs-4'
    ];

    public $buttonAttr = [
        'class' => 'navbar-toggler',
        'type' => 'button',
        'data-bs-toggle' => 'collapse',
        'data-bs-target' => '#navbarNav',
        'aria-controls' => 'navbarNav',
        'aria-expanded' => 'false',
        'aria-label' => 'Toggle navigation',
    ];
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($page = '')
    {
        collect($this)->map(function ($val, $member) {
            if (strstr($member, 'Class'))
                $this->{$member} = implode(' ', $val);
        });
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.navbar');
    }

    public function currentPage($page)
    {
        return Request::segment(1) != $page ?: 'active';
    }
}
