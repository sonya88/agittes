<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;

class SalesController extends Controller
{
    public function salesSummary()
    {
        $sales = DB::table('sales')
            ->select('item', DB::raw('SUM(revenue) as revenue'))
            ->groupBy('item')
            ->get();

        return response()->json(['status' => 'OK', 'items' => $sales]);
    }
    public function index2()
    {
        Artisan::call('data:fetch');

        return response()->json([
            'result' => Artisan::output(),
        ]);
    }
}
