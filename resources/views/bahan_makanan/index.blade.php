@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <div class="bg-white rounded-lg shadow-md p-6">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Manajemen Bahan Makanan</h1>
                <button onclick="openModal('create')" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md">
                    Tambah Bahan Makanan
                </button>
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
                <!-- AJAX -->
            </div>
        </div>
    </div>

    <div id="modal" class="fixed inset-0 bg-opacity-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md">
            <div class="p-6" id="modalContent">

            </div>
        </div>
    </div>

    <script>
        function loadData() {
            const perPage = document.getElementById('perPage').value;
            const search = document.getElementById('search').value;

            fetch(`/bahan/data?perPage=${perPage}&search=${search}`)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('dataContainer').innerHTML = html;
                    bindPaginationLinks();
                });
        }

        function bindPaginationLinks() {
            document.querySelectorAll('.pagination a').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();

                    const url = new URL(this.href);
                    const perPage = document.getElementById('perPage').value;
                    const search = document.getElementById('search').value;

                    url.searchParams.set('perPage', perPage);
                    url.searchParams.set('search', search);

                    fetch(url)
                        .then(response => response.text())
                        .then(html => {
                            document.getElementById('dataContainer').innerHTML = html;
                            bindPaginationLinks();
                        });
                });
            });
        }

        function openModal(action, id = null) {
            let url = '/bahan-makanan/create';
            if (action === 'edit' && id) {
                url = `/bahan-makanan/${id}/edit`;
            }

            fetch(url)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('modalContent').innerHTML = html;
                    document.getElementById('modal').classList.remove('hidden');
                });
        }

        function closeModal() {
            document.getElementById('modal').classList.add('hidden');
        }

        function submitForm(event, formElement) {
            event.preventDefault();
            const formData = new FormData(formElement);
            const url = formElement.action;
            const method = formElement.method;

            fetch(url, {
                    method: method,
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    alert(data.message);
                    closeModal();
                    loadData();
                })
                .catch(error => console.error('Error:', error));
        }

        function deleteData(id) {
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                fetch(`/bahan-makanan/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        alert(data.message);
                        loadData();
                    });
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            loadData();

            document.getElementById('perPage').addEventListener('change', loadData);
            document.getElementById('search').addEventListener('input', loadData);
        });
    </script>
@endsection
