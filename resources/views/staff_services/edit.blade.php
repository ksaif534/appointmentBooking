<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Assignment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('staff-services.update', $staffService->id) }}">
                        @csrf
                        @method('PUT')

                        @if ($errors->has('error'))
                            <div class="mb-4 text-red-600">
                                {{ $errors->first('error') }}
                            </div>
                        @endif

                        <!-- Staff Member -->
                        <div class="mb-4">
                            <x-input-label for="staff_id" :value="__('Staff Member')" />
                            <select id="staff_id" name="staff_id"
                                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                required>
                                <option value="">Select Staff Member</option>
                                @foreach ($staff as $member)
                                    <option value="{{ $member->id }}"
                                        {{ (old('staff_id') ?? $staffService->staff_id) == $member->id ? 'selected' : '' }}>
                                        {{ $member->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('staff_id')" class="mt-2" />
                        </div>

                        <!-- Service -->
                        <div class="mb-4">
                            <x-input-label for="service_id" :value="__('Service')" />
                            <select id="service_id" name="service_id"
                                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                required>
                                <option value="">Select Service</option>
                                @foreach ($services as $service)
                                    <option value="{{ $service->id }}"
                                        {{ (old('service_id') ?? $staffService->service_id) == $service->id ? 'selected' : '' }}>
                                        {{ $service->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('service_id')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('staff-services.index') }}"
                                class="text-gray-600 hover:text-gray-900 mr-4">{{ __('Cancel') }}</a>
                            <x-primary-button class="ml-4">
                                {{ __('Update Assignment') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
