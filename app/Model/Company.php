<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;

class Company extends Model{
    
    public $timestamps = false;
    
    protected $table = 'services';
    
    public function getCompanyList($perPage){
        
        $result = Company::join('users','users.id','=','services.id')
                           -> select('services.*','users.firstname','users.lastname')
                           ->orderBy('id','DESC')
                           ->paginate($perPage);
        return $result;
        
    }
    
    public function getMyCompanyList($perPage,$logindata){
        
        $result = Company::join('users','users.id','=','services.id')
                           ->select('services.*','users.firstname','users.lastname')
                           ->where('services.insurer',$logindata)
                           ->orderBy('id','DESC')
                           ->paginate($perPage);
                   
        return $result;
    }
}