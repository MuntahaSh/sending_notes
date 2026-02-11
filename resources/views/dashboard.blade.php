<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Dashboard layout -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                <!-- LEFT: Main content -->
                <div class="lg:col-span-2 space-y-6">
                    <livewire:dashboardstats />
                    <!-- later: notes list, activity feed, etc -->
                </div>

                <!-- RIGHT: Calendar -->
                <div class="lg:col-span-1">
                    <div class="rounded-2xl bg-white shadow p-4">
                        <h3 class="text-lg font-semibold mb-4">Notes Calendar</h3>
                        <div id="calendar"></div>
                    </div>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>