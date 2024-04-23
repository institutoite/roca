<?php

namespace App\Http\Controllers;

use App\Models\Pista;
use App\Models\Hermano;
use App\Http\Requests\StorePistaRequest;
use App\Http\Requests\UpdatePistaRequest;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class PistaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pistas=Pista::all();
        return view('pista.index',compact('pistas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ministros = Hermano::whereHas('papeles', function ($query) {
            $query->where('papel', 'MINISTRO');
        })->get();
        return view('pista.create',compact("ministros"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePistaRequest $request)
    {
        // if ($file = $request->file('foto')) {
        //     $fileName = hexdec(uniqid()).'.'.$file->getClientOriginalExtension();
        //     $path = 'public/portadas/';

        //     $file->storeAs($path, $fileName);
        //     $validatedData['product_image'] = $fileName;
        // }

        $pista = new Pista();
        $pista->nombre=$request->nombre;
        $pista->foto=$request->foto;
        $pista->hermano_id=$request->hermano_id;
        $pista->click=0;
        $pista->estado=1;
        
        if($request->file('foto')==true){
            $foto = $request->file('foto');
            $nombre=$this->GuardarImagenFisico($foto,'portadas');
            $pista->foto=$nombre;
        }
        
        if($request->file('pista')){
            $pistafile = $request->file('pista');
            $nombrepista=$this->GuardarImagenFisico($pistafile,'audios');
            $pista->audio = $nombrepista;
        }
        $pista->save();
        return redirect()->route("ministerios.index");


    }
    public function GuardarImagenFisico($imagen,$carpeta){
        $nombreArchivo=Str::random(5)."pista".'.'.$imagen->getClientOriginalExtension();
        $imagen->storeAs($carpeta,$nombreArchivo,'public');
        return $nombreArchivo;
    }


    /**
     * Display the specified resource.
     */
    public function show(Pista $pista)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pista $pista)
    {
        $ministros = Hermano::whereHas('papeles', function ($query) {
            $query->where('papel', 'MINISTRO');
        })->get();
        return view("pista.edit",compact("pista","ministros"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePistaRequest $request, Pista $pista)
    {

        if($request->hasFile('foto')){
            if (Storage::disk("public")->exists("portadas/".$pista->foto)) {
                Storage::disk('public')->delete('portadas/'.$pista->foto);
            }
            $imagen=$request->file('foto');
            $nuevoNombre=$this->GuardarImagenFisico($imagen,"portadas");
            $pista->foto=$nuevoNombre;
        }
        if($request->hasFile('pista')){
            //dd($request->hasFile('pista'));
            if (Storage::disk("public")->exists("audios/".$pista->audio)) {
                Storage::disk('public')->delete('audios/'.$pista->audio);
            }
            $audiofile=$request->file('pista');
            $nuevoNombreAudio=$this->GuardarImagenFisico($audiofile,"audios");
            $pista->audio=$nuevoNombreAudio;
        }
        $pista->nombre=$request->nombre;
        $pista->hermano_id=$request->hermano_id;
        $pista->click=0;
        $pista->estado=1;
        $pista->save();
        return redirect()->route("ministerios.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pista $pista)
    {
        //
    }
    public function guardar(Request $request)
    {
        // Validación del formulario
        $validator = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pista' => 'required|mimes:audio/mpeg,mpga,mp3,wav,|max:2048',
            'hermano_id' => 'required|exists:ministros,id',
            'g-recaptcha-response' => 'required|recaptcha'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()], 422);
        }

        // Procesamiento del formulario y almacenamiento en la base de datos

        return response()->json(['success' => '¡Formulario enviado correctamente!']);
    }
}
