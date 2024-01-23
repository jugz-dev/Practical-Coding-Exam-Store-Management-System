<?php

namespace App\Http\Controllers;
use App\Models\Store;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    //
    public function index(){
      $stores = Store::all();
      return view('store', compact('stores'));
    }

    public function create(){
      return view('forms.create_store');
    }

    public function store(Request $request){

      $request->validate([
        'store_name' => 'required|string|max:255|regex:/^(?![.\'&, -])[A-Za-z\'\d.,&\/-][A-Za-z\'\d.,&\/ -]*$/|unique:stores',
        'store_address' => 'required|string|regex:/^(?![.\',-])[A-Za-z\'\d., -]+$/|min:4|max:255',
        'store_phone_number' => 'required|string|regex:/^09\d{9}$/|min:11|max:11|unique:stores',
        'store_email' => 'required|email|min:3|max:320|unique:stores',
      ],[
        'store_phone_number.unique' => 'The phone number is already taken by other registered records in the system.',
        'store_email.unique' => 'The email is already taken by other registered records in the system.',
      ]);

       Store::create([
         'store_name' => $request->store_name, 
         'store_address' => $request->store_address, 
         'store_phone_number' => $request->store_phone_number, 
         'store_email' => $request->store_email
       ]);

       return redirect(route('store.index'))->with('message', 'New store inserted succesfully!');
    }

    public function edit($id){
      $store = Store::find($id);
      if($store){
        return view('forms.edit_store', compact('store')); 
      }else{
        return redirect(route('store.index'))->with('warning', 'It looks like you are trying to access a record that does not exist.');
      }
      
    }

    public function update(Request $request, $id){
      $store = Store::find($id);

      $request->validate([
        'store_name' => [
            'required',
            'string',
            'max:255',
            'regex:/^(?![.\'&, -])[A-Za-z\'\d.,&\/-][A-Za-z\'\d.,&\/ -]*$/',
            Rule::unique('stores')->ignore($id),
        ],
        'store_address' => [
            'required',
            'string',
            'regex:/^(?![.\',-])[A-Za-z\'\d., -]+$/',
            'min:4',
            'max:255',
        ],
        'store_phone_number' => [
            'required',
            'string',
            'regex:/^09\d{9}$/',
            'min:11',
            'max:11',
            Rule::unique('stores')->ignore($id),
        ],
        'store_email' => [
            'required',
            'email',
            'min:3',
            'max:320',
            Rule::unique('stores')->ignore($id),
        ],
    ], [
        'store_phone_number.unique' => 'The phone number is already taken by other registered records in the system.',
        'store_email.unique' => 'The email is already taken by other registered records in the system.',
    ]);
    
      $store->update([
        'store_name' => $request->store_name, 
        'store_address' => $request->store_address, 
        'store_phone_number' => $request->store_phone_number, 
        'store_email' => $request->store_email
     ]);

       return redirect(route('store.index'))->with('message', 'Store record updated succesfully!');
    }

    public function delete($id){
      $store = Store::find($id);
      if($store){
        $store->delete();
        return redirect(route('store.index'))->with('message', 'Store record deleted succesfully!');;
      }else{
        return redirect(route('store.index'))->with('warning', 'It looks like you are trying to access a record that does not exist.');
      }

    }

}
