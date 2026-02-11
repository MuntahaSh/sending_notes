<?php

namespace App\Livewire\Notes;

use App\Models\Notes;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;

use Livewire\Component;


class ShowNotes extends Component
{

    public function with(): array
    {
        return [
            'notes' => Auth::user()->notes()->orderBy('send_date', 'asc')->get(),
        ];
    }

    public function delete($note_id)
    {

        $note = Notes::where('id', $note_id)->first();
        $this->authorize('delete', $note);     // this for Notepolicy


        $note->delete();
        LivewireAlert::title('Your Note deleted successfully !')
            ->withOptions([
                'width' => '400px',
                'hight' => '18px',
                'background' => '#9cbfd8',
            ])
            ->toast()
            ->position('top-end')
            ->show();
    }


    public function render()
    {
        return view(
            'livewire.notes.show-notes',
            $this->with(),
        );
    }
}
