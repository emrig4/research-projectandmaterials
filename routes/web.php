<?php
use Modules\Setting\Http\Controllers\Admin\SitemapController;
use Illuminate\Support\Facades\Storage;
use Modules\Files\Entities\Files;
use Illuminate\Http\Request;
use Airondev\pCloud\File as pCloudFile;
use Airondev\pCloud\Folder as pCloudFolder;
use Illuminate\Support\Carbon;
use Modules\Category\Entities\Category;
use App\Http\Controllers\Optimizer;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Route::get('/', function () {
    return view('welcome');
});
 */
 
Route::get('installer/index', 'InstallerController@index');
Route::get('installer/requirements', 'InstallerController@serverRequirements');
Route::get('installer/configuration', 'InstallerController@environmentConfiguration');
Route::post('installer/configuration', 'InstallerController@postConfiguration');
Route::get('installer/complete', 'InstallerController@complete');

// Misc 
Route::get('/seed', function(){
	$rates = App\Helpers\fxExchange::getRates();
    $currencies = App\Helpers\dbSeeder::seedCurrency();
    return [$rates, $currencies];
});

// Route::get('/seed/currencies', function(){
// 	return App\Helpers\dbSeeder::seedCurrency();
// });

// Route::get('sitemap/generate', 'SitemapController@create')->name('sitemap.generate');
Route::get('sitemap/generate', function(){
	 return SitemapController::index();
})->name('sitemap.generate');


// optimize local asset images
Route::get('optimize/asset-images', function(){
	$directory = public_path("themes/cynoebook/public/images/lib-pictures");
	$images = glob("$directory/*.{jpg,png,bmp,jpeg,gif}", GLOB_BRACE);
	$img = new Optimizer();
	foreach($images as $image)
	{
	  // echo $image;
	  $img->optimize($image);
	}
	// $path = public_path('storage/media/84JCY17D0RuUS68ruH4PQIDxVQYPWGPCSG9TbI1Y.jpg');
	// $destination = public_path('storage/media/SCREENSHOT.JPEG');

	// $img = new Optimizer();
	// return $img->optimize($path, $destination);

})->name('optimize.images.asset');


// optimize images
Route::get('optimize/images', function(){

	if (request()->has('dir')) {
       $dir = request()->input('dir');

       	$directory = public_path($dir);
		$images = glob("$directory/*.{jpg,png,bmp,jpeg,gif}", GLOB_BRACE);
		$img = new Optimizer();
		foreach($images as $image)
		{
		  // echo $image;
		  $img->optimize($image);
		}
		return redirect()->back()->with('success', 'Images Optimized successfully');

	}
})->name('optimize.images');


// optimize cloud images
Route::get('optimize/cloud-images', function(){

	// if (request()->has('dir')) {
 //       $dir = request()->input('dir');


 //       	$directory = public_path($dir);
	// 	$images = glob("$directory/*.{jpg,png,bmp,jpeg,gif}", GLOB_BRACE);
	// 	$img = new Optimizer();
	// 	foreach($images as $image)
	// 	{
	// 	  // echo $image;
	// 	  $img->optimize($image);
	// 	}
	// 	return redirect()->back()->with('success', 'Images Optimized successfully');

	// }
	// $files = Files::where('mime', 'image/jpeg')
	// 				->orWhere('mime', 'image/jpg')
	// 				->orWhere('mime', 'image/gif')
	// 				->orWhere('extension', '=', 'png')
	// 				->get();
	// // dd( $files->first() );
	// foreach ($files as $file) {
	// 	echo $file->path;
	// }
})->name('optimize.images.cloud');



