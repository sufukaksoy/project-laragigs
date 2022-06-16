<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Ramsey\Uuid\Guid\Guid;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    //show all listings
    public function index()
    {
        return view('listings.index', [
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(6)
            // sondaki get metodu yerine paginate() kullanılırsa pagination yapılıyor.
            // parametredeki sayı kaçarlı sıralamamızı belirliyor.
            // simplePaginate metodu ile next-previous şekline paginate yapabiliyoruz.
        ]);
    }


    // show single listing
    public function show(Listing $listing)
    {
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    // show create form
    public function create()
    {
        return view('listings.create');
    }

    // store listing data

    public function store(Request $request)
    {
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos',
            'public');
        }

        Listing::create($formFields);


        return redirect('/')->with('message','Listing created successfully!');
    }
}
