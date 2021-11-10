<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;

use Illuminate\Support\Str;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Per prima cosa valido i dati che arrivano dal form
        $request->validate([
            'title'=>'required|max:255',
            'content'=> 'required',
            'author'=>'required',
            'thumbnail'=>'required',
            'tags'=>'exists:tags,id',
        ]);

        $form_data=$request->all();
        $new_post = new Post();

        // storiamo i dati con il metodo fill
        $new_post->fill($form_data);

        // Generiamo lo slug
        /*
            Titolo: il mio post
            Slug: il-mio-post
        */
        $slug = Str::slug($new_post->title, '-');

        $slug_presente = Post::where('slug', $slug)->first();
        $contatore = 1;
        while($slug_presente){
            $slug = $slug . '-' . $contatore;
            $slug_presente = Post::where('slug', $slug)->first();
            $contatore++;
        }

        $new_post->slug = $slug;

        // Creiamo i nuovi tags
        
        if($request->get('new_tags')){
            $tagNames = explode(',',$request->get('new_tags'));
            // $tagsID = [];
            foreach($tagNames as $tagName){
                //// $slug_tag_presente = Tag::where('slug', $tagName)->first();
                //// dump($slug_tag_presente);
                $slug_new_tag = Str::slug($tagName, '-');
                $new_tag = new Tag;
                $new_tag->name = $tagName;
                $new_tag->slug = $slug_new_tag;
                // dump($new_tag);
                // $new_tag->save();


                // return $slug_new_tag;
                // $new_tag = Tag::firstOrCreate(['name'=>$tagName]);
                // if($new_tag){
                //     $tagsID[] = $new_tag->id;
                // }
                // $slug_new_tag = Str::slug($new_tag->name, '-');

                // $slug_tag_presente = Tag::where('slug', $slug_new_tag)->first();
                // $contatore_tag = 1;

                // while($slug_tag_presente){
                //     $slug_new_tag = $slug_new_tag . '-' . $contatore_tag;
                //     $slug_tag_presente = Tag::where('slug', $slug_new_tag)->first();
                //     $contatore_tag++;
                // }
                // $new_tag->$slug_new_tag = $slug_new_tag;

                $new_tag->save();
            }
        }

        // salviamo
        $new_post->save();

        $new_post->tags()->attach([$form_data['tags'], $form_data['new_tags']]);
        if(array_key_exists('tags', $form_data)){
            $new_post->tags()->attach($form_data['tags']);
        }

        return redirect()->route('admin.posts.index')->with('inserted', 'Il post è stato correttamente creato');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tags = Tag::all();
        $post = Post::where('id', $id)->first();
        if(!$post){
            abort(404);
        }return view('admin.posts.show', compact('post', 'tags'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if(!$post){
            abort(404);
        }

        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title'=>'required|max:255',
            'content'=> 'required',
            'thumbnail'=>'required',
            'category_id'=>'nullable|exists:categories,id',
            'tags'=>'nullable|exists:tags,id',
        ]);

        $form_data = $request->all();

        if($form_data['title'] != $post->title){
            $slug = Str::slug($form_data['title'], '-');

            $slug_presente = Post::where('slug', $slug)->first();
            $contatore = 1;
            while($slug_presente){
                $slug = $slug . '-' . $contatore;
                $slug_presente = Post::where('slug', $slug)->first();
                $contatore++;
            }
            $form_data['slug'] = $slug;
        }

        $post->update($form_data);

        if(array_key_exists('tags', $form_data)){
            $post->tags()->sync($form_data['tags']);
        }else{
            $post->tags()->sync($form_data[]);
        }

        return redirect()->route('admin.posts.index')->with('updated', 'Post correttamente aggiornato');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->tags()->detach($post->id);
        $post->delete();
        return redirect()->route('admin.posts.index')->with('deleted', 'Post eliminato');
    }


}
