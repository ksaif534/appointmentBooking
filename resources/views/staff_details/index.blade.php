<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Staff Details') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="{ showDeleteModal: false, deleteAction: '' }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-end mb-4">
                        <a href="{{ route('staff-details.create') }}"
                            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">{{ __('Create Staff Detail') }}</a>
                    </div>

                    <div class="mt-4">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Staff Name</th>
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Bio</th>
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Specialization</th>
                                    <th
                                        class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($staffDetails as $detail)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $detail->user->name }}</td>
                                        <td class="px-6 py-4">{{ Str::limit($detail->bio, 50) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $detail->specialization }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="{{ route('staff-details.edit', $detail->id) }}"
                                                class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                            <button
                                                x-on:click.prevent="$dispatch('open-modal', 'confirm-staff-detail-deletion'); deleteAction = '{{ route('staff-details.destroy', $detail->id) }}'"
                                                class="text-red-600 hover:text-red-900 ml-4">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $staffDetails->links() }}
                    </div>
                </div>
            </div>
        </div>

        <x-modal name="confirm-staff-detail-deletion" focusable>
            <form method="POST" :action="deleteAction" class="p-6">
                @csrf
                @method('DELETE')

                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Are you sure you want to delete this staff detail?') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    {{ __('Once deleted, all of its resources and data will be permanently deleted.') }}
                </p>

                <div class="mt-6 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <x-danger-button class="ml-3">
                        {{ __('Delete Staff Detail') }}
                    </x-danger-button>
                </div>
            </form>
        </x-modal>
    </div>
</x-app-layout>
