@php
    use App\Models\Proyecto;
@endphp

@if (Request::is('proyectos/*'))

    @php
        $proyecto_id = Request::segment(2);
        $proyecto = Proyecto::find($proyecto_id);

        $auth_user = auth()->user()->id;
    @endphp
                
@endif

{{-- Popup1 --}}

<div class="fixed inset-0 flex items-center justify-center z-60 hidden" id="popup">
    <div class="fixed inset-0 bg-black opacity-50"></div>
    <div class="flex flex-col w-11/12 sm:w-5/6 lg:w-1/2 max-w-2xl mx-auto rounded-lg border border-gray-300 shadow-xl bg-white z-10" style="max-height: 80vh; pointer-events: auto">
        <div class="flex flex-row justify-between p-6 bg-white border-b border-gray-200 rounded-tl-lg rounded-tr-lg">
            <p class="font-semibold text-gray-800" id="name_title"></p>
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" onclick="closeModal('popup')">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </div>
            <div class="flex flex-col px-6 py-5 bg-gray-50 overflow-y-auto">
                <form id="create_update_task" name="create_update_task" action="" method="POST">
                    <input type="hidden" id="task_create" value="{{ route('proyectos.tareas.store', ['proyecto' => $proyecto_id]) }}">
                    <input type="hidden" id="proyecto_id" name="proyecto_id" value="{{ $proyecto_id }}">
                    <input type="hidden" id="tarea_id" name="tarea_id" value="">

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
                            <select type="text" name="prioridad_id" class="w-full p-5 bg-white border border-gray-200 rounded shadow-sm appearance-none">
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
                                <input datepicker datepicker-buttons value="" datepicker-format="yyyy-mm-dd" type="text" name="start_date" class="w-full p-3 bg-white border border-gray-200 rounded shadow-sm appearance-none pl-10 h-10" placeholder="Select date">
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
                                <input datepicker datepicker-buttons value="" datepicker-format="yyyy-mm-dd" type="text" name="end_date" class="w-full p-3 bg-white border border-gray-200 rounded shadow-sm appearance-none pl-10 h-10" placeholder="Select date">
                            </div>
                        </div>  
                    </div>

                    <div class="flex flex-col sm:flex-row items-center mb-5 sm:space-x-5 mt-3 mr-3" id="registrar_tiempo_button">
                        <div class="w-full mt-2 sm:mt-0 sm:w-1/2">
                            <button type="button" name="register_time" class="w-full p-5 bg-white border border-gray-200 rounded shadow-sm appearance-none">
                                {{ __('Registrar tiempo') }}
                            </button>
                        </div>

                        <button id="userDropdownTask" data-dropdown-toggle="dropdown2" class="bg-white border-gray-200 text-black font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-4 mt-4 ease-linearvtransition-all duration-150" type="button">
                            <span class="flex items-center"> 
                                <i class="fas fa-user mr-1"></i> {{ __('Usuarios') }}
                                <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </span>
                        </button>
                        <!-- Dropdown menu -->
                        <div id="dropdown2" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                            <input type="hidden" id="responsable_id" name="responsable_id" value="">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="multiLevelDropdownButton">
                                @foreach($proyecto->usuarios as $usuario)
                                <li>
                                    <p name="options_users" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" data-value="{{ $usuario->id }}">{{ $usuario->name }}
                                        <span name="badge_user" id="badge_user_{{ $usuario->id }}" class="inline-block bg-purple-300 text-black px-1.5 py-0.5 rounded-md text-xs hidden">{{ __('Asignado') }}</span>
                                    </p>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @method("POST")
                    @csrf
                </form>
            </div>
            <div class="flex flex-row justify-between p-5 bg-white border-t border-gray-200 rounded-bl-lg rounded-br-lg">
                <button class="px-4 py-2 text-white font-semibold bg-red-500 rounded hidden" type="button" id="delete_task_button" data-modal-toggle="popup6">
                    {{ __('Eliminar') }}
                </button>
                <div class="flex flex-row justify-end">
                    <button class="px-4 py-2 text-white font-semibold bg-blue-500 rounded" type="button" onclick="submitUpdate()">
                        {{ __('Guardar') }}
                    </button>
                </div>
            </div>
    </div>
</div>

{{-- Popup2 --}}

<div class="fixed inset-0 flex items-center justify-center z-50 hidden mb-20" id="popup2">
    <div class="fixed inset-0 bg-black opacity-50"></div>
    <div class="flex flex-col w-11/12 sm:w-5/6 lg:w-1/2 max-w-2xl mx-auto rounded-lg border border-gray-300 shadow-xl bg-white z-10 overflow-y-auto" style="max-height: 80vh; pointer-events: auto">
        <div class="flex flex-row justify-between p-6 bg-white border-b border-gray-200 rounded-tl-lg rounded-tr-lg">
            <p class="font-semibold text-gray-800" id="adduser"></p>
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" onclick="closeModal('popup2')">
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
        <form id="set_time_form" action="" method="POST">
            <div class="flex mb-4">
                <div class="w-1/2 mr-2" id="registrar_tiempo">
                    <label for="hours" class="font-bold">{{ __('Registrar tiempo') }}</label>
                    <div class="mt-2">
                        <input id="hours" type="text" class="w-full border-gray-300 border rounded px-3 py-2" pattern="^(?:(?:\d+h)?(?:\d+m)?)?$"
                            title="Usa este formato: HH:MM" name="hours">
                    </div>
                </div>
                <div class="w-1/2 mr-2">
                    <label for="hours" class="font-bold">{{ __('Tiempo estimado') }}</label>
                    <div class="mt-2" onclick="enableInput()">
                        <input id="estimated_hours" type="text" class="w-full bg-gray-200 border-gray-300 border rounded px-3 py-2" pattern="^(?:(?:\d+h)?(?:\d+m)?)?$"
                            title="Usa este formato: HH:MM" name="estimated_hours" disabled>
                    </div>
                </div>
            </div>
            <div class="mb-4">
                <small id="error_hours" class="ml-2 text-red-600"></small>
                <p class="text-gray-500" id="assigned_time"></p>
                <p class="text-gray-500" id="estimated_time"></p>
                <p class="text-gray-500 mt-2">Usa este formato: 6h 45m</p>
                <ul class="list-disc list-inside text-gray-500">
                    <li>h = horas</li>
                    <li>m = minutos</li>
                </ul>
            </div>
            <div class="flex justify-end">
                <button type="button" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-3 rounded mr-2 text-sm" onclick="handleTime()">Guardar</button>
                <button type="button" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-3 rounded text-sm" onclick="closeModal('popup3')">Cancelar</button>
            </div>
            @csrf
        </form>
    </div>
