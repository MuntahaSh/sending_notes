<?php

namespace App\Livewire\Notes;

use App\Mail\SavedNotes;
use App\Models\Notes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Create Note')]
class CreateNote extends Component
{
    public $noteTitle;
    public $noteBody;
    public $noteSendDate;
    public $noteRecipient;

    public function save()
    {
        $this->validate([
            'noteTitle' => 'required|string|min:5',
            'noteBody' => 'required|string|min:20',
            'noteSendDate' => 'required|date',
            'noteRecipient' => 'required|email'

        ]);

        $newNote = new Notes();
        $newNote::create([
            'title' => $this->noteTitle,
            'body' => $this->noteBody,
            'recipient' => $this->noteRecipient,
            'send_date' => $this->noteSendDate,
            'is_published' => true,
            'user_id' => request()->user()->id,
        ]);

        LivewireAlert::title('Note created successfully!')
            ->withOptions([
                'width' => '400px',
                'hight' => '18px',
                'background' => '#f3f4f6',



            ])
            ->toast()
            ->position('top-end')
            ->show();
        return redirect(route('notes.index'));
    }




    public function render()
    {
        return view('livewire.notes.create-note');
    }
}
