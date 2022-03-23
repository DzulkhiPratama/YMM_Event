<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Unit extends Model
{
    use HasFactory;

    // menampilkan list unit yang akan mengisi menu pada dashboard
    public static function list_unit()
    {
        $unit = [];
        $unit_full = [];
        $tr = DB::table('units')
            ->select('units.*')
            ->where('unit_type', '=', 'unit')
            ->orderby('unit_id', 'asc')
            ->get();

        foreach ($tr as $ty => $value) {
            if (in_array($value->unit_name, $unit)) {
                // nilai ditambahkan karena sudah ada sebelumnya
            } else {
                $unit[] = $value->unit_name;
                $unit_full[] = ['unit_name' => $value->unit_name, 'unit_code_str' => $value->unit_code_str, 'unit_desc' => $value->unit_desc];
            }
        }

        return $unit_full;
    }

    // menampilkan list dkm yang akan mengisi menu pada dashboard
    public static function list_dkm()
    {
        $tr = DB::table('units')
            ->select('units.*')
            ->where('unit_type', '=', 'dkm')
            ->orderby('unit_id', 'asc')
            ->get();
        return $tr;
    }
}
