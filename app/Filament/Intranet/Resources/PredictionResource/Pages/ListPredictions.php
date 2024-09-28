<?php

namespace App\Filament\Intranet\Resources\PredictionResource\Pages;

use App\Filament\Intranet\Resources\PredictionResource;
use App\Models\Prediction;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPredictions extends ListRecords
{
    protected static string $resource = PredictionResource::class;

    protected function getHeaderActions(): array
    {


/*          $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.polygon.io/v2/aggs/ticker/X:BTCUSD/range/1/day/2020-01-01/2024-07-04?apiKey=SI3YigVJ9CmCc9FHxQkUOBC4Eoz0PM3w',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $resp = json_decode($response);


        foreach ($resp->results as $key => $value) {
            Prediction::create([
                'symbol' => 'BTCUSD',
                'description' => 'BTCUSD',
                'price' => $value->c,
                'prediction_date' => date("Y-m-d", substr($value->t, 0, 10)),
            ]);
        }  */



        return [
            Actions\CreateAction::make(),
        ];
    }
}
