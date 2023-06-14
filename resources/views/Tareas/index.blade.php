@include('layouts.app')
@include('Tareas.error')
<div class="h-screen p-2">
  <div class="grid lg:grid-cols-4 md:grid-cols-1 sm:grid-cols-2 gap-5" >
    <!-- To-do -->
    @foreach ($estados as $estado)
    <div class="bg-white rounded px-2 py-2 border-2 sortable-task" data-id="{{ $estado->id }}" name="state" id="estado-{{ $estado->id }}" ondrop="drop(event)" ondragover="allowDrop(event)">
      <!-- board category header -->
      <input type="hidden" name="_token" value="{{ csrf_token() }}">

      <div class="flex flex-row justify-between items-center mb-2 mx-1" name="task-name">
        <div class="flex items-center not-sortable">
          <h2 class="{{ $estado->color }} text-sm w-max px-1 rounded mr-2 text-gray-700">{{ $estado->name }}</h2>
          <p class="text-gray-400 text-sm">{{ $estado->getTasksCount($proyecto->id) }}</p>
        </div>
      </div>
      <!-- board card -->
      @foreach($tareas as $tarea)
        @if($tarea->estado_id === $estado->id)
          <div class="grid grid-rows-1 gap-2 sortable-task mt-2 mb-2" name="task" data-id="{{$tarea->id}}" data-id2="{{$proyecto->id}}" data-id3="{{$estado->id}}" onclick="openPopup(this)" draggable="true" ondragstart="drag(event)">
            <input type="hidden" name="url_edit" value="{{ route('proyectos.tareas.edit', ['proyecto' => $proyecto->id, 'tarea' => $tarea->id]) }}">
            <input type="hidden" name="url_update" value="{{ route('proyectos.tareas.update', ['proyecto' => $proyecto->id, 'tarea' => $tarea->id]) }}" token="{{ csrf_token() }}">
            <div class="p-2 rounded shadow-sm border-gray-100 border-2">
              <h3 class="text-sm mb-3 text-gray-700">{{$tarea->name}}</h3>
              <p class="text-xs w-max p-1 {{ $tarea->estado->color }} rounded mr-2 text-gray-700">{{$estado->name}}</p>
              <div class="flex flex-row items-center mt-2">
                <div class="bg-gray-100 rounded-full w-4 h-4 mr-3"></div>
                <p class="text-xs text-gray-500">Responsable: {{$tarea->encargado->name}}</p>
              </div>
              <!-- <p class="text-xs text-gray-500 mt-2">2</p> -->
            </div>
          </div>
        @endif
      @endforeach
      <div class="flex flex-row items-center text-gray-300 mt-2 px-1" onclick="openCreate({{$estado->id}})">
        <p class="rounded mr-2 text-2xl">+</p>
        <p class="pt-1 rounded text-sm">New</p>
      </div>
    </div>
    @endforeach
  </div>
</div>

@include('Proyectos.popup')

<script src="/js/tarea.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>