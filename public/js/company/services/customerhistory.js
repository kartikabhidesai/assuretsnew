var Customerhistory=function(){
   
    var serviceInfo=function(){
        
        var userid=$("#userid").val();
        
                var dataArr = {"userId":userid};
                var columnWidth = {};
                var columnWidth = {"width": "20%", "targets": 8};               
                var arrList = {
                    'tableID': '#datatableServices',
                    'ajaxURL': baseurl + "callsajaxAction",
                    'ajaxAction': 'datatableCompanyHistoryServices',
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
                  title: "are you sure you want to delete service ?",                
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