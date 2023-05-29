<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    @vite('resources/css/app.css')
</head>

<body>

    <div class="flex min-h-screen items-center justify-center bg-black font-bold text-white">
    <div class=" text-center space-y-12">
        <div class="text-center text-5xl font-bold">
            Services offered
            <div class="relative inline-grid grid-cols-1 grid-rows-1 gap-12 overflow-hidden">
            <span class="animate-word col-span-full row-span-full">Flutter</span>
            <span class="animate-word-delay-1 col-span-full row-span-full">Django</span>
            <span class="animate-word-delay-2 col-span-full row-span-full">Website</span>
            <span class="animate-word-delay-3 col-span-full row-span-full">VueJS</span>
            <span class="animate-word-delay-4 col-span-full row-span-full">NuxtJS</span>
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