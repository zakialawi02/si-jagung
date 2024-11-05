@extends("layouts.guest")

@section("title", "Register | " . config("app.name"))
@section("meta_description", "")

@section("og_title", "Register | " . config("app.name"))
@section("og_description", "")


@section("css")
    {{-- code here --}}
@endsection

@section("content")
    <div class="page-wrapper full-page">
        <div class="page-content d-flex align-items-center justify-content-center">

            <div class="mx-0 row w-100 auth-page">
                <div class="mx-auto col-md-8 col-xl-6">
                    <div class="card">
                        <div class="row">
                            <div class="col-md-4 pe-md-0">
                                <div class="auth-side-wrapper">

                                </div>
                            </div>

                            <div class="col-md-8 ps-md-0">
                                <div class="px-4 py-5 auth-form-wrapper">
                                    <h5 class="mb-4 text-muted fw-normal">Buat akun</h5>
                                    <form class="form-horizontal" method="post" action="{{ route("register") }}" autocomplete="off">
                                        @csrf

                                        <div class="mb-3">
                                            <label class="form-label" for="name">Nama</label>
                                            <input class="form-control" id="name" name="name" type="text" value="{{ old("name") }}" placeholder="Masukkan nama" required autofocus="on">
                                            @error("name")
                                                <span class="text-danger" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="username">Username</label>
                                            <input class="form-control" id="username" name="username" type="text" value="{{ old("username") }}"placeholder="Masukkan username" required>
                                            @error("username")
                                                <span class="text-danger" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="email">Email address</label>
                                            <input class="form-control" id="email" name="email" type="email" value="{{ old("email") }}"placeholder="Masukkan email" required>
                                            @error("email")
                                                <span class="text-danger" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="password">Kata sandi</label>
                                            <input class="form-control" id="password" name="password" type="password" placeholder="Masukkan kata sandi" required>
                                            @error("password")
                                                <span class="text-danger" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="userPassword">Konfirmasi Kata sandi</label>
                                            <input class="form-control" id="password_confirmation" name="password_confirmation" type="password" placeholder="Masukkan ulang kata sandi" required>
                                        </div>

                                        <div>
                                            <button class="btn btn-primary    " type="submit">Daftar</button>
                                        </div>
                                        <a class="mt-3 d-block text-muted" href="{{ route("login") }}">Sudah punya akun? Masuk</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section("javascript")

    <script>
        // code here
    </script>
@endsection
