<?php

namespace App\Http\Controllers;

use App\Models\Images;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use App\Http\Requests\StoreNews;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $news = News::with('images')->where('published', true)->latest()->paginate(9);
        $Populars = News::with('images')->orderBy('views', 'desc')->take(5)->get();

        $last_news = News::where('published', true)->latest()->first();




        $url = url('/storage');
        // return $url . '/storage' . $news->images[0]->name;



        return view('news.index', compact('news', 'url', 'Populars', 'last_news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('news.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreNews $request)
    {
        //

        $news = new News();
        $news->title = $request->title;
        $news->content = $request->content;
        $news->created_by = auth()->user()->id;
        $news->save();
        $request->validate([
            'images.*' => 'mimes:doc,pdf,docx,zip,jpeg,png,jpg,gif,svg',
        ]);
        if ($file = $request->hasFile('images')) {

            $image = $request->file('images');
            $new_name = time() . '.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public/images', $new_name);
            $image_url = asset('storage/' . $path);

            $image = new Images();
            $image->name =  str_replace("public/", "", $path);;
            $image->news_id = $news->id;
            $image->save();
            return redirect()->back()->with('success', 'News uploaded successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function show($id = null)
    {
        //
        $url = url('/storage');

        $post = News::findOrFail($id);
        $post_images = [];
        $images = $post['images']->map(
            function ($product) use ($url) {
                $product->images_link = $url . '/' . $product->name;
                return $product;
            }
        );
        $post->images = $images;


        // do something

        return view('news.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function edit(News $news)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, News $news)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\News  $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        //
    }
}
