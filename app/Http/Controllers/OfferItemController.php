<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Redirect;
use Auth;
use App\Http\Requests;
use App\Category;
use App\Language;
use Validator;
use App\Providers\ValidatorProvider;
use Illuminate\Support\Facades\Input;
use App\SellRequest;
use App\SellRequestsImage;
use App\SpecialOrder;
use App\SpecialOrderImage;

class OfferItemController extends Controller
{
    public function index($id,Request $request) //offer item
    {
        if($id==0 || $id==1)  //0 offer item ,1 special order
            {
                if(Auth::check()&&Auth::user()->role==1)
                {

                    $artschools = OfferItemController::showArtSchools();
                    $colors = OfferItemController::showColorTypes();
                    return view('OfferItem',['artschools'=>$artschools,'colors'=>$colors,'id'=>$id]);
                }
                else
                    {return Redirect::to('login')->with('message', 'Login/Register to use this feature.');}
            }
        else
            abort(404);

        
    }


    public function ThankYou(Request $request)
    {
    	return view('ThankYou');
    }

    protected function showArtSchools()
    {
        return Category::orderBy('name')->get();        
    }

    protected function showColorTypes()
    {
        return Language::orderBy('name')->get();
    }

    public function NewValidate ( Request $request) 
    {
    	
    
		$messages  = [
          'valid_captcha' => 'Wrong code. Try again please.',
          'MatchingUserPassword' => 'Wrong password. Try again please.',
          ];

        $rules = [
            'Item_Name' => 'required|unique:sell_requests,name|max:20|regex:/^[a-zA-Z0-9\s_]+$/',
            'Height' => 'required|numeric|digits_between:1,8',
            'Length' => 'required|numeric|digits_between:1,8',
            'Width' => 'required|numeric|digits_between:1,8',
            'Price' => 'required|numeric|digits_between:1,6',
            'ArtSchools' =>'required',
            'Colors' => 'required',
           //'File' => 'required',
         //   'File.*' => 'mimes:jpeg,jpg,bmp,png',
            'Password' =>'required|MatchingUserPassword',
            'CaptchaCode'=>'required|valid_captcha'
             ];

      /*      $nbr = count($request->file('File')) - 1;
            foreach(range(0, $nbr) as $index) {
                $rules['File.' . $index] = 'required|image|max:4000';
            }*/


		$validator= Validator::make($request->all(),$rules,$messages); 

		return $validator;
    	
    	
    }

    protected function Store0(array $data) //offer item
    {
        $array =null;
        $ReturnCode = $this->multiple_upload($array);
        if($ReturnCode != 1)
            return $ReturnCode;

    	$sell_request=SellRequest::create([
    		'name' => $data['Item_Name'],
    		'width' => $data['Width'],
    		'length' => $data['Length'],
    		'height' => $data['Height'],
    		'price' => $data['Price'],
    		'colortype_id' => $data['Colors'],
    		'artschool_id' => $data['ArtSchools'],
    		'seller_id' => Auth::user()->id
    		]);

        //for each img // to be modified

    	$sell_request->save();

        $request_id = $sell_request->id;

        foreach($array as $x)
        {
            $sell_request_image=SellRequestsImage::create([
            'link' => '/imgitems/'.$x,
            'request_id'=>$request_id
            ]);
        $sell_request_image->save();
        }

    	return 1;
    }


    protected function Store1(array $data) //special order
    {
        $array = null;
        $ReturnCode = $this->multiple_upload($array);
        if($ReturnCode != 1)
            return $ReturnCode;

        $special_order=SpecialOrder::create([
            'name' => $data['Item_Name'],
            'width' => $data['Width'],
            'length' => $data['Length'],
            'height' => $data['Height'],
            'price' => $data['Price'],
            'colortype_id' => $data['Colors'],
            'artschool_id' => $data['ArtSchools'],
            'requester_id' => Auth::user()->id
            ]);

        /*//for each img // to be modified
        $sell_request_img=SpecialOrderImage::create([
            'link'=>"/imgitems/1.jpg",
            'request_id'=>$sell_request->id,
            ]);*/
        $special_order->save();
        $request_id = $special_order->id;

        foreach($array as $x)
        {
            $sell_request_image=SpecialOrderImage::create([
            'link' => '/imgitems/'.$x,
            'order_id'=>$request_id
            ]);
        $sell_request_image->save();
        }    
        return 1;
    }

    public function Submit($id,Request $request) //offer item 0 , special order 1
    {
        $error0 = 'Could not upload your images.';
        $error1 = 'Maximum number of images allowed is 5';
        $error2 = 'Maximum image size is 4 MB';
        $error3 = 'Unsupported File Extension.';
        if($id!=0 && $id!=1)
        {
            abort(404);
        }
    	$data=$request->all();
        // to be modified
        /*if( $request->hasFile('File') ) {
            $file = $request->file('File');
            $file->move("/imgitems","{$sell_request->id}");
        }*/
        $FinishCode = 0;
    	if(Auth::check())
    	{
    		$validator=$this->NewValidate($request);
    	 	if ($validator->fails()) 
            	{return redirect()->back()->withErrors($validator)->withInput();}
        	else
        		{ 
                    if($id==0)
        			    $FinishCode = $this->Store0($data);
                    else
                    {
                        $FinishCode = $this->Store1($data);
                    }

                    if($FinishCode == 0)
                        return redirect()->back()->withErrors(["File1"=>$error0])->withInput();
                    else if($FinishCode == 1)
        			    return view('ThankYou');
                    else if($FinishCode == 2)
                        return redirect()->back()->withErrors(["File2"=>$error1])->withInput();
                    else if($FinishCode == 3)
                        return redirect()->back()->withErrors(["File3"=>$error2])->withInput();
                    else if($FinishCode == 4)
                        return redirect()->back()->withErrors(["File4"=>$error3])->withInput();
        		}
    	}
    	else
    		{return Redirect::to('login')->with('message', 'Login/Register to use this feature.');}
    }

    public function multiple_upload(&$array) {
    // getting all of the post data
    $files = Input::file('images');
    // Making counting of uploaded images
    $file_count = count($files);
    // start count how many uploaded
    if($file_count>5)
        return 2;
    $uploadcount = 0;
    foreach($files as $file) {
      $rules = array('file' => 'required|mimes:png,gif,jpeg,jpg,bmp');
      $validator = Validator::make(array('file'=> $file), $rules);
      if($validator->passes()){
        $destinationPath = 'imgitems/';
        $filename = $file->getClientOriginalName();
        $filesize = $file->getClientSize();
        $fileextension = pathinfo($filename, PATHINFO_EXTENSION);
        if($filesize>4000000)       //File Size is Max 4 MB
            return 3;
        $InsertedFileName = md5($filename. microtime());
        $array[$uploadcount]=$InsertedFileName.'.'.$fileextension;
        $upload_success = $file->move($destinationPath, $InsertedFileName.'.'.$fileextension);
        $uploadcount++;
      }
      else return 4;
    }
       if($uploadcount!=$file_count)
         return 0;
     return 1;
     // else return view('ThankYou');
  }




}
