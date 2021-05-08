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
            [
                'id' => 4,
                'name' => 'Wafer',
                'selected' => false
            ],
            [
                'id' => 5,
                'name' => 'Wafer',
                'selected' => false
            ],
            [
                'id' => 6,
                'name' => 'Wafer',
                'selected' => false
            ],
            [
                'id' => 7,
                'name' => 'Wafer',
                'selected' => false
            ],
            [
                'id' => 8,
                'name' => 'Wafer',
                'selected' => false
            ],
            [
                'id' => 9,
                'name' => 'Wafer',
                'selected' => false
            ],
            [
                'id' => 10,
                'name' => 'Wafer',
                'selected' => false
            ],
            [
                'id' => 11,
                'name' => 'Wafer',
                'selected' => false
            ],
            [
                'id' => 12,
                'name' => 'Wafer',
                'selected' => false
            ],
            [
                'id' => 13,
                'name' => 'Wafer',
                'selected' => false
            ],
        ]);
    }

    public function loadSelected()
    {
        //$this->subCategory[0]['selected'] = true;
        //$this->subCategory[2]['selected'] = true;
        //dd($this->subCategory[0]);
        $this->dispatchBrowserEvent('editing', ['selected' => [$this->subCategory[0]['id'], $this->subCategory[2]['id']] ]);
    }

    public function loadAnother()
    {
        $this->dispatchBrowserEvent('editing', ['selected' => [$this->subCategory[1]['id']] ]);
    }

    public function removeTag()
    {
        //array_diff($this->selected, [id]);
        dd($this->selected);
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
