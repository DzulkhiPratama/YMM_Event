<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isNull;

class Event extends Model
{
    use HasFactory;
    protected $fillable = ['event_id', 'event_name', 'start_at', 'end_at', 'event_desc', 'user_id', 'unit_id', 'budget', 'image', 'pdf'];



    // menampilkan kegiatan unit berdasar URL yg dilempar
    public static function event_unit_user($unit_name)
    {
        $tr = DB::table('events')
            ->join('units', 'events.unit_id', '=', 'units.id')
            ->join('users', 'events.user_id', '=', 'users.id')
            ->select('events.*', 'units.*', 'users.*')
            ->where('unit_code_str', '=', $unit_name)
            ->orderby('start_at', 'desc')
            ->get();
        return $tr;
    }

    // menampilakn recently activity unit
    public static function event_unit_upper_three($unit_name)
    {
        $tr = DB::table('events')
            ->join('units', 'events.unit_id', '=', 'units.id')
            ->select('events.*', 'units.*')
            ->where('unit_code_str', '=', $unit_name)
            ->orderby('start_at', 'desc')
            ->take(3)
            ->get();
        return $tr;
    }

    // fungsi untuk menghandle ketika view event unit masih kosong
    public static function event_empty($unit_name)
    {
        $tr = DB::table('units')
            ->select('units.*')
            ->where('unit_code_str', '=', $unit_name)
            ->first();
        return $tr;
    }

    // fungsi untuk menghandle jumlah event tiap unit
    public static function unit_event_list_count()
    {
        $unit = [];
        $unit_full = [];
        $jum_event = [];
        $tr = DB::table('units')
            ->select('units.*')
            ->where('unit_type', '=', 'unit')
            ->orderby('unit_id', 'asc')
            ->get();

        foreach ($tr as $ty => $value) {
            if (in_array($value->unit_code_str, $unit)) {
                // nilai ditambahkan karena sudah ada sebelumnya
            } else {
                $unit[] = $value->unit_code_str;
                $unit_full[] = ['unit_name' => $value->unit_name, 'unit_code_str' => $value->unit_code_str];
            }
        }
        // dd($unit_full);

        //cari dengan code str
        foreach ($unit_full as $tx => $a) {
            $ts = DB::table('events')
                ->join('units', 'events.unit_id', '=', 'units.id')
                ->select('events.*', 'units.*')
                ->where('unit_code_str', '=', $a['unit_code_str'])
                ->get();
            if (count($ts) == 0) {
                $jum_event[] = 0;
            } else {
                $jum_event[] = count($ts);
            }
        }

        // dd($jum_event);
        return $jum_event;
    }

    public static function dkm_event_list_count()
    {
        $unit_full = DB::table('units')
            ->select('units.*')
            ->where('unit_type', '=', 'dkm')
            ->orderby('unit_id', 'asc')
            ->get();

        // dd($unit_full);

        //cari dengan code str
        foreach ($unit_full as $tx => $a) {
            $ts = DB::table('events')
                ->join('units', 'events.unit_id', '=', 'units.id')
                ->select('events.*', 'units.*')
                ->where('unit_code_str', '=', $a->unit_code_str)
                ->get();
            if (count($ts) == 0) {
                $jum_event[] = 0;
            } else {
                $jum_event[] = count($ts);
            }
        }

        // dd($jum_event);
        return $jum_event;
    }
}
