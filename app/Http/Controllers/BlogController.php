<?php

namespace App\Http\Controllers;
//for make transaction or process
use Illuminate\Http\Request;
//for validation
use Validator;
use App\Http\Requests;
use DB;
use App\blog;
//for session
use Session;
//for create pagination
use Illuminate\Pagination\LengthAwarePaginator;

use Illuminate\Support\Facades\Input;
class BlogController extends Controller
{
    //
    public function index(){
      $result=DB::table('blogs')->paginate(5);
      return view('blog.index')->with('blog',$result);

    }
    public function form()
    {
      return view('blog.form');
    }



    public function delete($id){
      $i=DB::table('blogs')->where('id',$id)->delete();
      if($i>0){
        Session::flash('message','Record has been Delete successfully');

          return redirect('blog');
      }
    }


    public function edit($id){
      $row=DB::table('blogs')->where('id',$id)->first();
      return view('blog.edit')->with('row',$row);
    }


public function update(Request $request)
    {
      $post=$request->all();
      // var_dump($post);
      $v= Validator::make($request->all(),
      [
      'title'=>'required',
      'description'=>'required',
      // 'blog_qty'=>'required'

      ]);
      if($v->fails())
      {
        return redirect()->back()->witherrors($v->errors());

      }
      else{
         if( $request->hasFile('file') ){
           $file = $request->file('file');
           $destination_path = 'uploads/';
           $filename = str_random(6).'_'.$file->getClientOriginalName();
           $file->move($destination_path, $filename);
           // $data->file = $destination_path . $filename;
             $data=array(
'file' => $destination_path . $filename,
          'title'=>$post['title'],
          'description'=>$post['description'],
          // 'blog_qty'=>$post['blog_qty']


          );
      }
        
        else{
        $data=array(
// 'file' => $destination_path . $filename,
          'title'=>$post['title'],
          'description'=>$post['description'],
          // 'blog_qty'=>$post['blog_qty']


          );
        }
        $i=DB::table('blogs')->where('id',$post['id'])->update($data);
        if($i>0){
          Session::flash('message','Record has been Update successfully');

          return redirect('blog');
        }

      }



    }

    public function save(Request $request)
    {


//     if($file = $request->file('file')){

//         $extension = $file->getClientOriginalName();
//         $name = rand(1111111111,9999999999).'.'.$extension.'.'.rand(0000000000,9999999999);
//         $file->move('images', $name);
//         // $input['file'] = $name;

//     }

      
// // DB::table('blogs')->insert($input);

//       $post=$request->all();
//       // var_dump($post);
//       $v= Validator::make($request->all(),
//       [
//       'title'=>'required',
//       'description'=>'required',
//       // 'blog_qty'=>'required'

//       ]);
//       if($v->fails())
//       {
//         return redirect()->back()->witherrors($v->errors());

//       }
//       else{
//         $data=array(

//           'title'=>$post['title'],
//           'description'=>$post['description'],
//           // 'blog_qty'=>$post['blog_qty'],
//                 'file'=>$name

//           );
//         $i=DB::table('blogs')->insert($data);
//         if($i>0){
//           Session::flash('message','Record has been Saved successfully');

//           return redirect('blog');
//         }

//       }


// {
//       // Validation //
      $validation = Validator::make($request->all(), [
         'title'     => 'required',
         'description' => 'required'
         // 'file'     => 'required|blog|mimes:jpeg,png|min:1|max:250'
      ]);

      // Check if it fails //
      if( $validation->fails() ){
         return redirect()->back()->withInput()
                          ->with('errors', $validation->errors() );
      }

      $blog = new Blog;

      // upload the blog //
      $file = $request->file('file');
      $destination_path = 'uploads/';
      $filename = str_random(6).'_'.$file->getClientOriginalName();
      $file->move($destination_path, $filename);
      
      // save blog data into database //
      $blog=array('file' => $destination_path . $filename,
      'title' => $request->input('title'),
     'description' => $request->input('description'));
      // $blog->save();
 DB::table('blogs')->insert($blog);


      return redirect('/blog')->with('message','You just uploaded an blog!');
   }


    // }


}
