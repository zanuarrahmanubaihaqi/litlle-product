<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
          'username' => 'admin',
          'password' => bcrypt('passw0rd'),
          'email' => 'adminroot@mail.co.id',
          'name' => 'System Administrator',
          'level' => 1,
          'remember_token' => $this->generateRandStr(10),
          'created_at' => date('Y-m-d H:i:s')
        ]);
    }

    public function generateRandStr($length = 10) {
        $char = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charLength = strlen($char);
        $randStr = '';
        for ($i = 0; $i < $length; $i++) {
            $randStr .= $char[rand(0, $charLength - 1)];
        }
        return $randStr;
    }
}
