<?php



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('about', function () {
    return view('about');
});

Route::get('contact', function () {
    return view('contact');
});


Auth::routes();

Route::get('/home', 'BackendController@index')->name('home');

Route::group(["prefix"=>'users'],function(){
    Route::get('/','UserController@index')->name('users');
    Route::get('register','UserController@create')->name('users.create');
    Route::post('store', 'UserController@store')->name('users.store');
   
    Route::get('{id}/edit','UserController@edit')->name('users.edit');
    Route::delete('{id}/delete','UserController@destroy')->name('users.delete');
    Route::patch('{id}/update','UserController@update')->name('users.update');

});

/*MODULO DE FACTURACION*/
Route::group(["prefix"=>'billings'],function(){
    Route::get('/','billings\BillController@index')->name('billings');
    Route::get('clients','billings\ClientController@index')->name('clients');
    Route::get('clients/create','billings\ClientController@create')->name('clients.create');
    Route::get('vendors','billings\VendorController@index')->name('vendors');
    Route::get('vendors/create','billings\VendorController@create')->name('vendors.create');
   });
/*------------------------------------ */

//Tablas Referenciales

//Route::resource('salarytypes', 'SalarytypesController');

Route::group(["prefix"=>'salarytypes'],function(){
    Route::get('/','SalarytypeController@index')->name('salarytypes');
    Route::get('register','SalarytypeController@create')->name('salarytypes.create');
    Route::post('store','SalarytypeController@store')->name('salarytypes.store');
   
    Route::get('{id}/edit','SalarytypeController@edit')->name('salarytypes.edit');
    Route::delete('{id}/delete','SalarytypeController@destroy')->name('salarytypes.delete');
    Route::patch('{id}/update','SalarytypeController@update')->name('salarytypes.update');

});


Route::group(["prefix"=>'positions'],function(){
    Route::get('/','PositionsController@index')->name('positions');
    Route::get('register','PositionsController@create')->name('positions.create');
    Route::post('store','PositionsController@store')->name('positions.store');
   
    Route::get('{id}/edit','PositionsController@edit')->name('positions.edit');
    Route::delete('{id}/delete','PositionsController@destroy')->name('positions.delete');
    Route::patch('{id}/update','PositionsController@update')->name('positions.update');

});

Route::group(["prefix"=>'academiclevels'],function(){
    Route::get('/','AcademiclevelsController@index')->name('academiclevels');
    Route::get('register','AcademiclevelsController@create')->name('academiclevels.create');
    Route::post('store','AcademiclevelsController@store')->name('academiclevels.store');
   
    Route::get('{id}/edit','AcademiclevelsController@edit')->name('academiclevels.edit');
    Route::delete('{id}/delete','AcademiclevelsController@destroy')->name('academiclevels.delete');
    Route::patch('{id}/update','AcademiclevelsController@update')->name('academiclevels.update');

});


Route::group(["prefix"=>'professions'],function(){
    Route::get('/','ProfessionsController@index')->name('professions');
    Route::get('register','ProfessionsController@create')->name('professions.create');
    Route::post('store','ProfessionsController@store')->name('professions.store');
   
    Route::get('{id}/edit','ProfessionsController@edit')->name('professions.edit');
    Route::delete('{id}/delete','ProfessionsController@destroy')->name('professions.delete');
    Route::patch('{id}/update','ProfessionsController@update')->name('professions.update');

});

Route::group(["prefix"=>'employees'],function(){
    Route::get('/','EmployeeController@index')->name('employees');
    Route::get('register','EmployeeController@create')->name('employees.create');
    Route::post('store', 'EmployeeController@store')->name('employees.store');
   
    Route::get('{id}/edit','EmployeeController@edit')->name('employees.edit');
    Route::delete('{id}/delete','EmployeeController@destroy')->name('employees.delete');
    Route::patch('{id}/update','EmployeeController@update')->name('employees.update');

});


