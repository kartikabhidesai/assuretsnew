<?php

namespace App\Model;

use App\Model\ServicePhoto;
use Illuminate\Database\Eloquent\Model;
use DB;
use PHPImageWorkshop\ImageWorkshop;
ini_set('memory_limit', '2048M');
class Service extends Model {
    protected $table = 'services';

    public function insertService($request ,$id) {

        $serviceObj = new Service;

        $serviceObj->service_no = $request->input('service_no');
        $serviceObj->vehicle_no = $request->input('vehicle_no');
        $serviceObj->owner_name = $request->input('owner_name');
        $serviceObj->owner_mobile = $request->input('owner_mobile');
        $serviceObj->location = $request->input('location');
        $serviceObj->insurer = $request->input('insurer');
        $serviceObj->address = $request->input('address');
        $serviceObj->user_id = $request->input('user_id');
        $serviceObj->created_by = $id;
        

        $serviceObj->save();
    }

    public function saveService($request){
    
        $id = $request->input('service_id');
        $result = Service::where('id', $id)
        ->update([
            'engine_no' => $request['engine_no'],
            'chession_no' => $request['chession_no'],
            'status' => 'inreport',
        ]);
        if($result){
            $servicephoto =$request->file('servicephoto');
          
            for($i = 0; $i < count($request->file('servicephoto')) ; $i++){
                $destinationPath = public_path() . '/servicephoto/';
                $file1 = $servicephoto[$i];
                $extension = $request->file('servicephoto')[$i]->extension();
               

                $filetype=$_FILES['servicephoto']['type'][$i];
                 
                if(strstr($filetype, "video/")){
                    $filetype = "video";
                }else if(strstr($filetype, "image/")){
                $filetype = "image";}

                $width=getimagesize($file1)[0];
                $height=getimagesize($file1)[1];
                $file_name1 = '';
                $file_name2 = '';
                if (!empty($file1)) {
                    $time = time();
                    $file_name1 = $time.$i. '-' . $file1->getClientOriginalName();
                    $file1->move($destinationPath, $file_name1);
                    $publicPath = $destinationPath . $file_name1;
                    if($extension != 'mp4'){
                        $this->addtimestamp($publicPath,$file_name1,$width);
                    }
                }
                $serviceId = $request->input('service_id');
                $latitude = $request->input('latitude');
                $longitude = $request->input('longitude');
                $objUser = new ServicePhoto;
                $objUser->service_id = $serviceId;
                $objUser->latitude  = $latitude;
                $objUser->longitude = $longitude;
                $objUser->name = $file_name1;
                $objUser->save();
            }
        }
        return $request;
    }

    public function inreportService($request) {

        $id = $request->input('service_id');

        $result = Service::where('id', $id)->update([
            'status' => 'inreport',
        ]);
        return $request;
    }

    public function getServices($perPage) {

        $result = Service::join('users', 'users.id', '=', 'services.user_id')
                    ->select('services.*', 'users.firstname', 'users.lastname','users.role_type')
                    ->orderBy('id', 'DESC')
                    ->paginate($perPage);
        return $result;
    }

    public function deleteService($id) {

        return Service::where('id', $id)->delete();
    }
    
    public function completeservices($id) {

         return Service::where('id', $id)->update([
             'status'=>'compelete']);
    }

    public function editService($request, $id) {

        $result = Service::where('id', $id)->update([
            'vehicle_no' => $request['vehicle_no'],
            'owner_name' => $request['owner_name'],
            'owner_mobile' => $request['owner_mobile'],
            'location' => $request['location'],
            'insurer' => $request['insurer'],
            'address' => $request['address'],
            'user_id' => $request['executive']
        ]);
        return $request;
    }

    public function getServiceData($id) {
        
       return Service::select('services.*','u2.firstname','u2.lastname','u1.firstname as executivefirstname','u1.lastname as executivelastname')
                        ->leftjoin('users as u1', 'services.user_id', '=', 'u1.id')
                        ->leftjoin('users as u2', 'services.insurer', '=', 'u2.id')
                        ->where('services.id',$id)
                        ->get()->toArray();
       
    }
    
