<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects= Project::all();

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $types= Type::all();
        return view('admin.projects.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $data = $request->validated();

        if ( isset($data['cover_image']) ) {
            $data['cover_image'] = Storage::put('uploads', $data['cover_image']);
        }

        $new_project = new Project();
        $new_project->fill($data);
        $new_project->slug = Str::slug($new_project->title);
        $new_project->save();

        return redirect()->route('admin.projects.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(string $slug)
    {   
        $project= Project::where('slug', $slug)->first();
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(string $slug)
    {
        $types= Type::all();

        $project= Project::where('slug', $slug)->first();
        return view('admin.projects.edit', compact('project', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $data=$request->validated();

        if ( isset($data['cover_image']) ) {
            if( $project->cover_image ) {
                Storage::delete($project->cover_image);
            }
            $data['cover_image'] = Storage::put('uploads', $data['cover_image']);
        }

        if( isset($data['no_image']) && $project->cover_image  ) {
            Storage::delete($project->cover_image);
            $project->cover_image = null;
        }

        $project->title = $data['title'];
        $project->client = $data['client'];
        $project->description = $data['description'];
        $project->type_id= $data['type_id'];
        $project->slug = Str::slug($data['title']);

        $project->update();

        return redirect()->route('admin.projects.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('admin.projects.index', $project);
    }
}
