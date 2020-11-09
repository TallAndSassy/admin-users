<?php

namespace TallModSassy\AdminUsers\Http\Livewire;

use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Illuminate\Support\Facades\DB;
use Mediconesystems\LivewireDatatables\DateColumn;
use \Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\CustomColumn;

class UsersTable extends LivewireDatatable
{
    public $model = \App\Models\User::class;

    public function columns()
    {
        $me = $this;
        return [
            Column::name('name')
                ->label('Person')
                ->searchable()
            ,
            Column::Callback(['name','email', 'id'],
                function(string $value, string $email, int $id) use ($me): string {
                    #return "<div>$value</div>";
                    $maybeHighlightedValue = $me->highlightStringWithCurrentSearchTerm($value);
                    #return $maybeHighlightedValue;
                    $maybeHighlightedValue = $value;
                    $asrRow = [];
                    $asrRow['id'] = $id;
                    $asrRow['name'] = $value;
                    $asrRow['email'] = $email;
                    #$asrRow['email_verified_at'] =$email_verified_at;
                    #$asrRow['profile_photo_url'] =$profile_photo_url;
                    return view('tassy::users-page-table-cell', ['value'=>$value, 'maybeHighlightedValue'=>$maybeHighlightedValue,  'id'=>$id, 'asrRow'=>$asrRow])->render();
                })
                ->label('Modal Person')
                ->searchable()
            ,
            Column::Callback(
                'email',
                function (string $value) use ($me): string {
                    $maybeHighlightedValue = $me->highlightStringWithCurrentSearchTerm($value);
                    return "<a href='mailto:$value'>$maybeHighlightedValue</a>";
                })
                ->searchable()
            ,

            DateColumn::raw('created_at')
                ->label('Created On')
                ->format('jS F, Y')
                ->searchable(),

        ];
    }
}
