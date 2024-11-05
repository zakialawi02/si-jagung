@extends("layouts.appFront")

@section("title", "Manfaat Jagung Bagi Kesehatan | " . config("app.name"))
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
                            <h2 class="mb-3 text-center fw-bolder">Apakah Manfaat Jagung Bagi Kesehatan</h2>
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
                        <img class="rounded img-fluid" src="./assets/img/corn3.jpg" alt="Jagung" loading="lazy" />
                    </div>
                    <div class="col-12 col-lg-7">
                        <div class="row justify-content-xl-end">
                            <div class="col-12 col-xl-11">
                                <!-- <h2 class="mb-3 h1">Our Design Process</h2> -->
                                <p class="mb-5 lead fs-5">Jagung adalah salah satu sumber pangan yang kaya akan nutrisi dan menawarkan berbagai manfaat bagi kesehatan. Berikut adalah beberapa manfaat
                                    jagung bagi kesehatan:</p>
                                <div class="mb-4 d-flex">
                                    <div>
                                        <span class="btn btn-primary bsb-btn-circle pe-none me-4">1</span>
                                    </div>
                                    <div>
                                        <h4 class="mb-3 text-primary">Sumber Energi</h4>
                                        <p class="mb-0">Jagung mengandung karbohidrat kompleks yang menyediakan energi berkelanjutan, membuatnya ideal untuk menjaga stamina sepanjang hari.</p>
                                    </div>
                                </div>
                                <div class="mb-4 d-flex">
                                    <div>
                                        <span class="btn btn-primary bsb-btn-circle pe-none me-4">2</span>
                                    </div>
                                    <div>
                                        <h4 class="mb-3 text-primary">Kaya Serat</h4>
                                        <p class="mb-0">Jagung adalah sumber serat yang baik, membantu memperlancar pencernaan dan mencegah sembelit. Serat juga dapat membantu mengendalikan kadar gula
                                            darah dan menurunkan risiko penyakit jantung.</p>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div>
                                        <span class="btn btn-primary bsb-btn-circle pe-none me-4">3</span>
                                    </div>
                                    <div>
                                        <h4 class="mb-3 text-primary">Mengandung Vitamin dan Mineral</h4>
                                        <p class="mb-0">Jagung mengandung vitamin B, terutama B1 (tiamin) dan B3 (niasin), yang penting untuk metabolisme energi dan fungsi saraf. Jagung juga kaya akan
                                            asam folat, vitamin C, dan mineral seperti magnesium dan potasium.</p>
                                    </div>
                                </div>
                                <div class="mb-4 d-flex">
                                    <div>
                                        <span class="btn btn-primary bsb-btn-circle pe-none me-4">4</span>
                                    </div>
                                    <div>
                                        <h4 class="mb-3 text-primary">Antioksidan</h4>
                                        <p class="mb-0">Jagung mengandung antioksidan seperti lutein dan zeaxanthin, yang bermanfaat untuk kesehatan mata dan dapat membantu mencegah degenerasi makula
                                            terkait usia.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row gy-4 gy-lg-0 align-items-lg-center">
                    <div class="col-12 col-lg-7">
                        <div class="row justify-content-xl-start">
                            <div class="col-12 col-xl-11">
                                <div class="mb-4 d-flex">
                                    <div>
                                        <span class="btn btn-primary bsb-btn-circle pe-none me-4">5</span>
                                    </div>
                                    <div>
                                        <h4 class="mb-3 text-primary">Menjaga Kesehatan Jantung</h4>
                                        <p class="mb-0">Kandungan serat dan senyawa fitokimia dalam jagung dapat membantu mengurangi kadar kolesterol jahat (LDL) dan meningkatkan kesehatan jantung.</p>
                                    </div>
                                </div>
                                <div class="mb-4 d-flex">
                                    <div>
                                        <span class="btn btn-primary bsb-btn-circle pe-none me-4">6</span>
                                    </div>
                                    <div>
                                        <h4 class="mb-3 text-primary">Mendukung Kesehatan Kulit</h4>
                                        <p class="mb-0">Vitamin C dan antioksidan dalam jagung membantu memproduksi kolagen dan melindungi kulit dari kerusakan akibat radikal bebas, menjaga kulit tetap
                                            sehat dan bercahaya.</p>
                                    </div>
                                </div>
                                <div class="mb-4 d-flex">
                                    <div>
                                        <span class="btn btn-primary bsb-btn-circle pe-none me-4">7</span>
                                    </div>
                                    <div>
                                        <h4 class="mb-3 text-primary">Menjaga Berat Badan</h4>
                                        <p class="mb-0">Karena kandungan seratnya yang tinggi, jagung dapat memberikan rasa kenyang lebih lama, membantu mengendalikan nafsu makan dan menjaga berat badan
                                            ideal.</p>
                                    </div>
                                </div>
                                <div class="mb-4 d-flex">
                                    <div>
                                        <span class="btn btn-primary bsb-btn-circle pe-none me-4">8</span>
                                    </div>
                                    <div>
                                        <h4 class="mb-3 text-primary">Mengurangi Risiko Anemia</h4>
                                        <p class="mb-0">Jagung mengandung asam folat dan vitamin B6 yang penting untuk produksi sel darah merah, sehingga dapat membantu mencegah anemia.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-5">
                        <img class="rounded img-fluid" src="./assets/img/corn.jpg" alt="Jagung" loading="lazy" />
                    </div>
                    <div class="mb-4 d-flex">
                        <div>
                            <p class="mb-0">Dengan mengonsumsi jagung secara teratur, Anda dapat menikmati berbagai manfaat kesehatan yang ditawarkannya.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        @include("components.front._footer")
    </main>
@endsection
