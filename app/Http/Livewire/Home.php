<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Home extends Component
{
    public $subCategory, $validatedData, $selected = [];

    protected $rules = [
        'selected' => 'nullable',
    ];

    public function mount()
    {
        $this->subCategory = collect([
            [
                'id' => 1,
                'name' => 'Biscuit',
                'selected' => false
            ],
            [
                'id' => 2,
                'name' => 'Chocolate',
                'selected' => false
            ],
            [
                'id' => 3,
                'name' => 'Wafer',
                'selected' => false
            ],
        ]);
    }

    public function loadSelected()
    {
        $this->subCategory[0]['selected'] = true;
        $this->subCategory[2]['selected'] = true;
    }

    public function save()
    {
        $this->validatedData = $this->validate();
        dd($this->validatedData);
    }

    public function render()
    {
        return view('livewire.home');
    }
}
