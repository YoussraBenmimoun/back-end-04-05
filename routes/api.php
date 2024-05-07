<?php

use App\Models\Cmodel;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\NewController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\CbrandController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CmodelController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\RoomtypeController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\TourController;
use App\Models\Offer;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/offers/{id}', [OfferController::class,"index"]);
Route::get('/car/models', [RestaurantController::class,"getModels"]);
Route::get('/cities', [RestaurantController::class,"getCities"]);
Route::get('/cities/cities', [RestaurantController::class,"getCitiesCities"]);
Route::get('/car/models/{selectedBrand}', [RestaurantController::class,"getModelsOfBrand"]);
Route::get('/rooms/rooms/type', [RestaurantController::class,"getRoomTyp"]);
Route::get('/car/brands/brands', [RestaurantController::class,"getBrands"]);
Route::delete('/offers/{offerId}', [OfferController::class,"destroy"]);
Route::get('/cuisines/cuisines/cuisines', [RestaurantController::class,"getCuisine"]);
Route::post('/offers/store', [OfferController::class,"storeRestu"]);
Route::post('/cars/store', [OfferController::class,"storeCar"]);
Route::post('/hotels/store', [OfferController::class,"storeHotel"]);
Route::post('/tours/store', [OfferController::class,"storeTour"]);





// Route::get('/restaurants/{id}/download-pdf', [PdfController::class, 'download']);

Route::get('/restaurants/restaurant_offers', [RestaurantController::class,"restaurant_offers"])->name('restaurants.restaurant_offers');

Route::get('/restaurants/{id}/table-types', [RestaurantController::class, 'getTableTypes']);
Route::post('/reservations/store_table', [RestaurantController::class,"store"]);



Route::get('/restaurants/{id}', [RestaurantController::class,"show"]);


Route::post("/host/registerH",[\App\Http\Controllers\AuthHostController::class,"store"]);



Route::post("/register", [AuthController::class, "register"]);
Route::post("/login", [AuthController::class, "login"]);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, "logout"]);
});

Route::get('bills', [BillController::class, 'event']);

Route::get('cars/car_offers', [CarController::class, 'car_offers']);
Route::get('cars/{id}', [CarController::class, 'show']);
Route::get('cbrands', [CbrandController::class, 'index']);
Route::get('cmodels', [CmodelController::class, 'index']);
Route::get('cmodels/findBrand/{id}', [CmodelController::class, 'findBrand']);
Route::get('cities', [CityController::class, 'index']);
Route::post('reservations/store_car', [ReservationController::class, "storeCarReservation"]);


Route::get('/restaurants/{id}/table-types', [RestaurantController::class, 'getTableTypes']);
Route::get('/cuisines/cuisines/cuisines', [RestaurantController::class, "getCuisine"]);
Route::get('/restaurants/restaurant_offers', [RestaurantController::class, "restaurant_offers"]);
Route::get('/cities', [RestaurantController::class, "getCities"]);
Route::get('/restaurants/{id}', [RestaurantController::class, "show"]);
Route::post('/reservations/store_table', [ReservationController::class, 'storeTableReservation']);

Route::get('/hotels', [HotelController::class, 'index']);
Route::get('hotels/hotel_offers',[HotelController::class,'hotel_offers']);
Route::get('hotels/{id}',[HotelController::class,'show']);
Route::get('/roomtypes/name', [RoomtypeController::class, 'index']);
// Route::get('/roomtypes/get', [RoomtypeController::class, 'getRoomTypes']);
Route::get('/hotels', [HotelController::class, 'getHotelsByStars']);
Route::post('/reservations/store_hotel', [ReservationController::class, 'storeRoomReservation']);


Route::post('/offers/store', [OfferController::class,"storeRestu"]);
Route::post('/cars/store', [OfferController::class,"storeCar"]);
Route::post('/hotels/store', [OfferController::class,"storeHotel"]);
Route::post('/tours/store', [OfferController::class,"storeTour"]);




Route::get('tours', [TourController::class,"getTours"]);
Route::get('tours/{id}', [TourController::class,"DetailsTour"]);
// Route::get('test', [TourController::class,"index"]);
Route::post('reviews', [ReviewController::class, 'addReview']);
Route::get('getReviewsTopRat', [ReviewController::class, 'getReviewsTopRat']);
Route::post('/reservations/store_tour', [ReservationController::class, 'storeTourReservation']);



Route::post("/host/registerH",[\App\Http\Controllers\AuthHostController::class,"store"]);

Route::post("/register",[\App\Http\Controllers\AuthController::class,"register"]);
Route::post("/login",[\App\Http\Controllers\AuthController::class,"login"]);
Route::post('/logout', [AuthController::class, "logout"]);




/*------------ADMIN ROUTES-------------*/

Route::get('/offers',[OfferController::class,'AllOffers']);
Route::delete('delete_offers',[OfferController::class,'deleteOffers']);

Route::get('/reservations', [ReservationController::class, 'index']);
Route::get('/clients/{id}',[ClientController::class,'show']);

Route::get('users', [UserController::class, 'index']);
Route::put('/users/{id}', [UserController::class, 'updateStatus']);
Route::delete('/users', [UserController::class, 'deleteUsers']);
Route::post('/users', [UserController::class, 'storeAdmin']);
Route::put('/admin',[UserController::class,"updateAdmin"]);

/*-----------------Notification & Bill Routes ----------- */

Route::get("/bills/{id}",[BillController::class,"show"]);
Route::get('/notifications',[NotificationController::class,"index"]);
Route::put('/mark_notification_as_read/{id}',[NotificationController::class,"mark_notification_as_read"]);