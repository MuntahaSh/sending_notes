<?php

use Livewire\Volt\Component;
use App\Models\Notes;
use Livewire\Attributes\Layout;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\Title;

new #[Layout('layouts.app')]class extends Component
{
    public Notes $note;

    public $noteTitle;
    public $noteBody;
    public $noteSendDate;
    public $noteRecipient;
    public $noteIsPublished;

    public function mount(Notes $note)
    {
                $this->authorize('update', $note);     // this for Notepolicy

        $this->note = $note;
        $this->noteTitle = $note->title;
        $this->noteBody = $note->body;
        $this->noteSendDate = \Carbon\Carbon::parse($note->send_date)->format('Y-m-d');
        $this->noteRecipient = $note->recipient;
        $this->noteIsPublished = $note->is_published;

    }



    public function updateNote()
    {
        $this->validate([
            'noteTitle' => 'required|string|min:5',
            'noteBody' => 'required|string|min:20',
            'noteSendDate' => 'required|date',
            'noteRecipient' => 'required|email',


        ]);

        $this->note->update([
            'title' => $this->noteTitle,
            'body' => $this->noteBody,
            'recipient' => $this->noteRecipient,
            'send_date' => $this->noteSendDate,
            'is_published'=> $this->noteIsPublished,
        ]);



                  LivewireAlert::title('Your Note updated successfully !')
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
};
?>

@section('title', 'Edit Note: ' . $note->title)
<x-slot name="header">
    <a href="{{ route('notes.create') }}" class=" text-xl font-semibold text-gray-800 leading-tight">
        {{ __(' Update Note ') }} </a>
</x-slot>


<div class="min-h-screen  px-4 py-10 sm:px-6 lg:px-8">
    <div
        class="mx-auto w-full max-w-5xl rounded-[32px] bg-gradient-to-br from-[#9cbfd8] to-[#dfe5ea] p-6 shadow-2xl ring-1 ring-white/60 backdrop-blur sm:p-10">
        <div class="rounded-[28px]  px-6 sm:px-10">
            <h2 class="mb-8 text-center text-3xl font-semibold leading-tight text-[#1f3d4f] sm:text-left">Update Note
            </h2>
            <form wire:submit.prevent="updateNote" class="space-y-6 text-[#1f3d4f]">
                @csrf
                <div>
                    <x-label for="title" value="Note Title" />
                    <input wire:model="noteTitle" id="title" type="text"
                        class="mt-2 block w-full rounded-2xl border border-[#c9e3ef] bg-white px-4 py-3 shadow-sm transition focus:border-[#54abd6] focus:ring-[#54abd6] @error('noteTitle') border-rose-400 @enderror" />
                    @error('noteTitle') <p class="mt-1 text-sm text-rose-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <x-label for="body" value="Your Note" />
                    <textarea wire:model="noteBody" id="body" rows="4" placeholder="Share all your thoughts..."
                        class="mt-2 block w-full rounded-2xl border border-[#c9e3ef] bg-white/90 px-4 py-3 shadow-sm focus:border-[#54abd6] focus:ring-[#54abd6] @error('noteBody') border-rose-400 @enderror"></textarea>
                    @error('noteBody') <p class="mt-1 text-sm text-rose-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <x-label for="recipient" value="Recipient" />
                    <div class="relative mt-2">
                        <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center ">
                            <i class="ri-mail-line"></i>
                        </span>
                        <input wire:model="noteRecipient" id="recipient" type="email" placeholder="friend@example.com"
                            class="block w-full rounded-2xl border border-[#c9e3ef] bg-white py-3 pl-11 pr-4 shadow-sm transition focus:border-[#54abd6] focus:ring-[#54abd6] @error('noteRecipient') border-rose-400 @enderror">
                    </div>
                    @error('noteRecipient') <p class="mt-1 text-sm text-rose-500">{{ $message }}</p> @enderror
                </div>

                <div class="flex flex-col gap-4 sm:flex-row">
                    <div class="flex-1">
                        <x-label for="send_date" value="Send Date" />
                        <input wire:model="noteSendDate" id="send_date" type="date"
                            class="mt-2 block w-full rounded-2xl border border-[#c9e3ef] bg-white/90 px-4 py-3 shadow-sm focus:border-[#54abd6] focus:ring-[#54abd6] @error('noteSendDate') border-rose-400 @enderror">
                        @error('noteSendDate') <p class="mt-1 text-sm text-rose-500">{{ $message }}</p> @enderror
                    </div>
                    <div class="flex-1">
                        <x-label for="is_published" value="Visibility" />
                        <div
                            class="mt-3 flex items-center gap-3 rounded-2xl border border-[#c9e3ef] bg-white/90 px-4 py-3 shadow-sm">
                            <x-checkbox id="is_published" wire:model="noteIsPublished" value="1"
                                class="text-[#54abd6] focus:ring-[#54abd6]" />
                            <div class="text-sm text-slate-600">
                                <p class="font-semibold text-[#1f3d4f]">Public note</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between items-center">
                    <a href="{{ route('notes.index') }}" wire:navigate
                        class="inline-flex items-center gap-2 text-sm font-semibold text-rose-700 hover:text-rose-900">
                        <i class="ri-arrow-left-line text-base"></i> Back to Notes
                    </a>
                    <x-button class="gap-2" wire:click.prevent="updateNote">
                        <i class="ri-calendar-schedule-line text-lg"></i>
                        <span wire:loading.remove>Update Note</span>
                        <span wire:loading>Updating...</span>
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</div>