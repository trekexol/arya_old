<?php

namespace App\Http\Controllers;

use App\Account;
use App\Client;
use App\ExpensesAndPurchase;
use App\Inventory;
use App\Provider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpensesAndPurchaseController extends Controller
{
 
    public function __construct(){

       $this->middleware('auth');
   }

   public function index()
   {
       $user       =   auth()->user();
       $users_role =   $user->role_id;
       if($users_role == '1'){

        $expensesandpurchases = ExpensesAndPurchase::orderBy('id' ,'DESC')
                                                    ->get();

        }elseif($users_role == '2'){
           return view('admin.index');
       }

       return view('admin.expensesandpurchases.index',compact('expensesandpurchases'));
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    
    public function create_expense($id_provider = null)
    {
        $provider = null;

        if(isset($id_provider)){
            $provider = Provider::find($id_provider);
        }
    
        $date = Carbon::now();
        $datenow = $date->format('Y-m-d');    

        return view('admin.expensesandpurchases.createexpense',compact('datenow','provider'));
    }

    public function create_expense_detail($id_provider = null)
    {
        $provider = null;

        if(isset($id_provider)){
            $provider = Provider::find($id_provider);
        }
    
        $date = Carbon::now();
        $datenow = $date->format('Y-m-d');    

        return view('admin.expensesandpurchases.create',compact('datenow','provider'));
    }

    public function createexpensesandpurchaseclient($id_client)
    {
        $client = null;
                
        if(isset($id_client)){
            $client = Client::find($id_client);
        }
        if(isset($client)){

       
            $date = Carbon::now();
            $datenow = $date->format('Y-m-d');    

            return view('admin.expensesandpurchases.createexpensesandpurchase',compact('client','datenow','transports'));

        }else{
            return redirect('/expensesandpurchases')->withDanger('El Cliente no existe');
        } 
    }

  


    public function create($id_expensesandpurchase)
    {
            $expensesandpurchase = null;
                
            if(isset($id_expensesandpurchase)){
                $expensesandpurchase = expensesandpurchase::find($id_expensesandpurchase);
            }

            if(isset($expensesandpurchase)){
                //$inventories_expensesandpurchases = expensesandpurchaseProduct::where('id_expensesandpurchase',$expensesandpurchase->id)->get();
                $inventories_expensesandpurchases = DB::table('products')
                                ->join('inventories', 'products.id', '=', 'inventories.product_id')
                                ->join('expensesandpurchase_products', 'inventories.id', '=', 'expensesandpurchase_products.id_inventory')
                                ->where('expensesandpurchase_products.id_expensesandpurchase',$id_expensesandpurchase)
                                ->select('products.*','expensesandpurchase_products.id as expensesandpurchase_products_id','inventories.code as code','expensesandpurchase_products.discount as discount',
                                'expensesandpurchase_products.amount as amount_expensesandpurchase')
                                ->get(); 
            
                
                $date = Carbon::now();
                $datenow = $date->format('Y-m-d');    
        
                return view('admin.expensesandpurchases.create',compact('expensesandpurchase','inventories_expensesandpurchases','datenow'));
            }else{
                return redirect('/expensesandpurchases')->withDanger('La cotizacion no existe');
            } 
            


    }
   

    public function selectproduct($id_expensesandpurchase)
    {
            $inventories     = Inventory::all();
        
            return view('admin.expensesandpurchases.selectinventary',compact('inventories','id_expensesandpurchase'));
    }


    public function selectprovider()
    {


            $providers     = Provider::all();
        
            return view('admin.expensesandpurchases.selectprovider',compact('providers'));
    }
    

    /**
        * Store a newly created resource in storage.
        *
        * @param  \Illuminate\Http\Request  $request
        * @return \Illuminate\Http\Response
        */
    public function store(Request $request)
        {
    
        $data = request()->validate([
            
        
            'id_provider'         =>'required',
            'id_user'         =>'required',
            'date-begin'         =>'required',
        
        ]);

        $var = new ExpensesAndPurchase();

        $var->id_provider = request('id_provider');
        $var->id_user = request('id_user');

        $var->invoice = request('invoice');
        $var->serie = request('serie');
        $var->observation = request('observation');

        $var->date = request('date-begin');

        $var->status =  "1";
    
        $var->save();

        return redirect('expensesandpurchases/register/'.$var->id.'')->withSuccess('Gasto o Compra Resgistrada Correctamente!');
        }


        public function storeproduct(Request $request)
        {
    
        $data = request()->validate([
            
        
            'id_expensesandpurchase'         =>'required',
            'id_inventory'         =>'required',
            'amount'         =>'required',
            'discount'         =>'required',
        
        
        ]);

        $var = new expensesandpurchaseProduct();

        $var->id_expensesandpurchase = request('id_expensesandpurchase');
        
        $var->id_inventory = request('id_inventory');

        if($var->id_inventory == -1){
            return redirect('expensesandpurchases/register/'.$var->id_expensesandpurchase.'')->withDanger('No se encontro el producto!');
        }
        $var->amount = request('amount');

        $var->discount = request('discount');

        if(($var->discount < 0) || ($var->discount > 100)){
            return redirect('expensesandpurchases/register/'.$var->id_expensesandpurchase.'')->withDanger('El descuento debe estar entre 0% y 100%!');
        }
        
        $var->status =  1;
    
        $var->save();

        return redirect('expensesandpurchases/register/'.$var->id_expensesandpurchase.'')->withSuccess('Producto agregado Exitosamente!');
        }
    /**
        * Display the specified resource.
        *
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
    public function show($id)
    {
        //
    }

    /**
        * Show the form for editing the specified resource.
        *
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
    public function edit($id)
    {
            $expensesandpurchase = expensesandpurchase::find($id);
        
            /*$segments    = Segment::all();
            $subsegments  = Subsegment::all();
        
            $unitofmeasures   = UnitOfMeasure::all();*/
        
            return view('admin.expensesandpurchases.edit',compact('expensesandpurchase','segments','subsegments','unitofmeasures'));
    
    }
    public function editexpensesandpurchaseproduct($id)
    {
            $expensesandpurchase_product = expensesandpurchaseProduct::find($id);
        
            if(isset($expensesandpurchase_product)){

                $inventory= Inventory::find($expensesandpurchase_product->id_inventory);

                return view('admin.expensesandpurchases.edit_product',compact('expensesandpurchase_product','inventory'));
            }else{
                return redirect('/expensesandpurchases')->withDanger('No se Encontro el Producto!');
            }
        
        
    
    }
    

    /**
        * Update the specified resource in storage.
        *
        * @param  \Illuminate\Http\Request  $request
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
    public function update(Request $request, $id)
    {

        $vars =  expensesandpurchase::find($id);

        $vars_status = $vars->status;
        $vars_exento = $vars->exento;
        $vars_islr = $vars->islr;
    
        $data = request()->validate([
            
        
            'segment_id'         =>'required',
            'sub_segment_id'         =>'required',
            'unit_of_measure_id'         =>'required',


            'type'         =>'required',
            'description'         =>'required',
        
            'price'         =>'required',
            'price_buy'         =>'required',
            'cost_average'         =>'required',

            'money'         =>'required',
        
            'special_impuesto'         =>'required',
            'status'         =>'required',
        
        ]);

        $var = expensesandpurchase::findOrFail($id);

        $var->segment_id = request('segment_id');
        $var->subsegment_id= request('sub_segment_id');
        $var->unit_of_measure_id = request('unit_of_measure_id');

        $var->code_comercial = request('code_comercial');
        $var->type = request('type');
        $var->description = request('description');
        
        $var->price = request('price');
        $var->price_buy = request('price_buy');
    
        $var->cost_average = request('cost_average');
        $var->photo_expensesandpurchase = request('photo_expensesandpurchase');

        $var->money = request('money');


        $var->special_impuesto = request('special_impuesto');

        if(request('exento') == null){
            $var->exento = "0";
        }else{
            $var->exento = "1";
        }
        if(request('islr') == null){
            $var->islr = "0";
        }else{
            $var->islr = "1";
        }
    

        if(request('status') == null){
            $var->status = $vars_status;
        }else{
            $var->status = request('status');
        }
    
        $var->save();

        return redirect('/expensesandpurchases')->withSuccess('Actualizacion Exitosa!');
        }



        

        public function updateexpensesandpurchaseproduct(Request $request, $id)
        { 

            $data = request()->validate([
                
                'amount'         =>'required',
                'discount'         =>'required',
            
            ]);
        
            $var = expensesandpurchaseProduct::findOrFail($id);
        
            $var->amount = request('amount');
        
            $var->discount = request('discount');
        
        
            $var->save();
        
            return redirect('/expensesandpurchases/register/'.$var->id_expensesandpurchase.'')->withSuccess('Actualizacion Exitosa!');
        
        }

    /**
        * Remove the specified resource from storage.
        *
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
    public function destroy($id)
    {
        //
    }

    
    public function listaccount(Request $request, $type = null){
        //validar si la peticion es asincrona
        if($request->ajax()){
            try{
                    $code_one = 0;  $code_two = 0;
                    $code_three = 0;

                if($type == 1){
                    $code_one = 1;  $code_two = 1;
                    $code_three = 8;
                }
                if($type == 2){
                    $code_one = 1;  $code_two = 2;
                    $code_three = 1;
                }
                if($type == 3){
                    $code_one = 5;  $code_two = 1;
                    $code_three = 1;
                }
                if($type == 4){
                    $code_one = 6;  $code_two = 1;
                    $code_three = 1;
                }
                if($type == 5){
                    $code_one = 6;  $code_two = 1;
                    $code_three = 2;
                }
                if($type == 6){
                    $code_one = 6;  $code_two = 1;
                    $code_three = 3;
                }
                if($type == 7){
                    $code_one = 6;  $code_two = 1;
                    $code_three = 4;
                }
                
                $respuesta = Account::select('id','description')->where('code_one',$code_one)
                                                                ->where('code_two', $code_two)
                                                                ->where('code_three', $code_three)
                                                                ->where('code_four', '<>',0)->get();
                return response()->json($respuesta,200);

            }catch(Throwable $th){
                return response()->json(false,500);
            }
        }
        
    }




}