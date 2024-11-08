<?php

namespace App\Http\Controllers;

use App\Models\LahanKebun;
use App\Models\LahanReviewed;
use Illuminate\Http\Request;

class LahanReviewedController extends Controller
{
    public function index()
    {
        $data = LahanReviewed::all();

        return response()->json($data);
    }

    public function verify(LahanKebun $lahan)
    {
        if (LahanReviewed::where('lahan_kebun_id', $lahan->id)->update(['reviewed' => 1])) {
            return redirect()->route('admin.lahan.index')->with('success', 'Data berhasil diverifikasi');
        } else {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memverifikasi data');
        }
    }
}
