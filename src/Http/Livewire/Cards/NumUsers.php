<?php

namespace TallModSassy\AdminUsers\Http\Livewire\Cards;

class NumUsers extends \TallAndSassy\AppThemeBaseAdmin\Http\Livewire\Cards\SimpleStat
{
    public static string $viewRef = 'tassy::cards.num-users';

    public string $title = "Number of users";

    public function render()
    {
        $this->value = view(
            "tassy::components.ui.looks.link-to",
            [
                'href' => '/admin/people/users',  // Future Nice to Do: Make this be LePage compatible for fast loading
                'slot' => \App\Models\User::count(),
                'attributes' => new \Illuminate\Support\Collection()
            ]
        )->render();
        return parent::render();
    }

}
