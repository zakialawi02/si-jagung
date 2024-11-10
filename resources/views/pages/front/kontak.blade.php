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
                            <h2 class="fw-bolder mb-3 text-center">KONTAK</h2>
                            <!-- <p class="text-primary mb-3 text-center">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Id quibusdam maxime quo amet temporibus molestiae.</p> -->
                            <hr class="w-50 mb-xl-9 border-secondary-subtle mx-auto mb-2" />
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Profile Start -->
        <section class="" id="profile">
            <div class="position-relative">
                <div class="image-profile-wrapper align-baseline">
                    <div style="background: linear-gradient(to bottom, #104a5972,#fffef6 ); height: 80vh; backdrop-filter: blur(2px);"></div>
                    <div class="position-absolute start-50 translate-middle-x w-75 w-md-100 top-0 px-4">
                        <div class="py-4">
                            <h2 class="mb-3 text-center">Tim Kami</h2>
                            <h4 class="h5 mb-3 text-center">Tim Pengabdian Masyarakat SIJAGUNG: PEMANFAATAN SISTEM INFORMASI GEOGRAFIS BERBASIS WEB UNTUK RANTAI PRODUKSI JAGUNG
                            </h4>
                            <hr class="w-50 mb-xl-9 border-secondary-subtle mx-auto mb-2" />
                        </div>
                    </div>
                </div>

                <div class="profile-video">
                    <img class="" src="/assets/img/IMG_0959.jpg" alt="tim kami" />
                </div>
            </div>
        </section>
        <!-- Profile End -->

        <!-- Contact Start -->
        <section class="py-md-5 align-items-center py-3" id="contact">
            <div class="container mt-4">
                <div class="row gy-3 gy-md-4 gy-lg-0 align-items-lg-center">
                    <div class="col-12 col-lg-6">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10129.962532174066!2d112.79374264927627!3d-7.278667019250665!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fa13c4642591%3A0x894902aff3849275!2sDepartemen%20Teknik%20Geomatika!5e1!3m2!1sen!2sid!4v1731222375082!5m2!1sen!2sid"
                            style="border: 0" with="100%" width="100%" height="450" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="row justify-content-xl-center">
                            <div class="col-12 col-xl-11">
                                <h2 class="h1 mb-3">Hubungi Kami</h2>
                                <p class="lead fs-4 text-primary mb-5">Jangan ragu untuk menghubungi kami jika ada pertanyaan, pertanyaan, atau sekadar menyapa. Kami di sini untuk membantu.</p>
                                <div class="d-flex mb-4">
                                    <div class="text-primary me-4">
                                        <svg class="bi bi-geo" xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd"
                                                d="M8 1a3 3 0 1 0 0 6 3 3 0 0 0 0-6zM4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999zm2.493 8.574a.5.5 0 0 1-.411.575c-.712.118-1.28.295-1.655.493a1.319 1.319 0 0 0-.37.265.301.301 0 0 0-.057.09V14l.002.008a.147.147 0 0 0 .016.033.617.617 0 0 0 .145.15c.165.13.435.27.813.395.751.25 1.82.414 3.024.414s2.273-.163 3.024-.414c.378-.126.648-.265.813-.395a.619.619 0 0 0 .146-.15.148.148 0 0 0 .015-.033L12 14v-.004a.301.301 0 0 0-.057-.09 1.318 1.318 0 0 0-.37-.264c-.376-.198-.943-.375-1.655-.493a.5.5 0 1 1 .164-.986c.77.127 1.452.328 1.957.594C12.5 13 13 13.4 13 14c0 .426-.26.752-.544.977-.29.228-.68.413-1.116.558-.878.293-2.059.465-3.34.465-1.281 0-2.462-.172-3.34-.465-.436-.145-.826-.33-1.116-.558C3.26 14.752 3 14.426 3 14c0-.599.5-1 .961-1.243.505-.266 1.187-.467 1.957-.594a.5.5 0 0 1 .575.411z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="mb-3">Address</h4>
                                        <address class="text-info mb-0">Departemen Teknik Geomatika Gedung Teknik Geomatika, FTSPK Kampus ITS, Sukolilo, Kota Surabaya, 60111</address>
                                    </div>
                                </div>
                                <div class="d-flex mb-4">
                                    <div class="text-primary me-4">
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
                                    <div class="text-primary me-4">
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
