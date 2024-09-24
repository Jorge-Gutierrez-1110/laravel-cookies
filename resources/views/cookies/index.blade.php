@extends('/plantilla/layout')

@section('contenido')

<div class="relative overflow-x-auto">
    <a href="/cookies/crear"
        class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Nuevo alumno</a>

    <form action="/cookies/vaciar" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Vaciar Alumnos</button>
    </form>

    <form action="/cookies/recrear" method="POST" style="display: inline;">
        @csrf
        <button type="submit" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Recrear la Cookie</button>
    </form>

    @if (session('success'))
        <div class="bg-green-500 text-white p-2 rounded">
            {{ session('success') }}
        </div>
    @endif


    @if (Cookie::has('alumnos'))
        @php
            $alumnos = json_decode(Cookie::get('alumnos'), true);
        @endphp

        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">email</th>
                    <th scope="col" class="px-6 py-3">password</th>
                    <th scope="col" class="px-6 py-3">editar</th>
                    <th scope="col" class="px-6 py-3">borrar</th>
                    <th scope="col" class="px-6 py-3">ver</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $posicion = 0;
                @endphp
                @foreach ($alumnos as $item)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $item['email'] }}
                        </th>
                        <td class="px-6 py-4">{{ $item['password'] }}</td>
                        <td class="px-6 py-4">
                            <a href="/cookies/editar/{{ $posicion }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</a>
                        </td>
                        <td class="px-6 py-4">
                            <form action="/cookies/borrar/{{ $posicion }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Borrar</button>
                            </form>
                        </td>
                        <td class="px-6 py-4">
                            <a href="/cookies/mostrar/{{ $posicion }}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Ver</a>
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
