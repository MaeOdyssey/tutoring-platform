<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Payment;
use App\Models\User;
use App\Models\Session;

class PaymentSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $sessions = Session::all();

        if ($users->isEmpty() || $sessions->isEmpty()) {
            $this->command->info('No users or sessions found. Seed them first!');
            return;
        }

        foreach ($users as $user) {
            // Pick 1–3 random sessions per user to pay for
            $userSessions = $sessions->where('user_id', $user->id)->random(min(3, $sessions->where('user_id', $user->id)->count()));

            foreach ($userSessions as $session) {
                Payment::create([
                    'user_id' => $user->id,
                    'session_id' => $session->id,
                    'amount' => fake()->randomFloat(2, 20, 100),
                    'method' => fake()->randomElement(['card', 'paypal', 'cash']),
                    'status' => fake()->randomElement(['paid', 'pending', 'failed']),
                ]);
            }
        }
    }
}
