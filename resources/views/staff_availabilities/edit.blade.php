<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Availability') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('staff-availabilities.update', $staffAvailability->id) }}">
                        @csrf
                        @method('PUT')

                        <!-- Staff Member -->
                        <div class="mb-4">
                            <x-input-label for="staff_id" :value="__('Staff Member')" />
                            <select id="staff_id" name="staff_id"
                                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                required>
                                <option value="">Select Staff Member</option>
                                @foreach ($staff as $member)
                                    <option value="{{ $member->id }}"
                                        {{ (old('staff_id') ?? $staffAvailability->staff_id) == $member->id ? 'selected' : '' }}>
                                        {{ $member->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('staff_id')" class="mt-2" />
                        </div>

                        <!-- Weekday -->
                        <div class="mb-4">
                            <x-input-label for="weekday" :value="__('Weekday')" />
                            <select id="weekday" name="weekday"
                                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                required>
                                <option value="">Select Weekday</option>
                                <option value="0"
                                    {{ (old('weekday') ?? $staffAvailability->weekday) == 0 || (old('weekday') ?? $staffAvailability->weekday) === 'sun' ? 'selected' : '' }}>
                                    Sunday
                                </option>
                                <option value="1"
                                    {{ (old('weekday') ?? $staffAvailability->weekday) == 1 || (old('weekday') ?? $staffAvailability->weekday) === 'mon' ? 'selected' : '' }}>
                                    Monday
                                </option>
                                <option value="2"
                                    {{ (old('weekday') ?? $staffAvailability->weekday) == 2 || (old('weekday') ?? $staffAvailability->weekday) === 'tue' ? 'selected' : '' }}>
                                    Tuesday
                                </option>
                                <option value="3"
                                    {{ (old('weekday') ?? $staffAvailability->weekday) == 3 || (old('weekday') ?? $staffAvailability->weekday) === 'wed' ? 'selected' : '' }}>
                                    Wednesday</option>
                                <option value="4"
                                    {{ (old('weekday') ?? $staffAvailability->weekday) == 4 || (old('weekday') ?? $staffAvailability->weekday) === 'thu' ? 'selected' : '' }}>
                                    Thursday</option>
                                <option value="5"
                                    {{ (old('weekday') ?? $staffAvailability->weekday) == 5 || (old('weekday') ?? $staffAvailability->weekday) === 'fri' ? 'selected' : '' }}>
                                    Friday
                                </option>
                                <option value="6"
                                    {{ (old('weekday') ?? $staffAvailability->weekday) == 6 || (old('weekday') ?? $staffAvailability->weekday) === 'sat' ? 'selected' : '' }}>
                                    Saturday</option>
                            </select>
                            <x-input-error :messages="$errors->get('weekday')" class="mt-2" />
                        </div>

                        <!-- Start Time -->
                        <div class="mb-4">
                            <x-input-label for="start_time" :value="__('Start Time')" />
                            <x-text-input id="start_time" class="block mt-1 w-full" type="time" name="start_time"
                                :value="old(
                                    'start_time',
                                    \Carbon\Carbon::parse($staffAvailability->start_time)->format('H:i'),
                                )" required />
                            <x-input-error :messages="$errors->get('start_time')" class="mt-2" />
                        </div>

                        <!-- End Time -->
                        <div class="mb-4">
                            <x-input-label for="end_time" :value="__('End Time')" />
                            <x-text-input id="end_time" class="block mt-1 w-full" type="time" name="end_time"
                                :value="old(
                                    'end_time',
                                    \Carbon\Carbon::parse($staffAvailability->end_time)->format('H:i'),
                                )" required />
                            <x-input-error :messages="$errors->get('end_time')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('staff-availabilities.index') }}"
                                class="text-gray-600 hover:text-gray-900 mr-4">{{ __('Cancel') }}</a>
                            <x-primary-button class="ml-4">
                                {{ __('Update Availability') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
