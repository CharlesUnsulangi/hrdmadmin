<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\MsHrUser;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'login' => 'required',
            'password' => 'required',
        ]);
        $user = MsHrUser::where('email', $data['login'])
            ->orWhere('username', $data['login'])
            ->first();
        
        if ($user && Hash::check($data['password'], $user->password)) {
            // Check if user is active using strict integer comparison
            if ($user->is_active != 1) {
                return back()->withErrors([
                    'login' => 'Akun Anda belum aktif. Silakan hubungi administrator.',
                ]);
            }
            
            Auth::login($user, $request->filled('remember'));
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }
        return back()->withErrors([
            'login' => 'Username/email atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|string|max:50',
            'email' => 'required|email|max:100|unique:ms_hr_user,email',
            'password' => 'required|string|min:6|confirmed',
        ]);
        $data['password'] = Hash::make($data['password']);
        MsHrUser::create($data);
        return redirect('/login')->with('success', 'Registrasi berhasil, silakan login.');
    }

    public function showForgotForm()
    {
        return view('auth.forgot');
    }

    // Implementasi reset password bisa ditambah sesuai kebutuhan
}
