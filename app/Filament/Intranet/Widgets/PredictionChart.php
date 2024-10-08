<?php

namespace App\Filament\Intranet\Widgets;


use App\Models\HistoricoCoinsPrice;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Carbon;

class PredictionChart extends ChartWidget
{
    protected static ?string $heading = 'Historico Precio Bitcoin';


    protected function getData(): array
    {
        $data = Trend::query(HistoricoCoinsPrice::where('coin', 'bitcoin'))
            ->between(
                start: Carbon::createFromFormat('Y-m-d', '2020-06-23'), # now()->startOfYear(),
                end: Carbon::createFromFormat('Y-m-d', '2024-09-28'), #now(),
            )
            ->perDay()
            ->sum('price');

        return [
            'datasets' => [
                [
                    'label' => 'BTCUSD',
                    'data' => $data->map(fn(TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn(TrendValue $value) => $value->date),
        ];
    }


    protected function getType(): string
    {
        return 'line';
    }
}
