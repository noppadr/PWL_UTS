<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        // Add user data using Eloquent Model
        $data = [
            'nama' => 'Pelanggan',
        ];
        UserModel::insert($data); // Add the data to the m_user table

        // Access UserModel to retrieve data
        $user = UserModel::all(); // Fetch all data from the m_user table
        return view('user', ['data' => $user]);
    }
}
