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
use PHPImageWorkshop\ImageWorkshop;

class HistoryController extends Controller {
    
    public function history() {

        $perPage = 15;
      
        $data['css'] = array(
            'plugins/dataTables/datatables.min.css',
            'plugins/sweetalert/sweetalert.css',
        );
        
        $data['js'] = array(
            'plugins/dataTables/datatables.min.js',            
            'plugins/sweetalert/sweetalert.min.js',
            'services/history.js'
            
        );
        $data['funinit'] = array(
            'Histroy.init()',
        );
        return view('admin.pages.history', $data);
    }
    
    public function puttime(){
//        $gifPath = 'C:\xampp\htdocs\assurets\public/servicephoto/1545752858-team1.jpg';
        $gifPath = '1541157590-team1.jpg';
        $norwayLayer = ImageWorkshop::initFromPath($gifPath);

        // This is the text layer
        $textLayer = ImageWorkshop::initTextLayer(date('Y-m-d H:i:s'), public_path().'/fonts/glyphicons-halflings-regular.ttf', 100, 'ffffff', 0);

        // We add the text layer 12px from the Left and 12px from the Bottom ("LB") of the norway layer:
        $norwayLayer->addLayerOnTop($textLayer, 12, 12, "LB");

        $image = $norwayLayer->getResult();
        
        file_put_contents($gifPath, $image);
        header('Content-type: image/jpeg');
        imagejpeg($image, null, 95); // We chose to show a JPG with a quality of 95%
        exit;
    }
}
