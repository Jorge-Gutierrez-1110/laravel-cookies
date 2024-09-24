<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class CookieController extends Controller
{

    public function index(Request $request){
        $alumnos = json_decode($request->cookie('alumnos', '[]'), true);
        return view('cookies.index', compact('alumnos'));
    }

    public function create(){
        return view('cookies.create');
    }

    public function store(Request $request){
        $alumnos = json_decode($request->cookie('alumnos', '[]'), true);
        $alumno = [
            'email' => $request->email,
            'password' => $request->password
        ];
        $alumnos[] = $alumno;
        return redirect('/cookies/listado')->withCookie(cookie('alumnos', json_encode($alumnos), 60));
    }

    public function edit($pos){
        $alumnos = json_decode(Cookie::get('alumnos'), true);

        if (!$alumnos || !isset($alumnos[$pos])) {
            return redirect('/cookies')->with('error', 'Alumno no encontrado');
        }

        return view('/cookies/editar')->with('alumno', $alumnos[$pos])->with('pos', $pos);
    }

    public function update($pos, Request $request){
        $alumnos = json_decode($request->cookie('alumnos', '[]'), true);
        $alumnos[$pos] = [
            'email' => $request->email,
            'password' => $request->password
        ];
        return redirect('/cookies/listado')->withCookie(cookie('alumnos', json_encode($alumnos), 60));
    }

    public function show($pos, Request $request){
        $alumnos = json_decode($request->cookie('alumnos', '[]'), true);
        $alumno = $alumnos[$pos];
        return view('cookies.show', compact('alumno'));
    }

    public function destroy($pos, Request $request){
        $alumnos = json_decode($request->cookie('alumnos', '[]'), true);
        unset($alumnos[$pos]);
        $alumnos = array_values($alumnos);
        return redirect('/cookies/listado')->withCookie(cookie('alumnos', json_encode($alumnos), 60));
    }

    public function vaciar(){
        return redirect('/cookies/listado')->withCookie(cookie()->forget('alumnos'));
    }

    public function recrear(Request $request) {
        $alumnos = [
            ['email' => 'correo@gmail.com', 'password' => 'contraseña1'],
            ['email' => 'soy.un.correo@gmail.com', 'password' => 'contraseña2'],
            ['email' => 'email@email.co', 'password' => 'contraseña3'],
        ];
        Cookie::queue('alumnos', json_encode($alumnos), 60);

        return redirect('/cookies/listado')->with('success', 'Cookie recreada con éxito.');
    }

}
