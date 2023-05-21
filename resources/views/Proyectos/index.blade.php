<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Your Website</title>
    @vite('resources/css/app.css')
</head>

<body>

@foreach ($proyectos as $proyecto)

    <a href="{{ route('proyectos.show', $proyecto->id) }}" class="ml-2 mt-2 block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
        {{ $proyecto->name }}
    </a>
    
@endforeach

</body>

</html>