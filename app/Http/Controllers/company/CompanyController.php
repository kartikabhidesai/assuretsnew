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

class CompanyController extends Controller {
        
//    $data['detail'] =  $data['id']=Auth::guard('company')->user();
//         print_r($data['detail']);
//         die();
    
    public function companylist() {
         
        $perPage = 15;

        $CompanyList = new Company;

        $getCompanyList = $CompanyList->getCompanyList($perPage);

        $data['getCompanyList'] = $getCompanyList;
        
          $data['css'] = array(
        
            'plugins/dataTables/datatables.min.css',
            'plugins/sweetalert/sweetalert.css',
        );
        
        $data['js'] = array(
            'plugins/dataTables/datatables.min.js',            
            'plugins/sweetalert/sweetalert.min.js',
            'company/services/companyservices.js'
            
        );
        $data['funinit'] = array(
            'Comapanyservices.init()',
        );

        return view('company.pages.company-list', $data);
    }
    
    public function companyserivces(){
        
        $logindata =  $data['id']=Auth::guard('company')->user()->id;
        $perPage = 15;
        $CompanyList = new Company;
        $getCompanyList = $CompanyList->getMyCompanyList($perPage,$logindata);
        $data['getCompanyList'] = $getCompanyList;
        
        $data['css'] = array(
            'plugins/dataTables/datatables.min.css',
            'plugins/sweetalert/sweetalert.css',
        );
        
        $data['js'] = array(
            'plugins/dataTables/datatables.min.js',            
            'plugins/sweetalert/sweetalert.min.js',
            'company/services/myservices.js'
            
        );
        $data['funinit'] = array(
            'Myservices.init()',
        );

        return view('company.pages.company-services-list', $data);
    }
    
    public function customermydetailservice(Request $request, $id){
       $serviceData = new Service;
        $getServiceData = $serviceData->getServiceData($id);
        $data['getServiceData'] = $getServiceData['0'];
        
        $objServicePhotoData = new ServicePhoto;
        $arrServicePhotoData = $objServicePhotoData->getServicePhotoData($id);
        $data['getServicePhotoDatas'] = $arrServicePhotoData;
        $data['css'] = array(
            'plugins/blueimp/css/blueimp-gallery.min.css',            
        );
         $data['js'] = array(                 
            'inspinia.js',
            'plugins/pace/pace.min.js',
            'plugins/blueimp/jquery.blueimp-gallery.min.js'
        );
        
        return view('company.pages.detailservice', $data);
    }
    
    public function customerdetailservice(Request $request, $id){
       $serviceData = new Service;
        $getServiceData = $serviceData->getServiceData($id);
        $data['getServiceData'] = $getServiceData['0'];
       
        $objServicePhotoData = new ServicePhoto;
        $arrServicePhotoData = $objServicePhotoData->getServicePhotoData($id);
        $data['getServicePhotoDatas'] = $arrServicePhotoData;
        $data['css'] = array(
            'plugins/blueimp/css/blueimp-gallery.min.css',            
        );
         $data['js'] = array(                 
            'inspinia.js',
            'plugins/pace/pace.min.js',
            'plugins/blueimp/jquery.blueimp-gallery.min.js'
        );
        
        return view('company.pages.detailservice', $data);
    }
    
    public function addservicecompany(Request $request){
        
        $id=Auth::guard('company')->user()->id;
        if ($request->isMethod('post')) {
            $validator = validator::make($request->all(), [
                        'vehicle_no' => 'required',
                        'owner_name' => 'required',
                        'owner_mobile' => 'required|numeric|min:10',
                        'location' => 'required',
                        'insurer' => 'required',
                        'address' => 'required',
                        'user_id' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect('addservice-company')
                                ->withErrors($validator)
                                ->withInput();
            }

            $serviceObj = new Service;

            $insertService = $serviceObj->insertService($request,$id);

            $data['insertService'] = $insertService;

            return redirect()->back()->with('message','Service inserted');
        }

        $userid = new Users;

        $getCompany = $userid->getCompany();

        $data['getCompany'] = $getCompany;
        
        $getUserId = $userid->getUser();

        $data['getUserId'] = $getUserId;

        return view('company.pages.addservice-company', $data);
    }
    
    public function customerhistory() {
         
        $perPage = 15;

        $CompanyList = new Company;

        $getCompanyList = $CompanyList->getCompanyList($perPage);

        $data['getCompanyList'] = $getCompanyList;
        
          $data['css'] = array(
        
            'plugins/dataTables/datatables.min.css',
            'plugins/sweetalert/sweetalert.css',
        );
        
        $data['js'] = array(
            'plugins/dataTables/datatables.min.js',            
            'plugins/sweetalert/sweetalert.min.js',
            'company/services/customerhistory.js'
            
        );
        $data['funinit'] = array(
            'Customerhistory.init()',
        );

        return view('company.pages.company-list', $data);
    }
}
