@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Manajemen Bahan Makanan</h1>
                <a href="{{ route('bahan-makanan.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                    Tambah Bahan Makanan
                </a>
            </div>

            <div class="mb-4 flex flex-col md:flex-row justify-between items-center">
                <div class="mb-2 md:mb-0">
                    <label class="mr-2">Tampilkan:</label>
                    <select id="perPage" class="border rounded p-1">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                    </select>
                </div>
                <div class="w-full md:w-64">
                    <input type="text" id="search" placeholder="Cari bahan makanan..."
                        class="w-full border rounded p-2">
                </div>
            </div>

            <div id="dataContainer" class="overflow-x-auto">
                @include('bahan_makanan.table', ['bahanMakanans' => $bahanMakanans])
            </div>
        </div>
    </div>

    <script>
        function loadData(page = 1) {
            const perPage = document.getElementById('perPage').value;
            const search = document.getElementById('search').value;

            let url = `/bahan-makanan?perPage=${perPage}&page=${page}`;
            if (search) {
                url += `&search=${search}`;
            }

            fetch(url, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('dataContainer').innerHTML = data.html;
                bindPaginationLinks();
            })
            .catch(error => console.error('Error:', error));
        }

        function bindPaginationLinks() {
            document.querySelectorAll('.pagination a').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const url = new URL(this.href);
                    const page = url.searchParams.get('page');
                    loadData(page);
                });
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Load data pertama kali
            if (!document.getElementById('dataContainer').innerHTML.trim()) {
                loadData();
            }

            document.getElementById('perPage').addEventListener('change', function() {
                loadData(1);
            });

            // Debounce untuk search
            let searchTimeout;
            document.getElementById('search').addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    loadData(1);
                }, 500);
            });
        });
    </script>
@endsection