/* CONSULTAS PARA SELECT DEPENDIENTES ESTADO--MUNICIPIO--PARRQUIA */
Route::group(["prefix"=>"municipio"],function(){
    Route::get('/','MunicipioController@index')->name('municipio.index');
    Route::get('list/{estado_id?}','MunicipioController@list')->name('municipio.list');
});
Route::group(["prefix"=>"parroquia"],function(){
    Route::get('/','ParroquiaController@index')->name('parroquia.index');
    Route::get('list/{municipio_id?}/{estado_id?}','ParroquiaController@list')->name('parroquia.list');
});

/* BOTON CANCELAR */
Route::get('danger/{ruta}', function($ruta) {
    return redirect()->route($ruta)->with('danger','Acción Cancelada!');
})->name('danger');



Route::group(["prefix"=>'segments'],function(){
    Route::get('/','SegmentController@index')->name('segments');
    Route::get('register','SegmentController@create')->name('segments.create');
    Route::post('store', 'SegmentController@store')->name('segments.store');
   
    Route::get('{id}/edit','SegmentController@edit')->name('segments.edit');
    Route::delete('{id}/delete','SegmentController@destroy')->name('segments.delete');
    Route::patch('{id}/update','SegmentController@update')->name('segments.update');

});
Route::group(["prefix"=>'subsegment'],function(){
    Route::get('/','SubsegmentController@index')->name('subsegment');
    Route::get('register','SubsegmentController@create')->name('subsegment.create');
    Route::post('store', 'SubsegmentController@store')->name('subsegment.store');
   
    Route::get('{id}/edit','SubsegmentController@edit')->name('subsegment.edit');
    Route::delete('{id}/delete','SubsegmentController@destroy')->name('subsegment.delete');
    Route::patch('{id}/update','SubsegmentController@update')->name('subsegment.update');


    Route::get('list/{estado_id?}','SubsegmentController@list')->name('subsegment.list');

});
Route::group(["prefix"=>'unitofmeasures'],function(){
    Route::get('/','UnitOfMeasureController@index')->name('unitofmeasures');
    Route::get('register','UnitOfMeasureController@create')->name('unitofmeasures.create');
    Route::post('store','UnitOfMeasureController@store')->name('unitofmeasures.store');
   
    Route::get('{id}/edit','UnitOfMeasureController@edit')->name('unitofmeasures.edit');
    Route::delete('{id}/delete','UnitOfMeasureController@destroy')->name('unitofmeasures.delete');
    Route::patch('{id}/update','UnitOfMeasureController@update')->name('unitofmeasures.update');

});

Route::group(["prefix"=>'clients'],function(){
    Route::get('/','ClientController@index')->name('clients');
    Route::get('register','ClientController@create')->name('clients.create');
    Route::post('store','ClientController@store')->name('clients.store');
   
    Route::get('{id}/edit','ClientController@edit')->name('clients.edit');
    Route::delete('{id}/delete','ClientController@destroy')->name('clients.delete');
    Route::patch('{id}/update','ClientController@update')->name('clients.update');

});

Route::group(["prefix"=>'providers'],function(){
    Route::get('/','ProviderController@index')->name('providers');
    Route::get('register','ProviderController@create')->name('providers.create');
    Route::post('store','ProviderController@store')->name('providers.store');
   
    Route::get('{id}/edit','ProviderController@edit')->name('providers.edit');
    Route::delete('{id}/delete','ProviderController@destroy')->name('providers.delete');
    Route::patch('{id}/update','ProviderController@update')->name('providers.update');

});

Route::group(["prefix"=>'branches'],function(){
    Route::get('/','BranchController@index')->name('branches');
    Route::get('register','BranchController@create')->name('branches.create');
    Route::post('store','BranchController@store')->name('branches.store');
   
    Route::get('{id}/edit','BranchController@edit')->name('branches.edit');
    Route::delete('{id}/delete','BranchController@destroy')->name('branches.delete');
    Route::patch('{id}/update','BranchController@update')->name('branches.update');

});

