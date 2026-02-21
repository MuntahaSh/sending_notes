<?php

namespace App\Console\Commands;

use App\Jobs\SendEmail;
use App\Models\Notes;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SendScheduledNotes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-scheduled-notes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();

        $notes = Notes::where('status', 'waiting')
            ->where('is_published', true)
            ->whereDate('send_date', '<=', $now)
            ->get();

        foreach ($notes as $note) {
            SendEmail::dispatch($note);

            $note->update([
                'status' => 'sent'
            ]);
        }
    }
}
