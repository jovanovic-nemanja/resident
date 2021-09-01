<?php

namespace App\Console\Commands;

use App\User;
use Carbon\Carbon;
use App\Usermedications;
use App\Assignmedications;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DailyAssignMedications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dailyassignmedications:duplicate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return mixed
     */
    public function handle()
    {
        $cur_date = User::getformattime();
        $cur_day = Carbon::parse($cur_date['dates']);

        $assign_medications = DB::table('assign_medications')
                            ->select('assign_medications.*')
                            ->whereDate('assign_medications.start_day', '<=', $cur_day)
                            ->whereDate('assign_medications.end_day', '>=', $cur_day)
                            ->get();

        if (@$assign_medications) {
            foreach ($assign_medications as $assign_medication) {
                $rec = Usermedications::where('assign_id', $assign_medication->id)->first();
                if (@$rec) {
                    // code...
                }else{
                    $assignmedications = Assignmedications::create([
                        'medications' => $assign_medication->medications,
                        'dose' => @$assign_medication->dose,
                        'resident' => $assign_medication->resident,
                        'route' => $assign_medication->route,
                        'units' => $assign_medication->units,
                        'sign_date' => $cur_date['date'],
                        'photo' => @$assign_medication->photo,
                        'time' => @$assign_medication->time,
                        'remarks' => @$assign_medication->remarks,
                        'start_day' => $assign_medication->start_day,
                        'end_day' => $assign_medication->end_day
                    ]);
                }
            }
        }
    }
}
