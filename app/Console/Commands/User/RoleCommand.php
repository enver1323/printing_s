<?php

namespace App\Console\Commands\User;

use App\Domain\User\Entities\User;
use Exception;
use Illuminate\Console\Command;

class RoleCommand extends Command
{
    protected $signature = 'user:role {email} {role}';
    protected $description = 'Assign role by email';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $email = $this->argument('email');
        $role = $this->argument('role');
        if ($user = User::where('email', $email)->first()) {
            try {
                $user->changeRole($role);
                $this->info("Role is successfully changed.");
                return true;
            } catch (Exception $e) {
                $this->error($e->getMessage());
                return false;
            }
        }
        $this->error("Undefined user with email $email");
        return false;
    }
}
