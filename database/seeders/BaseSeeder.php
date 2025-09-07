<?php

namespace Database\Seeders;

use App\Models\Amenity;
use App\Models\Company;
use App\Models\PropertyType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BaseSeeder extends Seeder
{
    public function run(): void
    {
        // Companies
        $comp = Company::firstOrCreate(
            ['slug' => 'default-agency'],
            ['name' => 'Default Agency', 'phone' => null, 'email' => null]
        );

        // Property Types (root + children)
        $res = PropertyType::firstOrCreate(['slug' => 'residential'], ['name' => 'Residential']);
        PropertyType::firstOrCreate(['slug' => 'apartment'], ['name' => 'Apartment','parent_id'=>$res->id]);
        PropertyType::firstOrCreate(['slug' => 'house'], ['name' => 'House','parent_id'=>$res->id]);
        $com = PropertyType::firstOrCreate(['slug' => 'commercial'], ['name' => 'Commercial']);
        PropertyType::firstOrCreate(['slug' => 'office'], ['name' => 'Office','parent_id'=>$com->id]);
        PropertyType::firstOrCreate(['slug' => 'retail'], ['name' => 'Retail','parent_id'=>$com->id]);

        // Amenities
        $amenities = ['Parking','Elevator','Balcony','Garden','Pool','Air Conditioning','Heating','Security','Furnished','Pet Friendly'];
        foreach ($amenities as $a) {
            Amenity::firstOrCreate(['slug'=>Str::slug($a)], ['name'=>$a]);
        }
    }
}
