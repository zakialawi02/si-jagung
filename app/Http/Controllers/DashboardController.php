<?php

namespace App\Http\Controllers;

use App\Models\LahanKebun;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::check() && Auth::user()->role === 'admin') {
            $lahan =  LahanKebun::with('user', 'reviewed')->orderBy('created_at', 'desc')->orderBy('created_at', 'desc')->limit(5)->get();
            $users = User::whereBetween('created_at', [now()->subDays(30), now()])
                ->orderBy('created_at', 'desc')->limit(5)->get();

            return view('pages.back.dashboard', compact('lahan', 'users'));
        } else if (Auth::check() && Auth::user()->role === 'user') {
            $lahan =  LahanKebun::with('user', 'reviewed')->where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->orderBy('created_at', 'desc')->get();

            if (request()->ajax()) {
                return datatables()->of($lahan)
                    ->addIndexColumn()
                    ->addColumn('action', function ($data) {
                        return '<button type="submit" class="btn btn-sm btn-danger deleteRowData" data-id="' . $data->id . ' "><span class="mdi mdi-trash-can-outline"></span></button>';
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

            return view('pages.back.dashboardUser');
        } else {
            return redirect('/')->with('status', 'You are not authorized to access this page.');
        }
    }
}
