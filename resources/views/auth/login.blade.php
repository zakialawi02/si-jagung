@extends("layouts.guest")

@section("title", "Login | " . config("app.name"))
@section("meta_description", "")

@section("og_title", "Login | " . config("app.name"))
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
                                    @if (session("status"))
                                        <div class="mb-4 alert alert-success" role="alert">
                                            {{ session("status") }}
                                        </div>
                                    @endif

                                    <h5 class="mb-4 text-muted fw-normal">Selamat datang kembali! Masuk ke akun Anda.</h5>

                                    <form class="form-horizontal" method="post" action="{{ route("login") }}">
                                        @csrf

                                        <div class="mb-3">
                                            <label class="form-label" for="id_user">Email/Username</label>
                                            <input class="form-control" id="id_user" name="id_user" type="text" value="{{ old("id_user") }}" placeholder="Enter email" autofocus>
                                            @error("id_user")
                                                <span class="text-danger" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="password">Kata sandi</label>
                                            <input class="form-control" id="password" name="password" type="password" value="{{ old("password") }}" placeholder="Enter password">
                                            @error("password")
                                                <span class="text-danger" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="mb-3 form-check">
                                            <input class="form-check-input"id="remember_me" name="remember" type="checkbox">
                                            <label class="form-check-label" for="remember_me">
                                                Ingat saya
                                            </label>
                                        </div>

                                        <div>
                                            <button class="btn btn-primary    " type="submit">Masuk</button>
                                        </div>

                                        <div class="mt-4">
                                            <a class="text-muted" href="{{ route("password.request") }}"><i class="mr-1 mdi mdi-lock"></i> Lupa kata sandi?</a>
                                        </div>

                                        <p class="d-block text-muted"> Belum punya akun ? <a class="font-weight-medium text-primary" href="{{ route("register") }}"> Daftar sekarang </a></p>
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
