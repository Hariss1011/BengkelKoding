<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected function redirectTo()
    {
        return '/pasien';
    }

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'alamat'   => ['required', 'string'],
            'no_hp'    => ['required', 'string'],
            'no_ktp'   => ['required', 'string'],
        ]);
    }

    protected function create(array $data)
    {
        // Generate no_rm unik otomatis
        $tanggal = Carbon::now()->format('ymd');
        $no_rm = '';
        $counter = 1;

        do {
            $no_rm = 'RM' . $tanggal . str_pad($counter, 3, '0', STR_PAD_LEFT);
            $counter++;
        } while (User::where('no_rm', $no_rm)->exists());

        return User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            'alamat'   => $data['alamat'],
            'no_hp'    => $data['no_hp'],
            'no_ktp'   => $data['no_ktp'],
            'role'     => 'pasien',
            'no_rm'    => $no_rm,
        ]);
    }
}