    public function getServiceData1($id) {
        
       return Service::select('services.*','u1.firstname','u1.lastname','u2.firstname as executivefirstname','u2.lastname as executivelastname')
                        ->leftjoin('users as u1', 'services.user_id', '=', 'u1.id')
                        ->leftjoin('users as u2', 'services.insurer', '=', 'u2.id')
                        ->where('services.id',$id)
                        ->get()->toArray();
       
    }
    
    public function getVihicleNo($id) {
        return Service::select('vehicle_no')
                ->where('id', $id)->get();
    }
    
    public function getUserService($id) {
        return Service::where('user_id', $id)
                        ->where('status', 'inprocess')
                        ->get()
                        ->toArray();
    }

    public function uploadServicePic($request) {
        $destinationPath = public_path() . '/servicephoto/';

        $file1 = $request->file('servicephoto');
        $extension = $request->file('servicephoto')->extension();
        
        
        $filetype=$_FILES['servicephoto']['type'];
        
        if(strstr($filetype, "video/")){
            $filetype = "video";
        }else if(strstr($filetype, "image/")){
        $filetype = "image";}
        
        $width=getimagesize($file1)[0];
        $height=getimagesize($file1)[1];
        $file_name1 = '';
        $file_name2 = '';
        if (!empty($file1)) {
            $time = time();
            $file_name1 = $time . '-' . $file1->getClientOriginalName();
            $file1->move($destinationPath, $file_name1);
            $publicPath = $destinationPath . $file_name1;
            if($extension != 'mp4'){
                $this->addtimestamp($publicPath,$file_name1,$width);
            }
        }
        $serviceId = $request->input('service_id');
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $objUser = new ServicePhoto;
        $objUser->service_id = $serviceId;
        $objUser->latitude  = $latitude;
        $objUser->longitude = $longitude;
        $objUser->name = $file_name1;
        $objUser->save();
        return TRUE;
    }

    public function addtimestamp($publicPath,$file_name1,$width){
        $gifPath = $publicPath; // Your animated GIF path
        
        $norwayLayer = ImageWorkshop::initFromPath($gifPath);
        $fontsize = 100;
        $fontsize =0;
        if($width >= 0 && $width <= 200 ){
            $fontsize=4;
        }
        
        if($width >= 200 && $width <= 300 ){
            $fontsize=5;
        }
        if($width >= 300 && $width <= 400 ){
            $fontsize=7;
        }
        
        
        if($width > 400 && $width <= 600 ){
            $fontsize=20;
        } 
        
        if($width > 600 ){
            $fontsize=25;
        }
       
        // This is the text layer
        $textLayer = ImageWorkshop::initTextLayer(date('Y-m-d H:i:s'), public_path().'/fonts/American Desktop.ttf', $fontsize, 'ffffff', 0);

        // We add the text layer 12px from the Left and 12px from the Bottom ("LB") of the norway layer:
        $norwayLayer->addLayerOnTop($textLayer, 12, 12, "LB");

        $textLayer = ImageWorkshop::initTextLayer('www.assurets.com', public_path().'/fonts/American Desktop.ttf', $fontsize, 'ffffff', 0);

        // We add the text layer 12px from the Left and 12px from the Bottom ("LB") of the norway layer:
        $norwayLayer->addLayerOnTop($textLayer, 12, 12, "RB");
        
        $image = $norwayLayer->getResult();
        
//        file_put_contents($gifPath, $image);
       // header('Content-type: image/jpeg');
        imagejpeg($image, $gifPath, 95); // We chose to show a JPG with a quality of 95%
        return true;
    }
    
