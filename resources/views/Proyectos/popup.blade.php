@php
    use App\Models\Tarea;

    $proyecto_id = Request::segment(2);
    $tarea_id = Request::segment(4);

    $tarea = Tarea::find($tarea_id);
@endphp

{{-- Popup1 --}}

<div class="fixed inset-0 flex items-center justify-center z-60 hidden" id="popup">
    <div class="fixed inset-0 bg-black opacity-50"></div>
    <div class="flex flex-col w-11/12 sm:w-5/6 lg:w-1/2 max-w-2xl mx-auto rounded-lg border border-gray-300 shadow-xl bg-white z-10" style="max-height: 80vh; pointer-events: auto">
        <div class="flex flex-row justify-between p-6 bg-white border-b border-gray-200 rounded-tl-lg rounded-tr-lg">
            <p class="font-semibold text-gray-800" id="name_title"></p>
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" onclick="closeModal(this)">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </div>
        <form id="create_update_task" name="create_update_task" action="{{ route('proyectos.tareas.update', ['proyecto' => $proyecto->id, 'tarea' => $tarea->id]) }}" method="POST">
            <input type="hidden" id="task_create" value="{{ route('proyectos.tareas.store', ['proyecto' => $proyecto_id]) }}">
            <input type="hidden" id="proyecto_id" name="proyecto_id" value="{{ $proyecto_id }}">
            <div class="flex flex-col px-6 py-5 bg-gray-50 overflow-y-auto">

                <div class="w-full mt-2 sm:mt-0">
                    <p class="mb-2 font-semibold text-gray-700">{{ __('Name') }}</p>
                    <input type="text" name="name" class="w-full p-5 bg-white border border-gray-200 rounded shadow-sm appearance-none field" id="name">
                </div>
                <!-- Contenido del popup -->
            
                <div class="w-full mt-2 sm:mt-0">
                    <p class="mb-2 font-semibold text-gray-700 mt-3">{{ __('Description') }}</p>
                    {{-- <input type="text" class="w-full p-5 bg-white border border-gray-200 rounded shadow-sm appearance-none h-45"> --}}
                    <textarea name="description" class="w-full p-5 bg-white border border-gray-200 rounded shadow-sm appearance-none field" id="description"></textarea>
                </div>

                <div class="flex flex-col sm:flex-row items-center mb-5 sm:space-x-5 mt-3">
                    <div class="w-full sm:w-1/2">
                        <p class="mb-2 font-semibold text-gray-700">{{ __('Estado') }}</p>
                        <select type="text" name="estado_id" class="w-full p-5 bg-white border border-gray-200 rounded shadow-sm appearance-none field" id="estado">
                            <option value="">{{ __('Selecciona un estado') }}</option>
                            @foreach ($estados as $estado)
                                <option name="state_option" value="{{ $estado->id }}" >{{ $estado->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="w-full sm:w-1/2 mt-2 sm:mt-0">
                        <p class="mb-2 font-semibold text-gray-700">{{ __('Prioridad') }}</p>
                        <select type="text"  name="prioridad_id" class="w-full p-5 bg-white border border-gray-200 rounded shadow-sm appearance-none" id="">
                            <option value="">{{ __('Selecciona una prioridad') }}</option>
                            @foreach ($prioridades as $prioridad)
                                <option name="priority_option" value="{{ $prioridad->id }}" class="">{{ $prioridad->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row items-center mb-5 sm:space-x-5 mt-3">
                    <div class="w-full mt-2 sm:mt-0 sm:w-1/2">
                    <p class="mb-2 font-semibold text-gray-700">{{ __('Fecha inicio') }}</p>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <input datepicker type="text" name="start_date" class="w-full p-3 bg-white border border-gray-200 rounded shadow-sm appearance-none pl-10 h-10" placeholder="Select date">
                        </div>
                    </div>  
                    <div class="w-full mt-2 sm:mt-0 sm:w-1/2">
                        <p class="mb-2 font-semibold text-gray-700">{{ __('Fecha fin') }}</p>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                            <input datepicker type="text" name="end_date" class="w-full p-3 bg-white border border-gray-200 rounded shadow-sm appearance-none pl-10 h-10" placeholder="Select date">
                        </div>
                    </div>  
                </div>

            </div>
            <div class="flex flex-row justify-between p-5 bg-white border-t border-gray-200 rounded-bl-lg rounded-br-lg">
                <button class="px-4 py-2 text-white font-semibold bg-blue-500 rounded" type="submit">
                    Save
                </button>
            </div>
        @method("POST")
        @csrf
        </form>
    </div>
</div>

{{-- Popup2 --}}

<div class="fixed inset-0 flex items-center justify-center z-50 hidden mb-20" id="popup2">
    <div class="fixed inset-0 bg-black opacity-50"></div>
    <div class="flex flex-col w-11/12 sm:w-5/6 lg:w-1/2 max-w-2xl mx-auto rounded-lg border border-gray-300 shadow-xl bg-white z-10 overflow-y-auto" style="max-height: 80vh; pointer-events: auto">
        <div class="flex flex-row justify-between p-6 bg-white border-b border-gray-200 rounded-tl-lg rounded-tr-lg">
            <p class="font-semibold text-gray-800" id="adduser"></p>
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" onclick="closeModal(this)">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </div>
        <input type="hidden" id="url_users" value="{{ route('user.getUsers')  }}">
        <input type="hidden" id="token_users" value="{{ csrf_token() }}">
        <div class="flex flex-col sm:flex-row items-center mb-5 sm:space-x-5 mt-3">
             <div class="w-full sm:w-2/3 ml-8 mt-3">
                <p class="mb-2 font-semibold text-gray-700">{{ __('Busca a un usuario') }}</p>
                <input type="text" id="user_name" name="user_name" class="w-full mb-3 p-5 bg-white border border-gray-200 rounded shadow-sm appearance-none field">
                <small id="error" class="ml-2 text-red-600"></small>
            </div>

            <div class="w-full sm:w-1/3 mt-2 mt-9">
                <button class="px-4 py-2 mb-2 text-white font-semibold bg-blue-500 rounded" type="submit" id="search_user">
                    {{ __('Search user') }}
                </button>    
            </div>
        </div>
        <div id="userlist"></div>
        <input type="hidden" name="url_send_notification" value="{{ route('notification.sendNotification') }}">
        <input type="hidden" name="token_send_notification" value="{{ csrf_token() }}">
    </div>
</div>

{{-- Popup3 --}}

<div class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden z-51" id="popup3">
    <div class="bg-white rounded-md w-96 p-6">
        <h1 class="text-xl font-bold mb-4">Seguimiento de tiempo</h1>
        <input type="hidden" value="{{ csrf_token() }}" name="token_set_time">
       
        <div class="flex mb-4">
            <div class="w-1/2 mr-2">
                <label for="hours" class="font-bold">{{ __('Registrar tiempo') }}</label>
                <div class="mt-2">
                    <input id="hours" type="text" class="w-full border-gray-300 border rounded px-3 py-2" pattern="^(?:\d+h)?(?:\d+m)?$"
                        title="Usa este formato: HH:MM" name="hours">
                </div>
            </div>
            <div class="w-1/2 ml-2">
                <label for="estatimated_hours" class="font-bold">{{ __('Tiempo asignado') }}</label>
                <div class="mt-2">
                    <input id="estatimated_hours" type="text" value="hola" class="w-full border-gray-300 border rounded px-3 py-2" pattern="^(?:\d+h)?(?:\d+m)?$"
                        title="Usa este formato: HH:MM" name="estatimated_hours">
                </div>
            </div>
        </div>
        <div class="mb-4">
            <p class="text-gray-500">Usa este formato: 2w 4d 6h 45m</p>
            <ul class="list-disc list-inside text-gray-500">
                <li>w = semanas</li>
                <li>d = días</li>
                <li>h = horas</li>
                <li>m = minutos</li>
            </ul>
        </div>
        <div class="flex justify-end">
            <button type="button" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-3 rounded mr-2 text-sm" onclick="handleTime()">Guardar</button>
            <button type="button" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-3 rounded text-sm" onclick="closeModal(this)">Cancelar</button>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/datepicker.min.js"></script>