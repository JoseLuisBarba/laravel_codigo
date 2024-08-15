<?php

namespace App\Http\Controllers;

use App\Events\ServicioSaved;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Models\Servicio;
use App\Http\Requests\CreateServicioRequest;
use App\Models\Category;

class Servicios2Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function __construct() {
        //$this->middleware('auth')->only('create', 'edit');
        $this->middleware('auth')->except('index','show');
    }

    public function index()
    {
        //
        $servicios = Servicio::latest()->paginate(2);
        return view('servicios', [
            'servicios' => Servicio::with('category')->latest()->paginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('create', [
            'servicio' => new Servicio,
            'categories' => Category::pluck('name', 'id') //extraer
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

        $servicio = new Servicio($request->validated());
        $servicio->image = $request->file('image')->store('images');
        $servicio->save();
        //optimizar la imagen que se ha guardado
        $image = Image::make(storage::get($servicio->image))
        ->widen(600)
        ->limitColors(255)
        ->encode();
        Storage::put($servicio->image, (string) $image);
        ServicioSaved::dispatch($servicio);
        return redirect()->route('servicios.index')->with('estado', 'El servicio fue creado correctamente');
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
            'servicio' => $id,
            'categories' => Category::pluck('name', 'id') //extraer
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     */
    public function update(Servicio $id, CreateServicioRequest $request)
    {
        //
        if($request->hasFile('image')){ // si enviamos una imagen
            Storage::delete($id->image);
            $id->fill($request->validated());
            $id->image = $request->file('image')->store('images');
            $id->save();
            //optimizar la imagen que se ha guardado
            $image = Image::make(storage::get($id->image))
                ->widen(600)
                ->limitColors(255)
                ->encode();
            //sobreescribir
            Storage::put($id->image, (string) $image);
            //Creamos el disparador enviando como parámetro el servicio
            ServicioSaved::dispatch($id);
        } else{
            $id->update( array_filter($request->validated()));
        }
        
        return redirect()->route('servicios.show', $id)->with('estado', 'El servicio fue actualizado correctamente');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Servicio $servicio)
    {
        //
        Storage::delete($servicio->image);
        $servicio->delete();
        return redirect()->route('servicios.index');
    }
}
