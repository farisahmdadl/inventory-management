<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Inventory</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#242424] text-gray-100 min-h-screen p-8">
    <div class="max-w-6xl mx-auto">
        <!-- Header dengan tombol aksi & navigasi -->
        <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
            <h1 class="text-2xl font-bold text-cyan-400">Product Inventory</h1>
            <div class="flex flex-wrap items-center gap-3">
                <button type="button" onclick="openAddProductModal()"
                    class="text-sm px-4 py-2 rounded font-semibold bg-cyan-500 hover:bg-cyan-400 text-gray-900 transition shadow">
                    + Add New Product
                </button>
                <a href="{{ route('stock-movements.index') }}" class="text-sm px-4 py-2 rounded bg-cyan-950/60 hover:bg-cyan-900/80 text-cyan-300 border border-cyan-700/60 transition">
                    Stock Movements &rarr;
                </a>
                <a href="{{ url('/') }}" class="text-sm px-4 py-2 rounded bg-[#424243] hover:bg-gray-600 text-gray-200 border border-gray-600 transition">
                    &larr; Back to Home
                </a>
            </div>
        </div>

        <!-- Alert Notifikasi Sukses -->
        @if (session('success'))
            <div class="mb-6 p-4 rounded-lg bg-emerald-900/50 border border-emerald-600 text-emerald-200 text-sm flex items-center justify-between">
                <span>{{ session('success') }}</span>
                <button onclick="this.parentElement.remove()" class="text-emerald-400 hover:text-white">&times;</button>
            </div>
        @endif

        <!-- Alert Notifikasi Error Session -->
        @if (session('error'))
            <div class="mb-6 p-4 rounded-lg bg-red-900/50 border border-red-600 text-red-200 text-sm flex items-center justify-between">
                <span>{{ session('error') }}</span>
                <button onclick="this.parentElement.remove()" class="text-red-400 hover:text-white">&times;</button>
            </div>
        @endif

        <!-- Alert Validasi Form Error -->
        @if ($errors->any())
            <div class="mb-6 p-4 rounded-lg bg-red-900/50 border border-red-600 text-red-200 text-sm">
                <div class="font-semibold mb-1">Terdapat kesalahan input:</div>
                <ul class="list-disc list-inside space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Tabel Produk -->
        <div class="bg-[#424243] rounded-lg shadow overflow-hidden border border-gray-700">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-600 bg-gray-800/50 text-cyan-400 text-sm uppercase">
                        <th class="py-3 px-4">ID</th>
                        <th class="py-3 px-4">SKU</th>
                        <th class="py-3 px-4">Name</th>
                        <th class="py-3 px-4">Category</th>
                        <th class="py-3 px-4">Stock</th>
                        <th class="py-3 px-4 text-right">Price</th>
                        <th class="py-3 px-4 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-600 text-sm">
                    @forelse ($products as $product)
                        <tr class="hover:bg-gray-700/40 transition">
                            <td class="py-3 px-4 font-mono text-gray-400">#{{ $product->id }}</td>
                            <td class="py-3 px-4 font-mono">{{ $product->sku }}</td>
                            <td class="py-3 px-4 font-medium text-white">{{ $product->name }}</td>
                            <td class="py-3 px-4">
                                <span class="px-2 py-1 rounded bg-gray-700 text-cyan-300 text-xs">
                                    {{ $product->category?->name ?? 'Category #' . $product->category_id }}
                                </span>
                            </td>
                            <td class="py-3 px-4">
                                <span class="px-2 py-1 rounded text-xs {{ $product->stock_quantity > 0 ? 'bg-emerald-900/60 text-emerald-300' : 'bg-red-900/60 text-red-300' }}">
                                    {{ $product->stock_quantity }} in stock
                                </span>
                            </td>
                            <td class="py-3 px-4 text-right font-mono text-cyan-300">
                                ${{ number_format($product->price, 2) }}
                            </td>
                            <td class="py-3 px-4 text-center">
                                <div class="inline-flex items-center gap-2">
                                    <!-- Tombol Stok Masuk (IN) -->
                                    <button type="button"
                                        onclick="openStockModal({{ $product->id }}, '{{ addslashes($product->name) }}', {{ $product->stock_quantity }}, 'in')"
                                        class="px-2.5 py-1 rounded text-xs font-semibold bg-emerald-900/60 hover:bg-emerald-700 text-emerald-300 border border-emerald-700/60 transition">
                                        + In
                                    </button>

                                    <!-- Tombol Stok Keluar (OUT) -->
                                    <button type="button"
                                        onclick="openStockModal({{ $product->id }}, '{{ addslashes($product->name) }}', {{ $product->stock_quantity }}, 'out')"
                                        class="px-2.5 py-1 rounded text-xs font-semibold bg-amber-900/60 hover:bg-amber-700 text-amber-300 border border-amber-700/60 transition {{ $product->stock_quantity <= 0 ? 'opacity-40 cursor-not-allowed' : '' }}"
                                        {{ $product->stock_quantity <= 0 ? 'disabled' : '' }}>
                                        - Out
                                    </button>

                                    <!-- Form & Tombol Hapus Produk -->
                                    <form method="POST" action="{{ route('products.destroy', $product->id) }}"
                                        onsubmit="return confirm('Do you really want to delete {{ addslashes($product->name) }}?');"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="px-2.5 py-1 rounded text-xs font-semibold bg-red-900/60 hover:bg-red-700 text-red-300 border border-red-700/60 transition">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-8 text-center text-gray-400">
                                No products found in the database.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal Pop-up Tambah Produk Baru -->
    <div id="addProductModal" class="fixed inset-0 bg-black/70 hidden items-center justify-center z-50 p-4">
        <div class="bg-[#424243] border border-gray-600 rounded-lg max-w-md w-full p-6 shadow-2xl">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-cyan-400">Add New Product</h3>
                <button type="button" onclick="closeAddProductModal()" class="text-gray-400 hover:text-white text-xl leading-none">&times;</button>
            </div>

            <form method="POST" action="{{ route('products.store') }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-xs uppercase text-gray-300 mb-1">Product Name</label>
                    <input type="text" name="name" maxlength="64" required placeholder="Example: Mechanical Keyboard"
                        class="w-full px-3 py-2 rounded bg-[#242424] border border-gray-600 text-white focus:outline-none focus:border-cyan-400 text-sm">
                </div>

                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-xs uppercase text-gray-300 mb-1">SKU (Unique Number)</label>
                        <input type="number" name="sku" required placeholder="100452"
                            class="w-full px-3 py-2 rounded bg-[#242424] border border-gray-600 text-white focus:outline-none focus:border-cyan-400 font-mono text-sm">
                    </div>
                    <div>
                        <label class="block text-xs uppercase text-gray-300 mb-1">Category</label>
                        @if($categories->count() > 0)
                            <select name="category_id" required
                                class="w-full px-3 py-2 rounded bg-[#242424] border border-gray-600 text-white focus:outline-none focus:border-cyan-400 text-sm">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        @else
                            <input type="number" name="category_id" value="1" min="1" required placeholder="ID Kategori"
                                class="w-full px-3 py-2 rounded bg-[#242424] border border-gray-600 text-white focus:outline-none focus:border-cyan-400 font-mono text-sm">
                        @endif
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="block text-xs uppercase text-gray-300 mb-1">Stock</label>
                        <input type="number" name="stock_quantity" min="0" value="0" required
                            class="w-full px-3 py-2 rounded bg-[#242424] border border-gray-600 text-white focus:outline-none focus:border-cyan-400 font-mono text-sm">
                    </div>
                    <div>
                        <label class="block text-xs uppercase text-gray-300 mb-1">Price ($)</label>
                        <input type="number" name="price" step="0.01" min="0" placeholder="0.00" required
                            class="w-full px-3 py-2 rounded bg-[#242424] border border-gray-600 text-white focus:outline-none focus:border-cyan-400 font-mono text-sm">
                    </div>
                </div>

                <div class="flex items-center justify-end gap-3">
                    <button type="button" onclick="closeAddProductModal()"
                        class="px-4 py-2 rounded text-sm bg-gray-700 hover:bg-gray-600 text-gray-200 transition">
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-4 py-2 rounded text-sm font-semibold bg-cyan-500 hover:bg-cyan-400 text-gray-900 transition">
                        Save Product
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Pop-up Adjust Stock -->
    <div id="stockModal" class="fixed inset-0 bg-black/70 hidden items-center justify-center z-50 p-4">
        <div class="bg-[#424243] border border-gray-600 rounded-lg max-w-md w-full p-6 shadow-2xl">
            <div class="flex items-center justify-between mb-4">
                <h3 id="modalTitle" class="text-lg font-bold text-cyan-400">Adjust Stock</h3>
                <button type="button" onclick="closeStockModal()" class="text-gray-400 hover:text-white text-xl leading-none">&times;</button>
            </div>

            <p class="text-sm text-gray-300 mb-4">
                Product: <span id="modalProductName" class="font-semibold text-white"></span><br>
                Current Stock: <span id="modalCurrentStock" class="font-mono text-cyan-300"></span>
            </p>

            <form id="stockForm" method="POST" action="">
                @csrf
                <input type="hidden" name="type" id="modalType" value="in">

                <div class="mb-4">
                    <label for="quantity" class="block text-xs uppercase text-gray-300 mb-1">Quantity</label>
                    <input type="number" name="quantity" id="modalQuantity" min="1" value="1" required
                        class="w-full px-3 py-2 rounded bg-[#242424] border border-gray-600 text-white focus:outline-none focus:border-cyan-400 font-mono text-sm">
                </div>

                <div class="mb-6">
                    <label for="notes" class="block text-xs uppercase text-gray-300 mb-1">Notes (Optional)</label>
                    <textarea name="notes" id="modalNotes" rows="2" placeholder="Example: Received from supplier, or Sent to customer"
                        class="w-full px-3 py-2 rounded bg-[#242424] border border-gray-600 text-white focus:outline-none focus:border-cyan-400 text-sm"></textarea>
                </div>

                <div class="flex items-center justify-end gap-3">
                    <button type="button" onclick="closeStockModal()"
                        class="px-4 py-2 rounded text-sm bg-gray-700 hover:bg-gray-600 text-gray-200 transition">
                        Batal
                    </button>
                    <button type="submit" id="modalSubmitBtn"
                        class="px-4 py-2 rounded text-sm font-semibold transition">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Script Pengatur Modal -->
    <script>
        function openAddProductModal() {
            const modal = document.getElementById('addProductModal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeAddProductModal() {
            const modal = document.getElementById('addProductModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function openStockModal(productId, productName, currentStock, type) {
            const modal = document.getElementById('stockModal');
            const form = document.getElementById('stockForm');
            const title = document.getElementById('modalTitle');
            const submitBtn = document.getElementById('modalSubmitBtn');
            const quantityInput = document.getElementById('modalQuantity');

            form.action = `/products/${productId}/adjust-stock`;

            document.getElementById('modalProductName').textContent = productName;
            document.getElementById('modalCurrentStock').textContent = currentStock + ' unit';
            document.getElementById('modalType').value = type;
            quantityInput.value = 1;
            document.getElementById('modalNotes').value = '';

            if (type === 'in') {
                title.textContent = 'Add Stock (IN)';
                title.className = 'text-lg font-bold text-emerald-400';
                submitBtn.textContent = '+ Add Stock';
                submitBtn.className = 'px-4 py-2 rounded text-sm font-semibold bg-emerald-600 hover:bg-emerald-500 text-white transition';
                quantityInput.removeAttribute('max');
            } else {
                title.textContent = 'Stock Out (OUT)';
                title.className = 'text-lg font-bold text-amber-400';
                submitBtn.textContent = '- Stock Out';
                submitBtn.className = 'px-4 py-2 rounded text-sm font-semibold bg-amber-600 hover:bg-amber-500 text-white transition';
                quantityInput.setAttribute('max', currentStock);
            }

            modal.classList.remove('hidden');
            modal.classList.add('flex');
            quantityInput.focus();
        }

        function closeStockModal() {
            const modal = document.getElementById('stockModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    </script>
</body>
</html>
