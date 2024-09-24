<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SesionController extends Controller
{
    public function index(){
        return view('/sesiones/index');
    }

    public function create(){
        return view('/sesiones/create');
    }

    public function store(Request $request){
        //dd($request->all());
        $alumnos = session('alumnos',[]);
        $alumno = [
            'email' => $request -> email,
            'password' => $request -> password
        ];
        session()->push('alumnos', $alumno);

        //$alumnos=[$alumno];
        //session()->put('alumno', $alumno);
        //session(['alumnos'=>$alumnos]);
        //dd(session()->all());
        return redirect('/sesiones/listado');
    }

    public function edit($pos){
        $alumnos = session ('alumnos');
        return view ('/sesiones/editar')->with('alumno',$alumnos[$pos])->with('pos', $pos);
    }

    public function update($pos, Request $request){
        $alumnos = session ('alumnos');
        $alumno=$alumnos[$pos];
        $alumno['email']=$request->email;
        $alumno['password']=$request->password;
        $alumnos[$pos]=$alumno;
        session()->put('alumnos',$alumnos);
        return redirect('/sesiones/listado');
    }

    public function show($pos){
        $alumnos = session('alumnos', []);
        $alumno = $alumnos[$pos];
        return view('sesiones.show', compact('alumno'));
    }

    public function destroy($pos){
        $alumnos = session('alumnos', []);
        unset($alumnos[$pos]);
        session()->put('alumnos', array_values($alumnos));
        return redirect('/sesiones/listado');
    }


    public function vaciar(){
        session()->forget('alumnos');
        return redirect('/sesiones/listado');
    }

}


