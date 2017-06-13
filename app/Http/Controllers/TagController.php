<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('tags.index', ['tags' => Tag::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['_tag_name'] = str_replace(' ', '_', $request->tag_name);
        $this->validate($request, [
            '_tag_name' => 'required|max:25|unique:tags,name|regex:/^[A-Za-z_\d\/]+$/'
        ]);
        if (Auth::user()){
            Auth::user()->tags()->create([
                'name' => $request->_tag_name
            ]);
        }
        else {
            Tag::create(['name' => $request->_tag_name]);
        }
        return back()->with('success', 'Tag created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $request['_tag_name'] = str_replace(' ', '_', $request->tag_name);
        $this->validate($request, [
            '_tag_name' => 'required|max:25|unique:tags,name|regex:/^[A-Za-z_\d\/]+$/'
        ]);
       $tag->update([
            'name' => $request->_tag_name
        ]);
        return back()->with('success', 'Tag updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        $tag->delete();
        return back()->with('info', 'Tag deleted');
    }
}
