   <!-- Current: "bg-gray-900 text-white", Default: "text-gray-300 hover:bg-gray-700 hover:text-white" -->
   @props(['active' => false])

   <a {{$attributes}} class=" {{ $active ? 'bg-gray-700 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white'}} px-3 py-2 text-sm font-medium text-white rounded-md">{{$slot}}</a>