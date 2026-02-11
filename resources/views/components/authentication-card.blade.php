<div class="min-h-screen flex flex-col items-center justify-center px-4 bg-[#FDFDFC]">

    <!-- Logo -->
    <div class="mb-6">
        <x-application-mark class="h-28 sm:h-32 w-auto fill-current" />
    </div>

    <!-- Card -->
    <div class="w-full max-w-lg sm:max-w-xl
               rounded-[32px]
               bg-gradient-to-br from-[#9cbfd8] to-[#dfe5ea]
               shadow-2xl ring-1 ring-white/60 backdrop-blur
               px-6 sm:px-10
               py-10 sm:py-14
               ">

        {{ $slot }}

    </div>
</div>