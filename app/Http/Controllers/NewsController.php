<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\NewsItem;

class NewsController extends Controller
{
    /**
     * Display a listing of the news created by current user.
     * User can filter by all, draft and published articles
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        $query = $items = NewsItem::where('author_id',\Auth::id());
        switch (\Input::get('view')) {
            case 'draft':
                $query = $query->where('published',0);
                break;
            case 'published':
                $query = $query->where('published',1);
                break;
            default:
                //Query all articles created by current user
                break;
        }
        $items = $query->orderBy('created_at','desc')->get();
        $showItemStatus = true;
        return view('news.index',compact('items','showItemStatus'));
    }

    /**
     * Show the form for creating a new article.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCreate()
    {
        return view('news.create');
    }

    /*
    * Store the article into database
    */
    public function postCreate(Request $request)
    {
        $file = $request->file('picture');
        $rules = array('title'=>'required',
                        'content'=>'required',
                        'picture' => 'required|mimes:jpeg,jpg,png|max:5000');
        $fileUrl = null;
        $inputs = $request->all();
        $inputs['picture'] = $file;
        
        $validator = \Validator::make($inputs, $rules);
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();    
        }
        $extension = $file->getClientOriginalExtension();

        //Handle picture uploading
        $fileUrl =  time().'_'.strtolower(str_random(8)).'.'.$extension;
        $file->move(public_path().'/'.config('app.upload_dir'), $fileUrl);
        $inputs['picture'] = $fileUrl;
        
        //Assign current user as article's author
        $inputs['author_id'] = \Auth::id();
        NewsItem::create($inputs);
        return redirect('news');
    }

    /**
     * Display the specified news item.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getView($id)
    {
        $item = NewsItem::findOrFail($id);
        return view('news.view',compact('item'));
    }

    /**
     * Show the form for editing the article.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getEdit($id)
    {
        $item = NewsItem::findOrFail($id);
        if($news->author_id != \Auth::id()) abort(402);
        
        return view('news.edit',compact('item'));
    }

    /**
     * Update the article
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postEdit(Request $request, $id)
    {
        $news = NewsItem::findOrFail($id);
        if($news->author_id != \Auth::id()) abort(402);

        $file = $request->file('picture');
        $rules = array('title'=>'required',
                        'content'=>'required',
                        'picture' => 'mimes:jpeg,jpg,png|max:5000');
        $fileUrl = null;
        $inputs = $request->all();
        if($file){
            //Picture is optional
            $inputs['picture'] = $file;
        }

        //Validate title,content and picture summitted
        $validator = \Validator::make($inputs, $rules);
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();    
        }
        if($file){
            $extension = $file->getClientOriginalExtension();
            $fileUrl =  time().'_'.strtolower(str_random(8)).'.'.$extension;
            $file->move(public_path().'/'.config('app.upload_dir'), $fileUrl);
            //Delete old picture from storage
            if($news->picture){
                \File::delete(public_path().'/'.config('app.upload_dir').'/'.$news->picture);
            }
            $inputs['picture'] = $fileUrl;
        }

        //Do not change author_id in any case
        unset($inputs['author_id']);
        $news->fill($inputs);
        $news->save();
        return redirect('news');
    }

    /*
    * Delete the specified article from database
    */
    public function postDelete($id){
        $item = NewsItem::findOrFail($id);
        if($item->author_id != \Auth::id()) abort(402);
        if($item) $item->delete();
        return redirect('news');
    }

    /*
    * Publish the specified article
    */
    public function postPublish($id){
        $item = NewsItem::findOrFail($id);
        if($item->author_id != \Auth::id()) abort(402);
        $item->published = 1;
        $item->save();
        return back();
    }

    /*
    * Download the pdf version of the specified article
    */
    public function getPdf($id){
        $item = NewsItem::findOrFail($id);

        //Generate the pdf version of this article
        $pdf = \PDF::loadView('news.pdf', compact('item'));
        return $pdf->download($item->getSlug().'.pdf');
    }
}
