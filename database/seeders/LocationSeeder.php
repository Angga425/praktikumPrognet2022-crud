<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $provinces = Http::withHeaders([
            'key' => 'd9b4ea264861995bd242a1a62a223c90'
        ])->get('https://api.rajaongkir.com/starter/province')->json()['rajaongkir']['results'];

        foreach ($provinces as $province) {
            Province::create([
                'id' => $province['province_id'],
                'title' => $province['province']
            ]);
            $cities = Http::withHeaders([
                'key' => 'd9b4ea264861995bd242a1a62a223c90'
            ])->get('https://api.rajaongkir.com/starter/city', [
                'province' => $province['province_id']
            ])->json()['rajaongkir']['results'];
            foreach ($cities as $city) {
                Province::find($province['province_id'])->cities()->create([
                    'id' => $city['city_id'],
                    'title' => $city['city_name']
                ]);
            }
        }
    }
}