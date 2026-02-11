@section('title', 'Create a Note')

<div
    class="mx-auto w-full max-w-5xl rounded-[32px] shadow-2xl ring-1  bg-gradient-to-br from-[#9cbfd8] to-[#dfe5ea] ring-white/60 backdrop-blur    ">


    <!-- Form column -->
    <div class="rounded-b-[32px] px-10 py-12 lg:rounded-r-[32px] lg:rounded-bl-none">
        <h2 class="mb-8 text-3xl font-semibold leading-tight">Create Note</h2>
        <form wire:submit.prevent="save" class="space-y-6 text-[#1f3d4f]">
            @csrf
            <div>
                <x-label for="title" value="Note Title" />
                <input wire:model="noteTitle" id="title" type="text"
                    class="mt-2 block w-full rounded-2xl border border-[#c9e3ef] bg-white/90 px-4 py-3 shadow-sm focus:border-[#54abd6] focus:ring-[#54abd6] @error('noteTitle') border-rose-400 @enderror">
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
                    <span class="pointer-events-none absolute inset-y-0 left-4 flex items-center text-[#54abd6]">
                        <i class="ri-mail-line"></i>
                    </span>
                    <input wire:model="noteRecipient" id="recipient" type="email" placeholder="friend@example.com"
                        class="block w-full rounded-2xl border border-[#c9e3ef] bg-white/90 py-3 pl-11 pr-4 shadow-sm focus:border-[#54abd6] focus:ring-[#54abd6] @error('noteRecipient') border-rose-400 @enderror">
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
                        class="mt-3 flex items-center gap-3 rounded-2xl border border-[hsl(0,23%,71%)] bg-white/90 px-4 py-3 shadow-sm">
                        <x-checkbox id="is_published" wire:model="isPublished" value="1"
                            class="text-[#54abd6] focus:ring-[#54abd6]" />
                        <div class="text-sm text-slate-600">
                            <p class="font-semibold text-[#1f3d4f]">Public note</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex justify-end">
                <x-button class="gap-2 ">
                    <i class="ri-calendar-schedule-line text-lg"></i>
                    <span wire:loading.remove>Schedule Note</span>
                    <span wire:loading>Saving…</span>
                </x-button>
            </div>
        </form>
    </div>
</div>

</div>