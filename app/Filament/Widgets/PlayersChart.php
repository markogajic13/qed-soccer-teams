<?php

namespace App\Filament\Widgets;

use App\Models\Player;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class PlayersChart extends ChartWidget
{
    protected static ?string $heading = 'Player average Overall Score Chart';
    protected static ?string $maxHeight = '300px';
    protected static string $color = 'success';

    protected function getData(): array
    {
        $trend = Trend::query(Player::where('email', 'like', '%@gmail.com'))
            ->between(
                start: now()->startOfMonth()->subMonths(2),
                end: now()->endOfMonth(),
            )
            ->perMonth()
            ->average('overall_score');

        return [
            'datasets' => [
                [
                    'label' => 'Average Overall Score',
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

