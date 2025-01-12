<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VerificationEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class VerificationController extends Controller
{
    public function input()
    {
        return view('auth.verify-email');
    }

    public function verify(Request $request)
    {
        // Validasi input
        $request->validate(['code' => 'required|numeric']);

        // Ambil pengguna berdasarkan sesi
        $user = User::find(session('user_id'));

        if (!$user) {
            return redirect()->route('register.create')->withErrors(['user' => 'Pengguna tidak ditemukan.']);
        }

        // Pastikan kolom 'email_verification_expires_at' tidak null
        if (!$user->email_verification_expires_at) {
            return redirect()->route('verification.input')->withErrors(['code' => 'Kode verifikasi telah kadaluarsa.']);
        }

        // Pastikan waktu sekarang masih dalam masa berlaku
        $expiresAt = Carbon::parse($user->email_verification_expires_at, 'Asia/Makassar');

        if (
            $user->email_verification_code === $request->code &&
            Carbon::now('Asia/Makassar')->lessThanOrEqualTo($expiresAt)
        ) {
            // Tandai email sebagai terverifikasi
            $user->email_verified_at = Carbon::now('Asia/Makassar');
            $user->email_verification_code = null;
            $user->email_verification_expires_at = null;
            $user->save();

            return redirect()->route('dashboard')->with('success', 'Email berhasil diverifikasi.');
        }

        // Jika kode salah atau sudah kadaluarsa
        return redirect()->route('verification.input')->withErrors(['code' => 'Kode verifikasi salah atau sudah kedaluwarsa.']);
    }

    /**
     * Kirim ulang kode verifikasi ke email pengguna.
     */
    public function resend()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->withErrors(['user' => 'Pengguna tidak ditemukan.']);
        }

        // Generate kode verifikasi baru
        $verificationCode = mt_rand(100000, 999999);
        $expirationTime = Carbon::now('Asia/Makassar')->addMinutes(30); // Waktu Makassar

        // Update kode verifikasi di database
        $user->update([
            'email_verification_code' => $verificationCode,
            'email_verification_expires_at' => $expirationTime->format('Y-m-d H:i:s'), // Format lengkap
        ]);

        // Kirim email verifikasi
        Mail::to($user->email)->send(new VerificationEmail($verificationCode, $user->name, $expirationTime->format('H:i') . ' WITA'));

        return back()->with('success', 'Kode verifikasi telah dikirim ulang ke email Anda.');
    }
}
