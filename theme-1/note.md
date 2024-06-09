### Untuk menggunakan WMS (Web Map Service) Efisien menggunakan ini.

panggil semua layernya di dalam params. maka di web fecthing-nya akan satu kali untuk semua layer yang ada tersebut.

tetapi tidak bisa mengatur layer mana yang ingin ditampilkan (visible:false) dan tidak bisa mengatur urutan layer (zIndex)

```javascript
const ll = new TileLayer({
  source: new TileWMS({
    url: "http://localhost:8080/geoserver/surabaya/wms",
    params: {
      LAYERS: ["surabaya:JALAN_LN_25K", "surabaya:AGRIKEBUN_AR_25K", "surabaya:AGRILADANG_AR_25K", "surabaya:AGRISAWAH_AR_25K", "surabaya:RAWA_AR_25K", "surabaya:BANGUNAN_AR_25K"],
      TILED: true,
      FORMAT: "image/png",
    },
    serverType: "geoserver",
  }),
  opacity: 0.8,
  visible: true,
});
surabayaWMS.getLayers().push(ll);
```

### Contoh penggunaan WMS (Web Map Service) dengan Layer Array

panggil semua layernya di dalam params. maka di web fecthing-nya akan satu kali untuk semua layer yang ada tersebut.

dan mengkali untuk layering

```javascript
// Buat WMS Layer dengan beberapa layer dari GeoServer
const ll = new ol.layer.Tile({
  source: new ol.source.TileWMS({
    url: "http://localhost:8080/geoserver/surabaya/wms",
    params: {
      LAYERS: ["surabaya:BANGUNAN_AR_25K", "surabaya:JALAN_LN_25K", "surabaya:AGRIKEBUN_AR_25K", "surabaya:AGRILADANG_AR_25K", "surabaya:AGRISAWAH_AR_25K"],
      TILED: true,
      FORMAT: "image/png",
    },
    serverType: "geoserver",
  }),
  opacity: 0.8,
  visible: true,
});

// Buat Group Layer untuk Surabaya dan tambahkan WMS Layer ke dalamnya
const surabayaWMS = new ol.layer.Group({
  title: "Surabaya",
  layers: [ll],
});

// Tambahkan Group Layer ke peta
map.addLayer(surabayaWMS);

// Menambahkan event listener untuk checkbox
const checkboxes = document.querySelectorAll(".form-check-input");
checkboxes.forEach((checkbox) => {
  checkbox.addEventListener("change", function () {
    const layerName = this.value;
    const layer = surabayaWMS.getLayers().getArray()[0]; // Ambil Group Layer Surabaya
    const layerWMS = layer.getSource().getParams().LAYERS; // Ambil daftar layer dari parameter LAYERS

    // Perbarui daftar layer terpilih sesuai dengan checkbox yang diubah
    const index = layerWMS.indexOf(layerName);
    console.log(index);
    if (index !== -1) {
      // Jika layer ditemukan dalam daftar LAYERS, sesuaikan statusnya
      if (this.checked) {
        // Tambahkan layer jika checkbox dicentang dan belum ada dalam daftar
        if (layerWMS.indexOf(layerName) === -1) {
          layerWMS.push(layerName);
        }
      } else {
        // Hapus layer jika checkbox tidak dicentang
        layerWMS.splice(index, 1);
      }

      // Perbarui parameter LAYERS pada sumber WMS
      layer.getSource().updateParams({ LAYERS: layerWMS });
    } else {
      // Tambahkan layer jika checkbox dicentang dan belum ada dalam daftar
      if (this.checked) {
        layerWMS.push(layerName);
        layer.getSource().updateParams({ LAYERS: layerWMS });
      }
    }
    layer.getSource().refresh();
  });
});
```

#### html

```html
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="surabaya:BANGUNAN_AR_25K" id="tes-1" checked />
        <label class="form-check-label" for="tes-1"> Layer 1 </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="surabaya:JALAN_LN_25K" id="tes-2" checked />
        <label class="form-check-label" for="tes-2"> Layer 2 </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="surabaya:AGRIKEBUN_AR_25K" id="tes-3" checked />
        <label class="form-check-label" for="tes-3"> Layer 3 </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="surabaya:AGRILADANG_AR_25K" id="tes-4" checked />
        <label class="form-check-label" for="tes-4"> Layer 4 </label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="checkbox" value="surabaya:AGRISAWAH_AR_25K" id="tes-5" checked />
        <label class="form-check-label" for="tes-5"> Layer 5 </label>
      </div>
    </div>
```
