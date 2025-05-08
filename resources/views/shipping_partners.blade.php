<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Set new shipment cost 🚚') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Display Flash Message -->
                    @if (session()->has('message'))
                        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                            {{ session('message') }}
                        </div>
                    @endif

                    <!-- Shipping Cost Management Form -->
                    <form action="{{ route('shipping-cost.index') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Shipping Cost</label>
                            <input type="number" name="shipping_cost" step="0.01" class="w-full mt-1 border-gray-300 rounded"
                                value="{{ old('shipping_cost', $shippingCost ? $shippingCost->shipping_cost : '') }}">
                            @error('shipping_cost') <span class="text-red-500">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded">Save Shipping Cost</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
