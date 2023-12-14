<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;

use Illuminate\Support\Facades\DB;

use App\Rules\UniqueEmail;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Models\Transaction;
session_start();

class AuthController extends Controller
{
    //
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    public function index(){
        $currentMonth = now()->startOfMonth();
        $nextMonth = now()->startOfMonth()->addMonth();

        $totalTransactions = Transaction::whereBetween('time', [$currentMonth, $nextMonth])->count();
       // Calculate total income and spending based on category name
       $totalIncome = Transaction::whereHas('category', function ($query) {
            $query->where('name', 'Nguồn thu');
        })->whereBetween('time', [$currentMonth, $nextMonth])->sum('total');

        $totalSpending = Transaction::whereHas('category', function ($query) {
            $query->where('name', '!=', 'Nguồn thu');
        })->whereBetween('time', [$currentMonth, $nextMonth])->sum('total');

       
   
        return view('pages.home', compact('totalTransactions', 'totalIncome', 'totalSpending'));
    }

    // public function wallet(){
    //     return view('pages.wallet');
    // }

   

    // public function transaction(){
    //     return view('pages.transaction');
    // }

    // public function profile(){
    //     return view('pages.profile');
    // }

    

    public function updateForm()
    {
        $user = Auth::user();
        return view('pages.profile', ['user' => $user]);
    }

    // ProfileController.php

    public function updateInfor(Request $request)
    {
    // Get the user ID from the session
        $userIdInSession = $request->session()->get('user_id');

        // $request->validate([
        //     'username' => 'required|string|max:255',
        //     'email' => 'required|string|email|max:255',
        //     'phone' => 'required|numeric|max:255',
        //     // Add other validation rules for additional fields
        // ]);

        // Retrieve the user by the ID from the session
        $user = User::find($userIdInSession);

        // Check if the user with the given ID exists
        if (!$user) {
            // Handle the case where the user does not exist (redirect, show error, etc.)
            return redirect()->back()->with('error', 'User not found.');
        }

        // Update the user's information
        $user->update([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            // Update other fields as needed
        ]);
        session(['username' => $user->username, 'user_id' => $user->id, 'email' => $user->email, 'phone' => $user->phone]);
        return redirect()->route('profile.update')->with('success', 'Chỉnh sửa thông tin cá nhân thành công');
    }
    public function showChangePasswordForm()
    {
        return view('pages.change_password');
    }

    public function changePassword(Request $request)
    {
        // $request->validate([
        //     'current_password' => 'required',
        //     'new_password' => 'required|min:8|confirmed',
        // ]);
        $userIdInSession = $request->session()->get('user_id');
        $user = User::find($userIdInSession);
       

        // Check if the current password matches
        if (!Hash::check($request->input('current_password'), $user->password)) {
            return redirect()->back()->with('error', 'Mật khẩu hiện tại không chính xác!.');
        }

        // Update the password
        $user->password = Hash::make($request->input('new_password'));
        $user->save();

        return redirect()->back()->with('success', 'Thay đổi mật khẩu thành công!.');
    }
    
}
