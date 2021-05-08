<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Home extends Component
{
    public $subCategory;

    public function mount()
    {
        $this->subCategory = collect([
            [
                'id' => 1,
                'name' => 'Biscuit',
                'selected' => true
            ],
            [
                'id' => 1,
                'name' => 'Chocolate',
                'selected' => false
            ],
            [
                'id' => 1,
                'name' => 'Wafer',
                'selected' => true
            ],
        ]);
    }

    public function loadSelected()
    {
        $this->subCategory[0]['selected'] = true;
        $this->subCategory[2]['selected'] = true;
    }

    public function render()
    {
        return view('livewire.home');
    }
}
