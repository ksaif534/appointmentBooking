@props(['disabled' => false])

<select name="role" {{ $attributes->merge(['class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) }}>
    <option value="customer">{{ __('customer') }}</option>
    <option value="staff">{{ __('staff') }}</option>
</select>
