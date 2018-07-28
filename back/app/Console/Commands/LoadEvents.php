<?php

namespace App\Console\Commands;

use App\Models\Session;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Spatie\GoogleCalendar\Event;

class LoadEvents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'load:events';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Chargement des cours des agendas du Brest Open Campus';

    public function handle()
    {
        $events = Event::get();

        $final = [];
        foreach ($events as $event){
            $googleEvent = $event->googleEvent;
            $name = $googleEvent->summary;
            $pivot['name'] = $name;

            $start = $googleEvent->start;
            $dateCarbon = new Carbon($start->dateTime);
            $pivot['start'] = $dateCarbon->toDateTimeString();

            $end = $googleEvent->end;
            $dateCarbon = new Carbon($end->dateTime);
            $pivot['end'] = $dateCarbon->toDateTimeString();

            $session = Session::create($pivot);
            $session->save();

            array_push($final,$pivot);

        }

        print_r($final);
    }

    /**
     * @param $message
     */
    protected function log($message) {
        Log::debug('['.get_called_class().'] '.$message);
    }
}
