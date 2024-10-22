<?php

namespace Panikka\LivewireAce;

use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class AceEditorBase extends Component
{
    public string $value = '';
    public string $mode = '';

    public function mount()
    {
    }

    public function render(): View
    {
        return view('livewire-ace::editor');
    }

    /**
     * Callback function to listen for value updates.
     */
    #[On('updateValue')]
    public function updatedValue(string $value): void
    {
        $this->value = $value;
    }
    
    public function updatedMode(string $mode): void
    {
        $this->mode = $mode;
        $this->dispatch('changeMode', $mode)->self();
    }
}
