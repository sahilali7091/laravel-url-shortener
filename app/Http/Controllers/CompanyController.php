<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use App\Models\Urls;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class CompanyController extends Controller
{

   public function store(Request $request): RedirectResponse
{
    $request->validate([
        'company_name' => 'required|string|max:255',
    ]);

    $company = new Companies();
    $company->company_name = $request->company_name;
    $company->save();

    

    return Redirect::route('dashboard')
        ->with('status', 'Company Added successfully.');
}
    public function create()
    {
        if(auth()->user()->role === 'superadmin') {
            $short_url = Urls::all();
            $companies = Companies::all();
        } else  if(auth()->user()->role === 'Admin') {
            $short_url = Urls::where('company_id', auth()->user()->company_id)->get();
            $companies = Companies::where('id', auth()->user()->company_id)->get();
        }else {
            $short_url = Urls::where('user_id', auth()->user()->id)->get();
            $companies = Companies::where('id', auth()->user()->company_id)->get();
        }
        return view('dashboard', compact('short_url', 'companies'));

    }
}