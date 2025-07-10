  <form class="max-w-xl mx-auto mb-5" action="{{ route('home') }}" id="search-form">
      <label for="search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
      <div class="relative">
          <div class="absolute inset-y-0 flex items-center pointer-events-none start-0 ps-3">
              <svg class="w-4 h-4 text-gray-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                  viewBox="0 0 20 20">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
              </svg>
          </div>
          <input type="search" id="search" name="search" value="{{ request('search') }}"
              class="block w-full p-4 text-sm text-gray-900 border border-gray-300 rounded-lg ps-10 bg-gray-50 focus:ring-primaryBrown focus:border-primaryBrown d"
              placeholder="Masukkan nama cafe favoritmu..." required />

          {{-- button reset --}}
          @if (request('search'))
              <a href="/home#services" class="absolute z-10 transition-all right-24 bottom-3">
                  <svg class="w-6 h-6 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                      width="24" height="24" fill="none" viewBox="0 0 24 24">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M6 18 17.94 6M18 18 6.06 6" />
                  </svg>
              </a>
          @endif

          <button type="submit"
              class="text-white absolute end-2.5 bottom-2.5 bg-primaryBrown hover:bg-semiPrimaryBrown focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2">Search</button>
      </div>
  </form>