    public function addtimestamp1($publicPath,$file_name1) {
        $image = $publicPath;

        /*
         * set the watermark font size
         * possible values 1,2,3,4, and 5
         * where 5 is the biggest
         */
        $fontSize = 5;

        //set the watermark text
        $text = date('Y-m-d H:i:s');

        /*
         * position the watermark
         * 10 pixels from the left
         * and 10 pixels from the top
         */
        $xPosition = 10;
        $yPosition = 10;

        //create a new image
        $newImg = @imagecreatefromjpeg($image);

        //set the watermark font color to red
        $fontColor = @imagecolorallocate($newImg, 255, 0, 0);

        //write the watermark on the created image
        @imagestring($newImg, $fontSize, $xPosition, $yPosition, $text, $fontColor);

        //output the new image with a watermark to a file
        @imagejpeg($newImg,$publicPath,100);
        /*
         * PNG file appeared to have
         * a better quality than the JPG
         */
        //@imagepng($newImg,$publicPath);

        /*
         * destroy the image to free
         * any memory associated with it
         */
        @imagedestroy($newImg);
    }

    public function getDatatable($request) {
        $requestData = $_REQUEST;

        $columns = array(
            // datatable column index  => database column name
            0 => 'services.id',
            1 => 'services.service_no',
            2 => 'services.vehicle_no',
            3 => 'services.owner_name',
            4 => 'services.owner_mobile',
            5 => 'services.location',
            6 => 'u2.firstname',
            7 => 'services.address',
            8 => 'u1.firstname',
        );

         $query = Service::leftjoin('users as u1', 'services.user_id', '=', 'u1.id')
                            ->leftjoin('users as u2', 'services.insurer', '=', 'u2.id')
                            ->where('services.status','!=','compelete');
        //->groupBy('services.id');
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
                                 'services.id', 'services.service_no', 'services.vehicle_no', 
                                'services.owner_name', 'services.owner_mobile', 'services.location', 
                                'services.insurer', 'services.address', 'u1.firstname as executivename',
                                'u1.role_type  as user_role_type', 
                                'u2.firstname as insurername',
                                'services.status'
                        )->get()->toArray();
        $data = array();
//        print_r($resultArr);exit;
        foreach ($resultArr as $row) {
            $actionHtml = '<a href="' . route("editservice", ["id" => $row["id"]]) . '"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a><a class="delete" data_value="' . $row["id"] . '"> <i  class=" fa fa-trash-o" aria-hidden="true"></i></a><a href="'. route("detailservice", ["id" => $row["id"]]) . '"> <i class="fa fa-eye" aria-hidden="true"></i></a><a class="complete" data_value="' . $row["id"] . '"> <i class="fa fa-check-square" aria-hidden="true"></i></a>';
            if($row['status']=='inprocess'){
                $label='<span class="label label-info">Inprocess</span>';
            }
            if($row['status']=='inreport'){
                $label='<span class="label label-danger">Inreport</span>';
            }
            if($row['status']=='compelete'){
                $label='<span class="label label-success">Compelete</span>';
            }
            
            if($row['user_role_type']=='admin' || $row['user_role_type']==''){
                 $user_role_type='<span class="label label-danger">Executiv Not Assign</span>';
            }else{
                 $user_role_type=$row['executivename'];
            }
//            print_r($row);exit;
            $nestedData = array();
            $nestedData[] = $row['id'];
            $nestedData[] = $row['service_no'];
            $nestedData[] = $row['vehicle_no'];
            $nestedData[] = $row['owner_name'];
            $nestedData[] = $row['owner_mobile'];
            $nestedData[] = $row['location'];
            $nestedData[] = $row['insurername'];
            $nestedData[] = $row['address'];
            $nestedData[] = $user_role_type;
            $nestedData[] = $label;
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
    
     public function getHistoryDatatable($request) {
        $requestData = $_REQUEST;

        $columns = array(
            // datatable column index  => database column name
             0 => 'services.id',
            1 => 'services.service_no',
            2 => 'services.vehicle_no',
            3 => 'services.owner_name',
            4 => 'services.owner_mobile',
            5 => 'services.location',
            6 => 'u2.firstname',
            7 => 'services.address',
            8 => 'u1.firstname',
        );

         $query = Service::leftjoin('users as u1', 'services.user_id', '=', 'u1.id')
                            ->leftjoin('users as u2', 'services.insurer', '=', 'u2.id')
                            ->where('services.status','=','compelete');
        //->groupBy('services.id');
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
                                 'services.id', 'services.service_no', 'services.vehicle_no', 'services.owner_name', 'services.owner_mobile', 'services.location', 'services.insurer', 'services.address', 'u1.firstname as executivename', 'u2.firstname as insurername','services.status'
                        )->get()->toArray();
        $data = array();
//        print_r($resultArr);exit;
        foreach ($resultArr as $row) {
            $actionHtml = '<a href="' . route("editservice", ["id" => $row["id"]]) . '"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a><a class="delete" data_value="' . $row["id"] . '"> <i  class=" fa fa-trash-o" aria-hidden="true"></i></a><a href="'. route("detailservice", ["id" => $row["id"]]) . '"> <i class="fa fa-eye" aria-hidden="true"></i></a>';
            if($row['status']=='inprocess'){
                $label='<span class="label label-info">Inprocess</span>';
            }
            if($row['status']=='inreport'){
                $label='<span class="label label-danger">Inreport</span>';
            }
            if($row['status']=='compelete'){
                $label='<span class="label label-success">Compelete</span>';
            }
//            print_r($row);exit;
            $nestedData = array();
            $nestedData[] = $row['id'];
            $nestedData[] = $row['service_no'];
            $nestedData[] = $row['vehicle_no'];
            $nestedData[] = $row['owner_name'];
            $nestedData[] = $row['owner_mobile'];
            $nestedData[] = $row['location'];
            $nestedData[] = $row['insurername'];
            $nestedData[] = $row['address'];
            $nestedData[] = $row['executivename'];
            $nestedData[] = $label;
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
    
    public function getDataCompanyServicestable($request) {
        $userid=$request->input('data')['userId'];
         
        $requestData = $_REQUEST;

        $columns = array(
            // datatable column index  => database column name
            0 => 'services.id',
            1 => 'services.service_no',
            2 => 'services.vehicle_no',
            3 => 'services.owner_name',
            4 => 'services.owner_mobile',
            5 => 'services.location',
            6 => 'u2.firstname',
            7 => 'services.address',
            8 => 'u1.firstname',
        );

        $query = Service::leftjoin('users as u1', 'services.user_id', '=', 'u1.id')
                            ->leftjoin('users as u2', 'services.insurer', '=', 'u2.id')
                            ->where('services.created_by','!=',$userid)
                            ->where('services.insurer','=',$userid)
                            ->where('services.status','!=',"compelete");
        //->groupBy('services.id');
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
                                'services.id', 'services.service_no', 'services.vehicle_no', 'services.owner_name', 'services.owner_mobile', 'services.location', 'services.insurer', 'services.address', 'u1.firstname as executivename', 'u2.firstname as insurername','services.status'
                        )
                        
                        ->get()->toArray();
        $data = array();
//        print_r($resultArr);exit;
        foreach ($resultArr as $row) {
            $actionHtml = '<a href="'. route("customerdetailservice", ["id" => $row["id"]]) . '"> <i class="fa fa-eye" aria-hidden="true"></i></a>';
            if($row['status']=='inprocess'){
                $label='<span class="label label-info">Inprocess</span>';
            }
            if($row['status']=='inreport'){
                $label='<span class="label label-danger">Inreport</span>';
            }
            if($row['status']=='compelete'){
                $label='<span class="label label-success">Compelete</span>';
            }
//            print_r($row);exit;
            $nestedData = array();
            $nestedData[] = $row['id'];
            $nestedData[] = $row['service_no'];
            $nestedData[] = $row['vehicle_no'];
            $nestedData[] = $row['owner_name'];
            $nestedData[] = $row['owner_mobile'];
            $nestedData[] = $row['location'];
            $nestedData[] = $row['insurername'];
            $nestedData[] = $row['address'];
            $nestedData[] = $row['executivename'];
            $nestedData[] = $label;
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
    
    public function getDataCompanyHistoryServicestable($request) {
        $userid=$request->input('data')['userId'];
         
        $requestData = $_REQUEST;

        $columns = array(
            // datatable column index  => database column name
            0 => 'services.id',
            1 => 'services.service_no',
            2 => 'services.vehicle_no',
            3 => 'services.owner_name',
            4 => 'services.owner_mobile',
            5 => 'services.location',
            6 => 'u2.firstname',
            7 => 'services.address',
            8 => 'u1.firstname',
        );

        $query = Service::leftjoin('users as u1', 'services.user_id', '=', 'u1.id')
                            ->leftjoin('users as u2', 'services.insurer', '=', 'u2.id')
                            ->where('services.status','=',"compelete")
                            ->where('services.insurer','=',$userid);
                            
        //->groupBy('services.id');
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
                                'services.id', 'services.service_no', 'services.vehicle_no', 'services.owner_name', 'services.owner_mobile', 'services.location', 'services.insurer', 'services.address', 'u1.firstname as executivename', 'u2.firstname as insurername','services.status'
                        )
                        
                        ->get()->toArray();
        $data = array();
//        print_r($resultArr);exit;
        foreach ($resultArr as $row) {
            $actionHtml = '<a href="'. route("customerdetailservice", ["id" => $row["id"]]) . '"> <i class="fa fa-eye" aria-hidden="true"></i></a>';
            if($row['status']=='inprocess'){
                $label='<span class="label label-info">Inprocess</span>';
            }
            if($row['status']=='inreport'){
                $label='<span class="label label-danger">Inreport</span>';
            }
            if($row['status']=='compelete'){
                $label='<span class="label label-success">Compelete</span>';
            }
//            print_r($row);exit;
            $nestedData = array();
            $nestedData[] = $row['id'];
            $nestedData[] = $row['service_no'];
            $nestedData[] = $row['vehicle_no'];
            $nestedData[] = $row['owner_name'];
            $nestedData[] = $row['owner_mobile'];
            $nestedData[] = $row['location'];
            $nestedData[] = $row['insurername'];
            $nestedData[] = $row['address'];
            $nestedData[] = $row['executivename'];
            $nestedData[] = $label;
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
    
    public function getDataMyCompanyServicestable($request) {
        
        $userid=$request->input('data')['userId'];
         
        $requestData = $_REQUEST;

        $columns = array(
            // datatable column index  => database column name
            0 => 'services.id',
            1 => 'services.service_no',
            2 => 'services.vehicle_no',
            3 => 'services.owner_name',
            4 => 'services.owner_mobile',
            5 => 'services.location',
            6 => 'u2.firstname',
            7 => 'services.address',
            8 => 'u1.firstname',
        );

        $query = Service::leftjoin('users as u1', 'services.user_id', '=', 'u1.id')
                   ->leftjoin('users as u2', 'services.insurer', '=', 'u2.id')
                   ->where('services.created_by','=',$userid)
                    ->where('services.status','!=','compelete');
        //->groupBy('services.id');
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
                                   'services.id', 'services.service_no', 'services.vehicle_no', 'services.owner_name', 'services.owner_mobile', 'services.location', 'services.insurer', 'services.address', 'u1.firstname as executivename', 'u2.firstname as insurername','services.status'
                        )
                        ->get()->toArray();
        $data = array();
//        print_r($resultArr);exit;
        foreach ($resultArr as $row) {
            $actionHtml = '<a href="'. route("customermydetailservice", ["id" => $row["id"]]) . '"> <i class="fa fa-eye" aria-hidden="true"></i></a>';
            if($row['status']=='inprocess'){
                $label='<span class="label label-info">Inprocess</span>';
            }
            if($row['status']=='inreport'){
                $label='<span class="label label-danger">Inreport</span>';
            }
            if($row['status']=='compelete'){
                $label='<span class="label label-success">Compelete</span>';
            }
//            print_r($row);exit;
            $nestedData = array();
            $nestedData[] = $row['id'];
            $nestedData[] = $row['service_no'];
            $nestedData[] = $row['vehicle_no'];
            $nestedData[] = $row['owner_name'];
            $nestedData[] = $row['owner_mobile'];
            $nestedData[] = $row['location'];
            $nestedData[] = $row['insurername'];
            
            $nestedData[] = $row['address'];
           $nestedData[] = $row['executivename'];
            $nestedData[] = $label;
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
    
    
}
