@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'rounded-md bg-green-50 p-3 text-sm text-green-800 border border-green-100']) }}>
        {{ $status }}
    </div>
@endif
