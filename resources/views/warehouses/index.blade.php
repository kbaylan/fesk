<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Warehouses') }}
        </h2>
    </x-slot>


    <div class="py-12">

        
        <div class="mx-auto max-w-5xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if (session()->has('status'))
                    <div class="flex justify-center items-center">

                        <p class="ml-3 text-sm font-bold text-green-600">{{ session()->get('status') }}</p>
                    </div>
                    @endif

                    <div class="mt-1 mb-4">

                        <x-primary-button>
                            <a href="{{ route('warehouses.create') }}">{{ __('Add Warehouse') }}</a>
                        </x-primary-button>
                    </div>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        #
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Address
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Edit
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Delete
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($warehouses as $warehouse)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                        {{ $warehouse->id }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $warehouse->name }}

                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $warehouse->address }}
                                    </td>
                                    <td class="px-6 py-4 ">
                                        
                                            <div  style="{{ $warehouse->status == '1' ? 'background-color:#22c55e;' : 'background-color:#ef4444;' }}" class="rounded-full w-5 h-5  "></div>

                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('warehouses.edit', $warehouse->id) }}">Edit</a>
                                    </td>
                                    <td class="px-6 py-4">
                                        <form action="{{ route('warehouses.destroy', $warehouse->id) }}" method="POST"
                                            onsubmit="return confirm('{{ trans('are You Sure ? ') }}');"
                                            style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="px-4 py-2 text-white bg-red-700 rounded" style="background-color:#ef4444;border:1px;"
                                                value="Delete">
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>