Route::group(["prefix"=>'nominatypes'],function(){
    Route::get('/','NominaTypeController@index')->name('nominatypes');
    Route::get('register','NominaTypeController@create')->name('nominatypes.create');
    Route::post('store','NominaTypeController@store')->name('nominatypes.store');
   
    Route::get('{id}/edit','NominaTypeController@edit')->name('nominatypes.edit');
    Route::delete('{id}/delete','NominaTypeController@destroy')->name('nominatypes.delete');
    Route::patch('{id}/update','NominaTypeController@update')->name('nominatypes.update');

});

Route::group(["prefix"=>'paymenttypes'],function(){
    Route::get('/','PaymentTypeController@index')->name('paymenttypes');
    Route::get('register','PaymentTypeController@create')->name('paymenttypes.create');
    Route::post('store','PaymentTypeController@store')->name('paymenttypes.store');
   
    Route::get('{id}/edit','PaymentTypeController@edit')->name('paymenttypes.edit');
    Route::delete('{id}/delete','PaymentTypeController@destroy')->name('paymenttypes.delete');
    Route::patch('{id}/update','PaymentTypeController@update')->name('paymenttypes.update');

});

Route::group(["prefix"=>'indexbcvs'],function(){
    Route::get('/','IndexBcvController@index')->name('indexbcvs');
    Route::get('register','IndexBcvController@create')->name('indexbcvs.create');
    Route::post('store','IndexBcvController@store')->name('indexbcvs.store');
   
    Route::get('{id}/edit','IndexBcvController@edit')->name('indexbcvs.edit');
    Route::delete('{id}/delete','IndexBcvController@destroy')->name('indexbcvs.delete');
    Route::patch('{id}/update','IndexBcvController@update')->name('indexbcvs.update');

});

Route::group(["prefix"=>'receiptvacations'],function(){
    Route::get('/','ReceiptVacationController@index')->name('receiptvacations');
    Route::get('/indexemployees','ReceiptVacationController@indexemployees')->name('receiptvacations.indexemployees');

    Route::get('register/{id}','ReceiptVacationController@create')->name('receiptvacations.create');
    Route::post('store','ReceiptVacationController@store')->name('receiptvacations.store');
    Route::get('{id}/edit','ReceiptVacationController@edit')->name('receiptvacations.edit');
    Route::delete('{id}/delete','ReceiptVacationController@destroy')->name('receiptvacations.delete');
    Route::patch('{id}/update','ReceiptVacationController@update')->name('receiptvacations.update');

});

Route::group(["prefix"=>'comisiontypes'],function(){
    Route::get('/','ComisionTypeController@index')->name('comisiontypes');
    Route::get('register','ComisionTypeController@create')->name('comisiontypes.create');
    Route::post('store','ComisionTypeController@store')->name('comisiontypes.store');
   
    Route::get('{id}/edit','ComisionTypeController@edit')->name('comisiontypes.edit');
    Route::delete('{id}/delete','ComisionTypeController@destroy')->name('comisiontypes.delete');
    Route::patch('{id}/update','ComisionTypeController@update')->name('comisiontypes.update');

});

Route::group(["prefix"=>'vendors'],function(){
    Route::get('/','VendorController@index')->name('vendors');
    Route::get('register','VendorController@create')->name('vendors.create');
    Route::post('store','VendorController@store')->name('vendors.store');
   
    Route::get('{id}/edit','VendorController@edit')->name('vendors.edit');
    Route::delete('{id}/delete','VendorController@destroy')->name('vendors.delete');
    Route::patch('{id}/update','VendorController@update')->name('vendors.update');

   
});

Route::group(["prefix"=>'products'],function(){
    Route::get('/','ProductController@index')->name('products');
    Route::get('register','ProductController@create')->name('products.create');
    Route::post('store','ProductController@store')->name('products.store');
   
    Route::get('{id}/edit','ProductController@edit')->name('products.edit');
    Route::delete('{id}/delete','ProductController@destroy')->name('products.delete');
    Route::patch('{id}/update','ProductController@update')->name('products.update');

});

