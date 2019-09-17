<?php

namespace App\Http\Controllers\company;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Model\Company;
use App\Model\Users;
use App\Model\Service;
use App\Model\ServicePhoto;
use DB;
use Chumper\Zipper\Zipper;
use Illuminate\Support\Facades\Response;

class ProfileController extends Controller {

    public function __construct() {
        
    }
    
    public function viewprofile(Request $request) {
        
         $id=Auth::guard('company')->user()->id;
        $profiledetails=new Users;
        $data['profiledetails']=$profiledetails->getprofiledetails($id);
        $data['css'] = array(
        );        
        $data['js'] = array(
        );
        $data['funinit'] = array(
        );
        return view('company.pages.profile.viewprofile',$data);
    }
    
    public function updateprofile(Request $request){
       // echo Auth::guard('admin')->user()->id;exit;
          $id=Auth::guard('company')->user()->id;
         $data['id']=Auth::guard('company')->user()->id;
         if ($request->isMethod('post')) {
             
              $validator = validator::make($request->all(), [
                        'firstname' => 'required',
                        'lastname' => 'required',
                        'email' => 'required|email',
                        'phonenumber' => 'required|numeric',
                        'username' => 'required',
                       
            ]);
            if ($validator->fails()) {
                return redirect('updateprofile')
                                ->withErrors($validator)
                                ->withInput();
            }
            
            $updateprofiledetails=new Users;
            $updatedetails=$updateprofiledetails->updateprofiledetails($request->all());
            
            $data['updatedetails'] = $updatedetails;
            return redirect()->back()->with('message','Your profile successfully updated ');
         }
       
        $profiledetails=new Users;
        $data['profiledetails']=$profiledetails->getprofiledetails($id);
        $data['css'] = array(
        );        
        $data['js'] = array(
        );
        $data['funinit'] = array(
        );
        return view('company.pages.profile.updateprofile',$data);
    }
    
    public function changepassword(Request $request){
        
        
       $id=$data['id']=Auth::guard('company')->user()->id;
        if ($request->isMethod('post')) {
            
              $validator = validator::make($request->all(), [
                        'oldpassword' => 'required',
                        'newpassword' => 'required',
                        'confirmpassword' => 'required|same:newpassword',
                        
                       
            ]);
            if ($validator->fails()) {
                return redirect('updateprofile-company')
                                ->withErrors($validator)
                                ->withInput();
            }
            $oldpassword = $request['oldpassword'];
            $loginUserpassword=Auth::guard('company')->user()['password'];
            
            $newpassword = Hash::make($request['newpassword']);
            $request['newpassword']=$newpassword;
            
            if (!Hash::check($oldpassword,$loginUserpassword)) {
                return redirect()->back()->with('message','Old password Does Not Match !!.');
                
                
            }else{
                $updatepassword=new Users;
                $updatepass=$updatepassword->updatepassword($request->all());
            }
            
            
            
            
            
            
            $data['updatepass'] = $updatepass;
            return redirect()->back()->with('message','Your password successfully updated ');
         }
        $data['css'] = array(
        );
        
        $data['js'] = array(
        );
        $data['funinit'] = array(
        );
        return view('company.pages.profile.changepassword',$data);
    }
    
    public function changeprofilepicture(Request $request){
        
        $id=$data['id']=Auth::guard('company')->user()->id;
        $profiledetails=new Users;
        if ($request->isMethod('post')) 
        {
            
             $validator = validator::make($request->all(), [
                        'profileimage' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect('changeprofilepicture-company')
                                ->withErrors($validator)
                                ->withInput();
            }
            
           $data['changeprofieimage']=$profiledetails->changeprofieimage($request);
           if($data['changeprofieimage']== TRUE){
               return redirect()->intended('company-dashboard');
           }
        }
        
        $data['profiledetails']=$profiledetails->getprofiledetails($id);
        $data['css'] = array(
        );        
        $data['js'] = array(
        );
        $data['funinit'] = array(
        );
        return view('company.pages.profile.changeprofilepicture',$data);
    }
   
   
}
