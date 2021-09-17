<?php

namespace App\Http\View\Composers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AppComposer
{
    public function compose(View $view)
    {
        $view
            ->with('user', Auth::user());

    }
}
