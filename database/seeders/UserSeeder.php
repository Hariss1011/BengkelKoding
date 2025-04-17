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
                'name' => 'akhmad',
                'alamat' => 'Jl jalan',
                'no_hp' => '081234567',
                'role' => 'dokter',
                'email' => 'akhmad@gmail.com',
                'password' => '12345678'
            ],
            [
                'name' => 'haris',
                'alamat' => 'Jl kaki',
                'no_hp' => '087654321',
                'role' => 'pasien',
                'email' => 'haris@gmail.com',
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
