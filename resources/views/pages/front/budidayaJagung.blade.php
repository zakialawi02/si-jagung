@extends("layouts.appFront")

@section("title", "Budidaya Jagung | " . config("app.name"))
@section("meta_description", "")
@section("meta_keywords", "")

@section("og_title", config("app.name"))
@section("og_description", "")

@section("content")
    <!-- Navbar -->
    @include("components.front._navbar")

    <main class="pt-5 mt-3">
        <section class="" id="">
            <div class="position-relative">
                <div class="align-baseline image-profile-wrapper" style="height: 20vh">
                    <img class="" src="./assets/img/jagung3.jpeg" alt="" />
                    <div class="top-0 position-absolute start-50 translate-middle-x w-75">
                        <div class="py-4">
                            <h2 class="mb-3 text-center fw-bolder">Teknik Budidaya Jagung</h2>
                            <!-- <p class="mb-3 text-center text-primary">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Id quibusdam maxime quo amet temporibus molestiae.</p> -->
                            <hr class="mx-auto mb-2 w-50 mb-xl-9 border-secondary-subtle" />
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-3 py-md-5 py-xl-8">
            <div class="container">
                <div class="row gy-4 gy-lg-0 align-items-lg-center">
                    <div class="col-12 col-lg-5">
                        <img class="rounded img-fluid" src="./assets/img/corn farm.jpg" alt="Jagung" loading="lazy" />
                    </div>
                    <div class="col-12 col-lg-7">
                        <div class="row justify-content-xl-end">
                            <div class="col-12 col-xl-11">
                                <!-- <h2 class="mb-3 h1">Our Design Process</h2> -->
                                <p class="mb-5 lead fs-5">Beberapa teknik budidaya jagung yang umum digunakan:</p>
                                <div class="mb-4 d-flex">
                                    <div>
                                        <span class="btn btn-primary bsb-btn-circle pe-none me-4">1</span>
                                    </div>
                                    <div>
                                        <h4 class="mb-3 text-primary">Budidaya konvensional</h4>
                                        <p class="mb-0">Melibatkan pengolahan tanah, pemupukan kimia, dan pengendalian hama dengan pestisida.</p>
                                    </div>
                                </div>
                                <div class="mb-4 d-flex">
                                    <div>
                                        <span class="btn btn-primary bsb-btn-circle pe-none me-4">2</span>
                                    </div>
                                    <div>
                                        <h4 class="mb-3 text-primary">Budidaya konservasi</h4>
                                        <p class="mb-0">Meminimalkan gangguan tanah untuk mencegah erosi dan mempertahankan kelembaban.</p>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div>
                                        <span class="btn btn-primary bsb-btn-circle pe-none me-4">3</span>
                                    </div>
                                    <div>
                                        <h4 class="mb-3 text-primary">Pertanian presisi</h4>
                                        <p class="mb-0">Menggunakan teknologi seperti GPS dan sensor untuk optimalisasi input pertanian.</p>
                                    </div>
                                </div>
                                <div class="mb-4 d-flex">
                                    <div>
                                        <span class="btn btn-primary bsb-btn-circle pe-none me-4">4</span>
                                    </div>
                                    <div>
                                        <h4 class="mb-3 text-primary">Budidaya organik</h4>
                                        <p class="mb-0">Mengandalkan pupuk organik dan pengendalian hama alami.</p>
                                    </div>
                                </div>
                                <div class="mb-4 d-flex">
                                    <div>
                                        <span class="btn btn-primary bsb-btn-circle pe-none me-4">4</span>
                                    </div>
                                    <div>
                                        <h4 class="mb-3 text-primary">Sistem tumpang sari</h4>
                                        <p class="mb-0">Menanam jagung bersama tanaman lain, seperti kacang-kacangan, untuk meningkatkan efisiensi penggunaan lahan.</p>
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
