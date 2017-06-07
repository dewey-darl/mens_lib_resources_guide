<?php

namespace App\Http\Controllers;

use App\Resource;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resources = Resource::all();
        return view('resources.index', ['resources' => $resources]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Resource::class);
        return view(
                'resources.create', 
                [
                    'resource' => new Resource,
                    'tag' => new Tag,
                    'tags' => Tag::orderBy('name')->get()
                ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Make sure the user is logged in
        $this->authorize('create', Resource::class);
        //Validate request
        $this->validate($request, [
            'name' => 'required|max:255|unique:resources',
            'url' => 'required|max:255|unique:resources',
            'description' => 'required|max:10000'
        ]);
        //Create the resource
        $resource = Auth::user()->resources()->create([
            'name' => $request->name,
            'url' => $request->url,
            'description' => $request->description
        ]);
        //Add the tags for this resource to the pivot table
        $resource->tags()->attach($request->tags);
        //Put a success message in the flasher
        $request->session()->flash('success', 'Resource created!');
        //Take them back to the resource form so they can add more resources
        return redirect('/resources/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function show(Resource $resource)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function edit(Resource $resource)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Resource $resource)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resource $resource)
    {
        //
    }
}