Route::group(["prefix"=>'inventories'],function(){
    Route::get('/','InventoryController@index')->name('inventories');
    Route::get('selectproduct','InventoryController@selectproduct')->name('inventories.select');
    Route::post('store','InventoryController@store')->name('inventories.store');
    
    Route::get('{id}/edit','InventoryController@edit')->name('inventories.edit');
    Route::delete('{id}/delete','InventoryController@destroy')->name('inventories.delete');
    Route::patch('{id}/update','InventoryController@update')->name('inventories.update');

    Route::get('{id}/create','InventoryController@create')->name('inventories.create');

    Route::post('storeincreaseinventory','InventoryController@store_increase_inventory')->name('inventories.store_increase_inventory');
    Route::get('createincreaseinventory/{id_inventario}','InventoryController@create_increase_inventory')->name('inventories.create_increase_inventory');
   
    Route::post('storedecreaseinventory','InventoryController@store_decrease_inventory')->name('inventories.store_decrease_inventory');
    Route::get('createdecreaseinventory/{id_inventario}','InventoryController@create_decrease_inventory')->name('inventories.create_decrease_inventory');
    Route::get('movements','InventoryController@indexmovements')->name('inventories.movement');
   
});

Route::group(["prefix"=>'modelos'],function(){
    Route::get('/','ModeloController@index')->name('modelos');
    Route::get('register','ModeloController@create')->name('modelos.create');
    Route::post('store','ModeloController@store')->name('modelos.store');
    Route::get('{id}/edit','ModeloController@edit')->name('modelos.edit');
    Route::delete('{id}/delete','ModeloController@destroy')->name('modelos.delete');
    Route::patch('{id}/update','ModeloController@update')->name('modelos.update');
});
Route::group(["prefix"=>'colors'],function(){
    Route::get('/','ColorController@index')->name('colors');
    Route::get('register','ColorController@create')->name('colors.create');
    Route::post('store','ColorController@store')->name('colors.store');
    Route::get('{id}/edit','ColorController@edit')->name('colors.edit');
    Route::delete('{id}/delete','ColorController@destroy')->name('colors.delete');
    Route::patch('{id}/update','ColorController@update')->name('colors.update');
});
Route::group(["prefix"=>'transports'],function(){
    Route::get('/','TransportController@index')->name('transports');
    Route::get('register','TransportController@create')->name('transports.create');
    Route::post('store','TransportController@store')->name('transports.store');
    Route::get('{id}/edit','TransportController@edit')->name('transports.edit');
    Route::delete('{id}/delete','TransportController@destroy')->name('transports.delete');
    Route::patch('{id}/update','TransportController@update')->name('transports.update');
});

Route::group(["prefix"=>'historictransports'],function(){
    Route::get('/','HistoricTransportController@index')->name('historictransports');
    Route::post('store','HistoricTransportController@store')->name('historictransports.store');
    Route::get('{id}/edit','HistoricTransportController@edit')->name('historictransports.edit');
    Route::delete('{id}/delete','HistoricTransportController@destroy')->name('historictransports.delete');
    Route::patch('{id}/update','HistoricTransportController@update')->name('historictransports.update');

    Route::get('selecttransport','HistoricTransportController@selecttransport')->name('historictransports.selecttransport');
    Route::get('{idtransport}/selectemployee','HistoricTransportController@selectemployee')->name('historictransports.selectemployee');
    Route::get('{idtransport}/{idemployee}/create','HistoricTransportController@create')->name('historictransports.create');
});


Route::group(["prefix"=>'accounts'],function(){
    Route::get('/','AccountController@index')->name('accounts');
    Route::get('register','AccountController@create')->name('accounts.create');
    Route::post('store','AccountController@store')->name('accounts.store');
    Route::get('{id}/edit','AccountController@edit')->name('accounts.edit');
    Route::delete('{id}/delete','AccountController@destroy')->name('accounts.delete');
    Route::patch('{id}/update','AccountController@update')->name('accounts.update');

    Route::post('store/newlevel','AccountController@storeNewLevel')->name('accounts.storeNewLevel');
    

    Route::get('register/{code_one}/{code_two}/{code_three}/{code_four}/{period}','AccountController@createlevel')->name('accounts.createlevel');
    
    Route::get('movementaccount/{id_account}','AccountController@movements')->name('accounts.movements');
});

