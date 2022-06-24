<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('can:doctors.index')  ->only('index');
        $this->middleware('can:doctors.create') ->only('create', 'store');
        $this->middleware('can:doctors.edit')   ->only('edit', 'update');
        $this->middleware('can:doctors.show')   ->only('show');
        $this->middleware('can:doctors.destroy')->only('destroy');
        
    }


    public function index()
    {
        
        $doctor = Doctor::paginate(5);
        return view('doctor.index')->with('doctors',$doctor);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('doctor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'ci' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'password' => 'required',
            'fecha_nacimiento' => 'required',
        ]);
        $user                   = new User();
        $user->name             = $request->input('name');
        $user->ci               = $request->input('ci');
        $user->address          = $request->input('address');
        $user->phone            = $request->input('phone');
        $user->email            = $request->input('email');
        $user->password         = bcrypt($request->input('password'));
        $user->fecha_nacimiento = $request->input('fecha_nacimiento');
        $user->assignRole('Doctor');
        $user->save();
        $doctor = new Doctor();
        $doctor->especialidad = $request->input('especialidad');
        $doctor->user_id = $user->id;
        $doctor->save();

        $mytime = Carbon::now('America/La_Paz');
        DB::statement('CALL insertar_bitacora(?,?,?,?,?,?)',['Doctor', 'Crear',$user->name,$mytime->toDateTimeString(),auth()->user()->id,
        auth()->user()->name]);
        
        return redirect()->route('doctors.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $doctor = Doctor::findorFail($id);
        $doctor->load('user');
        return view('doctor.show',['doctor' => $doctor]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $doctor = Doctor::findorFail($id);
        $doctor->load('user');
        return view('doctor.edit',['doctor' => $doctor]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'ci' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required',
            //'password' => 'required',
            'fecha_nacimiento' => 'required',
            'especialidad' => 'required',
        ]);
        $user                   = User::findorFail($id);
        $user->name             = $request->input('name');
        $user->ci               = $request->input('ci');
        $user->address          = $request->input('address');
        $user->phone            = $request->input('phone');
        $user->email            = $request->input('email');
        //$user->password         = $request->input('password');
        $user->fecha_nacimiento = $request->input('fecha_nacimiento');
        $user->save();
        $doctor = $user->doctor;
        $doctor->especialidad = $request->input('especialidad');
        $doctor->user_id = $user->id;
        $doctor->save();

        $mytime = Carbon::now('America/La_Paz');
        DB::statement('CALL insertar_bitacora(?,?,?,?,?,?)',['Doctor', 'Modificar',$user->name,$mytime->toDateTimeString(),auth()->user()->id,
        auth()->user()->name]);

        return redirect()->route('doctors.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $doctor = Doctor::findorFail($id);
        $user   = User::findorFail($doctor->user_id);
        $doctor->delete();
        $user->delete();

        $mytime = Carbon::now('America/La_Paz');
        DB::statement('CALL insertar_bitacora(?,?,?,?,?,?)',['Doctor', 'Eliminar',$user->name,$mytime->toDateTimeString(),auth()->user()->id,
        auth()->user()->name]);

        return redirect()->route('doctors.index');
    }
}
