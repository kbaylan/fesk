<x-app-layout>
    
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Manufacturers Edit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-5xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('manufacturers.update',$manufacturer->id) }}">
                        @csrf
                        @method('put')
                        <div class="mb-6">
                            <label class="block">
                                <span class="text-gray-700">Title</span>
                                <input type="text" name="name"
                                    class="block w-full mt-1 rounded-md"
                                    placeholder="" value="{{old('title',$manufacturer->name)}}" />
                            </label>
                            @error('name')
                            <div class="text-sm text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-6">
                            <label class="block">
                                <span class="text-gray-700">Description</span>
                                <input type="text" name="description"
                                    class="block w-full mt-1 rounded-md"
                                    placeholder="" value="{{old('slug',$manufacturer->description)}}" />
                            </label>
                            @error('description')
                            <div class="text-sm text-red-600">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-6">


                            <div class="flex items-center mb-4">
                                <input id="default-radio-1" type="radio" value="1" name="status" {{ $manufacturer->status == 1 ? 'checked' : '' }} class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="default-radio-1" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Active</label>
                            </div>
                            <div class="flex items-center">
                                <input id="default-radio-2" type="radio" value="0" name="status" {{ $manufacturer->status == 0 ? 'checked' : '' }} class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <label for="default-radio-2" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Deactive</label>
                            </div>

                            @error('status')
                            <div class="text-sm text-red-600">{{ $message }}</div>
                            @enderror
                        </div>

                        <x-primary-button type="submit">
                            Update
                        </x-primary-button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>