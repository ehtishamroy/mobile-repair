<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\HomepageContent;
use App\Models\AboutPageContent;
use App\Models\ServicePageContent;
use App\Models\JoinPageContent;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $content = HomepageContent::getContent();
        return view('frontend.index', compact('content'));
    }

    public function about()
    {
        $content = AboutPageContent::getContent();
        return view('frontend.about', compact('content'));
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function join()
    {
        $content = JoinPageContent::getContent();
        return view('frontend.join', compact('content'));
    }

    public function checkout()
    {
        return view('frontend.checkout');
    }

    public function marketplace()
    {
        return view('frontend.marketplace');
    }

    public function service()
    {
        $content = ServicePageContent::getContent();
        return view('frontend.service', compact('content'));
    }

    public function wishlist()
    {
        return view('frontend.wishlist');
    }

    public function trackOrder()
    {
        return view('frontend.track-order');
    }

    public function cart()
    {
        return view('frontend.cart');
    }

    public function select()
    {
        return view('frontend.select');
    }

    public function productDetail()
    {
        return view('frontend.product-detail');
    }

    public function placeOrder()
    {
        return view('frontend.place-order');
    }

    public function mobileRepair()
    {
        return view('frontend.mobile-repair');
    }
}
