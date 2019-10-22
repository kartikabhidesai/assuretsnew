<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
use PHPImageWorkshop\ImageWorkshop;
class ServicePhoto extends Model {

    protected $table = 'service_photo';

    public function getServicePhotoData($id){
        return ServicePhoto::where('service_id',$id)->get()->toArray();
    }
    
    
    public function deleteimages($request){
        $imagesid=$request->input('imagesid');
        for($i=0;$i<count($imagesid);$i++){
           $image= ServicePhoto::select('name')
                ->where('id', $imagesid[$i])->get()->toarray();
          
            $file=  base_path().'/public/servicephoto/'.$image['0']['name'];
            if (file_exists($file)) {
               unlink($file);  
            }
            ServicePhoto::where('id', $imagesid[$i])->delete();
          
        }
        return TRUE;
    }
    
    public function addimages($request){
        $serviseid=$request->input('serviceid');
        $destinationPath = public_path() . '/servicephoto/';
        $file1 = $request->file('filename');
        $file_name1 = '';
        $width=getimagesize($file1)[0];
        $height=getimagesize($file1)[1];
       
        
        if (!empty($file1)) {
            $time = time();
            $file_name1 = $time .'-'. $file1->getClientOriginalName();
            $file1->move($destinationPath, $file_name1);
            $publicPath = $destinationPath . $file_name1;
            $this->addtimestamp($publicPath,$file_name1,$width);
            $servicephoto = new ServicePhoto;
            
            $servicephoto->service_id = $serviseid;
            $servicephoto->name = $file_name1;
                if($servicephoto->save()){
                    return true;
                }
            
        }
       
    }
    
    public function addtimestamp($publicPath,$file_name1,$width){
        $gifPath = $publicPath; // Your animated GIF path
        
        $norwayLayer = ImageWorkshop::initFromPath($gifPath);
        $fontsize =0;
        if($width >= 0 && $width <= 400 ){
            $fontsize=7;
        }
        
        
        if($width > 400 && $width <= 600 ){
            $fontsize=20;
        } 
        
        
//        
//        if($width > 600 || $width >= 800 ){
//            $fontsize=50;
//        }
//        
//        if($width > 800 || $width >= 1000 ){
//            $fontsize=60;
//        }
//        
        if($width > 600 ){
            $fontsize=25;
        }
       
        // This is the text layer
        $textLayer = ImageWorkshop::initTextLayer(date('Y-m-d H:i:s'), public_path().'/fonts/American Desktop.ttf', $fontsize, 'ffffff', 0);

        // We add the text layer 12px from the Left and 12px from the Bottom ("LB") of the norway layer:
        $norwayLayer->addLayerOnTop($textLayer, 12, 12, "LB");
        
        $textLayernew = ImageWorkshop::initTextLayer('www.assurets.com', public_path().'/fonts/American Desktop.ttf', $fontsize, 'ffffff', 0);
        $norwayLayer->addLayerOnTop($textLayernew, 12, 12, "RB");

        $image = $norwayLayer->getResult();
        
//        file_put_contents($gifPath, $image);
       // header('Content-type: image/jpeg');
        imagejpeg($image, $gifPath, 95); // We chose to show a JPG with a quality of 95%
        return true;
    }
}
