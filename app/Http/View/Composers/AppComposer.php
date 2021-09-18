<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;

class AppComposer
{
    public function compose(View $view)
    {
        $view
            ->with('user', app("auth")->user());

    }
}
