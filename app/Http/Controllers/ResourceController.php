<?php

namespace App\Http\Controllers;

use App\Resource;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        return view('resources.index', [
                                            'resources' => $resources, 
                                            'selected_tags' => []
                                        ]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('resources.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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

    /**
     * Returns and displays resources that have at least one of the specified tags.
     *
     * @param  String  $tagString  A string of tag names, separated by a +
     * @return \Illuminate\Http\Response
     */
    public function hasAny(String $tagString)
    {
        $tagNames = explode('+', $tagString);
        $resourcesInfo = DB::table('tags')
                        ->select('resources.id')
                        ->join('resource_tag', 'tags.id', '=', 'resource_tag.tag_id')
                        ->whereIn('tags.name', $tagNames)
                        ->join('resources', 'resource_tag.resource_id', '=', 'resources.id')
                        ->groupBy('resources.id')
                        ->inRandomOrder()
                        ->get();
        $resourceIds = array_column($resourcesInfo->all(), 'id');
        $resources = Resource::find($resourceIds);
        return view('resources.index', [
                                            'resources' => $resources, 
                                            'selected_tags' => $tagNames
                                        ]
        );
    }

    /**
     * Returns and displays resources that have all of the specified tags.
     *
     * @param  String  $tagString  A string of tag names, separated by a +
     * @return \Illuminate\Http\Response
     */
    public function hasAll(String $tagString)
    {
        $tagNames = explode('+', $tagString);
        $count = count($tagNames);
        $resourcesInfo = DB::table('tags')
                        ->select('resources.id', DB::raw('COUNT(*) AS count'))
                        ->join('resource_tag', 'tags.id', '=', 'resource_tag.tag_id')
                        ->whereIn('tags.name', $tagNames)
                        ->join('resources', 'resource_tag.resource_id', '=', 'resources.id')
                        ->groupBy('resources.id')
                        ->havingRaw("count >= $count")
                        ->inRandomOrder()
                        ->get();
        $resourceIds = array_column($resourcesInfo->all(), 'id');
        $resources = Resource::find($resourceIds);
        return view('resources.index', [
                                            'resources' => $resources, 
                                            'selected_tags' => $tagNames
                                        ]
        );
    }

}






