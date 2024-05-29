<?php

namespace App\Filament\Widgets;

use App\Models\Player;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class FemalePlayersChart extends ChartWidget
{
    protected static ?string $heading = 'Female Player average Performance Score Chart';
    protected static ?string $maxHeight = '300px';
    protected static string $color = 'success';

    protected function getData(): array
    {
        $trend = Trend::query(Player::where('gender', 'like', 'female'))
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->average('performance_score');
            
        return [
            'datasets' => [
                [
                    'label' => 'Average Performance Score',
                    'data' => $trend->map(fn(TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $trend->map(fn(TrendValue $value) => $value->date),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}

