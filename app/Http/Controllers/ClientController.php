<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /*----------Admin----------*/
    public function show($id){

        $client = Client::find($id);
        $client->user = $client->user;
        return response()->json(['client' => $client]);
    }
}
