@extends('layouts.app')
@section('title', 'Manajemen Siswa')
@section('page-title', 'Manajemen Siswa')

@section('content')

{{-- Page Header --}}
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h2 class="text-xl font-bold text-gray-800">Data Siswa</h2>
        <p class="text-sm text-gray-500 mt-0.5">Kelola seluruh data siswa aktif dan non-aktif</p>
    </div>
    <button onclick="openModalTambah()"
            class="inline-flex items-center gap-2 px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-xl shadow-sm transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah Siswa
    </button>
</div>

{{-- Filter & Search Bar --}}
<div class="bg-white rounded-xl border border-gray-100 shadow-sm p-4 mb-5">
    <div class="flex flex-col sm:flex-row gap-3">
        {{-- Search --}}
        <div class="relative flex-1">
            <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </span>
            <input type="text" id="search-input" placeholder="Cari nama siswa..."
                   class="w-full pl-10 pr-4 py-2.5 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all">
        </div>
        {{-- Filter Kelas --}}
        <select id="filter-kelas" class="py-2.5 px-3 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all appearance-none sm:w-44">
            <option value="">Semua Kelas</option>
        </select>
        {{-- Filter Status --}}
        <select id="filter-status" class="py-2.5 px-3 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all appearance-none sm:w-40">
            <option value="">Semua Status</option>
            <option value="aktif">Aktif</option>
            <option value="nonaktif">Non-Aktif</option>
        </select>
    </div>
</div>

{{-- Table --}}
<div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-gray-50 border-b border-gray-100">
                    <th class="px-5 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider w-12">#</th>
                    <th class="px-5 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Nama Siswa</th>
                    <th class="px-5 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">NIS & L/P</th>
                    <th class="px-5 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Kelas</th>
                    <th class="px-5 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-5 py-3.5 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody id="student-tbody" class="divide-y divide-gray-50">
                <tr>
                    <td colspan="6" class="px-5 py-8 text-center text-gray-400">Memuat data...</td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="px-5 py-4 border-t border-gray-100 flex flex-col sm:flex-row items-center justify-between gap-3">
        <p class="text-xs text-gray-400" id="pagination-info">Menampilkan halaman 1</p>
        <div class="flex items-center gap-1" id="pagination-controls">
            <!-- Dynamically populated -->
        </div>
    </div>
</div>

{{-- Modal Form Siswa (Tambah/Edit) --}}
<x-modal id="modal-form-siswa" title="Form Siswa">
    <form id="student-form" class="space-y-4">
        <input type="hidden" id="student_id" value="">
        
        <!-- Baris 1: Nama dan NIS -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
                <input type="text" id="input-nama" placeholder="Masukkan nama..." required
                       class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 transition-all">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">NIS <span class="text-red-500">*</span></label>
                <input type="text" id="input-nis" placeholder="Nomor Induk Siswa" required
                       class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 transition-all">
            </div>
        </div>

        <!-- Baris 2: Kelas dan Jenis Kelamin -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Kelas <span class="text-red-500">*</span></label>
                <select id="input-kelas" required class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 transition-all appearance-none">
                    <option value="">Pilih Kelas</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Jenis Kelamin <span class="text-red-500">*</span></label>
                <select id="input-jk" required class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 transition-all appearance-none">
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>
        </div>

        <!-- Baris 3: Tanggal Lahir -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Tanggal Lahir <span class="text-red-500">*</span></label>
            <input type="date" id="input-tgl" required
                   class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 transition-all">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Alamat</label>
            <textarea id="input-alamat" rows="2" placeholder="Masukkan alamat lengkap..."
                      class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 transition-all resize-none"></textarea>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Status</label>
            <div class="flex gap-4">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" name="input_status" value="aktif" checked class="text-emerald-600">
                    <span class="text-sm text-gray-700">Aktif</span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" name="input_status" value="nonaktif" class="text-emerald-600">
                    <span class="text-sm text-gray-700">Non-Aktif</span>
                </label>
            </div>
        </div>
    </form>
    <x-slot name="footer">
        <button type="button" onclick="closeModal('modal-form-siswa')"
                class="px-4 py-2 text-sm font-medium text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl transition-colors">
            Batal
        </button>
        <button type="button" onclick="saveStudent()"
                class="px-4 py-2 text-sm font-semibold text-white bg-emerald-600 hover:bg-emerald-700 rounded-xl transition-colors">
            Simpan Data
        </button>
    </x-slot>
</x-modal>

@endsection

