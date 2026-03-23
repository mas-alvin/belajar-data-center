@extends('layouts.app')
@section('title', 'Jadwal Pelajaran')
@section('page-title', 'Jadwal Pelajaran')

@section('content')

{{-- Page Header --}}
<div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-6">
    <div>
        <h2 class="text-xl font-bold text-gray-800">Jadwal Pelajaran</h2>
        <p class="text-sm text-gray-500 mt-0.5">Atur jadwal mengajar dan kelas akademik</p>
    </div>
    <div class="flex items-center gap-3">
        <button class="inline-flex items-center gap-2 px-4 py-2.5 bg-white border border-gray-200 hover:bg-gray-50 text-gray-700 text-sm font-semibold rounded-xl shadow-sm transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
            </svg>
            Cetak Jadwal
        </button>
        <button onclick="openModal('modal-tambah-jadwal')"
                class="inline-flex items-center gap-2 px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-xl shadow-sm transition-colors">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Jadwal
        </button>
    </div>
</div>

{{-- Filter --}}
<div class="bg-white rounded-xl border border-gray-100 shadow-sm p-5 mb-6">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
        <div>
            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Pilih Kelas</label>
            <select class="w-full py-2.5 px-3 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all">
                <option value="">Semua Kelas</option>
                <option>XII MIPA 1</option>
                <option selected>XII MIPA 2</option>
                <option>XI IPS 1</option>
            </select>
        </div>
        <div>
            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Pilih Hari</label>
            <select class="w-full py-2.5 px-3 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all">
                <option value="">Semua Hari</option>
                <option selected>Senin</option>
                <option>Selasa</option>
                <option>Rabu</option>
                <option>Kamis</option>
                <option>Jumat</option>
            </select>
        </div>
        <div>
            <label class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Guru Pengampu</label>
            <select class="w-full py-2.5 px-3 text-sm bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all">
                <option value="">Semua Guru</option>
                <option>Dra. Rini Wahyuni</option>
                <option>Siti Aminah, M.Pd</option>
            </select>
        </div>
        <div class="flex items-end">
            <button class="w-full py-2.5 px-4 bg-gray-800 hover:bg-gray-900 text-white text-sm font-semibold rounded-lg shadow-sm transition-colors">
                Terapkan Filter
            </button>
        </div>
    </div>
</div>

{{-- Jadwal Table Wrapper --}}
<div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden mb-6">
    <div class="bg-gray-50/80 px-5 py-4 border-b border-gray-100 flex items-center justify-between">
        <h3 class="font-bold text-gray-800">Jadwal Kelas: <span class="text-emerald-700">XII MIPA 2</span> (Hari Senin)</h3>
        <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-blue-100 text-blue-700">TA 2025/2026</span>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="bg-white border-b border-gray-100">
                    <th class="px-5 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider w-32 border-r border-gray-100">Jam</th>
                    <th class="px-5 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Mata Pelajaran</th>
                    <th class="px-5 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Guru Pengampu</th>
                    <th class="px-5 py-3.5 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Ruangan</th>
                    <th class="px-5 py-3.5 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider w-24">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @php
                    $jadwal = [
                        ['jam'=>'07:00 - 08:30', 'mapel'=>'Matematika Wajib', 'guru'=>'Dra. Rini Wahyuni', 'ruang'=>'Ruang Kelas A1', 'tipe'=>'kelas'],
                        ['jam'=>'08:30 - 10:00', 'mapel'=>'Fisika', 'guru'=>'Ir. Sudirman', 'ruang'=>'Ruang Kelas A1', 'tipe'=>'kelas'],
                        ['jam'=>'10:00 - 10:30', 'mapel'=>'Istirahat', 'guru'=>'-', 'ruang'=>'-', 'tipe'=>'istirahat'],
                        ['jam'=>'10:30 - 12:00', 'mapel'=>'Kimia', 'guru'=>'Siti Aminah, M.Pd', 'ruang'=>'Laboratorium Biologi', 'tipe'=>'kelas'],
                        ['jam'=>'12:00 - 12:45', 'mapel'=>'Ishoma', 'guru'=>'-', 'ruang'=>'-', 'tipe'=>'istirahat'],
                        ['jam'=>'12:45 - 14:15', 'mapel'=>'Biologi', 'guru'=>'Siti Aminah, M.Pd', 'ruang'=>'Laboratorium Biologi', 'tipe'=>'kelas'],
                    ];
                @endphp
                @foreach ($jadwal as $j)
                    @if($j['tipe'] == 'istirahat')
                        <tr class="bg-orange-50/40">
                            <td class="px-5 py-3 text-gray-700 font-mono text-xs border-r border-orange-100">{{ $j['jam'] }}</td>
                            <td colspan="4" class="px-5 py-3 text-center text-orange-800 font-semibold tracking-wide text-xs uppercase opacity-80 flex items-center justify-center gap-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                {{ $j['mapel'] }}
                            </td>
                        </tr>
                    @else
                        <tr class="hover:bg-gray-50 transition-colors group">
                            <td class="px-5 py-4 text-gray-700 font-mono text-xs border-r border-gray-100 font-medium">{{ $j['jam'] }}</td>
                            <td class="px-5 py-4">
                                <span class="font-bold text-gray-800">{{ $j['mapel'] }}</span>
                            </td>
                            <td class="px-5 py-4">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-6 h-6 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center font-bold text-[10px]">
                                        {{ substr($j['guru'], 0, 1) }}
                                    </div>
                                    <span class="text-gray-700 text-sm">{{ $j['guru'] }}</span>
                                </div>
                            </td>
                            <td class="px-5 py-4">
                                <span class="text-gray-600 text-sm">{{ $j['ruang'] }}</span>
                            </td>
                            <td class="px-5 py-4 text-center">
                                <div class="flex items-center justify-center gap-1.5 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <button onclick="openModal('modal-edit-jadwal')"
                                            class="p-1.5 rounded-md text-blue-600 hover:bg-blue-100 transition-colors" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </button>
                                    <button class="p-1.5 rounded-md text-red-500 hover:bg-red-100 transition-colors" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Modal Tambah Jadwal (Grid Layout) --}}
