@extends("layouts.guest")

@section("title", "Verifikasi email Anda | " . config("app.name"))
@section("meta_description", "")

@section("og_title", "Verifikasi email Anda | " . config("app.name"))
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

                                <h4 class="mt-3 font-size-18">Verifikasi email</h4>
                                <p class="mb-4 text-muted fw-normal">Verifikasi alamat email Anda.</p>

                                @if (session("status"))
                                    <div class="mb-4 alert alert-success" role="alert">
                                        {{ session("status") }}
                                    </div>
                                @endif

                                @if (session("status") == "verification-link-sent")
                                    <div class="mb-4 alert alert-success" role="alert">
                                        {{ __("Tautan verifikasi baru telah dikirim ke alamat email yang Anda berikan saat pendaftaran.") }}
                                    </div>
                                @endif

                                <div class="mb-4 alert alert-info" role="alert">Tautan verifikasi telah dikirim ke email Anda. Silakan periksa kotak masuk Anda dan klik tautan tersebut untuk
                                    memverifikasi alamat email Anda.</div>

                                <div class="flex-row d-flex justify-content-center">
                                    <form class="m-1 form-horizontal" method="post" action="{{ route("verification.send") }}">
                                        @csrf

                                        <div class="mt-4 text-center">
                                            <button class="btn btn-primary" type="submit">Kirim Ulang Email Verifikasi</button>
                                        </div>
                                    </form>
                                    <form class="m-1 form-horizontal" method="post" action="{{ route("logout") }}">
                                        @csrf

                                        <div class="mt-4 text-center">
                                            <button class="btn btn-secondary" type="submit">Keluar</button>
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
