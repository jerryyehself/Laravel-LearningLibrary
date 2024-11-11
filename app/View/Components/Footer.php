<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Footer extends Component
{
    public $rightSign;

    public $author = 'Jerry Yeh';
    public $email = 'jerry40522@gmail.com';
    public $footerLinks = [
        'github' => [
            'icon' => 'github',
            'url' => 'https://github.com/jerryyehself'
        ],
        'instagram' => [
            'icon' => 'instagram',
            'url' => 'https://www.instagram.com/jerry29_new_life/'
        ],
        'gmail' => [
            'icon' => 'envelope',
            'url' => 'mailto:jerry40522@gmail.com'
        ],
    ];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct() {}

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.footer');
    }

    public function rightSign()
    {
        return "© " . now()->year . " {$this->author} ({$this->email}). All rights reserved.";
    }
}
