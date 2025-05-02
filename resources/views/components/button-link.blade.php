@props([
    'url'=>'/',
    'icon'=>null,
    'bgClass'=> 'bg-gray-300',
    'hoverClass'=>'hover:bg-gray-400',
    'textClass'=>'text-white',
    'block'=>false
    ])

<a href="{{$url}}" class="{{$bgClass}} {{$hoverClass}} {{$textClass}} {{$block ? 'block' : ''}} px-4 py-2 rounded hover:shadow-md transition duration-300">
    @if ($icon)
        <i class="fa fa-{{$icon}}"></i>
    @endif
    {{$slot}}
</a>
