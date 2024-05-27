<?php

namespace App\Filament\Widgets;

use App\Models\Player;
use App\Models\Team;
use App\Models\League;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?string $pollingInterval = '10s';
    protected static bool $isLazy = false;
    protected function getStats(): array
    {
        return [
            Stat::make('Total Players', Player::query()->count())
                ->description('All league players') 
                ->descriptionIcon('heroicon-o-user')
                ->color('success'),
            Stat::make('Total Teams', Team::query()->count())
                ->description('All league teams') 
                ->descriptionIcon('heroicon-o-user-group')
                ->color('success'),
            Stat::make('Total Leagues', League::query()->count())
                ->description('All leagues') 
                ->descriptionIcon('heroicon-o-squares-2x2')
                ->color('success'),
            Stat::make('Performance Score', Player::query()->where('performance_score', '>', 90)->count())
                ->description('Players with performance score above 90') 
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
        ];
    }
}

