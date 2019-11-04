<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use \Validator;
use App\Model\Users;
use App\Model\Service;
use DB;

class LoginController extends Controller {

    public function __construct() {
        
    }
    
    public function phpinfo(){
        print_r(phpinfo());
    }

    public function register(Request $request) {

        if ($request->isMethod('post')) {

            $validator = validator::make($request->all(), [
                        'firstname' => 'required',
                        'lastname' => 'required',
                        'email' => 'required|email',
                        'username' => 'required|min:5',
                        'password' => 'required',
                        'mobile' => 'required|min:10',
            ]);
            if ($validator->fails()) {
                return redirect('register')
                                ->withErrors($validator)
                                ->withInput();
            }

            $firstname = $request['firstname'];
            $lastname = $request['lastname'];
            $email = $request['email'];
            $username = $request['username'];
            $password = Hash::make($request['password']);
            $mobile = $request['mobile'];

            DB::table('users')->Insert([
                'firstname' => $firstname,
                'lastname' => $lastname,
                'email' => $email,
                'username' => $username,
                'password' => $password,
                'mobile' => $mobile,
                'role_type' => 'user',
            ]);
            return redirect('login');
        }

        return view('admin.pages.register');
    }

    public function login(Request $request) {

        if ($request->isMethod('post')) {

            $validator = validator::make($request->all(), [
                        'username' => 'required|min:5',
                        'password' => 'required'
            ]);
            if ($validator->fails()) {
                return redirect('login')
                                ->withErrors($validator)
                                ->withInput();
            }

            $username = $request['username'];
            $password = $request['password'];

            if (Auth::guard('admin')->attempt(['username' => $username, 'password' => $password, 'role_type' => 'admin'])) {
                return redirect()->intended('dashboard');
            }
            else if(Auth::guard('company')->attempt(['username'=>$username,'password'=>$password,'role_type'=>'company'])){
                return redirect()->intended('company-dashboard');
            }
            else if (Auth::guard('users')->attempt(['username' => $username, 'password' => $password, 'role_type' => 'user'])) {
                return redirect()->intended('/');
            } else {
                return redirect()->back()->with('message', 'Unauthorized user');
            }
        }

        return view('admin.pages.login');
    }

    public function dashboard() {
        return view('admin.pages.dashboard');
    }
    
    
    
    public function companydashboard(){
        return view('company.pages.company-dashboard');
    }

    public function userlist() {
        $perPage = 15;
        $userlist = new Users;
        $getUserlistdata = $userlist->getUserList($perPage);
        $data['getUserlistdata'] = $getUserlistdata;
        $data['css'] = array(
            'plugins/dataTables/datatables.min.css',
            'plugins/sweetalert/sweetalert.css'
            );
        
         $data['js'] = array(
            'plugins/dataTables/datatables.min.js',
            'plugins/sweetalert/sweetalert.min.js',
            'users/user.js'
         );
        $data['funinit'] = array(
            'User.init()',
        );
        return view('admin.pages.userlist', $data);
    }

    public function delete(Request $request) {

        $id = $request['id'];

        DB::table('users')->where('id', $id)->delete();
        return redirect()->back()->with('message', 'User Deleted successfully');
    }

    public function edituser(Request $request, $id) {

        if ($request->isMethod('post')) {

            $validator = validator::make($request->all(), [
                        'firstname' => 'required',
                        'lastname' => 'required',
                        'email' => 'required|email',
                        'username' => 'required|min:5',
                        'mobile' => 'required|min:10',
                        
            ]);
            if ($validator->fails()) {
                return redirect('edituser/' . $id)
                                ->withErrors($validator)
                                ->withInput();
            }
            
            

            $id = $request['id'];
            $firstname = $request['firstname'];
            $lastname = $request['lastname'];
            $email = $request['email'];
            $username = $request['username'];
            $mobile = $request['mobile'];
            $role_type = $request['role_type'];

            $updateInputs = new Users;
            $getUpadateData = $updateInputs->updateData($request, $id);
            
            if($getUpadateData==0){
                return redirect()->back()->with('message', 'Data Updated successfully');
            }
            if($getUpadateData==1){
                return redirect()->back()->with('message', 'User Name alreay exist');
            }
            if($getUpadateData==2){
                return redirect()->back()->with('message', 'Emial alreay exist');
            }
        }
        $updateUsers = new Users;
        $getupdateData = $updateUsers->getupdate($id);
        $data['getupdateData'] = $getupdateData;
        return view('admin.pages.edituser', $data);
    }
    
    public function changepassword(Request $request, $id) {
        
        if ($request->isMethod('post')) {
            
            $validator = validator::make($request->all(), [
                'newpassword' => 'required',
                'confirmpassword' => 'required|same:newpassword',
            ]);
            if ($validator->fails()) {
                return redirect('changeuserpassword/' . $id)
                                ->withErrors($validator)
                                ->withInput();
            }
            
            
            $id = $request['id'];
            $newpassword = $request['newpassword'];
            $confirmpassword = $request['confirmpassword'];
             $hashnewpassword = Hash::make($newpassword);      

            $updateInputs = new Users;
            $getUpadateData = $updateInputs->changepassword($hashnewpassword, $id);
            
            
            if($getUpadateData){
                return redirect()->back()->with('message', 'User Name alreay exist');
            }else{
                return redirect()->back()->with('message', 'Something Goes to wrong');
            }
        }
        $data['id'] = $id ;
        $updateUsers = new Users;
        $getupdateData = $updateUsers->getupdate($id);
        $data['getupdateData'] = $getupdateData;
        return view('admin.pages.changeuserpassword', $data);
    }

    public function userform(Request $request) {

        if ($request->isMethod('post')) {

            $validator = validator::make($request->all(), [
                        'firstname' => 'required',
                        'lastname' => 'required',
                        'email' => 'required|email',
                        'username' => 'required|min:5',
                        'password' => 'required',
                        'mobile' => 'required|min:10',
                        'role_type'=>'required',
            ]);
            if ($validator->fails()) {
                return redirect('userform')
                                ->withErrors($validator)
                                ->withInput();
            }
            $password = Hash::make($request['password']);
            $request['password']=$password;
            
            $newuser = new Users;
            $getUpadateData = $newuser->newuser($request);
            if($getUpadateData==0){
                return redirect()->back()->with('message', 'User Inserted Successfully');
            }
            if($getUpadateData==1){
                return redirect()->back()->with('message', 'User Name alreay exist');
            }
            if($getUpadateData==2){
                return redirect()->back()->with('message', 'Emial alreay exist');
            }
            
            
            
        }

        return view('admin.pages.userform');
    }
    
    public function forgotpassword(Request $request){
         if ($request->isMethod('post')) {
            $username = $request['username'];
             
            $validator = validator::make($request->all(), [
                        'username' => 'required',
                        
            ]); 
             if ($validator->fails()) {
                return redirect('forgotpassword')
                                ->withErrors($validator)
                                ->withInput();
            }else{
                $objsendpassword = new Users;
                $sendpassword=$objsendpassword->forgotpaasword($username);
            }
            
            
         }
         $data['css'] = array(
            );
        
         $data['js'] = array(
             'comman_function.js',
         );
        $data['funinit'] = array(  
        );
        return view('admin.pages.forgotpassword',$data);
    }
    
    public function createpassword(){
       echo $password = Hash::make('admin123');
    }
}
