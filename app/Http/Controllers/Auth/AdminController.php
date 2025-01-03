<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function index(){

        $totalCustomers = \App\Models\Customer::count();
        $totalRooms = \App\Models\Room::count();
        $totalBookings = \App\Models\Booking::count();
        $totalPayments = \App\Models\Payment::count();

        return view('backend.dashboard', compact('totalCustomers', 'totalRooms', 'totalBookings', 'totalPayments'));
    }
    /**
     * Tampilkan form login.
     */
    public function showLoginFormAdmin()
    {
        return view('auth.admin.login');
    }

    /**
     * Proses login.
     */
    public function loginAdmin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Coba login dengan kredensial yang diberikan
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect sesuai role
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('home');
        }

        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ]);
    }

    /**
     * Proses logout.
     */
    public function logoutAdmin(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
