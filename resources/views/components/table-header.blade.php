@props(['field', 'order', 'dir'])
@php
    $name = array_keys($field);
    $title = $field[$name[0]];
@endphp

{{$title}}
@if ($order == $name[0])
    @if ($dir == 'asc')
        <i class="fa-solid fa-arrow-up-short-wide mt-1 float-right"></i>
    @else
        <i class="fa-solid fa-arrow-down-short-wide float-right"></i>
    @endif
@else
    <i class="fa-solid fa-sort float-right mt-1 text-gray-300"></i>
@endif 