Route::group(["prefix"=>'headervouchers'],function(){
    Route::get('/','HeaderVoucherController@index')->name('headervouchers');
    Route::get('register','HeaderVoucherController@create')->name('headervouchers.create');
    Route::post('store','HeaderVoucherController@store')->name('headervouchers.store');
    Route::get('{id}/edit','HeaderVoucherController@edit')->name('headervouchers.edit');
    Route::delete('{id}/delete','HeaderVoucherController@destroy')->name('headervouchers.delete');
    Route::patch('{id}/update','HeaderVoucherController@update')->name('headervouchers.update');

});

Route::group(["prefix"=>'detailvouchers'],function(){
    Route::get('/','DetailVoucherController@index')->name('detailvouchers');
    Route::get('register','DetailVoucherController@create')->name('detailvouchers.create');
    Route::post('store','DetailVoucherController@store')->name('detailvouchers.store');
    Route::get('{id}/edit','DetailVoucherController@edit')->name('detailvouchers.edit');
    Route::delete('{id}/delete','DetailVoucherController@destroy')->name('detailvouchers.delete');
    Route::patch('{id}/update','DetailVoucherController@update')->name('detailvouchers.update');
   
    Route::get('selectaccount/{id_header}','DetailVoucherController@selectaccount')->name('detailvouchers.selectaccount');
    
    Route::get('selectheadervouche','DetailVoucherController@selectheader')->name('detailvouchers.selectheadervouche');

    Route::get('register/{id_header}','DetailVoucherController@createselect')->name('detailvouchers.createselect');

    Route::get('register/{id_header}/{code_one}/{code_two}/{code_three}/{code_four}/{period}','DetailVoucherController@createselectaccount')->name('detailvouchers.createselectaccount');

    Route::get('contabilizar/{id_header}','DetailVoucherController@contabilizar')->name('detailvouchers.contabilizar');
    
    Route::get('listheader/{var?}','DetailVoucherController@listheader')->name('detailvouchers.listheader');
});

Route::group(["prefix"=>'quotations'],function(){
    Route::get('/','QuotationController@index')->name('quotations');
    Route::get('register/{id_quotation}','QuotationController@create')->name('quotations.create');
    Route::post('store','QuotationController@store')->name('quotations.store');
    Route::get('{id}/edit','QuotationController@edit')->name('quotations.edit');
    Route::delete('{id}/delete','QuotationController@destroy')->name('quotations.delete');
    Route::patch('{id}/update','QuotationController@update')->name('quotations.update');

    Route::get('registerquotation','QuotationController@createquotation')->name('quotations.createquotation');

    Route::get('registerquotation/{id_client}','QuotationController@createquotationclient')->name('quotations.createquotationclient');
    Route::get('selectclient','QuotationController@selectclient')->name('quotations.selectclient');
    
    Route::get('registerquotation/{id_client}/{id_vendor}','QuotationController@createquotationvendor')->name('quotations.createquotationvendor');
    Route::get('selectvendor/{id_client}','QuotationController@selectvendor')->name('quotations.selectvendor');


    Route::get('selectproduct/{id_quotation}','QuotationController@selectproduct')->name('quotations.selectproduct');
    Route::get('register/{id_quotation}/{id_product}','QuotationController@createproduct')->name('quotations.createproduct');

    
    Route::post('storeproduct','QuotationController@storeproduct')->name('quotations.storeproduct');

    Route::get('facturar/{id_quotation}','FacturarController@createfacturar')->name('quotations.createfacturar');

    Route::post('storefactura','FacturarController@storefactura')->name('quotations.storefactura');
    Route::get('facturado/{id_quotation}','FacturarController@createfacturado')->name('quotations.createfacturado');

    Route::get('listinventory/{var?}','QuotationController@listinventory')->name('quotations.listinventory');


    Route::get('notadeentrega/{id_quotation}/{coin}','DeliveryNoteController@createdeliverynote')->name('quotations.createdeliverynote');

    Route::get('indexnotasdeentrega/','DeliveryNoteController@index')->name('quotations.indexdeliverynote');

    Route::get('quotationproduct/{id}/edit','QuotationController@editquotationproduct')->name('quotations.productedit');
    Route::patch('quotationproduct/{id}/update','QuotationController@updatequotationproduct')->name('quotations.productupdate');

    Route::post('storefacturacredit','FacturarController@storefacturacredit')->name('quotations.storefacturacredit');


    Route::get('facturarafter/{id_quotation}','FacturarController@createfacturar_after')->name('quotations.createfacturar_after');

   
});

