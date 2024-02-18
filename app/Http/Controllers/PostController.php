<?php

namespace App\Http\Controllers;
//import model "Post"

use Illuminate\Http\RedirectResponse;


use App\Models\Post;

//return type View
use Illuminate\View\View;

//return type redirectResponse
use Illuminate\Http\Request;

//import Facade "Storage"
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
     /**
     * index
     * 
     *  @return view
     */
    public function index(): View
    {
        //get posts
        $posts = Post::latest()->paginate(5);

        //render view dengan posts
        return view('posts.index',compact('posts'));
    }
    /**
     * create
     * 
     *  @return View
     */
    public function create():View
    {
        return view('posts.create');
    }
    /**
     * store
     * 
     *  @param mixed $request
     *  @return RedirectResponse
     */
    public function store (Request $request): RedirectResponse
    {
        //validasi form
        $this->validate($request, [
            'image'   => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'title'   => 'required|min:5',
            'content' => 'required|min:10'
        ]);

        $image = $request->file ('image');
        $image->storeAs('public/posts', $image->hashName());

        Post::create([
            'image' => $image -> hashName(),
            'title' => $request-> title,
            'content'=> $request-> content
        ]);
        return redirect()->route('posts.index')->with(['success' => 'Data berhasil Disimpan!']);
    }
    /**
     * show
     * 
     * @param mixed $id
     * @return View
     */
    public function show(string $id): View
    {
        $post= Post::findOrFail($id);
        return view('posts.show', compact('post'));
    }
    /**
     * edit
     * 
     * @param mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', compact('post'));
    }

    /**
     * update
     * 
     * @param mixed $request
     * @param mixed $id
     * @return RedirectResponse 
     */
    public function update(Request $request,$id): RedirectResponse
    {
        //validasi form
        $this->validate($request, [
            'image'   => 'image|mimes:jpeg,jpg,png|max:2048',
            'title'   => 'required|min:5',
            'content' => 'required|min:10',
        ]);
        //get post dengan id
        $post = Post::findOrFail($id);

        //check gambar yang di upload 
        if($request->hasFile('image')) {
            //uploadn gambar baru
            $image = $request->file('image');
            $image->storeAs('public/posts',$image->hashName());

            //delete gambar lama
            Storage::delete('public/posts/'.$post->image);

            //update post dengan gambar baru
            $post->update([
                'image' => $image->hashName(),
                'title' => $request->title,
                'content' => $request->content
            ]);
        } else {
            $post->update([
                'title' => $request->title,
                'content' => $request->content
            ]);
        }
        //kembali ke index
        return redirect()->route('posts.index')->with(['success' => ' Data Berhasil Diubah!']);
    }
        /**
         *  destroy
         *  @param mixed $post
         *  @return void 
         */
        public function destroy($id): RedirectResponse
        {
            //get post dengan id
            $post = Post::findOrFail($id);

            //delete gambar
            Storage::delete('public/posts/'. $post->image);

            //delete post 
            $post->delete();

            //kembali ke index
            return redirect()->route('posts.index')->with(['success' => 'Data berhasil Dihapus']);
}
}