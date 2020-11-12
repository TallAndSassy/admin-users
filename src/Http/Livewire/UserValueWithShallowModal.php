<?php

namespace TallModSassy\AdminUsers\Http\Livewire;

use Livewire\Component;

class UserValueWithShallowModal extends Component
{
    public \App\Models\User $user;
    protected $rules = [
        'user.name' =>  'required|string|min:2|max:256',
        'user.email' => 'required|string|max:512|email',
    ];
    public int $db_id;
    public string $maybeHighlightedValue; // might be html with search term highlighted

    private array $enumStates = ['editing','reading'];
    public string $isInState = 'reading';
    public bool $showingModal = false;
    public bool $canUpdate = true;


    public function mount(string $value, int $id, string $maybeHighlightedValue = 'dub', $asrRow)
    {
        #$this->value = $value;
        $this->db_id = $id;
        $this->maybeHighlightedValue = $maybeHighlightedValue;
        #$this->asrRow = $asrRow;
        $this->user = \App\Models\User::find($this->db_id);
        assert($this->user,__FILE__.__LINE__);
    }


    public function showModal(\MattLibera\LivewireFlash\Livewire\FlashMessage $f) {
        $this->showingModal = true;
        $this->isInState = 'reading';
        session()->forget('flash_notification');
    }

    public function closeModal() {
        $this->showingModal = false;
    }


    public function moveToState(string $enumNewState) {
        assert(in_array($enumNewState, $this->enumStates),__FILE__.__LINE__);
        assert($enumNewState != $this->isInState,__FILE__.__LINE__);
        $this->isInState = $enumNewState;
    }

    public function updated($propertyName)
    {
        $this->canUpdate = false;
        $b = $this->validateOnly($propertyName); // validate on change, but
        $this->canUpdate = true; // Execution doesn't reach here if validation fails.
    }

    public function update()
    {
        $validatedData = $this->validate();
        // Execution doesn't reach here if validation fails.

        $flight = \App\Models\User::find($this->db_id);
        $flight->name = $validatedData['user']['name'];
        $flight->email = $validatedData['user']['email'];
        $b = false;
        $b = $flight->save();
        if (!$b) {
            flash('Ouch: Nothing was saved for '.$flight->getOriginal('name') )->error()->livewire($this);
        } else {
            $this->isInState = 'reading';
            flash('Successfully Updated '.$this->user->name)->success()->livewire($this);
        }
    }

    public function render()
    {
        return view('tassy::livewire.user-value-with-shallow-modal');
    }
}
