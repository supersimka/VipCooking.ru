<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\HomeRepository;

class HomeComposer
{
    protected $home;

    public function __construct(HomeRepository $home)
    {
        $this->home = $home;
    }

    public function compose(View $view)
    {
        $view->with('home', $this->home->get_info());
    }
}
