<div class="mt-10">
    <section class="mb-3 flex flex-col md:flex-row gap-4 md:gap-0 md:items-center justify-between md:border-l-4 md:border-[#583e26] lg:mb-6">
        <div class="flex items-center justify-between border-l-4 border-[#583e26] md:border-l-0">
        <h1 class="font ml-2 text-xl font-semibold capitalize">Menu Kami</h1>
        <div class="flex items-center gap-2 md:hidden">
        <a class="btn-show-cart flex cursor-pointer uppercase tracking-widest md:hidden gap-2" id="">
            cart
            <span><i class="fa-solid fa-cart-shopping text-[#583e26]"></i></span>
          </a>
          <p class="cart-indicator hidden h-4 w-4 items-center justify-center rounded-full bg-[#583e26] text-xs text-white min-[1250px]:h-4 min-[1250px]:w-4 min-[1250px]:text-xs" id=""></p>
        </div>
    </div>
    <ul class="flex gap-4 text-sm md:gap-8" id="list-category">
        <!-- list category -->
      </ul>
    </section>
    <div id="wrapper-product" class="min-h-[242px]">
        {{-- list menu --}}
    </div>
    <div id="wrapper-all-indicator-group-menu" class="flex justify-center items-center mt-6">
        <button type="button"
            class="group group flex h-full cursor-pointer items-center justify-center px-4 focus:outline-none"
            id="btn-previous-group-menu">
            <span
                class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-[#583e26] group-focus:outline-none group-focus:ring-4 group-focus:ring-[#583e26]/70 group-focus:ring-white md:h-10 md:w-10 md:group-hover:bg-[#583e26]">
                <svg class="h-4 w-4 text-white rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 1 1 5l4 4" />
                </svg>
                <span class="sr-only">Previous</span>
            </span>
        </button>
        <div class="flex gap-2" id="wrapper-indicator-group-menu">
            {{-- indicator menu --}}
        </div>
        <button type="button"
            class="group flex h-full cursor-pointer items-center justify-center px-4 focus:outline-none"
            id="btn-next-group-menu">
            <span
                class="inline-flex h-8 w-8 items-center justify-center rounded-full bg-[#583e26] group-focus:outline-none group-focus:ring-4 group-focus:ring-[#583e26]/70 group-focus:ring-white md:h-10 md:w-10 md:group-hover:bg-[#583e26]">
                <svg class="h-4 w-4 text-white rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 9 4-4-4-4" />
                </svg>
                <span class="sr-only">Next</span>
            </span>
        </button>
    </div>
</div>
