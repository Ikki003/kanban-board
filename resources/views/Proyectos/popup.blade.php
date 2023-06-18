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
                        {{ __('Crear') }}
                    </button>
                </div>
            </div>
    </div>
</div>