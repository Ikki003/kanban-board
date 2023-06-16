<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    @vite('resources/css/app.css')
</head>

<body>

    @if (Route::has('login'))
        <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
            @auth
                <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                @endif
            @endauth
        </div>
    @endif

    <div class="flex min-h-screen items-center justify-center bg-white font-bold text-black">
    <div class=" text-center space-y-12">
        <div class="text-center text-5xl font-bold">
            Optimiza tu tiempo 
            <div class="relative inline-grid grid-cols-1 grid-rows-1 gap-12 overflow-hidden">
            <span class="animate-word col-span-full row-span-full">Simplifica</span>
            <span class="animate-word-delay-1 col-span-full row-span-full">Organiza</span>
            <span class="animate-word-delay-2 col-span-full row-span-full">Potencia</span>
            <span class="animate-word-delay-3 col-span-full row-span-full">Agiliza</span>
            <span class="animate-word-delay-4 col-span-full row-span-full">Gestiona</span>
            </div>
        </div>
        <p class=" text-white">
            Want to hire me for work ping me <a class="underline" href="mailto:ponnamkarthik3@gmail.com">mail here</a>
        </p>
    </div>
    </div>

    <style>

    @keyframes word {
    0% {
        transform: translateY(100%);
    }
    15% {
        transform: translateY(-10%);
        animation-timing-function: ease-out;
    }

    20% {
        transform: translateY(0);
    }

    40%,
    100% {
        transform: translateY(-110%);
    }
    }

    .animate-word {
    animation: word 7s infinite;
    }
    .animate-word-delay-1 {
    animation: word 7s infinite;
    animation-delay: -1.4s;
    }
    .animate-word-delay-2 {
    animation: word 7s infinite;
    animation-delay: -2.8s;
    }
    .animate-word-delay-3 {
    animation: word 7s infinite;
    animation-delay: -4.2s;
    }
    .animate-word-delay-4 {
    animation: word 7s infinite;
    animation-delay: -5.6s;
    }

    </style>

</body>

</html>