<x-modal id="modal-tambah-jadwal" title="Tambah Jadwal Pelajaran" maxWidth="max-w-2xl">
    <form class="space-y-5">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            {{-- Kiri --}}
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Kelas <span class="text-red-500">*</span></label>
                    <select class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all">
                        <option value="">Pilih Kelas</option>
                        <option>XII MIPA 1</option>
                        <option>XII MIPA 2</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Hari <span class="text-red-500">*</span></label>
                    <select class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all">
                        <option value="">Pilih Hari</option>
                        <option>Senin</option><option>Selasa</option><option>Rabu</option><option>Kamis</option><option>Jumat</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Waktu (Jam) <span class="text-red-500">*</span></label>
                    <div class="flex items-center gap-2">
                        <input type="time" class="w-full px-4 py-2 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 transition-all">
                        <span class="text-gray-400 font-medium">s/d</span>
                        <input type="time" class="w-full px-4 py-2 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 transition-all">
                    </div>
                </div>
            </div>

            {{-- Kanan --}}
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Mata Pelajaran <span class="text-red-500">*</span></label>
                    <select class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all">
                        <option value="">Pilih Mata Pelajaran</option>
                        <option>Matematika Wajib</option>
                        <option>Fisika</option>
                        <option>Kimia</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Guru Pengampu <span class="text-red-500">*</span></label>
                    <select class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all">
                        <option value="">Pilih Guru Pengampu</option>
                        <option>Dra. Rini Wahyuni</option>
                        <option>Ir. Sudirman</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Ruangan</label>
                    <select class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all">
                        <option value="">Pilih Ruangan</option>
                        <option>Ruang Kelas A1</option>
                        <option>Laboratorium Biologi</option>
                    </select>
                </div>
            </div>
        </div>
    </form>
    <x-slot name="footer">
        <button onclick="closeModal('modal-tambah-jadwal')"
                class="px-4 py-2 text-sm font-medium text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl transition-colors">
            Batal
        </button>
        <button class="px-4 py-2 text-sm font-semibold text-white bg-emerald-600 hover:bg-emerald-700 rounded-xl transition-colors">
            Simpan Jadwal
        </button>
    </x-slot>
</x-modal>

{{-- Modal Edit Jadwal --}}
<x-modal id="modal-edit-jadwal" title="Edit Jadwal Pelajaran" maxWidth="max-w-2xl">
    <form class="space-y-5">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Kelas <span class="text-red-500">*</span></label>
                    <select class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all">
                        <option selected>XII MIPA 2</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Hari <span class="text-red-500">*</span></label>
                    <select class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all">
                        <option selected>Senin</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Waktu (Jam) <span class="text-red-500">*</span></label>
                    <div class="flex items-center gap-2">
                        <input type="time" value="07:00" class="w-full px-4 py-2 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 transition-all">
                        <span class="text-gray-400 font-medium">s/d</span>
                        <input type="time" value="08:30" class="w-full px-4 py-2 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 transition-all">
                    </div>
                </div>
            </div>

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Mata Pelajaran <span class="text-red-500">*</span></label>
                    <select class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all">
                        <option selected>Matematika Wajib</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Guru Pengampu <span class="text-red-500">*</span></label>
                    <select class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all">
                        <option selected>Dra. Rini Wahyuni</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Ruangan</label>
                    <select class="w-full px-4 py-2.5 text-sm border border-gray-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all">
                        <option selected>Ruang Kelas A1</option>
                    </select>
                </div>
            </div>
        </div>
    </form>
    <x-slot name="footer">
        <button onclick="closeModal('modal-edit-jadwal')"
                class="px-4 py-2 text-sm font-medium text-gray-600 bg-gray-100 hover:bg-gray-200 rounded-xl transition-colors">
            Batal
        </button>
        <button class="px-4 py-2 text-sm font-semibold text-white bg-emerald-600 hover:bg-emerald-700 rounded-xl transition-colors">
            Simpan Perubahan
        </button>
    </x-slot>
</x-modal>

@endsection
