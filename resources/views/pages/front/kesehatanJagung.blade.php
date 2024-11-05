@extends("layouts.appFront")

@section("title", "Kesehatan Jagung | " . config("app.name"))
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
                            <h2 class="mb-3 text-center fw-bolder">Kesehatan Jagung</h2>
                            {{-- <p class="mb-3 text-center text-primary">Jagung: Tanaman Multifungsi dengan Potensi Besar</p> --}}
                            <hr class="mx-auto mb-2 w-50 mb-xl-9 border-secondary-subtle" />
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="audience-section py-2 mt-5" id="audience-section">
            <div class="container">
                <h2 class="section-heading text-center mb-4">Jagung: Tanaman Multifungsi dengan Potensi Besar</h2>
                <div class="section-intro single-col-max mx-auto text-center mb-5">
                    Jagung (Zea mays L.) adalah salah satu tanaman pangan utama di dunia, menempati posisi ketiga setelah gandum dan padi dalam hal produksi global. Tanaman ini memiliki sejarah panjang
                    dalam peradaban manusia dan terus memainkan peran penting dalam ketahanan pangan, industri, dan ekonomi.
                </div>
            </div>
        </section>

        <!-- Varietas -->
        <section class="py-3 py-md-5">
            <div class="container">
                <div class="row gy-3 gy-md-4 gy-lg-0 align-items-lg-center">
                    <div class="col-12 col-lg-6 col-xl-5">
                        <img class="img-fluid rounded" src="./assets/img/corn4.jpg" alt="About 1" loading="lazy">
                    </div>
                    <div class="col-12 col-lg-6 col-xl-7">
                        <div class="row justify-content-xl-center">
                            <div class="col-12 col-xl-11">
                                <h2 class="mb-3">Spesies dan Varietas Jagung</h2>
                                <p class="lead fs-5 text-primary mb-3">Jagung termasuk dalam genus Zea dari famili Poaceae (rumput-rumputan). Meskipun hanya ada satu spesies jagung yang dibudidayakan
                                    (Zea mays), terdapat banyak subspesies dan varietas yang telah dikembangkan:
                                </p>
                            </div>

                            <div class="col-12 col-xl-11">
                                <div class="d-flex align-items-center mb-3">
                                    <div class="me-3 text-primary">
                                        <svg class="bi bi-check-circle-fill" xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" viewBox="0 0 16 16">
                                            <path
                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="fs-5 m-0">Zea mays var. indentata (jagung gigi kuda)</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-3">
                                    <div class="me-3 text-primary">
                                        <svg class="bi bi-check-circle-fill" xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" viewBox="0 0 16 16">
                                            <path
                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="fs-5 m-0">Zea mays var. indurata (jagung mutiara)</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-3">
                                    <div class="me-3 text-primary">
                                        <svg class="bi bi-check-circle-fill" xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" viewBox="0 0 16 16">
                                            <path
                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="fs-5 m-0">Zea mays var. saccharata (jagung manis)</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-3">
                                    <div class="me-3 text-primary">
                                        <svg class="bi bi-check-circle-fill" xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" viewBox="0 0 16 16">
                                            <path
                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="fs-5 m-0">Zea mays var. everta (jagung berondong)</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-3">
                                    <div class="me-3 text-primary">
                                        <svg class="bi bi-check-circle-fill" xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" viewBox="0 0 16 16">
                                            <path
                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="fs-5 m-0">Zea mays var. amylacea (jagung tepung)</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-3">
                                    <div class="me-3 text-primary">
                                        <svg class="bi bi-check-circle-fill" xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" viewBox="0 0 16 16">
                                            <path
                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="fs-5 m-0">Zea mays var. ceratina (jagung lilin)</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 col-xl-11">
                                <p class="lead fs-5 mb-3">Setiap varietas memiliki karakteristik dan kegunaan yang berbeda, mulai dari konsumsi langsung hingga pengolahan industri.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- siklus -->
        <section class="py-3 py-md-5 py-xl-8">
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col-12 col-md-10 col-lg-8 col-xl-7 fs-4">
                        <h2 class="mb-4 display-5 text-center">Siklus Hidup dan Fisiologi Jagung</h2>
                        <p class="text-secondary mb-5 text-center lead fs-5">Siklus hidup jagung dapat dibagi menjadi beberapa fase utama</p>
                        <hr class="w-50 mx-auto mb-5 mb-xl-9 border-dark-subtle">
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row gy-4 gy-lg-0 align-items-lg-center">
                    <div class="col-12 col-lg-6">
                        <img class="img-fluid rounded border border-dark" src="./assets/img/corn farm.jpg" alt="About Us" loading="lazy">
                    </div>
                    <div class="col-12 col-lg-6 col-xxl-6">
                        <div class="row justify-content-lg-end">
                            <div class="col-12 col-lg-11">
                                <div class="about-wrapper">
                                    <p class="lead mb-2">Tanaman jagung umumnya membutuhkan 90-120 hari dari penanaman hingga panen, tergantung pada varietas dan kondisi lingkungan.</p>

                                    <p class="lead mb-2">Jagung adalah tanaman C4, yang berarti memiliki efisiensi fotosintesis yang tinggi, terutama dalam kondisi suhu tinggi dan intensitas
                                        cahaya kuat. Karakteristik ini memungkinkan jagung untuk tumbuh dengan baik di daerah tropis dan subtropis.</p>

                                    <div class="row gy-1 my-4 mb-md-5">
                                        <div class="d-flex">
                                            <div>
                                                <span class="btn btn-sm btn-primary bsb-btn-circle pe-none me-3">1</span>
                                            </div>
                                            <div>
                                                <h4 class="mb-3 text-primary">Fase perkecambahan (VE)</h4>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <div>
                                                <span class="btn btn-sm btn-primary bsb-btn-circle pe-none me-3">2</span>
                                            </div>
                                            <div>
                                                <h4 class="mb-3 text-primary">Fase pertumbuhan vegetatif (V1-Vn)</h4>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <div>
                                                <span class="btn btn-sm btn-primary bsb-btn-circle pe-none me-3">3</span>
                                            </div>
                                            <div>
                                                <h4 class="mb-3 text-primary">Fase tasseling (VT)</h4>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <div>
                                                <span class="btn btn-sm btn-primary bsb-btn-circle pe-none me-3">4</span>
                                            </div>
                                            <div>
                                                <h4 class="mb-3 text-primary">Fase silking (R1)</h4>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <div>
                                                <span class="btn btn-sm btn-primary bsb-btn-circle pe-none me-3">5</span>
                                            </div>
                                            <div>
                                                <h4 class="mb-3 text-primary">Fase pengisian biji (R2-R5)</h4>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <div>
                                                <span class="btn btn-sm btn-primary bsb-btn-circle pe-none me-3">6</span>
                                            </div>
                                            <div>
                                                <h4 class="mb-3 text-primary">Fase kemasakan fisiologis (R6)</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Kandungan -->
        <section class="bg-light py-3 py-md-5 py-xl-8">
            <div class="container">
                <div class="row gy-3 gy-md-5 gy-lg-0 align-items-center">
                    <div class="col-12 col-lg-5">
                        <h2 class="fs-3 text-secondary mb-2 mb-xl-3">Kandungan Nutrisi Jagung</h2>
                        <h3 class="display-5 mb-3 mb-xl-4 fs-5">Jagung memiliki profil nutrisi yang kaya dan beragam.</h3>
                        <p class="lead mb-4 mb-xl-5 fs-6">Komposisi nutrisi ini dapat bervariasi tergantung pada varietas jagung dan kondisi pertumbuhan.</p>
                    </div>
                    <div class="col-12 col-lg-7">
                        <div class="row justify-content-xl-end">
                            <div class="col-12 col-xl-11">
                                <div class="row gy-3 gy-md-4">
                                    <div class="col-12 col-sm-6">
                                        <div class="card border-0 border-bottom border-secondary shadow-sm">
                                            <div class="card-body text-center p-2 p-xxl-3">
                                                <h4 class="h3 mb-2">Karbohidrat</h4>
                                                <p class="fs-5 mb-0 text-secondary">74-76%</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="card border-0 border-bottom border-secondary shadow-sm">
                                            <div class="card-body text-center p-2 p-xxl-3">
                                                <h4 class="h3 mb-2">Protein</h4>
                                                <p class="fs-5 mb-0 text-secondary">9-11%</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="card border-0 border-bottom border-secondary shadow-sm">
                                            <div class="card-body text-center p-2 p-xxl-3">
                                                <h4 class="h3 mb-2">Lemak</h4>
                                                <p class="fs-5 mb-0 text-secondary">3-5%</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="card border-0 border-bottom border-secondary shadow-sm">
                                            <div class="card-body text-center p-2 p-xxl-3">
                                                <h4 class="h3 mb-2">Serat</h4>
                                                <p class="fs-5 mb-0 text-secondary">2-3%</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="card border-0 border-bottom border-secondary shadow-sm">
                                            <div class="card-body text-center p-2 p-xxl-3">
                                                <h4 class="h3 mb-2">Vitamin</h4>
                                                <p class="fs-5 mb-0 text-secondary">A, B kompleks (terutama B1, B3, B5), C, E, K</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="card border-0 border-bottom border-secondary shadow-sm">
                                            <div class="card-body text-center p-2 p-xxl-3">
                                                <h4 class="h3 mb-2">Mineral</h4>
                                                <p class="fs-5 mb-0 text-secondary">Fosfor, magnesium, mangan, seng, besi, tembaga</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="card border-0 border-bottom border-secondary shadow-sm">
                                            <div class="card-body text-center p-2 p-xxl-3">
                                                <h4 class="h3 mb-2">Antioksidan</h4>
                                                <p class="fs-5 mb-0 text-secondary">Karotenoid (lutein, zeaxanthin), fenolik, dan flavonoid</p>
                                            </div>
                                        </div>
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
