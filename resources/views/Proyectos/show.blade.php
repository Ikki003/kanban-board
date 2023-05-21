<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Your Website</title>
    <script src="/assets/jquery.js"></script>
    @vite('resources/css/app.css')
</head>

<body>

<div class="grid grid-cols-4 gap-4 mt-2 ml-2 mr-2">
  @foreach ($estados as $estado)
    <div class="bg-gray-400 p-4 border border-gray-200 rounded-lg">
        {{ $estado->name }}
        
        {{ $estado->showTasks($proyecto->id)->pluck('name') }}
        
    </div>
  @endforeach
  
</div>

</body>

</html>