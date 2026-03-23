@props([
    'id'    => 'modal',
    'title' => 'Modal',
    'size'  => 'md',   {{-- sm | md | lg | xl --}}
])

@php
    $sizes = [
        'sm' => 'max-w-sm',
        'md' => 'max-w-lg',
        'lg' => 'max-w-2xl',
        'xl' => 'max-w-4xl',
    ];
    $sizeClass = $sizes[$size] ?? 'max-w-lg';
@endphp

{{-- Modal Backdrop --}}
<div id="{{ $id }}"
     class="fixed inset-0 z-50 hidden items-center justify-center p-4"
     role="dialog" aria-modal="true">

    {{-- Overlay --}}
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm"
         onclick="closeModal('{{ $id }}')"></div>

    {{-- Panel --}}
    <div class="relative w-full {{ $sizeClass }} bg-white rounded-2xl shadow-2xl flex flex-col max-h-[90vh] transition-all">

        {{-- Header --}}
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100 flex-shrink-0">
            <h3 id="{{ $id }}-title" class="text-base font-bold text-gray-800">{{ $title }}</h3>
            <button type="button" onclick="closeModal('{{ $id }}')"
                    class="p-1.5 rounded-lg text-gray-400 hover:text-gray-700 hover:bg-gray-100 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- Body --}}
        <div class="overflow-y-auto px-6 py-5 flex-1">
            {{ $slot }}
        </div>

        {{-- Footer (optional) --}}
        @isset($footer)
        <div class="px-6 py-4 border-t border-gray-100 flex items-center justify-end gap-3 flex-shrink-0">
            {{ $footer }}
        </div>
        @endisset
    </div>
</div>

@once
@push('scripts')
<script>
    function openModal(id)  { const m = document.getElementById(id); m.classList.remove('hidden'); m.classList.add('flex'); }
    function closeModal(id) { const m = document.getElementById(id); m.classList.remove('flex'); m.classList.add('hidden'); }
</script>
@endpush
@endonce
