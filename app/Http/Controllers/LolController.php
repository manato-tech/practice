<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Post;


class LolController extends Controller
{
    public function lol(){
        //postsデータ
        $posts=Post::all();
        return view('lol.lol');
    }
    

    }
