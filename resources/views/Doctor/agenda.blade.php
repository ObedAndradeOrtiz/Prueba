@extends('Layouts.dashboard')
@section('contenido')
{{-- <h1>Ver Cita</h1>
@foreach ($citas as $cita)
    <div class="contenedor-show">
        <div class="show-dato">
            <span>Nombre: </span>
            <span>{{$cita->paciente->user->name}}</span>
        </div>

        <div class="show-dato">
            <span>Fecha y Hora: </span>
            <span>{{$cita->fecha_hora}}</span>
        </div>
        <div class="show-dato">
            <span>Descripcion: </span>
            <span>{{$cita->description}}</span>
        </div>
        <a href="{{route('receta.createCita', $cita->id)}}" class="btn btn-info">Crear Receta</a>
        <a href="{{route('receta.show', $cita->id)}}" class="btn btn-info">Ver Receta</a>

        <br>
        <span>-----------------------------</span>
        <span>-----------------------------</span>
    </div>
    @endforeach --}}

    {{-- <script>
      var btnReceta = document.getElementById("recetaBtn")
      btnReceta.addEventListener('click', (e) => {
          alert("btnReceta.value")
          // var inputIdReceta = document.getElementById("idCita")
          // inputIdReceta.value = btnReceta.value;
      });
    </script> --}}
  <head>
  	<title>Calendar</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="{{asset('css/style.css')}} ">
	</head>
	<body>
	<section class="ftco-section">
		<div hidden="true">

			<p id="pdataJson">{{$dataJson}}</p>
		</div>

		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center">
					<h2 class="heading-section">Calendario</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="content w-100">
				    <div class="calendar-container">
				      <div class="calendar"> 
				        <div class="year-header"> 
				          <span class="left-button fa fa-chevron-left" id="prev"> </span> 
				          <span class="year" id="label"></span> 
				          <span class="right-button fa fa-chevron-right" id="next"> </span>
				        </div> 
				        <table class="months-table w-100"> 
				          <tbody>
				            <tr class="months-row">
				              <td class="month">Ene</td> 
				              <td class="month">Feb</td> 
				              <td class="month">Mar</td> 
				              <td class="month">Abr</td> 
				              <td class="month">May</td> 
				              <td class="month">Jun</td> 
				              <td class="month">Jul</td>
				              <td class="month">Ago</td> 
				              <td class="month">Sep</td> 
				              <td class="month">Oct</td>          
				              <td class="month">Nov</td>
				              <td class="month">Dic</td>
				            </tr>
				          </tbody>
				        </table> 
				        
				        <table class="days-table w-100"> 
				          <td class="day">Dom</td> 
				          <td class="day">Lun</td> 
				          <td class="day">Mar</td> 
				          <td class="day">Mie</td> 
				          <td class="day">Jue</td> 
				          <td class="day">Vie</td> 
				          <td class="day">Sab</td>
				        </table> 
				        <div class="frame"> 
				          <table class="dates-table w-100"> 
			              <tbody class="tbody">             
			              </tbody> 
				          </table>
				        </div> 
				         {{-- <button class="button" id="add-button">Add Event</button> --}}
				      </div>
				    </div>
				    <div class="events-container">
				    </div>
				    <div class="dialog" id="dialog">
				        <h2 class="dialog-header"> Add New Event </h2>
				        <form class="form" id="form">
				          <div class="form-container">
				            <label class="form-label" id="valueFromMyButton" for="name">Event name</label>
				            <input class="input" type="text" id="name" maxlength="36">
				            <label class="form-label" id="valueFromMyButton" for="count">Number of people to invite</label>
				            <input class="input" type="number" id="count" min="0" max="1000000" maxlength="7">
				            <input type="button" value="Cancel" class="button" id="cancel-button">
				            <input type="button" value="OK" class="button button-white" id="ok-button">
				          </div>
				        </form>
				      </div>
				  </div>
				</div>
			</div>
		</div>
	</section>
  <script src="{{asset('js/jquery.min.js')}}"></script>
  <script src="{{asset('js/popper.js')}}"></script>
  <script src="{{asset('js/bootstrap.min.js')}}"></script>
  <script src="{{asset('js/main.js')}}"></script>
</body>  
    @endsection

