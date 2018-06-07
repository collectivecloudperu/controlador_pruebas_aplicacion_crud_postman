<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Postres;
use Session;
use Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\ItemCreateRequest;
use App\Http\Requests\ItemUpdateRequest;
use Illuminate\Support\Facades\Validator;
use DB;
use Input;
use Storage;
use Auth;

class PostresController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$postres = Postres::all();
        
        return response()->json([
            'estado' => 'true',
            'mensaje' => 'Lista de Postres',
            'datos' => $postres
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemCreateRequest $request)
    {
        $resp = \App\Postres::create([
            'nombre' => $request['nombre'],
            'stock' => $request['stock'],
            'precio' => $request['precio'],
            'fecha_creacion' => date('Y-m-d H:i:s'),
            'fecha_actualizacion' => '0000-00-00 00:00:00',
        ]);

        return response()->json([
		    'estado' => 'true',
		    'mensaje' => 'Guardado Correctamente !',
		    'datos' => $resp
		]);
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ItemUpdateRequest $request, $id)
    {        
        $postres = Postres::find($id);

        $postres->fecha_actualizacion = date('Y-m-d H:i:s');
        
        $postres->fill($request->all());
        $postres->save();

        return response()->json([
		    'estado' => 'true',
		    'mensaje' => 'Editado Correctamente !',
		    'datos' => $postres
		]);

       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $imagen = Postres::find($id);

        foreach($imagen as $image){
            Storage::delete($image['path']);
        }

        Postres::destroy($id);        

        return response()->json([
		    'estado' => 'true',
		    'mensaje' => 'Eliminado Correctamente !'
		]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function json_postres()
    {
        $postres = Postres::all();

        $array = array(
	    	'records' => $postres->toArray()
		);

		return json_encode($array, JSON_PRETTY_PRINT);

        //return $postres->toJson();
    }

}
