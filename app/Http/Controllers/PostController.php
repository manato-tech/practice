<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Post;


class PostController extends Controller
{
    public function index(){
        //postsデータ
        $posts=Post::all();
        return view('post.index', compact('posts'));
    }
    public function create()
    {
        return view('post.create');
    }

    public function store(Request $request){
        Gate::authorize('test');
        $validated =  $request->validate([
            'title'=>'required|max:20',
            'body'=>'required|max:400',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'// 画像バリデーション
            
        ]);
        $validated['user_id']=auth()->id();

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('images', 'public'); // `storage/app/public/images` に保存
        }

        $post = Post::create($validated);
        $request->session()->flash('message','保存しました');
        return back();
    }
    
    //タイプヒント
    public function show(Post $post){
        return view('post.show',compact('post'));
    }
    

    public function edit(Post $post){
        return view('post.edit',compact('post'));
    }


    public function update(Request $request, Post $post){
        $validated =  $request->validate([
            'title'=>'required|max:20',
            'body'=>'required|max:400',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'// 画像バリデーション
        ]);

        $validated['user_id']=auth()->id();

        if ($request->hasFile('image')) {
            // 既存の画像を削除
            if ($post->image) {
                Storage::disk('public')->delete($post->image);
            }
            // 新しい画像を保存
            $validated['image'] = $request->file('image')->store('images', 'public');
        }

        $post->update($validated);

        $request->session()->flash('message','更新しました');
        return back();
    }

    public function destroy(Request $request,Post $post){

        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        $post->delete();
        //sessionは一時保存
        $request->session()->flash('message','削除しました');
        return redirect()->route('post.index');
    }

    public function search(Request $request)
{
    $query = $request->input('query');

    $posts = Post::where('title', 'like', "%{$query}%")
                 ->orWhere('body', 'like', "%{$query}%")
                 ->latest()
                 ->get();

    return view('post.search', compact('posts'));
}


    }

    

