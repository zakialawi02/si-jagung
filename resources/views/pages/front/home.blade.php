@extends("layouts.appFront")

@section("title", config("app.name"))
@section("meta_description", "")
@section("meta_keywords", "")

@section("og_title", config("app.name"))
@section("og_description", "")

@section("content")
    <!-- Navbar -->
    @include("components.front._navbar")

    <main class="pt-6 mt-3">
        <!-- Hero Start -->
        <section class="px-4 bg-white hero px-md-5" id="home">
            <div class="py-6 row flex-lg-row-reverse align-items-center justify-content-center g-5">
                <div class="col-10 col-sm-8 col-lg-6">
                    <img class="img-relative d-block mx-lg-auto img-fluid" src="./assets/img/vector-corn-stalks-illustration.png" width="500" width="700" height="500" loading="lazy" />
                </div>
                <div class="col-lg-6">
                    <h1 class="mb-3 fw-bold lh-1 text-start">Selamat Datang di Sistem Informasi Jagung</h1>
                    <p class="lead">
                        Sistem informasi ini dirancang untuk memberikan pengetahuan komprehensif tentang jagung, mulai dari budidaya, pengolahan, hingga manfaatnya bagi kesehatan dan industri. Dengan
                        informasi yang disajikan, diharapkan dapat
                        membantu petani, peneliti, dan masyarakat umum untuk memahami lebih dalam tentang potensi jagung dan mengoptimalkan penggunaannya.
                    </p>
                    <div class="gap-2 d-grid d-md-flex justify-content-md-start">
                        <button class="px-4 btn btn-outline-warning btn-lg" type="button">Text Here</button>
                    </div>
                </div>
            </div>
        </section>
        <!-- Hero End -->

        <!-- About Start -->
        <section class="bg-primary">
            <div class="overflow-hidden container-fluid">
                <div class="row">
                    <div class="order-1 p-0 col-12 col-md-6 order-lg-0">
                        <img class="img-fluid w-100 h-100 object-fit-cover" src="./assets/img/corn2.jpg" alt="" loading="lazy" />
                    </div>
                    <div class="col-12 col-md-6 order-0 order-md-1 align-self-md-center">
                        <div class="py-3 row py-sm-5 py-xl-9 mt-md-10 justify-content-sm-center">
                            <div class="col-12 col-sm-10">
                                <h2 class="mb-4 text-white display-3 fw-bolder">Apakah Manfaat Jagung Bagi Kesehatan</h2>
                                <div class="">
                                    <p class="mb-5 text-white fs-5">Jagung adalah salah satu sumber pangan yang kaya akan nutrisi dan menawarkan berbagai manfaat bagi kesehatan.</p>
                                </div>

                                <div class="py-2 pt-4 d-flex align-items-center">
                                    <a class="px-3 btn btn-secondary py-sm-3 px-sm-5 me-5" href="./manfaat-jagung-bagi-kesehatan">Selengkapnya</a>
                                    <a class="btn-play glightbox3" data-gallery="video1" data-type="video" type="button" href="https://www.youtube.com/watch?v=JOYwDUTOahU"><span
                                            class="mt-1"></span></a>
                                    <h6 class="m-0 text-white ms-4 d-none d-sm-block">Watch Video</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- About End -->

        <!-- Service Start -->
        <section class="py-5 bsb-service-7 py-xl-8" id="service">
            <div class="container mt-4">
                <div class="row justify-content-md-center">
                    <div class="col-12 col-md-10 col-lg-8 col-xl-7">
                        <h2 class="mb-5 text-center display-6 mb-xl-9">Apa Saja Yang Ada Dalam SIJAGUNG?</h2>
                    </div>
                </div>
            </div>

            <div class="container mb-3">
                <div class="px-5 row">
                    <div class="bg-white col-12">
                        <div class="shadow row">
                            <div class="p-0 border col-12 col-md-4 d-flex flex-column">
                                <div class="px-5 py-3 text-center">
                                    <i class="services-icon bi bi-map-fill"></i>
                                    <h4 class="mb-4 fw-bold text-uppercase">Peta Lahan Jagung</h4>
                                    <p class="mb-4 text-primary">Temukan peta lahan jagung yang terperinci dan lengkap, membantu Anda memetakan area pertanian dengan mudah dan efisien.</p>
                                </div>
                                <div class="p-4 mt-auto text-center">
                                    <a class="fw-bold text-decoration-none link-secondary" href="./peta2">
                                        Pelajari Lebih Lanjut
                                        <svg class="bi bi-arrow-right-short" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            <div class="p-0 border col-12 col-md-4 d-flex flex-column">
                                <div class="px-5 py-3 text-center">
                                    <i class="services-icon bi bi-tools"></i>
                                    <h4 class="mb-4 fw-bold text-uppercase">Cara Budidaya Jagung</h4>
                                    <p class="mb-4 text-primary">Dapatkan panduan lengkap tentang cara budidaya jagung dari persiapan lahan hingga panen, memastikan hasil maksimal dan berkualitas.</p>
                                </div>
                                <div class="p-4 mt-auto text-center">
                                    <a class="fw-bold text-decoration-none link-secondary" href="./cara-budidaya-jagung">
                                        Pelajari Lebih Lanjut
                                        <svg class="bi bi-arrow-right-short" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            <div class="p-0 border col-12 col-md-4 d-flex flex-column">
                                <div class="px-5 py-3 text-center">
                                    <i class="services-icon bi bi-heart-pulse"></i>
                                    <h4 class="mb-4 fw-bold text-uppercase">Kesehatan Jagung</h4>
                                    <p class="mb-4 text-primary">Pelajari cara menjaga kesehatan tanaman jagung Anda dengan tips dan trik untuk mencegah penyakit serta meningkatkan produktivitas.</p>
                                </div>
                                <div class="p-4 mt-auto text-center">
                                    <a class="fw-bold text-decoration-none link-secondary" href="./kesehatan-jagung">
                                        Pelajari Lebih Lanjut
                                        <svg class="bi bi-arrow-right-short" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Service End -->

        <section class="bsb-service-6 py-5 py-xl-8">
            <div class="container">
                <div class="row justify-content-md-center">
                    <div class="col-12 col-md-10 col-lg-8 col-xl-7">
                        <h2 class="display-5 mb-2 text-center">Produk dan Penggunaan Jagung</h2>
                        <h3 class="fs-5 mb-2 mb-md-3  text-secondary text-center text-uppercase">Jagung memiliki berbagai kegunaan</h3>
                        <hr class="w-50 mx-auto mb-5 mb-xl-9 border-dark-subtle">
                    </div>
                </div>
            </div>

            <div class="container overflow-hidden">
                <div class="row gy-4 gy-md-0 gx-xxl-5 align-items-lg-center justify-content-lg-center">
                    <div class="col-12 col-md-4">
                        <div class="card bg-transparent border-primary rounded-0">
                            <div class="card-body text-center">
                                <h4 class="mb-2">Pangan</h4>
                                <p class="mb-2 text-secondary">Jagung segar, tepung jagung, minyak jagung, sirup jagung fruktosa tinggi (HFCS).</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="card bg-transparent border-primary rounded-0">
                            <div class="card-body text-center">
                                <h4 class="mb-2">Pakan ternak</h4>
                                <p class="mb-2 text-secondary">Biji jagung, silase jagung.</p>

                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="card bg-transparent border-primary rounded-0">
                            <div class="card-body text-center">
                                <h4 class="mb-2">Pakan ternak</h4>
                                <p class="mb-2 text-secondary">Bioetanol.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="card bg-transparent border-primary rounded-0">
                            <div class="card-body text-center">
                                <h4 class="mb-2">Industri</h4>
                                <p class="mb-2 text-secondary">Plastik biodegradable, tekstil, kosmetik, farmasi.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="card bg-transparent border-primary rounded-0">
                            <div class="card-body text-center">
                                <h4 class="mb-2">Pati jagung</h4>
                                <p class="mb-2 text-secondary">Digunakan dalam berbagai produk makanan dan non-makanan.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-3 py-md-5 bg-info" id="featured">
            <div class="container mt-5">
                <div class="row gy-3 gy-md-4 gy-lg-0 align-items-lg-center">
                    <div class="col-12 col-lg-6">
                        <img class="img-fluid rounded" src="https://fakeimg.pl/600x600" alt="About 2" loading="lazy" />
                    </div>
                    <div class="col-12 col-lg-6 text-light">
                        <div class="row justify-content-xl-center">
                            <div class="col-12 col-xl-10">
                                <h2 class="mb-3">Produksi Jagung di Indonesia</h2>
                                <p class="lead fs-5 mb-3 mb-xl-5">Indonesia adalah produsen jagung terbesar ke-7 di dunia. Sentra produksi utama meliputi:</p>
                                <div class="d-flex align-items-center mb-3">
                                    <div class="me-3 text-warning">
                                        <svg class="bi bi-check-circle-fill" xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" viewBox="0 0 16 16">
                                            <path
                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="fs-5 m-0">Jawa Timur</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-3">
                                    <div class="me-3 text-warning">
                                        <svg class="bi bi-check-circle-fill" xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" viewBox="0 0 16 16">
                                            <path
                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="fs-5 m-0">Jawa Tengah</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-3">
                                    <div class="me-3 text-warning">
                                        <svg class="bi bi-check-circle-fill" xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" viewBox="0 0 16 16">
                                            <path
                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="fs-5 m-0">Lampung</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-3">
                                    <div class="me-3 text-warning">
                                        <svg class="bi bi-check-circle-fill" xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" viewBox="0 0 16 16">
                                            <path
                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="fs-5 m-0">Sulawesi Selatan</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center mb-4 mb-xl-5">
                                    <div class="me-3 text-warning">
                                        <svg class="bi bi-check-circle-fill" xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" viewBox="0 0 16 16">
                                            <path
                                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="fs-5 m-0">Sulawesi Utara</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-light mb-5 py-3 py-md-5 py-xl-8">
            <div class="container p-3">
                <div class="row gy-3 gy-md-5 gy-lg-0 align-items-center">
                    <div class="col-12 col-lg-5">
                        <h2 class="fs-3 text-primary mb-2 mb-xl-3">Tantangan dan Prospek Masa Depan</h2>
                        <h3 class="display-5 mb-3 mb-xl-4 fs-5">Beberapa tantangan dalam produksi jagung di Indonesia.</h3>

                        <p class="mt-5 pt-5">Namun, dengan inovasi teknologi seperti pengembangan varietas tahan kekeringan dan hama, serta peningkatan efisiensi produksi, jagung tetap memiliki prospek
                            yang
                            cerah sebagai komoditas strategis di Indonesia.</p>
                    </div>
                    <div class="col-12 col-lg-7">
                        <div class="row justify-content-xl-end">
                            <div class="col-12 col-xl-11">
                                <div class="row gy-3 gy-md-4">
                                    <div class="col-12 col-sm-6">
                                        <div class="card shadow h-50 justify-content-center align-items-center center mb-4 mt-0 mt-md-4">
                                            <div class="card-body text-center p-2 p-xxl-3">
                                                <h5 class="mb-1">Perubahan iklim dan cuaca ekstrem</h5>
                                            </div>
                                        </div>
                                        <div class="card shadow h-50 justify-content-center align-items-center">
                                            <div class="card-body text-center p-2 p-xxl-3">
                                                <h5 class="mb-1">Serangan hama dan penyakit</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="card shadow h-50 justify-content-center align-items-center mt-lg-6 mt-xxl-8 mb-4">
                                            <div class="card-body text-center p-2 p-xxl-3">
                                                <h5 class="mb-1">Keterbatasan lahan produktif</h5>
                                            </div>
                                        </div>
                                        <div class="card shadow h-50 justify-content-center align-items-center">
                                            <div class="card-body text-center p-2 p-xxl-3">
                                                <h5 class="mb-1">Fluktuasi harga</h5>
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


        <!-- Team Start -->
        <!-- <section class="py-3 pb-2 bg-light py-md-5 py-xl-8" id="team">
                                                                                                                                                                                                                                                                                                        <div class="container mt-4">
                                                                                                                                                                                                                                                                                                          <div class="row justify-content-md-center">
                                                                                                                                                                                                                                                                                                            <div class="col-12 col-md-10 col-lg-8 col-xl-7 col-xxl-6">
                                                                                                                                                                                                                                                                                                              <h2 class="mb-4 text-center display-5">Team (Section 6)</h2>
                                                                                                                                                                                                                                                                                                              <p class="mb-5 text-center text-secondary lead fs-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque, numquam at itaque animi voluptatum rerum officia voluptates.</p>
                                                                                                                                                                                                                                                                                                              <hr class="mx-auto mb-5 w-50 mb-xl-9 border-dark-subtle"/>
                                                                                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                                                          </div>
                                                                                                                                                                                                                                                                                                        </div>

                                                                                                                                                                                                                                                                                                        <div class="container overflow-hidden">
                                                                                                                                                                                                                                                                                                          <div class="row gy-4 gy-lg-0 gx-xxl-5">
                                                                                                                                                                                                                                                                                                            <div class="col-12 col-md-6 col-lg-3">
                                                                                                                                                                                                                                                                                                              <div class="overflow-hidden border-0 shadow-sm card border-bottom border-primary">
                                                                                                                                                                                                                                                                                                                <div class="p-0 card-body">
                                                                                                                                                                                                                                                                                                                  <figure class="p-0 m-0">
                                                                                                                                                                                                                                                                                                                    <img class="img-fluid" src="./assets/img/team/p1.jpeg" alt="Anggota team" loading="lazy" width="500"/>
                                                                                                                                                                                                                                                                                                                    <figcaption class="p-4 m-0">
                                                                                                                                                                                                                                                                                                                      <h4 class="mb-1">Evander Mac</h4>
                                                                                                                                                                                                                                                                                                                      <p class="mb-0 text-secondary">Product Manager</p>
                                                                                                                                                                                                                                                                                                                    </figcaption>
                                                                                                                                                                                                                                                                                                                  </figure>
                                                                                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                                                                              </div>
                                                                                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                                                            <div class="col-12 col-md-6 col-lg-3">
                                                                                                                                                                                                                                                                                                              <div class="overflow-hidden border-0 shadow-sm card border-bottom border-primary">
                                                                                                                                                                                                                                                                                                                <div class="p-0 card-body">
                                                                                                                                                                                                                                                                                                                  <figure class="p-0 m-0">
                                                                                                                                                                                                                                                                                                                    <img class="img-fluid" src="./assets/img/team/p3.jpg" alt="Anggota team" loading="lazy" width="500"/>
                                                                                                                                                                                                                                                                                                                    <figcaption class="p-4 m-0">
                                                                                                                                                                                                                                                                                                                      <h4 class="mb-1">Flora Nyra</h4>
                                                                                                                                                                                                                                                                                                                      <p class="mb-0 text-secondary">Art Director</p>
                                                                                                                                                                                                                                                                                                                    </figcaption>
                                                                                                                                                                                                                                                                                                                  </figure>
                                                                                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                                                                              </div>
                                                                                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                                                            <div class="col-12 col-md-6 col-lg-3">
                                                                                                                                                                                                                                                                                                              <div class="overflow-hidden border-0 shadow-sm card border-bottom border-primary">
                                                                                                                                                                                                                                                                                                                <div class="p-0 card-body">
                                                                                                                                                                                                                                                                                                                  <figure class="p-0 m-0">
                                                                                                                                                                                                                                                                                                                    <img class="img-fluid" src="./assets/img/team/p2.jpg" alt="Anggota team" loading="lazy" width="500"/>
                                                                                                                                                                                                                                                                                                                    <figcaption class="p-4 m-0">
                                                                                                                                                                                                                                                                                                                      <h4 class="mb-1">Wylder Elio</h4>
                                                                                                                                                                                                                                                                                                                      <p class="mb-0 text-secondary">Investment Planner</p>
                                                                                                                                                                                                                                                                                                                    </figcaption>
                                                                                                                                                                                                                                                                                                                  </figure>
                                                                                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                                                                              </div>
                                                                                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                                                            <div class="col-12 col-md-6 col-lg-3">
                                                                                                                                                                                                                                                                                                              <div class="overflow-hidden border-0 shadow-sm card border-bottom border-primary">
                                                                                                                                                                                                                                                                                                                <div class="p-0 card-body">
                                                                                                                                                                                                                                                                                                                  <figure class="p-0 m-0">
                                                                                                                                                                                                                                                                                                                    <img class="img-fluid" src="./assets/img/team/p4.jpg" alt="Anggota team" loading="lazy" width="500"/>
                                                                                                                                                                                                                                                                                                                    <figcaption class="p-4 m-0">
                                                                                                                                                                                                                                                                                                                      <h4 class="mb-1">Taytum Elia</h4>
                                                                                                                                                                                                                                                                                                                      <p class="mb-0 text-secondary">Financial Analyst</p>
                                                                                                                                                                                                                                                                                                                    </figcaption>
                                                                                                                                                                                                                                                                                                                  </figure>
                                                                                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                                                                              </div>
                                                                                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                                                          </div>
                                                                                                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                                                                                                                        </section> -->
        <!-- Team End -->

        <!-- Contact Start -->
        <section class="py-3 py-md-5 align-items-center" id="contact">
            <div class="container mt-4">
                <div class="row gy-3 gy-md-4 gy-lg-0 align-items-lg-center">
                    <div class="col-12 col-lg-6">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7904.4839249354045!2d111.61639928493351!3d-7.869730369777083!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e79a7967dcfee75%3A0x7ea4ba09249258d9!2sBreeding%20Farm!5e0!3m2!1sen!2sid!4v1721634855670!5m2!1sen!2sid"
                            style="border: 0" with="100%" width="100%" height="450" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="row justify-content-xl-center">
                            <div class="col-12 col-xl-11">
                                <h2 class="mb-3 h1">Hubungi Kami</h2>
                                <p class="mb-5 lead fs-4 text-primary"></p>
                                <div class="mb-4 d-flex">
                                    <div class="me-4 text-primary">
                                        <svg class="bi bi-geo" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M8 1a3 3 0 1 0 0 6 3 3 0 0 0 0-6zM4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999zm2.493 8.574a.5.5 0 0 1-.411.575c-.712.118-1.28.295-1.655.493a1.319 1.319 0 0 0-.37.265.301.301 0 0 0-.057.09V14l.002.008a.147.147 0 0 0 .016.033.617.617 0 0 0 .145.15c.165.13.435.27.813.395.751.25 1.82.414 3.024.414s2.273-.163 3.024-.414c.378-.126.648-.265.813-.395a.619.619 0 0 0 .146-.15.148.148 0 0 0 .015-.033L12 14v-.004a.301.301 0 0 0-.057-.09 1.318 1.318 0 0 0-.37-.264c-.376-.198-.943-.375-1.655-.493a.5.5 0 1 1 .164-.986c.77.127 1.452.328 1.957.594C12.5 13 13 13.4 13 14c0 .426-.26.752-.544.977-.29.228-.68.413-1.116.558-.878.293-2.059.465-3.34.465-1.281 0-2.462-.172-3.34-.465-.436-.145-.826-.33-1.116-.558C3.26 14.752 3 14.426 3 14c0-.599.5-1 .961-1.243.505-.266 1.187-.467 1.957-.594a.5.5 0 0 1 .575.411z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="mb-3">Address</h4>
                                        <address class="mb-0 text-info">Departemen Teknik Geomatika Gedung Teknik Geomatika, FTSPK Kampus ITS, Sukolilo, Kota Surabaya, 60111</address>
                                    </div>
                                </div>
                                <div class="mb-4 d-flex">
                                    <div class="me-4 text-primary">
                                        <svg class="bi bi-telephone-outbound" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 16 16">
                                            <path
                                                d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.568 17.568 0 0 0 4.168 6.608 17.569 17.569 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.678.678 0 0 0-.58-.122l-2.19.547a1.745 1.745 0 0 1-1.657-.459L5.482 8.062a1.745 1.745 0 0 1-.46-1.657l.548-2.19a.678.678 0 0 0-.122-.58L3.654 1.328zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.678.678 0 0 0 .178.643l2.457 2.457a.678.678 0 0 0 .644.178l2.189-.547a1.745 1.745 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.634 18.634 0 0 1-7.01-4.42 18.634 18.634 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877L1.885.511zM11 .5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V1.707l-4.146 4.147a.5.5 0 0 1-.708-.708L14.293 1H11.5a.5.5 0 0 1-.5-.5z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="mb-3">Phone</h4>
                                        <p class="mb-0">
                                            <a class="link-info text-decoration-none" href="tel:#">+62 821-3233-3324</a>
                                        </p>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <div class="me-4 text-primary">
                                        <svg class="bi bi-envelope-at" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 16 16">
                                            <path
                                                d="M2 2a2 2 0 0 0-2 2v8.01A2 2 0 0 0 2 14h5.5a.5.5 0 0 0 0-1H2a1 1 0 0 1-.966-.741l5.64-3.471L8 9.583l7-4.2V8.5a.5.5 0 0 0 1 0V4a2 2 0 0 0-2-2H2Zm3.708 6.208L1 11.105V5.383l4.708 2.825ZM1 4.217V4a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v.217l-7 4.2-7-4.2Z" />
                                            <path
                                                d="M14.247 14.269c1.01 0 1.587-.857 1.587-2.025v-.21C15.834 10.43 14.64 9 12.52 9h-.035C10.42 9 9 10.36 9 12.432v.214C9 14.82 10.438 16 12.358 16h.044c.594 0 1.018-.074 1.237-.175v-.73c-.245.11-.673.18-1.18.18h-.044c-1.334 0-2.571-.788-2.571-2.655v-.157c0-1.657 1.058-2.724 2.64-2.724h.04c1.535 0 2.484 1.05 2.484 2.326v.118c0 .975-.324 1.39-.639 1.39-.232 0-.41-.148-.41-.42v-2.19h-.906v.569h-.03c-.084-.298-.368-.63-.954-.63-.778 0-1.259.555-1.259 1.4v.528c0 .892.49 1.434 1.26 1.434.471 0 .896-.227 1.014-.643h.043c.118.42.617.648 1.12.648Zm-2.453-1.588v-.227c0-.546.227-.791.573-.791.297 0 .572.192.572.708v.367c0 .573-.253.744-.564.744-.354 0-.581-.215-.581-.8Z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="mb-3">E-Mail</h4>
                                        <p>
                                            <a class="link-info text-decoration-none" href="mailto:geomatika@its.ac.id">geomatika@its.ac.id</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Contact End -->

        <!-- Footer -->
        @include("components.front._footer")
    </main>
@endsection
