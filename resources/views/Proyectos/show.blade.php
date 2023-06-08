<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Your Website</title>
    <script src="/assets/jquery.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    @vite('resources/css/app.css')
</head>

<body>


<div class="h-screen p-2">
  <div class="grid lg:grid-cols-4 md:grid-cols-1 sm:grid-cols-2 gap-5">
    <!-- To-do -->
    @foreach ($estados as $estado)
    <div class="bg-white rounded px-2 py-2">
      <!-- board category header -->
      <div class="flex flex-row justify-between items-center mb-2 mx-1">
        <div class="flex items-center">
          <h2 class="{{$estado->color}} text-sm w-max px-1 rounded mr-2 text-gray-700">{{ $estado->name }}</h2>
          <p class="text-gray-400 text-sm">3</p>
        </div>
      </div>
      <!-- board card -->
      @foreach($tareas as $tarea)
        @if($tarea->estado_id === $estado->id)
          <div class="grid grid-rows-1 gap-2"
            id="open-popup" data-id="{{$tarea->id}}" data-id2="{{$proyecto->id}}" onclick="openPopup(this)">
            <div class="p-2 rounded shadow-sm border-gray-100 border-2">
              <h3 class="text-sm mb-3 text-gray-700">{{$tarea->name}}</h3>
              <p class="{{$estado->color}} text-xs w-max p-1 rounded mr-2 text-gray-700">{{$estado->name}}</p>
              <div class="flex flex-row items-center mt-2">
                <div class="bg-gray-300 rounded-full w-4 h-4 mr-3"></div>
                <a href="#" class="text-xs text-gray-500">Responsable: {{$tarea->getResponsable()}}</a>
              </div>
              <!-- <p class="text-xs text-gray-500 mt-2">2</p> -->
            </div>
          </div>
        @endif
      @endforeach
      <div class="flex flex-row items-center text-gray-300 mt-2 px-1">
        <p class="rounded mr-2 text-2xl">+</p>
        <p class="pt-1 rounded text-sm">New</p>
      </div>
    </div>
    @endforeach
  </div>
</div>

@include('Proyectos.popup')


{{-- href="{{ route('tareas.edit', $tarea->id) }}" --}}

</body>

<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

<script>
  function openPopup(este) {
    let id_tarea = $(este).data('id');
    let id_proyecto = $(este).data('id2');
    
    let url = "{{ route('tarea.edit', ['tarea' => ':id_tarea']) }}";
    url = url.replace(':id_tarea', id_tarea);

    $.ajax({
            type: "GET",
            url: url,
            data: id_tarea,
            success: function(data){

                if(data['tarea']) {
                  $('#popup').removeClass('hidden');
                  $('#popup').draggable({
                    cursor: "move", // Cambia el cursor al mover el popup
                    containment: "window" // Limita el movimiento dentro de la ventana
                  });

                  let tarea = data['tarea'];

                  $("#task_name").val(data['tarea']['name']);

                  $('.popup-field').each(function() {

                    let fieldId = $(this).attr('id');
                    $(this).text(tarea[fieldId]);

                  });
                }
            },
            error:function(){
            }
        });
  }

  function closeModal() {
    $('#popup').addClass('hidden');
  }
</script>
</html>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>