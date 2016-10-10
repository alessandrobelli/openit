<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Storage;
//use App\Pin;
use App\Place;
use App\MapRoute;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class MapRouteController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth-admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['routes'] = MapRoute::orderBy('id', 'desc')->get();

        return view('admin.mapRoutes.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['places'] = Place::lists('name', 'id');

        return $this->makeResponse(null, 'admin.mapRoutes.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $mapRoute = MapRoute::create($request->all());

        $mapRoute->places()->attach($request->input('places'));

        $data['route'] = $mapRoute;

        return $this->makeResponse('', 'admin.mapRoutes.showRow', $data);
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
        $data['route'] = MapRoute::findOrFail($id);
        $data['places'] = Place::lists('name', 'id');
        $data['selectedPlaces'] = array();

        foreach($data['route']->places as $place) {
            $data['selectedPlaces'][] = $place->pivot->place_id;
        }

        return $this->makeResponse(null, 'admin.mapRoutes.editRow', $data);
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
        $mapRoute = MapRoute::findOrFail($id);

        $mapRoute->update($request->all());

        if (is_null($request->input('places'))) {
            $mapRoute->places()->detach();
        } else {
            $mapRoute->places()->sync($request->input('places'));
        }

        $data['route'] = $mapRoute;

        return $this->makeResponse('', 'admin.mapRoutes.showRow', $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mapRoute = MapRoute::findOrFail($id);

        $mapRoute->places()->detach();

        foreach($mapRoute->pins as $pin) {
            if (!is_null($pin->image)) {
                Storage::disk('public')->delete($pin->image);
            }

            $pin->mapRoutes()->detach();
            $pin->delete();
        }

        $affectedRows = $mapRoute->delete();

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
        $data['route'] = MapRoute::findOrFail($id);

        return $this->makeResponse('', 'admin.mapRoutes.showRow', $data);
    }

    /**
     * Toggle active field of a specific row
     *
     * @param int  $id
     * @return \Illuminate\Http\Response
     */
    public function toggleActive($id)
    {
        $data['route'] = $this->changeActive(MapRoute::findOrFail($id));

        return $this->makeResponse('', 'admin.mapRoutes.showRow', $data);
    }
}
