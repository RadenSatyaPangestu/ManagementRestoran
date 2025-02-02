<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Daftar command yang tersedia.
     */
    protected $commands = [
        \App\Console\Commands\AutoResetIncomingItems::class,
    ];

    /**
     * Tentukan jadwal tugas yang akan dijalankan.
     */
    protected function schedule(Schedule $schedule)
    {
        // Menjalankan reset data incoming_items setiap hari pada pukul 00:00
        $schedule->command('incoming_items:reset')->dailyAt('00:00');
    }

    /**
     * Registrasi perintah artisan untuk aplikasi ini.
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
