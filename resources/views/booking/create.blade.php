<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Book Appointment: ') . $service->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="GET" action="{{ route('booking.create', $service->id) }}" id="availability-form"
                        class="mb-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Staff Selection -->
                            <div>
                                <x-input-label for="staff_id" :value="__('Select Staff')" />
                                <select id="staff_id" name="staff_id"
                                    class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    onchange="this.form.submit()">
                                    <option value="">-- Choose Staff --</option>
                                    @foreach ($staff as $member)
                                        <option value="{{ $member->id }}"
                                            {{ $selectedStaffId == $member->id ? 'selected' : '' }}>
                                            {{ $member->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Date Selection -->
                            <div>
                                <x-input-label for="date" :value="__('Select Date')" />
                                <x-text-input id="date" class="block mt-1 w-full" type="date" name="date"
                                    :value="$selectedDate" min="{{ date('Y-m-d') }}" onchange="this.form.submit()" />
                            </div>
                        </div>
                    </form>

                    @if ($selectedStaffId && $selectedDate)
                        <hr class="my-6">

                        <h3 class="text-lg font-medium text-gray-900 mb-4">Available Time Slots</h3>

                        @if (count($availableSlots) > 0)
                            <form method="POST" action="{{ route('booking.store') }}">
                                @csrf
                                <input type="hidden" name="service_id" value="{{ $service->id }}">
                                <input type="hidden" name="staff_id" value="{{ $selectedStaffId }}">
                                <input type="hidden" name="date" value="{{ $selectedDate }}">

                                <div class="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4 mb-6">
                                    @foreach ($availableSlots as $slot)
                                        <label class="cursor-pointer">
                                            <input type="radio" name="start_time" value="{{ $slot }}"
                                                class="peer sr-only" required>
                                            <div
                                                class="rounded-md border border-gray-300 px-4 py-2 text-center hover:bg-gray-50 peer-checked:border-indigo-600 peer-checked:bg-indigo-50 peer-checked:text-indigo-600">
                                                {{ $slot }}
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                                <x-input-error :messages="$errors->get('start_time')" class="mb-4" />

                                <div class="flex justify-end">
                                    <x-primary-button
                                        class="bg-indigo-600 hover:bg-indigo-500 focus:bg-indigo-500 active:bg-indigo-700">
                                        {{ __('Confirm Booking') }}
                                    </x-primary-button>
                                </div>
                            </form>
                        @else
                            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                                <div class="flex">
                                    <div class="ml-3">
                                        <p class="text-sm text-yellow-700">
                                            No available time slots for this staff member on the selected date. Please
                                            try another date or staff member.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
