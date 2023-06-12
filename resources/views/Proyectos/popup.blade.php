{{-- Popup1 --}}

@php
    $proyecto_id = Request::segment(2);
@endphp

<div class="fixed inset-0 flex items-center justify-center z-50 hidden" id="popup">
    <div class="fixed inset-0 bg-black opacity-50"></div>
    <div class="flex flex-col w-11/12 sm:w-5/6 lg:w-1/2 max-w-2xl mx-auto rounded-lg border border-gray-300 shadow-xl bg-white z-10" style="max-height: 80vh; pointer-events: auto">
        <div class="flex flex-row justify-between p-6 bg-white border-b border-gray-200 rounded-tl-lg rounded-tr-lg">
            <p class="font-semibold text-gray-800" id="name_title"></p>
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" onclick="closeModal()">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </div>
        <form id="create_update_task" name="create_update_task" action="" method="POST">
            <input type="hidden" id="task_create" value="{{ route('tareas.store') }}">
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
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" onclick="closeModal()">
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
