<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use \Validator;
use App\Model\Users;
use App\Model\Service;
use DB;

class APIController extends Controller {

    public function __construct() {
        
    }

   

    public function login(Request $request) {
        
        if ($request->isMethod('post')) {

            $validator = validator::make($request->all(), [
                        'username' => 'required|min:5',
                        'password' => 'required'
            ]);
            if ($validator->fails()) {
                $result['status'] = 'fail';
                $result['message'] = 'Username and password is required.';
                $result['data'] = json_decode("{}");
                echo json_encode($result);
                exit;
            }

            $username = $request['username'];
            $password = $request['password'];

            if (Auth::guard('users')->attempt(['username' => $username, 'password' => $password, 'role_type' => 'user'])) {
                $result['status'] = 'success';
                $result['message'] = 'Login Successfully.';
                $result['data'] = Auth()->guard('users')->user();
                echo json_encode($result);
                exit;
            } else {
                $result['status'] = 'fail';
                $result['message'] = 'Login not Successfully.';
                $result['data'] = json_decode("{}");
                echo json_encode($result);
                exit;
            }
        }

       
    }

    public function getUserService(Request $request) {
        
        $validator = validator::make($request->all(), [
                        'userid' => 'required',
            ]);
            if ($validator->fails()) {
                $result['status'] = 'fail';
                $result['message'] = 'Userid is required.';
                $result['data'] = json_decode("{}");
                echo json_encode($result);
                exit;
            }
        $userId = $request['userid'];   
        $serviceObj = new Service;
        $insertService = $serviceObj->getUserService($userId);
       
        if(!empty($insertService)){
            $result['status'] = 'success';
            $result['message'] = 'Data found successfully.';
            $result['data'] = $insertService;
        }else{
            $result['status'] = 'success';
            $result['message'] = 'Data not found.';
            $result['data'] = array();
        }
        
        echo json_encode($result);
        exit;
    }
    
    public function postServicePhoto(Request $request){
        if ($request->isMethod('post')) {
              $serviceObj = new Service;
              $usersaved = $serviceObj->uploadServicePic($request);
              if($usersaved)
                {
                    $return['status'] = 'success';
                    $return['message'] = 'Service photo successfully.';
                   // $return['redirect'] = 'login';
                    echo json_encode($return);
                    exit;
                }
          }
    }

    public function saveService(Request $request){
       
        if ($request->isMethod('post')) {
            
              $serviceObj = new Service;
              $usersaved = $serviceObj->saveService($request);
                if($usersaved)
                {
                    $return['status'] = 'success';
                    $return['message'] = 'Service successfully.';
                    echo json_encode($return);
                    exit;
                }
          }
    }
    
    public function inreportService(Request $request){
        if ($request->isMethod('post')) {
              $serviceObj = new Service;
              $usersaved = $serviceObj->inreportService($request);
              if($usersaved)
                {
                    $return['status'] = 'success';
                    $return['message'] = 'Service update successfully.';
                   // $return['redirect'] = 'login';
                    echo json_encode($return);
                    exit;
                }
          }
    }
    

}
