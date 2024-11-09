<?php

namespace App\Http\Controllers;

use App\Models\LahanKebun;
use App\Models\LahanReviewed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LahanKebunController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Lahan Kebun',
            'kebun' => LahanKebun::with('user', 'reviewed')->orderBy('created_at', 'desc')->get()
        ];

        if (request()->ajax()) {
            return datatables()->of($data['kebun'])
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return '<a href="' . route('admin.lahan.show', $data->id) . '" class="btn btn-sm btn-info"><span class="mdi mdi-file-eye-outline"></span></a>
                    <button type="submit" class="btn btn-sm btn-danger deleteRowData" data-id="' . $data->id . ' "><span class="mdi mdi-trash-can-outline"></span></button>';
                })
                ->editColumn('luas', function ($data) {
                    return number_format($data->luas / 10000, 5, ',', '.') . ' Ha';
                })
                ->editColumn('jumlah_produksi', function ($data) {
                    return number_format($data->jumlah_produksi, 3, ',', '.') . ' Kg';
                })
                ->editColumn('reviewed', function ($data) {
                    return $data->reviewed->reviewed ? '<span class="badge bg-success">Sudah Diperiksa</span>' : '<span class="badge bg-danger">Belum Diperiksa</span>';
                })
                ->editColumn('created_at', function ($data) {
                    return $data->created_at ? $data->created_at->format("d M Y H:i") : '-';
                })
                ->rawColumns(['action', 'reviewed'])
                ->make(true);
        }

        return view('pages.back.lahan.index', compact('data',));
    }

    public function indexNew()
    {
        $data = [
            'title' => 'Data Masuk | Data Lahan Kebun',
            'kebun' => LahanKebun::with('user', 'reviewed')->whereHas('reviewed', function ($q) {
                $q->where('reviewed', 0);
            })->orderBy('created_at', 'desc')->get()
        ];

        if (request()->ajax()) {
            return datatables()->of($data['kebun'])
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    return '<a href="' . route('admin.lahan.show', $data->id) . '" class="btn btn-sm btn-info"><span class="mdi mdi-file-eye-outline"></span></a>
                    <button type="submit" class="btn btn-sm btn-danger deleteRowData" data-id="' . $data->id . ' "><span class="mdi mdi-trash-can-outline"></span></button>';
                })
                ->editColumn('luas', function ($data) {
                    return number_format($data->luas / 10000, 5, ',', '.') . ' Ha';
                })
                ->editColumn('jumlah_produksi', function ($data) {
                    return number_format($data->jumlah_produksi, 3, ',', '.') . ' Kg';
                })
                ->editColumn('created_at', function ($data) {
                    return $data->created_at ? $data->created_at->format("d M Y H:i") : '-';
                })
                ->rawColumns(['action', 'reviewed'])
                ->make(true);
        }

        return view('pages.back.lahan.dataBaru', compact('data'));
    }

    public function show(LahanKebun $lahan)
    {
        $lahan->load('reviewed', 'user');
        $data = [
            'title' => 'Detail Lahan',
            'lahan' => $lahan
        ];

        return view('pages.back.lahan.showDetail', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_kebun' => 'required',
            'nama_pemilik' => 'required|min:2',
            'luas' => 'required|numeric',
            'jumlah_produksi' => 'required|numeric',
            'jenis_jagung' => 'required|in:pakan,konsumsi',
            'varietas_jagung' => 'required|min:2',
            'geom' => 'required'
        ]);

        try {
            $lahan = LahanKebun::create([
                'user_id' => Auth::id(),
                'no_kebun' => $request->no_kebun,
                'nama_pemilik' => $request->nama_pemilik,
                'luas' => $request->luas,
                'jumlah_produksi' => $request->jumlah_produksi,
                'jenis_jagung' => $request->jenis_jagung,
                'varietas_jagung' => $request->varietas_jagung,
                'geom' => DB::raw("ST_GeomFromGeoJSON('{$request->geom}')")
            ]);

            LahanReviewed::create([
                'lahan_kebun_id' => $lahan->id,
                'reviewed' => 0
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'geojson' => $request->geom,
                'message' => 'Terjadi kesalahan saat menyimpan data',
                'error' => $e
            ], 400);
        }
    }

    public function destroy(LahanKebun $lahan)
    {
        try {
            $lahan->delete();
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil di hapus'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus data',
                'error' => $e
            ], 400);
        }
    }
}
