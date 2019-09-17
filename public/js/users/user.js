var User=function(){
    var userInfo=function(){
         var dataArr = {};
                var columnWidth = {};
                var columnWidth = {"width": "20%", "targets":6};               
                var arrList = {
                    'tableID': '#datatableUser',
                    'ajaxURL': baseurl + "callsajaxAction",
                    'ajaxAction': 'datatableUser',
                    'postData': dataArr,
                    'hideColumnList': [],
                    'noSearchApply': [0],
                    'noSortingApply': [0],
                    'defaultSortColumn': 0,
                    'defaultSortOrder': 'desc',
                    'setColumnWidth': columnWidth
                };
               
        getDataTable(arrList);
        
        $(document).on('click','.delete',function(){
          var id=$(this).attr('data_value');
          
          swal({
                title: "are you sure you want to delete user ?",                
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel it!",
                closeOnConfirm: false,
              },
                function (isConfirm) {
                    if (isConfirm) {
                         window.location=baseurl+"delete/"+id;
                        
                    } 
                });
        });  
        
    };
    
    return{
        init:function(){
           userInfo(); 
        },
    }
}();