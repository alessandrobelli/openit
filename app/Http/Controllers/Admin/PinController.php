<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use DB;
use Excel;
use Storage;
use App\Pin;
use App\MapRoute;
use App\Http\Requests;
use App\DisabilityType;
use App\Http\Controllers\Controller;

class PinController extends Controller
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
        $data['pins'] = Pin::orderBy('id', 'desc')->get();

        return view('admin.pins.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['routes'] = MapRoute::lists('name', 'id');
        $data['disabilities'] = DisabilityType::lists('name', 'id');

        return $this->makeResponse(null, 'admin.pins.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pin = Pin::create($request->all());

        if ($request->hasFile('image')) {
            $destinationPath = 'files/';
            $fileName = time() . '_' . $request->file('image')->getClientOriginalName();

            Storage::disk('public')->put(
                $destinationPath . $fileName,
                file_get_contents($request->file('image')->getRealPath())
            );

            $pin->image = $destinationPath . $fileName;
            $pin->save();
        }

        $pin->mapRoutes()->attach($request->input('routes'));

        $data['pin'] = $pin;

        return $this->makeResponse('', 'admin.pins.showRow', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['pin'] = Pin::findOrFail($id);

        return view('admin.pins.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['pin'] = Pin::findOrFail($id);
        $data['disabilities'] = DisabilityType::lists('name', 'id');
        $data['routes'] = MapRoute::lists('name', 'id');
        $data['selectedRoutes'] = array();

        foreach($data['pin']->mapRoutes as $route) {
            $data['selectedRoutes'][] = $route->pivot->map_route_id;
        }

        return $this->makeResponse(null, 'admin.pins.editRow', $data);
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
        $pin = Pin::findOrFail($id);

        $pin->update($request->all());

        if ($request->hasFile('image')) {
            $destinationPath = 'files/';
            $fileName = time() . '_' . $request->file('image')->getClientOriginalName();

            if ($request->has('removed_image')) {
                // Remove file from storage
                Storage::disk('public')->delete($pin->image);

                // Upload file in storage
                Storage::disk('public')->put(
                    $destinationPath . $fileName,
                    file_get_contents($request->file('image')->getRealPath())
                );

                $pin->image = $destinationPath . $fileName;
            } elseif (is_null($pin->image)) {
                Storage::disk('public')->put(
                    $destinationPath . $fileName,
                    file_get_contents($request->file('image')->getRealPath())
                );

                $pin->image = $destinationPath . $fileName;
            }

            $pin->save();
        }

        if (is_null($request->input('routes'))) {
            $pin->mapRoutes()->detach();
        } else {
            $pin->mapRoutes()->sync($request->input('routes'));
        }

        $data['pin'] = $pin;

        return back()->with('status', 'Pin Info Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pin = Pin::findOrFail($id);

        if (!is_null($pin->image)) {
            // Remove file from storage
            Storage::disk('public')->delete($pin->image);
        }

        $pin->mapRoutes()->detach();

        $affectedRows = $pin->delete();

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
        $data['pin'] = Pin::findOrFail($id);

        return $this->makeResponse('', 'admin.pins.showRow', $data);
    }

    /**
     * Toggle active field of a specific row
     *
     * @param int  $id
     * @return \Illuminate\Http\Response
     */
    public function toggleActive($id)
    {
        $data['pin'] = $this->changeActive(Pin::findOrFail($id));

        return $this->makeResponse('', 'admin.pins.showRow', $data);
    }

    /**
     * Download excel or csv file of pins
     *
     * @param string $fileType
     */
    public function exportPins($fileType = 'xlsx')
    {
        $pins = Pin::select('pins.id',
            'pins.name',
            'pins.latitude',
            'pins.longitude',
            DB::raw('IF(pins.crit = 1, "Yes", "No") as crit'),
            'pins.notes',
            'pins.image',
            'pins.created_at',
            DB::raw('disability_types.name as disability_type')
        )
            ->leftJoin('disability_types', 'disability_types.id', '=', 'pins.disability_type_id')
            ->get();

        Excel::create('OpenIT_Pins', function($excel) use($pins) {
            // Set the title
            $excel->setTitle('OpenIT Pins');

            // Call them separately
            $excel->setDescription('A demonstration to change the file properties');

            $excel->sheet('Pins', function($sheet) use($pins){
                $sheet->fromModel($pins);
            });

        })->download($fileType);
    }
}
