@extends('layouts.app')
@section('title', 'Kalender Akademik')
@section('page-title', 'Kalender Akademik')

@section('content')

{{-- Page Header --}}
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h2 class="text-xl font-bold text-gray-800">Kalender Akademik</h2>
        <p class="text-sm text-gray-500 mt-0.5">Kelola agenda dan event akademik sekolah</p>
    </div>
    <div class="flex items-center gap-3">
        <select class="py-2.5 px-4 text-sm font-semibold bg-white border border-gray-200 text-gray-700 rounded-xl shadow-sm focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all">
            <option>TA 2025/2026</option>
            <option>TA 2024/2025</option>
        </select>
        <button onclick="openModal('modal-tambah-event')"
                class="inline-flex items-center gap-2 px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-xl shadow-sm transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Event
        </button>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-4 gap-6 mb-6">
    
    {{-- Sidebar (Mini Calendar & Legend) --}}
    <div class="lg:col-span-1 space-y-6">
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
            <h3 class="font-bold text-gray-800 mb-4">Oktober 2025</h3>
            <div class="grid grid-cols-7 gap-1 text-center mb-2">
                <div class="text-xs font-semibold text-gray-400">Min</div>
                <div class="text-xs font-semibold text-gray-400">Sen</div>
                <div class="text-xs font-semibold text-gray-400">Sel</div>
                <div class="text-xs font-semibold text-gray-400">Rab</div>
                <div class="text-xs font-semibold text-gray-400">Kam</div>
                <div class="text-xs font-semibold text-gray-400">Jum</div>
                <div class="text-xs font-semibold text-gray-400">Sab</div>
            </div>
            <div class="grid grid-cols-7 gap-1 text-center text-sm">
                {{-- Example mini calendar --}}
                <div class="p-1 text-gray-300">28</div><div class="p-1 text-gray-300">29</div><div class="p-1 text-gray-300">30</div>
                <div class="p-1 text-gray-700 hover:bg-gray-100 rounded-lg cursor-pointer transition-colors">1</div>
                <div class="p-1 text-gray-700 hover:bg-gray-100 rounded-lg cursor-pointer transition-colors">2</div>
                <div class="p-1 text-gray-700 hover:bg-gray-100 rounded-lg cursor-pointer transition-colors">3</div>
                <div class="p-1 text-red-500 font-medium hover:bg-red-50 rounded-lg cursor-pointer transition-colors">4</div>
                
                <div class="p-1 text-red-500 font-medium hover:bg-red-50 rounded-lg cursor-pointer transition-colors">5</div>
                <div class="p-1 text-gray-700 hover:bg-gray-100 rounded-lg cursor-pointer transition-colors">6</div>
                <div class="p-1 bg-blue-100 text-blue-700 font-bold rounded-lg cursor-pointer">7</div>
                <div class="p-1 bg-blue-100 text-blue-700 font-bold rounded-lg cursor-pointer">8</div>
                <div class="p-1 text-gray-700 hover:bg-gray-100 rounded-lg cursor-pointer transition-colors">9</div>
                <div class="p-1 text-gray-700 hover:bg-gray-100 rounded-lg cursor-pointer transition-colors">10</div>
                <div class="p-1 text-red-500 font-medium hover:bg-red-50 rounded-lg cursor-pointer transition-colors">11</div>
                
                <div class="p-1 text-red-500 font-medium hover:bg-red-50 rounded-lg cursor-pointer transition-colors">12</div>
                <div class="p-1 bg-emerald-500 text-white font-bold rounded-lg cursor-pointer shadow-sm">13</div>
                <div class="p-1 text-gray-700 hover:bg-gray-100 rounded-lg cursor-pointer transition-colors">14</div>
                <div class="p-1 text-gray-700 hover:bg-gray-100 rounded-lg cursor-pointer transition-colors">15</div>
                <div class="p-1 text-gray-700 hover:bg-gray-100 rounded-lg cursor-pointer transition-colors">16</div>
                <div class="p-1 bg-orange-100 text-orange-700 font-bold rounded-lg cursor-pointer">17</div>
                <div class="p-1 text-red-500 font-medium hover:bg-red-50 rounded-lg cursor-pointer transition-colors">18</div>

                <div class="p-1 text-red-500 font-medium hover:bg-red-50 rounded-lg cursor-pointer transition-colors">19</div>
                <div class="p-1 text-gray-700 hover:bg-gray-100 rounded-lg cursor-pointer transition-colors">20</div>
                <div class="p-1 text-gray-700 hover:bg-gray-100 rounded-lg cursor-pointer transition-colors">21</div>
                <div class="p-1 text-gray-700 hover:bg-gray-100 rounded-lg cursor-pointer transition-colors">22</div>
                <div class="p-1 text-gray-700 hover:bg-gray-100 rounded-lg cursor-pointer transition-colors">23</div>
                <div class="p-1 text-gray-700 hover:bg-gray-100 rounded-lg cursor-pointer transition-colors">24</div>
                <div class="p-1 text-red-500 font-medium hover:bg-red-50 rounded-lg cursor-pointer transition-colors">25</div>
            </div>
        </div>

        <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5">
            <h3 class="font-bold text-gray-800 mb-4">Kategori Event</h3>
            <ul class="space-y-3">
                <li class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-blue-500"></span>
                        <span class="text-sm text-gray-600">Ujian & Evaluasi</span>
                    </div>
                </li>
                <li class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-emerald-500"></span>
                        <span class="text-sm text-gray-600">Kegiatan Sekolah</span>
                    </div>
                </li>
                <li class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-orange-500"></span>
                        <span class="text-sm text-gray-600">Libur Nasional</span>
                    </div>
                </li>
                <li class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-purple-500"></span>
                        <span class="text-sm text-gray-600">Penerimaan Rapor</span>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    {{-- Main Events List (Table Style) --}}
    <div class="lg:col-span-3">
        <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden h-full flex flex-col">
            <div class="p-5 border-b border-gray-100 flex items-center justify-between bg-gray-50/50">
                <h3 class="font-bold text-gray-800 text-lg">Daftar Agenda (Oktober 2025)</h3>
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </span>
                    <input type="text" placeholder="Cari event..." class="pl-9 pr-4 py-2 text-sm border border-gray-200 rounded-lg focus:ring-2 focus:ring-emerald-500 outline-none w-48 sm:w-64 transition-all bg-white">
                </div>
            </div>

            <div class="flex-1 overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-white border-b border-gray-100">
                            <th class="px-5 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider w-1/4">Tanggal</th>
                            <th class="px-5 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Nama Kegiatan</th>
                            <th class="px-5 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Kategori</th>
                            <th class="px-5 py-3.5 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider w-24">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        <tr class="hover:bg-gray-50/70 transition-colors group">
                            <td class="px-5 py-4">
                                <div class="flex flex-col">
                                    <span class="font-bold text-blue-700">07 - 08 Okt 2025</span>
                                    <span class="text-xs text-gray-500 mt-0.5">2 Hari</span>
                                </div>
                            </td>
                            <td class="px-5 py-4">
                                <span class="font-semibold text-gray-800">Ujian Tengah Semester (UTS) Ganjil</span>
                            </td>
                            <td class="px-5 py-4">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-blue-50 text-blue-700 border border-blue-100">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span> Ujian & Evaluasi
                                </span>
                            </td>
                            <td class="px-5 py-4">
                                <div class="flex items-center justify-center gap-1.5 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <button onclick="openModal('modal-edit-event')" class="p-1.5 rounded-md text-blue-600 hover:bg-blue-100 transition-colors" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </button>
                                    <button class="p-1.5 rounded-md text-red-500 hover:bg-red-100 transition-colors" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        
                        <tr class="hover:bg-gray-50/70 transition-colors group">
                            <td class="px-5 py-4">
                                <div class="flex flex-col">
                                    <span class="font-bold text-emerald-700">13 Okt 2025</span>
                                    <span class="text-xs text-gray-500 mt-0.5">1 Hari (08:00 - 15:00)</span>
                                </div>
                            </td>
                            <td class="px-5 py-4">
                                <span class="font-semibold text-gray-800">Peringatan Hari Guru & Gebyar Seni</span>
                            </td>
                            <td class="px-5 py-4">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-100">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span> Kegiatan Sekolah
                                </span>
                            </td>
                            <td class="px-5 py-4">
                                <div class="flex items-center justify-center gap-1.5 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <button class="p-1.5 rounded-md text-blue-600 hover:bg-blue-100 transition-colors" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </button>
                                    <button class="p-1.5 rounded-md text-red-500 hover:bg-red-100 transition-colors" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <tr class="hover:bg-gray-50/70 transition-colors group">
                            <td class="px-5 py-4">
                                <div class="flex flex-col">
                                    <span class="font-bold text-orange-700">17 Okt 2025</span>
                                    <span class="text-xs text-gray-500 mt-0.5">1 Hari</span>
                                </div>
                            </td>
                            <td class="px-5 py-4">
                                <span class="font-semibold text-gray-800">Libur Nasional (Cuti Bersama)</span>
                            </td>
                            <td class="px-5 py-4">
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-orange-50 text-orange-700 border border-orange-100">
                                    <span class="w-1.5 h-1.5 rounded-full bg-orange-500"></span> Libur Nasional
                                </span>
                            </td>
                            <td class="px-5 py-4">
                                <div class="flex items-center justify-center gap-1.5 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <button class="p-1.5 rounded-md text-blue-600 hover:bg-blue-100 transition-colors" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </button>
                                    <button class="p-1.5 rounded-md text-red-500 hover:bg-red-100 transition-colors" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Modal Tambah Event --}}
