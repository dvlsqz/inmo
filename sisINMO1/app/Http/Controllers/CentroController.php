<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Centro;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CentroFormRequest;
use Illuminate\Support\Facades\Input;
use DB;

class CentroController extends Controller
{
  public function __construct(){
    $this->middleware('auth');
  }

  public function index(Request $request){
    if($request){
      $query= trim($request->get('searchText'));
      $centros=DB::table('centro as cen')
      ->select('cen.id','cen.nombre','cen.direccion','cen.departamento','cen.ciudad','cen.logo','cen.telefono1','cen.telefono2')
      ->where('cen.nombre','LIKE','%'.$query.'%')
      ->orderBy('cen.id','asc')
      ->groupBy('cen.id','cen.nombre','cen.direccion','cen.departamento','cen.ciudad','cen.logo','cen.telefono1','cen.telefono2')
      ->paginate(7);

      return view('centro_educativo.index',["centros"=>$centros,"searchText"=>$query]);
    }
  }

  public function create(){
    return view("centro_educativo.create");
  }

  public function store(CentroFormRequest $request /*Request $request*/){
    $centro= new Centro;
    $centro->id = $request->get('id');
    $centro->nombre = $request->get('nombre');
    $centro->direccion = $request->get('direccion');
    $centro->departamento = $request->get('departamento');
    $centro->ciudad	 = $request->get('ciudad');

    if(Input::hasFile('logo')){
      $file=Input::file('logo');
      $file->move(public_path().'/imagenes/logos/',$file->getClientOriginalName());
      $centro->logo=$file->getClientOriginalName();
    }

    $centro->telefono1 = $request->get('telefono1');
    $centro->telefono2 = $request->get('telefono2');


    $centro->save();
    return Redirect::to('centro_educativo/');
  }

  public function show($id){
    return view("centro_educativo.show",["centro"=>Centro::findOrFail($id)]);
  }

  public function edit($id){
    return view("centro_educativo.edit",["centro"=>Centro::findOrFail($id)]);
  }

  public function update(CentroFormRequest $request, $id){

    $centro=Centro::findOrFail($id);
    $centro->nombre = $request->get('nombre');
    $centro->direccion = $request->get('direccion');
    $centro->departamento = $request->get('departamento');
    $centro->cuidad = $request->get('ciudad');
    $centro->logo = $request->get('logo');
    $centro->telefono1 = $request->get('telefono1');
    $centro->telefono2 = $request->get('telefono2');
    $centro->update();

    return Redirect::to('centro_educativo/');
  }

  public function destroy($id){
    $centro = DB::table('centro')->where('id', '=',$id)->delete();
    return Redirect::to('centro_educativo/');
  }
}
