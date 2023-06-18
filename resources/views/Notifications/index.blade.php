@include('layouts.app')
@include('Notifications.alert')

<div class="bg-white pt-12 pr-0 pb-12 pl-0 mt-0 mr-auto mb-0 ml-auto sm:py-16 lg:py-20">
  <div class="pt-0 pr-4 pb-0 pl-4 mt-0 mr-auto mb-0 ml-auto max-w-7xl sm:px-6 lg:px-8">
    <div class="pt-0 pr-4 pb-0 pl-4 mt-0 mr-auto mb-0 ml-auto max-w-4xl sm:px-6 lg:px-8">
      <div class="pt-0 pr-4 pb-0 pl-4 mt-0 mr-auto mb-0 ml-auto sm:flex sm:items-center sm:justify-between">
        <div>
          <p class="text-xl font-bold text-gray-900">Busca entre todas las notificaciones</p>
          <p class="text-sm mt-1 mr-0 mb-0 ml-0 font-semi-bold text-gray-500"></p>
        </div>
        <div class="mt-4 mr-0 mb-0 ml-0 sm:mt-0 flex">
          <form id="search_notification" action="{{ route('notifications.searchNotification') }}" method="POST">
            <button id="dropdownStates" data-dropdown-toggle="dropdown" class="bg-white-500 text-gray font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-4 mt-4 ease-linearvtransition-all duration-150" type="button">
              <span class="flex items-center"> 
                  {{ __('Estados') }}
                  <svg class="w-4 h-4 ml-2" aria-hidden="true" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                  </svg>
              </span>
            </button>
                      <!-- Dropdown menu -->
            <div id="dropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="multiLevelDropdownButton">
                    @foreach ($estados_notificaciones as $name=>$id)
                      <li>
                        <input type="hidden" name="filter_state_input" value="">
                        <p name="filter_state" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white" data-id="{{ $id }}">{{ $name }}</p>
                      </li>
                    @endforeach                  
                </ul>
            </div>
            @csrf
            @method("POST")
          </form>
          {{-- }<form id="read" action="{{ route('notifications.read') }}" method="POST">
            <button id="readNotification" class="ml-2 bg-white-500 text-gray font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none mr-1 mb-4 mt-4 ease-linearvtransition-all duration-150" type="submit">
              <span class="flex items-center"> 
                  {{ __('Leer notificaciones') }}
              </span>
            </button>
            @csrf
            @method("POST")
          </form> --}}
        </div>
      </div>
      <div class="shadow-xl mt-8 mr-0 mb-0 ml-0 pt-4 pr-10 pb-4 pl-10 flow-root rounded-lg sm:py-2">
        <div class="pt--10 pr-0 pb-10 pl-0">
        @if(count($notifications) === 0)
        <div class="flex items-center flex-1 min-w-0">
          <div class="mt-0 mr-0 mb-0 ml-4 flex-1 min-w-0 text-center">
              <p class="text-lg font-bold text-gray-800 truncate items-center mt-2">{{ __('No se ha encontrado ninguna notificación') }}</p>
          </div>
        </div>
        @else
          @foreach($notifications as $notification)
          <div class="rounded-lg bg-white shadow-md p-6 mb-5">
            <input type="hidden" name="notification_data" value="{{ $notification }}">
            <div class="grid grid-cols-2 gap-4"> 
              <div>
                <div class="flex items-center mb-4">
                  <img src="https://d34u8crftukxnk.cloudfront.net/slackpress/prod/sites/6/SlackLogo_CompanyNews_SecondaryAubergine_Hero.jpg?d=500x500&amp;f=fill" class="w-12 h-12 rounded-full object-cover mr-4" />
                  <div>
                    <p class="text-lg font-bold text-gray-800">{{ $notification->message }}</p>
                    @if(auth()->user()->id == $notification->sender->id)
                      <p class="text-gray-600 text-sm">{{ __('Para: ') .$notification->receiver->name }}</p>
                    @endif
                    @if(auth()->user()->id == $notification->receiver->id)
                      <p class="text-gray-600 text-sm">{{ __('De: ') .$notification->sender->name }}</p>
                    @endif
                  </div>
                </div>
              </div>
              @if($notification->estado_notificacion_id == 1 && $notification->user_receptor_id == auth()->user()->id)
                <div class="flex items-center justify-end">
                  <button type="button" id="accept" class="bg-blue-500 text-white py-2 px-4 rounded-lg text-sm hover:bg-blue-700 transition-all duration-200 mr-3" onclick="manageRequest({{$notification}}, 'accept')">Aceptar</button>
                  <button type="button" id="decline" class="bg-red-500 text-white py-2 px-4 rounded-lg text-sm hover:bg-red-700 transition-all duration-200" onclick="manageRequest({{$notification}}, 'decline')">Rechazar</button>
                  <input type="hidden" id="manage_request" value="{{ route('usuarios_proyectos.store') }}">
                  <input type="hidden" id="manage_request_token" value="{{ csrf_token() }}">
                </div>
              @elseif($notification->estado_notificacion_id == 1 && !($notification->user_receptor_id == auth()->user()->id))
                <div class="flex items-center justify-end">
                  <button type="button" class="bg-purple-400 text-white py-2 px-4 rounded-lg text-sm hover:bg-purple-700 transition-all duration-200 mr-3" disabled>{{ __('Pendiente') }}</button>
                </div>
              @elseif($notification->estado_notificacion_id == 2)
                <div class="flex items-center justify-end">
                  <button type="button" class="bg-green-400 text-white py-2 px-4 rounded-lg text-sm hover:bg-green-700 transition-all duration-200 mr-3" disabled>{{ __('Aceptada') }}</button>
                </div>
              @elseif($notification->estado_notificacion_id == 3)
              <div class="flex items-center justify-end">
                <button type="button" class="bg-yellow-400 text-white py-2 px-4 rounded-lg text-sm hover:bg-yellow-700 transition-all duration-200 mr-3" disabled>{{ __('Cancelada') }}</button>
              </div>
              @else
              <div class="flex items-center justify-end">
                <button type="button" class="bg-gray-400 text-white py-2 px-4 rounded-lg text-sm hover:bg-gray-700 transition-all duration-200 mr-3" disabled>&nbsp; {{ __('Privada') }} &nbsp;</button>
              </div>
              @endif
            </div>
          </div>
          @endforeach
        @endif
        </div>
      </div>
    </div>
  </div>
</div>

<script src="/js/notificacion.js"></script>