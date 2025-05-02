@props(['id', 'name', 'label' => null, 'type' => 'text', 'value' => '', 'placeholder' => '', 'required' => false])

<div class="mb-4">
    @if($label)
    <label class="block font-bold mb-1" for="{{$id}}">{{$label}}</label>
    @endif
    <input id="{{$id}}" type="{{$type}}" name="{{$name}}"
        class="w-full px-4 py-2 border rounded focus:outline-1 bg-white/10  @error($name) border-red-500 @else border-white/10 @enderror"
        placeholder="{{$placeholder}}" value="{{old($name, $value)}}" {{$required ? 'required' : '' }} />
    @error($name)
    <p class="text-red-500 text-xs mt-1 italic">{{$message}}</p>
    @enderror
</div>
