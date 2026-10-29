<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products Inventory</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#242424] text-gray-100 min-h-screen p-8">
    <div class="max-w-5xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-cyan-400">Product Inventory</h1>
            <a href="<?php echo e(url('/')); ?>" class="text-sm px-4 py-2 rounded bg-[#424243] hover:bg-gray-600 text-cyan-300 border border-gray-600 transition">
                &larr; Back to Home
            </a>
        </div>

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
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-600 text-sm">
                    <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-gray-700/40 transition">
                            <td class="py-3 px-4 font-mono text-gray-400">#<?php echo e($product->id); ?></td>
                            <td class="py-3 px-4 font-mono"><?php echo e($product->sku); ?></td>
                            <td class="py-3 px-4 font-medium text-white"><?php echo e($product->name); ?></td>
                            <td class="py-3 px-4">
                                <span class="px-2 py-1 rounded bg-gray-700 text-cyan-300 text-xs">
                                    <?php echo e($product->category?->name ?? 'Uncategorized'); ?>

                                </span>
                            </td>
                            <td class="py-3 px-4">
                                <span class="px-2 py-1 rounded text-xs <?php echo e($product->stock_quantity > 0 ? 'bg-emerald-900/60 text-emerald-300' : 'bg-red-900/60 text-red-300'); ?>">
                                    <?php echo e($product->stock_quantity); ?> in stock
                                </span>
                            </td>
                            <td class="py-3 px-4 text-right font-mono text-cyan-300">
                                $<?php echo e(number_format($product->price, 2)); ?>

                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="py-8 text-center text-gray-400">
                                No products found in the database.
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
<?php /**PATH D:\laragon\www\inventaris-gudang\resources\views/products/index.blade.php ENDPATH**/ ?>