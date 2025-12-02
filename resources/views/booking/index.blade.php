<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Book an Appointment') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Select a Service</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($services as $service)
                            <div class="border rounded-lg p-6 hover:shadow-lg transition-shadow duration-200">
                                <h4 class="text-xl font-bold mb-2">{{ $service->name }}</h4>
                                <p class="text-gray-600 mb-4 h-12 overflow-hidden">
                                    {{ Str::limit($service->description, 100) }}</p>
                                <div class="flex justify-between items-center mb-4">
                                    <span class="text-sm text-gray-500">{{ $service->duration_minutes }} mins</span>
                                    <span class="font-bold text-indigo-600">${{ $service->price }}</span>
                                </div>
                                <a href="{{ route('booking.create', $service->id) }}"
                                    class="block w-full text-center bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                                    Book Now
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
