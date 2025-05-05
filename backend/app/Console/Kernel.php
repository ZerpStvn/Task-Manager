<?php
namespace App\Console;

use App\Models\Task;
use Illuminate\Support\Facades\Log;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function (): void {
            Task::where('created_at', '<', now()->subDays(30))
                ->each(fn(Task $t): void => Log::info("Deleting {$t->id}") & $t->delete());
        })->dailyAt('00:00');
    }

    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}