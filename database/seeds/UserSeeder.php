<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class UserSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run(): void
    {
        $data = [
            [
                'name'  => 'John Doe',
                'email' => 'john@example.com',
                'password' => password_hash('password123', PASSWORD_BCRYPT),
            ],
            [
                'name'  => 'Jane Smith',
                'email' => 'jane@example.com',
                'password' => password_hash('password123', PASSWORD_BCRYPT),
            ]
        ];

        $this->table('users') // Table name
             ->insert($data)  // Insert data
             ->save();        // Save changes
    }
}