</div>

{{-- Popup6 --}}

<div tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full" id="popup6">
    <form id="delete_task_form" action="" method="POST">
        <div class="relative p-4 w-full max-w-md h-full md:h-auto">
            <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                <button type="button" class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="popup6">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">{{ __('Cerrar modal') }}</span>
                </button>
                <svg class="text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                <p class="mb-4 text-gray-500 dark:text-gray-300">{{ __('¿Estás seguro de que quieres borrar esta tarea?') }}</p>
                <div class="flex justify-center items-center space-x-4">
                    <button data-modal-toggle="popup6" type="button" class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                        {{ __('No, Cancelar') }}
                    </button>
                    <button type="submit" class="py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                        {{ __('Sí, estoy seguro') }}
                    </button>
                </div>
            </div>
        </div>
        @csrf
        @method("DELETE")
    </form>
</div>

{{-- Popup7 --}}

<div tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full" id="popup7">
    <form id="delete_project_form" action="{{ route('proyectos.destroy', ['proyecto' => $proyecto_id]) }}" method="POST">
        <div class="relative p-4 w-full max-w-md h-full md:h-auto">
            <div class="relative p-4 text-center bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                <button type="button" class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="popup7">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">{{ __('Cerrar modal') }}</span>
                </button>
                <svg class="text-gray-400 dark:text-gray-500 w-11 h-11 mb-3.5 mx-auto" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                <p class="mb-4 text-gray-500 dark:text-gray-300">{{ __("¿Estás seguro de que quieres borrar este proyecto? Se borrarán ". $proyecto->getTareasCount(). " tareas asociadas") }}</p>
                <div class="flex justify-center items-center space-x-4">
                    <button data-modal-toggle="popup7" type="button" class="py-2 px-3 text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                        {{ __('No, Cancelar') }}
                    </button>
                    <button type="submit" class="py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                        {{ __('Sí, estoy seguro') }}
                    </button>
                </div>
            </div>
        </div>
        @csrf
        @method("DELETE")
    </form>
</div>

{{-- Popup8 --}}

<div class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-modal md:h-full" id="popup8">
    <div class="flex flex-col w-11/12 sm:w-5/6 lg:w-1/2 max-w-2xl mx-auto rounded-lg border border-gray-300 shadow-xl bg-white z-90" style="max-height: 80vh; pointer-events: auto">
        <div class="flex flex-row justify-between p-6 bg-white border-b border-gray-200 rounded-tl-lg rounded-tr-lg">
            <p class="font-semibold text-gray-800" id="name_title">{{ __('Crear Proyecto') }}</p>
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" data-modal-toggle="popup8">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </div>
        <form id="update_project" name="update_project" action="{{ route('proyectos.update', ['proyecto' => $proyecto_id]) }}" method="POST">
            <div class="flex flex-col px-6 py-5 bg-gray-50 overflow-y-auto">
                    <input type="hidden" id="project_create" value="{{ route('proyectos.store') }}">

                    <div class="w-full mt-2 sm:mt-0">
                        <p class="mb-2 font-semibold text-gray-700">{{ __('Name') }}</p>
                        <input type="text" name="project_name" class="w-full p-5 bg-white border border-gray-200 rounded shadow-sm appearance-none field" id="project_name" value="{{ $proyecto->name }}">
                    </div>
                    <!-- Contenido del popup -->
                
                    <div class="w-full mt-2 sm:mt-0">
                        <p class="mb-2 font-semibold text-gray-700 mt-3">{{ __('Description') }}</p>
                        {{-- <input type="text" class="w-full p-5 bg-white border border-gray-200 rounded shadow-sm appearance-none h-45"> --}}
                        <textarea name="project_description" class="w-full p-5 bg-white border border-gray-200 rounded shadow-sm appearance-none field" id="project_description">{{ $proyecto->description }}</textarea>
                    </div>
                
            </div>
            <div class="flex flex-row justify-between p-5 bg-white border-t border-gray-200 rounded-bl-lg rounded-br-lg">
                <div class="flex flex-row justify-end">
                    <button class="px-4 py-2 text-white font-semibold bg-blue-500 rounded">
                        {{ __('Guardar') }}
                    </button>
                </div>
            </div>
        @method("PUT")
        @csrf
        </form>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/datepicker.min.js"></script>