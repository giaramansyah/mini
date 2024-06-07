<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Accounts;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class AutoLogoutCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'autologout:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scheduler for auto logout inactive account';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $carbon = Carbon::now();
        $timeout = $carbon->subMinutes(env('SESSION_LIFETIME', 125));

        $accounts = Accounts::where('is_login', 1)->where('is_trash', 0)->whereNull('remember_token')->where('last_login', '<=', $timeout)->get();
        foreach($accounts as $user) {
            $user->is_login = 0;
            $user->save();
            Log::info($user->username . ' session expired auto logout');
        }
    }
}
