@extends('Layouts.dashboard')

@section('contenido')
<h1>Gestionar Doctores</h1>
@if(Auth::user()->plan=='basico' && $contador<1)
<a href="{{ route('doctors.create') }}"  class="btn btn-info mb-3" >Nuevo Doctor</a>
@else
@if(Auth::user()->plan=='basico')
<a href=""  class="btn btn-warning mb-3" >Solicite un nuevo Plan</a>
@else
<a href="{{ route('doctors.create') }}"  class="btn btn-info mb-3" >Nuevo Doctor</a>
@endif
@endif

<table  class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nombre Completo</th>
            <th scope="col">Ci</th>
            <th scope="col">Telefono</th>
            <th scope="col">Especialidad</th>
            <th scope="col">Acciones</th>
            
        </tr>
    </thead>
    <tbody>
        @foreach($doctors as $doctor)
        @if ($id==$doctor->admin_id)
        <tr>
            <td>{{ $doctor->id}}</td>
            <td>{{ $doctor->user->name}}</td>
            <td>{{ $doctor->user->ci}}</td>
            <td>{{ $doctor->user->phone}}</td>
            <td>{{ $doctor->especialidad}}</td>
            <td>     
                <div class="table-data-option-list">
                    <form action="{{route ('doctors.destroy',$doctor->id)}}" method="POST">
                    <a class="table-data-option" href="{{route('doctors.edit',$doctor->id)}}" style="color:rgb(92, 230, 92)"><i class="fa-solid fa-file-pen"></i></a>  
                    <a class="table-data-option" href="{{route('doctors.show',$doctor->id)}}" style="color:rgb(102, 146, 228)"><i class="fa-solid fa-eye"></i></a>  
                        @method('delete')
                        @csrf
                        <button type="submit" class="table-data-option" onclick="return confirm('CONFIRMAR ELIMINACION')" style="color:rgb(238, 78, 73)"><i class="fa-solid fa-trash-can"></i></button>
                    </form>
                </div>
            </td>
        </tr>
        @endif
        @endforeach
    </tbody>
</table>  
{{$doctors->links('pagination::bootstrap-5')}}
@endsection

