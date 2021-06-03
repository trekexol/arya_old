<?php

namespace App\Http\Controllers;

use App\Account;
use App\Branch;
use App\Client;
use App\DetailVoucher;
use App\ExpensePayment;
use App\ExpensesAndPurchase;
use App\ExpensesDetail;
use App\HeaderVoucher;
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


   public function movements_expense($id_expense)
   {
       

       $user       =   auth()->user();
       $users_role =   $user->role_id;
       if($users_role == '1'){
           $expense = ExpensesAndPurchase::find($id_expense);
           $detailvouchers = DetailVoucher::where('id_expense',$id_expense)->get();

        }elseif($users_role == '2'){
           return view('admin.index');
       }
       
       return view('admin.expensesandpurchases.index_movement',compact('detailvouchers','expense'));
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

            $anticipos_sum = 0;//Anticipo::where('status',1)->where('id_client',$expense->id_client)->sum('amount');

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

    public function create_payment_after($id_expense)
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

            $anticipos_sum = 0;//Anticipo::where('status',1)->where('id_client',$expense->id_client)->sum('amount');

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

             
     
             return view('admin.expensesandpurchases.create_payment_after',compact('expense','datenow','expense_details','accounts_bank', 'accounts_efectivo', 'accounts_punto_de_venta','anticipos_sum'));
         
         
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


    public function store_expense_payment(Request $request)
    { 
        $data = request()->validate([
            
        ]);

    
        $date = Carbon::now();
        $datenow = $date->format('Y-m-d'); 
        
        $total_pay = 0;

        //Saber cuantos pagos vienen
        $come_pay = request('amount_of_payments');


        $user_id = request('user_id');

        /*Validar cuales son los pagos a guardar */
            $validate_boolean1 = false;
            $validate_boolean2 = false;
            $validate_boolean3 = false;
            $validate_boolean4 = false;
            $validate_boolean5 = false;
            $validate_boolean6 = false;
            $validate_boolean7 = false;

        //-----------------------

        $expense = ExpensesAndPurchase::findOrFail(request('id_expense'));

        //Verifica el status del pago, si esta en C significa Cobrado y por tanto no se debe cobrar de nuevo 
        if($expense->status != "C"){
        
            
        
            $payment_type = request('payment_type');
            if($come_pay >= 1){

                /*-------------PAGO NUMERO 1----------------------*/

                $var = new ExpensePayment();

                $amount_pay = request('amount_pay');
        
                if(isset($amount_pay)){
                    
                    $valor_sin_formato_amount_pay = str_replace(',', '.', str_replace('.', '', $amount_pay));
                }else{
                    return redirect('expensesandpurchases/registerpaymentafter/'.$expense->id.'')->withDanger('Debe ingresar un monto de pago 1!');
                }
                    
        
                $account_bank = request('account_bank');
                $account_efectivo = request('account_efectivo');
                $account_punto_de_venta = request('account_punto_de_venta');
        
                $credit_days = request('credit_days');
        
                
        
                $reference = request('reference');
        
                if($valor_sin_formato_amount_pay != 0){
        
                    if($payment_type != 0){
        
                        $var->id_expense = request('id_expense');
        
                        //SELECCIONA LA CUENTA QUE SE REGISTRA EN EL TIPO DE PAGO
                        if($payment_type == 1 || $payment_type == 11 || $payment_type == 5 ){
                            //CUENTAS BANCARIAS
                            if(($account_bank != 0)){
                                if(isset($reference)){
        
                                    $var->id_account = $account_bank;
        
                                    $var->reference = $reference;
        
                                }else{
                                    return redirect('expensesandpurchases/registerpaymentafter/'.$expense->id.'')->withDanger('Debe ingresar una Referencia Bancaria!');
                                }
                            }else{
                                return redirect('expensesandpurchases/registerpaymentafter/'.$expense->id.'')->withDanger('Debe seleccionar una Cuenta Bancaria!');
                            }
                        }
                        if($payment_type == 4){
                            //DIAS DE CREDITO
                            if(isset($credit_days)){
        
                                $var->credit_days = $credit_days;
        
                            }else{
                                return redirect('expensesandpurchases/registerpaymentafter/'.$expense->id.'')->withDanger('Debe ingresar los Dias de Credito!');
                            }
                        }
        
                        if($payment_type == 6){
                            //DIAS DE CREDITO
                            if(($account_efectivo != 0)){
        
                                $var->id_account = $account_efectivo;
        
                            }else{
                                return redirect('expensesandpurchases/registerpaymentafter/'.$expense->id.'')->withDanger('Debe seleccionar una Cuenta de Efectivo!');
                            }
                        }
        
                        if($payment_type == 9 || $payment_type == 10){
                            //CUENTAS PUNTO DE VENTA
                            if(($account_punto_de_venta != 0)){
                                $var->id_account = $account_punto_de_venta;
                            }else{
                                return redirect('expensesandpurchases/registerpaymentafter/'.$expense->id.'')->withDanger('Debe seleccionar una Cuenta de Punto de Venta!');
                            }
                        }
        
                            
                    
        
                            $var->payment_type = request('payment_type');
                            $var->amount = $valor_sin_formato_amount_pay;
                            
                            
                            $var->status =  1;
                        
                            $total_pay += $valor_sin_formato_amount_pay;
        
                            $validate_boolean1 = true;
        
                        
                    }else{
                        return redirect('expensesandpurchases/registerpaymentafter/'.$expense->id.'')->withDanger('Debe seleccionar un Tipo de Pago 1!');
                    }
        
                    
                }else{
                        return redirect('expensesandpurchases/registerpaymentafter/'.$expense->id.'')->withDanger('El pago debe ser distinto de Cero!');
                    }
                /*--------------------------------------------*/
            }   
            $payment_type2 = request('payment_type2');
            if($come_pay >= 2){

                /*-------------PAGO NUMERO 2----------------------*/

                $var2 = new ExpensePayment();

                $amount_pay2 = request('amount_pay2');

                if(isset($amount_pay2)){
                    
                    $valor_sin_formato_amount_pay2 = str_replace(',', '.', str_replace('.', '', $amount_pay2));
                }else{
                    return redirect('expensesandpurchases/registerpaymentafter/'.$expense->id.'')->withDanger('Debe ingresar un monto de pago 2!');
                }
                    

                $account_bank2 = request('account_bank2');
                $account_efectivo2 = request('account_efectivo2');
                $account_punto_de_venta2 = request('account_punto_de_venta2');

                $credit_days2 = request('credit_days2');

                

                $reference2 = request('reference2');

                if($valor_sin_formato_amount_pay2 != 0){

                if($payment_type2 != 0){

                    $var2->id_expense = request('id_expense');

                    //SELECCIONA LA CUENTA QUE SE REGISTRA EN EL TIPO DE PAGO
                    if($payment_type2 == 1 || $payment_type2 == 11 || $payment_type2 == 5 ){
                        //CUENTAS BANCARIAS
                        if(($account_bank2 != 0)){
                            if(isset($reference2)){

                                $var2->id_account = $account_bank2;

                                $var2->reference = $reference2;

                            }else{
                                return redirect('expensesandpurchases/registerpaymentafter/'.$expense->id.'')->withDanger('Debe ingresar una Referencia Bancaria en pago numero 2!');
                            }
                        }else{
                            return redirect('expensesandpurchases/registerpaymentafter/'.$expense->id.'')->withDanger('Debe seleccionar una Cuenta Bancaria en pago numero 2!');
                        }
                    }
                    if($payment_type2 == 4){
                        //DIAS DE CREDITO
                        if(isset($credit_days2)){

                            $var2->credit_days = $credit_days2;

                        }else{
                            return redirect('expensesandpurchases/registerpaymentafter/'.$expense->id.'')->withDanger('Debe ingresar los Dias de Credito en pago numero 2!');
                        }
                    }

                    if($payment_type2 == 6){
                        //DIAS DE CREDITO
                        if(($account_efectivo2 != 0)){

                            $var2->id_account = $account_efectivo2;

                        }else{
                            return redirect('expensesandpurchases/registerpaymentafter/'.$expense->id.'')->withDanger('Debe seleccionar una Cuenta de Efectivo en pago numero 2!');
                        }
                    }

                    if($payment_type2 == 9 || $payment_type2 == 10){
                            //CUENTAS PUNTO DE VENTA
                        if(($account_punto_de_venta2 != 0)){
                            $var2->id_account = $account_punto_de_venta2;
                        }else{
                            return redirect('expensesandpurchases/registerpaymentafter/'.$expense->id.'')->withDanger('Debe seleccionar una Cuenta de Punto de Venta en pago numero 2!');
                        }
                    }

                        
                

                        $var2->payment_type = request('payment_type2');
                        $var2->amount = $valor_sin_formato_amount_pay2;
                        
                        
                        $var2->status =  1;
                    
                        $total_pay += $valor_sin_formato_amount_pay2;

                        $validate_boolean2 = true;

                    
                }else{
                    return redirect('expensesandpurchases/registerpaymentafter/'.$expense->id.'')->withDanger('Debe seleccionar un Tipo de Pago 2!');
                }

                
                }else{
                    return redirect('expensesandpurchases/registerpaymentafter/'.$expense->id.'')->withDanger('El pago 2 debe ser distinto de Cero!');
                }
                /*--------------------------------------------*/
            } 
            $payment_type3 = request('payment_type3');   
            if($come_pay >= 3){

                    /*-------------PAGO NUMERO 3----------------------*/

                    $var3 = new ExpensePayment();

                    $amount_pay3 = request('amount_pay3');

                    if(isset($amount_pay3)){
                        
                        $valor_sin_formato_amount_pay3 = str_replace(',', '.', str_replace('.', '', $amount_pay3));
                    }else{
                        return redirect('expensesandpurchases/registerpaymentafter/'.$expense->id.'')->withDanger('Debe ingresar un monto de pago 3!');
                    }
                        

                    $account_bank3 = request('account_bank3');
                    $account_efectivo3 = request('account_efectivo3');
                    $account_punto_de_venta3 = request('account_punto_de_venta3');

                    $credit_days3 = request('credit_days3');

                

                    $reference3 = request('reference3');

                    if($valor_sin_formato_amount_pay3 != 0){

                        if($payment_type3 != 0){

                            $var3->id_expense = request('id_expense');

                            //SELECCIONA LA CUENTA QUE SE REGISTRA EN EL TIPO DE PAGO
                            if($payment_type3 == 1 || $payment_type3 == 11 || $payment_type3 == 5 ){
                                //CUENTAS BANCARIAS
                                if(($account_bank3 != 0)){
                                    if(isset($reference3)){

                                        $var3->id_account = $account_bank3;

                                        $var3->reference = $reference3;

                                    }else{
                                        return redirect('expensesandpurchases/registerpaymentafter/'.$expense->id.'')->withDanger('Debe ingresar una Referencia Bancaria en pago numero 3!');
                                    }
                                }else{
                                    return redirect('expensesandpurchases/registerpaymentafter/'.$expense->id.'')->withDanger('Debe seleccionar una Cuenta Bancaria en pago numero 3!');
                                }
                            }
                            if($payment_type3 == 4){
                                //DIAS DE CREDITO
                                if(isset($credit_days3)){

                                    $var3->credit_days = $credit_days3;

                                }else{
                                    return redirect('expensesandpurchases/registerpaymentafter/'.$expense->id.'')->withDanger('Debe ingresar los Dias de Credito en pago numero 3!');
                                }
                            }

                            if($payment_type3 == 6){
                                //DIAS DE CREDITO
                                if(($account_efectivo3 != 0)){

                                    $var3->id_account = $account_efectivo3;

                                }else{
                                    return redirect('expensesandpurchases/registerpaymentafter/'.$expense->id.'')->withDanger('Debe seleccionar una Cuenta de Efectivo en pago numero 3!');
                                }
                            }

                            if($payment_type3 == 9 || $payment_type3 == 10){
                                //CUENTAS PUNTO DE VENTA
                                if(($account_punto_de_venta3 != 0)){
                                    $var3->id_account = $account_punto_de_venta3;
                                }else{
                                    return redirect('expensesandpurchases/registerpaymentafter/'.$expense->id.'')->withDanger('Debe seleccionar una Cuenta de Punto de Venta en pago numero 3!');
                                }
                            }

                        
                        

                                $var3->payment_type = request('payment_type3');
                                $var3->amount = $valor_sin_formato_amount_pay3;
                                
                                
                                $var3->status =  1;
                            
                                $total_pay += $valor_sin_formato_amount_pay3;

                                $validate_boolean3 = true;

                            
                        }else{
                            return redirect('expensesandpurchases/registerpaymentafter/'.$expense->id.'')->withDanger('Debe seleccionar un Tipo de Pago 3!');
                        }

                        
                    }else{
                            return redirect('expensesandpurchases/registerpaymentafter/'.$expense->id.'')->withDanger('El pago 3 debe ser distinto de Cero!');
                        }
                    /*--------------------------------------------*/
            }
            $payment_type4 = request('payment_type4');
            if($come_pay >= 4){

                    /*-------------PAGO NUMERO 4----------------------*/

                    $var4 = new expensePayment();

                    $amount_pay4 = request('amount_pay4');

                    if(isset($amount_pay4)){
                        
                        $valor_sin_formato_amount_pay4 = str_replace(',', '.', str_replace('.', '', $amount_pay4));
                    }else{
                        return redirect('expensesandpurchases/registerpaymentafter/'.$expense->id.'')->withDanger('Debe ingresar un monto de pago 4!');
                    }
                        

                    $account_bank4 = request('account_bank4');
                    $account_efectivo4 = request('account_efectivo4');
                    $account_punto_de_venta4 = request('account_punto_de_venta4');

                    $credit_days4 = request('credit_days4');

                

                    $reference4 = request('reference4');

                    if($valor_sin_formato_amount_pay4 != 0){

                        if($payment_type4 != 0){

                            $var4->id_expense = request('id_expense');

                            //SELECCIONA LA CUENTA QUE SE REGISTRA EN EL TIPO DE PAGO
                            if($payment_type4 == 1 || $payment_type4 == 11 || $payment_type4 == 5 ){
                                //CUENTAS BANCARIAS
                                if(($account_bank4 != 0)){
                                    if(isset($reference4)){

                                        $var4->id_account = $account_bank4;

                                        $var4->reference = $reference4;

                                    }else{
                                        return redirect('expensesandpurchases/registerpaymentafter/'.$expense->id.'')->withDanger('Debe ingresar una Referencia Bancaria en pago numero 4!');
                                    }
                                }else{
                                    return redirect('expensesandpurchases/registerpaymentafter/'.$expense->id.'')->withDanger('Debe seleccionar una Cuenta Bancaria en pago numero 4!');
                                }
                            }
                            if($payment_type4 == 4){
                                //DIAS DE CREDITO
                                if(isset($credit_days4)){

                                    $var4->credit_days = $credit_days4;

                                }else{
                                    return redirect('expensesandpurchases/registerpaymentafter/'.$expense->id.'')->withDanger('Debe ingresar los Dias de Credito en pago numero 4!');
                                }
                            }

                            if($payment_type4 == 6){
                                //DIAS DE CREDITO
                                if(($account_efectivo4 != 0)){

                                    $var4->id_account = $account_efectivo4;

                                }else{
                                    return redirect('expensesandpurchases/registerpaymentafter/'.$expense->id.'')->withDanger('Debe seleccionar una Cuenta de Efectivo en pago numero 4!');
                                }
                            }

                            if($payment_type4 == 9 || $payment_type4 == 10){
                                //CUENTAS PUNTO DE VENTA
                                if(($account_punto_de_venta4 != 0)){
                                    $var4->id_account = $account_punto_de_venta4;
                                }else{
                                    return redirect('expensesandpurchases/registerpaymentafter/'.$expense->id.'')->withDanger('Debe seleccionar una Cuenta de Punto de Venta en pago numero 4!');
                                }
                            }

                        
                        

                                $var4->payment_type = request('payment_type4');
                                $var4->amount = $valor_sin_formato_amount_pay4;
                                
                                
                                $var4->status =  1;
                            
                                $total_pay += $valor_sin_formato_amount_pay4;

                                $validate_boolean4 = true;

                            
                        }else{
                            return redirect('expensesandpurchases/registerpaymentafter/'.$expense->id.'')->withDanger('Debe seleccionar un Tipo de Pago 4!');
                        }

                        
                    }else{
                            return redirect('expensesandpurchases/registerpaymentafter/'.$expense->id.'')->withDanger('El pago 4 debe ser distinto de Cero!');
                        }
                    /*--------------------------------------------*/
            } 
            $payment_type5 = request('payment_type5');
            if($come_pay >= 5){

                /*-------------PAGO NUMERO 5----------------------*/

                $var5 = new expensePayment();

                $amount_pay5 = request('amount_pay5');

                if(isset($amount_pay5)){
                    
                    $valor_sin_formato_amount_pay5 = str_replace(',', '.', str_replace('.', '', $amount_pay5));
                }else{
                    return redirect('expensesandpurchases/registerpaymentafter/'.$expense->id.'')->withDanger('Debe ingresar un monto de pago 5!');
                }
                    

                $account_bank5 = request('account_bank5');
                $account_efectivo5 = request('account_efectivo5');
                $account_punto_de_venta5 = request('account_punto_de_venta5');

                $credit_days5 = request('credit_days5');

            

                $reference5 = request('reference5');

                if($valor_sin_formato_amount_pay5 != 0){

                    if($payment_type5 != 0){

                        $var5->id_expense = request('id_expense');

                        //SELECCIONA LA CUENTA QUE SE REGISTRA EN EL TIPO DE PAGO
                        if($payment_type5 == 1 || $payment_type5 == 11 || $payment_type5 == 5 ){
                            //CUENTAS BANCARIAS
                            if(($account_bank5 != 0)){
                                if(isset($reference5)){

                                    $var5->id_account = $account_bank5;

                                    $var5->reference = $reference5;

                                }else{
                                    return redirect('expensesandpurchases/registerpaymentafter/'.$expense->id.'')->withDanger('Debe ingresar una Referencia Bancaria en pago numero 5!');
                                }
                            }else{
                                return redirect('expensesandpurchases/registerpaymentafter/'.$expense->id.'')->withDanger('Debe seleccionar una Cuenta Bancaria en pago numero 5!');
                            }
                        }
                        if($payment_type5 == 4){
                            //DIAS DE CREDITO
                            if(isset($credit_days5)){

                                $var5->credit_days = $credit_days5;

                            }else{
                                return redirect('expensesandpurchases/registerpaymentafter/'.$expense->id.'')->withDanger('Debe ingresar los Dias de Credito en pago numero 5!');
                            }
                        }

                        if($payment_type5 == 6){
                            //DIAS DE CREDITO
                            if(($account_efectivo5 != 0)){

                                $var5->id_account = $account_efectivo5;

                            }else{
                                return redirect('expensesandpurchases/registerpaymentafter/'.$expense->id.'')->withDanger('Debe seleccionar una Cuenta de Efectivo en pago numero 5!');
                            }
                        }

                        if($payment_type5 == 9 || $payment_type5 == 10){
                            //CUENTAS PUNTO DE VENTA
                            if(($account_punto_de_venta5 != 0)){
                                $var5->id_account = $account_punto_de_venta5;
                            }else{
                                return redirect('expensesandpurchases/registerpaymentafter/'.$expense->id.'')->withDanger('Debe seleccionar una Cuenta de Punto de Venta en pago numero 5!');
                            }
                        }

                    
                    

                            $var5->payment_type = request('payment_type5');
                            $var5->amount = $valor_sin_formato_amount_pay5;
                            
                            
                            $var5->status =  1;
                        
                            $total_pay += $valor_sin_formato_amount_pay5;

                            $validate_boolean5 = true;

                        
                    }else{
                        return redirect('expensesandpurchases/registerpaymentafter/'.$expense->id.'')->withDanger('Debe seleccionar un Tipo de Pago 5!');
                    }

                    
                }else{
                        return redirect('expensesandpurchases/registerpaymentafter/'.$expense->id.'')->withDanger('El pago 5 debe ser distinto de Cero!');
                    }
                /*--------------------------------------------*/
            } 
            $payment_type6 = request('payment_type6');
            if($come_pay >= 6){

                /*-------------PAGO NUMERO 6----------------------*/

                $var6 = new expensePayment();

                $amount_pay6 = request('amount_pay6');

                if(isset($amount_pay6)){
                    
                    $valor_sin_formato_amount_pay6 = str_replace(',', '.', str_replace('.', '', $amount_pay6));
                }else{
                    return redirect('expensesandpurchases/registerpaymentafter/'.$expense->id.'')->withDanger('Debe ingresar un monto de pago 6!');
                }
                    

                $account_bank6 = request('account_bank6');
                $account_efectivo6 = request('account_efectivo6');
                $account_punto_de_venta6 = request('account_punto_de_venta6');

                $credit_days6 = request('credit_days6');

                

                $reference6 = request('reference6');

                if($valor_sin_formato_amount_pay6 != 0){

                    if($payment_type6 != 0){

                        $var6->id_expense = request('id_expense');

                        //SELECCIONA LA CUENTA QUE SE REGISTRA EN EL TIPO DE PAGO
                        if($payment_type6 == 1 || $payment_type6 == 11 || $payment_type6 == 5 ){
                            //CUENTAS BANCARIAS
                            if(($account_bank6 != 0)){
                                if(isset($reference6)){

                                    $var6->id_account = $account_bank6;

                                    $var6->reference = $reference6;

                                }else{
                                    return redirect('expensesandpurchases/registerpaymentafter/'.$expense->id.'')->withDanger('Debe ingresar una Referencia Bancaria en pago numero 6!');
                                }
                            }else{
                                return redirect('expensesandpurchases/registerpaymentafter/'.$expense->id.'')->withDanger('Debe seleccionar una Cuenta Bancaria en pago numero 6!');
                            }
                        }
                        if($payment_type6 == 4){
                            //DIAS DE CREDITO
                            if(isset($credit_days6)){

                                $var6->credit_days = $credit_days6;

                            }else{
                                return redirect('expensesandpurchases/registerpaymentafter/'.$expense->id.'')->withDanger('Debe ingresar los Dias de Credito en pago numero 6!');
                            }
                        }

                        if($payment_type6 == 6){
                            //DIAS DE CREDITO
                            if(($account_efectivo6 != 0)){

                                $var6->id_account = $account_efectivo6;

                            }else{
                                return redirect('expensesandpurchases/registerpaymentafter/'.$expense->id.'')->withDanger('Debe seleccionar una Cuenta de Efectivo en pago numero 6!');
                            }
                        }

                        if($payment_type6 == 9 || $payment_type6 == 10){
                            //CUENTAS PUNTO DE VENTA
                            if(($account_punto_de_venta6 != 0)){
                                $var6->id_account = $account_punto_de_venta6;
                            }else{
                                return redirect('expensesandpurchases/registerpaymentafter/'.$expense->id.'')->withDanger('Debe seleccionar una Cuenta de Punto de Venta en pago numero 6!');
                            }
                        }

                    
                    

                            $var6->payment_type = request('payment_type6');
                            $var6->amount = $valor_sin_formato_amount_pay6;
                            
                            
                            $var6->status =  1;
                        
                            $total_pay += $valor_sin_formato_amount_pay6;

                            $validate_boolean6 = true;

                        
                    }else{
                        return redirect('expensesandpurchases/registerpaymentafter/'.$expense->id.'')->withDanger('Debe seleccionar un Tipo de Pago 6!');
                    }

                    
                }else{
                        return redirect('expensesandpurchases/registerpaymentafter/'.$expense->id.'')->withDanger('El pago 6 debe ser distinto de Cero!');
                    }
                /*--------------------------------------------*/
            } 
            $payment_type7 = request('payment_type7');
            if($come_pay >= 7){

                /*-------------PAGO NUMERO 7----------------------*/

                $var7 = new expensePayment();

                $amount_pay7 = request('amount_pay7');

                if(isset($amount_pay7)){
                    
                    $valor_sin_formato_amount_pay7 = str_replace(',', '.', str_replace('.', '', $amount_pay7));
                }else{
                    return redirect('expensesandpurchases/registerpaymentafter/'.$expense->id.'')->withDanger('Debe ingresar un monto de pago 7!');
                }
                    

                $account_bank7 = request('account_bank7');
                $account_efectivo7 = request('account_efectivo7');
                $account_punto_de_venta7 = request('account_punto_de_venta7');

                $credit_days7 = request('credit_days7');

                

                $reference7 = request('reference7');

                if($valor_sin_formato_amount_pay7 != 0){

                    if($payment_type7 != 0){

                        $var7->id_expense = request('id_expense');

                        //SELECCIONA LA CUENTA QUE SE REGISTRA EN EL TIPO DE PAGO
                        if($payment_type7 == 1 || $payment_type7 == 11 || $payment_type7 == 5 ){
                            //CUENTAS BANCARIAS
                            if(($account_bank7 != 0)){
                                if(isset($reference7)){

                                    $var7->id_account = $account_bank7;

                                    $var7->reference = $reference7;

                                }else{
                                    return redirect('expensesandpurchases/registerpaymentafter/'.$expense->id.'')->withDanger('Debe ingresar una Referencia Bancaria en pago numero 7!');
                                }
                            }else{
                                return redirect('expensesandpurchases/registerpaymentafter/'.$expense->id.'')->withDanger('Debe seleccionar una Cuenta Bancaria en pago numero 7!');
                            }
                        }
                        if($payment_type7 == 4){
                            //DIAS DE CREDITO
                            if(isset($credit_days7)){

                                $var7->credit_days = $credit_days7;

                            }else{
                                return redirect('expensesandpurchases/registerpaymentafter/'.$expense->id.'')->withDanger('Debe ingresar los Dias de Credito en pago numero 7!');
                            }
                        }

                        if($payment_type7 == 6){
                            //DIAS DE CREDITO
                            if(($account_efectivo7 != 0)){

                                $var7->id_account = $account_efectivo7;

                            }else{
                                return redirect('expensesandpurchases/registerpaymentafter/'.$expense->id.'')->withDanger('Debe seleccionar una Cuenta de Efectivo en pago numero 7!');
                            }
                        }

                        if($payment_type7 == 9 || $payment_type7 == 10){
                            //CUENTAS PUNTO DE VENTA
                            if(($account_punto_de_venta7 != 0)){
                                $var7->id_account = $account_punto_de_venta7;
                            }else{
                                return redirect('expensesandpurchases/registerpaymentafter/'.$expense->id.'')->withDanger('Debe seleccionar una Cuenta de Punto de Venta en pago numero 7!');
                            }
                        }

                    
                    

                            $var7->payment_type = request('payment_type7');
                            $var7->amount = $valor_sin_formato_amount_pay7;
                            
                            
                            $var7->status =  1;
                        
                            $total_pay += $valor_sin_formato_amount_pay7;

                            $validate_boolean7 = true;

                        
                    }else{
                        return redirect('expensesandpurchases/registerpaymentafter/'.$expense->id.'')->withDanger('Debe seleccionar un Tipo de Pago 7!');
                    }

                    
                }else{
                        return redirect('expensesandpurchases/registerpaymentafter/'.$expense->id.'')->withDanger('El pago 7 debe ser distinto de Cero!');
                    }
                /*--------------------------------------------*/
            } 

            $total_pay_form = request('total_pay_form');

            //VALIDA QUE LA SUMA MONTOS INGRESADOS SEAN IGUALES AL MONTO TOTAL DEL PAGO
            if($total_pay == $total_pay_form){

            
                $header_voucher  = new HeaderVoucher();


                $header_voucher->description = "Pago de Bienes o servicios.";
                $header_voucher->date = $datenow;
                
            
                $header_voucher->status =  "1";
            
                $header_voucher->save();

                    

                    //Al final de agregar los movimientos de los pagos, agregamos el monto total de los pagos a cuentas por cobrar clientes
                    $account_cuentas_por_pagar_proveedores = Account::where('description', 'like', 'Cuentas por Pagar Proveedores')->first(); 
                        
                    if(isset($account_cuentas_por_pagar_proveedores)){
                            $this->add_movement($header_voucher->id,$account_cuentas_por_pagar_proveedores->id,$expense->id,$user_id,$total_pay_form,0);
                    }

                /*TERMINAR ESTO */
                if($validate_boolean1 == true){
                    $var->save();

                
                    $this->add_pay_movement($payment_type,$header_voucher->id,$var->id_account,$expense->id,$user_id,0,$var->amount);
                    

                    //LE PONEMOS STATUS C, DE COBRADO
                    $expense->status = "C";
                }
                
                if($validate_boolean2 == true){
                    $var2->save();
                
                    $this->add_pay_movement($payment_type2,$header_voucher->id,$var2->id_account,$expense->id,$user_id,0,$var2->amount);
                    
                }
                
                if($validate_boolean3 == true){
                    $var3->save();

                    $this->add_pay_movement($payment_type3,$header_voucher->id,$var3->id_account,$expense->id,$user_id,0,$var3->amount);
                
                    
                }
                if($validate_boolean4 == true){
                    $var4->save();

                    $this->add_pay_movement($payment_type4,$header_voucher->id,$var4->id_account,$expense->id,$user_id,0,$var4->amount);
                
                }
                if($validate_boolean5 == true){
                    $var5->save();

                    $this->add_pay_movement($payment_type5,$header_voucher->id,$var5->id_account,$expense->id,$user_id,0,$var5->amount);
                
                }
                if($validate_boolean6 == true){
                    $var6->save();

                    $this->add_pay_movement($payment_type6,$header_voucher->id,$var6->id_account,$expense->id,$user_id,0,$var6->amount);
                
                }
                if($validate_boolean7 == true){
                    $var7->save();

                    $this->add_pay_movement($payment_type7,$header_voucher->id,$var7->id_account,$expense->id,$user_id,0,$var7->amount);
                
                }

                $sin_formato_base_imponible = str_replace(',', '.', str_replace('.', '', request('base_imponible_form')));
                $sin_formato_amount = str_replace(',', '.', str_replace('.', '', request('sub_total_form')));
                $sin_formato_amount_iva = str_replace(',', '.', str_replace('.', '', request('iva_amount_form')));
                $sin_formato_amount_with_iva = str_replace(',', '.', str_replace('.', '', request('total_pay_form')));

                $expense->base_imponible = $sin_formato_base_imponible;
                $expense->amount =  $sin_formato_amount;
                $expense->amount_iva =  $sin_formato_amount_iva;
                $expense->amount_with_iva =  $sin_formato_amount_with_iva;
            
                $iva_percentage = request('iva_form');

                $date = Carbon::now();
                $datenow = $date->format('Y-m-d');   

                $sub_total = request('sub_total_form');

                $base_imponible = request('base_imponible_form');

                //Verificamos si ya existen movimientos guardados, si es asi, no registramos movimientos
                $verification_detail = DetailVoucher::where('id_expense',$expense->id)->first();

                if(!isset($verification_detail)){
                    $header_voucher  = new HeaderVoucher();


                    $header_voucher->description = "Compras de Bienes o servicios.";
                    $header_voucher->date = $datenow;
                    
                
                    $header_voucher->status =  "1";
                
                    $header_voucher->save();
                
                    //Mercancia para la Venta
                        
                    $account_mercancia_venta = Account::where('description', 'like', 'Mercancia para la Venta')->first();
    
                    if(isset($account_mercancia_venta)){
                        $this->add_movement($header_voucher->id,$account_mercancia_venta->id,$expense->id,$user_id,$sub_total,0);
                    }
    
                    //Debito Fiscal IVA por Pagar
    
                    $account_credito_iva_fiscal = Account::where('description', 'like', 'IVA Credito Fiscal')->first();
                        
                    if(isset($account_credito_iva_fiscal)){
                        if($sin_formato_amount_iva != 0){
                            $this->add_movement($header_voucher->id,$account_credito_iva_fiscal->id,$expense->id,$user_id,$sin_formato_amount_iva,0);
                        }
                    }
    
                    //Al final de agregar los movimientos de los pagos, agregamos el monto total de los pagos a cuentas por cobrar clientes
                    $account_cuentas_por_pagar_proveedores = Account::where('description', 'like', 'Cuentas por Pagar Proveedores')->first(); 
                    
                    if(isset($account_cuentas_por_pagar_proveedores)){
                        $this->add_movement($header_voucher->id,$account_cuentas_por_pagar_proveedores->id,$expense->id,$user_id,0,$total_pay_form);
                    }
                }
                
                
                

                /*Modifica la cotizacion */
                    $expense->date_payment = $datenow;

                    $expense->date_payment = $datenow;

                    $expense->iva_percentage = $iva_percentage;

                    $anticipo = request('anticipo_form');


                    
                    

                    if(isset($anticipo)){
                    // $valor_sin_formato_anticipo = str_replace(',', '.', str_replace('.', '', $anticipo));
                        $expense->anticipo =  $anticipo;
                    }else{
                        $expense->anticipo = 0;
                    }

                    $expense->amount_with_iva = $total_pay_form;

                    

                    $expense->save();

                /*---------------------- */

            

                
                /*aumentamos el inventario*/
                    $retorno = $this->increase_inventory($expense->id);

                    if($retorno != "exito"){
                        return redirect('expensesandpurchases/registerpaymentafter/'.$expense->id.'');
                    }
                
                /*---------------- */


            
                

                /*Verificamos si el cliente tiene anticipos activos */

                if($anticipo != 0){
                        DB::table('anticipos')->where('id_client', '=', $expense->id_client)
                        ->where('status', '=', '1')
                        ->update(['status' => 'C']);
            
                }

                


                    /*------------------------------------------------- */

            }else{
                return redirect('expensesandpurchases/registerpaymentafter/'.$expense->id.'')->withDanger('La suma de los pagos es diferente al monto Total a Pagar!');
            }

            

            return redirect('expensesandpurchases/expensevoucher/'.$expense->id.'')->withSuccess('Factura Guardada con Exito!');

        }else{
            return redirect('expensesandpurchases/registerpaymentafter/'.$expense->id.'')->withDanger('Este pago ya ha sido realizado!');
        }

    }


    public function store_expense_credit(Request $request)
    {
        
        $date = Carbon::now();
        $datenow = $date->format('Y-m-d'); 

        $sin_formato_base_imponible = str_replace(',', '.', str_replace('.', '', request('base_imponible')));
        $sin_formato_amount = str_replace(',', '.', str_replace('.', '', request('total_factura')));
        $sin_formato_amount_iva = str_replace(',', '.', str_replace('.', '', request('iva_amount')));
        $sin_formato_amount_with_iva = str_replace(',', '.', str_replace('.', '', request('grand_total')));
         

        $id_expense = request('id_expense');
        $user_id = request('user_id');

        $expense = ExpensesAndPurchase::findOrFail($id_expense);

        $expense->base_imponible = $sin_formato_base_imponible;
        $expense->amount =  $sin_formato_amount;
        $expense->amount_iva =  $sin_formato_amount_iva;
        $expense->amount_with_iva =  $sin_formato_amount_with_iva;

        $credit = request('credit');

        $expense->iva_percentage = request('iva');

        $expense->credit_days = $credit;

        $expense->save();

        $header_voucher  = new HeaderVoucher();


        $header_voucher->description = "Compras de Bienes o servicios.";
        $header_voucher->date = $datenow;
        
    
        $header_voucher->status =  "1";
    
        $header_voucher->save();
    
        //Mercancia para la Venta
            
        $account_mercancia_venta = Account::where('description', 'like', 'Mercancia para la Venta')->first();

        if(isset($account_mercancia_venta)){
            $this->add_movement($header_voucher->id,$account_mercancia_venta->id,$expense->id,$user_id,$sin_formato_amount,0);
        }

        //IVA credito Fiscal

        $account_credito_iva_fiscal = Account::where('description', 'like', 'IVA Credito Fiscal')->first();
            
        if(isset($account_credito_iva_fiscal)){
            if($sin_formato_amount_iva != 0){
                $this->add_movement($header_voucher->id,$account_credito_iva_fiscal->id,$expense->id,$user_id,$sin_formato_amount_iva,0);
            }
        }

        //Al final de agregar los movimientos de los pagos, agregamos el monto total de los pagos a cuentas por cobrar clientes
        $account_cuentas_por_pagar_proveedores = Account::where('description', 'like', 'Cuentas por Pagar Proveedores')->first(); 
                    
        if(isset($account_cuentas_por_pagar_proveedores)){
            $this->add_movement($header_voucher->id,$account_cuentas_por_pagar_proveedores->id,$expense->id,$user_id,0,$sin_formato_amount_with_iva);
        }
        return redirect('expensesandpurchases/expensevoucher/'.$expense->id.'')->withSuccess('Gasto o Compra Guardada con Exito!');
    }


    public function increase_inventory($id_expense){
       
        
        $expense_detail = ExpensesDetail::where('id_expense',$id_expense)->get();
        
        if(isset($expense_detail)){
           
           foreach($expense_detail as $var){
            
                if(isset($var->id_inventory)){
                    $inventory = Inventory::findOrFail($var->id_inventory);
                    
                    if(isset($inventory)){
                           
                        $inventory->amount += $var->amount;
                        $inventory->save();

                                
                    }else{
                                return redirect('expensesandpurchases/registerpaymentafter/'.$id_expense.'')->withDanger('El Inventario no existe!');
                    }
                }
           }         
            
                   
        }else{
                return redirect('expensesandpurchases/registerpaymentafter/'.$id_expense.'')->withDanger('El Inventario de la cotizacion no existe!');
            }

           

            return "exito";

}





    public function add_movement($id_header,$id_account,$id_expense,$id_user,$debe,$haber){

        $detail = new DetailVoucher();

        $detail->id_account = $id_account;
        $detail->id_header_voucher = $id_header;
        $detail->user_id = $id_user;

        $detail->id_expense = $id_expense;

      /*  $valor_sin_formato_debe = str_replace(',', '.', str_replace('.', '', $debe));
        $valor_sin_formato_haber = str_replace(',', '.', str_replace('.', '', $haber));*/


        $detail->debe = $debe;
        $detail->haber = $haber;
       
      
        $detail->status =  "C";

         /*Le cambiamos el status a la cuenta a M, para saber que tiene Movimientos en detailVoucher */
         
            $account = Account::findOrFail($detail->id_account);

            if($account->status != "M"){
                $account->status = "M";
                $account->save();
            }
         
    
        $detail->save();

    }


    public function add_pay_movement($payment_type,$header_voucher,$id_account,$id_expense,$user_id,$amount_debe,$amount_haber){


        //Cuentas por Cobrar Clientes

            //AGREGA EL MOVIMIENTO DE LA CUENTA CON LA QUE SE HIZO EL PAGO
            if(isset($id_account)){
                $this->add_movement($header_voucher,$id_account,$id_expense,$user_id,$amount_debe,$amount_haber);
            
            }//SIN DETERMINAR
            else if($payment_type == 7){
                
                $account_sin_determinar = Account::where('description', 'like', 'Sin determinar')->first(); 
        
                if(isset($account_sin_determinar)){
                    $this->add_movement($header_voucher,$account_sin_determinar->id,$id_expense,$user_id,$amount_debe,$amount_haber);
                }
            }//PAGO DE CONTADO
            else if($payment_type == 2){
                
                $account_contado = Account::where('description', 'like', 'Caja Chica')->first(); 
        
                if(isset($account_contado)){
                    $this->add_movement($header_voucher,$account_contado->id,$id_expense,$user_id,$amount_debe,$amount_haber);
                }
            }//CONTRA ANTICIPO
            else if($payment_type == 3){
                
                $account_contra_anticipo = Account::where('description', 'like', 'Anticipos a Proveedores Nacionales')->first(); 
        
                if(isset($account_contra_anticipo)){
                    $this->add_movement($header_voucher,$account_contra_anticipo->id,$id_expense,$user_id,$amount_debe,$amount_haber);
                }
            } 
            //Tarjeta Corporativa 
            else if($payment_type == 8){
                
                $account_contra_anticipo = Account::where('description', 'like', 'Tarjeta Corporativa')->first(); 
        
                if(isset($account_contra_anticipo)){
                    $this->add_movement($header_voucher,$account_contra_anticipo->id,$id_expense,$user_id,$amount_debe,$amount_haber);
                }
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