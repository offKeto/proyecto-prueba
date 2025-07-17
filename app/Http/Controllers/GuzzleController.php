<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class GuzzleController extends Controller
{
    public function fetchData()
    {
        $client = new Client();

        $response = $client->get('https://jsonplaceholder.typicode.com/users');

        $data = json_decode($response->getBody());

        foreach ($data as $user) {
            echo "Nombre: $user->name<br>";
            echo "Email: $user->email<br><br>";
        }
    }
}
