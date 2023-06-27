<?php

namespace App\Http\Controllers\API\V1;;

use App\Models\Tour;
use App\Models\Travel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\TourResource;
use App\Http\Requests\TourListRequest;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TourListRequest $request,Travel $travel)
    {
        // filter tour data by tour
        $tours = $travel->tours()
                ->when($request->priceFrom, function ($query) use ($request){
                    $query->where('price','>=', $request->priceFrom*100);
                })
                ->when($request->priceTo, function ($query) use ($request){
                    $query->where('price','<=', $request->priceTo*100);
                })
                ->when($request->dateFrom, function ($query) use ($request){
                    $query->where('starting_date','>=', $request->dateFrom);
                })
                ->when($request->dateTo, function ($query) use ($request){
                    $query->where('ending_date','<=', $request->dateTo);
                })
                ->when($request->sortBy && $request->sortOrder, function ($query) use ($request){
                    $query->orderBy($request->sortBy,$request->sortOrder);
                })
                ->orderBy('starting_date')
                ->paginate();
        return TourResource::collection($tours);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Tour $tour)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tour $tour)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tour $tour)
    {
        //
    }
}
