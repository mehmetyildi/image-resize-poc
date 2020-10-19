<?php


namespace App\Http\Controllers;

use App\Models\CanvasImage;
use Illuminate\Http\Request;
use Image;

class ImageController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function resize(Request $request)
	{
		$image = Image::make($request->image);
		$height = $image->height();
		$width = $image->width();
		$ratio = $height / $width;
		if ($ratio == 1)
		{
			$return_image = $image;
		} else
		{
			$big_edge = $height <= $width ? $width : $height;
			dd($height,$width,$big_edge);
			$return_image = $image->resizeCanvas($big_edge, $big_edge, 'center', false, 'ffffff');
		}
		$finalName = self::generateName($image);
		$return_image->save(public_path('storage/' . $finalName));
		$canvas = CanvasImage::create([
			'image'=>$finalName
		]);
		return view('show', compact('canvas'));
	}

	public function generateName($image){
		$filename = 'image_' . time();
		$finalName = $filename . self::getImageExtension($image->mime());
		return $finalName;
	}

	public function getImageExtension($mime)
	{
		if ($mime == 'image/jpeg')
		{
			$extension = '.jpg';
		} elseif ($mime == 'image/png')
		{
			$extension = '.png';
		}
		return $extension;
	}

}