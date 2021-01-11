<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use Illuminate\Http\Request;
use LaravelLocalization;

class CrudController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getOffers()
    {
        return Offer::select() -> get();
    }

    public function create (){
        return view('offers.create');
    }

    public function store(OfferRequest $request)
    {
//        if ($valid -> fails()){
//            return redirect()->back()->withErrors($valid)->withInputs($request->all());
//        }

        Offer::create([
            'name_ar' => $request -> name_ar,
            'name_en' => $request -> name_en,
            'price' => $request -> price,
            'details_ar' => $request -> details_ar,
            'details_en' => $request -> details_en,
        ]);
        return redirect()->back()->with(['sucsses' => __('messages.Offer added successfully')]);
    }

    public function getAllOffers() {
        $offers = Offer::select(
            'id',
            'price',
            'name_' . LaravelLocalization::getCurrentLocale() . ' as name',
            'details_'.LaravelLocalization::getCurrentLocale() . ' as details') -> get();
        return view('offers.all', compact('offers'));
    }
}
