<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Api extends Model
{
    use HasFactory;

    // https://gps.trackmycar.lk/api/api.php?api=server&ver=1.0&key=C1CD215EBADF1D0728A1D65C1BBC2CF6&cmd=ADD_USER,test@gmail.com,true
    // https://gps.trackmycar.lk/api/api.php?api=server&ver=1.0&key=C1CD215EBADF1D0728A1D65C1BBC2CF6&cmd=CHECK_USER_EXISTS,test@gmail.com

    public function addUser($email)
    {
        $apiAddUser = env('API_CONNECTION_LINK') . 'ADD_USER,' . $email . ',true';
        $response = Http::get($apiAddUser);
        return $response;
    }

    public function existUser($email)
    {
        $apiAddUser = env('API_CONNECTION_LINK') . 'CHECK_USER_EXISTS,' . $email . '';
        $response = Http::get($apiAddUser);
        return $response;
    }
}
