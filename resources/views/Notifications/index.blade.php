@include('layouts.app')
@include('Notifications.alert')

{{-- <div class="mx-auto container py-20 px-6">
    <div class="grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($notifications as $notification) 
        <div class="rounded"> 
            <div class="w-full h-64 flex flex-col justify-between dark:bg-gray-800 bg-white dark:border-gray-700 rounded-lg border border-gray-400 mb-6 py-5 px-4">
                <div>
                    <h4 class="text-gray-800 dark:text-gray-100 font-bold mb-3"></h4>
                    <p class="text-gray-800 dark:text-gray-100 text-sm">Our interior design experts work with you to create the space that you have been dreaming about.</p>
                </div>
                <div>
                <div class="flex items-center justify-between text-gray-800 dark:text-gray-100">
                    <p class="text-sm">March 28, 2020</p>
                    <button class="w-8 h-8 rounded-full bg-gray-800 dark:bg-gray-100 dark:text-gray-800 text-white flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-offset-2  focus:ring-black" aria-label="edit note" role="button">
                        <svg  xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-pencil" width="20" height="20" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z"></path>
                            <path d="M4 20h4l10.5 -10.5a1.5 1.5 0 0 0 -4 -4l-10.5 10.5v4"></path>
                            <line x1="13.5" y1="6.5" x2="17.5" y2="10.5"></line>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        @endforeach    
    </div>
</div> --}}

<div class="bg-white pt-12 pr-0 pb-12 pl-0 mt-0 mr-auto mb-0 ml-auto sm:py-16 lg:py-20">
  <div class="pt-0 pr-4 pb-0 pl-4 mt-0 mr-auto mb-0 ml-auto max-w-7xl sm:px-6 lg:px-8">
    <div class="pt-0 pr-4 pb-0 pl-4 mt-0 mr-auto mb-0 ml-auto max-w-4xl sm:px-6 lg:px-8">
      <div class="pt-0 pr-4 pb-0 pl-4 mt-0 mr-auto mb-0 ml-auto sm:flex sm:items-center sm:justify-between">
        <div>
          <p class="text-xl font-bold text-gray-900">Busca entre todos los proyectos</p>
          <p class="text-sm mt-1 mr-0 mb-0 ml-0 font-semi-bold text-gray-500">Lorem ipsum dolor sit amet, consectetur
              adipis</p>
        </div>
        <div class="mt-4 mr-0 mb-0 ml-0 sm:mt-0">
          <p class="sr-only">Search Position</p>
          <div class="relative">
            <div class="flex items-center pt-0 pr-0 pb-0 pl-3 absolute inset-y-0 left-0 pointer-events-none">
              <p>
                <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewbox="0 0 24 24"
                    stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21
                    21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
              </p>
            </div>
            <input placeholder="Search Positions " type="search" class="border block pt-2 pr-0 pb-2 pl-10 w-full py-2
                pl-10 border border-gray-300 rounded-lg focus:ring-indigo-600 focus:border-indigo-600 sm:text-sm"/>
          </div>
        </div>
      </div>
      <div class="shadow-xl mt-8 mr-0 mb-0 ml-0 pt-4 pr-10 pb-4 pl-10 flow-root rounded-lg sm:py-2">
        <div class="pt--10 pr-0 pb-10 pl-0">
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
        </div>
      </div>
    </div>
  </div>
</div>

<script src="/js/notificacion.js"></script>