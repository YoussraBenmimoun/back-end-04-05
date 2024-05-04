<?php

namespace App\Models;

use App\Models\Car;
use App\Models\Bill;
use App\Models\Room;
use App\Models\Tour;
use App\Models\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = ['start_date','end_date','nbr_people','reservation_date_restaurant','table_id','client_id'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    public function table()
    {
        return $this->belongsTo(Table::class);
    }
    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    public function offer(){
        return $this->belongsTo(Offer::class);
    }

    public function bill(){
        return $this->belongsTo(Bill::class);
    }
}
