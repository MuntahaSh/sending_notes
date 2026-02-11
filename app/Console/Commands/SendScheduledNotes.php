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
        $notes = Notes::where('is_published', true)
            ->where('send_date', $now->toDateString())
            ->get();

        $noteCount = $notes->count();
        $this->info("sending {$noteCount} notes .");

        foreach ($notes as $note) {
            SendEmail::dispatch($note);
        }
    }
}
