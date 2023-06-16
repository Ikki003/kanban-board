{{-- Popup 4 --}}

<div class="fixed inset-0 flex items-center justify-center z-60 hidden" id="popup4">
    <div class="fixed inset-0 bg-black opacity-50"></div>
    <div class="flex flex-col w-11/12 sm:w-5/6 lg:w-1/2 max-w-2xl mx-auto rounded-lg border border-gray-300 shadow-xl bg-white z-10" style="max-height: 80vh; pointer-events: auto">
        <div class="flex flex-row justify-between p-6 bg-white border-b border-gray-200 rounded-tl-lg rounded-tr-lg">
            <p class="font-semibold text-gray-800" id="name_title">{{ __('Crear Proyecto') }}</p>
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" onclick="closeModal('popup4')">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </div>
            <div class="flex flex-col px-6 py-5 bg-gray-50 overflow-y-auto">
                <form id="create_update_project" name="create_update_project" action="" method="POST">
                    <input type="hidden" id="project_create" value="{{ route('proyectos.store') }}">

                    <div class="w-full mt-2 sm:mt-0">
                        <p class="mb-2 font-semibold text-gray-700">{{ __('Name') }}</p>
                        <input type="text" name="project_name" class="w-full p-5 bg-white border border-gray-200 rounded shadow-sm appearance-none field" id="project_name">
                    </div>
                    <!-- Contenido del popup -->
                
                    <div class="w-full mt-2 sm:mt-0">
                        <p class="mb-2 font-semibold text-gray-700 mt-3">{{ __('Description') }}</p>
                        {{-- <input type="text" class="w-full p-5 bg-white border border-gray-200 rounded shadow-sm appearance-none h-45"> --}}
                        <textarea name="project_description" class="w-full p-5 bg-white border border-gray-200 rounded shadow-sm appearance-none field" id="project_description"></textarea>
                    </div>

                    <div class="w-full mt-2 sm:mt-0">
                        <p class="mb-2 font-semibold text-gray-700 mt-3">{{ __('*El administrador por defecto del proyecto eres tú') }}</p>
                    </div>
                    @method("POST")
                    @csrf
                </form>
            </div>
            <div class="flex flex-row justify-between p-5 bg-white border-t border-gray-200 rounded-bl-lg rounded-br-lg">
                <div class="flex flex-row justify-end">
                    <button class="px-4 py-2 text-white font-semibold bg-blue-500 rounded" type="button" onclick="submitCreate()">
                        {{ __('Guardar') }}
                    </button>
                </div>
            </div>
    </div>
</div>


{{-- Popup5 --}}

<div class="flex items-center justify-center h-screen hidden" id="popup5">
  <button class="inline-flex items-center modal-open px-6 py-3 text-xl font-semibold text-red-600 hover:text-white bg-white hover:bg-red-600 border-2 border-red-500 rounded-full focus:outline-none dark:border-gray-50 dark:bg-gray-800 dark:text-gray-100 dark:hover:bg-gray-700 dark:hover:text-gray-50 ">
  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
  </svg>
    Delete media
  </button>
  <div class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
    <div class="modal-overlay absolute w-full h-full bg-gray-300 opacity-50"></div>
    <div class="modal-container bg-gradient-to-r bg-white dark:bg-gray-800 max-w-lg mx-auto rounded shadow-lg z-50 overflow-y-auto">
        <div class="modal-content py-4 text-left px-6">
            <div class="flex justify-end items-center pb-3">
                <div class="modal-close cursor-pointer z-50 p-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400 dark:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
            </div>
            <h2 class="text-center font-bold text-2xl mt-1 text-gray-600 dark:text-gray-100">{{ __('¿Quieres borrar el proyecto?') }}</h2>
            <p class=" text-gray-500 font-medium text-center my-6 mx-6 dark:text-gray-200"> {{ __("Haz click en el botón 'Eliminar' para confirmar") }} </p>
            <div class="px-4 flex flex-row py-4 min-w-min border-l-4 border-red-400 dark:border-gray-200 bg-red-100 dark:bg-gray-700 rounded mx-auto">
                <span class="w-6 h-6 mr-4 mt-1 text-red-500 dark:text-gray-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </span>
                <div>
                    <h2 class="text-lg font-bold text-red-700 dark:text-gray-100">Warning</h2>
                    <p class="text-sm my-2 text-red-500 dark:text-gray-200 font-medium">{{ __('Si borras el proyecto se borrarán también') . ' ' . $proyecto->getTareasCount() . ' ' . __('Tareas asociadas') }}</p>
                </div>
            </div>
            <div class="flex-row md:flex items-center md:justify-between py-4 text-center mx-auto">
                <div class="space-y-2 sm:space-x-2 my-4">
                    <button class="modal-close px-5 py-2 bg-gray-500 rounded-full text-gray-200 font-semibold hover:bg-gray-800 dark:hover:bg-gray-600 hover:text-gray-100 focus:outline-none">No, Keep it.</button>
                    <button class="modal-close px-5 py-2 bg-red-500 dark:bg-gray-100 rounded-full text-gray-200 dark:text-gray-700 font-semibold hover:bg-red-600 dark:hover:bg-white hover:text-gray-100 dark:hover:text-gray-800 focus:outline-none">Yes, Delete media!</button>
                </div>
            </div>
        </div>
    </div>
</div>