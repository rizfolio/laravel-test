 
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New ☕️ Sale') }}
        </h2>
    </x-slot>




    <div class="py-12">
    <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow rounded p-6">
            <form wire:submit.prevent="save">
                <div class="grid grid-cols-6 gap-4 items-end">
                    <!-- Product Dropdown -->
                    <div class="col-span-1 none">
                        <label class="block text-sm">Product</label>
                        <select wire:model.live="product_id" class="w-full border-gray-300 rounded">
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Quantity -->
                    <div class="col-span-1">
                        <label class="block text-sm">Quantity</label>
                        <input type="number" wire:model.live="quantity"  value="" class="w-full border-gray-300 rounded">
                    </div>

                    <!-- Unit Cost -->
                    <div class="col-span-1">
                        <label class="block text-sm">Unit Cost (&pound;)</label>
                        <input type="number" wire:model.live="unit_cost" step="0.01" class="w-full border-gray-300 rounded">
                    </div>

                 
 

                    <!-- Selling Price -->
                    <div class="col-span-1">
                        <label class="block text-sm font-semibold text-green-700">Selling Price (&pound;)</label>
                        <input type="text" readonly wire:model.live="selling_price" class="w-full border-green-300 rounded bg-green-50 font-bold text-green-700">
                    </div>

 
                    <div class="col-span-1">

                    <button type="button"   
 
                        @click="
                            if ($wire.quantity && $wire.unit_cost) {
                                $dispatch('confirm-sale')
                            } else {
                                alert('Please enter both Quantity and Unit Cost before confirming.')
                            }
                        "

                        class="px-4 py-2 bg-green-600 text-white rounded">
                        Review & Confirm
                    </button>

                 </div>
                </div>

            

            </form>
        </div>
 

            <div class="mt-10 bg-white p-6 rounded shadow">
                <h3 class="text-lg font-semibold mb-3">Recent Sales</h3>
                <table class="w-full table-auto border text-sm border-sky-500/100">
                    <thead class="bg-sky-500/100 text-white  text-lg">
                        <tr>
                            <th class="px-4 py-2">Product</th>
                            <th class="px-4 py-2 text-left ">Quantity</th>
                            <th class="px-4 py-2 text-left">Unit Cost</th>
                            <th class="px-4 py-2 text-left">Selling Price</th>
                            <th class="px-4 py-2 text-left">Sold At</th>
                             
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentSales as $sale)
                            <tr class=" border-b border-sky-500/100">
                                <td class="px-4 py-2">{{ $sale->product->name }}</td>
                                <td class="px-4 py-2">{{ $sale->quantity }}</td>
                                <td class="px-4 py-2 bg-sky-500/50">&pound;{{ number_format($sale->unit_cost, 2) }}</td>
                                <td class="px-4 py-2">&pound;{{ number_format($sale->selling_price, 2) }}</td>
                                <td class="px-4 py-2">{{ $sale->sold_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
 


 

 <!-- Confirmation Modal -->
 <div
    x-data="{
        showConfirm: false,
        productName: @entangle('product_name'),
        quantity: @entangle('quantity'),
        unitCost: @entangle('unit_cost'),
        commission: @entangle('commission'),
        shippingCost: @entangle('shipping_cost'),
        sellingPrice: @entangle('selling_price')
    }"
    @confirm-sale.window="showConfirm = true"
>
    <template x-if="showConfirm">
        <div class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
            <div class="bg-white p-6 rounded shadow-md max-w-md w-full">
                <h2 class="text-lg font-semibold mb-4">Confirm Sale</h2>

                <div class="space-y-2 text-sm">
                    <p><strong>Product:</strong> <span x-text="productName"></span></p>
                    <p><strong>Quantity:</strong> <span x-text="quantity"></span></p>
                    <p><strong>Unit Cost:</strong> &pound;<span x-text="unitCost"></span></p>
                    <p><strong>Commission:</strong> <span x-text="(commission * 100).toFixed(0) + '%'"></span></p>
                    <p><strong>Shipping Cost:</strong> &pound;<span x-text="shippingCost"></span></p>
                    <p><strong>Selling Price:</strong> &pound;<span x-text="sellingPrice"></span></p>
                </div>

                <div class="mt-4 flex justify-end space-x-2">
                    <button @click="showConfirm = false" class="px-4 py-2 bg-gray-300 rounded">Cancel</button>
                    <button wire:click="save"  @click="showConfirm = false" class="px-4 py-2 bg-blue-600 text-white rounded">Confirm</button>
                </div>
            </div>
        </div>
    </template>
</div>
