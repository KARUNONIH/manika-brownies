<!-- modal cart -->
<div id="default-modal" tabindex="-1" aria-hidden="true" class="fixed z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden inset-0">
    <div class="relative max-h-full w-full max-w-2xl p-4">
      <!-- Modal content -->
      <div class="relative rounded-lg bg-white shadow">
        <!-- Modal header -->
        <div class="flex items-center justify-between rounded-t border-b px-2 py-1">
          <h3 class="text-sm font-semibold uppercase text-gray-900">Data diri</h3>
          <button type="button" class="ms-auto inline-flex h-8 w-8 items-center justify-center rounded-lg bg-transparent text-sm text-gray-400 hover:bg-gray-200 hover:bg-gray-600 hover:text-gray-900 hover:text-white" id="btn-close-modal">
            <svg class="h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close modal</span>
          </button>
        </div>
        <!-- Modal body -->
        <div class="w-full space-y-4 px-2 py-3">
          <form class="">
            <div class="grid grid-cols-2 gap-6">
              <div class="group relative z-0 mb-5 w-full">
                <label for="namaPenerima" class="block text-[11px] font-medium capitalize text-gray-900">Nama Penerima</label>
                <input type="text" name="namaPenerima" id="namaPenerima" class="peer block w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent px-0 py-1.5 text-sm text-gray-900 focus:border-green-600 focus:outline-none focus:ring-0" placeholder="John Doe" required />
              </div>
              <div class="group relative z-0 mb-5 w-full">
                <label for="teleponPenerima" class="block text-[11px] font-medium capitalize text-gray-900">Telepon Penerima</label>
                <section class="flex items-center">
                  <i class="fa-solid fa-plus"></i>
                  <input type="number" name="negaraTeleponPenerima" id="negaraTeleponPenerima" class="peer block w-1/5 appearance-none border-0 border-b-2 border-gray-300 bg-transparent px-1 py-1.5 text-sm text-gray-900 focus:border-green-600 focus:outline-none focus:ring-0 md:px-2" value="62" required min="0" max="99" />
                  <input type="number" name="teleponPenerima" id="teleponPenerima" class="peer block w-full appearance-none border-0 border-b-2 border-gray-300 bg-transparent px-0 py-1.5 text-sm text-gray-900 focus:border-green-600 focus:outline-none focus:ring-0" placeholder="81234567890 " required />
                </section>
              </div>
            </div>
            <div class="">
              <label for="alamatPenerima" class="mb-2 block text-[11px] font-medium capitalize text-gray-900">Alamat Penerima</label>
              <textarea id="alamatPenerima" rows="2" class="block w-full rounded border border-gray-600 bg-gray-50 p-2.5 text-sm text-gray-900 focus:border-blue-500 focus:ring-blue-500" placeholder="Provinsi, Kota/Kabupaten, Kecamatan, Jalan, RT/RW, No, Kode Pos"></textarea>
            </div>
          </form>
        </div>
        <!-- Modal footer -->
        <div class="flex items-center gap-2 rounded-b border-t border-gray-200 p-2 md:p-5">
          <button type="button" class="rounded bg-gray-600 px-2.5 py-1.5 text-xs capitalize text-white duration-100 md:hover:bg-green-700 lg:px-5 lg:py-2.5 lg:text-sm" id="submit-data-user">submit</button>
          <!-- <button data-modal-hide="default-modal" class="rounded-sm bg-green-600 px-2.5 py-1.5 text-xs capitalize text-white duration-100 md:hover:bg-green-700 lg:px-5 lg:py-2.5 lg:text-sm">Shop now</button> -->
        </div>
      </div>
    </div>
  </div>
