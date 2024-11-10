@extends("layouts.appFront")

@section("title", "Budidaya Jagung | " . config("app.name"))
@section("meta_description", "")
@section("meta_keywords", "")

@section("og_title", config("app.name"))
@section("og_description", "")

@section("content")
    <!-- Navbar -->
    @include("components.front._navbar")

    <main class="mt-3 pt-5">
        <section class="" id="">
            <div class="position-relative">
                <div class="image-profile-wrapper align-baseline" style="height: 20vh">
                    <img class="" src="./assets/img/jagung3.jpeg" alt="" />
                    <div class="position-absolute start-50 translate-middle-x w-75 top-0">
                        <div class="py-4">
                            <h2 class="fw-bolder mb-3 text-center">Teknik Budidaya Jagung</h2>
                            <!-- <p class="text-primary mb-3 text-center">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Id quibusdam maxime quo amet temporibus molestiae.</p> -->
                            <hr class="w-50 mb-xl-9 border-secondary-subtle mx-auto mb-2" />
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-md-5 py-xl-8 py-3">
            <div class="container">
                <div class="row gy-4 gy-lg-0 align-items-lg-center">
                    <div class="col-12 col-lg-5">
                        <img class="img-fluid rounded" src="./assets/img/corn farm.jpg" alt="Jagung" loading="lazy" />
                    </div>
                    <div class="col-12 col-lg-7">
                        <div class="row justify-content-xl-end">
                            <div class="col-12 col-xl-11">
                                <!-- <h2 class="h1 mb-3">Our Design Process</h2> -->
                                <p class="lead fs-5 mb-5">Beberapa teknik budidaya jagung yang umum digunakan:</p>
                                <div class="d-flex mb-4">
                                    <div>
                                        <span class="btn btn-primary bsb-btn-circle pe-none me-4">1</span>
                                    </div>
                                    <div>
                                        <h4 class="text-primary mb-3">Budidaya konvensional</h4>
                                        <p class="mb-0">Melibatkan pengolahan tanah, pemupukan kimia, dan pengendalian hama dengan pestisida. Metode ini membantu meningkatkan hasil panen, tetapi dapat
                                            berdampak pada lingkungan, seperti erosi tanah dan pencemaran air.</p>
                                    </div>
                                </div>
                                <div class="d-flex mb-4">
                                    <div>
                                        <span class="btn btn-primary bsb-btn-circle pe-none me-4">2</span>
                                    </div>
                                    <div>
                                        <h4 class="text-primary mb-3">Budidaya konservasi</h4>
                                        <p class="mb-0">Meminimalkan gangguan tanah untuk mencegah erosi dan mempertahankan kelembaban. Teknik ini menjaga struktur tanah dan mengurangi kebutuhan air
                                            dengan menggunakan mulsa sebagai penutup lahan.</p>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div>
                                        <span class="btn btn-primary bsb-btn-circle pe-none me-4">3</span>
                                    </div>
                                    <div>
                                        <h4 class="text-primary mb-3">Pertanian presisi</h4>
                                        <p class="mb-0">Menggunakan teknologi seperti GPS dan sensor untuk optimalisasi input pertanian. Input seperti pupuk dan air diberikan sesuai kebutuhan tanaman,
                                            sehingga lebih efisien dan ramah lingkungan.</p>
                                    </div>
                                </div>
                                <div class="d-flex mb-4">
                                    <div>
                                        <span class="btn btn-primary bsb-btn-circle pe-none me-4">4</span>
                                    </div>
                                    <div>
                                        <h4 class="text-primary mb-3">Budidaya organik</h4>
                                        <p class="mb-0">Mengandalkan pupuk alami seperti kompos dan pestisida alami untuk mengendalikan hama. Teknik ini menghasilkan jagung bebas residu kimia dan
                                            mendukung keberlanjutan lingkungan.</p>
                                    </div>
                                </div>
                                <div class="d-flex mb-4">
                                    <div>
                                        <span class="btn btn-primary bsb-btn-circle pe-none me-4">4</span>
                                    </div>
                                    <div>
                                        <h4 class="text-primary mb-3">Sistem tumpang sari</h4>
                                        <p class="mb-0">Menanam jagung bersama tanaman lain, seperti kacang-kacangan, untuk meningkatkan kesuburan tanah secara alami. Teknik ini menghemat ruang,
                                            mengurangi hama, dan meningkatkan hasil panen.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        @include("components.front._footer")
    </main>
@endsection
