<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Model\Sendmail;
use Illuminate\Support\Facades\Auth;
class Users extends Model{
    
    public $timestamps = false;
    
    protected $table = 'users';

    public function newuser($request){
    
            $firstname = $request['firstname'];
            $lastname = $request['lastname'];
            $email = $request['email'];
            $username = $request['username'];
            $password = $request['password'];
            $mobile = $request['mobile'];
            $role_type = $request['role_type'];
            
            $count_username=Users::where('username','=',$request['username'])                   
               ->get()->count();
            if($count_username==0){
                $count_email=Users::where('email','=',$request['email'])               
                     ->get()->count();
                
                 if($count_email==0){
                    $objsavedetails=new Users();
                    $objsavedetails->firstname = $firstname;
                    $objsavedetails->lastname = $lastname;
                    $objsavedetails->email = $email;
                    $objsavedetails->username = $username;
                    $objsavedetails->password = $password;
                    $objsavedetails->mobile = $mobile;
                    $objsavedetails->role_type = $role_type;
                    if ($objsavedetails->save()) {
                        return '0';
                    }else{
                        return '3';
                    }
                    
                 }else{
                     return '2';
                 }  
             }else{
                 return '1';
             }
       
    }

    public function getUserList($perPage){
                  
        $result = Users::select('*')->orderBy('id','DESC')->paginate($perPage);
        return $result;
        
    }
    
    public function getupdate($id){
        
        $result = Users::select('*')->where('id',$id)->first();
        return $result;
        
    }
    
    public function updateData($request, $id){
        
       $count_username=Users::where('id','!=',$id)
               ->where('username','=',$request['username'])               
               ->get()->count();
       if($count_username==0){
          $count_email=Users::where('id','!=',$id)
               ->where('email','=',$request['email'])               
               ->get()->count();
           if($count_email==0){
            $update_res = Users::where('id',$id)->update([
                'firstname' => $request['firstname'],
                'lastname' => $request['lastname'],
                'email' => $request['email'],
                'username' => $request['username'],
                'mobile' => $request['mobile'],
                'role_type' => $request['role_type'],
            ]);
           return '0';
           }else{
               return '2';
           }  
       }else{
           return '1';
       }
        
                
       
    }
    
    public function getCompany(){
        $result = Users::where('role_type','company')->get();
        return $result;
    }
    
    public function getUser(){
        $result = Users::where('role_type','user')->get();
        return $result;
    }
    
   
    
    public function getDatatable($request) {
        $requestData = $_REQUEST;          
        $columns = array(           
            0 => 'users.id',
            1 => 'users.firstname',
            2 => 'users.lastname',
            3 => 'users.email',
            4 => 'users.username',
            5 => 'users.mobile',
            6 => 'users.role_type',
        );
        $query =Users::select('id','firstname','lastname','email','username','mobile','role_type')
                ->where('role_type','!=','admin');
                
        if (!empty($requestData['search']['value'])) {   // if there is a search parameter, $requestData['search']['value'] contains search parameter
            $searchVal = $requestData['search']['value'];
            $query->where(function($query) use ($columns, $searchVal, $requestData) {
                        $flag = 0;
                        foreach ($columns as $key => $value) {
                            $searchVal = $requestData['search']['value'];
                            if ($key == 3 && ($searchVal == 'Not Sent' || $searchVal == 'not sent')) {
                                $searchVal = 0;
                            } else if ($key == 3 && ($searchVal == 'sent' || $searchVal == 'Sent')) {
                                $searchVal = 1;
                            }

                            if ($requestData['columns'][$key]['searchable'] == 'true') {
                                if ($flag == 0) {
                                    $flag = $flag + 1;
                                    $query->where($value, 'like', '%' . $searchVal . '%');
                                } else {
//                                    $query->orWhere($value, 'like',"%$searchVal%");
                                    $query->orWhere($value, 'like', '%' . $searchVal . '%');
                                }
                            }
                        }
                    });
        }

        $temp = $query->orderBy($columns[$requestData['order'][0]['column']], $requestData['order'][0]['dir']);
        $totalData = count($temp->get());
        $totalFiltered = count($temp->get());
        $resultArr = $query->skip($requestData['start'])
                            ->take($requestData['length'])
                            ->select(
                                'users.id',
                                'users.firstname',
                                'users.lastname',
                                'users.email', 
                                'users.username',
                                'users.mobile', 
                                'users.role_type'                                                                           
                            )->get()->toArray();
                            
        $data = array();
         foreach ($resultArr as $row) {
            $actionHtml = '<a href="'. route("changeuserpassword",["id"=>$row["id"]]).'"><i class="fa fa-eye-slash" aria-hidden="true" title="Change Password"></i></a> <a href="'. route("edituser",["id"=>$row["id"]]).'"><i class="fa fa-pencil-square-o" title="Edit Details" aria-hidden="true"></i></a><a class="delete" data_value="'.$row["id"].'" ><i class="fa fa-trash-o" aria-hidden="true"></i></a> ';
            if($row['role_type']=='admin'){
                $roletypeHtml='<span class="label label-success">Admin</span>';
            }
            if($row['role_type']=='company'){
                $roletypeHtml='<span class="label label-info">Company</span>';
            }
            
            if($row['role_type']=='user'){
                $roletypeHtml='<span class="label label-danger">User</span>';
            }
            $nestedData = array();
            $nestedData[] = $row['id'];
            $nestedData[] = $row['firstname'];
            $nestedData[] = $row['lastname'];
            $nestedData[] = $row['email'];
            $nestedData[] = $row['username'];
            $nestedData[] = $row['mobile'];
            $nestedData[] = $roletypeHtml;   
            $nestedData[] = $actionHtml;   
            $data[] = $nestedData;
        }
        
          $json_data = array(
            "draw" => intval($requestData['draw']), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw. 
            "recordsTotal" => intval($totalData), // total number of records
            "recordsFiltered" => intval($totalFiltered), // total number of records after searching, if there is no searching then totalFiltered = totalData
            "data" => $data   // total data array
          );
        
        
        return $json_data;
    }
    
