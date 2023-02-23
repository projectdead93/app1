<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use Illuminate\Http\Request;

class BlogsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $posts = Blogs::all();
        return response()->json(["data" => $posts], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $posts = Blogs::create($request->all());
        return $posts ? response()->json(['message' => 'post/s added successfully'], 200)
                      : response()->make('ERROR', 401);
        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blogs  $blogs
     * @return \Illuminate\Http\Response
     */
    public function show(Blogs $blogs, $id)
    {
        //
        $posts = $blogs->find($id);
        return $posts ? response()->json(["data" => $posts], 200)
                     : response()->json(["message" => "this post/s could not be found"]);;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blogs  $blogs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $posts = Blogs::find($id);
        $posts->update($request->all());
        return $posts ? response()->json(['message' => 'Post/s Updated Successfully!'], 200)
                      : response()->make('ERROR', 401);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blogs  $blogs
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blogs $blogs, $id)
    {
        //
        $posts = $blogs->destroy($id);
        return $posts ? response()->json(['message' => 'Post/s Deleted Successfully!'], 200)
                      : response()->make('ERROR', 401);
    }

    /**
     * Search for a name
     *
     * @param  str  $name
     * @return \Illuminate\Http\Response
     */
    public function searchByName($name)
    {
        return Blogs::where('Name', 'like', '%' . $name . '%')->get();
    }

    /**
     * Search for a Slug
     *
     * @param  str  $slug
     * @return \Illuminate\Http\Response
     */
    public function searchBySlug($slug)
    {
        return Blogs::where('Description', 'like', '%' . $slug . '%')->get();
    }
}



//php artisan make:controller API\\YourController --api --model=YourModel
//or
// php artisan make:model Blogs --resource