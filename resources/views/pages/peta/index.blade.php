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
                                <div class="form-check">
                                    <input class="form-check-input" id="ndvi-2021-1" type="checkbox" value="si-jagung:2021-01-03-00_00_2021-01-03-23_59_Sentinel-2_L1C_NDVI" checked />
                                    <label class="form-check-label" for="ndvi-2021-1">NDVI Januari 2021</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="ndvi-2021-2" type="checkbox" value="si-jagung:2021-03-19-00_00_2021-03-19-23_59_Sentinel-2_L1C_NDVI" />
                                    <label class="form-check-label" for="ndvi-2021-2">NDVI Maret 2021</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="ndvi-2021-3" type="checkbox" value="si-jagung:2021-04-23-00_00_2021-04-23-23_59_Sentinel-2_L1C_NDVI" />
                                    <label class="form-check-label" for="ndvi-2021-3">NDVI April 2021</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="ndvi-2021-4" type="checkbox" value="si-jagung:2021-05-18-00_00_2021-05-18-23_59_Sentinel-2_L1C_NDVI" />
                                    <label class="form-check-label" for="ndvi-2021-4">NDVI Mei 2021</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="ndvi-2021-5" type="checkbox" value="si-jagung:2021-06-07-00_00_2021-06-07-23_59_Sentinel-2_L1C_NDVI" />
                                    <label class="form-check-label" for="ndvi-2021-5">NDVI Juni 2021</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="ndvi-2021-6" type="checkbox" value="si-jagung:2021-07-27-00_00_2021-07-27-23_59_Sentinel-2_L1C_NDVI" />
                                    <label class="form-check-label" for="ndvi-2021-6">NDVI Juli 2021</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="ndvi-2021-7" type="checkbox" value="si-jagung:2021-08-06-00_00_2021-08-06-23_59_Sentinel-2_L1C_NDVI" />
                                    <label class="form-check-label" for="ndvi-2021-7">NDVI Agustus 2021</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="ndvi-2021-8" type="checkbox" value="si-jagung:2021-09-10-00_00_2021-09-10-23_59_Sentinel-2_L1C_NDVI" />
                                    <label class="form-check-label" for="ndvi-2021-8">NDVI September 2021</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="ndvi-2021-9" type="checkbox" value="si-jagung:2021-10-05-00_00_2021-10-05-23_59_Sentinel-2_L1C_NDVI" />
                                    <label class="form-check-label" for="ndvi-2021-9">NDVI Oktober 2021</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="ndvi-2021-10" type="checkbox" value="si-jagung:2021-11-09-00_00_2021-11-09-23_59_Sentinel-2_L1C_NDVI" />
                                    <label class="form-check-label" for="ndvi-2021-10">NDVI November 2021</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="ndvi-2021-11" type="checkbox" value="si-jagung:2021-12-19-00_00_2021-12-19-23_59_Sentinel-2_L1C_NDVI" />
                                    <label class="form-check-label" for="ndvi-2021-11">NDVI Desember 2021</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" id="ndvi-2022-1" type="checkbox" value="si-jagung:2022-01-03-00_00_2022-01-03-23_59_Sentinel-2_L1C_NDVI" />
                                    <label class="form-check-label" for="ndvi-2022-1">NDVI Januari 2022</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="ndvi-2022-2" type="checkbox" value="si-jagung:2022-02-02-00_00_2022-02-02-23_59_Sentinel-2_L1C_NDVI" />
                                    <label class="form-check-label" for="ndvi-2022-2">NDVI Februari 2022</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="ndvi-2022-3" type="checkbox" value="si-jagung:2022-03-04-00_00_2022-03-04-23_59_Sentinel-2_L1C_NDVI" />
                                    <label class="form-check-label" for="ndvi-2022-3">NDVI Maret 2022</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="ndvi-2022-4" type="checkbox" value="si-jagung:2022-04-03-00_00_2022-04-03-23_59_Sentinel-2_L1C_NDVI" />
                                    <label class="form-check-label" for="ndvi-2022-4">NDVI April 2022</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="ndvi-2022-5" type="checkbox" value="si-jagung:2022-05-13-00_00_2022-05-13-23_59_Sentinel-2_L1C_NDVI" />
                                    <label class="form-check-label" for="ndvi-2022-5">NDVI Mei 2022</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="ndvi-2022-6" type="checkbox" value="si-jagung:2022-06-02-00_00_2022-06-02-23_59_Sentinel-2_L1C_NDVI" />
                                    <label class="form-check-label" for="ndvi-2022-6">NDVI Juni 2022</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="ndvi-2022-7" type="checkbox" value="si-jagung:2022-07-07-00_00_2022-07-07-23_59_Sentinel-2_L1C_NDVI" />
                                    <label class="form-check-label" for="ndvi-2022-7">NDVI Juli 2022</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="ndvi-2022-8" type="checkbox" value="si-jagung:2022-08-01-00_00_2022-08-01-23_59_Sentinel-2_L1C_NDVI" />
                                    <label class="form-check-label" for="ndvi-2022-8">NDVI Agustus 2022</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="ndvi-2022-10" type="checkbox" value="si-jagung:2022-10-30-00_00_2022-10-30-23_59_Sentinel-2_L1C_NDVI" />
                                    <label class="form-check-label" for="ndvi-2022-10">NDVI Oktober 2022</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="ndvi-2022-11" type="checkbox" value="si-jagung:2022-11-04-00_00_2022-11-04-23_59_Sentinel-2_L1C_NDVI" />
                                    <label class="form-check-label" for="ndvi-2022-11">NDVI November 2022</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="ndvi-2022-12" type="checkbox" value="si-jagung:2022-12-09-00_00_2022-12-09-23_59_Sentinel-2_L1C_NDVI" />
                                    <label class="form-check-label" for="ndvi-2022-12">NDVI Desember 2022</label>
                                </div>


                                <div class="mt-2 p-1 ml-3">
                                    <p class="mb-1">NDMI</p>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" id="moisture-1" type="checkbox" value="si-jagung:2021-01-03-00_00_2021-01-03-23_59_Sentinel-2_L1C_Moisture_index" checked />
                                    <label class="form-check-label" for="moisture-1">Moisture Index Januari 2021</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="moisture-2" type="checkbox" value="si-jagung:2021-03-19-00_00_2021-03-19-23_59_Sentinel-2_L1C_Moisture_index" />
                                    <label class="form-check-label" for="moisture-2">Moisture Index Maret 2021</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="moisture-3" type="checkbox" value="si-jagung:2021-04-23-00_00_2021-04-23-23_59_Sentinel-2_L1C_Moisture_index" />
                                    <label class="form-check-label" for="moisture-3">Moisture Index April 2021</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="moisture-4" type="checkbox" value="si-jagung:2021-05-18-00_00_2021-05-18-23_59_Sentinel-2_L1C_Moisture_index" />
                                    <label class="form-check-label" for="moisture-4">Moisture Index Mei 2021</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="moisture-5" type="checkbox" value="si-jagung:2021-06-07-00_00_2021-06-07-23_59_Sentinel-2_L1C_Moisture_index" />
                                    <label class="form-check-label" for="moisture-5">Moisture Index Juni 2021</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="moisture-6" type="checkbox" value="si-jagung:2021-07-27-00_00_2021-07-27-23_59_Sentinel-2_L1C_Moisture_index" />
                                    <label class="form-check-label" for="moisture-6">Moisture Index Juli 2021</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="moisture-7" type="checkbox" value="si-jagung:2021-08-06-00_00_2021-08-06-23_59_Sentinel-2_L1C_Moisture_index" />
                                    <label class="form-check-label" for="moisture-7">Moisture Index Agustus 2021</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="moisture-8" type="checkbox" value="si-jagung:2021-09-10-00_00_2021-09-10-23_59_Sentinel-2_L1C_Moisture_index" />
                                    <label class="form-check-label" for="moisture-8">Moisture Index September 2021</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="moisture-9" type="checkbox" value="si-jagung:2021-10-05-00_00_2021-10-05-23_59_Sentinel-2_L1C_Moisture_index" />
                                    <label class="form-check-label" for="moisture-9">Moisture Index Oktober 2021</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="moisture-10" type="checkbox" value="si-jagung:2021-11-09-00_00_2021-11-09-23_59_Sentinel-2_L1C_Moisture_index" />
                                    <label class="form-check-label" for="moisture-10">Moisture Index November 2021</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="moisture-11" type="checkbox" value="si-jagung:2021-12-19-00_00_2021-12-19-23_59_Sentinel-2_L1C_Moisture_index" />
                                    <label class="form-check-label" for="moisture-11">Moisture Index Desember 2021</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" id="moisture-2022-1" type="checkbox" value="si-jagung:2022-01-03-00_00_2022-01-03-23_59_Sentinel-2_L1C_Moisture_index" />
                                    <label class="form-check-label" for="moisture-2022-1">Moisture Index Januari 2022</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="moisture-2022-2" type="checkbox" value="si-jagung:2022-02-02-00_00_2022-02-02-23_59_Sentinel-2_L1C_Moisture_index" />
                                    <label class="form-check-label" for="moisture-2022-2">Moisture Index Februari 2022</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="moisture-2022-3" type="checkbox" value="si-jagung:2022-03-04-00_00_2022-03-04-23_59_Sentinel-2_L1C_Moisture_index" />
                                    <label class="form-check-label" for="moisture-2022-3">Moisture Index Maret 2022</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="moisture-2022-4" type="checkbox" value="si-jagung:2022-04-03-00_00_2022-04-03-23_59_Sentinel-2_L1C_Moisture_index" />
                                    <label class="form-check-label" for="moisture-2022-4">Moisture Index April 2022</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="moisture-2022-5" type="checkbox" value="si-jagung:2022-05-13-00_00_2022-05-13-23_59_Sentinel-2_L1C_Moisture_index" />
                                    <label class="form-check-label" for="moisture-2022-5">Moisture Index Mei 2022</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="moisture-2022-6" type="checkbox" value="si-jagung:2022-06-02-00_00_2022-06-02-23_59_Sentinel-2_L1C_Moisture_index" />
                                    <label class="form-check-label" for="moisture-2022-6">Moisture Index Juni 2022</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="moisture-2022-7" type="checkbox" value="si-jagung:2022-07-07-00_00_2022-07-07-23_59_Sentinel-2_L1C_Moisture_index" />
                                    <label class="form-check-label" for="moisture-2022-7">Moisture Index Juli 2022</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="moisture-2022-8" type="checkbox" value="si-jagung:2022-08-01-00_00_2022-08-01-23_59_Sentinel-2_L1C_Moisture_index" />
                                    <label class="form-check-label" for="moisture-2022-8">Moisture Index Agustus 2022</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="moisture-2022-10" type="checkbox" value="si-jagung:2022-10-30-00_00_2022-10-30-23_59_Sentinel-2_L1C_Moisture_index" />
                                    <label class="form-check-label" for="moisture-2022-10">Moisture Index Oktober 2022</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="moisture-2022-11" type="checkbox" value="si-jagung:2022-11-04-00_00_2022-11-04-23_59_Sentinel-2_L1C_Moisture_index" />
                                    <label class="form-check-label" for="moisture-2022-11">Moisture Index November 2022</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="moisture-2022-12" type="checkbox" value="si-jagung:2022-12-09-00_00_2022-12-09-23_59_Sentinel-2_L1C_Moisture_index" />
                                    <label class="form-check-label" for="moisture-2022-12">Moisture Index Desember 2022</label>
                                </div>



                                <div class="mt-2 p-1 ml-3">
                                    <p class="mb-1">Methane</p>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" id="metana-1" type="checkbox" value="si-jagung:Metana Januari 2022" />
                                    <label class="form-check-label" for="metana-1"> Metana Januari 2022 </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="metana-2" type="checkbox" value="si-jagung:Metana Februari 2022" />
                                    <label class="form-check-label" for="metana-2"> Metana Februari 2022 </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="metana-3" type="checkbox" value="si-jagung:Metana Maret 2022" />
                                    <label class="form-check-label" for="metana-3"> Metana Maret 2022 </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="metana-4" type="checkbox" value="si-jagung:Metana April 2022" />
                                    <label class="form-check-label" for="metana-4"> Metana April 2022 </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="metana-5" type="checkbox" value="si-jagung:Metana Mei 2022" />
                                    <label class="form-check-label" for="metana-5"> Metana Mei 2022 </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="metana-6" type="checkbox" value="si-jagung:Metana Juni 2022" />
                                    <label class="form-check-label" for="metana-6"> Metana Juni 2022 </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="metana-7" type="checkbox" value="si-jagung:Metana Juli 2022" />
                                    <label class="form-check-label" for="metana-7"> Metana Juli 2022 </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="metana-8" type="checkbox" value="si-jagung:Metana Agustus 2022" />
                                    <label class="form-check-label" for="metana-8"> Metana Agustus 2022 </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="metana-9" type="checkbox" value="si-jagung:Metana Oktober 2022" />
                                    <label class="form-check-label" for="metana-9"> Metana Oktober 2022 </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="metana-12" type="checkbox" value="si-jagung:Metana September 2023" />
                                    <label class="form-check-label" for="metana-12"> Metana September 2023 </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="metana-10" type="checkbox" value="si-jagung:Metana November 2022" />
                                    <label class="form-check-label" for="metana-10"> Metana November 2022 </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" id="metana-11" type="checkbox" value="si-jagung:Metana Desember 2022" />
                                    <label class="form-check-label" for="metana-11"> Metana Desember 2022 </label>
                                </div>



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