Route::group(["prefix"=>'bankmovements'],function(){
    Route::get('/','BankMovementController@index')->name('bankmovements');
    Route::post('store','BankMovementController@store')->name('bankmovements.store');
    Route::get('{id}/edit','BankMovementController@edit')->name('bankmovements.edit');
    Route::delete('{id}/delete','BankMovementController@destroy')->name('bankmovements.delete');
    Route::patch('{id}/update','BankMovementController@update')->name('bankmovements.update');

    Route::get('registerdeposit/{id_account}','BankMovementController@createdeposit')->name('bankmovements.createdeposit');
    Route::get('registerretirement/{id_account}','BankMovementController@createretirement')->name('bankmovements.createretirement');

    Route::get('list/{contrapartida_id?}','BankMovementController@list')->name('bankmovements.list');
    Route::get('listbeneficiario/{beneficiario_id?}','BankMovementController@listbeneficiario')->name('bankmovements.listbeneficiario');
    
    Route::post('storeretirement','BankMovementController@storeretirement')->name('bankmovements.storeretirement');

    Route::get('registertransfer/{id_account}','BankMovementController@createtransfer')->name('bankmovements.createtransfer');
    Route::post('storetransfer','BankMovementController@storetransfer')->name('bankmovements.storetransfer');

    Route::get('seemovements','BankMovementController@indexmovement')->name('bankmovements.indexmovement');
    
});

Route::group(["prefix"=>'nominas'],function(){
    Route::get('/','NominaController@index')->name('nominas');
    Route::get('register','NominaController@create')->name('nominas.create');
    Route::post('store','NominaController@store')->name('nominas.store');
    Route::get('{id}/edit','NominaController@edit')->name('nominas.edit');
    Route::delete('{id}/delete','NominaController@destroy')->name('nominas.delete');
    Route::patch('{id}/update','NominaController@update')->name('nominas.update');

    Route::get('selectemployee/{id}','NominaController@selectemployee')->name('nominas.selectemployee');
 
    Route::get('calculate/{id}','NominaController@calculate')->name('nominas.calculate');
});


Route::group(["prefix"=>'nominaconcepts'],function(){
    Route::get('/','NominaConceptController@index')->name('nominaconcepts');
    Route::get('register','NominaConceptController@create')->name('nominaconcepts.create');
    Route::post('store','NominaConceptController@store')->name('nominaconcepts.store');
    Route::get('{id}/edit','NominaConceptController@edit')->name('nominaconcepts.edit');
    Route::delete('{id}/delete','NominaConceptController@destroy')->name('nominaconcepts.delete');
    Route::patch('{id}/update','NominaConceptController@update')->name('nominaconcepts.update');

    
});

Route::group(["prefix"=>'nominacalculations'],function(){
    Route::get('index/{id_nomina}/{id_employee}','NominaCalculationController@index')->name('nominacalculations');
    Route::get('register/{id_nomina}/{id_employee}','NominaCalculationController@create')->name('nominacalculations.create');
    Route::post('store','NominaCalculationController@store')->name('nominacalculations.store');
    Route::get('{id}/edit','NominaCalculationController@edit')->name('nominacalculations.edit');
    Route::delete('{id}/delete','NominaCalculationController@destroy')->name('nominacalculations.delete');
    Route::patch('{id}/update','NominaCalculationController@update')->name('nominacalculations.update');

});