<x-modal id="modal-tambah-event" title="Tambah Event Kalender" maxWidth="max-w-xl">
    <form class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Kegiatan <span class="text-red-500">*</span></label>
            <input type="text" placeholder="Contoh: Ujian Tengah Semester Ganjil"
                   class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all">
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Tanggal Mulai <span class="text-red-500">*</span></label>
                <input type="date" class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Tanggal Selesai <span class="text-red-500">*</span></label>
                <input type="date" class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Kategori Event <span class="text-red-500">*</span></label>
            <select class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all appearance-none cursor-pointer">
                <option value="">Pilih Kategori</option>
                <option>Ujian & Evaluasi</option>
                <option>Kegiatan Sekolah</option>
                <option>Libur Nasional</option>
                <option>Penerimaan Rapor</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Keterangan (Opsional)</label>
            <textarea rows="3" placeholder="Masukkan detail tambahan tentang kegiatan ini..."
                      class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all resize-none"></textarea>
        </div>
    </form>
    <x-slot name="footer">
        <button onclick="closeModal('modal-tambah-event')"
                class="px-4 py-2 text-sm font-medium text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl transition-colors">
            Batal
        </button>
        <button class="px-4 py-2 text-sm font-semibold text-white bg-emerald-600 hover:bg-emerald-700 rounded-xl transition-colors">
            Simpan Event
        </button>
    </x-slot>
