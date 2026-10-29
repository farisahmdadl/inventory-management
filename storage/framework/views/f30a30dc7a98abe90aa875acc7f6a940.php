<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventaris Gudang - Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#242424] text-gray-100 min-h-screen flex items-center justify-center p-8">
    <div class="max-w-3xl w-full">
        <!-- Header -->
        <div class="text-center mb-10">
            <h1 class="text-3xl font-bold text-cyan-400 tracking-tight mb-2">
                Sistem Inventaris Gudang
            </h1>
            <p class="text-gray-400 text-sm">
                Pilih modul di bawah ini untuk mengelola daftar produk dan riwayat pergerakan stok.
            </p>
        </div>

        <!-- Navigation Cards / Buttons -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Button 1: Products Page -->
            <a href="<?php echo e(route('products.index')); ?>"
               class="group bg-[#424243] p-6 rounded-lg border border-gray-700 hover:border-cyan-400/60 hover:bg-gray-700/50 transition duration-200 flex flex-col justify-between shadow-lg">
                <div>
                    <div class="w-12 h-12 rounded-lg bg-gray-800/80 border border-gray-600 flex items-center justify-center text-cyan-400 mb-4 group-hover:scale-105 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                    </div>
                    <h2 class="text-xl font-semibold text-white group-hover:text-cyan-300 transition mb-2">
                        Product Inventory
                    </h2>
                    <p class="text-sm text-gray-400">
                        Lihat daftar produk, kode SKU, kategori, jumlah stok tersedia, dan harga satuan.
                    </p>
                </div>
                <div class="mt-6 flex items-center text-sm font-medium text-cyan-400 group-hover:translate-x-1 transition">
                    Buka Halaman Produk &rarr;
                </div>
            </a>

            <!-- Button 2: Stock Movements Page -->
            <a href="<?php echo e(route('stock-movements.index')); ?> "class="group bg-[#424243] p-6 rounded-lg border border-gray-700 hover:border-cyan-400/60 hover:bg-gray-700/50 transition duration-200 flex flex-col justify-between shadow-lg">
                <div>
                    <div class="w-12 h-12 rounded-lg bg-gray-800/80 border border-gray-600 flex items-center justify-center text-cyan-400 mb-4 group-hover:scale-105 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                        </svg>
                    </div>
                    <h2 class="text-xl font-semibold text-white group-hover:text-cyan-300 transition mb-2">
                        Stock Movements
                    </h2>
                    <p class="text-sm text-gray-400">
                        Pantau log keluar-masuk barang (`in` / `out`), kuantitas, catatan, dan petugas.
                    </p>
                </div>
                <div class="mt-6 flex items-center text-sm font-medium text-cyan-400 group-hover:translate-x-1 transition">
                    Buka Log Pergerakan Stok &rarr;
                </div>
            </a>
        </div>
    </div>
</body>
</html>
<?php /**PATH D:\laragon\www\inventaris-gudang\resources\views/home.blade.php ENDPATH**/ ?>