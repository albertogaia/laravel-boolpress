<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;
use Illuminate\Support\Facades\Storage;
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
            'tags'=>'nullable|exists:tags,id', // può essere vuoto
            'new_tags'=>'nullable', // può essere vuoto
            'image'=>'nullable|image'
        ]);

        $form_data=$request->all();
        $new_post = new Post();

        if(array_key_exists('image', $form_data)){
            //salviamo l'immagine e recuperiamo il path
            $cover_path = Storage::put('post_covers', $form_data['image']);
        
            // aggiungiamo all'array che viene usato nella funzione fill la chiave cover
            // che contiene il percorso relativo dell'immagine caricata a partire  da public/storage
            $form_data['cover'] = $cover_path;
        }
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

        // ! Creiamo i nuovi tags
        if($request->get('new_tags')){
            // Voglio dividere i tag che ricevo separati da virgola
            $tagNames = explode(',',$request->get('new_tags'));


            foreach($tagNames as $tagName){
                // Creo nuovo slug per ciascun nuovo nome
                $slug_new_tag = Str::slug($tagName, '-');
                $new_tag = new Tag;

                // Gli imposto un nome e uno slug mannaggia  a loro
                $new_tag->name = $tagName;
                $new_tag->slug = $slug_new_tag;

                // salvo il nuovo tag
                $new_tag->save();
                
                // Controllo se stati selezionati già tag esistenti
                if(isset($form_data['tags'])){
                    array_push($form_data['tags'], strval($new_tag->id));
                }else{
                
                    $form_data['tags'] = [strval($new_tag->id)];
                }

            }
        }

        // salviamo il post
        $new_post->save(); 
        //// $new_post->tags()->attach($form_data['tags']);

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
            'category_id'=>'nullable|exists:categories,id',
            'tags'=>'nullable|exists:tags,id',
            'image'=>'nullable|image'
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

        if(array_key_exists('image', $form_data)){
            Storage::delete($post->cover);
            // salvo l'immagine e recupero il path
            $cover_path = Storage::put('post_covers', $form_data['image']);
            $form_data['cover'] = $cover_path;
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