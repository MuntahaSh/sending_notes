<?php

use Livewire\Volt\Component;
use App\Models\Notes;

new class extends Component {
    public Notes $note;
    public $heartCount;

    public function mount(Notes $note){
        $this->note=$note;
        $this->heartCount=$note->heart_count;
    }

public function increaseHeartCount()
{
    $this->note->increment('heart_count');
    $this->heartCount++;
}

}; ?>

<div
    class="inline-flex rounded-full border border-rose-200 bg-slate-100 px-3 py-1 text-sm font-semibold text-rose-700 shadow-sm">
    <button wire:click="increaseHeartCount"
        class="flex items-center gap-2 focus:outline-none focus-visible:ring focus-visible:ring-rose-400">
        <span>

            <i class="ri-heart-add-line text-base"></i>
        </span>
        <span class="tracking-wide">{{ $heartCount }}</span>
    </button>
</div>