<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class GeolocationForm extends Component
{

    public $ipAddress;
    /**
     * Create a new component instance.
     */

    public function __construct($ipAddress = null)

    {

        $this->ipAddress = $ipAddress;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.geolocation-form', [
            'ipAddress' => $this->ipAddress,
        ]);
    }
}
