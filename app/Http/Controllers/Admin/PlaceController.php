<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Storage;
use App\Place;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PlaceController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['places'] = Place::orderBy('id', 'desc')->get();

        return view('admin.places.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->makeResponse(null, 'admin.places.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $place = Place::create($request->all());

        $data['place'] = $place;

        return $this->makeResponse('', 'admin.places.showRow', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['place'] = Place::findOrFail($id);

        return $this->makeResponse(null, 'admin.places.editRow', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $place = Place::findOrFail($id);

        $place->update($request->all());

        $data['place'] = $place;

        return $this->makeResponse('', 'admin.places.showRow', $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $place = Place::findOrFail($id);

        foreach($place->mapRoutes as $mapRoute) {
            $mapRoute->places()->detach();

            foreach($mapRoute->pins as $pin) {
                if (!is_null($pin->image)) {
                    Storage::disk('public')->delete($pin->image);
                }

                $pin->mapRoutes()->detach();
                $pin->delete();
            }

            $mapRoute->delete();
        }

        $affectedRows = $place->delete();

        return response()->json(['affectedRows' => $affectedRows]);
    }

    /**
     * Show a specific resource from storage (table row).
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showRow($id)
    {
        $data['place'] = Place::findOrFail($id);

        return $this->makeResponse('', 'admin.places.showRow', $data);
    }

    /**
     * Toggle active field of a specific row
     *
     * @param int  $id
     * @return \Illuminate\Http\Response
     */
    public function toggleActive($id)
    {
        $data['place'] = $this->changeActive(Place::findOrFail($id));

        return $this->makeResponse('', 'admin.places.showRow', $data);
    }
}
