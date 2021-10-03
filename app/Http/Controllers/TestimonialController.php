<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Product;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestimonialController extends Controller
{
    public function edit(){
        $products = Product::all();

        return view('customer.upload_testimonial', compact('products'));
    }

    public function save(Request $request){
        $data = $request->only('product_id','type','desc');
        $data['user_id'] = Auth::id();

        try {
            $testimonial = Testimonial::create($data);
            $media = null;
            if($request->hasFile('media')){
                $media = $request->media->store('testimonials','public');
            }
            if($media){
                $attachment = [];
                $attachment['attach_id'] = $testimonial->id;
                $attachment['type'] = 'testimonial';
                $attachment['url'] = asset('storage')."/".$media;
                Attachment::create($attachment);
            }

            session()->flash('testimonial_success', 1);
        }catch (\Exception $e){
            session()->flash('testimonial_error', 1);
        }

        return redirect()->back();
    }

    public function index(){
        $videos = Testimonial::with('attach')->where('type','video')->orderBy('created_at', 'DESC')->limit(6)->get();
        $pictures = Testimonial::with('attach')->where('type','picture')->orderBy('created_at', 'DESC')->limit(10)->get();

        return view('testimonial', compact('videos','pictures'));
    }

    public function all_images(){
        $data = Testimonial::with('attach')->where('type','picture')->orderBy('created_at', 'DESC')->paginate(9);
        $count = count($data);
        $pagination_params = [
            'result' => $count,
            'per_page' => 9
        ];

        return view('testimonial_images', compact('pagination_params'), ['data'=>$data]);
    }

    public function all_videos(){
        $data = Testimonial::with('attach')->where('type','video')->orderBy('created_at', 'DESC')->paginate(9);
        $count = count($data);
        $pagination_params = [
            'result' => $count,
            'per_page' => 9
        ];

        return view('testimonial_videos', compact('pagination_params'), ['data'=>$data]);
    }
}
