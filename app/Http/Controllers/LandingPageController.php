<?php

namespace App\Http\Controllers;

use App\Models\InternBatche;
use App\Models\InternPositionBatche;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Nnjeim\World\Models\Country;

class LandingPageController extends Controller
{
    public function index()
    {
        $internBatches = DB::table('intern_batches')
            ->select('id', 'name_intern_batches', 'description_intern_batches', 'slug_intern_batches', 'start_date_intern_batches', 'end_date_intern_batches', 'status_intern_batches')
            ->get();

        $internPositionBatch = InternPositionBatche::with('internPosition', 'internBatch', 'internLocation')
            ->where('status_intern_position_batches', 'active')
            ->get();

        // Ambil ID batch yang punya posisi aktif
        $batchesWithPositions = $internPositionBatch->pluck('internBatch.id')->unique()->toArray();

        // Filter internBatches supaya cuma yang ada posisi aktif
        $filteredInternBatches = $internBatches->filter(function ($batch) use ($batchesWithPositions) {
            return in_array($batch->id, $batchesWithPositions);
        });

        // Batasi internship yang mau ditampilkan (misal limit 6)
        $internPositionBatchLimited = $internPositionBatch->take(6);

        // Total semua internship untuk kondisi "See More"
        $totalInternships = $internPositionBatch->count();

        $province = Province::select('id', 'name')->get();
        $countries = Country::select('id', 'name')->get();

        return view('landing-page', [
            'internBatches' => $internBatches,
            'filteredInternBatches' => $filteredInternBatches,
            'internPositionBatch' => $internPositionBatchLimited,
            'totalInternships' => $totalInternships,
            'provinces' => $province,
            'countries' => $countries
        ]);
    }



    public function detailBatchInternship($slug)
    {
        $internBatch = InternBatche::where('slug_intern_batches', $slug)->firstOrFail();
        return view('detail-batch-internship', compact('internBatch'));
    }
}
