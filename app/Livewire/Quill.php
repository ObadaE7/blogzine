<?php

namespace App\Livewire;

use Livewire\Component;

class Quill extends Component
{
    public $value;
    public $quillId;

    public function render()
    {
        return view('livewire.quill');
    }

    public function mount($value = '')
    {
        $this->value = $value;
        $this->quillId = 'quill-' . uniqid();
    }

    public function updatedValue($value)
    {
        $this->dispatch('quill-updated-value', $this->value);
    }
}
