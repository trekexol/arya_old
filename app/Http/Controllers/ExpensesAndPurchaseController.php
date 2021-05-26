<?php

namespace App\Http\Controllers;

use App\Account;
use App\Branch;
use App\Client;
use App\ExpensesAndPurchase;
use App\ExpensesDetail;
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
                                                    ->where('amount_with_iva','=',null)
                                                    ->get();

        }elseif($users_role == '2'){
           return view('admin.index');
       }

       return view('admin.expensesandpurchases.index',compact('expensesandpurchases'));
   }


   public function index_historial()
   {
       $user       =   auth()->user();
       $users_role =   $user->role_id;
       if($users_role == '1'){

        $expensesandpurchases = ExpensesAndPurchase::orderBy('id' ,'DESC')
                                                    ->where('amount_with_iva','<>',null)
                                                    ->get();

        }elseif($users_role == '2'){
           return view('admin.index');
       }

       return view('admin.expensesandpurchases.index_historial',compact('expensesandpurchases'));
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

    public function create_expense_detail($id_expense = null,$id_inventory = null)
    {
        $expense = null;
        $provider = null;
        $expense_details = null;
        
        $inventory = null;
        $accounts_inventory = null;

        if(isset($id_expense)){
            $expense = ExpensesAndPurchase::find($id_expense);

            $provider = Provider::find($expense->id_provider);

            $expense_details = ExpensesDetail::where('id_expense',$expense->id)->get();

            if(isset($id_inventory)){
                $inventory = Inventory::find($id_inventory);
                $accounts_inventory = Account::select('id','description')->where('code_one',1)
                                                                ->where('code_two', 1)
                                                                ->where('code_three', 8)
                                                                ->where('code_four', '<>',0)->get();
            }
        }
            $branches = Branch::orderBy('description','desc')->get();

            

        $date = Carbon::now();
        $datenow = $date->format('Y-m-d');    

        return view('admin.expensesandpurchases.create',compact('datenow','provider','expense','expense_details','branches','inventory','accounts_inventory'));
    }

   
  


    public function create_payment($id_expense)
    {
        $expense = null;
        $provider = null;
        $expense_details = null;

        if(isset($id_expense)){
            $expense = ExpensesAndPurchase::find($id_expense);

            $provider = Provider::find($expense->id_provider);

            $expense_details = ExpensesDetail::where('id_expense',$expense->id)->get();
        }else{
            return redirect('/expensesandpurchases')->withDanger('El Pago no existe');
        } 

            $anticipos_sum = 0;//Anticipo::where('status',1)->where('id_client',$quotation->id_client)->sum('amount');

            $accounts_bank = DB::table('accounts')->where('code_one', 1)
                                        ->where('code_two', 1)
                                        ->where('code_three', 2)
                                        ->where('code_four', '<>',0)
                                        ->get();
            $accounts_efectivo = DB::table('accounts')->where('code_one', 1)
                                        ->where('code_two', 1)
                                        ->where('code_three', 1)
                                        ->where('code_four', '<>',0)
                                        ->get();
            $accounts_punto_de_venta = DB::table('accounts')->where('description','LIKE', 'Punto de Venta%')
                                        ->get();
          
             $total= 0;
             $base_imponible= 0;

             foreach($expense_details as $var){
                 
                    $total += ($var->price * $var->amount);
               
                if($var->exento == 0){
                    $base_imponible += ($var->price * $var->amount); 
                }
             }

             $expense->total_factura = $total;
             $expense->base_imponible = $base_imponible;
            
             $date = Carbon::now();
             $datenow = $date->format('Y-m-d');    

             
     
             return view('admin.expensesandpurchases.create_payment',compact('expense','datenow','expense_details','accounts_bank', 'accounts_efectivo', 'accounts_punto_de_venta','anticipos_sum'));
         
         
    }

   

    public function selectprovider()
    {
            $providers     = Provider::all();
        
            return view('admin.expensesandpurchases.selectprovider',compact('providers'));
    }
    
    
    public function selectinventary($id_expense)
    {
            $inventories     = Inventory::all();
        
            return view('admin.expensesandpurchases.selectinventary',compact('inventories','id_expense'));
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


    public function store_detail(Request $request)
    {
    
            
                $data = request()->validate([
                    
                
                    'id_expense'    =>'required',
                    
                    'id_user'  =>'required',
                    'amount'        =>'required',
                    'description'   =>'required',
                    'price'         =>'required',
                
                
                ]);

                $var = new ExpensesDetail();

                $var->id_expense = request('id_expense');
                
                $var->id_user = request('id_user');
                $var->id_account = request('Account');
                
                $var->amount = request('amount');

                $var->description = request('description');
                $var->price = request('price');

                $var->id_branch = request('centro_costo');

                $exento = request('exento');
                if($exento == null){
                    $var->exento = false;
                }else{
                    $var->exento = true;
                }
                
                $islr = request('islr');
                if($islr == null){
                    $var->islr = false;
                }else{
                    $var->islr = true;
                }

                $id_inventory = request('id_inventory');
                if($id_inventory != -1){
                    $var->id_inventory = $id_inventory;
                }
                
                $var->status =  1;
            
                $var->save();

                return redirect('expensesandpurchases/register/'.$var->id_expense.'')->withSuccess('Agregado Exitosamente!');
    }


    public function store_payment(Request $request)
    {
        
        $id_expense = request('id_expense');

        $data = request()->validate([
            
        
            'total_pay_form'        =>'required',
            'id_user'               =>'required',
            'base_imponible_form'   =>'required',
            'sub_total_form'        =>'required',
            'iva'                   =>'required',
            'iva_amount_form'       =>'required',
        ]);

        $var = ExpensesAndPurchase::findOrFail($id_expense);

        if(isset($var)){
            $sin_formato_amount_iva = str_replace(',', '.', str_replace('.', '', request('iva_amount_form')));
        
            $var->iva_percentage = request('iva');
            
            $var->id_user = request('id_user');
    
            $var->base_imponible = request('base_imponible_form');
            $var->amount = request('sub_total_form');
            $var->amount_iva = $sin_formato_amount_iva;
            $var->amount_with_iva = request('total_pay_form');
           
            $var->save();
    
            return redirect('expensesandpurchases/register/'.$var->id.'')->withSuccess('Gasto o Compra Resgistrada Correctamente!');
        
        }else{
            return redirect('/expensesandpurchases')->withDanger('El Pago no existe');
        }

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
            $expensesandpurchase_product = ExpensesAndPurchase::find($id);
        
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
        
            $var = ExpensesAndPurchase::findOrFail($id);
        
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

    public function store_expense_credit(Request $request)
    {
        

        $sin_formato_base_imponible = str_replace(',', '.', str_replace('.', '', request('base_imponible')));
        $sin_formato_amount = str_replace(',', '.', str_replace('.', '', request('total_factura')));
        $sin_formato_amount_iva = str_replace(',', '.', str_replace('.', '', request('iva_amount')));
        $sin_formato_amount_with_iva = str_replace(',', '.', str_replace('.', '', request('grand_total')));
         

        $id_expense = request('id_expense');

        $expense = ExpensesAndPurchase::findOrFail($id_expense);

        $expense->base_imponible = $sin_formato_base_imponible;
        $expense->amount =  $sin_formato_amount;
        $expense->amount_iva =  $sin_formato_amount_iva;
        $expense->amount_with_iva =  $sin_formato_amount_with_iva;

        $credit = request('credit');

        $expense->iva_percentage = request('iva');

        $expense->credit_days = $credit;

        $expense->save();

        return redirect('expensesandpurchases/expensevoucher/'.$expense->id.'')->withSuccess('Gasto o Compra Guardada con Exito!');
    }

    

    public function create_expense_voucher($id_expense){

        $expense = null;
        $provider = null;
        $expense_details = null;

        if(isset($id_expense)){
            $expense = ExpensesAndPurchase::find($id_expense);

            $expense_details = ExpensesDetail::where('id_expense',$expense->id)->get();
        }else{
            return redirect('/expensesandpurchases')->withDanger('El Pago no existe');
        } 

             $total= 0;
             $base_imponible= 0;

             foreach($expense_details as $var){
                 
                    $total += ($var->price * $var->amount);
               
                if($var->exento == 0){
                    $base_imponible += ($var->price * $var->amount); 
                }
             }

             $expense->total_factura = $total;
             $expense->base_imponible = $base_imponible;
            
             $date = Carbon::now();
             $datenow = $date->format('Y-m-d');    

             
     
             return view('admin.expensesandpurchases.create_payment_voucher',compact('expense','datenow','expense_details'));
         
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