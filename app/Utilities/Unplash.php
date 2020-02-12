<?php


namespace App\Utilities;
use GuzzleHttp\client;


class Unplash
{
    public static function getImages($query)
    {

        $apiKey = config('services.unplash.unplash_api_key');
        $url = 'https://api.unsplash.com/search/photos?per_page=10&page=1&query=' . $query . '&client_id=' . $apiKey;
        $url2 = 'https://api.unsplash.com/search/photos?per_page=10&page=2&query=' . $query . '&client_id=' . $apiKey;
        $url3 = 'https://api.unsplash.com/search/photos?per_page=10&page=3&query=' . $query . '&client_id=' . $apiKey;
        $client = new Client();

        $geocodeResponse = $client->get($url)->getBody();
        $geocodeData = json_decode($geocodeResponse);

        $picSearch = [];
        if($geocodeData->total != 0){
            $geocodeResponse2 = $client->get($url2)->getBody();
            $geocodeData2 = json_decode($geocodeResponse2);
            $geocodeResponse3 = $client->get($url3)->getBody();
            $geocodeData3 = json_decode($geocodeResponse3);
            $j = 0;
            $z = 0;
            for($i=0; $i<10; $i++){
                $picSearch[$i] = [$geocodeData->results[$i]->alt_description, $geocodeData->results[$i]->urls->regular, $geocodeData->results[$i]->urls->raw, $geocodeData->results[$i]->id];
            }
            for($i=10; $i<20; $i++){

                $picSearch[$i] = [$geocodeData2->results[$j]->alt_description, $geocodeData2->results[$j]->urls->regular, $geocodeData2->results[$j]->urls->raw, $geocodeData2->results[$j]->id];
                $j++;
            }
            for($i=20; $i<30; $i++){
                $picSearch[$i] = [$geocodeData3->results[$z]->alt_description, $geocodeData3->results[$z]->urls->regular, $geocodeData3->results[$z]->urls->raw, $geocodeData3->results[$z]->id];
                $z++;
            }
        }else{
            $picSearch = '';
        }
//         $description = $geocodeData->results[0]->alt_description;
//         echo $geocodeResponse;
//         $url_raw = $geocodeData->results[0]->urls->raw;


        return $picSearch;
//         echo $picSearch[0][0];


//         echo "<img src='$url_raw' />";

    }

     public static function getRandomImages()
        {

            $apiKey = config('services.unplash.unplash_api_key');
            $url = 'https://api.unsplash.com/photos/random?count=30&query=&client_id=' . $apiKey;

            $client = new Client();

            $geocodeResponse = $client->get($url)->getBody();
            $geocodeData = json_decode($geocodeResponse);
    //         $description = $geocodeData->results[0]->alt_description;
    //         echo $geocodeResponse;
    //         $url_raw = $geocodeData->results[0]->urls->raw;
            $picSearch = [];
            for($i=0; $i<30; $i++){
                $picSearch[$i] = [$geocodeData[$i]->alt_description, $geocodeData[$i]->urls->regular, $geocodeData[$i]->urls->raw, $geocodeData[$i]->id];
            }
            return $picSearch;
    //         echo $picSearch[0][0];


    //         echo "<img src='$url_raw' />";

        }
}