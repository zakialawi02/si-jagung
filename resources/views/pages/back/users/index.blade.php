@extends("layouts.app")

@section("title", ($data["title"] ?? "") . " • Dashboard | " . config("app.name"))
@section("meta_description", "")

@include("components.dependencies._datatables")

@push("css")
    {{-- code here --}}
@endpush

@section("content")
    <div class="card p-3">

        <div class="d-flex justify-content-end align-items-center mb-3 px-2">
            <button class="btn btn-primary" id="createNewUser" data-bs-toggle="modal" data-bs-target="#userModal" type="button"> Tambah Pengguna </button>
        </div>

        <div class="table-responsive">
            <table class="table-hover table-striped table" id="myTable" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Peran</th>
                        <th scope="col">Terdaftar</th>
                        <th scope="col">Terverifikasi</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="userModal" aria-labelledby="userModalLabel" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Judul Modal</h5>
                    <button class="btn-close" data-bs-dismiss="modal" type="button" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div id="error-messages"></div>

                    <form class="form-horizontal" id="userForm" method="post" action="">
                        @csrf
                        <input id="_method" name="_method" type="hidden">

                        <div class="form-group mb-3">
                            <label for="name">Nama</label>
                            <input class="form-control" id="name" name="name" type="text" value="{{ old("name") }}" placeholder="Masukkan Nama Anda" required autofocus="on">
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group mb-3">
                                <label for="username">Username</label>
                                <input class="form-control" id="username" name="username" type="text" value="{{ old("username") }}" placeholder="Masukkan username Anda" required>
                            </div>

                            <div class="col-md-6 form-group mb-3">
                                <label for="role">Peran</label>
                                <select class="form-control" id="role" name="role">
                                    <option value="admin">Admin</option>
                                    <option value="writer">Penulis</option>
                                    <option value="user" selected>Pengguna</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input class="form-control" id="email" name="email" type="email" value="{{ old("email") }}" placeholder="Masukkan email" required>
                        </div>

                        <div class="form-group mb-3">
                            <label for="password">Kata Sandi</label>
                            <input class="form-control" id="password" name="password" type="password" placeholder="Masukkan kata sandi">
                            <span class="text-muted" id="passwordHelpBlock"></span>
                        </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Tutup</button>
                    <button class="btn btn-primary" id="saveBtn" type="button">Simpan perubahan</button>
                </div>
            </div>
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
                order: [
                    [2, 'asc']
                ],
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'photo',
                        name: 'photo',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'username',
                        name: 'username'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'role',
                        name: 'role'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'email_verified_at',
                        name: 'email_verified_at'
                    },
                    {
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

            const cardErrorMessages = `<div id="body-messages" class="alert alert-danger" role="alert"></div>`;

            // Buka modal untuk menambah pengguna baru
            $('#createNewUser').click(function() {
                $('#userModal').find('.modal-title').text('Tambah Pengguna');
                $('#userForm').attr('method', 'POST');
                $('#_method').val('POST');
                $('#userForm').trigger("reset");
                $('#userForm').attr('action', '{{ route("admin.users.store") }}');
                $('#saveBtn').text('Buat');
                $("#error-messages").html("");
                $("#passwordHelpBlock").html("");
            });

            // Simpan pengguna baru atau yang diperbarui
            $('#saveBtn').on('click', function(e) {
                e.preventDefault();
                const formData = $('#userForm').serialize();
                const formAction = $('#userForm').attr('action');
                const method = $('#userForm').attr('method');

                $.ajax({
                    type: method,
                    url: formAction,
                    data: formData,
                    beforeSend: function() {
                        $("#body-messages").html("");
                    },
                    success: function(response) {
                        console.log(response);

                        $('#userModal').modal('hide');
                        $('#myTable').DataTable().ajax.reload();
                        Swal.fire({
                            title: "Sukses!",
                            text: response.message,
                            icon: "success",
                            timer: 2000,
                            timerProgressBar: true,
                            confirmButtonText: "Ok"
                        });
                    },
                    error: function(error) {
                        $("#error-messages").html(cardErrorMessages);
                        const messages = error.responseJSON.errors;
                        console.log(messages);
                        $.each(messages, function(indexInArray, message) {
                            console.log(message[0]);
                            $("#body-messages").append('<span>' + message[0] + '</span> <br>');
                        });
                    }
                });
            });

            // Edit pengguna
            $('body').on('click', '.editUser', function() {
                $("#error-messages").html("");
                $("#passwordHelpBlock").html("kosongkan jika tidak ingin mengubah");
                const userId = $(this).data('id');
                $.get(`{{ route("admin.users.show", ":userId") }}`.replace(':userId', userId), function(data) {
                    $('#userModal').modal('show');
                    $('#userModal').find('.modal-title').text('Edit Pengguna');
                    $('#userForm').attr('action', `{{ route("admin.users.update", ":userId") }}`.replace(':userId', userId));
                    $('#saveBtn').text('Perbarui');
                    $('#_method').val('PUT');
                    $('#name').val(data.name);
                    $('#username').val(data.username);
                    $('#role').val(data.role);
                    $('#email').val(data.email);
                });
            });

            // Hapus pengguna
            $('body').on('click', '.deleteUser', function(e) {
                e.preventDefault();
                const userId = $(this).data('id');
                const url = `{{ route("admin.users.destroy", ":userId") }}`.replace(':userId', userId);

                confirmDelete(userId);
            })

            function confirmDelete(userId) {
                Swal.fire({
                    title: "Apakah Anda yakin ingin menghapus catatan ini?",
                    text: 'Anda tidak akan bisa mengembalikannya!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#74788d',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonColor: '#5664d2',
                    cancelButtonText: 'Batal',
                }).then((result) => {
                    if (result.isConfirmed) {
                        deleteUser(userId);
                    }
                });
            }

            function deleteUser(userId) {
                $.ajax({
                    type: "DELETE",
                    url: `{{ route("admin.users.destroy", ":userId") }}`.replace(':userId', userId),
                    success: function(response) {
                        $('#myTable').DataTable().ajax.reload();
                        Swal.fire({
                            title: "Sukses!",
                            text: response.message,
                            icon: "success",
                            timer: 2000,
                            timerProgressBar: true,
                            confirmButtonText: "Ok"
                        });
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }
        });
    </script>
@endpush
