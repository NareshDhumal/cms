<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\backend\Cmspages;


class PagesController extends Controller
{
  public function index($cms_pages_id)
  {
    $page_content = Cmspages::Where('cms_slug',$cms_pages_id)->Where('show_hide',1)->first();
    if($page_content)
    {
      return view('frontend.pages.index',compact('page_content'));
    }
  }

  public function faqs()
  {
    $faqs = FAQs::Where('visibility',1)->orderBy('sort_order','asc')->get();
    if($faqs)
    {
      return view('frontend.pages.faqs',compact('faqs'));
    }
  }
}
