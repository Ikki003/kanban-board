<div class="fixed inset-0 flex items-center justify-center z-50 hidden" id="popup">
    <div class="fixed inset-0 bg-black opacity-50"></div>
    <div class="flex flex-col w-11/12 sm:w-5/6 lg:w-1/2 max-w-2xl mx-auto rounded-lg border border-gray-300 shadow-xl bg-white z-10" style="max-height: 80vh;">
        <div class="flex flex-row justify-between p-6 bg-white border-b border-gray-200 rounded-tl-lg rounded-tr-lg">
            <p class="font-semibold text-gray-800">Cabecera</p>
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </div>
        <div class="flex flex-col px-6 py-5 bg-gray-50 overflow-y-auto">

            <div class="w-full mt-2 sm:mt-0">
                <p class="mb-2 font-semibold text-gray-700">{{ __('Name') }}</p>
                <input type="text" class="w-full p-5 bg-white border border-gray-200 rounded shadow-sm appearance-none">
            </div>
            <!-- Contenido del popup -->
        
            <div class="w-full mt-2 sm:mt-0">
                <p class="mb-2 font-semibold text-gray-700">{{ __('Description') }}</p>
                <input type="text" class="w-full p-5 bg-white border border-gray-200 rounded shadow-sm appearance-none h-45">
            </div>

            <p class="mb-2 font-semibold text-gray-700 mt-3">Bots Message</p>
            

            <div class="flex flex-col sm:flex-row items-center mb-5 sm:space-x-5">
                <div class="p-2 rounded shadow-sm border-gray-100 bg-white border-2 w-full sm:w-1/2 mt-2 sm:mt-0">
                    <h3 class="text-sm mb-3 text-gray-700">{{$tarea->name}}</h3>
                    <p>Tarea 1</p>
                    <p>Tarea 1</p>
                    <p>Tarea 1</p>
                    <p>Tarea 1</p>
                    <p>Tarea 1</p>
                    <p>Tarea 1</p>
                    <p>Tarea 1</p>
                    <p>Tarea 1</p>
                    <p>Tarea 1</p>
                    <p>Tarea 1</p>
                    <p>Tarea 1</p>
                    <p>Tarea 1</p>
                    <p>Tarea 1</p>
                    <p>Tarea 1</p>
                    <p>Tarea 1</p>
                    <p>Tarea 1</p>
                </div>
                
                <div class="relative max-w-sm sm:w-1/2 mt-2">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                    </div>
                    <input datepicker type="text" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Select date">
                </div>

            </div>

    
        </div>
        <div class="flex flex-row justify-between p-5 bg-white border-t border-gray-200 rounded-bl-lg rounded-br-lg">
            <p class="font-semibold text-gray-600">Footer</p>
            <button class="px-4 py-2 text-white font-semibold bg-blue-500 rounded">
                Save
            </button>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/datepicker.min.js"></script>
