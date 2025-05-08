<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Coffee Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if (session('success'))
                    <div class="mb-4 text-green-700 bg-green-100 border border-green-300 rounded p-3">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="flex justify-between mb-4">
                    <h3 class="text-lg font-semibold">Product List</h3>
                    <a href="{{ route('products.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        + Add Product
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white text-sm border">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 border">Name</th>
                                <th class="px-4 py-2 border">Unit Cost</th>
                                <th class="px-4 py-2 border">Commission</th>
                                <th class="px-4 py-2 border">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $product)
                                <tr>
                                    <td class="px-4 py-2 border">{{ $product->name }}</td>
                                    <td class="px-4 py-2 border">&pound;{{ number_format($product->unit_cost, 2) }}</td>
                                    <td class="px-4 py-2 border">{{ $product->commission }}</td>
                                    <td class="px-4 py-2 border space-x-2">
                                        <a href="{{ route('products.show', $product) }}" class="text-blue-600 hover:underline">View</a>
                                        <a href="{{ route('products.edit', $product) }}" class="text-yellow-600 hover:underline">Edit</a>
                                        <form action="{{ route('products.destroy', $product) }}" method="POST" class="inline">
                                            @csrf @method('DELETE')
                                            <button class="text-red-600 hover:underline" onclick="return confirm('Delete this product?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center px-4 py-3">No products found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
