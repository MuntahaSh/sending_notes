<?php

use Livewire\Volt\Component;

new class extends Component {
    //pringing the information when the componant is rendered
    public function with(){
        $user = Auth::user();
        $today = today();

        return [
            'notesSentCount' => $user->notes()
                ->whereDate('send_date', '<', $today)
                ->where('is_published', true)
                ->count(),

            'notesUnSentCount' => $user->notes()
                ->whereDate('send_date', '>=', $today)
                ->count(),

            'notesLoveCount' => $user->notes->sum('heart_count'),
        ];

    }
}; ?>

<div>

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 md:grid-cols-3 mx-10 ">
        <div class=" p-6 rounded-lg shadow-lg dark:bg-gray-800 bg-gradient-to-r from-[#9cbfd8] to-[#dfe5ea]">
            <div class='flex items-center'>
                <div class="flex justify-between gap-2">
                    <i class="ri-mail-send-line text-xl"></i>
                    <p class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-100">

                        Notes Sent
                    </p>
                </div>
            </div>
            <div class="mt-6">
                <p class="text-3xl font-bold leading-9 text-gray-900 dark:text-gray-100">{{ $notesSentCount }}</p>
            </div>
        </div>

        <div class="p-6 bg-white rounded-lg shadow-lg dark:bg-gray-800 bg-gradient-to-r from-[#9cbfd8] to-[#dfe5ea]">
            <div class='flex items-center'>
                <div class="flex justify-between gap-2">
                    <i class="ri-mail-line text-xl"></i>

                    <p class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-100">Waiting Notes </p>
                </div>
            </div>
            <div class="mt-6">
                <p class="text-3xl font-bold leading-9 text-gray-900 dark:text-gray-100">{{ $notesUnSentCount }}</p>
            </div>
        </div>


        <div class="p-6 bg-white rounded-lg shadow-lg dark:bg-gray-800 bg-gradient-to-r from-[#9cbfd8] to-[#dfe5ea]">
            <div class='flex items-center'>
                <div class="flex justify-between gap-2">
                    <i class="ri-heart-add-line text-xl "></i>
                    <p class="text-lg font-medium leading-6 text-gray-900 dark:text-gray-100 gap-2">
                        Liked Notes
                    </p>
                </div>
            </div>
            <div class="mt-6">
                <p class="text-3xl font-bold leading-9 text-gray-900 dark:text-gray-100">{{ $notesLoveCount }}</p>
            </div>
        </div>
    </div>

</div>