<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;

class mainController extends Controller
{
    public function getArticles(){
    	$articles=Article::all();
    	return view('articles/articles',compact('articles'));
    }
    public function getArticle($id){
    	$article=Article::findOrFail($id);
    	return view('articles/article',compact('article'));
    }
}
