<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $today = Carbon::today()->toDateString();
        $beritas = Berita::where(function ($query) use ($today) {
            $query->whereNull('start_date')
                ->orWhere('start_date', '<=', $today);
        })
            ->where(function ($query) use ($today) {
                $query->whereNull('end_date')
                    ->orWhere('end_date', '>=', $today);
            })
            ->latest()
            ->get();

        return view('berita.index', compact('beritas'));
    }
    public function show($id)
    {
        $berita = Berita::findOrFail($id);

        return view('berita.detail', compact('berita'));
    }
}
