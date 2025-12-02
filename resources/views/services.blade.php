<x-public-layout>
    <div class="bg-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="lg:text-center">
                <h2 class="text-base text-indigo-600 font-semibold tracking-wide uppercase">Our Services</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                    Choose the perfect service for you
                </p>
                <p class="mt-4 max-w-2xl text-xl text-gray-500 lg:mx-auto">
                    We offer a wide range of professional services designed to meet your specific needs.
                </p>
            </div>

            <div class="mt-10">
                <div class="grid grid-cols-1 gap-y-10 sm:grid-cols-2 gap-x-6 lg:grid-cols-3 xl:gap-x-8">
                    @foreach ($services as $service)
                        <div
                            class="group relative bg-white border border-gray-200 rounded-lg flex flex-col overflow-hidden hover:shadow-lg transition-shadow duration-300">
                            <div class="aspect-w-3 aspect-h-2 bg-gray-200 group-hover:opacity-75 sm:aspect-none sm:h-48">
                                <img src="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60"
                                    alt="{{ $service->name }}"
                                    class="w-full h-full object-center object-cover sm:w-full sm:h-full">
                            </div>
                            <div class="flex-1 p-4 flex flex-col justify-between">
                                <div>
                                    <h3 class="text-lg font-medium text-gray-900">
                                        <a href="{{ route('booking.create', $service->id) }}">
                                            <span aria-hidden="true" class="absolute inset-0"></span>
                                            {{ $service->name }}
                                        </a>
                                    </h3>
                                    <p class="mt-1 text-sm text-gray-500">{{ Str::limit($service->description, 100) }}
                                    </p>
                                </div>
                                <div class="mt-4 flex items-center justify-between">
                                    <p class="text-xl font-semibold text-gray-900">
                                        ${{ number_format($service->price, 2) }}</p>
                                    <p class="text-sm text-gray-500">{{ $service->duration_minutes }} mins</p>
                                </div>
                            </div>
                            <div class="p-4 bg-gray-50 border-t border-gray-100">
                                <a href="{{ route('booking.create', $service->id) }}"
                                    class="w-full flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700">
                                    Book Now
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-public-layout>
