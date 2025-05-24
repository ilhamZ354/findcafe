@section('title-header', 'List Booking Chat')

<x-dashboard.layout>
    <!-- ===== Main Content Start ===== -->
    <main>
        <div class="p-4 mx-auto max-w-screen-2xl md:p-6 2xl:p-10">
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-6 xl:grid-cols-4 2xl:gap-7.5">
                <!-- ====== Table Transaksi Cafe Start -->
                <div x-data="{
                    openModal: false,
                    openEditModal: {{ isset($showModalEdit) && $showModalEdit ? 'true' : 'false' }},
                    openDeleteModal: false
                }" class="col-span-12 xl:col-span-8">
                    <div
                        class="rounded-xl border border-stroke bg-white px-5 pb-2.5 pt-6 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-5 -z-10">
                        <div class="flex items-center justify-between mb-6">
                            <h4 class="text-xl font-bold text-black">List Booking Chat</h4>
                        </div>


                        {{-- table --}}
                        <ul class="max-w-md divide-y divide-gray-200">
                            @foreach ($users as $user)
                                <li class="pb-3 sm:pb-4 group">
                                    <a href="{{ route('cafe.chat', $user->id) }}"
                                        class="flex items-center space-x-4 rtl:space-x-reverse ">
                                        <div class="shrink-0">
                                            <img class="w-8 h-8 rounded-full"
                                                src="{{ asset('images/profile-default.png') }}" alt="image profile">
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p
                                                class="text-sm font-medium text-gray-900 capitalize group-hover:underline">
                                                {{ $user->name }}
                                            </p>
                                            <p class="text-sm text-gray-500 truncate line-clamp-1">
                                                {{ $user->unreadMessages->first()?->message ?? 'Tidak ada pesan baru' }}
                                            </p>
                                        </div>
                                        <div class="inline-flex items-center text-base font-semibold text-gray-900">
                                            @if ($user->unreadMessages->first()?->message != null)
                                                <span
                                                    class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm0">Pesan
                                                    Baru</span>
                                            @endif
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- ===== Main Content End ===== -->

    <!-- modal -->
    {{-- @include('components.modal.cafe.add-transaksi')

    @if (isset($transaction))
        @include('components.modal.cafe.update-transaksi')
    @endif

    @if (isset($showModalEdit) && $showModalEdit)
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const updateModal = document.getElementById('update-transaksi');
                const modal = new Modal(updateModal);
                modal.show();

                // Focus on first input when modal opens
                updateModal.addEventListener('shown.bs.modal', function() {
                    document.querySelector('#update-transaksi input[name="name"]').focus();
                });
            });
        </script>
    @endif --}}

</x-dashboard.layout>
