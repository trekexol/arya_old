<?php

namespace App\Http\Controllers;


use App\Segment;
use App\Subsegment;
use Illuminate\Http\Request;

class SubsegmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function list(Request $request, $id_segment = null){
        //validar si la peticion es asincrona
        if($request->ajax()){
            try{
                
                $subsegment = Subsegment::select('id','description')->where('segment_id',$id_segment)->orderBy('description','asc')->get();
                return response()->json($subsegment,200);
            }catch(Throwable $th){
                return response()->json(false,500);
            }
        }
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        $user       =   auth()->user();
        $users_role =   $user->role_id;
        if($users_role == '1'){
           $subsegments      =   Subsegment::orderBy('id', 'asc')->get();
        }elseif($users_role == '2'){
            return view('admin.index');
        }

    //dd('llego');
        return view('admin.subsegment.index',compact('subsegments'));
      
    }

    public function create()
    {

       /* $personregister         = Person::find($id);
        $estados                = Estado::orderBY('descripcion','asc')->pluck('descripcion','id')->toArray();
        $municipios             = Municipio::orderBY('descripcion','asc')->pluck('descripcion','id')->toArray();
       */ $segments                  = Segment::orderBy('description', 'asc')->get();

        return view('admin.subsegment.create',compact('segments'));
    }

    public function store(Request $request)
    {
        //
        $data = request()->validate([
            'description'         =>'required|max:255',
            'status'         =>'required|max:1',
            'segment_id'         =>'required',
            
        ]);

        $users = new Subsegment();

        $users->description = request('description');
        $users->segment_id = request('segment_id');
        $users->status = request('status');

        $users->save();
        return redirect('/subsegment')->withSuccess('Registro Exitoso!');
    }
    
    public function messages()
    {
        return [
            'segment_id.required' => 'A title is required',
            'segment_id'  => 'A message is required',
        ];
    }


    public function edit($id)
    {

        $var  = Subsegment::find($id);
        $segments        = Segment::all();

        return view('admin.subsegment.edit',compact('var','segments'));
    }

   


    public function update(Request $request,$id)
    {
        $subsegment =  Subsegment::find($id);
       
        $subsegment_status = $subsegment->status;

        $request->validate([
            'description'         =>'required|max:255',
            'segment_id'  => 'required|integer',
            
        ]);//verifica que el usuario existe

        
        $var = Subsegment::findOrFail($id);
        $var->description         = request('description');
        $var->segment_id       = request('segment_id');
      
       
        if(request('status') == null){
            $var->status = $subsegment_status;
        }else{
            $var->status = request('status');
        }
       

        $var->save();


        return redirect('/subsegment')->withSuccess('Registro Guardado Exitoso!');

    }


}