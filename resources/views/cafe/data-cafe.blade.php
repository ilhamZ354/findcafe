@section('title-header', 'Cafe')

<x-dashboard.layout>
    <!-- ===== Main Content Start ===== -->
    <main>
        @if (session()->has('success'))
            <script>
                localStorage.removeItem("uploadedImages");
            </script>
        @endif

        <div
            class="flex flex-col-reverse items-start justify-between flex-grow w-full gap-4 px-4 py-4 md:flex-row md:px-6">
            {{-- card 1 --}}
            <div class="w-full px-3 py-5 bg-white shadow-md md:w-2/3 rounded-xl">

                @if (!isset($cafe->id))
                    <div class="p-4 my-10 text-lg text-red-800 rounded-lg bg-red-50 " role="alert">
                        <span class="font-medium">Penting!</span> Mohon isi terlebih dahulu data detail cafe
                        berikut.
                    </div>
                @endif

                <div class="mb-6">
                    <h4 class="text-xl font-bold text-black dark:text-white">Data Detail Cafe</h4>
                    <span>Lengkapi data-data berikut untuk melengkapi informasi Cafe.</span>
                </div>

                {{-- form detail cafe --}}
                <form action="{{ isset($cafe->id) ? route('cafe.update', $cafe->id) : route('cafe.store') }}"
                    method="POST" enctype="multipart/form-data">
                    @if (isset($cafe->id))
                        @method('PUT')
                    @endif
                    @csrf
                    <div class="flex flex-col gap-2 mb-3">
                        {{-- image_profile --}}
                        <x-form.profile-upload value="{{ $cafe->image_profile ?? '' }}" />

                        {{-- deskripsi --}}
                        <x-form.textarea label="Deskripsi" name="description" placeholder="Tulis deskripsi di sini..."
                            required rows="6" value="{{ $cafe->description ?? '' }}" />

                        {{-- gallery --}}
                        <x-form.gallery-upload :values="$cafe->galleries ?? []" />

                        {{-- address --}}
                        <x-form.input-field name="address" label="Alamat Cafe" placeholder="Masukkan alamat"
                            value="{{ $cafe->address ?? '' }}" required />

                        {{-- location(maps) --}}
                        <x-form.input-field name="location" label="Lokasi Cafe"
                            placeholder="Masukkan lokasi (Link Google Maps)" value="{{ $cafe->location ?? '' }}"
                            required />
                    </div>

                    {{-- button simpan --}}
                    <x-form.button-form type="submit" label="Simpan">
                        <svg class="w-5 h-5 me-1 -ms-1" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </x-form.button-form>
                </form>
            </div>

            {{-- card 2 --}}
            <div
                class="flex flex-col items-center justify-start w-full px-3 py-5 bg-white shadow-md md:w-1/3 rounded-xl">
                <img src="{{ $cafe->image_profile ?? asset('images/profile-default.png') }}" alt="image-profile-default"
                    class="object-cover w-20 h-20 rounded-full">

                <hr class="w-full my-5 border-gray-300">

                {{-- data cafe --}}
                <div>
                    <h1 class="text-2xl font-bold text-center text-primaryBrown">{{ Auth::user()->username }}</h1>
                    <span
                        class="block mx-auto text-sm font-light text-center text-grayTheme">{{ Auth::user()->role }}</span>

                </div>
                <div class="w-full mt-3 text-left">
                    <table class="text-sm text-slate-300">
                        <tr>
                            <td class="pr-4 align-top font-extralight">Email</td>
                            <td class="font-medium text-grayTheme">{{ Auth::user()->email }}</td>
                        </tr>
                        <tr>
                            <td class="pr-4 align-top font-extralight">No Whatsapp</td>
                            <td class="font-medium text-grayTheme">{{ Auth::user()->no_wa }}</td>
                        </tr>
                    </table>
                </div>

                <span class="block mx-auto mt-8 mb-2 text-sm italic font-light text-center text-grayTheme">Bergabung
                    sejak
                    {{ Auth::user()->created_at->diffForHumans() }}</span>
            </div>
        </div>
    </main>
    <!-- ===== Main Content End ===== -->

</x-dashboard.layout>
