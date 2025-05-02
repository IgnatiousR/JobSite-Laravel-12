@props(['url'=>'/', 'active' => false, 'icon'=>null, 'mobile'=>null])

@if ($mobile)
    <a href="{{$url}}" class="block px-4 py-2 hover:bg-stone-500 rounded {{$active ? 'text-yellow-300 font-bold' : 'text-white'}}">
        @if ($icon)
            <i class="fa fa-{{$icon}}"></i>
        @endif
        {{$slot}}</a>
@else
    <a href="{{$url}}" class=" hover:underline py-2 {{$active ? 'text-yellow-300 font-bold' : 'text-white'}}">
        @if ($icon)
            <i class="fa fa-{{$icon}}"></i>
        @endif
        {{$slot}}
    </a>
@endif
