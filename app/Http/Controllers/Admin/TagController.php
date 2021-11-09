<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Tag;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();
        return view('admin.tags.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.tags.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $request->url();
        
        $request->validate([
            'name'=>'required'
        ]);

        $form_data = $request->all();
        $new_tag = new Tag;
        $new_tag->fill($form_data);
        $slug = Str::slug($new_tag->name, '-');

        $slug_presente = Tag::where('slug', $slug)->first();
        $contatore = 1;
        while($slug_presente){
            $slug = $slug . '-' . $contatore;
            $slug_presente = Tag::where('slug', $slug)->first();
            $contatore++;
        }
        $new_tag->slug = $slug;
        $new_tag->save();

        return redirect()->route('admin.tags.index')->with('inserted', 'Il tag è stata correttamente creato');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tag = Tag::where('id', $id)->first();
        if(!$tag){
            abort(404);
        }return view('admin.tags.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = Tag::where('id', $id)->first();
        return view('admin.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'name'=>'required'
        ]);

        $form_data = $request->all();
        if($form_data['name'] != $tag->name){
            $slug = Str::slug($form_data['name'], '-');

            $slug_presente = Tag::where('slug', $slug)->first();
            $contatore = 1;
            while($slug_presente){
                $slug = $slug . '-' . $contatore;
                $slug_presente = Tag::where('slug', $slug)->first();
                $contatore++;
            }
            $form_data['slug'] = $slug;
        }

        $tag->update($form_data);

        return redirect()->route('admin.tags.index')->with('inserted', 'Il tag è stata correttamente modificato');
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
