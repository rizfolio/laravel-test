<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $product->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <ul class="list-group">
                        <li class="list-group-item"><strong>Unit Cost:</strong> &pound;{{ number_format($product->unit_cost, 2) }}</li>
                        <li class="list-group-item"><strong>Commission:</strong> {{ $product->commission }}</li>
                    </ul>
                    <a href="{{ route('products.index') }}" class="btn btn-secondary mt-3">Back</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
