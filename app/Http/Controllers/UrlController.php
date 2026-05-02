<?php

namespace App\Http\Controllers;

use App\Models\Companies;
use App\Models\User;
use App\Models\Urls;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class UrlController extends Controller
{

 public function store(Request $request): RedirectResponse
{
    $request->validate([
        'long_url'  => 'required|string|active_url|max:2048|regex:/^https?:\/\//',
    ]);

    if (str_contains($request->long_url, 'localhost')) {
    return back()->with('error', 'Local URLs not allowed');
    }
        $company_id = auth()->user()->company_id;
        $user_id = auth()->user()->id;
        $company = Companies::find($company_id);
                if (!$company) {
                    return Redirect::route('dashboard')
                        ->with('status', 'Company not found.'); 
                }
    
    
             $check = Urls::where('long_url', $request->long_url)->where('company_id', $company_id)->first();
        if($check) {
            return Redirect::route('generate-url')
                ->with('status', 'Short URL already exists for your company: ' . url('s/' . $check->short_url));
        }

        $shortUrl = Str::random(6);

        $url = new Urls();
        $url->long_url = $request->long_url;
        $url->short_url = $shortUrl;
        $url->company_id = $company_id;
        $url->user_id = $user_id;
        $url->save();

        return Redirect::route('dashboard')
            ->with('status', 'Short URL generated successfully: ' . url('s/' . $shortUrl));
    

    

  
    

}
    public function redirect($code)
    {
        $url = Urls::where('short_url', $code)
                    ->first();

        if (!$url) {
            abort(404);
        }

        return redirect()->away($url->long_url);
    }


}