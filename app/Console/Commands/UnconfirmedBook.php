<?php

namespace App\Console\Commands;

use DateTime;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UnconfirmedBook extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:unconfirmed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deletes unconfirmed bookings that have more than two minutes!';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
       $bookings = DB::table('bookings')->get();

       foreach ($bookings as $booking){
           $minutes = $this->checkAge($booking);
           if ($booking->confirmed == '0' && $minutes > 5){
               DB::table('bookings')->where('id', $booking->id)->delete();
           }

       }

    }


    private function checkAge($booking)
    {

        $then = new DateTime($booking->created_at);
        $now = new DateTime();

        $diff = $now->diff($then);
        $minutes = ($diff->format('%a') * 1440) + // total days converted to minutes
            ($diff->format('%h') * 60) +   // hours converted to minutes
            $diff->format('%i');          // minutes

        return $minutes;

    }

}
