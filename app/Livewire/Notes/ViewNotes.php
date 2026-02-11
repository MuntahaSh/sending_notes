<?php

namespace App\Livewire\Notes;

use App\Models\Notes;
use Livewire\Component;

class ViewNotes extends Component
{
    public Notes $note;
    public $noteTitle;
    public $noteBody;
    public $noteSendDate;
    public $noteRecipient;
    public $noteIsPublished;

    public function mount(Notes $note)
    {
        // $this->authorize('view', $note);     // this for Notepolicy

        $this->note = $note;
        $this->noteTitle = $note->title;
        $this->noteBody = $note->body;
        $this->noteSendDate = \Carbon\Carbon::parse($note->send_date)->format('Y-m-d\TH:i');
        $this->noteRecipient = $note->recipient;
        $this->noteIsPublished = $note->is_published;
    }


    public function render()
    {
        return view('livewire.notes.view-notes');
    }
}
