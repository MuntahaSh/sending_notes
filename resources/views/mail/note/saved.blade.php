<x-mail::message>
    # Introduction

    Your Message is created and will be sent at specified send date !
    click to button below to show all your messages

    <x-mail::button :url="'{{ route('notes.index') }}'">
        SHOW
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>