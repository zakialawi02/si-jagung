@extends("layouts.app")

@section("title", "Profile • Dashboard | " . config("app.name"))
@section("meta_description", "")

@push("css")
    {{-- kode di sini --}}
@endpush

@section("content")
    <section class="mb-3" id="information">
        <div class="p-3 card">
            <h4>{{ __("Informasi Profil") }}</h4>
            <p>{{ __("Perbarui informasi profil akun Anda dan alamat email") }}.</p>

            <form id="send-verification" method="post" action="{{ route("verification.send") }}">
                @csrf
            </form>

            <div class="row">
                <div class="col-md-6">
                    <form class="p-2 mt-2" method="post" action="{{ route("profile.update") }}">
                        @csrf
                        @method("patch")

                        <div class="form-group mb-3">
                            <label for="name">Nama</label>
                            <input class="form-control" id="name" name="name" type="text" value="{{ old("name", $user->name) }}" placeholder="Masukkan nama Anda" required />
                            @error("name")
                                <span class="text-danger" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="email">E-mail</label>
                            <input class="form-control" id="email" name="email" type="email" value="{{ old("email", $user->email) }}" placeholder="Masukkan e-mail yang valid" required />
                            @error("email")
                                <span class="text-danger" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>

                        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                            <div>
                                <p class="mt-2 text-sm">
                                    {{ __("Alamat email Anda belum terverifikasi.") }}

                                    <button class="btn btn-sm btn-info" form="send-verification">{{ __("Klik di sini untuk mengirim ulang email verifikasi.") }}</button>
                                </p>

                                @if (session("status") === "verification-link-sent")
                                    <p class="mt-2 text-sm text-success">
                                        {{ __("Tautan verifikasi baru telah dikirim ke alamat email Anda.") }}
                                    </p>
                                @endif
                            </div>
                        @endif

                        <div class="flex-row d-flex align-items-baseline ">
                            <button class="btn btn-primary waves-effect" type="submit">Simpan</button>
                            @if (session("status") === "profile-updated")
                                <p class="p-2 text-sm text-muted">{{ __("Disimpan.") }}</p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="mb-3" id="password">
        <div class="p-3 card">
            <h4> {{ __("Perbarui Kata Sandi") }}</h4>
            <p>{{ __("Pastikan akun Anda menggunakan kata sandi yang panjang dan acak untuk tetap aman.") }}.</p>

            <div class="row">
                <div class="col-md-6">
                    <form class="p-2 mt-2" method="post" action="{{ route("password.update") }}">
                        @csrf
                        @method("put")

                        <div class="form-group mb-3">
                            <label for="update_password_current_password">Kata Sandi Saat Ini</label>
                            <input class="form-control" id="update_password_current_password" name="current_password" type="password" placeholder="Kata sandi saat ini" required />
                            @if ($errors->updatePassword->has("current_password"))
                                <p class="p-2 text-sm text-danger">{{ __("Kata Sandi Salah!") }}</p>
                            @endif
                        </div>

                        <div class="form-group mb-3">
                            <label for="update_password_password">Kata Sandi Baru</label>
                            <input class="form-control" id="update_password_password" name="password" type="password" placeholder="Kata sandi baru" required />
                            @if ($errors->updatePassword->has("password"))
                                <p class="p-2 text-sm text-danger">{{ __("Kolom kata sandi harus memiliki setidaknya 8 karakter.") }}</p>
                            @endif
                        </div>

                        <div class="form-group mb-3">
                            <label for="update_password_password_confirmation">Konfirmasi Kata Sandi Baru</label>
                            <input class="form-control" id="update_password_password_confirmation" name="password_confirmation" type="password" placeholder="Konfirmasi kata sandi baru" required />
                            @if ($errors->updatePassword->has("password_confirmation"))
                                <p class="p-2 text-sm text-danger">{{ __("Kata sandi tidak cocok.") }}</p>
                            @endif
                        </div>

                        <div class="flex-row d-flex align-items-baseline ">
                            <button class="btn btn-primary waves-effect" type="submit">Simpan</button>
                            @if (session("status") === "password-updated")
                                <p class="p-2 text-sm text-muted">{{ __("Disimpan.") }}</p>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <section class="mb-3" id="delete-account">
        <div class="p-3 card">
            <h4> {{ __("Hapus Akun") }}</h4>
            <p>{{ __("Setelah akun Anda dihapus, semua sumber daya dan data akan dihapus secara permanen. Sebelum menghapus akun Anda, harap unduh data atau informasi yang ingin Anda simpan.") }}.</p>

            <div class="row">
                <div class="col-md-6">

                    <!-- Modal -->
                    <div class="modal fade" id="confirm-user-deletion" aria-labelledby="confirm-user-deletionLabel" aria-hidden="true" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{ __("Konfirmasi penghapusan akun") }}</h5>
                                    <button class="close" data-bs-dismiss="modal" type="button" aria-label="Tutup">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form class="p-2" method="post" action="{{ route("profile.destroy") }}">
                                    @csrf
                                    @method("delete")

                                    <div class="modal-body">
                                        <p><strong>{{ __("Apakah Anda yakin ingin menghapus akun Anda?") }}</strong></p>
                                        <p>{{ __("Setelah akun Anda dihapus, semua sumber daya dan data akan dihapus secara permanen. Harap masukkan kata sandi Anda untuk mengonfirmasi bahwa Anda ingin menghapus akun Anda secara permanen.") }}
                                        </p>

                                        <div class="form-group mb-3 pt-4">
                                            <label for="password">Kata sandi Anda</label>
                                            <input class="form-control" id="password" name="password" type="password" placeholder="Kata sandi Anda" required />
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">{{ __("Batal") }}</button>
                                        <button class="btn btn-primary" type="submit">{{ __("Hapus Akun") }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Button trigger modal -->
                    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirm-user-deletion" type="button">{{ __("Hapus Akun") }}</button>

                    @if ($errors->userDeletion->has("password"))
                        <p class="p-2 text-sm text-danger">{{ __("Gagal menghapus akun. Kata Sandi Salah!") }}</p>
                    @endif

                </div>
            </div>
        </div>
    </section>

@endsection

@push("javascript")
    <script>
        // kode di sini
    </script>
@endpush
