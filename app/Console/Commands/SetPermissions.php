<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Thermometer;

class SetPermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:set-permissions {username} {status}'; 

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set permissions for a specific thermometer.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $username = $this->argument('username');
        $status = $this->argument('status');

        $user = Thermometer::where('username', $username)->first();

        if (!$user) {
            $this->error('User not found.');
            return;
        }

        $user->has_permission = $status;

        $user->save();

        $this->info('User permissions updated.');

        return;
    }
}
