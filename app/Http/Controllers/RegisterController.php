<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        $type = [];

        $tr = DB::table('units')
            ->select('units.unit_id', 'units.unit_name', 'units.unit_area')
            ->orderBy('units.unit_id')
            ->get();

        foreach ($tr as $ty) {
            if (in_array($ty->unit_name, $type)) {
                // nilai ditambahkan karena sudah ada sebelumnya
            } else {
                $type[] = [$ty->unit_id, $ty->unit_name, $ty->unit_area];
            }
        }

        return view(
            'register',
            [
                'unit' => $type,
            ]

        );
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([

            'name' => 'min:2|unique:users',
            'email' => 'email:dns|unique:users',
            'password' => 'min:2',
            'userid' => 'min:4|unique:users',

        ]);

        $validatedData['password'] = bcrypt($validatedData['password']);
        $validatedData['role_id'] = 1;
        $validatedData['unit_id'] = $request->unit_id;

        // dd($validatedData);
        User::create($validatedData);
        return redirect('/user')->with('success', 'User Berhasil Diregistrasi');
    }
}
