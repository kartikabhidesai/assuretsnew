var Servicesdetails=function(){
   
    var serviceDelete=function(){
       $('body').on("click",'.deleteimages',function(){
           var token=$("#token").val();
            var id=$("#id").val();
          var imagesid = [];
            $.each($("input[name='image']:checked"), function(){            
                imagesid.push($(this).val());
            });
            if(imagesid.length > 0){
            swal({
                  title: "are you sure you want to delete images ?",                
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonColor: "#DD6B55",
                  confirmButtonText: "Yes, delete it!",
                  cancelButtonText: "No, cancel it!",
                  closeOnConfirm: true,
                   },
                  function (isConfirm) {
                      
                      $.ajax({
                            type: "POST",
                            url: baseurl + "deleteimages",
                            data: {"imagesid": imagesid,"_token":token},
                            success: function(data) {
                                window.location.href=baseurl + "detailservice/"+id;
                            }
                        });
                  });
           }else{
               swal({
                  title: "No image selected",                
                  type: "error",
                  
                   }
                  );
           }
       });
    };
    return{
        init:function(){
           serviceDelete(); 
        },
    }
}();