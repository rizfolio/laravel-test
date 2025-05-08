<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700">Name</label>
    <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}"
           class="mt-1 block w-full border-gray-300 rounded shadow-sm" required>
</div>

<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700">Unit Cost</label>
    <input type="number" name="unit_cost" step="0.01" value="{{ old('unit_cost', $product->unit_cost ?? '') }}"
           class="mt-1 block w-full border-gray-300 rounded shadow-sm" required>
</div>

<div class="mb-4">
    <label class="block text-sm font-medium text-gray-700">Commission</label>
    <input type="number" name="commission" step="0.01" value="{{ old('commission', $product->commission ?? '') }}"
           class="mt-1 block w-full border-gray-300 rounded shadow-sm" required>
</div>

<div class="flex items-center gap-4">
    <button class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Save</button>
    <a href="{{ route('products.index') }}" class="text-gray-600 hover:underline">Cancel</a>
</div>
