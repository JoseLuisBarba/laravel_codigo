<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servicio;
use App\Http\Requests\CreateServicioRequest;

class Servicios2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        //
        $servicios = Servicio::latest()->paginate(2);
        return view('servicios', compact('servicios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('create', [
            'servicio' => new Servicio
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $camposv = request()->validate([
            'titulo' => 'required',
            'descripcion' => 'required'
        ]);

        Servicio::create($camposv);

        return redirect()->route('servicios.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     */
    public function show($id)
    {
        //
        return view('show', [
            'servicio' => Servicio::find($id),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Servicio $id)
    {
        //
        return view('edit', [
            'servicio' => $id
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Servicio $id, CreateServicioRequest $request)
    {
        //
        $id->update($request->validated());
        return redirect()->route('servicios.show', $id);
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Servicio $servicio)
    {
        //
        $servicio->delete();
        return redirect()->route('servicios.index');
    }
}
