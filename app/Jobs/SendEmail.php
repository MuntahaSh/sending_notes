<?php

namespace App\Jobs;

use App\Models\Notes;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendEmail implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public Notes $note)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    { //config(APP_URL) in the .env file
        $noteUrl = config('app.url') . '/notes/' . $this->note->id;
        $emailContent = "Hello,You have received a new note . view it here: {$noteUrl}";
        Mail::raw($emailContent, function ($message) {
            $message->from('sendnotes@muntaha.co', 'Notes App')
                ->to($this->note->recipient)
                ->subject('You have a new note from ' . $this->note->user->name);
        });
    }
}
