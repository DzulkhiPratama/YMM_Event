<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Unit;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        return view('um', [
            'list_user' => User::list_user(),
            'roles' => Role::all(),
            'units' => Unit::orderBy('unit_id', 'asc')->get(),
            'list_unit' => Unit::list_unit(),
            'list_dkm' => Unit::list_dkm(),
        ]);
    }

    public function update(Request $request, $userid)
    {

        $usr = User::where('userid', $userid)->first();

        if ($request->cgfullname == 'Yes') {

            $credentials = $request->validate([
                'name' => 'min:2|unique:users'
            ]);

            $usr->update([
                'name' => $request->name_mdl,
            ]);
        }

        if ($request->cgemail == 'Yes') {
            $validatedData = $request->validate([
                'email' => 'email:dns|unique:users',
            ]);
            $usr->update([
                'email' => $validatedData['email'],
            ]);
        }

        if ($request->cgpass == 'Yes') {
            $validatedData = $request->validate([
                'password' => 'min:2',
            ]);
            $validatedData['password'] = bcrypt($validatedData['password']);
            $usr->update([
                'password' => $validatedData['password'],
            ]);
        }

        if ($request->cguserid == 'Yes') {
            $validatedData = $request->validate([
                'userid' => 'min:4|unique:users',
            ]);
            $usr->update([
                'userid' => $validatedData['userid'],
            ]);
        }

        $usr->update([
            'role_id' => $request->role_id,
            'unit_id' => $request->unit_id,
        ]);

        return redirect()->back()->with('success', 'Perubahan Detail User Tersimpan !');
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
        $validatedData['role_id'] = $request->role_id;
        $validatedData['unit_id'] = $request->unit_id;

        // dd($validatedData);
        User::create($validatedData);

        return redirect()->back()->with('success', 'User Tersimpan !');
    }

    public function destroy($userid)
    {

        DB::table('users')->where('userid', $userid)->delete();
        return redirect()->back()->with('danger', 'User Di-unreg');
    }
}
