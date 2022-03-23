<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\location;
use App\Models\Role;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Event::factory(15)->create();
        User::factory(10)->create();

        Unit::create([
            'unit_id' => 1,
            'unit_name' => "BPPU",
            'unit_code_str' => "bppu",
            'unit_area' => "HL",
            'unit_type' => "unit",
            'unit_desc' => "Another exciting bit of representative placeholder content. This time, we've moved on to the second column",
        ]);

        Unit::create([
            'unit_id' => 2,
            'unit_name' => "DWP",
            'unit_code_str' => "dwp",
            'unit_area' => "LL",
            'unit_type' => "unit",
            'unit_desc' => "Another exciting bit of representative placeholder content. This time, we've moved on to the second column",
        ]);

        Unit::create([
            'unit_id' => 3,
            'unit_name' => "DWP",
            'unit_code_str' => "dwp",
            'unit_area' => "HL",
            'unit_type' => "unit",
            'unit_desc' => "Another exciting bit of representative placeholder content. This time, we've moved on to the second column",
        ]);

        Unit::create([
            'unit_id' => 4,
            'unit_name' => "IPHFI",
            'unit_code_str' => "iphfi",
            'unit_area' => "LL",
            'unit_type' => "unit",
            'unit_desc' => "Another exciting bit of representative placeholder content. This time, we've moved on to the second column",
        ]);
        Unit::create([
            'unit_id' => 5,
            'unit_name' => "IPHI",
            'unit_code_str' => "iphfi",
            'unit_area' => "HL",
            'unit_type' => "unit",
            'unit_desc' => "Another exciting bit of representative placeholder content. This time, we've moved on to the second column",
        ]);
        Unit::create([
            'unit_id' => 6,
            'unit_name' => "IRMAFI",
            'unit_code_str' => "irmafi",
            'unit_area' => "HL",
            'unit_type' => "unit",
            'unit_desc' => "Another exciting bit of representative placeholder content. This time, we've moved on to the second column",
        ]);
        Unit::create([
            'unit_id' => 7,
            'unit_name' => "KOMINFO",
            'unit_code_str' => "kominfo",
            'unit_area' => "HL",
            'unit_type' => "unit",
            'unit_desc' => "Another exciting bit of representative placeholder content. This time, we've moved on to the second column",
        ]);
        Unit::create([
            'unit_id' => 8,
            'unit_name' => "TPQ Haisra",
            'unit_code_str' => "tpq_haisra",
            'unit_area' => "HL",
            'unit_type' => "unit",
            'unit_desc' => "Another exciting bit of representative placeholder content. This time, we've moved on to the second column",
        ]);
        Unit::create([
            'unit_id' => 9,
            'unit_name' => "YMM Care",
            'unit_code_str' => "ymm_care",
            'unit_area' => "HL",
            'unit_type' => "unit",
            'unit_desc' => "Another exciting bit of representative placeholder content. This time, we've moved on to the second column",
        ]);

        Unit::create([
            'unit_id' => 10,
            'unit_name' => "YMM Care",
            'unit_code_str' => "ymm_care",
            'unit_area' => "HL",
            'unit_type' => "unit",
            'unit_desc' => "Another exciting bit of representative placeholder content. This time, we've moved on to the second column",
        ]);

        Unit::create([
            'unit_id' => 11,
            'unit_name' => "AL IKHLAS",
            'unit_code_str' => "al_ikhlas",
            'unit_area' => "LL",
            'unit_type' => "dkm",
            'unit_desc' => "Another exciting bit of representative placeholder content. This time, we've moved on to the second column",
        ]);

        Unit::create([
            'unit_id' => 12,
            'unit_name' => "AN NI'MAH",
            'unit_code_str' => "an_nimah",
            'unit_area' => "LL",
            'unit_type' => "dkm",
            'unit_desc' => "Another exciting bit of representative placeholder content. This time, we've moved on to the second column",
        ]);

        Unit::create([
            'unit_id' => 13,
            'unit_name' => "AL ISTIQOMAH",
            'unit_code_str' => "al_istiqomah",
            'unit_area' => "LL",
            'unit_type' => "dkm",
            'unit_desc' => "Another exciting bit of representative placeholder content. This time, we've moved on to the second column",
        ]);

        Unit::create([
            'unit_id' => 14,
            'unit_name' => "BAITURRAHIM",
            'unit_code_str' => "baiturrahim",
            'unit_area' => "LL",
            'unit_type' => "dkm",
            'unit_desc' => "Another exciting bit of representative placeholder content. This time, we've moved on to the second column",
        ]);

        Unit::create([
            'unit_id' => 15,
            'unit_name' => "AL HIDAYAH",
            'unit_code_str' => "al_hidayah",
            'unit_area' => "LL",
            'unit_type' => "dkm",
            'unit_desc' => "Another exciting bit of representative placeholder content. This time, we've moved on to the second column",
        ]);

        Unit::create([
            'unit_id' => 16,
            'unit_name' => "AL AZHAR",
            'unit_code_str' => "al_azhar",
            'unit_area' => "LL",
            'unit_type' => "dkm",
            'unit_desc' => "Another exciting bit of representative placeholder content. This time, we've moved on to the second column",
        ]);

        Unit::create([
            'unit_id' => 17,
            'unit_name' => "BAITUL MUTTAQIN",
            'unit_code_str' => "baitul_muttaqin",
            'unit_area' => "LL",
            'unit_type' => "dkm",
            'unit_desc' => "Another exciting bit of representative placeholder content. This time, we've moved on to the second column",
        ]);

        Unit::create([
            'unit_id' => 18,
            'unit_name' => "AL MUNAWWAROH",
            'unit_code_str' => "al_munawwaroh",
            'unit_area' => "HL",
            'unit_type' => "dkm",
            'unit_desc' => "Another exciting bit of representative placeholder content. This time, we've moved on to the second column",
        ]);

        Unit::create([
            'unit_id' => 19,
            'unit_name' => "DAARUSSA'ADAH",
            'unit_code_str' => "daarussaadah",
            'unit_area' => "HL",
            'unit_type' => "dkm",
            'unit_desc' => "Another exciting bit of representative placeholder content. This time, we've moved on to the second column",
        ]);

        Unit::create([
            'unit_id' => 20,
            'unit_name' => "BAITURRAHMAN",
            'unit_code_str' => "baiturrahman",
            'unit_area' => "HL",
            'unit_type' => "dkm",
            'unit_desc' => "Another exciting bit of representative placeholder content. This time, we've moved on to the second column",
        ]);

        Unit::create([
            'unit_id' => 21,
            'unit_name' => "AT TAQWA",
            'unit_code_str' => "at_taqwa",
            'unit_area' => "HL",
            'unit_type' => "dkm",
            'unit_desc' => "Another exciting bit of representative placeholder content. This time, we've moved on to the second column",
        ]);

        Unit::create([
            'unit_id' => 22,
            'unit_name' => "AL A'RAF",
            'unit_code_str' => "al_araf",
            'unit_area' => "HL",
            'unit_type' => "dkm",
            'unit_desc' => "Another exciting bit of representative placeholder content. This time, we've moved on to the second column",
        ]);

        Unit::create([
            'unit_id' => 23,
            'unit_name' => "BAABUL MUNAAWWAROH",
            'unit_code_str' => "baabul_munawwaroh",
            'unit_area' => "HL",
            'unit_type' => "dkm",
            'unit_desc' => "Another exciting bit of representative placeholder content. This time, we've moved on to the second column",
        ]);

        Unit::create([
            'unit_id' => 24,
            'unit_name' => "DINUSSALAM",
            'unit_code_str' => "dinussalam",
            'unit_area' => "HL",
            'unit_type' => "dkm",
            'unit_desc' => "Another exciting bit of representative placeholder content. This time, we've moved on to the second column",
        ]);

        Unit::create([
            'unit_id' => 25,
            'unit_name' => "ASHABUL KAHFI",
            'unit_code_str' => "ashabul_kahfi",
            'unit_area' => "HL",
            'unit_type' => "dkm",
            'unit_desc' => "Another exciting bit of representative placeholder content. This time, we've moved on to the second column",
        ]);

        Role::create([
            'role_name' => "user",
            'role_desc' => "common user",
        ]);

        Role::create([
            'role_name' => "admin",
            'role_desc' => "developer and ymm admin",
        ]);
    }
}
