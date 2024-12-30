<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class AssingAdminRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:assingadminrole';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assing admin role.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $username = $this->argument('username');

        $user = User::where('username', $username)->first();

        if (!$user) {
            $this->error('User not found.');
            return;
        }

        $user->assignRole('admin');

        $this->info('Admin role assigned to user.');

        return;
    }
}
