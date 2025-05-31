<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Produk</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-pink-50 font-sans">
    <div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold text-pink-700 mb-6">Edit Produk</h2>
        <form method="POST" action="{{ route('produk.update', $produk->id) }}">
            @csrf
            <div class="mb-4">
                <label class="block text-pink-700 font-semibold mb-1">Nama Produk</label>
                <input type="text" name="nama" value="{{ $produk->nama }}" class="w-full border border-pink-300 p-2 rounded" required>
            </div>
            <div class="mb-4">
                <label class="block text-pink-700 font-semibold mb-1">Harga</label>
                <input type="number" name="harga" value="{{ $produk->harga }}" class="w-full border border-pink-300 p-2 rounded" required>
            </div>
            <div class="mb-4">
                <label class="block text-pink-700 font-semibold mb-1">Deskripsi</label>
                <textarea name="deskripsi" rows="4" class="w-full border border-pink-300 p-2 rounded" required>{{ $produk->deskripsi }}</textarea>
            </div>
            <button type="submit" class="bg-pink-600 text-white px-4 py-2 rounded hover:bg-pink-700">Update</button>
        </form>
    </div>
</body>
</html>
