<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Offer;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BillController extends Controller
{
    // public function event(){
    //     $reservations_by_host = Reservation::join('offers', 'reservations.offer_id', '=', 'offers.id')
    //         ->select('offers.host_id', DB::raw('count(*) as reservation_count'))
    //         ->whereMonth('reservations.created_at', now()->month)
    //         ->whereYear('reservations.created_at', now()->year)
    //         ->groupBy('offers.host_id')
    //         ->get();

    //     foreach ($reservations_by_host as $bill_data) {
    //         $host_id = $bill_data->host_id;
    //         $reservation_count = $bill_data->reservation_count;

    //         $total = $reservation_count*10; 

    //         Bill::create([
    //             'host_id' => $host_id,
    //             'total' => $total,
    //         ]);

    //         // Reservation::where('offer_id', function ($query) use ($host_id) {
    //         //     $query->select('id')
    //         //         ->from('offers')
    //         //         ->where('host_id', $host_id);
    //         // })->update(['billed' => true]);
            
    //         $offerIds = Offer::where('host_id', $host_id)->pluck('id');
    //         Reservation::whereIn('offer_id', $offerIds)->update(['billed' => true]);
    //     }
    //     return response()->json(['message' => "Event réalisé"]);
    // }

    public function show($id){
        $bill = Bill::find($id);
        $bill->host = $bill->host;
        return response()->json(["bill" => $bill]);
    }
}
