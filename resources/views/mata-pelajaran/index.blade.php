@extends('layouts.app')
@section('title', 'Manajemen Mata Pelajaran')
@section('page-title', 'Data Master Mata Pelajaran')

@section('content')

<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h2 class="text-xl font-bold text-gray-800">Mata Pelajaran</h2>
        <p class="text-sm text-gray-500 mt-0.5">Kelola data kurikulum dan mata pelajaran</p>
    </div>
    <button onclick="openModalTambah()" class="inline-flex items-center gap-2 px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-xl shadow-sm transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
        Tambah Mapel
    </button>
</div>

<div class="bg-white rounded-xl border border-gray-100 shadow-sm p-4 mb-5">
    <div class="flex flex-col sm:flex-row gap-3">
        <div class="relative flex-1">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </span>
            <input type="text" id="search-input" placeholder="Cari nama atau kode mapel..." class="w-full pl-10 pr-4 py-2.5 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all">
        </div>
        <select id="filter-status" class="py-2.5 px-3 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all appearance-none sm:w-40">
            <option value="">Semua Status</option>
            <option value="aktif">Aktif</option>
            <option value="nonaktif">Non-Aktif</option>
        </select>
    </div>
</div>

<div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <th class="px-5 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider w-12">#</th>
                    <th class="px-5 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Mata Pelajaran</th>
                    <th class="px-5 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Kode</th>
                    <th class="px-5 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Kelompok</th>
                    <th class="px-5 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-5 py-3.5 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody id="data-tbody" class="divide-y divide-gray-50">
                <tr><td colspan="6" class="px-5 py-8 text-center text-gray-400">Memuat data...</td></tr>
            </tbody>
        </table>
    </div>
    <div class="px-5 py-4 border-t border-gray-100 flex flex-col sm:flex-row items-center justify-between gap-3">
        <p class="text-xs text-gray-400" id="pagination-info">Menampilkan halaman 1</p>
        <div class="flex items-center gap-1" id="pagination-controls"></div>
    </div>
</div>

<x-modal id="modal-form" title="Form Mata Pelajaran">
    <form id="main-form" class="space-y-4">
        <input type="hidden" id="item_id" value="">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Mapel <span class="text-red-500">*</span></label>
            <input type="text" id="input-nama" placeholder="Contoh: Matematika" required class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 transition-all">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Kode Mapel <span class="text-red-500">*</span></label>
            <input type="text" id="input-kode" placeholder="Contoh: MTK" required class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 transition-all">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Kelompok</label>
            <input type="text" id="input-kelompok" placeholder="Contoh: Kelompok A" class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 transition-all">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Status</label>
            <div class="flex gap-4">
                <label class="flex items-center gap-2 cursor-pointer"><input type="radio" name="input_status" value="aktif" checked class="text-emerald-600"><span class="text-sm text-gray-700">Aktif</span></label>
                <label class="flex items-center gap-2 cursor-pointer"><input type="radio" name="input_status" value="nonaktif" class="text-emerald-600"><span class="text-sm text-gray-700">Non-Aktif</span></label>
            </div>
        </div>
    </form>
    <x-slot name="footer">
        <button type="button" onclick="closeModal('modal-form')" class="px-4 py-2 text-sm font-medium text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl transition-colors">Batal</button>
        <button type="button" onclick="saveData()" class="px-4 py-2 text-sm font-semibold text-white bg-emerald-600 hover:bg-emerald-700 rounded-xl transition-colors">Simpan Data</button>
    </x-slot>
</x-modal>

@endsection

