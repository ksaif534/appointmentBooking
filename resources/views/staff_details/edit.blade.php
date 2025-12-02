<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Staff Detail') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('staff-details.update', $staffDetail->id) }}">
                        @csrf
                        @method('PUT')

                        <!-- Staff Member -->
                        <div class="mb-4">
                            <x-input-label for="user_id" :value="__('Staff Member')" />
                            <select id="user_id" name="user_id"
                                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                required>
                                <option value="">Select Staff Member</option>
                                @foreach ($staff as $member)
                                    <option value="{{ $member->id }}"
                                        {{ (old('user_id') ?? $staffDetail->user_id) == $member->id ? 'selected' : '' }}>
                                        {{ $member->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('user_id')" class="mt-2" />
                        </div>

                        <!-- Bio -->
                        <div class="mb-4">
                            <x-input-label for="bio" :value="__('Bio')" />
                            <textarea id="bio" name="bio"
                                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                rows="3">{{ old('bio') ?? $staffDetail->bio }}</textarea>
                            <x-input-error :messages="$errors->get('bio')" class="mt-2" />
                        </div>

                        <!-- Specialization -->
                        <div class="mb-4">
                            <x-input-label for="specialization" :value="__('Specialization')" />
                            <x-text-input id="specialization" class="block mt-1 w-full" type="text"
                                name="specialization" :value="old('specialization') ?? $staffDetail->specialization" />
                            <x-input-error :messages="$errors->get('specialization')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('staff-details.index') }}"
                                class="text-gray-600 hover:text-gray-900 mr-4">{{ __('Cancel') }}</a>
                            <x-primary-button class="ml-4">
                                {{ __('Update Staff Detail') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
