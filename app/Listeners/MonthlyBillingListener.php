<?php

namespace App\Listeners;

use App\Models\Bill;
use App\Models\Host;
use App\Models\User;
use App\Models\Offer;
use App\Models\Reservation;
use Illuminate\Support\Facades\DB;
use App\Events\MonthlyBillingEvent;
use App\Notifications\BillNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class MonthlyBillingListener implements ShouldQueue
{


    public function handle(MonthlyBillingEvent $event): void
    {
        $reservations_by_host = Reservation::join('offers', 'reservations.offer_id', '=', 'offers.id')
            ->select('offers.host_id', DB::raw('count(*) as reservation_count'))
            ->whereMonth('reservations.start_date', now()->month)
            ->whereYear('reservations.start_date', now()->subMonth()->year)
            ->groupBy('offers.host_id')
            ->get();

        foreach ($reservations_by_host as $bill_data) {
            $host_id = $bill_data->host_id;
            $reservation_count = $bill_data->reservation_count;

            $total = $reservation_count * 10;

            $bill = Bill::create([
                'host_id' => $host_id,
                'total' => $total,
            ]);

            $offerIds = Offer::where('host_id', $host_id)->pluck('id');
            Reservation::whereIn('offer_id', $offerIds)->update(['billed' => true]);

            $host = Host::find($host_id); 
            $user = $host->user;
            Notification::send($user,new BillNotification($bill));
            // $host->notify(new BillNotification($bill));
        }
        info("Reservation of " . now()->subMonth()->format('m/Y') . " billed");
    }
}
