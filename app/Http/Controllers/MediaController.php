<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use DB;
use Helper;
use App\Media;

class MediaController extends Controller
{
    public function uploads(Request $request)
    {
    	DB::transaction(function() use ($request){

    		foreach ($request->file('file') as $file) {

	    		$extension = $file->getClientOriginalExtension();

	            $realfilename = $file->getClientOriginalName();
	            $filesize = $file->getClientSize();

	            $dir = public_path('uploads/');
	            $filename = time() .'_'. rand() .'.' . $extension;
	            $file->move($dir, $filename);

	            $thumb1 = Image::make($dir.'/'.$filename);
	            $thumb1->fit(215, 215);
	            $thumb1->save($dir.'thumbs/'.$filename);

		        $media = new Media;
		        $media->name = $filename;
		        $media->alt = pathinfo($realfilename, PATHINFO_FILENAME);
		        $media->size = $filesize;
		        $media->save();
		    }

    	});
    	

	    $res = [
	    			'title' => 'Success',
	    			'type' => 'success',
	    			'message' => count($request->file).' uploaded successfuly'
    			];

		return response()->json($res);

    }

    public function getData(Request $request)
    {
    	$images = Media::orderBy('id', 'desc');

    	if (isset($request->keyword)) {
    		clone $images->where('name', 'like', '%'.$request->keyword.'%')
    					->orWhere('alt', 'like', '%'.$request->keyword.'%')
    					->orWhere('description', 'like', '%'.$request->keyword.'%');
    	}

	 	if ($request->ajax()) {
            return view('backend.media.load', ['images' => $images->get()])->render();  
        }
    }

    public function selectData($id)
    {
    	$media = Media::find($id);
    	$media->size = Helper::bytesToHuman($media->size);

    	return $media->toJson();
    }

    public function destroy($id)
    {
    	$media = Media::find($id);

        if (file_exists(public_path('uploads/thumbs/'.$media->name))) {
            unlink(public_path('uploads/thumbs/'.$media->name));
        }

        if (file_exists(public_path('uploads/'.$media->name))) {
            unlink(public_path('uploads/'.$media->name));
        }

    	$media->delete();

    	$res = ['title' => 'Success', 'type' => 'success', 'message' => 'Delete success!'];

    	return response()->json($res);

    }
}