</x-modal>

{{-- Modal Edit Event --}}
<x-modal id="modal-edit-event" title="Edit Event Kalender" maxWidth="max-w-xl">
    <form class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Kegiatan <span class="text-red-500">*</span></label>
            <input type="text" value="Ujian Tengah Semester (UTS) Ganjil"
                   class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all">
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Tanggal Mulai <span class="text-red-500">*</span></label>
                <input type="date" value="2025-10-07" class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1.5">Tanggal Selesai <span class="text-red-500">*</span></label>
                <input type="date" value="2025-10-08" class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Kategori Event <span class="text-red-500">*</span></label>
            <select class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all appearance-none cursor-pointer">
                <option selected>Ujian & Evaluasi</option>
                <option>Kegiatan Sekolah</option>
                <option>Libur Nasional</option>
                <option>Penerimaan Rapor</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1.5">Keterangan (Opsional)</label>
            <textarea rows="3" class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all resize-none"></textarea>
        </div>
    </form>
    <x-slot name="footer">
        <button onclick="closeModal('modal-edit-event')"
                class="px-4 py-2 text-sm font-medium text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl transition-colors">
            Batal
        </button>
        <button class="px-4 py-2 text-sm font-semibold text-white bg-emerald-600 hover:bg-emerald-700 rounded-xl transition-colors">
            Simpan Perubahan
        </button>
    </x-slot>
</x-modal>

@endsection
