<?php

namespace App\Filament\Intranet\Widgets;


use App\Models\HistoricoFearGreedIndex;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Carbon;

class HistoricFearGreedIndexChart extends ChartWidget
{
    protected static ?string $heading = 'Historico - Sentimiento del Mercado';

    protected function getData(): array
    {
        $data = Trend::model(HistoricoFearGreedIndex::class)
            ->between(
                start: Carbon::createFromFormat('Y-m-d', '2024-06-01'), # now()->startOfYear(),
                end: Carbon::createFromFormat('Y-m-d', '2024-09-28'), #now(),
            )
            ->perDay()
            ->sum('value');

        return [
            'datasets' => [
                [
                    'label' => 'Indice',
                    'data' => $data->map(fn(TrendValue $value) => $value->aggregate),
                    'backgroundColor' => '#36A2EB',
                    'borderColor' => '#9BD0F5',
                ],
            ],
            'labels' => $data->map(fn(TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
    
}
