<nav class="border-gray-200 shadow-md bg-white">
    <div class="w-full md:w-4/5 flex flex-wrap items-center justify-between mx-auto p-4 md:py-4 md:px-0">
        <a href="https://flowbite.com/" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="{{ asset('/image/logo.png') }}" class="h-8" alt="Manika Brownies" />
            <p class="self-center text-2xl font-semibold whitespace-nowrap hidden md:block">Manika <span class="text-[#583E26]">Brownies</span></p>
        </a>
        <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
            <section class="relative items-center gap-2 pr-[5%] md:flex" id="wrapper-cart">
                <div class="hidden md:flex gap-2 items-center">
                    <a class="btn-show-cart  cursor-pointer uppercase tracking-widest flex gap-2" id="">
                        cart
                        <span><i class="fa-solid fa-cart-shopping text-[#583e26]"></i></span>
                      </a>
                      <p class="cart-indicator hidden h-4 w-4 items-center justify-center rounded-full bg-[#583e26] text-xs text-white min-[1250px]:h-4 min-[1250px]:w-4 min-[1250px]:text-xs" id=""></p>
                </div>

                <form class="fixed bottom-0 right-0 hidden w-screen rounded-bl-[14px] bg-gray-200 p-2 shadow md:bottom-auto md:right-0 md:top-16 md:w-max min-w-[400px]" id="cart">
                  <div class="mb-2 flex justify-between rounded-[6px] bg-white p-2">
                    <section class="flex items-center text-sm font-medium">
                      <p class="mr-2 w-max capitalize">total menu</p>
                      <p class="mr-2">:</p>
                      <p class="mr-2" id="total-menu"></p>
                      <p class="">(<span id="total-item"></span>)</p>
                    </section>
                    <div class="cursor-pointer" id="btn-close-cart"><i class="fa-solid fa-x text-base font-normal"></i></div>
                  </div>
                  <div class="flex max-h-48 flex-col gap-2 overflow-auto" id="product-in-cart"></div>
                  <div class="mt-2 rounded-[6px] bg-white p-2">
                    <!-- <section class="flex items-center text-sm font-medium">
                      <p class="w-28 capitalize">total harga</p>
                      <p class="mr-4">:</p>
                      <p class="" id="total-harga"></p>
                    </section> -->
                    <section class="flex items-center text-sm font-medium">
                      <!-- <p class="w-28 capitalize">biaya ongkir</p>
                      <p class="mr-4">:</p> -->
                      <p class=""><span class="cursor-pointer font-normal italic underline" id="btn-show-modal">Input data diri</span></p>
                    </section>
                    <section class="mt-2">
                      <p class="text-sm font-medium capitalize">Nama penerima</p>
                      <p class="w-full text-xs font-normal capitalize" id="nama-penerima"></p>
                    </section>
                    <section class="mt-2">
                      <p class="text-sm font-medium capitalize">Telepon penerima</p>
                      <p class="w-full text-xs font-normal capitalize" id="telepon-penerima"></p>
                    </section>
                    <section class="mt-2">
                      <p class="text-sm font-medium capitalize">Alamat penerima</p>
                      <p class="w-full text-xs font-normal capitalize" id="alamat-penerima"></p>
                    </section>
                    <section class="mt-4 flex items-center gap-2">
                      <button class="g-recaptcha flex-1 rounded bg-gray-600 py-1 text-sm text-white md:hover:bg-gray-700" id="btn-checkout" type="submit">checkout</button>
                      <section class="flex items-center text-sm font-medium">
                        <p class="mr-2 w-max capitalize">total harga</p>
                        <p class="mr-2">:</p>
                        <p class="" id="total-harga"></p>
                      </section>
                    </section>
                  </div>
                </form>
              </section>
            <button  type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-black rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200" aria-controls="navbar-default" aria-expanded="false" id="btn-navbar">
                <span class="sr-only">Open main menu</span>
                <i class="fa-solid fa-bars text-xl" id="icon-navbar"></i>
            </button>
        </div>
        <div class="hidden w-full md:block md:w-auto" id="navbar-default">
            <ul class="font-medium flex gap-2 flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white" id="nav-menu">
                {{-- list page --}}
            </ul>
        </div>
    </div>
</nav>
