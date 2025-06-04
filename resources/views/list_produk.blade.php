<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Daftar Produk</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-pink-50 font-sans">

  <div class="max-w-5xl mx-auto p-6 mt-10">

    <div class="text-center mb-10">
      <h1 class="text-4xl font-bold text-pink-700">Produk Bunga Store</h1>
    </div>

    @if (session('success'))
      <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded mb-6">
        {{ session('success') }}
      </div>
    @elseif (session('error'))
      <div class="bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded mb-6">
        {{ session('error') }}
      </div>
    @endif

    <div class="bg-white p-6 rounded-lg shadow-md border border-pink-100 mb-10">
      <h2 class="text-xl font-semibold text-pink-700 mb-4">Tambah Produk Baru</h2>
      <form method="POST" action="{{ route('produk.simpan') }}" class="space-y-6">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label class="block text-sm text-pink-700 font-medium mb-1">Nama Produk</label>
            <input type="text" name="nama" class="w-full border border-pink-300 rounded-md px-3 py-2 focus:ring-pink-400 focus:border-pink-400" required>
          </div>
          <div>
            <label class="block text-sm text-pink-700 font-medium mb-1">Harga</label>
            <input type="number" name="harga" class="w-full border border-pink-300 rounded-md px-3 py-2 focus:ring-pink-400 focus:border-pink-400" required>
          </div>
        </div>
        <div>
          <label class="block text-sm text-pink-700 font-medium mb-1">Deskripsi</label>
          <textarea name="deskripsi" rows="3" class="w-full border border-pink-300 rounded-md px-3 py-2 focus:ring-pink-400 focus:border-pink-400" required></textarea>
        </div>
        <div>
          <button type="submit" class="bg-pink-600 text-white font-semibold px-6 py-2 rounded-md hover:bg-pink-700 transition">
            Simpan
          </button>
        </div>
      </form>
    </div>

    <div class="bg-white shadow-md rounded-lg border border-pink-100 overflow-x-auto">
      <table class="min-w-full text-sm text-left">
        <thead class="bg-pink-100 text-pink-700 uppercase text-xs font-semibold">
          <tr>
            <th class="px-5 py-3">No</th>
            <th class="px-5 py-3">Nama</th>
            <th class="px-5 py-3">Deskripsi</th>
            <th class="px-5 py-3">Harga</th>
            <th class="px-5 py-3">Aksi</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-pink-100">
          @foreach ($nama as $index => $item)
            <tr class="hover:bg-pink-50 transition">
              <td class="px-5 py-4">{{ $index + 1 }}</td>
              <td class="px-5 py-4 font-medium text-gray-900">{{ $item }}</td>
              <td class="px-5 py-4 text-gray-700">{{ $desc[$index] }}</td>
              <td class="px-5 py-4 whitespace-nowrap text-gray-900 font-semibold">
                Rp {{ number_format($harga[$index], 0, ',', '.') }}
              </td>
              <td class="px-5 py-4">
                <div class="flex gap-3">
                  <button onclick="openEditModal({{ $id[$index] }})" class="text-blue-600 hover:underline">Edit</button>
                  <form method="POST" action="{{ route('produk.delete', $id[$index]) }}" onsubmit="return confirm('Yakin ingin menghapus {{ $item }}?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                  </form>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

  </div>

  <div id="editModal" class="fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-xl p-6 w-full max-w-lg relative">
      <button onclick="closeModal()" class="absolute top-3 right-3 text-gray-400 hover:text-black text-lg">×</button>
      <h2 class="text-xl font-semibold text-pink-700 mb-4">Edit Produk</h2>
      <form id="editForm" method="POST">
        @csrf
        <div class="mb-4">
          <label class="block mb-1 text-pink-700">Nama Produk</label>
          <input type="text" name="nama" id="editNama" class="w-full border border-pink-300 p-2 rounded focus:ring-pink-400 focus:border-pink-400" required>
        </div>
        <div class="mb-4">
          <label class="block mb-1 text-pink-700">Harga</label>
          <input type="number" name="harga" id="editHarga" class="w-full border border-pink-300 p-2 rounded focus:ring-pink-400 focus:border-pink-400" required>
        </div>
        <div class="mb-4">
          <label class="block mb-1 text-pink-700">Deskripsi</label>
          <textarea name="deskripsi" id="editDeskripsi" rows="3" class="w-full border border-pink-300 p-2 rounded focus:ring-pink-400 focus:border-pink-400" required></textarea>
        </div>
        <button type="submit" class="bg-pink-600 text-white px-5 py-2 rounded hover:bg-pink-700">
          Update
        </button>
      </form>
    </div>
  </div>

  <script>
    function openEditModal(id) {
      fetch(`/listproduk/data/${id}`)
        .then(res => res.json())
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
