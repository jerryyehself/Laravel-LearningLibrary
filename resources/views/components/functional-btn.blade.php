<button type="{{ isset($type) ? $type : 'button' }}" @class($class) form="main"
    name="{{ $name }}Btn" id="{{ $id }}" value="{{ $value }}">
    {{ $label }}
</button>
