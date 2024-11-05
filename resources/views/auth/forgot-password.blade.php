@extends("layouts.guest")

@section("title", "Lupa Kata Sandi | " . config("app.name"))
@section("meta_description", "")

@section("og_title", "Lupa Kata Sandi | " . config("app.name"))
@section("og_description", "")

@section("css")
    {{-- kode di sini --}}
@endsection

@section("content")
    <div class="page-wrapper full-page">
        <div class="page-content d-flex align-items-center justify-content-center">

            <div class="mx-0 row w-100 auth-page">
                <div class="mx-auto col-md-8 col-xl-4">
                    <div class="card">
                        <div class="col-md-12 ps-md-0">
                            <div class="px-4 py-5 auth-form-wrapper">

                                <h4 class="mt-3 font-size-18">Lupa Kata Sandi</h4>
                                <p class="mb-4 text-muted fw-normal">Atur ulang kata sandi Anda.</p>

                                @if (session("status"))
                                    <div class="mb-4 alert alert-success" role="alert">
                                        {{ session("status") }}
                                    </div>
                                @endif

                                <div class="mb-4 alert alert-success" role="alert">Masukkan alamat Email Anda dan instruksi akan dikirimkan kepada Anda!</div>

                                <form class="form-horizontal" method="post" action="{{ route("password.email") }}">
                                    @csrf

                                    <div class="mb-3">
                                        <label class="form-label" for="email">Alamat email</label>
                                        <input class="form-control" id="email" name="email" type="email" value="{{ old("email") }}" placeholder="Masukkan email" required>
                                        @error("email")
                                            <span class="text-danger" role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div>
                                        <button class="btn btn-primary    t" type="submit">Atur Ulang</button>
                                    </div>

                                    <div class="mt-4">
                                        <a class="text-muted" href="{{ route("password.request") }}"><i class="mr-1 mdi mdi-lock"></i> Lupa kata sandi Anda?</a>
                                    </div>

                                    <p class="d-block text-muted">Belum memiliki akun? <a class="font-weight-medium text-primary" href="{{ route("register") }}"> Daftar </a></p>
                                </form>
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
