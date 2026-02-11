{{-- this is blade file associataed with th route , copyed from dashboard.blade.php --}}
@section('title', 'Create Note')
<x-app-layout>
    <x-slot name="header">
        <a href="{{ route('notes.create') }}" class=" text-xl font-semibold text-gray-800 leading-tight">
            {{ __(' New Note ') }} </a>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8  ">

            <livewire:notes.create-note>


        </div>




    </div>
</x-app-layout>
