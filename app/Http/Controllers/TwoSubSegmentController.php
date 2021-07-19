<?php

namespace App\Http\Controllers;

use App\Subsegment;
use App\TwoSubSegment;
use Illuminate\Http\Request;

class TwoSubSegmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function list(Request $request, $id_subsegment = null){
        //validar si la peticion es asincrona
        if($request->ajax()){
            try{
                
                $subsegment = TwoSubsegment::select('id','description')->where('subsegment_id',$id_subsegment)->orderBy('description','asc')->get();
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
           $subsegments      =   TwoSubsegment::orderBy('id', 'asc')->get();
        }elseif($users_role == '2'){
            return view('admin.index');
        }

        return view('admin.twosubsegments.index',compact('subsegments'));
      
    }

    public function create()
    {
        $subsegments   = Subsegment::orderBy('description', 'asc')->get();

        return view('admin.twosubsegments.create',compact('subsegments'));
    }

    public function store(Request $request)
    {
       
        $data = request()->validate([
            'description'         =>'required|max:255',
            'segment_id'         =>'required',
            
        ]);

        $users = new TwoSubsegment();

        $users->description = request('description');
        $users->subsegment_id = request('segment_id');
        $users->status = 1;

        $users->save();
        return redirect('/twosubsegments')->withSuccess('Registro Exitoso!');
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

        $var        = TwoSubsegment::find($id);
        $subsegments   = SubSegment::all();

        return view('admin.twosubsegments.edit',compact('var','subsegments'));
    }

   


    public function update(Request $request,$id)
    {
        $subsegment =  TwoSubsegment::find($id);
       
        $subsegment_status = $subsegment->status;

        $request->validate([
            'description'         =>'required|max:255',
            'segment_id'  => 'required|integer',
            
        ]);

        
        $var = TwoSubsegment::findOrFail($id);
        $var->description         = request('description');
        $var->subsegment_id       = request('segment_id');
      
       
        if(request('status') == null){
            $var->status = $subsegment_status;
        }else{
            $var->status = request('status');
        }
       

        $var->save();


        return redirect('/twosubsegments')->withSuccess('Registro Guardado Exitoso!');

    }
}