@push('scripts')
<script>
    let currentPage = 1;
    let hasMorePages = false;

    // Element selection
    const searchInput = document.getElementById('search-input');
    const filterKelas = document.getElementById('filter-kelas');
    const filterStatus = document.getElementById('filter-status');
    const tbody = document.getElementById('student-tbody');

    // Attach Event Listeners for Filters
    let typingTimer;
    searchInput.addEventListener('input', () => {
        clearTimeout(typingTimer);
        typingTimer = setTimeout(() => fetchStudents(1), 500);
    });
    filterKelas.addEventListener('change', () => fetchStudents(1));
    filterStatus.addEventListener('change', () => fetchStudents(1));

    // Fetch initial data
    document.addEventListener('DOMContentLoaded', () => {
        fetchStudents(1);
        loadKelasOptions();
    });

    async function loadKelasOptions() {
        try {
            const res = await fetch('/api/kelas?per_page=100', { headers: { 'Accept': 'application/json' } });
            const data = await res.json();
            if(data.success) {
                const filterSelect = document.getElementById('filter-kelas');
                const inputSelect = document.getElementById('input-kelas');
                data.data.forEach(item => {
                    const html = `<option value="${item.id}">${item.nama_kelas}</option>`;
                    filterSelect.innerHTML += html;
                    inputSelect.innerHTML += html;
                });
            }
        } catch (e) { console.error('Gagal fetch kelas:', e); }
    }

    /**
     * Fetch students data from API Server-side simplePagination.
     */
    async function fetchStudents(page = 1) {
        currentPage = page;
        const search = searchInput.value;
        const kelas_id = filterKelas.value;
        const status = filterStatus.value;

        tbody.innerHTML = `<tr><td colspan="6" class="px-5 py-8 text-center text-gray-400">Loading data...</td></tr>`;

        try {
            const url = new URL(window.location.origin + '/api/students');
            url.searchParams.append('page', page);
            url.searchParams.append('per_page', 10);
            if(search) url.searchParams.append('search', search);
            if(kelas_id) url.searchParams.append('kelas_id', kelas_id);
            if(status) url.searchParams.append('status', status);

            const res = await fetch(url.toString(), {
                headers: { 'Accept': 'application/json' }
            });
            const response = await res.json();

            if (response.success) {
                renderTable(response.data);
                renderPagination(response.meta);
            } else {
                showToast("Gagal memuat data: " + response.message, "error");
            }
        } catch (error) {
            console.error(error);
            showToast("Kesalahan jaringan saat load data siswa.", "error");
            tbody.innerHTML = `<tr><td colspan="6" class="px-5 py-4 text-center text-red-500">Gagal mengambil data.</td></tr>`;
        }
    }

    function renderTable(data) {
        tbody.innerHTML = '';
        if (data.length === 0) {
            tbody.innerHTML = `<tr><td colspan="6" class="px-5 py-8 text-center text-gray-500">Tidak ada data siswa ditemukan.</td></tr>`;
            return;
        }

        data.forEach((s, index) => {
            // Urutan nomer secara relative dengan page (simplePaginate tdk return total jd mulai dari index 1 tiap hal)
            const number = ((currentPage - 1) * 10) + (index + 1);
            const avatarColor = s.jenis_kelamin === 'L' ? 'bg-blue-100 text-blue-700' : 'bg-pink-100 text-pink-700';
            
            let statusBadge = '';
            if(s.status === 'aktif') {
                statusBadge = `<span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700">
                                  <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Aktif
                               </span>`;
            } else {
                statusBadge = `<span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-semibold bg-red-50 text-red-600">
                                  <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span> Non-Aktif
                               </span>`;
            }

            const tr = document.createElement('tr');
            tr.className = 'hover:bg-gray-50/70 transition-colors';
            tr.innerHTML = `
                <td class="px-5 py-4 text-gray-400 text-xs">${number}</td>
                <td class="px-5 py-4">
                    <div class="flex items-center gap-3">
                        <img class="w-8 h-8 rounded-full shrink-0"
                             src="https://ui-avatars.com/api/?name=${encodeURIComponent(s.nama)}&background=f3f4f6&color=374151&size=32"
                             alt="${s.nama}">
                        <span class="font-semibold text-gray-800">${s.nama}</span>
                    </div>
                </td>
                <td class="px-5 py-4 text-gray-500 text-xs">
                    <div class="font-mono">${s.nis}</div>
                    <div class="mt-1 ${avatarColor} inline-block px-1.5 py-0.5 rounded text-[10px] font-bold">${s.jenis_kelamin}</div>
                </td>
                <td class="px-5 py-4">
                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold bg-indigo-50 text-indigo-700">
                        ${s.kelas ? s.kelas.nama_kelas : '-'}
                    </span>
                </td>
                <td class="px-5 py-4">${statusBadge}</td>
                <td class="px-5 py-4">
                    <div class="flex items-center justify-center gap-1.5">
                        <button onclick="editStudent(${s.id})" class="p-2 rounded-lg text-blue-600 hover:bg-blue-50 transition-colors" title="Edit">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                        </button>
                        <button onclick="deleteStudent(${s.id}, '${s.nama}')" class="p-2 rounded-lg text-red-500 hover:bg-red-50 transition-colors" title="Hapus">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </div>
                </td>
            `;
            tbody.appendChild(tr);
        });
    }

    function renderPagination(meta) {
        document.getElementById('pagination-info').innerText = `Halaman ${meta.current_page}`;
        const controls = document.getElementById('pagination-controls');
        
        hasMorePages = meta.has_more_pages;
        
        let html = '';
        if (meta.current_page > 1) {
            html += `<button onclick="fetchStudents(${meta.current_page - 1})" class="px-3 py-1.5 text-xs font-medium text-gray-500 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">‹ Prev</button>`;
        } else {
            html += `<button disabled class="px-3 py-1.5 text-xs font-medium text-gray-300 bg-gray-50 rounded-lg cursor-not-allowed">‹ Prev</button>`;
        }

        html += `<button class="px-3 py-1.5 text-xs font-semibold text-white bg-emerald-600 rounded-lg">${meta.current_page}</button>`;

        if (meta.has_more_pages) {
            html += `<button onclick="fetchStudents(${meta.current_page + 1})" class="px-3 py-1.5 text-xs font-medium text-gray-500 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">Next ›</button>`;
        } else {
            html += `<button disabled class="px-3 py-1.5 text-xs font-medium text-gray-300 bg-gray-50 rounded-lg cursor-not-allowed">Next ›</button>`;
        }

        controls.innerHTML = html;
    }

    // Modal Form Logic
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    function openModalTambah() {
        document.getElementById('student-form').reset();
        document.getElementById('student_id').value = '';
        document.getElementById('modal-form-siswa-title').innerText = "Tambah Siswa Baru";
        openModal('modal-form-siswa');
    }

    async function editStudent(id) {
        try {
            const res = await fetch(`/api/students/${id}`, {
                headers: { 'Accept': 'application/json' }
            });
            const response = await res.json();
            if(response.success) {
                const s = response.data;
                document.getElementById('student_id').value = s.id;
                document.getElementById('input-nama').value = s.nama;
                document.getElementById('input-nis').value = s.nis;
                document.getElementById('input-kelas').value = s.kelas_id;
                document.getElementById('input-jk').value = s.jenis_kelamin;
                document.getElementById('input-tgl').value = s.tanggal_lahir.split('T')[0];
                document.getElementById('input-alamat').value = s.alamat || '';
                document.querySelector(`input[name="input_status"][value="${s.status}"]`).checked = true;
                
                document.getElementById('modal-form-siswa-title').innerText = "Edit Data Siswa";
                openModal('modal-form-siswa');
            } else {
                showToast("Gagal load data: " + response.message, "error");
            }
        } catch (e) {
            console.error(e);
            showToast("Terjadi kesalahan jaringan.", "error");
        }
    }

    async function saveStudent() {
        const id = document.getElementById('student_id').value;
        const method = id ? 'PUT' : 'POST';
        const url = id ? `/api/students/${id}` : `/api/students`;

        const payload = {
            nama: document.getElementById('input-nama').value,
            nis: document.getElementById('input-nis').value,
            kelas_id: document.getElementById('input-kelas').value,
            jenis_kelamin: document.getElementById('input-jk').value,
            tanggal_lahir: document.getElementById('input-tgl').value,
            alamat: document.getElementById('input-alamat').value,
            status: document.querySelector(`input[name="input_status"]:checked`).value
        };

        try {
            const res = await fetch(url, {
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify(payload)
            });

            const data = await res.json();
            
            if (res.status === 422) { // Validation error
                for (const key in data.errors) {
                    errorMsg += data.errors[key][0] + " ";
                }
                showToast(errorMsg, "error");
                return;
            }

            if (data.success) {
                showToast(data.message);
                closeModal('modal-form-siswa');
                fetchStudents(currentPage); // reload current page
            } else {
                showToast("Gagal: " + (data.message || "Kesalahan internal"), "error");
            }
        } catch (e) {
            console.error(e);
            showToast("Kesalahan jaringan saat menyimpan data.", "error");
        }
    }

    async function deleteStudent(id, nama) {
        const isConfirm = confirm(`Peringatan Konfirmasi!\nApakah Anda yakin ingin menghapus data siswa "${nama}"? Data akan hilang permanen.`);
        if (!isConfirm) return;

        try {
            const res = await fetch(`/api/students/${id}`, {
                method: 'DELETE',
                headers: {
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            });
            const data = await res.json();
            if (data.success) {
                showToast(data.message);
                // if last item on page deleted, go back 1 page
                if (tbody.children.length === 1 && currentPage > 1) {
                    currentPage--;
                }
                fetchStudents(currentPage);
            } else {
                showToast("Gagal menghapus: " + data.message, "error");
            }
        } catch(e) {
            console.error(e);
            showToast("Kesalahan jaringan saat menghapus data.", "error");
        }
    }
</script>
@endpush