Route::group(["prefix"=>'invoices'],function(){
    Route::get('/','InvoiceController@index')->name('invoices');

    Route::get('movementinvoice/{id_invoice}','InvoiceController@movementsinvoice')->name('invoices.movement');
    
   
 });

 Route::group(["prefix"=>'pdf'],function(){
    Route::get('factura/{id_quotation}','PDFController@imprimirfactura')->name('pdf');
    Route::get('deliverynote/{id_quotation}/{iva}','PDFController@deliverynote')->name('pdf.deliverynote');
    Route::get('inventory','PDFController@imprimirinventory')->name('pdf.inventory');

    Route::get('facturamedia/{id_quotation}','PDFController@imprimirfactura_media')->name('pdf.media');

    Route::get('expense/{id_expense}','PDFController@imprimirExpense')->name('pdf.expense');

    Route::get('expensemedia/{id_expense}','PDFController@imprimirExpenseMedia')->name('pdf.expense_media');
 });


 Route::group(["prefix"=>'tasas'],function(){
    Route::get('/','TasaController@index')->name('tasas');
    Route::get('register','TasaController@create')->name('tasas.create');
    Route::post('store', 'tasaController@store')->name('tasas.store');
   
    Route::get('{id}/edit','TasaController@edit')->name('tasas.edit');
    Route::delete('{id}/delete','TasaController@destroy')->name('tasas.delete');
    Route::patch('{id}/update','TasaController@update')->name('tasas.update');

});



Route::group(["prefix"=>'anticipos'],function(){
    Route::get('/','AnticipoController@index')->name('anticipos');
    Route::get('register','AnticipoController@create')->name('anticipos.create');
    Route::post('store', 'anticipoController@store')->name('anticipos.store');
   
    Route::get('{id}/edit','AnticipoController@edit')->name('anticipos.edit');
    Route::delete('{id}/delete','AnticipoController@destroy')->name('anticipos.delete');
    Route::patch('{id}/update','AnticipoController@update')->name('anticipos.update');

    Route::get('register/{id_client}','AnticipoController@createclient')->name('anticipos.createclient');
    Route::get('selectclient','AnticipoController@selectclient')->name('anticipos.selectclient');

    Route::get('historic','AnticipoController@indexhistoric')->name('anticipos.historic');
    
});


Route::group(["prefix"=>'sales'],function(){
    Route::get('/','SaleController@index')->name('sales');
    /*Route::get('register','SaleController@create')->name('sales.create');
    Route::post('store', 'saleController@store')->name('sales.store');
   
    Route::get('{id}/edit','SaleController@edit')->name('sales.edit');
    Route::delete('{id}/delete','SaleController@destroy')->name('sales.delete');
    Route::patch('{id}/update','SaleController@update')->name('sales.update');*/

});


Route::group(["prefix"=>'expensesandpurchases'],function(){
    Route::get('/','ExpensesAndPurchaseController@index')->name('expensesandpurchases');
    Route::get('registerexpense/{id_provider?}','ExpensesAndPurchaseController@create_expense')->name('expensesandpurchases.create');
    Route::post('store', 'ExpensesAndPurchaseController@store')->name('expensesandpurchases.store');
   
    Route::get('{id}/edit','ExpensesAndPurchaseController@edit')->name('expensesandpurchases.edit');
    Route::delete('{id}/delete','ExpensesAndPurchaseController@destroy')->name('expensesandpurchases.delete');
    Route::patch('{id}/update','ExpensesAndPurchaseController@update')->name('expensesandpurchases.update');


    Route::get('selectprovider','ExpensesAndPurchaseController@selectprovider')->name('expensesandpurchases.selectprovider');

    Route::get('register/{id_expense?}/{id_inventory?}','ExpensesAndPurchaseController@create_expense_detail')->name('expensesandpurchases.create_detail');
    
    Route::get('listaccount/{type_var?}','ExpensesAndPurchaseController@listaccount')->name('expensesandpurchases.listaccount');

    Route::post('storedetail', 'ExpensesAndPurchaseController@store_detail')->name('expensesandpurchases.store_detail');

    Route::get('registerpayment/{id_expense?}','ExpensesAndPurchaseController@create_payment')->name('expensesandpurchases.create_payment');
    
    Route::patch('storepayment','ExpensesAndPurchaseController@store_payment')->name('expensesandpurchases.store_payment');

    Route::get('indexhistorial','ExpensesAndPurchaseController@index_historial')->name('expensesandpurchases.index_historial');

    Route::post('storeexpensecredit', 'ExpensesAndPurchaseController@store_expense_credit')->name('expensesandpurchases.store_expense_credit');

    Route::get('selectinventary/{id_expense}','ExpensesAndPurchaseController@selectinventary')->name('expensesandpurchases.selectinventary');

    Route::get('expensevoucher/{id_expense}','ExpensesAndPurchaseController@create_expense_voucher')->name('expensesandpurchases.create_expense_voucher');

    Route::get('registerpaymentafter/{id_expense?}','ExpensesAndPurchaseController@create_payment_after')->name('expensesandpurchases.create_payment_after');
    
    Route::post('storeexpensepayment', 'ExpensesAndPurchaseController@store_expense_payment')->name('expensesandpurchases.store_expense_payment');

    Route::get('movementexpense/{id_expense}','ExpensesAndPurchaseController@movements_expense')->name('expensesandpurchases.movement');
    
});

