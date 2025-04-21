<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Event;

//Réaliser avec ChatGPT
class DailyEventReportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $today = now()->toDateString();

        $events = Event::whereDate('created_at', $today)->get();

        $csvData = "ID,Title,Date\n";
        foreach ($events as $event) {
            $csvData .= "{$event->id},\"{$event->title}\",{$event->created_at}\n";
        }

        $fileName = "reports/events_{$today}.csv";
        Storage::put($fileName, $csvData);
    }
}
