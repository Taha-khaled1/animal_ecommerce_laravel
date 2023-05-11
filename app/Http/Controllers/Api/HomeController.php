<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\RegisterMail;
use App\Models\Admin\Brand;
use App\Models\Admin\Category;
use App\Models\Admin\Product;

use App\Models\User;
use Faker\Extension\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function products()
    {
        $products = Product::where('status', 1)->orderBy('id', 'DESC')->get();
        return responseFunction('products', $products, '200');
    }

    public function categories()
    {
        $categories = Category::where('status', 1)->orderBy('id', 'DESC')->get();
        return responseFunction('categories', $categories, '200');

    }

    public function brands()
    {
        $brands = Brand::where('status', '1')->orderBy('id', 'DESC')->get();
        return responseFunction('brands', $brands, '200');
    }

    public function viewProduct($id)
    {
        $product = Product::with(['category', 'brand', 'colors', 'sizes', 'product_tags', 'product_reviews'])->where('status', 1)->find($id);
        return responseFunction('product', $product, '200');

    }

    public function viewBrandProducts($brandID)
    {
        $products = Product::where('status', 1)->where('Brand_Id', $brandID)->orderBy('id', 'DESC')->get();
        return responseFunction('products', $products, '200');
    }

    public function viewCategoryProducts($categoryID)
    {
        $products = Product::where('status', 1)->where('Category_Id', $categoryID)->orderBy('id', 'DESC')->get();
        return responseFunction('products', $products, '200');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'string|required',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users',
                'regex:/^\w+[-\.\w]*@(?!(?:outlook|myemail|yahoo)\.com$)\w+[-\.\w]*?\.\w{2,4}$/'
            ],
            'password' => [
                'required',
                'min:6'
            ],
        ]);
        if ($validator->fails())
            return $validator->errors()->toJson();
        $data = $request->all();
        $data['password'] = Hash::make($request->password);
//        $random = random_int(10000, 99999);
//        $data['code'] = $random;
        $token = Str::random(80);
//        $data['remember_token'] = hash('sha256', $token);
        $data['api_token'] = hash('sha256', $token);
        User::create($data);
        //in case verification
//        Mail::to($request->email)->send(new RegisterMail($user));
//        $message = [
//            'message', 'registered successfully, check your email to verify it!',
//            'code' => $random
//        ];
        return responseFunction('api_token', $token, '200');



    }
//    public function verifyRegister(Request $request)
//    {
//        $validator = Validator::make($request->all(), [
//            'code' => 'required',
//            'email' => 'required'
//        ]);
//        if ($validator->fails())
//            return $validator->errors()->toJson();
//        $user = User::where('email', $request->email)->first();
//        if (!$user)
//            return responseFunction('error', 'user not found', '404');
//        if ($user->code != $request->code)
//            return responseFunction('error', 'incorrect code', '401');
//
//
//    }
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'min:6'],
        ]);
        if ($validator->fails())
            return $validator->errors()->toJson();
        $user = User::where('is_admin', '0')->where('email', $request->email)->first();
        if (!$user)
            return responseFunction('error', 'User not found!', '404');
        if (!Hash::check($request->password, $user->password))
            return responseFunction('error', 'Password mismatch!', '422');
        $token = Str::random(80);
        $user->update([
            'api_token' => hash('sha256', $token)
        ]);
        return responseFunction('api_token', $token, '200');
    }
}
