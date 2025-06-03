<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $testimonials = Testimonial::all();
        return view('home', ['testimonials' => $testimonials]);
    }

    /**
     * Show the testimonial detail page.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function testimonialDetail(Request $request, $id)
    {
        $testimonial = Testimonial::findOrFail($id);
        return view('testimonial-detail', ['testimonial' => $testimonial]);
    }
}
