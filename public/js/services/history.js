var Histroy=function(){
   
    var serviceInfo=function(){
        
                var dataArr = {};
                var columnWidth = {};
                var columnWidth = {"width": "20%", "targets": 8};               
                var arrList = {
                    'tableID': '#datatableServices',
                    'ajaxURL': baseurl + "callsajaxAction",
                    'ajaxAction': 'datatableHistory',
                    'postData': dataArr,
                    'hideColumnList': [],
                    'noSearchApply': [0],
                    'noSortingApply': [0],
                    'defaultSortColumn': 0,
                    'defaultSortOrder': 'desc',
                    'setColumnWidth': columnWidth
                };
        getDataTable(arrList);
        
        $(document).on('click','.complete',function(){
            var id=$(this).attr('data_value');
            swal({
                  title: "Are you sure you want to complete service ?",                
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText: "Yes, complete it!",
                  cancelButtonText: "No, cancel it!",
                  closeOnConfirm: false,
                   },
                  function (isConfirm) {
                      if (isConfirm) {
                         
                           window.location=baseurl+"completeservices/"+id;

                      } 
                  });
        });
        
        $(document).on('click','.delete',function(){
            var id=$(this).attr('data_value');

            swal({
                  title: "Are you sure you want to delete service ?",                
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText: "Yes, delete it!",
                  cancelButtonText: "No, cancel it!",
                  closeOnConfirm: false,
                   },
                  function (isConfirm) {
                      if (isConfirm) {
                          
                           window.location=baseurl+"deleteservice/"+id;

                      } 
                  });
        });  
    };
    return{
        init:function(){
           serviceInfo(); 
        },
    }
}();