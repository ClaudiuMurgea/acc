<?php

namespace Database\Seeders;

use App\DataProviders\CityDataProvider;
use App\DataProviders\CountryDataProvider;
use App\DataProviders\StateDataProvider;
use App\Models\City;
use App\Models\Country;
use App\Models\State;
use Illuminate\Database\Seeder;

class CountryData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::insertOrIgnore(CountryDataProvider::data());


        foreach (CountryDataProvider::dataCountryCode() as $data){

            $country = Country::where('name',strtolower($data['name']))->first();

            if (!$country)
                continue;

            $country->update(

                [
                    'name'  => $data['name'],
                    'country_code'  => $data['code'],
                    'country_phone_code'    => $data['phone']
                ]
            );
        }
        State::insertOrIgnore(StateDataProvider::data());
        foreach (collect(CityDataProvider::data())->chunk(15000) as $chunkCities) {
            City::insertOrIgnore($chunkCities->toArray());
        }
    }
}
