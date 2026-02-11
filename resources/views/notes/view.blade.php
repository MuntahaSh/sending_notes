@section('title', 'View Note: ' . $note->title)
<x-guest-layout>
    <div class="min-h-screen bg-slate-50 px-4 py-20">
        <div class="space-y-8 w-full max-w-3xl mx-auto">
            <div
                class="w-full rounded-3xl bg-gradient-to-br  from-[#9cbfd8] to-[#dfe5ea] p-8 shadow-inner ring-1 ring-rose-100 ">
                <div class="flex items-start justify-between gap-4 ">
                    <div>
                        <h1 class="mt-1 text-2xl font-semibold text-slate-900">{{ $note->title }}</h1>
                        <p class="text-sm text-slate-500">
                            {{ \Carbon\Carbon::parse($note->send_date)->format('F j, Y') }}
                        </p>
                    </div>
                    <livewire:heartreact :note="$note" />
                </div>

                <div
                    class="mt-6 rounded-2xl border border-rose-100 bg-white/90 px-6 py-8 text-base leading-7 text-slate-700">
                    {!! nl2br(e($note->body)) !!}
                </div>

                <div class="mt-4 flex flex-col gap-2 text-sm text-slate-500 ">
                    <span class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-3 py-1">
                        <i class="ri-user-shared-line text-rose-700"></i> Sent from {{ $user->name }}
                    </span>
                    <span class="inline-flex items-center gap-2 rounded-full bg-slate-100 px-3 py-1">
                        <i class="ri-user-received-line text-rose-700"></i> Recipient: {{ $note->recipient }}
                    </span>
                </div>
            </div>

            <a href="{{ route('notes.index') }}" wire:navigate
                class="inline-flex items-center gap-2 text-sm font-semibold text-rose-700 hover:text-rose-900">
                <i class="ri-arrow-left-line text-base"></i> Back to Notes
            </a>
        </div>
    </div>
</x-guest-layout>