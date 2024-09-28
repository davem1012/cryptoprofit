<?php

namespace App\Filament\Intranet\Widgets;

use App\Models\Prediction;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Carbon;
class PredictionChart extends ChartWidget
{
    protected static ?string $heading = 'Prediccion';


    protected function getData(): array
    {
        $data = Trend::model(Prediction::class)
            ->between(
                start: Carbon::createFromFormat('Y-m-d', '2024-06-20') ,# now()->startOfYear(),
                end: Carbon::createFromFormat('Y-m-d', '2024-07-03') , #now(),
            )
            ->perDay()
            ->sum('price');

        return [
            'datasets' => [
                [
                    'label' => 'BTCUSD',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
