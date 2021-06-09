<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function home() {
        return view('homepage');
    }
    
    public function locale($locale){
        session()->put('locale', $locale);
        return redirect()->back();
    }
    public function search(Request $request){
        $q = $request->input('q');
        $articles = Article::search($q)->where('is_accepted', true)->paginate(6);
        return view('search.search_results', compact('q', 'articles'));
    }

    // vista home
}