    public function getprofiledetails($id){
        $result=Users::select('id','firstname','lastname','email','username','mobile','profile_image')
                ->where('id',$id)
                ->get()->toArray();
        return $result;
        
    }
    
    public function updateprofiledetails($request){
        
        $update_res = Users::where('id',$request['id'])
                ->update([
                        'firstname' => $request['firstname'],
                        'lastname' => $request['lastname'],
                        'email' => $request['email'],
                        'username' => $request['username'],
                        'mobile' => $request['phonenumber'],
                    ]);
         return $update_res;
    }
    
    public function updatepassword($request){
       
        $update_res = Users::where('id',$request['id'])
                ->update([
                        'password' => $request['newpassword'],
                    ]);
         return $update_res;
    }
    
    public function changeprofieimage($request){
        $id=$request['id'];
        $result=Users::select('profile_image')
                ->where('id',$id)
                ->get()->toArray();
        $oldimage=$result[0]['profile_image'];
        
        
        $destinationPath = public_path() . '/uploads/userprofile/';
        $file1 = $request->file('profileimage');
        
        $file_name1 = '';
        
        if (!empty($file1)) {
            $time = time();
            $file_name1 = $time .'-'. $file1->getClientOriginalName();
            $file1->move($destinationPath, $file_name1);
            
            
            $update_res = Users::where('id',$request['id'])
                ->update([
                        'profile_image' => $file_name1                        
                    ]);
        }
        return TRUE;
        
        
     
        
    }
    
    public function forgotpaasword($request){
         $finduser=Users::where('username','=',$request) 
               ->orWhere('email', '=',$request)
               ->get()->count();
        if($finduser==0){
            return 0;
        }else{
             $result=Users::select('email')
                            ->where('username','=',$request) 
                            ->orWhere('email', '=',$request)
                            ->get()->toArray();
            
           $email=$result['0']['email'];
           $password=Str::random(8); 
           
           $mailData['subject'] = 'Reset new password';
           $mailData['template'] = 'emails.forgotpassword';
           $mailData['mailto'] = 'parthkhunt12@gmail.com';//$email;
           $mailData['data']['interUser'] = $password;
           $sendMail = new Sendmail;
           $send=$sendMail->sendSMTPMail($mailData);
           print_r($send);
           die();
           
        }
        
    }
    
    public function changepassword($hashnewpassword , $id){
        $update_res = Users::where('id',$id)
                ->update([
                        'password' => $hashnewpassword,
                    ]);
         return $update_res;
        
    }
        
    
}

