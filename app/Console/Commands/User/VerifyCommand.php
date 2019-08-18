<?php

namespace App\Console\Commands\User;

use App\Domain\User\Entities\User;
use App\Domain\User\Services\UserService;
use Illuminate\Console\Command;

/**
 * Class VerifyCommand
 * @package App\Console\Commands\User
 * @property UserService $service
 */
class VerifyCommand extends Command
{
    protected $signature = 'user:verify {email}';
    protected $description = 'Verify user by email';

    private $service;

    public function __construct(UserService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    public function handle()
    {
        $email = $this->argument('email');
        if ($user = User::where('email', $email)->first()) {
            try {
                $this->service->verify($user->id);
            } catch (\Exception $e) {
                $this->error($e->getMessage());
                return false;
            }
            $this->info("User verified successfully.");
            return true;
        }
        $this->error("Undefined user with email $email");
        return false;
    }
}
