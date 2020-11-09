<?php

namespace TallModSassy\AdminUsers\Http\Livewire;

use Livewire\Component;

class UserValueWithShallowModal extends Component
{
    public string $value;
    public string $valueLabel = 'Name';
    public int $db_id;
    public string $maybeHighlightedValue; // might be html with search term highlighted
    public array $asrRow;

    public bool $showingModal = false;

    public function mount(string $value, int $id, string $maybeHighlightedValue = 'dub', $asrRow)
    {
        $this->value = $value;
        $this->db_id = $id;
        $this->maybeHighlightedValue = $maybeHighlightedValue;
        $this->asrRow = $asrRow;

    }

    public function doModalPrimary()
    {
        // Do something $this->count = $this->count + 5;

        // Close dialog
        $this->showingModal = false; // FYI: This is wire's way of closing the modal, since
    }


    public function render()
    {
        return view('tassy::livewire.user-value-with-shallow-modal');
    }
}
