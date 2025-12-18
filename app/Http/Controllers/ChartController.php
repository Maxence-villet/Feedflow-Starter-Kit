<?php

namespace App\Http\Controllers;

use App\Models\SurveyAnswer;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ChartController extends Controller
{
    public function index()
    {
        $surveyCounts = SurveyAnswer::getData();
        $chartLabels = [];
        $chartData = [];

        $startOfWeek = Carbon::now()->startOfWeek(); 
        $today = Carbon::now();
        for ($date = $startOfWeek->copy(); $date->lte($today); $date->addDay()) {
            
            $chartLabels[] = ucfirst($date->translatedFormat('l'));
            
            $chartData[] = rand(5, 50); 

            $dateString = $date->format('Y-m-d');
            $dayData = $surveyCounts->where('date', $dateString)->first();
            $chartData[] = $dayData ? $dayData->total : 0;
        }

        return view('dashboard', compact('chartLabels', 'chartData'));
    }
}