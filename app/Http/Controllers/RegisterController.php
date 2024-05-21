<?php

namespace App\Http\Controllers;

use App\Mail\MailSend;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function register()
    {
        return view('register');
    }

    protected function actionregister(Request $request)
    {
        $str = Str::random(100);
        $user = User::create([
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'active' => 0,
            'verify_key' => $str
        ]);

        //VERIFIKASI EMAIL
        // $details = [
        //     'username' => $request->username,
        //     'role' => $request->role,
        //     'website' => 'www.ayongoding.com',
        //     'datetime' => date('Y-m-d H:i:s'),
        //     'url' => request()->getHttpHost() . '/register/verify/' . $str
        // ];

        // Mail::to($request->email)->send(new MailSend($details));

        return redirect('/')->with(['success' => 'Akun berhasil dibuat, silahkan Login !']);
    }

    public function verify($verify_key)
    {
        $keyCheck = User::select('verify_key')
            ->where('verify_key', $verify_key)
            ->exists();

        if ($keyCheck) {
            $user = User::where('verify_key', $verify_key)
                ->update([
                    'active' => 1
                ]);

            return "Verifikasi Berhasil. Akun Anda sudah aktif.";
        } else {
            return "Key tidak valid!";
        }
    }
}
