@extends("layouts.app")

@section("title", "Dashboard | " . config("app.name"))
@section("meta_description", "")

@include("components.dependencies._datatables")

@push("css")
    {{-- code here --}}
@endpush

@section("content")
    <div class="d-flex justify-content-between align-items-center grid-margin flex-wrap">
        <div>
            <h4 class="mb-md-0 mb-3">Dasbor</h4>
        </div>
        <div class="d-flex align-items-center text-nowrap flex-wrap"></div>
    </div>

    <div class="card p-3">
        <div class="d-flex justify-content-between align-items-center grid-margin flex-wrap">
            <div>
                <h4 class="mb-md-0 mb-3">Data Saya | <span class="text-muted">Data ajuan saya</span></h4>
            </div>
            <div class="d-flex align-items-center text-nowrap flex-wrap"></div>
        </div>

        <div class="table-responsive">
            <table class="table-hover table-striped table" id="myTable" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">No. kebun</th>
                        <th scope="col">Nama Pemilik</th>
                        <th scope="col">luasan (Ha)</th>
                        <th scope="col">Jumlah produksi (Kg)</th>
                        <th scope="col">Jenis jagung</th>
                        <th scope="col">varietas jagung</th>
                        <th scope="col">Status</th>
                        <th scope="col">Tgl. Input</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>

    </div>
@endsection


@push("javascript")
    <script>
        $(document).ready(function() {
            let table = new DataTable('#myTable', {
                processing: true,
                serverSide: true,
                ajax: "{{ url()->current() }}",
                lengthMenu: [
                    [10, 15, 25, 50, -1],
                    [10, 15, 25, 50, "Semua"]
                ],
                language: {
                    paginate: {
                        previous: '<i class="mdi mdi-chevron-left">',
                        next: '<i class="mdi mdi-chevron-right">'
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'no_kebun',
                        name: 'no_kebun'
                    },
                    {
                        data: 'nama_pemilik',
                        name: 'nama_pemilik'
                    },
                    {
                        data: 'luas',
                        name: 'luas'
                    },
                    {
                        data: 'jumlah_produksi',
                        name: 'jumlah_produksi'
                    },
                    {
                        data: 'jenis_jagung',
                        name: 'jenis_jagung'
                    },
                    {
                        data: 'varietas_jagung',
                        name: 'varietas_jagung'
                    },
                    {
                        data: 'reviewed',
                        name: 'reviewed',
                    }, {
                        data: 'created_at',
                        name: 'created_at',

                    }, {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Hapus data
            $('body').on('click', '.deleteRowData', function(e) {
                e.preventDefault();
                const dataId = $(this).data('id');
                const url = `{{ route("admin.lahan.destroy", ":dataId") }}`.replace(':dataId', dataId);

                confirmDelete(dataId);
            })

            function confirmDelete(dataId) {
                Swal.fire({
                    title: "Apakah Anda yakin ingin menghapus data ini?",
                    text: 'Anda tidak akan bisa mengembalikannya!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#74788d',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonColor: '#5664d2',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        deleteAction(dataId);
                    }
                });
            }

            function deleteAction(dataId) {
                $.ajax({
                    type: "DELETE",
                    url: `{{ route("admin.lahan.destroy", ":dataId") }}`.replace(':dataId', dataId),
                    success: function(response) {
                        $('#myTable').DataTable().ajax.reload();
                        toastr["success"](response.message, "Success", optionsTostr)
                    },
                    error: function(error) {
                        console.error(error);
                        Swal.fire({
                            title: "Error!",
                            text: error.responseJSON.message,
                            icon: "error",
                            timer: 2000,
                            timerProgressBar: true,
                            confirmButtonText: "Ok"
                        })
                    }
                });
            }
        });
    </script>
@endpush
