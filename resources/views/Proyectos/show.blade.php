<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Your Website</title>
    <script src="/assets/jquery.js"></script>
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


<!-- <div class="grid grid-cols-4 gap-4 mt-2 ml-2 mr-2">
  @foreach ($estados as $estado)
    <div class="bg-gray-400 p-4 border border-gray-200 rounded-lg">
        {{ $estado->name }}
        
        @foreach($tareas as $tarea)
          @if($tarea->estado_id === $estado->id)
            <a id="open-popup" data-id="{{$tarea->id}}" data-id2="{{$proyecto->id}}" onclick="openPopup(this)" class="ml-2 mt-2 block max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                {{ $tarea->name }}
            </a>
          @endif
        @endforeach
        
    </div>
  @endforeach
  
</div> -->


<div class="fixed inset-0 flex items-center justify-center z-50 hidden" id="popup">
    <div class="fixed inset-0 bg-black opacity-50"></div>
    <!-- <div class="bg-white rounded-lg p-6 shadow-xl z-10"> -->
    <div class="flex flex-col w-11/12 sm:w-5/6 lg:w-1/2 max-w-2xl mx-auto rounded-lg border border-gray-300 shadow-xlbg-white z-10">
        <div
          class="flex flex-row justify-between p-6 bg-white border-b border-gray-200 rounded-tl-lg rounded-tr-lg"
        >
          <p class="font-semibold text-gray-800">Add a step</p>
          <svg
            class="w-6 h-6"
            fill="none"
            stroke="currentColor"
            viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M6 18L18 6M6 6l12 12"
            ></path>
          </svg>
        </div>
        <div class="flex flex-col px-6 py-5 bg-gray-50">
          <p class="mb-2 font-semibold text-gray-700">Bots Message</p>
          <textarea
            type="text"
            name=""
            placeholder="Type message..."
            class="p-5 mb-5 bg-white border border-gray-200 rounded shadow-sm h-36"
            id=""
          ></textarea>
          <div class="flex flex-col sm:flex-row items-center mb-5 sm:space-x-5">
            <div class="w-full sm:w-1/2">
              <p class="mb-2 font-semibold text-gray-700">Customer Response</p>
              <select
                type="text"
                name=""
                class="w-full p-5 bg-white border border-gray-200 rounded shadow-sm appearance-none"
                id=""
              >
                <option value="0">Add service</option>
              </select>
            </div>
            <div class="w-full sm:w-1/2 mt-2 sm:mt-0">
              <p class="mb-2 font-semibold text-gray-700">Next step</p>
              <select
                type="text"
                name=""
                class="w-full p-5 bg-white border border-gray-200 rounded shadow-sm appearance-none"
                id=""
              >
                <option value="0">Book Appointment</option>
              </select>
            </div>
          </div>
          <hr />

          <div class="flex items-center mt-5 mb-3 space-x-4">
            <input
              class="inline-flex rounded-full"
              type="checkbox"
              id="check1"
              name="check1"
            />
            <label class="inline-flex font-semibold text-gray-400" for="check1">
              Add a crew</label
            ><br />
            <input
              class="inline-flex"
              type="checkbox"
              id="check2"
              name="check2"
                   checked
            />
            <label class="inline-flex font-semibold text-blue-500" for="check2">
              Add a specific agent</label
            ><br />
          </div>
          <div
            class="flex flex-row items-center justify-between p-5 bg-white border border-gray-200 rounded shadow-sm"
          >
            <div class="flex flex-row items-center">
              <img
                class="w-10 h-10 mr-3 rounded-full"
                src="https://randomuser.me/api/portraits/lego/7.jpg"
                alt=""
              />
              <div class="flex flex-col">
                <p class="font-semibold text-gray-800">Xu Lin Bashir</p>
                <p class="text-gray-400">table.co</p>
              </div>
            </div>
            <h1 class="font-semibold text-red-400">Remove</h1>
          </div>
        </div>
        <div
          class="flex flex-row items-center justify-between p-5 bg-white border-t border-gray-200 rounded-bl-lg rounded-br-lg"
        >
          <p class="font-semibold text-gray-600">Cancel</p>
          <button class="px-4 py-2 text-white font-semibold bg-blue-500 rounded">
            Save
          </button>
        </div>
      </div>
        <!--  -->
    </div>
</div>


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
</script>
</html>