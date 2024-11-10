@extends("layouts.appFront")

@section("title", "Kesehatan Jagung | " . config("app.name"))
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
                            <h2 class="fw-bolder mb-3 text-center">Kesehatan Jagung</h2>
                            {{-- <p class="mb-3 text-center text-primary">Jagung: Tanaman Multifungsi dengan Potensi Besar</p> --}}
                            <hr class="w-50 mb-xl-9 border-secondary-subtle mx-auto mb-2" />
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="audience-section mt-5 py-2" id="audience-section">
            <div class="container">
                <h2 class="section-heading mb-4 text-center">Jagung: Tanaman Multifungsi dengan Potensi Besar</h2>
                <div class="section-intro single-col-max mx-auto mb-5 text-center">
                    Jagung (Zea mays L.) adalah salah satu tanaman pangan utama di dunia, menempati posisi ketiga setelah gandum dan padi dalam hal produksi global. Tanaman ini memiliki sejarah panjang
                    dalam peradaban manusia dan terus memainkan peran penting dalam ketahanan pangan, industri, dan ekonomi.
                </div>
            </div>
        </section>

        <!-- Varietas -->
        <section class="py-md-5 py-3">
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
                                    <div class="text-primary me-3">
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
                                    <div class="text-primary me-3">
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
                                    <div class="text-primary me-3">
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
                                    <div class="text-primary me-3">
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
                                    <div class="text-primary me-3">
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
                                    <div class="text-primary me-3">
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
        <section class="py-md-5 py-xl-8 py-3">
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col-12 col-md-10 col-lg-8 col-xl-7 fs-4">
                        <h2 class="fs-1 mb-4 text-center">Siklus Hidup dan Fisiologi Jagung</h2>
                        <p class="text-secondary lead fs-5 mb-5 text-center">Siklus hidup jagung dapat dibagi menjadi beberapa fase utama</p>
                        <hr class="w-50 mb-xl-9 border-dark-subtle mx-auto mb-5">
                    </div>
                </div>
            </div>

            <div class="container">
                <div class="row gy-4 gy-lg-0 align-items-lg-center">
                    <div class="col-12 col-lg-6">
                        <img class="img-fluid border-dark rounded border" src="/assets/img/siklus jagung.png" alt="About Us" loading="lazy">
                    </div>
                    <div class="col-12 col-lg-6 col-xxl-6">
                        <div class="row justify-content-lg-end">
                            <div class="col-12 col-lg-11">
                                <div class="about-wrapper">
                                    <p class="lead mb-2">Tanaman jagung umumnya membutuhkan 90-120 hari dari penanaman hingga panen, tergantung pada varietas dan kondisi lingkungan.</p>

                                    <p class="lead mb-2">Jagung adalah tanaman C4, yang berarti memiliki efisiensi fotosintesis yang tinggi, terutama dalam kondisi suhu tinggi dan intensitas
                                        cahaya kuat. Karakteristik ini memungkinkan jagung untuk tumbuh dengan baik di daerah tropis dan subtropis.</p>

                                    <div class="row gy-1 mb-md-5 my-4">
                                        <div class="d-flex">
                                            <div>
                                                <span class="btn btn-sm btn-primary bsb-btn-circle pe-none me-3">1</span>
                                            </div>
                                            <div>
                                                <h4 class="text-primary mb-3">Fase perkecambahan (VE)</h4>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <div>
                                                <span class="btn btn-sm btn-primary bsb-btn-circle pe-none me-3">2</span>
                                            </div>
                                            <div>
                                                <h4 class="text-primary mb-3">Fase pertumbuhan vegetatif (V1-Vn)</h4>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <div>
                                                <span class="btn btn-sm btn-primary bsb-btn-circle pe-none me-3">3</span>
                                            </div>
                                            <div>
                                                <h4 class="text-primary mb-3">Fase tasseling (VT)</h4>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <div>
                                                <span class="btn btn-sm btn-primary bsb-btn-circle pe-none me-3">4</span>
                                            </div>
                                            <div>
                                                <h4 class="text-primary mb-3">Fase silking (R1)</h4>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <div>
                                                <span class="btn btn-sm btn-primary bsb-btn-circle pe-none me-3">5</span>
                                            </div>
                                            <div>
                                                <h4 class="text-primary mb-3">Fase pengisian biji (R2-R5)</h4>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <div>
                                                <span class="btn btn-sm btn-primary bsb-btn-circle pe-none me-3">6</span>
                                            </div>
                                            <div>
                                                <h4 class="text-primary mb-3">Fase kemasakan fisiologis (R6)</h4>
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
        <section class="bg-light py-md-5 py-xl-8 py-3">
            <div class="container">
                <div class="row gy-3 gy-md-5 gy-lg-0 align-items-center">
                    <div class="col-12 col-lg-5">
                        <h2 class="fs-3 text-secondary mb-xl-3 mb-2">Kandungan Nutrisi Jagung</h2>
                        <h3 class="display-5 mb-xl-4 fs-5 mb-3">Jagung memiliki profil nutrisi yang kaya dan beragam.</h3>
                        <p class="lead mb-xl-5 fs-6 mb-4">Komposisi nutrisi ini dapat bervariasi tergantung pada varietas jagung dan kondisi pertumbuhan.</p>
                    </div>
                    <div class="col-12 col-lg-7">
                        <div class="row justify-content-xl-end">
                            <div class="col-12 col-xl-11">
                                <div class="row gy-3 gy-md-4">
                                    <div class="col-12 col-sm-6">
                                        <div class="card border-bottom border-primary border-0 shadow-sm">
                                            <div class="card-body bg-info p-xxl-3 p-2 text-center">
                                                <h4 class="h3 fs-5 mb-2">Karbohidrat</h4>
                                                <p class="fs-6 text-light mb-0">74-76%</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="card border-bottom border-primary border-0 shadow-sm">
                                            <div class="card-body bg-info p-xxl-3 p-2 text-center">
                                                <h4 class="h3 fs-5 mb-2">Protein</h4>
                                                <p class="fs-6 text-light mb-0">9-11%</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="card border-bottom border-primary border-0 shadow-sm">
                                            <div class="card-body bg-info p-xxl-3 p-2 text-center">
                                                <h4 class="h3 fs-5 mb-2">Lemak</h4>
                                                <p class="fs-6 text-light mb-0">3-5%</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="card border-bottom border-primary border-0 shadow-sm">
                                            <div class="card-body bg-info p-xxl-3 p-2 text-center">
                                                <h4 class="h3 fs-5 mb-2">Serat</h4>
                                                <p class="fs-6 text-light mb-0">2-3%</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="card border-bottom border-primary border-0 shadow-sm">
                                            <div class="card-body bg-info p-xxl-3 p-2 text-center">
                                                <h4 class="h3 fs-5 mb-2">Vitamin</h4>
                                                <p class="fs-6 text-light mb-0">A, B kompleks (terutama B1, B3, B5), C, E, K</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="card border-bottom border-primary border-0 shadow-sm">
                                            <div class="card-body bg-info p-xxl-3 p-2 text-center">
                                                <h4 class="h3 fs-5 mb-2">Mineral</h4>
                                                <p class="fs-6 text-light mb-0">Fosfor, magnesium, mangan, seng, besi, tembaga</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="card border-bottom border-primary border-0 shadow-sm">
                                            <div class="card-body bg-info p-xxl-3 p-2 text-center">
                                                <h4 class="h3 fs-5 mb-2">Antioksidan</h4>
                                                <p class="fs-6 text-light mb-0">Karotenoid (lutein, zeaxanthin), fenolik, dan flavonoid</p>
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

        <section class="audience-section mt-5 py-2" id="audience-section">
            <div class="container">
                <h2 class="section-heading mb-4 text-center">Meningkatkan Produktivitas Jagung dengan Teknologi Penginderaan Jauh</h2>
                <div class="section-intro single-col-max mx-auto mb-5 text-center">
                    Penggunaan teknologi penginderaan jauh seperti NDVI, NDMI, dan pemantauan emisi metana memainkan peran penting dalam meningkatkan produktivitas tanaman jagung secara berkelanjutan.
                </div>
            </div>

            <div class="container mb-5 overflow-hidden">
                <div class="row gy-4 gy-lg-0">
                    <div class="col-12 col-lg-4">
                        <article>
                            <div class="card border-0">
                                <div class="card-header bg-white p-0">
                                    <img class="img-fluid w-100 object-cover" src="/assets/img/corn farm1.webp" alt="Card Image" style="height: 200px; object-fit: cover">
                                </div>
                                <div class="card-body border bg-white p-4">
                                    <div class="entry-header mb-3">
                                        <h2 class="card-title entry-title h4 mb-0">
                                            <a class="link-dark text-decoration-none" href="#!">NDVI untuk Memantau Kesehatan Tanaman</a>
                                        </h2>
                                    </div>
                                    <p class="card-text entry-summary text-primary">
                                        NDVI (Normalized Difference Vegetation Index) dari satelit Sentinel-2 digunakan untuk menilai kesehatan dan tingkat kehijauan tanaman jagung. Indeks ini membantu
                                        petani mengidentifikasi area tanaman yang memerlukan perhatian lebih, mempermudah pengambilan keputusan untuk pemupukan dan irigasi, sehingga mendukung pertumbuhan
                                        yang optimal.
                                    </p>
                                </div>
                            </div>
                        </article>
                    </div>
                    <div class="col-12 col-lg-4">
                        <article>
                            <div class="card border-0">
                                <div class="card-header bg-white p-0">
                                    <img class="img-fluid w-100 object-cover" src="/assets/img/corn farm2.webp" alt="Card Image" style="height: 200px; object-fit: cover">
                                </div>
                                <div class="card-body border bg-white p-4">
                                    <div class="entry-header mb-3">
                                        <h2 class="card-title entry-title h4 mb-0">
                                            <a class="link-dark text-decoration-none" href="#!">NDMI untuk Mengukur Kelembapan Tanaman</a>
                                        </h2>
                                    </div>
                                    <p class="card-text entry-summary text-primary">
                                        NDMI (Normalized Difference Moisture Index) juga dari Sentinel-2 memungkinkan pengukuran tingkat kelembapan tanaman jagung. Dengan data ini, petani dapat mengatur
                                        irigasi secara tepat guna menghindari kekeringan. Hal ini tidak hanya menghemat air, tetapi juga meningkatkan ketahanan tanaman terhadap perubahan iklim.
                                    </p>
                                </div>
                            </div>
                        </article>
                    </div>
                    <div class="col-12 col-lg-4">
                        <article>
                            <div class="card border-0">
                                <div class="card-header bg-white p-0">
                                    <img class="img-fluid w-100 object-cover" src="/assets/img/corn farm3.jpeg" alt="Card Image" style="height: 200px; object-fit: cover">
                                </div>
                                <div class="card-body border bg-white p-4">
                                    <div class="entry-header mb-3">
                                        <h2 class="card-title entry-title h4 mb-0">
                                            <a class="link-dark text-decoration-none" href="#!">Pemantauan Emisi Metana untuk Pengelolaan Limbah</a>
                                        </h2>
                                    </div>
                                    <p class="card-text entry-summary text-primary">
                                        Satelit Sentinel-5 menyediakan data mengenai emisi metana dari limbah jagung. Dengan informasi ini, petani dapat mengelola limbah lebih efektif, seperti mengolahnya
                                        menjadi pupuk organik. Praktik ini tidak hanya mengurangi dampak lingkungan, tetapi juga memperkaya tanah dan mendukung pertumbuhan jagung yang lebih subur
                                    </p>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </section>


        <!-- Footer -->
        @include("components.front._footer")
    </main>
@endsection
