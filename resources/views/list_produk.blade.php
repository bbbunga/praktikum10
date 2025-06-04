<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-pink-50 font-sans">

<div class="max-w-4xl mx-auto px-4 sm:px-6 mt-12">
    <div class="mb-8 text-center">
        <h1 class="text-3xl font-extrabold text-pink-800">Produk Bunga Store</h1>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg p-6 mb-10">
        <h2 class="text-xl font-semibold text-pink-700 mb-4">Input Produk Baru</h2>
        <form method="POST" action="{{ route('produk.simpan') }}" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="nama" class="block text-sm font-medium text-pink-700">Nama Produk</label>
                    <input type="text" id="nama" name="nama" class="mt-1 block w-full border border-pink-300 rounded-md p-2 focus:ring-pink-500 focus:border-pink-500" required>
                </div>
                <div>
                    <label for="harga" class="block text-sm font-medium text-pink-700">Harga</label>
                    <input type="number" id="harga" name="harga" class="mt-1 block w-full border border-pink-300 rounded-md p-2 focus:ring-pink-500 focus:border-pink-500" required>
                </div>
            </div>
            <div>
                <label for="deskripsi" class="block text-sm font-medium text-pink-700">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" rows="3" class="mt-1 block w-full border border-pink-300 rounded-md p-2 focus:ring-pink-500 focus:border-pink-500" required></textarea>
            </div>
            <div class="pt-4">
                <button type="submit" class="bg-pink-600 hover:bg-pink-700 text-white font-bold py-2 px-6 rounded shadow-md transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>

    <div class="bg-white shadow-md rounded-lg overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-pink-100">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-bold text-pink-700 uppercase tracking-wider">No</th>
                    <th class="px-4 py-3 text-left text-xs font-bold text-pink-700 uppercase tracking-wider">Nama</th>
                    <th class="px-4 py-3 text-left text-xs font-bold text-pink-700 uppercase tracking-wider">Deskripsi</th>
                    <th class="px-4 py-3 text-left text-xs font-bold text-pink-700 uppercase tracking-wider">Harga</th>
                    <th class="px-4 py-3 text-left text-xs font-bold text-pink-700 uppercase tracking-wider">Action</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach ($nama as $index => $item)
                    <tr class="hover:bg-pink-50 transition">
                        <td class="px-4 py-3 text-sm text-gray-800">{{ $index + 1 }}</td>
                        <td class="px-4 py-3 text-sm text-gray-900">{{ $item }}</td>
                        <td class="px-4 py-3 text-sm text-gray-700">{{ $desc[$index] }}</td>
                        <td class="px-4 py-3 text-sm text-gray-900 font-semibold">Rp {{ number_format($harga[$index], 0, ',', '.') }}</td>
                        <td class="px-4 py-3 text-sm">
                            <div class="flex space-x-2">
                                <button onclick="openEditModal({{ $id[$index] }})" class="text-blue-500 hover:text-blue-700 font-medium">Edit</button>
                                <form action="{{ route('produk.delete', $id[$index]) }}" method="POST" onsubmit="return confirm('Hapus produk {{ $item }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 font-medium">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Edit -->
<div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center hidden z-50">
    <div class="bg-white p-6 rounded shadow max-w-lg w-full relative">
        <button onclick="closeModal()" class="absolute top-2 right-2 text-gray-600 hover:text-black">✕</button>
        <h2 class="text-xl font-bold text-pink-700 mb-4">Edit Produk</h2>
        <form id="editForm" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-pink-700 mb-1">Nama Produk</label>
                <input type="text" name="nama" id="editNama" class="w-full border border-pink-300 p-2 rounded" required>
            </div>
            <div class="mb-4">
                <label class="block text-pink-700 mb-1">Harga</label>
                <input type="number" name="harga" id="editHarga" class="w-full border border-pink-300 p-2 rounded" required>
            </div>
            <div class="mb-4">
                <label class="block text-pink-700 mb-1">Deskripsi</label>
                <textarea name="deskripsi" id="editDeskripsi" rows="4" class="w-full border border-pink-300 p-2 rounded" required></textarea>
            </div>
            <button type="submit" class="bg-pink-600 text-white px-4 py-2 rounded hover:bg-pink-700">Update</button>
        </form>
    </div>
</div>

<script>
    function openEditModal(id) {
        fetch(`/listproduk/data/${id}`)
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    alert(data.error);
                } else {
                    document.getElementById('editNama').value = data.nama;
                    document.getElementById('editHarga').value = data.harga;
                    document.getElementById('editDeskripsi').value = data.deskripsi;
                    document.getElementById('editForm').action = `/listproduk/update/${id}`;
                    document.getElementById('editModal').classList.remove('hidden');
                }
            });
    }

    function closeModal() {
        document.getElementById('editModal').classList.add('hidden');
    }
</script>

</body>
</html>
