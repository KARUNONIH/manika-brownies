@extends('layout')

@section('content')
<div>
    logout
    <div class="logout">
        <form method="POST" action="{{ route('logout') }} ">
            @csrf
            <div class="mb-3">
                <button class="btn btn-danger" >
                    Logout
                </button>
            </div>
        </form>
     </div>
</div>
<h1>Daftar Kue</h1>
<a href="{{ route('myadmin.create') }}">Tambah Kue</a>
<div class="relative flex flex-col w-full min-w-0 mb-0 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
    <div class="p-6 pb-0 mb-0 bg-white rounded-t-2xl">
        <h6>Authors table</h6>
    </div>
    <div class="flex-auto px-0 pt-0 pb-2">
        <div class="p-0 overflow-x-auto">
        <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
            <thead class="align-bottom">
                <tr>
                    <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">No</th>
                    <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Nama</th>
                    <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Harga</th>
                    <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Gambar</th>
                    <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Tanggal</th>
                    <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Cek BS</th>
                    <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $index => $manika)
                    <tr>
                        <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            <span class="font-semibold leading-tight text-xs text-slate-400">{{ $loop->iteration }}</span>
                        </td>
                        <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            <span class="font-semibold leading-tight text-xs text-slate-400">{{ $manika->nama_kue }}</span>
                        </td>
                        <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            <span class="font-semibold leading-tight text-xs text-slate-400">{{ $manika->formatted_harga }}</span>
                        </td>
                        <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            <img src="{{ asset('storage/' . $manika->gambar_kue) }}" alt="{{ $manika->nama_kue }}" width="100">
                        </td>
                        <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            <span class="font-semibold leading-tight text-xs text-slate-400">{{ $manika->created_at->format('d-m-Y') }}</span>
                        </td>
                        <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            <span class="font-semibold leading-tight text-xs text-slate-400">
                                <input type="checkbox" class="bs-checkbox" data-id="{{ $manika->kode_kue }}" {{ $manika->status_bs ? 'checked' : '' }}>
                            </span>
                        </td>
                        <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                            <a href="{{ route('myadmin.edit', $manika->kode_kue) }}">Edit</a>
                            <form action="{{ route('myadmin.destroy', $manika->kode_kue) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkboxes = document.querySelectorAll('.bs-checkbox');
        const maxChecks = 4;

        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                const checkedCheckboxes = document.querySelectorAll('.bs-checkbox:checked');
                    if (checkedCheckboxes.length > maxChecks) {
                        this.checked = false;
                        alert('Maksimal hanya 4 kue yang dapat dijadikan Best Seller.');
                    } else {
                        const id = this.getAttribute('data-id');
                        const status = this.checked;

                        fetch(`/myadmin/${id}/set-bs`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ status })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (!data.success) {
                                this.checked = !status;
                                alert(data.message);
                        }
                    });
                }
            });
        });
    });
</script>
@endsection
