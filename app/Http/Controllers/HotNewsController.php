<?php

namespace App\Http\Controllers;

use App\Models\HotNews;
use App\Models\News;
use App\Models\Status;
use App\Models\Advertisement;
use Illuminate\Http\Request;
use Carbon\Carbon;

class HotNewsController extends Controller
{
    public function index()
    {
        $hotNewsLimit = HotNews::with(['news'])->limit(3)->get();
        $news = HotNews::all();
        $topAdvertisement = Advertisement::where('awalTampil', Carbon::now()->format('Y-m-d'))->where('posisi', 'top')
        ->first();
        $leftAdvertisement = Advertisement::where('awalTampil', Carbon::now()->format('Y-m-d'))->where('posisi', 'left')
        ->first();
        $rightAdvertisement = Advertisement::where('awalTampil', Carbon::now()->format('Y-m-d'))->where('posisi', 'right')
        ->first();
        $middleAdvertisement = Advertisement::where('awalTampil', Carbon::now()->format('Y-m-d'))->where('posisi', 'middle')
        ->first();
        return view('hotNews.hotNews', compact('hotNewsLimit', 'news', 'topAdvertisement', 'leftAdvertisement', 'rightAdvertisement', 'middleAdvertisement'));
    }

    public function show($slug)
    {
        $hotNewsLimit = HotNews::with(['news'])->limit(3)->get();
        $news = News::where('slug', $slug)->first();
        $newsLimit = HotNews::orderByDesc('created_at')->limit(3)->get();
        $newsLimitAll = HotNews::orderByDesc('created_at')->offset(3)->limit(12)->get();
        $topAdvertisement = Advertisement::where('awalTampil', Carbon::now()->format('Y-m-d'))->where('posisi', 'top')
        ->first();
        $leftAdvertisement = Advertisement::where('awalTampil', Carbon::now()->format('Y-m-d'))->where('posisi', 'left')
        ->first();
        $rightAdvertisement = Advertisement::where('awalTampil', Carbon::now()->format('Y-m-d'))->where('posisi', 'right')
        ->first();
        $middleAdvertisement = Advertisement::where('awalTampil', Carbon::now()->format('Y-m-d'))->where('posisi', 'middle')
        ->first();
        return view('hotNews.view', compact('hotNewsLimit', 'news', 'newsLimit', 'newsLimitAll', 'topAdvertisement', 'leftAdvertisement', 'rightAdvertisement', 'middleAdvertisement'));
    }
}
