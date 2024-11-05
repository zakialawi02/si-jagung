@extends("layouts.guest")

@section("title", "Kunci | " . config("app.name"))
@section("meta_description", "")

@section("og_title", "Kunci | " . config("app.name"))
@section("og_description", "")

@section("css")
    {{-- kode di sini --}}
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

                                    <h4 class="mt-3 font-size-18">Layar Kunci</h4>
                                    <p class="mb-4 text-muted fw-normal">Masukkan kata sandi Anda untuk membuka kunci layar!</p>

                                    @if (session("status"))
                                        <div class="mb-4 alert alert-success" role="alert">
                                            {{ session("status") }}
                                        </div>
                                    @endif

                                    <form class="form-horizontal" method="post" action="{{ route("password.confirm") }}">
                                        @csrf

                                        <div class="mb-3">
                                            <label class="form-label" for="password">Kata Sandi</label>
                                            <input class="form-control" id="password" name="password" type="password" placeholder="Masukkan kata sandi" required>
                                            @error("password")
                                                <span class="text-danger" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>

                                        <div>
                                            <button class="btn btn-primary    " type="submit">Konfirmasi</button>
                                        </div>
                                    </form>

                                    <div class="mt-4">
                                        <form method="POST" action="{{ route("logout") }}">
                                            @csrf
                                            <p class="d-block text-muted">Bukan Anda?
                                                <button class="font-weight-medium text-primary" type="submit" style="background:none;border:none;padding:0;">Keluar</button>
                                            </p>
                                        </form>
                                    </div>
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
        // kode di sini
    </script>
@endsection
