<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\Restaurant;
use App\Models\City;
use App\Models\Cuisine;
use App\Models\Cbrand;
use App\Models\Cmodel;
use App\Models\Car;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\Roomtype;
use App\Models\Tour;
use App\Models\Staff;
use App\Models\Activity;
use App\Models\Transporation;









use App\Models\Host;
use App\Models\Image;
use App\Models\Reservation;
use App\Models\Table;






class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($hostId)
    {
        // Récupérer l'hôte associé à l'ID fourni
        $hostId = 6;
        $host = Host::findOrFail($hostId);

        // Récupérer les offres de cet hôte avec les images associées
        $offers = $host->offers()->with('images')->get();

        // Retourner les offres en tant que réponse JSON
        return response()->json($offers);
    }


    public function storeHotel(Request $request)
    {
        //$hostId = Auth::user()->host->id;

        $hotelData = $request->input('hotel');
        $type = $request->input('type');
        $roomsData = $request->input('rooms');

        $city = City::where('name', $hotelData['city_name'])->firstOrFail();

        $hotel = Hotel::create([
            'name' => $hotelData['name'],
            'address' => $hotelData['address'],
            'nbr_stars' => $hotelData['nbr_stars'],
            'description' => $hotelData['description'],
            'city_id' => $city->id,
        ]);

        $createdRooms = [];

        foreach ($roomsData as $roomData) {
            $roomType = Roomtype::where('name', $roomData['typeRoName'])->firstOrFail();

            $room = Room::create([
                'hotel_id' => $hotel->id,
                'roomtype_id' => $roomType->id,
                'nbr_beds' => $roomData['nbrBeds'],
                'price_per_night' => $roomData['priceDay'],
                'description' => $roomData['descriptionRo'],
            ]);

            $createdRooms[] = $room;
        }

        $offer = Offer::create([
            'type' => $type,
            'hotel_id' => $hotel->id,
            'host_id' => '6',
        ]);

        return response()->json([
            'hotel' => $hotel,
            'rooms' => $createdRooms,
            'offer' => $offer
        ], 201);
    }


    public function storeTour(Request $request)
    {
        $tourData = $request->input('tours');
        $staffData = $request->input('staffs');
        $transData = $request->input('transportations');
        $actvData = $request->input('activities');
        $type = $request->input('type');

        $tour = Tour::create([
            'name' => $tourData['name'],
            'description' => $tourData['description'],
            'start_date' => $tourData['startDate'],
            'end_date' => $tourData['endDate'],
            'nbr_people' => $tourData['nbrPeople'],
            'price_per_person' => $tourData['pricePerson'],
        ]);

        if (isset($tourData['selectedCities'])) {
            $tour->cities()->sync($tourData['selectedCities']);
        }

        if (isset($staffData)) {
            foreach ($staffData as $staff) {
                Staff::create([
                    'first_name' => $staff['first_name'],
                    'last_name' => $staff['last_name'],
                    'role' => $staff['role'],
                    'telephone' => $staff['telephone'],
                    'tour_id' => $tour->id,
                ]);
            }
        }

        if (isset($transData)) {
            foreach ($transData as $transportation) {
                Transporation::create([
                    'registration_number' => $transportation['registration_number'],
                    'type' => $transportation['type'],
                    'nbr_places' => $transportation['nbr_places'],
                    'tour_id' => $tour->id,
                ]);
            }
        }

        if (isset($actvData)) {
            foreach ($actvData as $activity) {
                Activity::create([
                    'name' => $activity['name'],
                    'description' => $activity['description'],
                    'tour_id' => $tour->id,
                ]);
            }
        }

        $offer = Offer::create([
            'type' => $type,
            'tour_id' => $tour->id,
            'host_id' => 5,
        ]);

        return response()->json($offer, 201);
    }



    public function storeCar(Request $request)
    {
        $carData = $request->input('car');
        $typeOff = $request->input('type');

        $car = new Car();
        $car->cmodel_id = $carData['cmodel_id'];
        $car->price_per_day = $carData['priceDay'];
        $car->production_date = $carData['production_date'];
        $car->fuel = $carData['fuel'];
        $car->nbr_places = $carData['nbrPlace'];
        $car->description = $carData['description'];
        $car->city_id = $carData['city_id'];
        $car->save();
        $offer = Offer::create([
            'type' => $typeOff,
            'car_id' => $car->id,
            'host_id' => '5',
        ]);

        return response()->json($car);
    }



    public function storeRestu(Request $request)
    {
        $cuisine = Cuisine::where('name', $request->input('restaurant.cuisine_name'))->firstOrFail();
        $city = City::where('name', $request->input('restaurant.city_name'))->firstOrFail();

        $restaurant = Restaurant::create([
            'name' => $request->input('restaurant.name'),
            'address' => $request->input('restaurant.address'),
            'cuisine_id' => $cuisine->id,
            'city_id' => $city->id,
            'description' => $request->input('restaurant.description'),
        ]);

        $createdTables = [];
        $nbr_tables = 0;

        if ($request->has('table_type') && $request->has('table_quantity')) {
            foreach ($request->input('table_type') as $index => $tableType) {
                $tableQuantity = $request->input('table_quantity')[$index];

                for ($i = 0; $i < $tableQuantity; $i++) {
                    $table = Table::create([
                        'type' => $tableType,
                        'restaurant_id' => $restaurant->id,
                    ]);
                    $createdTables[] = $table;
                }
                $nbr_tables += $tableQuantity;
            }
        }

        $restaurant->nbr_tables = $nbr_tables;
        $restaurant->save();

        $offer = Offer::create([
            'type' => $request->input('type'),
            'restaurant_id' => $restaurant->id,
            'host_id' => '1',
        ]);

        return response()->json([
            'restaurant' => $restaurant,
            'tables' => $createdTables,
            'offer' => $offer
        ], 201);
    }


    public function destroy($id)
    {
        try {
            $offer = Offer::findOrFail($id);
            $offer->delete();

            return response()->json(['message' => 'Offer deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete offer', 'error' => $e->getMessage()], 500);
        }
    }

    /*----------Admin--------*/

    
    public function AllOffers()
    {
        $offers = Offer::all();
        foreach ($offers as $offer) {
            $offer->host = $offer->host;
        }
        return response()->json(['offers' => $offers]);
    }

    public function deleteOffers(Request $request)
    {
        $ids = $request->ids_of_offers_to_delete;
        foreach ($ids as $id) {
            $offer = Offer::find($id);
            if ($offer->car_id) {
                $offer->car->delete();
            } elseif ($offer->tour_id) {
                $tour = $offer->tour;
                $transports = Transporation::where('tour_id', $tour->id)->get();
                foreach ($transports as $transport) {
                    $transport->delete();
                }
                $activities = Activity::where('tour_id', $tour->id)->get();
                foreach ($activities as $activity) {
                    $activity->delete();
                }
                $staff = Staff::where('tour_id', $tour->id)->get();
                foreach ($staff as $s) {
                    $s->delete();
                }
                $tour->cities()->detach();
                $tour->delete();
            } elseif ($offer->hotel_id) {
                $hotel = $offer->hotel;
                $rooms = Room::where('hotel_id', $hotel->id)->get();
                foreach ($rooms as $room) {
                    $room->delete();
                }
                $hotel->delete();
            } elseif ($offer->restaurant_id) {
                $restaurant = $offer->restaurant;
                $tables = Table::where('restaurant_id', $restaurant->id)->get();
                foreach ($tables as $table) {
                    $table->delete();
                }
                $restaurant->delete();
            }

            $images = Image::where('offer_id', $offer->id)->get();
            foreach ($images as $image) {
                $image->delete();
            }
            $reservations = Reservation::where('offer_id', $offer->id)->get();
            foreach ($reservations as $reservation) {
                $reservation->delete();
            }
            $offer->delete();
        }

        return response()->json(['message' => "Offres supprimées !"]);
    }
}
