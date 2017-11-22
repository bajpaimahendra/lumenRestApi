<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $aticles =  \DB::table('content')
        ->select('id', 'url', 'title', 'publisher', 'published_at', 'description')
        ->where('is_active', 1)
        ->orderBy('published_at', 'desc')
        ->take(10)
        ->get();
        return response()->json($aticles);
    }
    public function category()
    {
        return 'category';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $aticle =  \DB::table('content')
        ->select('id', 'url', 'title', 'publisher', 'published_at', 'description')
        ->where('id', $id)
        ->orderBy('published_at', 'desc')
        ->get();
        return response()->json($aticle);
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
        //
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
}
