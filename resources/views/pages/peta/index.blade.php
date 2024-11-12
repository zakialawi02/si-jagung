@extends("layouts.appFrontMap")

@section("title", "Peta | " . config("app.name"))
@section("meta_description", "")
@section("meta_keywords", "")

@section("og_title", config("app.name"))
@section("og_description", "")

@push("css")
    <style>
        table {
            word-wrap: break-word;
            /* word-break: break-all; */
        }

        td {
            border: 1px solid #434343 !important;
        }
    </style>
@endpush

@section("content")
    <main class="pt-6">
        <section>
            <div class="position-relative" id="mapWrapper">
                <div id="map"></div>


                <div class="" id="topLeft">
                    <!-- layerControl Button -->
                    <button class="position-relative" id="layerControlBtn">Layer <i class="bi bi-layout-sidebar"></i><i class="bi bi-arrow-bar-right"></i></button>
                </div>

                <div class="" id="topRight">
                    <!-- draw Button -->
                    <button class="position-relative" id="drawerControlBtn"></i><i class="bi bi-arrow-bar-left d-none d-md-inline"></i><i class="fas fa-pencil-ruler"></i> Gambar</button>
                </div>

                <div class="" id="bottomLeft">
                    <!-- Ledend button -->
                    <div class="d-flex align-items-center justify-content-between mb-3" id="legendBtn">
                        <span>Legenda</span>
                        <i class="fas fa-arrow-alt-circle-up"></i>
                    </div>

                    <div class="d-flex align-items-end">
                        <!-- Mouse Position -->
                        <div class="position-relative mb-1" id="mousePosition"></div>

                        <!-- Scaleline -->
                        <div class="position-relative" id="scaleline"></div>

                    </div>
                </div>

                <div class="" id="bottomRight">
                    <!-- Zoom Toggle -->
                    <div class="position-relative" id="zoomToggle"></div>

                    <!-- Minimap -->
                    <div class="position-relative" id="minimap"></div>


                    <!-- attribution -->
                    <div class="position-relative" id="attribution"></div>
                </div>
            </div>

            <!-- overlay popup -->
            <div class="" id="overlaySection">
                <div class="bg-light d-none" id="informationPopup">
                    <div class="m-0 px-2">
                        <div class="d-flex justify-content-between align-items-center mb-0" id="informationPopupHeader">
                            <div class="panel-header position-relative w-100 align-content-start">
                                <h5>Informasi Data Layer</h5>
                                <div class="position-absolute translate-middle-y end-0 top-0 m-0 mt-2 p-0" id="informationPopupClose">
                                    <button class="btn-close" data-bs-dismiss="offcanvas" type="button" aria-label="Close"></button>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-content-start" id="informationPopupCoordinate">...</div>
                    </div>
                    <div class="p-2" id="informationPopupContent">...</div>
                </div>

                <div class="bg-light d-none" id="legendSection">
                    <div class="" id="legendBody">
                        <div class="d-flex justify-content-between align-items-center mb-0" id="">
                            <div class="panel-header position-relative w-100 align-content-start">
                                <h5>Legenda</h5>
                                <div class="position-absolute translate-middle-y end-0 top-0 m-0 mt-2 p-0" id="legendPopupClose">
                                    <button class="btn-close" data-bs-dismiss="offcanvas" type="button" aria-label="Close"></button>
                                </div>
                            </div>
                        </div>
                        <div class="p-1" id="legendContent">...</div>
                    </div>
                </div>
            </div>

            <!-- offcanvas layerControl -->
            <div class="position-relative">
                <div class="align-self-end" id="layerControl">
                    <div class="layerControl-header d-flex justify-content-between align-items-center mb-2">
                        <h5 class="layerControl-title px-2 py-1" id="layerControlTitle">Layer</h5>
                        <button class="btn btn-layerControl-close align-self-start m-1 p-1" type="button"><i class="bi bi-arrow-bar-left"></i></button>
                    </div>
                    <div class="px-2 py-1" id="layerControlBody">
                        <div class="">
                            <div class="layer mb-3">
                                <div class="ml-3 mt-2 p-1">
                                    <p class="mb-1">NDVI</p>
                                </div>
                                @include("components.front.peta._ndviLayers")


                                <div class="ml-3 mt-2 p-1">
                                    <p class="mb-1">NDMI</p>
                                </div>
                                @include("components.front.peta._ndmiLayers")


                                <div class="ml-3 mt-2 p-1">
                                    <p class="mb-1">Methane</p>
                                </div>
                                @include("components.front.peta._methaneLayers")


                            </div>

                            <div class="mb-3" id="basemap-select">
                                <div class="ml-3 mt-2 p-1">
                                    <p class="mb-1">Base Map</p>
                                </div>

                                <select class="form-select" id="basemap" name="basemap">
                                    <option value="osm">Street OSM</option>
                                    <option value="bingaerial" selected>Bing Aerial</option>
                                    <option value="mapbox">Street Mapbox</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- offcanvas drawerControl -->
            <div class="position-relative">
                <div class="align-self-end" id="drawerControl">
                    <div class="panel-header d-flex justify-content-between align-items-center my-1 px-2">
                        <h5>Gambar</h5>
                        <button class="btn btn-close btn-drawerControl-close align-self-start m-1 p-1" type="button"></button>
                    </div>
                    <div class="px-2 py-1" id="drawerControlBody">
                        <div class="">
                            <button class="btn btn-sm btn-primary" id="drawPolygonBtn" role="button"><i class="fas fa-pencil-ruler"></i>&nbsp;&nbsp; gambar polygon</button>
                        </div>

                        <div class="mt-2" id="drawerGeojson" style="max-height: 60px; overflow: auto;"></div>
                        <hr class="solid">

                        <div class="d-none my-2" id="featureProperties">
                            <form id="featurePropertiesForm" action="">
                                @csrf

                                <div class="mb-1">
                                    <label class="form-label m-0" for="no_kebun" style="font-size: 14px">No. Kebun</label>
                                    <input class="form-control form-control-sm" id="no_kebun" name="no_kebun" type="text" placeholder="Masukkan No. Kebun" />
                                </div>
                                <div class="mb-1">
                                    <label class="form-label m-0" for="nama_pemilik" style="font-size: 14px">Nama Pemilik</label>
                                    <input class="form-control form-control-sm" id="nama_pemilik" name="nama_pemilik" type="text" placeholder="Masukkan Nama Pemilik" />
                                </div>
                                <div class="mb-1">
                                    <label class="form-label m-0" for="luas" style="font-size: 14px">Luas Lahan</label>
                                    <div class="" id="measurementOutput" style="font-size: 14px"></div>
                                </div>
                                <div class="mb-1">
                                    <label class="form-label m-0" for="jumlah_produksi" style="font-size: 14px">Jumlah Produksi (per panen) [Kg]</label>
                                    <input class="form-control form-control-sm" id="jumlah_produksi" name="jumlah_produksi" type="text" placeholder="Masukkan Jumlah Produksi dalam kilogram" />
                                </div>
                                <div class="mb-1">
                                    <label class="form-label m-0" for="jenis_jagung" style="font-size: 14px">Jenis Jagung</label>
                                    <select class="form-select form-select-sm" id="jenis_jagung" name="jenis_jagung">
                                        <option value="" selected>Pilih Jenis</option>
                                        <option value="pakan">Pakan</option>
                                        <option value="konsumsi">Konsumsi</option>
                                    </select>
                                </div>
                                <div class="mb-1">
                                    <label class="form-label m-0" for="varietas_jagung" style="font-size: 14px">varietas jagung</label>
                                    <input class="form-control form-control-sm" id="varietas_jagung" name="varietas_jagung" type="text" placeholder="Masukkan varietas jagung" />
                                </div>
                                <div class="mb-1">
                                    <label class="form-label m-0" for="kontak" style="font-size: 14px">Kontak</label>
                                    <input class="form-control form-control-sm" id="kontak" name="kontak" type="text" placeholder="Masukkan yang dapat dihubungi" />
                                </div>

                                <div class="mb-1 mt-2">
                                    <button class="btn btn-sm btn-primary" id="saveFeatureProperties" type="submit" role="button">Simpan</button>
                                    <button class="btn btn-sm btn-secondary" id="batalFeatureProperties" type="reset" role="button">Batal</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection


@push("javascript")
    <script src={{ asset("assets/js/dataNDVI.js") }}></script>
    <script src={{ asset("assets/js/dataNDMI.js") }}></script>
    <script src={{ asset("assets/js/dataMETHANE.js") }}></script>
@endpush
