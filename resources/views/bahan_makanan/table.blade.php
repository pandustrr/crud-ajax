<table class="min-w-full bg-white border border-gray-200">
    <thead class="bg-gray-50">
        <tr>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Satuan</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stok</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        @foreach ($bahanMakanans as $index => $bahan)
            <tr>
                <td class="px-6 py-4 whitespace-nowrap">
                    {{ ($bahanMakanans->currentPage() - 1) * $bahanMakanans->perPage() + $loop->iteration }}
                </td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $bahan->nama }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $bahan->satuan }}</td>
                <td class="px-6 py-4 whitespace-nowrap">{{ $bahan->stok }}</td>
                <td class="px-6 py-4">{{ Str::limit($bahan->deskripsi, 50) }}</td>
                <td class="px-6 py-4 whitespace-nowrap">
                    <a href="{{ route('bahan-makanan.edit', $bahan->id) }}"
                        class="text-blue-600 hover:text-blue-900 mr-3">Edit</a>
                    <a href="{{ route('bahan-makanan.hapus', $bahan->id) }}" onclick="confirm('Yakin mau hapus?')"
                        class="text-red-600 hover:text-red-900">Hapus</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@if ($bahanMakanans->hasPages())
    <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
        {{ $bahanMakanans->withQueryString()->links() }}
    </div>
@endif
