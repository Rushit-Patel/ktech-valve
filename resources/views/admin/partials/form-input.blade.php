{{-- Form Input Component --}}
@props([
    'type' => 'text',
    'name',
    'id' => $name,
    'label',
    'value' => old($name),
    'placeholder' => '',
    'required' => false,
    'disabled' => false,
    'readonly' => false,
    'rows' => null,
    'class' => '',
    'help' => null
])

@php
    $hasError = $errors->has($name);
    $baseClasses = 'w-full px-3 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500';
    $borderClass = $hasError ? 'border-red-300' : 'border-gray-300';
    $inputClasses = $baseClasses . ' ' . $borderClass . ' ' . $class;
@endphp

<div>
    @if($label)
        <label for="{{ $id }}" class="block text-sm font-medium text-gray-700 mb-2">
            {{ $label }}
            @if($required)
                <span class="text-red-500">*</span>
            @endif
        </label>
    @endif
    
    @if($type === 'textarea')
        <textarea 
            id="{{ $id }}" 
            name="{{ $name }}" 
            @if($rows) rows="{{ $rows }}" @endif
            @if($placeholder) placeholder="{{ $placeholder }}" @endif
            @if($required) required @endif
            @if($disabled) disabled @endif
            @if($readonly) readonly @endif
            class="{{ $inputClasses }}"
        >{{ $value }}</textarea>
    @elseif($type === 'select')
        <select 
            id="{{ $id }}" 
            name="{{ $name }}"
            @if($required) required @endif
            @if($disabled) disabled @endif
            class="{{ $inputClasses }}"
        >
            {{ $slot }}
        </select>
    @else
        <input 
            type="{{ $type }}" 
            id="{{ $id }}" 
            name="{{ $name }}" 
            value="{{ $value }}"
            @if($placeholder) placeholder="{{ $placeholder }}" @endif
            @if($required) required @endif
            @if($disabled) disabled @endif
            @if($readonly) readonly @endif
            class="{{ $inputClasses }}"
        >
    @endif
    
    @error($name)
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
    
    @if($help)
        <p class="mt-1 text-sm text-gray-500">{{ $help }}</p>
    @endif
</div>
