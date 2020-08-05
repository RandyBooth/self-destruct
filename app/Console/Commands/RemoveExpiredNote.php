<?php

namespace App\Console\Commands;

use App\Note;
use Illuminate\Console\Command;

class RemoveExpiredNote extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sd:remove-expired-note';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '';

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
        Note::withoutEvents(
            function () {
                $now = now();
                $nowSub30Days = $now->copy()->subDays(30);

                Note
                    ::withoutGlobalScope('expired')
                    ->where('expired_at', '<=', $now)
                    ->orWhere(
                        function ($query) use ($nowSub30Days) {
                            $query->where('created_at', '<=', $nowSub30Days)
                                ->whereNull('expired_at');
                        }
                    )
                    ->delete();
            }
        );
    }
}
