<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight dark:text-gray-200">
                {{ __('Manage Products') }}
            </h2>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8">
        <div class="flex items-center justify-between">
            <a href="{{ route('products.create') }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-600">Create</a>

            <form action="{{ route('products.index') }}" method="GET" class="w-full sm:w-1/3 lg:w-1/4 flex items-center ml-4">
                <label for="table-search" class="sr-only">Search</label>
                <input name="filter[search]" type="search" placeholder="Search..." value="{{ request('filter.search') }}" class="flex-grow p-2 border border-gray-300 rounded"/>
                <button type="submit" class="ml-2 p-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">Search</button>
            </form>
        </div>
    </div>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 relative overflow-x-auto shadow-md sm:rounded-lg mb-4">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs text-gray-700 dark:text-gray-300 uppercase bg-gray-50 dark:bg-gray-700">
                        <tr>
                        <th scope="col" class="px-6 py-3">
                                <a href="{{ request()->fullUrlWithQuery(['sort' => request()->input('sort') === 'name' ? '-name' : 'name']) }}">
                                    Name
                                </a>
                            </th>
                            <th scope="col" class="px-6 py-3">Description</th>
                            <th scope="col" class="px-6 py-3">
                                <a href="{{ request()->fullUrlWithQuery(['sort' => request()->input('sort') === 'price' ? '-price' : 'price']) }}">
                                    Price
                                </a>
                            </th>                            
                            <th scope="col" class="px-6 py-3">
                                <a href="{{ request()->fullUrlWithQuery(['sort' => request()->input('sort') === 'qty' ? '-qty' : 'qty']) }}">
                                    Quantity
                                </a>
                            </th>
                            <th scope="col" class="px-6 py-3">Created At</th>
                            <th scope="col" class="px-6 py-3">Updated At</th>
                            <th scope="col" class="px-6 py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr class="odd:bg-white even:bg-gray-50 dark:odd:bg-gray-800 dark:even:bg-gray-700 border-b dark:border-gray-600">
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-gray-200 whitespace-nowrap">{{ $product->name }}</td>
                                <td class="px-6 py-4 dark:text-gray-200">{{ $product->description }}</td>
                                <td class="px-6 py-4 dark:text-gray-200">${{ number_format($product->price, 2) }}</td>
                                <td class="px-6 py-4 dark:text-gray-200">{{ $product->qty }}</td>
                                <td class="px-6 py-4 dark:text-gray-200">{{ $product->created_at }}</td>
                                <td class="px-6 py-4 dark:text-gray-200">{{ $product->updated_at }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex space-x-2">
                                        <a href="{{ route('products.edit', $product->id) }}" class="text-indigo-600 hover:text-indigo-900 dark:text-indigo-400 dark:hover:text-indigo-600">Edit</a>
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-600">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{ $products->links() }}
        </div>
    </div>
</x-app-layout>