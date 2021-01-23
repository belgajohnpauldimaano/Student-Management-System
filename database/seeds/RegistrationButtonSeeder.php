<?php

use Illuminate\Database\Seeder;
use App\Models\RegistrationButton;

class RegistrationButtonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RegistrationButton::create([
            'name' => 'Registration Button',
            'is_enabled' => 0
        ]);
    }
}