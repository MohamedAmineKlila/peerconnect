@props(['href' => null, 'variant' => 'primary'])

@if ($href)
    <a {{ $attributes->merge(['class' => 'btn btn-' . $variant, 'href' => $href]) }}>{{ $slot }}</a>
@else
    <button {{ $attributes->merge(['class' => 'btn btn-' . $variant]) }}>{{ $slot }}</button>
@endif
