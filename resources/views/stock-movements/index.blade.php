<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Movements</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#242424] text-gray-100 min-h-screen p-8">
    <div class="max-w-6xl mx-auto">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-cyan-400">Stock Movements Log</h1>
            <a href="{{ url('/') }}" class="text-sm px-4 py-2 rounded bg-[#424243] hover:bg-gray-600 text-cyan-300 border border-gray-600 transition">
                &larr; Back to Home
            </a>
        </div>

        <div class="bg-[#424243] rounded-lg shadow overflow-hidden border border-gray-700">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="border-b border-gray-600 bg-gray-800/50 text-cyan-400 text-sm uppercase">
                        <th class="py-3 px-4">ID</th>
                        <th class="py-3 px-4">Date</th>
                        <th class="py-3 px-4">Product</th>
                        <th class="py-3 px-4">Type</th>
                        <th class="py-3 px-4 text-right">Quantity</th>
                        <th class="py-3 px-4">Notes</th>
                        <th class="py-3 px-4">Handled By</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-600 text-sm">
                    @forelse ($movements as $movement)
                        @php
                            $isIncoming = strtolower($movement->type) === 'in';
                        @endphp
                        <tr class="hover:bg-gray-700/40 transition">
                            <td class="py-3 px-4 font-mono text-gray-400">#{{ $movement->id }}</td>
                            <td class="py-3 px-4 text-gray-300 whitespace-nowrap">
                                {{ $movement->created_at?->format('d M Y, H:i') }}
                            </td>
                            <td class="py-3 px-4 font-medium text-white">
                                {{ $movement->product?->name ?? 'Unknown Product (#' . $movement->product_id . ')' }}
                                @if($movement->product?->sku)
                                    <span class="block text-xs font-mono text-gray-400">SKU: {{ $movement->product->sku }}</span>
                                @endif
                            </td>
                            <td class="py-3 px-4">
                                <span class="px-2.5 py-1 rounded text-xs font-semibold uppercase {{ $isIncoming ? 'bg-emerald-900/60 text-emerald-300 border border-emerald-700/50' : 'bg-amber-900/60 text-amber-300 border border-amber-700/50' }}">
                                    {{ $movement->type }}
                                </span>
                            </td>
                            <td class="py-3 px-4 text-right font-mono font-semibold {{ $isIncoming ? 'text-emerald-400' : 'text-amber-400' }}">
                                {{ $isIncoming ? '+' : '-' }}{{ $movement->quantity }}
                            </td>
                            <td class="py-3 px-4 text-gray-300 max-w-xs truncate">
                                {{ $movement->notes ?? '—' }}
                            </td>
                            <td class="py-3 px-4 text-cyan-300">
                                User #{{ $movement->user_id }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-8 text-center text-gray-400">
                                No stock movements recorded yet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
