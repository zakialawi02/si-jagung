@extends("layouts.app")

@section("title", "Dashboard | " . config("app.name"))
@section("meta_description", "")


@push("css")
    {{-- code here --}}
@endpush

@section("content")
    <div class="d-flex justify-content-between align-items-center grid-margin flex-wrap">
        <div>
            <h4 class="mb-md-0 mb-3">Dasbor</h4>
        </div>
        <div class="d-flex align-items-center text-nowrap flex-wrap"></div>
    </div>

    <div class="row">
        <div class="col-lg-7 col-xl-8 grid-margin">
            <div class="card">
                <div class="px-3 pt-3">
                    <h5>Data Masuk | <span class="text-muted">Data ajuan baru</span></h5>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table-hover mb-0 table">
                            <thead>
                                <tr>
                                    <th class="pt-0">#</th>
                                    <th class="pt-0">Tgl. Input</th>
                                    <th class="pt-0">Nama Pemilik</th>
                                    <th class="pt-0">Luasan</th>
                                    <th class="pt-0">Jenis Jangung</th>
                                    <th class="pt-0">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($lahan->where('reviewed.reviewed', 0) as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->created_at->format("d M Y") }}</td>
                                        <td>{{ $item->nama_pemilik }}</td>
                                        <td>{{ number_format((float) $item->luas / 10000, 5, ",", ".") }} Ha</td>
                                        <td>{{ $item->jenis_jagung }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a class="btn btn-sm btn-info" href="{{ route("admin.lahan.show", $item->id) }}">Lihat</a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="6">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="d-flex justify-content-end m-3 p-3">
                    <a class="btn btn-primary" href="{{ route("admin.lahan.indexNew") }}">Lihat Semua</a>
                </div>
            </div>
        </div>

        <div class="col-lg-5 col-xl-4 grid-margin d-lg-block d-none">
            <div class="card">
                <div class="px-3 pt-3">
                    <h5>Pengguna | <span class="text-muted">30 hari terakhir</span></h5>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table-hover mb-0 table">
                            <thead>
                                <tr>
                                    <th class="pt-0">Username</th>
                                    <th class="pt-0">Tgl. Daftar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->created_at->format("d M Y") }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan="2">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="d-flex justify-content-end m-3 p-3">
                    <a class="btn btn-primary" href="{{ route("admin.users.index") }}">Lihat Semua</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="card">
            <div class="px-3 pt-3">
                <h5>Data Lahan Kebun | <span class="text-muted">Semua data terbaru</span></h5>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table-hover mb-0 table">
                        <thead>
                            <tr>
                                <th class="pt-0">#</th>
                                <th class="pt-0">Tgl. Input</th>
                                <th class="pt-0">Nama Pemilik</th>
                                <th class="pt-0">Luasan</th>
                                <th class="pt-0">Jenis Jangung</th>
                                <th class="pt-0">Status</th>
                                <th class="pt-0">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($lahan as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->created_at->format("d M Y") }}</td>
                                    <td>{{ $item->nama_pemilik }}</td>
                                    <td>{{ number_format((float) $item->luas / 10000, 5, ",", ".") }} Ha</td>
                                    <td>{{ $item->jenis_jagung }}</td>
                                    <td>
                                        <span class="badge {{ $item->reviewed->reviewed ? "bg-success" : "bg-warning" }}">
                                            {{ $item->reviewed->reviewed ? "Telah ditinjau" : "Belum ditinjau" }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a class="btn btn-sm btn-info" href="{{ route("admin.lahan.show", $item->id) }}">Lihat</a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="6">Tidak ada data</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="d-flex justify-content-end m-3 p-3">
                <a class="btn btn-primary" href="{{ route("admin.lahan.index") }}">Lihat Semua</a>
            </div>
        </div>
    </div>
@endsection


@push("javascript")
    {{-- code here --}}
@endpush
