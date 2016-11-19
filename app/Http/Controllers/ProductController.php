<?php

namespace App\Http\Controllers;
//for make transaction or process
use Illuminate\Http\Request;
//for validation
use Validator;
use App\Http\Requests;
use DB;
//for session
use Session;
//for create pagination
use Illuminate\Pagination\LengthAwarePaginator;

use Illuminate\Support\Facades\Input;
class ProductController extends Controller
{
    //
    public function index(){
    	$result=DB::table('products')->paginate(5);
    	 return view('product.index')->with('data',$result);
        // return $result;

    }
    public function form()
    {
    	return view('product.form');
    }



    public function delete($id){
    	$i=DB::table('products')->where('id',$id)->delete();
    	if($i>0){
    		Session::flash('message','Record has been Delete successfully');

    			return redirect('product');
    	}
    }


    public function edit($id){
    	$row=DB::table('products')->where('id',$id)->first();
    	return view('product.edit')->with('row',$row);
    }


public function update(Request $request)
    {
    	$post=$request->all();
    	// var_dump($post);
    	$v= Validator::make($request->all(),
    	[
    	'product_name'=>'required',
    	'product_price'=>'required',
    	'product_qty'=>'required'

    	]);
    	if($v->fails())
    	{
    		return redirect()->back()->witherrors($v->errors());

    	}
    	else{
    		$data=array(

    			'product_name'=>$post['product_name'],
		    	'product_price'=>$post['product_price'],
		    	'product_qty'=>$post['product_qty']


    			);
    		$i=DB::table('products')->where('id',$post['id'])->update($data);
    		if($i>0){
    			Session::flash('message','Record has been Update successfully');

    			return redirect('product');
    		}

    	}

    }

    public function save(Request $request)
    {

//          if(Input::hasFile('file')){

//                         echo 'Uploaded
// ';
//                         $file = Input::file('file');
//                         $file->move('uploads', $file->getClientOriginalName());
//                         echo '';
//                 }


  // $input = $request->all();

    if($file = $request->file('file')){

        $extension = $file->getClientOriginalName();
        $name = rand(1111111111,9999999999).'.'.$extension.'.'.rand(0000000000,9999999999);
        $file->move('images', $name);
        // $input['file'] = $name;

    }

      
// DB::table('products')->insert($input);

    	$post=$request->all();
    	// var_dump($post);
    	$v= Validator::make($request->all(),
    	[
    	'product_name'=>'required',
    	'product_price'=>'required',
    	'product_qty'=>'required'

    	]);
    	if($v->fails())
    	{
    		return redirect()->back()->witherrors($v->errors());

    	}
    	else{
    		$data=array(

    			'product_name'=>$post['product_name'],
		    	'product_price'=>$post['product_price'],
		    	'product_qty'=>$post['product_qty'],
                'file'=>$name

    			);
    		$i=DB::table('products')->insert($data);
    		if($i>0){
    			Session::flash('message','Record has been Saved successfully');

    			return redirect('product');
    		}

    	}

    }


}
