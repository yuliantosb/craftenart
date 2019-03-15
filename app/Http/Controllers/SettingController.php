<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Widget;
use App\Setting;

class SettingController extends Controller
{
    public function index()
    {
    	$settings = Setting::get();
    	$widgets = Widget::get();

    	$results_en = [];
        $results_id = [];

    	foreach ($settings as $setting) {
    		$results_en[$setting->name] = json_decode($setting->content_en);
            $results_id[$setting->name] = json_decode($setting->content_id);
    	}

    	return view('backend.settings', compact(['results_en', 'results_id', 'widgets']));
    }

    public function getWidget()
    {
    	$widget = Widget::select('id', 'name as text')
    				->get();

    	return response()->json($widget);
    }

    public function store(Request $request)
    {
    	
    	if ($request->submit == 'en') {
            $this->store_en($request);
        } else {
            $this->store_id($request);
        }

     	return redirect()
                ->back()
                ->with('message', 'Setting saved successfully!');

        // dd($request->footer);


    }

    private function store_en($request)
    {
        foreach ($request->all() as $index => $datas) {

            if ($index == 'banner') {

                $banner = [];

                $banner_img = $request->banner['img'];
                $banner_align = $request->banner['align'];
                $banner_title = $request->banner['title'];
                $banner_header = $request->banner['header'];
                $banner_subheader = $request->banner['subheader'];
                $banner_content = $request->banner['content'];
                $banner_url = $request->banner['url'];
                $banner_url_text = $request->banner['url_text'];

                foreach($banner_img as $key => $v){
                    $banner[] = [
                                    'img' => $banner_img[$key],
                                    'align' => $banner_align[$key],
                                    'title' => $banner_title[$key],
                                    'header' => $banner_header[$key],
                                    'subheader' => $banner_subheader[$key],
                                    'content' => $banner_content[$key],
                                    'url' => $banner_url[$key],
                                    'url_text' => $banner_url_text[$key],
                                ];
                }

                Setting::updateOrCreate(['name' => 'banner'],[
                        'content_en' => json_encode($banner)]);

            } else if ($index == 'footer') {

                $footer = [];
                $footer_title = $request['footer']['title'];
                $footer_align = $request['footer']['align'];
                $footer_widget_id = $request['footer']['widget_id'];

                foreach($footer_title as $key => $v){

                    $footer[] = [
                                    'title' => $footer_title[$key],
                                    'widget_id' => $footer_widget_id[$key],
                                    'align' => $footer_align[$key]
                                ];
                }

                Setting::updateOrCreate(['name' => 'footer'],
                                        ['content_en' => json_encode($footer)]);

            } else {

                Setting::updateOrCreate(['name' => $index],
                                        ['content_en' => json_encode($datas)]);
            }
        
        }
    }

    private function store_id($request)
    {
        foreach ($request->all() as $index => $datas) {

            if ($index == 'banner') {

                $banner = [];

                $banner_img = $request->banner['img'];
                $banner_align = $request->banner['align'];
                $banner_title = $request->banner['title'];
                $banner_header = $request->banner['header'];
                $banner_subheader = $request->banner['subheader'];
                $banner_content = $request->banner['content'];
                $banner_url = $request->banner['url'];
                $banner_url_text = $request->banner['url_text'];

                foreach($banner_img as $key => $v){
                    $banner[] = [
                                    'img' => $banner_img[$key],
                                    'align' => $banner_align[$key],
                                    'title' => $banner_title[$key],
                                    'header' => $banner_header[$key],
                                    'subheader' => $banner_subheader[$key],
                                    'content' => $banner_content[$key],
                                    'url' => $banner_url[$key],
                                    'url_text' => $banner_url_text[$key],
                                ];
                }

                Setting::updateOrCreate(['name' => 'banner'],[
                        'content_id' => json_encode($banner)]);

            } else if ($index == 'footer') {

                $footer = [];
                $footer_title = $request->footer['title'];
                $footer_align = $request->footer['align'];
                $footer_widget_id = $request->footer['widget_id'];

                foreach($footer_title as $key => $v){

                    $footer[] = [
                                    'title' => $footer_title[$key],
                                    'widget_id' => $footer_widget_id[$key],
                                    'align' => $footer_align[$key]
                                ];
                }

                Setting::updateOrCreate(['name' => 'footer'],
                                        ['content_id' => json_encode($footer)]);

            } else {

                Setting::updateOrCreate(['name' => $index],
                                        ['content_id' => json_encode($datas)]);
            }
        
        }
    }
}
