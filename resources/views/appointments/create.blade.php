<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Appointment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('appointments.store') }}">
                        @csrf

                        <!-- Customer -->
                        <div class="mb-4">
                            <x-input-label for="customer_id" :value="__('Customer')" />
                            <select id="customer_id" name="customer_id"
                                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                required>
                                <option value="">Select Customer</option>
                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}"
                                        {{ old('customer_id') == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('customer_id')" class="mt-2" />
                        </div>

                        <!-- Staff -->
                        <div class="mb-4">
                            <x-input-label for="staff_id" :value="__('Staff')" />
                            <select id="staff_id" name="staff_id"
                                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                required>
                                <option value="">Select Staff</option>
                                @foreach ($staff as $member)
                                    <option value="{{ $member->id }}"
                                        {{ old('staff_id') == $member->id ? 'selected' : '' }}>
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
                                        {{ old('service_id') == $service->id ? 'selected' : '' }}>
                                        {{ $service->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('service_id')" class="mt-2" />
                        </div>

                        <!-- Date -->
                        <div class="mb-4">
                            <x-input-label for="date" :value="__('Date')" />
                            <x-text-input id="date" class="block mt-1 w-full" type="date" name="date"
                                :value="old('date')" required />
                            <x-input-error :messages="$errors->get('date')" class="mt-2" />
                        </div>

                        <!-- Start Time -->
                        <div class="mb-4">
                            <x-input-label for="start_time" :value="__('Start Time')" />
                            <x-text-input id="start_time" class="block mt-1 w-full" type="time" name="start_time"
                                :value="old('start_time')" required />
                            <x-input-error :messages="$errors->get('start_time')" class="mt-2" />
                        </div>

                        <!-- End Time -->
                        <div class="mb-4">
                            <x-input-label for="end_time" :value="__('End Time')" />
                            <x-text-input id="end_time" class="block mt-1 w-full" type="time" name="end_time"
                                :value="old('end_time')" required />
                            <x-input-error :messages="$errors->get('end_time')" class="mt-2" />
                        </div>

                        <!-- Status -->
                        <div class="mb-4">
                            <x-input-label for="status" :value="__('Status')" />
                            <select id="status" name="status"
                                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                required>
                                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending
                                </option>
                                <option value="confirmed" {{ old('status') == 'confirmed' ? 'selected' : '' }}>
                                    Confirmed</option>
                                <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>
                                    Completed</option>
                                <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>
                                    Cancelled</option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        <!-- Notes -->
                        <div class="mb-4">
                            <x-input-label for="notes" :value="__('Notes')" />
                            <textarea id="notes" name="notes"
                                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                rows="3">{{ old('notes') }}</textarea>
                            <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('appointments.index') }}"
                                class="text-gray-600 hover:text-gray-900 mr-4">{{ __('Cancel') }}</a>
                            <x-primary-button class="ml-4">
                                {{ __('Create Appointment') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
