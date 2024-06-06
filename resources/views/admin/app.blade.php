@extends('admin.template.template')

@section('content')
    <div id="dashboard" class="page">
        <div class="w-full px-6 py-6 mx-auto">
            <!-- row 1 -->
            <div class="flex flex-wrap -mx-3">
                <!-- card1 -->
                <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                    <div
                        class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                        <div class="flex-auto p-4">
                            <div class="flex flex-row -mx-3">
                                <div class="flex-none max-w-full px-3">
                                    <div>
                                        <p
                                            class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">
                                            Pendapatan Hari ini</p>
                                        {{-- <h5 class="mb-2 font-bold dark:text-white">taro ini</h5> --}}
                                        <p class="mb-2 font-bold dark:text-white">
                                            {{ 'Rp' . number_format($totalIncomeToday, 0, ',', '.') }}</p>

                                        <p class="mb-0 dark:text-white dark:opacity-60">
                                            <span
                                                class="text-sm font-bold leading-normal text-emerald-500">{{ $percentageIncome }}
                                                %</span>
                                            dari pendapatan kemarin
                                        </p>
                                    </div>
                                </div>
                                {{-- <div class="px-3 text-right basis-1/3">
                                    <div
                                        class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-blue-500 to-violet-500">
                                        <i class="ni leading-none ni-money-coins text-lg relative top-3.5 text-white"></i>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- card2 -->
                <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                    <div
                        class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                        <div class="flex-auto p-4">
                            <div class="flex flex-row -mx-3">
                                <div class="flex-none max-w-full px-3">
                                    <div>
                                        <p
                                            class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">
                                            Produk Terjual Hari ini</p>
                                        <h5 class="mb-2 font-bold dark:text-white">{{ $produkTerjualHariIni }}</h5>
                                        <p class="mb-0 dark:text-white dark:opacity-60">
                                            <span
                                                class="text-sm font-bold leading-normal text-emerald-500">{{ $percentageProduct }}%</span>
                                            dari kemarin
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- card3 -->
                <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                    <div
                        class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                        <div class="flex-auto p-4">
                            <div class="flex flex-row -mx-3">
                                <div class="flex-none max-w-full px-3">
                                    <div>
                                        <p
                                            class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">
                                            Total Pendapatan</p>
                                        <h5 class="mb-2 font-bold dark:text-white">
                                            {{ 'Rp' . number_format($totalIncome->total_harga, 0, ',', '.') }}</h5>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- card4 -->
                <div class="w-full max-w-full px-3 sm:w-1/2 sm:flex-none xl:w-1/4">
                    <div
                        class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                        <div class="flex-auto p-4">
                            <div class="flex flex-row -mx-3">
                                <div class="flex-none max-w-full px-3">
                                    <div>
                                        <p
                                            class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60">
                                            Total Produk Terjual</p>
                                        <h5 class="mb-2 font-bold dark:text-white">{{ $totalProdukTerjual }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <!-- cards row 2 -->
            <div class="flex flex-wrap mt-6 -mx-3">
                <div class="w-full max-w-full px-3 mt-0 lg:w-7/12 lg:flex-none">
                    <div
                        class="border-black/12.5 dark:bg-slate-850 dark:shadow-dark-xl shadow-xl relative z-20 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
                        <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid p-6 pt-4 pb-0">
                            <h6 class="capitalize dark:text-white">Sales overview</h6>
                            <p class="mb-0 text-sm leading-normal dark:text-white dark:opacity-60">
                                <i class="fa fa-arrow-up text-emerald-500"></i>
                                <span class="font-semibold">4% more</span> in 2021
                            </p>
                        </div>
                        <div class="flex-auto p-4">
                            <div>
                                <canvas id="chart-line" height="300"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full max-w-full px-3 lg:w-5/12 lg:flex-none">
                    <div slider class="relative w-full h-full overflow-hidden rounded-2xl">
                        <!-- slide 1 -->
                        <div slide class="absolute w-full h-full transition-all duration-500">
                            <img class="object-cover h-full" src="{{ asset('admin/img/carousel-1.jpg') }}"
                                alt="carousel image" />
                            <div class="block text-start ml-12 left-0 bottom-0 absolute right-[15%] pt-5 pb-5 text-white">
                                <div
                                    class="inline-block w-8 h-8 mb-4 text-center text-black bg-white bg-center rounded-lg fill-current stroke-none">
                                    <i class="top-0.75 text-xxs relative text-slate-700 ni ni-camera-compact"></i>
                                </div>
                                <h5 class="mb-1 text-white">Get started with Argon</h5>
                                <p class="dark:opacity-80">There’s nothing I really wanted to do in life that I wasn’t able
                                    to get good at.</p>
                            </div>
                        </div>

                        <!-- slide 2 -->
                        <div slide class="absolute w-full h-full transition-all duration-500">
                            <img class="object-cover h-full" src="{{ asset('admin/img/carousel-2.jpg') }}"
                                alt="carousel image" />
                            <div class="block text-start ml-12 left-0 bottom-0 absolute right-[15%] pt-5 pb-5 text-white">
                                <div
                                    class="inline-block w-8 h-8 mb-4 text-center text-black bg-white bg-center rounded-lg fill-current stroke-none">
                                    <i class="top-0.75 text-xxs relative text-slate-700 ni ni-bulb-61"></i>
                                </div>
                                <h5 class="mb-1 text-white">Faster way to create web pages</h5>
                                <p class="dark:opacity-80">That’s my skill. I’m not really specifically talented at anything
                                    except for the ability to learn.</p>
                            </div>
                        </div>

                        <!-- slide 3 -->
                        <div slide class="absolute w-full h-full transition-all duration-500">
                            <img class="object-cover h-full" src="{{ asset('admin/img/carousel-3.jpg') }}"
                                alt="carousel image" />
                            <div class="block text-start ml-12 left-0 bottom-0 absolute right-[15%] pt-5 pb-5 text-white">
                                <div
                                    class="inline-block w-8 h-8 mb-4 text-center text-black bg-white bg-center rounded-lg fill-current stroke-none">
                                    <i class="top-0.75 text-xxs relative text-slate-700 ni ni-trophy"></i>
                                </div>
                                <h5 class="mb-1 text-white">Share with us your design tips!</h5>
                                <p class="dark:opacity-80">Don’t be afraid to be wrong because you can’t learn anything from
                                    a compliment.</p>
                            </div>
                        </div>

                        <!-- Control buttons -->
                        <button btn-next
                            class="absolute z-10 w-10 h-10 p-2 text-lg text-white border-none opacity-50 cursor-pointer hover:opacity-100 far fa-chevron-right active:scale-110 top-6 right-4"></button>
                        <button btn-prev
                            class="absolute z-10 w-10 h-10 p-2 text-lg text-white border-none opacity-50 cursor-pointer hover:opacity-100 far fa-chevron-left active:scale-110 top-6 right-16"></button>
                    </div>
                </div>
            </div> --}}

            <!-- cards row 3 -->

            <div class="flex flex-wrap mt-6 -mx-3">
                <div class="w-full max-w-full px-3 mt-0 mb-6 lg:mb-0 lg:w-7/12 lg:flex-none">
                    <div
                        class="relative flex flex-col min-w-0 break-words bg-white border-0 border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl dark:bg-gray-950 border-black-125 rounded-2xl bg-clip-border">
                        <div class="p-4 pb-0 mb-0 rounded-t-4">
                            <div class="flex justify-between">
                                <h6 class="mb-2 dark:text-white">Statistik Produk</h6>
                            </div>
                        </div>
                        <div class="overflow-x-auto">
                            <table
                                class="items-center w-full mb-4 align-top border-collapse border-gray-200 dark:border-white/40">
                                <thead>
                                    <th class="text-center">Product</th>
                                    <th>Jumlah Transaksi</th>
                                    <th>Total Terjual</th>
                                    <th>Persentase penjualan</th>
                                </thead>
                                <tbody>
                                    @foreach ($penjualan as $item)
                                        <tr>
                                            <td
                                                class="p-2 align-middle bg-transparent border-b w-3/10 whitespace-nowrap dark:border-white/40">
                                                <div class="flex items-center px-2 py-1">
                                                    <div>
                                                        <img class="w-10 h-10 rounded-full"
                                                            src="{{ 'storage/' . $item->gambar_kue }}" alt="Country flag" />
                                                    </div>
                                                    <div class="ml-6">
                                                        <p
                                                            class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-60">
                                                            {{ $item->nama_kue }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td
                                                class="p-2 align-middle bg-transparent border-b whitespace-nowrap dark:border-white/40">
                                                <div class="text-center">
                                                    <p
                                                        class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-60">
                                                        {{ $item->jumlah_transaksi }}</p>
                                                </div>
                                            </td>
                                            <td
                                                class="p-2 align-middle bg-transparent border-b whitespace-nowrap dark:border-white/40">
                                                <div class="text-center">
                                                    <p
                                                        class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-60">
                                                        {{ $item->total_kue_terjual }}</p>
                                                </div>
                                            </td>
                                            <td
                                                class="p-2 text-sm leading-normal align-middle bg-transparent border-b whitespace-nowrap dark:border-white/40">
                                                <div class="flex-1 text-center">
                                                    <p
                                                        class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-60">
                                                        {{ $item->persentase_penjualan }} %</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="w-full max-w-full px-3 mt-0 lg:w-5/12 lg:flex-none">
                    <div
                        class="border-black/12.5 shadow-xl dark:bg-slate-850 dark:shadow-dark-xl relative flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
                        <div class="p-4 pb-0 rounded-t-4">
                            <h6 class="mb-0 dark:text-white">History Transaksi</h6>
                        </div>
                        <div class="flex-auto p-4">
                            <table
                                class="items-center w-full mb-4 align-top border-collapse border-gray-200 dark:border-white/40">
                                <thead>
                                    <th class="text-center">Pembeli</th>
                                    <th class="text-center">Tanggal</th>
                                    <th class="text-center">Status</th>
                                </thead>
                                <tbody>
                                    @foreach ($historiTransaksi as $item)
                                        <tr>
                                            <td
                                                class="p-2 align-middle bg-transparent border-b w-3/10 whitespace-nowrap dark:border-white/40">
                                                <div class="flex items-center px-2 py-1">
                                                    <div class="ml-6">
                                                        <p
                                                            class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-60">
                                                            {{ $item->nama_pembeli }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td
                                                class="p-2 align-middle bg-transparent border-b whitespace-nowrap dark:border-white/40">
                                                <div class="text-center">
                                                    <p
                                                        class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-60">
                                                        {{ \Carbon\Carbon::parse($item->updated_at)->format('d-m-Y') }}
                                                    </p>
                                                </div>
                                            </td>
                                            <td
                                                class="p-2 align-middle bg-transparent border-b whitespace-nowrap dark:border-white/40">
                                                <div class="text-center">
                                                    <p
                                                        class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-60">
                                                        {{ $item->status }}</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="menu" class="hidden page">
        <div class="w-full px-6 py-6 mx-auto">
            <div class="d-flex gap-2">
                <button class="btn btn-dark mb-2" data-bs-toggle="modal" data-bs-target="#addProductModal">Tambah
                    menu</button>
                <button class="btn btn-dark mb-2" data-bs-toggle="modal" data-bs-target="#listKategori">List
                    Kategori</button>
            </div>

            <div class="flex flex-wrap -mx-3">
                <div class="flex-none w-full max-w-full px-3">
                    <div
                        class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                        <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                            <h6 class="dark:text-white">Tabel Product</h6>
                        </div>
                        <div class="flex-auto px-0 pt-0 pb-2">
                            <div class="p-4 overflow-x-auto">
                                <table
                                    class="items-center w-full mb-0 align-top border-2 border-collapse dark:border-white/40 text-slate-500"
                                    id="tableMenu" style="width: 100% !important;">
                                    <thead class="align-bottom">
                                        <tr>
                                            <th
                                                class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                No</th>
                                            <th
                                                class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                Produk</th>
                                            <th
                                                class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                Kategori</th>
                                            <th
                                                class="px-6 py-3 pl-2 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                Harga</th>
                                            <th
                                                class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                Status</th>
                                            <th
                                                class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $index => $manika)
                                            <tr class="border-b dark:border-white/40">
                                                <td>
                                                    <p
                                                        class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-80 text-center">
                                                        {{ $loop->iteration }}</p>
                                                </td>
                                                <td
                                                    class="p-2 align-middle bg-transparent  whitespace-nowrap shadow-transparent">
                                                    <div class="flex px-2 py-1">
                                                        <div>
                                                            <img src="{{ asset('storage/' . $manika->gambar_kue) }}"
                                                                class="inline-flex items-center justify-center mr-4 text-sm text-white transition-all duration-200 ease-in-out h-9 w-9 rounded-xl"
                                                                alt="user1" />
                                                        </div>
                                                        <div class="flex flex-col justify-center">
                                                            <h6 class="mb-0 text-sm leading-normal dark:text-white">
                                                                {{ $manika->nama_kue }}</h6>
                                                            <p
                                                                class="mb-0 text-xs leading-tight dark:text-white dark:opacity-80 text-slate-400">
                                                                {{ $manika->deskripsi }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td
                                                    class="p-2 align-middle bg-transparent  whitespace-nowrap shadow-transparent">
                                                    <p
                                                        class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-80">
                                                        {{ $manika->kategori->namaKategori }}</p>
                                                </td>
                                                <td
                                                    class="p-2 align-middle bg-transparent  whitespace-nowrap shadow-transparent">
                                                    <p
                                                        class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-80">
                                                        {{ $manika->formatted_harga }}</p>
                                                </td>
                                                <td
                                                    class="p-2 text-sm leading-normal text-center align-middle bg-transparent  whitespace-nowrap shadow-transparent">
                                                    <form class="status-form max-w-sm mx-auto"
                                                        data-id="{{ $manika->kode_kue }}" data-type="menu">
                                                        @csrf
                                                        <select name="status_bs"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                            <option value="true"
                                                                {{ $manika->status_bs ? 'selected' : '' }}>favorite
                                                            </option>
                                                            <option value="false"
                                                                {{ !$manika->status_bs ? 'selected' : '' }}>biasa</option>
                                                        </select>
                                                    </form>
                                                </td>
                                                <td
                                                    class=" border-none  align-middle bg-transparent  whitespace-nowrap shadow-transparent flex gap-2 justify-center">
                                                    <button href="" class="btn btn-outline-warning"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#editProductModal{{ $manika->kode_kue }}">
                                                        <i class="fa-solid fa-pen-to-square"></i></button>
                                                    <form action="{{ route('myadmin.destroy', $manika->kode_kue) }}"
                                                        method="POST"
                                                        onsubmit="return confirmDelete(event, {{ $manika->kode_kue }})"
                                                        id="deleteProduct{{ $manika->kode_kue }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-outline-danger" type="submit">
                                                            <i class="fa-solid fa-trash-can"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

    <div id="transaksi" class="hidden page">
        <div class="w-full px-6 py-6 mx-auto">
            <div class="d-flex">
                <button class="btn btn-dark mb-2" data-bs-toggle="modal" data-bs-target="#addTransactionModal">Tambah
                    Transaksi</button>

            </div>

            <div class="flex flex-wrap -mx-3">
                <div class="flex-none w-full max-w-full px-3">
                    <div
                        class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
                        <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                            <h6 class="dark:text-white">Tabel Transaksi</h6>
                        </div>
                        <div class="flex-auto px-0 pt-0 pb-2">
                            <div class="p-4 overflow-x-auto">
                                <table
                                    class="items-center w-full mb-0 align-top border-2 border-collapse dark:border-white/40 text-slate-500"
                                    id="tableTransaksi" style="width: 100% !important;">
                                    <thead>
                                        <tr class="border-b dark:border-white/40">
                                            <th
                                                class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                Nama Pembeli</th>
                                            <th
                                                class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                Nomor Telepon</th>
                                            <th
                                                class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                Alamat</th>

                                            <th
                                                class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                Total Harga</th>
                                            <th
                                                class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                Tanggal</th>
                                            <th
                                                class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                Status</th>
                                            <th
                                                class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transactionsDetail as $transaction)
                                            <tr class="border-b-2 border-gray-300">
                                                <td
                                                    class="p-2 align-middle text-center bg-transparent  whitespace-nowrap shadow-transparent">
                                                    <p
                                                        class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-80">
                                                        {{ $transaction->nama_pembeli }}</p>
                                                </td>
                                                <td
                                                    class="p-2 align-middle text-center bg-transparent  whitespace-nowrap shadow-transparent">
                                                    <p
                                                        class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-80">
                                                        {{ $transaction->nomor_telepon }}</p>
                                                </td>
                                                <td
                                                    class="p-2 align-middle text-center bg-transparent  whitespace-nowrap shadow-transparent">
                                                    <p
                                                        class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-80">
                                                        {{ $transaction->alamat }}</p>
                                                </td>

                                                <td
                                                    class="p-2 align-middle text-center bg-transparent  whitespace-nowrap shadow-transparent">
                                                    <p
                                                        class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-80">
                                                        {{ 'Rp ' . number_format($transaction->total_harga, 0, ',', '.') }}
                                                    </p>
                                                </td>
                                                <td
                                                    class="p-2 align-middle text-center bg-transparent  whitespace-nowrap shadow-transparent">
                                                    <p
                                                        class="mb-0 text-xs font-semibold leading-tight dark:text-white dark:opacity-80">
                                                        {{ \Carbon\Carbon::parse($transaction->created_at)->format('d-m-Y') }}
                                                    </p>
                                                </td>
                                                <td
                                                    class="p-2 text-sm leading-normal text-center align-middle bg-transparent  whitespace-nowrap shadow-transparent">
                                                    <form class="status-form max-w-sm mx-auto"
                                                        data-name="{{ $transaction->nama_pembeli }}"
                                                        data-created_at="{{ $transaction->created_at }}"
                                                        data-type="transaksi">
                                                        @csrf
                                                        @method('PATCH')
                                                        <select name="status"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                            <option value="pending"
                                                                {{ $transaction->status === 'pending' ? 'selected' : '' }}>
                                                                pending</option>
                                                            <option value="diproses"
                                                                {{ $transaction->status === 'diproses' ? 'selected' : '' }}>
                                                                diproses</option>
                                                            <option value="dikirim"
                                                                {{ $transaction->status === 'dikirim' ? 'selected' : '' }}>
                                                                dikirim</option>
                                                            <option value="selesai"
                                                                {{ $transaction->status === 'selesai' ? 'selected' : '' }}>
                                                                selesai</option>
                                                        </select>
                                                    </form>
                                                </td>
                                                <td class="flex justify-center mt-2 items-center gap-2">
                                                    <button class="btn btn-outline-success" data-bs-toggle="modal"
                                                        data-bs-target="#detailModal{{ md5($transaction->nama_pembeli . $transaction->created_at) }}"><i
                                                            class="fa-solid fa-magnifying-glass"></i></button>
                                                    <form
                                                        action="{{ route('transactions.delete', ['nama_pembeli' => $transaction->nama_pembeli, 'created_at' => $transaction->created_at]) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger"><i
                                                                class="fa-solid fa-trash-can"></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

    {{-- modal list kategori --}}
    <div class="modal fade" id="listKategori" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">List Kategori</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <button class="btn btn-dark mb-2" data-bs-toggle="modal" data-bs-target="#addKategoriModal">Tambah
                        Kategori</button>
                    <table class="w-full bg-white border border-gray-300">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 border-b">Nama Kategori</th>
                                <th class="px-4 py-2 border-b">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $item)
                                <tr class="border-b">
                                    <td class="px-4 py-2">
                                            <p>{{ $item->namaKategori }}</p>
                                    </td>
                                    <td class="px-4 py-2  flex items-center gap-2">
                                        <button class="btn btn-outline-warning" data-bs-toggle="modal"
                                            data-bs-target="#detailKategoriModal{{ $item->id }}">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        <form action="{{ route('kategori.destroy', ['id' => $item->id]) }}"
                                            method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger"><i
                                                    class="fa-solid fa-trash-can"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- modal tambah kategori --}}
    <div class="modal fade" id="addKategoriModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <form action="{{ route('kategori.store') }}" method="POST">
            @csrf

            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Transaksi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <label for="namaKategori" class="form-label">Nama kategori</label>
                            <input type="text" name="namaKategori" id="namaKategori" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    {{-- modal edit kategori --}}
    @foreach ($categories as $item)
        <div class="modal fade" id="detailKategoriModal{{ $item->id }}" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <form action="{{ route('kategori.update', $item->id)  }}" method="POST">

            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Transaksi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                            @csrf
                            @method('PUT')
                            <div>
                                <label for="namaKategori" class="form-label">Nama kategori</label>
                                <input type="text" name="namaKategori" id="namaKategori" class="form-control"
                                    value="{{ $item->namaKategori }}" required>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
        </div>
    @endforeach

    {{-- modal detail transaksi --}}
    @foreach ($transactionsDetail as $transaction)
        <div class="modal fade" id="detailModal{{ md5($transaction->nama_pembeli . $transaction->created_at) }}"
            tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Transaksi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h2 class="text-lg font-bold mb-2">Catatan: {{ $transaction->catatan }}</h2>
                        {{-- <p class="mb-2">Nomor Telepon: {{ $transaction->nomor_telepon }}</p> --}}
                        {{-- <p class="mb-2">Tanggal Beli: {{ \Carbon\Carbon::parse($transaction->created_at)->format('d-m-Y') }}</p> --}}
                        <table class="min-w-full bg-white border border-gray-300">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2 border-b">Nama Kue</th>
                                    <th class="px-4 py-2 border-b">Jumlah Kue</th>
                                    <th class="px-4 py-2 border-b">Harga Satuan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions->where('nama_pembeli', $transaction->nama_pembeli)->where('created_at', $transaction->created_at) as $detail)
                                    <tr>
                                        <td class="px-4 py-2 border-b">{{ $detail->nama_kue }}</td>
                                        <td class="px-4 py-2 border-b">{{ $detail->jumlah_kue }}</td>
                                        <td class="px-4 py-2 border-b">{{ $detail->harga_satuan }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- add modal transaksi --}}
    <div class="modal fade" id="addTransactionModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <form action="{{ route('transactions.store') }}" method="POST">
            @csrf
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Transaksi</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" style="max-height: 400px; overflow:auto;">
                        <div>
                            <label for="nama_pembeli" class="form-label">Nama Pembeli:</label>
                            <input type="text" name="nama_pembeli" id="nama_pembeli" class="form-control" required>
                        </div>
                        <div>
                            <label for="nomor_telepon" class="form-label">Nomor Telepon:</label>
                            <input type="text" name="nomor_telepon" id="nomor_telepon" class="form-control" required>
                        </div>
                        <div>
                            <label for="alamat" class="form-label">Alamat:</label>
                            <input type="text" name="alamat" id="alamat" class="form-control" required>
                        </div>
                        <div>
                            <label for="catatan" class="form-label">Catatan:</label>
                            <textarea name="catatan" id="catatan" class="form-control"></textarea>
                        </div>
                        <div id="kue-fields">
                            <div class="kue-field">
                                <label for="kode_kue_1" class="form-label">Kode Kue:</label>
                                <select name="kode_kue[]" id="kode_kue_1" data-index="1" class="form-select kode-kue"
                                    required>
                                    <option value="">Pilih Kue</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->kode_kue }}" data-harga="{{ $product->harga_kue }}">
                                            {{ $product->nama_kue }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="jumlah_kue_1" class="form-label">Jumlah Kue:</label>
                                <input type="number" name="jumlah_kue[]" id="jumlah_kue_1" data-index="1"
                                    class="form-control jumlah-kue" required>
                                <label for="total_harga_1" class="form-label">Total Harga:</label>
                                <input type="text" name="total_harga[]" id="total_harga_1"
                                    class="form-control total-harga" readonly>
                            </div>
                        </div>
                        <button type="button" id="tambah-kue" class="btn btn-secondary mt-3">Tambah Kue</button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    {{-- add modal product --}}
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form id="addProductForm" action="{{ route('myadmin.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Produk</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md">
                                <label for="nama_kue">Nama:</label>
                                <input type="text" class="form-control" id="nama_kue" name="nama_kue" required>
                            </div>
                            <div class="form-group col-md">
                                <label for="harga_kue">Harga:</label>
                                <input type="number" class="form-control" id="harga_kue" name="harga_kue" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="kode_kategori">Kategori</label>
                            <select name="kode_kategori" id="kode_kategori" class="form-select"
                                    required>
                                    <option value="">Pilih Kategori</option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}">
                                            {{ $item->namaKategori }}
                                        </option>
                                    @endforeach
                                </select>
                        </div>
                        <div class="form-group mt-4">
                            <label for="deskripsi">Deskripsi:</label>
                            <textarea class="form-control" id="deskripsi" name="deskripsi" required></textarea>
                        </div>
                        <div class="form-group mt-4">
                            <label for="gambar_kue">Gambar:</label>
                            <input type="file" class="form-control-file" id="gambar_kue" name="gambar_kue"
                                accept="image/*" required>
                            <img id="imagePreview" src="#" alt="Image Preview" style="display: none;"
                                class="img-fluid mt-4" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    {{-- edit modal product --}}
    @foreach ($products as $index => $manika)
        <div class="modal fade" id="editProductModal{{ $manika->kode_kue }}" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <form id="editProductForm" action="{{ route('myadmin.update', $manika->kode_kue) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Produk</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group col-md">
                                    <label for="nama_kue">Nama:</label>
                                    <input type="text" class="form-control" id="nama_kue" name="nama_kue" required
                                        value="{{ $manika->nama_kue }}">
                                </div>
                                <div class="form-group col-md">
                                    <label for="harga_kue">Harga:</label>
                                    <input type="number" class="form-control" id="harga_kue" name="harga_kue" required
                                        value="{{ $manika->harga_kue }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="kode_kategori">Kategori</label>
                                <select name="kode_kategori" id="kode_kategori" class="form-select"
                                        required>
                                        <option value="">Pilih Kategori</option>
                                        @foreach ($categories as $item)
                                        @if ($manika->kode_kategori === $item->id)
                                        <option value="{{ $item->id }}" selected>
                                            {{ $item->namaKategori }}
                                        </option>
                                        @else
                                        <option value="{{ $item->id }}">
                                            {{ $item->namaKategori }}
                                        </option>
                                        @endif

                                        @endforeach
                                    </select>
                            </div>
                            <div class="form-group mt-4">
                                <label for="deskripsi">Deskripsi:</label>
                                <textarea class="form-control" id="deskripsi" name="deskripsi" required>{{ $manika->deskripsi }}</textarea>
                            </div>
                            <div class="form-group mt-4">
                                <label for="gambar_kue">Gambar:</label>
                                <input type="file" class="form-control-file" id="gambar_kue" name="gambar_kue"
                                    accept="image/*">
                                <img id="imagePreview" src="{{ 'storage/' . $manika->gambar_kue }}" alt="Image Preview"
                                    class="img-fluid mt-4" />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    @endforeach
