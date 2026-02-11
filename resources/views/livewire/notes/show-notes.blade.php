<div class="pb-12">
    <div class="px-6">
        @if ($notes->isEmpty())
        <div class="text-center">
            <h2 class="text-xl font-bold">No notes available</h2>
            <p class="mt-4 text-gray-500 text-sm">You haven't created any notes yet. Start by adding a new note!</p>
            <x-button href="{{ route('notes.create') }}" wire:navigate
                class="mt-6 py-3 mx-auto text-gray-500  bg-[#54abd6] hover:bg-[#4298d7]  font-semibold ">
                Create Note
            </x-button>

        </div>



        @else
        <div class="flex items-end justify-end">
            <!-- Delete button -->
            <x-button href="{{ route('notes.create') }}" wire:navigate
                class="flex items-center justify-center w-8 h-8 rounded-full bg-gradient-to-r from-[#9cbfd8] to-[#dfe5ea]  transition">
                <i class="ri-add-large-line "></i>
            </x-button>

        </div>


        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-12 ">

            @foreach ($notes as $note)
            <div wire:key="note-{{ $note->id }}"
                class=" bg-gradient-to-r from-[#9cbfd8] to-[#dfe5ea] overflow-hidden shadow sm:rounded-lg">

                <!-- Card content -->
                <div class="p-6">
                    <div class="flex justify-between items-start ">
                        <a href="{{route('notes.edit',$note)}}" wire:navigate
                            class="text-xl font-bold text-gray-800 hover:underline hover:text-[#54abd6]">
                            {{ $note->title }}
                        </a>

                        <span class="text-sm text-gray-500">
                            {{ \Carbon\Carbon::parse($note->send_date)->format('d/m/Y') }}
                        </span>
                    </div>
                    <div class="mx-auto mt-4">
                        <p class="text-xs">{{Str::limit($note->body,30)}}</p>
                    </div>
                </div>


                <!-- Recipient & Actions -->
                <div class="flex items-center justify-between px-6 pb-4">
                    <p class="text-xs text-gray-600">
                        Recipient: <span class="font-semibold">{{ $note->recipient }}</span>
                    </p>

                    <div class="flex gap-3">
                        <!-- Eye button -->
                        <button
                            class="flex items-center justify-center w-8 h-8 rounded-full bg-gray-100 hover:bg-blue-100 text-blue-600 transition">
                            <a href="{{ route('notes.view', $note) }}"
                                class="flex items-center justify-center w-8 h-8 rounded-full bg-gray-100 hover:bg-blue-100 text-blue-600 transition">
                                <i class="ri-eye-line text-lg"></i>
                            </a>
                        </button>

                        <!-- Delete button -->
                        <button wire:click="delete('{{ $note->id }}')"
                            class="flex items-center justify-center w-8 h-8 rounded-full bg-gray-100 hover:bg-red-100 text-red-600 transition">
                            <i class="ri-delete-bin-6-line text-lg"></i>
                        </button>


                    </div>
                </div>

            </div>
            @endforeach


        </div>
        @endif
    </div>
</div>