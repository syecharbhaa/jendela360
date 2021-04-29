<?php

use Illuminate\Database\Seeder;
use App\Models\Dealer;

class DealerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Dealer::create([
            'name' => 'Dealer Jendela360',
            'username' => 'jendela360',
            'password' => md5('jendela360')
        ]);
    }
}
