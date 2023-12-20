<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::factory()->create(
            [
                'first_name' => 'Martin',
                'last_name' => 'Carlin',
                'email' => 'martin@martincarlin.uk',
                'bio' => 'Software Developer @ OneSpoke',
                'password' => '$2y$10$XbxLp782vrTqT.ae5rW8eeumUYYwfaB.58mbTbWCOMrdITlws9wBe',
                'is_admin' => 1,
                'account_type' => User::PERSONAL,
                'is_verified' => 1,
            ]
        );

        User::factory()->create(
            [
                'first_name' => 'Mehdi',
                'last_name' => 'Lachhab',
                'email' => 'mehdi@onespoke.co.uk',
                'bio' => 'Founder @ OneSpoke',
                'password' => '$2y$10$/OrpjitIOGpGx8mwY8JzSe9S.BIjvW8kfnQbBy8L.nmqm06atD.a6',
                'is_admin' => 1,
                'account_type' => User::PERSONAL,
                'is_verified' => 1,
            ]
        );

        User::factory()->create(
            [
                'first_name' => 'Kaz',
                'last_name' => null,
                'email' => 'Ka2012pro@gmail.com',
                'bio' => 'Founder @ OneSpoke',
                'password' => '$2a$10$GhWrvpuUVgkjAKCSTTmW/eoCFJa0WaaX.hnsYgAKhU8lpcd0tPysW',
                'is_admin' => 1,
                'account_type' => User::PERSONAL,
                'is_verified' => 1,
            ]
        );
    }
}
