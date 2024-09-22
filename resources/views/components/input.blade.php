<label for="{{ $id }}" class="block text-sm font-medium mb-2">
    {{ $label }}
</label>
<input 
    type="{{ $type }}" 
    id="{{ $id }}" 
    name="{{ $name }}"
    placeholder="{{ $placeholder }}"
    value="{{ $value }}"
    class="py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 transition">