@endsection

@push('scripts')
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
            });
        @endif
    </script>
    <script>
        $(document).ready(function() {
            $('#tambah-kue').on('click', function() {
                var kueFields = $('#kue-fields');
                var nextIndex = kueFields.find('.kue-field').length + 1;

                var newKueField = $('<div class="kue-field"></div>');

                var kodeKueLabel = $('<label></label>')
                    .attr('for', 'kode_kue_' + nextIndex)
                    .text('Kode Kue:')
                    .addClass('form-label');
                newKueField.append(kodeKueLabel);

                var selectKue = $('<select></select>')
                    .attr('name', 'kode_kue[]')
                    .attr('id', 'kode_kue_' + nextIndex)
                    .attr('data-index', nextIndex)
                    .addClass('form-select kode-kue')
                    .attr('required', 'required')
                    .on('change', updateTotalHarga);

                $('<option></option>').val('').text('Pilih Kue').appendTo(selectKue);
                @foreach ($products as $product)
                    $('<option></option>')
                        .attr('value', '{{ $product->kode_kue }}')
                        .attr('data-harga', '{{ $product->harga_kue }}')
                        .text('{{ $product->nama_kue }}')
                        .appendTo(selectKue);
                @endforeach
                newKueField.append(selectKue);

                var jumlahKueLabel = $('<label></label>')
                    .attr('for', 'jumlah_kue_' + nextIndex)
                    .text('Jumlah Kue:')
                    .addClass('form-label');
                newKueField.append(jumlahKueLabel);

                var inputJumlahKue = $('<input></input>')
                    .attr('type', 'number')
                    .attr('name', 'jumlah_kue[]')
                    .attr('id', 'jumlah_kue_' + nextIndex)
                    .attr('data-index', nextIndex)
                    .addClass('form-control jumlah-kue')
                    .attr('required', 'required')
                    .on('input', updateTotalHarga);
                newKueField.append(inputJumlahKue);

                var totalHargaLabel = $('<label></label>')
                    .attr('for', 'total_harga_' + nextIndex)
                    .text('Total Harga:')
                    .addClass('form-label');
                newKueField.append(totalHargaLabel);

                var inputTotalHarga = $('<input></input>')
                    .attr('type', 'text')
                    .attr('name', 'total_harga[]')
                    .attr('id', 'total_harga_' + nextIndex)
                    .addClass('form-control total-harga')
                    .attr('readonly', 'readonly');
                newKueField.append(inputTotalHarga);

                kueFields.append(newKueField);
            });

            function updateTotalHarga(event) {
                var index = $(event.target).data('index');
                var selectKue = $('#kode_kue_' + index);
                var jumlahKue = $('#jumlah_kue_' + index);
                var totalHarga = $('#total_harga_' + index);

                var hargaKue = selectKue.find('option:selected').data('harga');
                var jumlah = jumlahKue.val();

                if (hargaKue && jumlah) {
                    totalHarga.val(hargaKue * jumlah);
                } else {
                    totalHarga.val(0);
                }
            }

            $(document).on('input', '.jumlah-kue', updateTotalHarga);
            $(document).on('change', '.kode-kue', updateTotalHarga);
        });
    </script>
@endpush
