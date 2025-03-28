<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{
    News, Complaint, Letter, Citizen, VillageOfficial, 
    VillageProfile, PublicService, Umkm, Finance, Event,Gallery,
};
use App\Models\Statistics\{
    Population,
    Apbdes,
    Idm,
    Sdgs,
};
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        // Tidak perlu middleware di sini karena sudah ditangani di route group
    }

    public function index()
    {
        // Data Berita Terbaru
        $latestNews = News::latest()
            ->take(5)
            ->get();

        // Data Pejabat
        $officials = VillageOfficial::latest()
            ->take(6)
            ->get();

        // Data UMKM
        $umkm = Umkm::latest()
            ->take(6)
            ->get();

        // Data Galeri
        $gallery = VillageProfile::latest()
            ->take(6)
            ->get();


        $totalPenduduk = Population::sum('laki_laki') + Population::sum('perempuan');
        $totalApbdes = Apbdes::where('tahun', date('Y'))->sum('pendapatan');
        $statusIdm = Idm::where('tahun', date('Y'))->first()->status ?? 'Belum ada data';
        $totalGoalsTercapai = Sdgs::where('tahun', date('Y'))->first()->summary['tercapai'] ?? 0;

        return view('admin.dashboard', compact(
            'latestNews', 'officials', 'umkm', 'gallery',
      

            'totalPenduduk', 'totalApbdes', 'statusIdm', 'totalGoalsTercapai'
        ));
    }
} 