@props([
    'orientation' => 'horizontal',
])

@if($orientation === 'vertical')
    <div {{ $attributes->class('h-full w-px bg-slate-200') }}></div>
@else
    <hr {{ $attributes->class('border-slate-200') }}>
@endif
