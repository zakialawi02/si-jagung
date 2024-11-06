@extends("layouts.appFrontMap")

@section("title", "Peta | " . config("app.name"))
@section("meta_description", "")
@section("meta_keywords", "")

@section("og_title", config("app.name"))
@section("og_description", "")


@section("content")
    <main class="pt-6">
        <section>
            <div class="position-relative" id="mapWrapper">
                <div id="map"></div>


                <div class="" id="topLeft">
                    <!-- layerControl Button -->
                    <button class="position-relative" id="layerControlBtn"><i class="bi bi-layout-sidebar"></i><i class="bi bi-arrow-bar-right"></i></button>
                </div>

                <div class="" id="bottomLeft">
                    <div class="d-flex align-items-end">
                        <!-- Mouse Position -->
                        <div class="mb-1 position-relative" id="mousePosition"></div>

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
                    <div class="px-2 m-0">
                        <div class="mb-0 d-flex justify-content-between align-items-center" id="informationPopupHeader">
                            <div class="position-relative w-100 align-content-start" id="informationPopupTitle">
                                <h5>Informasi Data Layer</h5>
                                <div class="top-0 p-0 m-0 mt-2 position-absolute end-0 translate-middle-y" id="informationPopupClose">
                                    <button class="btn-close" data-bs-dismiss="offcanvas" type="button" aria-label="Close"></button>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-content-start" id="informationPopupCoordinate">...</div>
                    </div>
                    <div class="p-2" id="informationPopupContent">...</div>
                </div>
            </div>

            <!-- offcanvas layerControl -->
            <div class="position-relative">
                <div class="layerControl align-self-end" id="layerControl">
                    <div class="layerControl-header d-flex justify-content-between align-items-center">
                        <h5 class="px-2 py-1 layerControl-title" id="layerControlTitle"></h5>
                        <button class="p-1 m-1 btn btn-layerControl-close align-self-start" type="button"><i class="bi bi-arrow-bar-left"></i></button>
                    </div>
                    <div class="px-2 py-1 layerControl-body">
                        <div class="layerControl-body">
                            <div class="mb-3 layer">
                                <div class="mt-2 p-1 ml-3">
                                    <p class="mb-1">NDVI</p>
                                </div>
                                @include("components.front.peta._ndviLayers")


                                <div class="mt-2 p-1 ml-3">
                                    <p class="mb-1">NDMI</p>
                                </div>
                                @include("components.front.peta._ndmiLayers")


                                <div class="mt-2 p-1 ml-3">
                                    <p class="mb-1">Methane</p>
                                </div>
                                @include("components.front.peta._methaneLayers")


                            </div>

                            <div class="mb-3" id="basemap-select">
                                <select class="" id="basemap" name="basemap">
                                    <option value="osm">Street OSM</option>
                                    <option value="bingaerial" selected>Bing Aerial</option>
                                    <option value="mapbox">Street Mapbox</option>
                                </select>
                            </div>
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
