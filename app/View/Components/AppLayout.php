<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AppLayout extends Component
{
	/* Dynamic pageTitle is handled via @section directive in each views */
	
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('components.app-layout');
    }
}