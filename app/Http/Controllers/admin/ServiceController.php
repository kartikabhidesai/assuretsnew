<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;
use App\Model\Users;
use App\Model\Service;
use App\Model\ServicePhoto;
use DB;
use Chumper\Zipper\Zipper;
use Illuminate\Support\Facades\Response;

class ServiceController extends Controller {

    public function addservice(Request $request) {
    $id=Auth::guard('admin')->user()->id;
    
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
                return redirect('addservice')
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

        return view('admin.pages.addservice', $data);
    }

    public function services() {

        $perPage = 15;
        $services = new service;
        $getUserServices = $services->getServices($perPage);
        $data['getUserServices'] = $getUserServices;
        $data['css'] = array(
        
            'plugins/dataTables/datatables.min.css',
            'plugins/sweetalert/sweetalert.css',
        );
        
        $data['js'] = array(
            'plugins/dataTables/datatables.min.js',            
            'plugins/sweetalert/sweetalert.min.js',
            'services/services.js'
            
        );
        $data['funinit'] = array(
            'Services.init()',
        );
        return view('admin.pages.services', $data);
    }

    public function deleteservice(Request $request, $id) {

        $serviceObj = new service;

        $deleteService = $serviceObj->deleteService($id);

        $data['deleteService'] = $deleteService;

        return redirect()->back()->with('message', 'Service Deleted Successfully');
    }
    
    public function completeservices(Request $request, $id) {
       $serviceObj = new service;

        $deleteService = $serviceObj->completeservices($id);

        $data['deleteService'] = $deleteService;

        return redirect()->back()->with('message', 'Service completed ');
    }

    public function editservice(Request $request, $id) {

        if ($request->isMethod('post')) {

            $validator = validator::make($request->all(), [
                        'vehicle_no' => 'required',
                        'address' => 'required'
            ]);

            if ($validator->fails()) {
                return redirect('editservice'.'/'.$id)->withErrors($validator)->withInput();
            }

            $serviceObj = new Service;

            $editService = $serviceObj->editService($request, $id);

            $data['editService'] = $editService;
            
//            print_r($editService);exit;
            
            return redirect('services');
        }
        $userid = new Users;
        $serviceData = new Service;
        $getServiceData = $serviceData->getServiceData($id);
        $data['getServiceData'] = $getServiceData['0'];
      
        $getUserId = $userid->getUser();
        $data['getUserId'] = $getUserId;
        $getUserId = $userid->getCompany();
        $data['getCompany'] = $getUserId;
        return view('admin.pages.editservice', $data);
    }
    
    public function detailservice(Request $request, $id) {

        $serviceData = new Service;
        $getServiceData = $serviceData->getServiceData($id);
        $data['getServiceData'] = $getServiceData[0];
        $data['id']=$id;
        
        $objServicePhotoData = new ServicePhoto;
        $arrServicePhotoData = $objServicePhotoData->getServicePhotoData($id);
        $data['getServicePhotoDatas'] = $arrServicePhotoData;
        $data['css'] = array(
            'plugins/blueimp/css/blueimp-gallery.min.css',  
            'plugins/sweetalert/sweetalert.css',
        );
         $data['js'] = array(                 
            'inspinia.js',
            'plugins/pace/pace.min.js',
            'plugins/blueimp/jquery.blueimp-gallery.min.js',
             'plugins/sweetalert/sweetalert.min.js',
            'servicesdetails.js'
        );
        $data['funinit'] = array(
            'Servicesdetails.init()',
        );
        
        return view('admin.pages.detailservice', $data);
    }
    
    public function downloadzip(Request $request,$serviceId){
        
        $objServicePhotoData = new ServicePhoto;
        $serviceData = new Service;
        $arrServicePhotoData = [];
        $arrServicePhotoData = $objServicePhotoData->getServicePhotoData($serviceId);
        
        
        $vehicle_no = $serviceData->getVihicleNo($serviceId);
        $servicearry=[];
        $vehicleNo=$vehicle_no[0]->vehicle_no;
        
        for($i=0;$i<count($arrServicePhotoData);$i++){
            array_push($servicearry, 'public/servicephoto/'.$arrServicePhotoData[$i]['name']);
        }
        if(count($arrServicePhotoData)!='0'){
        $zipper = new Zipper();
        $files = $servicearry;
        
        if (file_exists('public/servicephoto/'.$vehicleNo.'.zip')) {
             unlink('public/servicephoto/'.$vehicleNo.'.zip'); 
        }
        
        $zipper->make('public/servicephoto/'.$vehicleNo.'.zip')->add($files)->close();
        return Response::download('public/servicephoto/'.$vehicleNo.'.zip');        
        }else{
            
            return redirect('detailservice/'.$serviceId);
        }
    }
    public function ajaxAction(Request $request){
         $action = $request->input('action');
         
            switch ($action)
            {
                case 'datatableServices':
                    $serviceObj = new Service;
                    $serviceLists = $serviceObj->getDatatable($request);
                    echo json_encode($serviceLists);
                    break;
                
                case 'datatableHistory':
                    $serviceObj = new Service;
                    $serviceLists = $serviceObj->getHistoryDatatable($request);
                    echo json_encode($serviceLists);
                    break;
                  
                case 'datatableUser':                      
                    $usersObj = new Users;
                    $serviceLists = $usersObj->getDatatable($request);
                    echo json_encode($serviceLists);
                    break;
                
                case 'datatableCompanyServices':                      
                    $serviceObj = new Service;
                    $serviceLists = $serviceObj->getDataCompanyServicestable($request);
                    echo json_encode($serviceLists);
                    break;
                
                 case 'datatableCompanyHistoryServices':                      
                    $serviceObj = new Service;
                    $serviceLists = $serviceObj->getDataCompanyHistoryServicestable($request);
                    echo json_encode($serviceLists);
                    break;
                
                case 'datatableMyCompanyServices':
                    $serviceObj = new Service;
                    $serviceLists = $serviceObj->getDataMyCompanyServicestable($request);
                    echo json_encode($serviceLists);
                    break;
            }
    }
    
    public function deleteimages(Request $request){
      $servicephotoObj = new ServicePhoto;  
      $serviceLists = $servicephotoObj->deleteimages($request);
      if($serviceLists == TRUE){
           return redirect()->back()->with('message','Images Successfully deleted');
      }else{
           return redirect()->back()->with('message','Images not deleted');
      }
    }
    
    public function addimages(Request $request){
         $servicephotoaddObj = new ServicePhoto;  
         $servicesaddphoto = $servicephotoaddObj->addimages($request);
         if($servicesaddphoto == TRUE){
           return redirect()->back()->with('message','Images Successfully Added');
      }else{
           return redirect()->back()->with('message','Images not Added');
      }
    }
}
