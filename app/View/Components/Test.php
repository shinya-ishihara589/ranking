<?php

namespace App\View\Components;

use App\Helpers\EmailHelper;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cookie;

class Test extends Component
{
    public $param;
    /**
     * Create a new component instance.
     */
    public function __construct($email, $param)
    {
        $email = "username@domain.com";

        $this->param = $param;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.test');
    }
}
