<?php

namespace App\Http\Controllers;

use App\Models\NewsItem;

class HomeController extends Controller
{
	/*
	* Display the news high light with 10 latest news articles
	*/
	public function index(){
		$items = NewsItem::where('published',1)
						->orderBy('publish_date','desc')
						->take(10)
						->get();
		$showItemStatus = false;
		return view('home',compact('items','showItemStatus'));
	}

	/*
	* Show RSS feed with latest 10 published news
	*/
	public function feed(){
		
		// create new feed
	    $feed = \App::make("feed");

	    // multiple feeds are supported
	    // if you are using caching you should set different cache keys for your feeds

	    // cache the feed for 60 minutes (second parameter is optional)
	    $feed->setCache(60, 'laravelFeedKey');

	    // check if there is cached feed and build new only if is not
	    if (!$feed->isCached())
	    {
	       // creating rss feed with our most recent 20 posts
	       $posts = NewsItem::where('published',1)->orderBy('publish_date', 'desc')->take(10)->get();

	       // set your feed's title, description, link, pubdate and language
	       $feed->title = 'NewsPortal RSS Feed';
	       $feed->description = 'Latest news from NewsPortal';
	       $feed->link = url('feed');
	       $feed->setDateFormat('datetime'); // 'datetime', 'timestamp' or 'carbon'
	       $feed->pubdate = $posts[0]->created_at;
	       $feed->lang = 'en';
	       $feed->setShortening(true); // true or false
	       $feed->setTextLimit(100); // maximum length of description text

	       foreach ($posts as $post)
	       {
	           // set item's title, author, url, pubdate, description, content, enclosure (optional)*
	           $feed->add($post->title, $post->author->name, \URL::to($post->getSlug()), $post->publish_date, $post->content, $post->content);
	       }

	    }

	    // first param is the feed format
	    // optional: second param is cache duration (value of 0 turns off caching)
	    // optional: you can set custom cache key with 3rd param as string
	    return $feed->render('atom');

	}
	
}
