@extends("layouts.guest")

@section("title", "Atur Ulang Kata Sandi | " . config("app.name"))
@section("meta_description", "")

@section("og_title", "Atur Ulang Kata Sandi | " . config("app.name"))
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

                                    <h4 class="mt-3 font-size-18">Atur Ulang Kata Sandi</h4>
                                    <p class="mb-4 text-muted fw-normal">Atur ulang kata sandi Anda.</p>

                                    @if (session("status"))
                                        <div class="mb-4 alert alert-success" role="alert">
                                            {{ session("status") }}
                                        </div>
                                    @endif

                                    <div class="mb-4 alert alert-success" role="alert">Masukkan akun email Anda dan kata sandi baru Anda</div>

                                    <form class="form-horizontal" method="post" action="{{ route("password.store") }}">
                                        @csrf

                                        <!-- Token Atur Ulang Kata Sandi -->
                                        <input name="token" type="hidden" value="{{ request()->route("token") }}">

                                        <div class="mb-3">
                                            <label class="form-label" for="email">Alamat email</label>
                                            <input class="form-control" id="email" name="email" type="email" value="{{ old("email") }}" placeholder="Masukkan email" required>
                                            @error("email")
                                                <span class="text-danger" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="password">Kata Sandi</label>
                                            <input class="form-control" id="password" name="password" type="password" placeholder="Masukkan kata sandi" required>
                                            @error("password")
                                                <span class="text-danger" role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="password_confirmation">Konfirmasi Kata Sandi</label>
                                            <input class="form-control" id="password_confirmation" name="password_confirmation" type="password" placeholder="Konfirmasi Kata Sandi" required>
                                        </div>

                                        <div>
                                            <button class="btn btn-primary" type="submit">Atur Ulang Kata Sandi</button>
                                        </div>
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
        // kode di sini
    </script>
@endsection
