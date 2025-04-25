<?php


namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Gustavo',
                'alamat' => 'Jl kanan',
                'no_hp' => '0221',
                'role' => 'pasien',
                'email' => 'gustavo@gmail.com',
                'password' => '12345678'
            ],
        ];
        foreach ($data as $d) {
            User::create([
                'name' => $d['name'],
                'alamat' => $d['alamat'],
                'no_hp' => $d['no_hp'],
                'role' => $d['role'],
                'email' => $d['email'],
                'password' => $d['password'],
            ]);
        }
    }
}