@push('scripts')
<script>
    let currentPage = 1;
    const searchInput = document.getElementById('search-input');
    const filterStatus = document.getElementById('filter-status');
    const tbody = document.getElementById('data-tbody');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    searchInput.addEventListener('input', debounce(() => fetchData(1), 500));
    filterStatus.addEventListener('change', () => fetchData(1));
    document.addEventListener('DOMContentLoaded', () => fetchData(1));

    function debounce(func, wait) { let timeout; return function(...args) { clearTimeout(timeout); timeout = setTimeout(() => func.apply(this, args), wait); }; }

    async function fetchData(page = 1) {
        currentPage = page;
        const search = searchInput.value;
        const status = filterStatus.value;
        tbody.innerHTML = `<tr><td colspan="6" class="px-5 py-8 text-center text-gray-400">Loading data...</td></tr>`;
        try {
            const url = new URL(window.location.origin + '/api/mata-pelajarans');
            url.searchParams.append('page', page);
            if(search) url.searchParams.append('search', search);
            if(status) url.searchParams.append('status', status);
            const res = await fetch(url.toString(), { headers: { 'Accept': 'application/json' } });
            const response = await res.json();
            if (response.success) { renderTable(response.data); renderPagination(response.meta); } else { showToast(response.message, "error"); }
        } catch (error) { showToast("Gagal mengambil data.", "error"); }
    }

    function renderTable(data) {
        tbody.innerHTML = '';
        if (data.length === 0) { tbody.innerHTML = `<tr><td colspan="6" class="px-5 py-8 text-center text-gray-500">Tidak ada data ditemukan.</td></tr>`; return; }
        data.forEach((item, index) => {
            const number = ((currentPage - 1) * 10) + (index + 1);
            const statusBadge = item.status === 'aktif' 
                ? `<span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700"><span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Aktif</span>`
                : `<span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-red-50 text-red-600"><span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Non-Aktif</span>`;
            tbody.innerHTML += `
                <tr class="hover:bg-gray-50/70 transition-colors">
                    <td class="px-5 py-4 text-gray-400 text-xs">${number}</td>
                    <td class="px-5 py-4 font-semibold text-gray-800">${item.nama_mapel}</td>
                    <td class="px-5 py-4"><span class="font-mono text-xs font-bold px-2 py-1 bg-gray-100 rounded text-gray-600">${item.kode_mapel}</span></td>
                    <td class="px-5 py-4 text-gray-500 text-xs">${item.kelompok || '-'}</td>
                    <td class="px-5 py-4">${statusBadge}</td>
                    <td class="px-5 py-4">
                        <div class="flex items-center justify-center gap-1.5">
                            <button onclick="editData(${item.id})" class="p-2 rounded-lg text-blue-600 hover:bg-blue-50 transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg></button>
                            <button onclick="deleteData(${item.id}, '${item.nama_mapel}')" class="p-2 rounded-lg text-red-500 hover:bg-red-50 transition-colors"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg></button>
                        </div>
                    </td>
                </tr>`;
        });
    }

    function renderPagination(meta) {
        document.getElementById('pagination-info').innerText = `Halaman ${meta.current_page}`;
        const controls = document.getElementById('pagination-controls');
        let html = '';
        html += `<button onclick="fetchData(${meta.current_page - 1})" ${meta.current_page === 1 ? 'disabled' : ''} class="px-3 py-1.5 text-xs font-medium ${meta.current_page === 1 ? 'text-gray-300 bg-gray-50 cursor-not-allowed' : 'text-gray-500 bg-gray-100 hover:bg-gray-200'} rounded-lg transition-colors">Prev</button>`;
        html += `<button class="px-3 py-1.5 text-xs font-semibold text-white bg-emerald-600 rounded-lg">${meta.current_page}</button>`;
        html += `<button onclick="fetchData(${meta.current_page + 1})" ${!meta.has_more_pages ? 'disabled' : ''} class="px-3 py-1.5 text-xs font-medium ${!meta.has_more_pages ? 'text-gray-300 bg-gray-50 cursor-not-allowed' : 'text-gray-500 bg-gray-100 hover:bg-gray-200'} rounded-lg transition-colors">Next</button>`;
        controls.innerHTML = html;
    }

    function openModalTambah() { document.getElementById('main-form').reset(); document.getElementById('item_id').value = ''; document.getElementById('modal-form-title').innerText = "Tambah Mapel Baru"; openModal('modal-form'); }

    async function editData(id) {
        try {
            const res = await fetch(`/api/mata-pelajarans/${id}`, { headers: { 'Accept': 'application/json' } });
            const response = await res.json();
            if(response.success) {
                const item = response.data;
                document.getElementById('item_id').value = item.id;
                document.getElementById('input-nama').value = item.nama_mapel;
                document.getElementById('input-kode').value = item.kode_mapel;
                document.getElementById('input-kelompok').value = item.kelompok || '';
                document.querySelector(`input[name="input_status"][value="${item.status}"]`).checked = true;
                document.getElementById('modal-form-title').innerText = "Edit Mata Pelajaran";
                openModal('modal-form');
            }
        } catch (e) { showToast("Gagal memuat data.", "error"); }
    }

    async function saveData() {
        const id = document.getElementById('item_id').value;
        const method = id ? 'PUT' : 'POST';
        const url = id ? `/api/mata-pelajarans/${id}` : `/api/mata-pelajarans`;
        const payload = { nama_mapel: document.getElementById('input-nama').value, kode_mapel: document.getElementById('input-kode').value, kelompok: document.getElementById('input-kelompok').value, status: document.querySelector(`input[name="input_status"]:checked`).value };
        try {
            const res = await fetch(url, { method: method, headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': csrfToken }, body: JSON.stringify(payload) });
            const data = await res.json();
            if (res.status === 422) { showToast(Object.values(data.errors).flat().join(" "), "error"); return; }
            if (data.success) { showToast(data.message); closeModal('modal-form'); fetchData(currentPage); } else { showToast(data.message, "error"); }
        } catch (e) { showToast("Gagal menyimpan data.", "error"); }
    }

    async function deleteData(id, name) {
        if (!confirm(`Hapus data mapel "${name}"?`)) return;
        try {
            const res = await fetch(`/api/mata-pelajarans/${id}`, { method: 'DELETE', headers: { 'Accept': 'application/json', 'X-CSRF-TOKEN': csrfToken } });
            const data = await res.json();
            if (data.success) { showToast(data.message); fetchData(currentPage); } else { showToast(data.message, "error"); }
        } catch(e) { showToast("Gagal menghapus data.", "error"); }
    }
</script>
@endpush