Route::group(["prefix"=>'directpaymentorders'],function(){
    Route::get('/','DirectPaymentOrderController@createretirement')->name('directpaymentorders.create');
    Route::post('store','DirectPaymentOrderController@store')->name('directpaymentorders.store');

    Route::get('listbeneficiary/{type_var?}','DirectPaymentOrderController@listbeneficiary')->name('directpaymentorders.listbeneficiary');
    Route::get('listcontrapartida/{type_var?}','DirectPaymentOrderController@listcontrapartida')->name('directpaymentorders.listcontrapartida');

   

});


Route::group(["prefix"=>'inventarytypes'],function(){
    Route::get('/','InventaryTypeController@index')->name('inventarytypes');
    Route::get('create','InventaryTypeController@create')->name('inventarytypes.create');
    Route::post('store','InventaryTypeController@store')->name('inventarytypes.store');
    Route::get('{id}/edit','InventaryTypeController@edit')->name('inventarytypes.edit');
    Route::patch('{id}/update','InventaryTypeController@update')->name('inventarytypes.update');

});

Route::group(["prefix"=>'ratetypes'],function(){
    Route::get('/','RateTypeController@index')->name('ratetypes');
    Route::get('create','RateTypeController@create')->name('ratetypes.create');
    Route::post('store','RateTypeController@store')->name('ratetypes.store');
    Route::get('{id}/edit','RateTypeController@edit')->name('ratetypes.edit');
    Route::patch('{id}/update','RateTypeController@update')->name('ratetypes.update');

});

Route::group(["prefix"=>'companies'],function(){
    Route::get('/','CompaniesController@index')->name('companies');
    Route::get('register','CompaniesController@create')->name('companies.create');
    Route::post('store','CompaniesController@store')->name('companies.store');

    Route::get('{id}/edit','CompaniesController@edit')->name('companies.edit');
    Route::delete('{id}/delete','CompaniesController@destroy')->name('companies.delete');
    Route::patch('{id}/update','CompaniesController@update')->name('companies.update');

});

Route::group(["prefix"=>'nominaformulas'],function(){
    Route::get('/','NominaFormulaController@index')->name('nominaformulas');
    Route::get('register','NominaFormulaController@create')->name('nominaformulas.create');
    Route::post('store','NominaFormulaController@store')->name('nominaformulas.store');
    Route::get('{id}/edit','NominaFormulaController@edit')->name('nominaformulas.edit');
    Route::delete('{id}/delete','NominaFormulaController@destroy')->name('nominaformulas.delete');
    Route::patch('{id}/update','NominaFormulaController@update')->name('nominaformulas.update');

    Route::get('calcularlunes','NominaController@calcular_cantidad_de_lunes')->name('nominaformulas.calcular_cantidad_de_lunes');
});