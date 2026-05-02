<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class PersonController extends Controller
{

 public function store(Request $request): RedirectResponse
{
    $validation = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'company_id' => 'required|integer|exists:companies,id',
    ];

    if (auth()->user()->role === 'Admin') {
        $validation['role'] = 'required|string|in:Admin,Member';
    }

    $request->validate($validation);


    $company = Companies::find($request->company_id);
    if (!$company) {
        return Redirect::route('dashboard')
            ->with('status', 'Company not found.'); 
    }

  
    $userPassword = Str::random(10);
    $role = null;
    if(auth()->user()->role === 'superadmin') {
        $role = 'Admin';
    } elseif(auth()->user()->role === 'Admin') {
        $role = $request->role;
    }
    $user = new User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->company_id = $company->id;
    $user->role = $role;
    $user->password = Hash::make($userPassword);
    $user->save();

    
    Mail::raw(
        "Hello {$user->name},

            Your " . ucfirst($user->role) . " account has been created.

            Login Email: {$user->email}
            Password: {$userPassword}

            You can login with the above credentials.
            
            login here: " . url('/login'),
        function ($message) use ($user) {
            $message->to($user->email)
                    ->subject('Your ' . ucfirst($user->role) . ' Account Created');
        }
    );

    return Redirect::route('dashboard')
        ->with('status', ucfirst($user->role) . ' created successfully.');
}

public function create()
{
    if (auth()->user()->role === 'superadmin') {
        $companies = Companies::all();
    } else {
        $companies = Companies::where('id', auth()->user()->company_id)->get();
    }

    return view('add-new-person', compact('companies'));
}
}