<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB as DB;
use App\Models\Blog as Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Ramsey\Collection\Collection;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //paginate
        $currentPage = $request->input('page', 1);
        $numPostPerPage = $request->input('limit', '20');
        if ($numPostPerPage == - 1){
            $numPostPerPage = Blog::all()->count();
        }
        if (auth()->user()){
            // show all blogs for user
            $posts = DB::table('blogs')->skip($numPostPerPage * $currentPage)->paginate($numPostPerPage);
        }
        else{
            // show enabled blogs
            $posts = DB::table('blogs')->where('status', 1)->paginate($numPostPerPage);
        }
        $pages = array();
        for ($i = 1; $i <= $posts->lastPage(); $i++) {
            $pages[] = $i;
        }
        return view('blog.index', [
            'posts'=>$posts->items(),
            'pages' =>$pages,
            'currentPage' => $currentPage,
            'perPage'=> $numPostPerPage]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('blog.create', ['post'=> null]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Log::info('Stored');
        $request->validate([
            'title' => 'required',
            'content' => 'required',
//            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $blog = new Blog;

        if (request()->image){
            $file_name = request()->image->getClientOriginalName() . '.' . request()->image->getClientOriginalExtension();
            request()->image->move(public_path('images'), $file_name);
        }
        else{
            // set default image
            $file_name = 'no-image.jpg';
        }

        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->image = '/images/'. $file_name;
        $blog->status = $request->status;

        $blog->save();
        return redirect('/blog');
    }
    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        if ($blog->status || auth()->user()){
            return view('blog.show', ['post'=> $blog]);
        }
        else{
            return redirect('/blog');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        return view('blog.create', ['post'=> $blog]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $newData = [
          'title'=> $request->title,
          'content'=> $request->content,
          'status'=> $request->status,
        ];
        if (request()->image){
            $file_name = request()->image->getClientOriginalName();
            request()->image->move(public_path('images'), $file_name);
            $newData['image'] = '/images/'. $file_name;
        }
        $blog->update($newData);
        return redirect('/blog');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect('/blog');
    }
}
