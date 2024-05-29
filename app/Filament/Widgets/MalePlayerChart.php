<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Player;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class MalePlayerChart extends ChartWidget
{
    protected static ?string $heading = 'Male Player average Performance Score Chart';

    protected static ?string $maxHeight = '300px';
    protected static string $color = 'success';

    protected function getData(): array
    {
        $trend = Trend::query(Player::where('gender', 'male'))
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
