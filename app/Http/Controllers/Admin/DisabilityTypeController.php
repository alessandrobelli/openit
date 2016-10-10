<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\DisabilityType;
use App\Http\Controllers\Controller;

class DisabilityTypeController extends Controller
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
        $data['disabilities'] = DisabilityType::orderBy('id', 'desc')->get();

        return view('admin.disabilities.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->makeResponse(null, 'admin.disabilities.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $disability = DisabilityType::create($request->all());

        $data['disability'] = $disability;

        return $this->makeResponse('', 'admin.disabilities.showRow', $data);
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
        $data['disability'] = DisabilityType::findOrFail($id);

        return $this->makeResponse(null, 'admin.disabilities.editRow', $data);
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
        $disability = DisabilityType::findOrFail($id);

        $disability->update($request->all());

        $data['disability'] = $disability;

        return $this->makeResponse('', 'admin.disabilities.showRow', $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $disability = DisabilityType::findOrFail($id);
        $affectedRows = $disability->delete();

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
        $data['disability'] = DisabilityType::findOrFail($id);

        return $this->makeResponse('', 'admin.disabilities.showRow', $data);
    }
}
