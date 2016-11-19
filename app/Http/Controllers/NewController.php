<?php
namespace App\Http\Controllers;
use Request;
//for validation
use Validator;
use App\Http\Requests;
use DB;
class NewController extends Controller
{
    /**
     * Posts
     *
     * @return void
     */
    public function showPosts()
    {
        $posts = DB::table('products')->paginate(3);

        if (Request::ajax()) {
            return Response::json(View::make('posts', array('posts' => $posts))->render());
        }

        // return View::make('blog', array('posts' => $posts));
         return view('blog')->with('posts',$posts);

    }
}