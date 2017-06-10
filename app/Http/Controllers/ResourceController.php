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
        $resources = Resource::published()->get();
        return view('resources.index', [
                                            'resources' => $resources, 
                                            'selected_tags' => collect([])
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
            'url' => 'required|max:255|unique:resources|active_url',
            'description' => 'required|max:10000',
            'tags.*' => 'exists:tags,id'
        ]);
        //Create the resource
        $resource = Auth::user()->resources()->create([
            'name' => $request->name,
            'url' => $request->url,
            'description' => $request->description,
            'is_published' => Auth::user()->isAdmin()
        ]);
        //Add the tags for this resource to the pivot table
        $resource->tags()->attach($request->tags);
        $responseText = 'Resource created';
        $responseText .= Auth::user()->isAdmin() ? ' and published!' : ' and awaiting review.';
        //Take them back to the resource form so they can add more resources
        return redirect('/resources/create')->with('success', $responseText);
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
        return view(
                'resources.edit', 
                [
                    'resource' => $resource
                ]
        );
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
        //Validate request
        $this->validate($request, [
            'name' => 'required|max:255',
            'url' => 'required|max:255',
            'description' => 'required|max:10000',
            'tags.*' => 'exists:tags,id',
            'is_published' => 'required|boolean'
        ]);
        //Create the resource
        $resource->update([
            'name' => $request->name,
            'url' => $request->url,
            'description' => $request->description,
            'is_published' => $request->is_published
        ]);
        //Drop the tags from the pivot table. Add the updated ones
        $resource->tags()->detach();
        //Add the tags for this resource to the pivot table
        $resource->tags()->attach($request->tags);
        $responseText = 'Resource updated';
        $responseText .= $request->is_published ? ' and published' : '';
        //Take them back to the resource form so they can add more resources
        return back()->with('success', $responseText);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Resource  $resource
     * @return \Illuminate\Http\Response
     */
    public function destroy(Resource $resource)
    {
        $resource->delete();
        return back()->with('info', 'Resource deleted');
    }

    /**
     * Returns and displays resources that have at least one of the specified tags.
     *
     * @param  String  $tagString  A string of tag names, separated by a +
     * @return \Illuminate\Http\Response
     */
    public function hasAny(String $tagString=null)
    {
        if (!isset($tagString)){
            return redirect()->action('ResourceController@index');
        }
        $tagNames = explode('+', $tagString);
        $invalidNames = $this->getInvalidTagNames($tagNames);
        if (count($invalidNames) > 0){
            return back()->with('danger', 'Invalid tag names: ' . implode(', ', $tagNames));
        }
        $resourcesInfo = DB::table('tags')
                        ->select('resources.id')
                        ->join('resource_tag', 'tags.id', '=', 'resource_tag.tag_id')
                        ->whereIn('tags.name', $tagNames)
                        ->join('resources', 'resource_tag.resource_id', '=', 'resources.id')
                        ->where('is_published', true)
                        ->groupBy('resources.id')
                        ->inRandomOrder()
                        ->get();
        $resourceIds = array_column($resourcesInfo->all(), 'id');
        $resources = Resource::find($resourceIds);
        return view('resources.index', [
                                            'resources' => $resources, 
                                            'selected_tags' => Tag::whereIn('name', $tagNames)->get()
                                        ]
        );
    }

    /**
     * Returns and displays resources that have all of the specified tags.
     *
     * @param  String  $tagString  A string of tag names, separated by a +
     * @return \Illuminate\Http\Response
     */
    public function hasAll(String $tagString=null)
    {
        if (!isset($tagString)){
            return redirect()->action('ResourceController@index');
        }
        $tagNames = explode('+', $tagString);
        $invalidNames = $this->getInvalidTagNames($tagNames);
        if (count($invalidNames) > 0){
            return back()->with('danger', 'Invalid tag names: ' . implode(', ', $tagNames));
        }
        $count = count($tagNames);
        $resourcesInfo = DB::table('tags')
                        ->select('resources.id', DB::raw('COUNT(*) AS count'))
                        ->join('resource_tag', 'tags.id', '=', 'resource_tag.tag_id')
                        ->whereIn('tags.name', $tagNames)
                        ->join('resources', 'resource_tag.resource_id', '=', 'resources.id')
                        ->where('is_published', true)
                        ->groupBy('resources.id')
                        ->havingRaw("count >= $count")
                        ->inRandomOrder()
                        ->get();
        $resourceIds = array_column($resourcesInfo->all(), 'id');
        $resources = Resource::find($resourceIds);
        return view('resources.index', [
                                            'resources' => $resources, 
                                            'selected_tags' => Tag::whereIn('name', $tagNames)->get()
                                        ]
        );
    }

    public function getUnpublished(Request $request){
        return view(
                'resources.unpublished', 
                [
                    'resources' => Resource::unpublished()->get()
                ]
        );
    }

    public function publish(Resource $resource){
        $resource->update(['is_published' => true]);
        return back()->with('success', 'Resource published');
    }

    public function unpublish(Resource $resource){
        $resource->update(['is_published' => false]);
        return back()->with('info', 'Resource unpublished');
    }

    private function getInvalidTagNames(Array $tagNames){
        $invalidNames = [];
        foreach ($tagNames as $name){
            if(Tag::where('name', $name)->count() === 0){
                $invalidNames[] = $name;
            }
        }
        return $invalidNames;
    }

}






