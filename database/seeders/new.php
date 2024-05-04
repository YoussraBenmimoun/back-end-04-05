<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Car;
use App\Models\City;
use App\Models\Host;
use App\Models\Room;
use App\Models\User;
use App\Models\Hotel;
use App\Models\Image;
use App\Models\Offer;
use App\Models\Table;
use App\Models\Cbrand;
use App\Models\Client;
use App\Models\Cmodel;
use App\Models\Cuisine;
use App\Models\Roomtype;
use App\Models\Restaurant;
use App\Models\Reservation;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $citiesData = [
            [
                'name' => 'Tangier',
            ],
            [
                'name' => 'Rabat',
            ],
            [
                'name' => 'Marrakech',
            ],
        ];

        foreach ($citiesData as $cityData) {
            City::create($cityData);
        }

        $cbrandsData = [
            [
                'name' => 'Brand 1',
            ],

            [
                'name' => 'Brand 2',
            ],
        ];

        foreach ($cbrandsData as $cbrandData) {
            Cbrand::create($cbrandData);
        }


        $cmodelsData = [
            [
                'name' => 'Modèle 1',
                'cbrand_id' => 1,
            ],

            [
                'name' => 'Modèle 2',
                'cbrand_id' => 2,
            ],
            [
                'name' => 'Modèle 3',
                'cbrand_id' => 2,
            ],
        ];

        foreach ($cmodelsData as $cmodelData) {
            Cmodel::create($cmodelData);
        }

        $carsData = [
            [
                'price_per_day' => 550.00,
                'production_date' => '2022-01-01',
                'fuel' => 'Essence',
                'nbr_places' => 2 + 2,
                'description' => 'Une voiture luxueuse et fiable.',
                'cmodel_id' => 1,
                'city_id' => 1,
            ],
            [
                'price_per_day' => 460.00,
                'production_date' => '2021-05-15',
                'fuel' => 'Diesel',
                'nbr_places' => 4,
                'description' => 'Une voiture luxueuse et spacieuse.',
                'cmodel_id' => 2,
                'city_id' => 2,
            ],
            [
                'price_per_day' => 200.00,
                'production_date' => '2008-10-10',
                'fuel' => 'Diesel',
                'nbr_places' => 4,
                'description' => 'Une voiture économique et fiable.',
                'cmodel_id' => 3,
                'city_id' => 1,
            ],
        ];

        foreach ($carsData as $carData) {
            Car::create($carData);
        }

        $usersData = [
            [
                'image' => '/assets/user_mock_image.png',
                'email' => 'youssra.benmimoun@gmail.com',
                'password' => '123',
                'type' => 'client',
                'status' => 0
            ],

            [
                'image' => '/assets/user_mock_image.png',
                'email' => 'aida.benmimoun@gmail.com',
                'password' => '123',
                'type' => 'host',
                'status' => 0
            ],

        ];

        foreach ($usersData as $userData) {
            User::create($userData);
        }

        $hostsData = [
            [
                'CIN' => 'CD654321',
                'first_name' => 'Aida',
                'last_name' => 'Benmimoun',
                'address' => 'bit',
                'telephone' => '0123456789',
                'birth_date' => '2000-06-06',
                'user_id' => 2
            ]

        ];

        foreach ($hostsData as $hostData) {
            Host::create($hostData);
        }

        $clientsData = [
            [
                'first_name' => 'Youssra',
                'last_name' => 'Benmimoun',
                'address' => 'bit',
                'telephone' => '0123456789',
                'birth_date' => '1998-08-11',
                'user_id' => 1
            ]

        ];

        foreach ($clientsData as $clientData) {
            Client::create($clientData);
        }

        $cuisinesData = [
            [
                'name' => 'marocaine',
            ],
            [
                'name' => 'italienne',
            ],
            [
                'name' => 'chinoise',
            ],
            [
                'name' => 'mexicaine',
            ]

        ];

        foreach ($cuisinesData as $cuisineData) {
            Cuisine::create($cuisineData);
        }

        $restaurantsData = [
            [
                'name' => 'Pallermo',
                'description' => '............................',
                'nbr_tables' => 16,
                'cuisine_id' => 2,
                'city_id' => 1,
                "address" => "address !!!!!!!"
            ],
            [
                'name' => 'Chihuahua',
                'description' => '............................',
                'nbr_tables' => 18,
                'cuisine_id' => 4,
                'city_id' => 1,
                "address" => "address !!!!!!!"
                
            ],
            [
                'name' => 'Dar Naji',
                'description' => '............................',
                'nbr_tables' => 20,
                'cuisine_id' => 1,
                'city_id' => 2,
                "address" => "address !!!!!!!"
            ],
            [
                'name' => 'Dar Tazi',
                'description' => '............................',
                'nbr_tables' => 24,
                'cuisine_id' => 1,
                'city_id' => 2,
                "address" => "address !!!!!!!"
            ],


        ];

        foreach ($restaurantsData as $restaurantData) {
            Restaurant::create($restaurantData);
        }


        $hotels = [
            [
                'name' => 'Hilton Tanger City Center Hotel & Residences',
                'address' => ' Tanger City Center Place du Maghreb, 90000 Tangier, Morocco',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
                'nbr_stars' => 5,
                'city_id' => 1,
            ],
            [
                'name' => 'Royal Tulip City Center',
                'address' => ' Rte de Malabata, Tanger 90000, Morocco ',
                'description' => 'Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'nbr_stars' => 5,
                'city_id' => 1,
            ],
            [
                'name' => 'Hotel Golden Tulip Farah',
                'address' => ' PLACE 16 NOVEMBRE, Bd Mohamed Lyazidi, Rabat 10000, Morocco',
                'description' => 'Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'nbr_stars' => 5,
                'city_id' => 2,
            ],
            [
                'name' => 'Hotel Akabar',
                'address' => ' Av. Echouhada, Marrakech 40000, Morocco',
                'description' => 'Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
                'nbr_stars' => 5,
                'city_id' => 3,
            ],

        ];


        foreach ($hotels as $hotelData) {
            Hotel::insert($hotelData);
        }

        $roomtypes = [
            ['name' => 'suite'],
            ['name' => 'familly room']
        ];

        foreach ($roomtypes as $roomtypeData) {
            Roomtype::insert($roomtypeData);
        }

        $room = [
            [
                'nbr_beds' => 3,
                'price_per_night' => '140.00',
                'description' => 'suite',
                'hotel_id' => 1,
                'roomtype_id' => 1
            ],
            [
                'nbr_beds' => 1,
                'price_per_night' => '70.00',
                'description' => 'familly',
                'hotel_id' => 2,
                'roomtype_id' => 2
            ],


        ];
        foreach ($room as $roomData) {
            Room::insert($roomData);
        }

        $offersData = [
            [
                'type' => 'car',
                'host_id' => 1,
                'car_id' => 1
            ],

            [
                'type' => 'car',
                'host_id' => 1,
                'car_id' => 2
            ],
            [
                'type' => 'car',
                'host_id' => 1,
                'car_id' => 3
            ],
            [
                'type' => 'restaurant',
                'host_id' => 1,
                'restaurant_id' => 1
            ],

            [
                'type' => 'restaurant',
                'host_id' => 1,
                'restaurant_id' => 2
            ],
            [
                'type' => 'restaurant',
                'host_id' => 1,
                'restaurant_id' => 3
            ],

            [
                'type' => 'restaurant',
                'host_id' => 1,
                'restaurant_id' => 4
            ],
            [
                'type' => 'hotel',
                'host_id' => 1,
                'hotel_id' => 1
            ],
            [
                'type' => 'hotel',
                'host_id' => 1,
                'hotel_id' => 2
            ],
            [
                'type' => 'hotel',
                'host_id' => 1,
                'hotel_id' => 3
            ],
            [
                'type' => 'hotel',
                'host_id' => 1,
                'hotel_id' => 4
            ],

        ];

        foreach ($offersData as $offerData) {
            Offer::create($offerData);
        }


        $imagesData = [
            [
                'url' => '/assets/polestar-1.jpg',
                'offer_id' => 1,
            ],
            [
                'url' => '/assets/polestar-1-1.jpg',
                'offer_id' => 1,
            ],
            [
                'url' => '/assets/car2.jpg',
                'offer_id' => 2,
            ],
            [
                'url' => '/assets/mercedes-2005.jpg',
                'offer_id' => 3,
            ],
            [
                'url' => '/assets/hilton tanger.jpg',
                'offer_id' => 8,
            ],
            [
                'url' => '/assets/hilton tanger -1.jpg',
                'offer_id' => 8,
            ],
            [
                'url' => '/assets/hilton tanger -2.jpg',
                'offer_id' => 8,
            ],
            [
                'url' => '/assets/Royal Tulip City Center.jpg',
                'offer_id' => 9,
            ],
            [
                'url' => '/assets/Royal Tulip City Center-1.jpg',
                'offer_id' => 9,
            ],
            [
                'url' => '/assets/Hotel Golden Tulip Farah.jpg',
                'offer_id' => 10,
            ],
            [
                'url' => '/assets/Hotel Golden Tulip Farah-1.jpg',
                'offer_id' => 10,
            ],
            [
                'url' => '/assets/Hotel Golden Tulip Farah-2.jpg',
                'offer_id' => 10,
            ],
            [
                'url' => '/assets/Hotel Akabar.jpg',
                'offer_id' => 11,
            ],
            [
                'url' => '/assets/Hotel Akabar-1.jpg',
                'offer_id' => 11,
            ]

        ];

        foreach ($imagesData as $imageData) {
            Image::create($imageData);
        }





        $tablesData = [
            [
                'type' => 'table à 4',
                'restaurant_id' => 1
            ],

            [
                'type' => 'table à 2',
                'restaurant_id' => 1
            ],

            [
                'type' => 'table à 4',
                'restaurant_id' => 1
            ],

            [
                'type' => 'table à 2',
                'restaurant_id' => 2
            ],
        ];

        foreach ($tablesData as $tableData) {
            Table::create($tableData);
        }

        $reservationsData = [
            [
                'start_date' => "2024-04-24",
                'end_date' => "2024-04-26",
                'client_id' => 1,
                'offer_id' => 1,
                'car_id' => 1
            ],
            [
                'start_date' => "2024-05-25",
                'end_date' => "2024-05-26",
                'client_id' => 1,
                'offer_id' => 2,
                'car_id' => 1
            ]
        ];
        foreach ($reservationsData as $reservationData) {
            Reservation::create($reservationData);
        }
    }
}
