@extends('/plantilla/layout')

@section('contenido')

{{-- <!--{{ dd(session()->all()) }}--> --}}

<div class="relative overflow-x-auto">
    <a href="/sesiones/crear"
        class="font-medium text-blue-600 datk:text-blue-500 hover:underline">Nuevo alumno</a>
    <a href="/sesiones/vaciar"
        class="font-medium text-blue-600 datk:text-blue-500 hover:underline">Vaciar Alumnos</a>
    @if (session()->has('alumnos'))
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    email
                </th>
                <th scope="col" class="px-6 py-3">
                    password
                </th>
                <th scope="col" class="px-6 py-3">
                    editar
                </th>
                <th scope="col" class="px-6 py-3">
                    borrar
                </th>
            </tr>
        </thead>
        <tbody>
            @php
                $posicion = 0;
            @endphp
            @foreach (session('alumnos') as $item)
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ $item['email'] }}
                </th>
                <td class="px-6 py-4">
                    {{ $item['password'] }}
                </td>
                <td class="px-6 py-4">
                    <a href="/sesiones/editar/{{ $posicion }}" class="font-medium text-blue-600 datk:text-blue-500 hover:underline">Editar</a>
                </td>
                <td class="px-6 py-4">
                    <form action="/sesiones/borrar/{{ $posicion }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="font-medium text-blue-600 datk:text-blue-500 hover:underline">Borrar</button>
                    </form>
                </td>
                <td class="px-6 py-4">
                    <a href="/sesiones/mostrar/{{ $posicion }}" class="font-medium text-blue-600 datk:text-blue-500 hover:underline">Ver</a>
                </td>
            </tr>
            @php
                $posicion++;
            @endphp
            @endforeach
        </tbody>

    </table>
    @else
        <h1>NO HAY REGISTROS</h1>
    @endif


</div>

@endsection
