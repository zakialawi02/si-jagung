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
                    <button class="position-relative" id="layerControlBtn">Layer <i class="bi bi-layout-sidebar"></i><i class="bi bi-arrow-bar-right"></i></button>
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
                            <div class="position-relative w-100 align-content-start" id="informationPopupTitle">
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
                            <div class="position-relative w-100 align-content-start" id="informationPopupTitle">
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
                <div class="layerControl align-self-end" id="layerControl">
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
