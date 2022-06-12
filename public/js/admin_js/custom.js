$(document).ready(function(){
    $("#current_password").keyup(function(){
        let current_password=$(this).val();
        console.log(current_password);

        $.ajax({
            type:"Post",
            url:"/admin/check-current-password",
            data:{
                "_token":$('meta[name="csrf_token"]').attr('content'),
                "current_password":current_password,

            },
            success:(res)=>{
                if(res=="true"){
                    $("#current_password_span").html(`<font class="text-success">Your current password is correct</font>`)
                }
                else if(res=="false"){
                    $("#current_password_span").html(`<font class="text-danger">Your current password is incorrect</font>`)
                }
            },
            error:()=>{ 
                console.log("Error");
            }
        })
    })

    $(document).on("click",".toggleStatus",function(){
        

        let status=$(this).children("i").attr("status");
        let admin_id=$(this).attr("admin_id");
      
        $.ajax({
            type:"Post",
            url:`/admin/management/status`,
            data:{
                "_token":$('meta[name="csrf_token"]').attr('content'),
                "status":status,
                "admin_id":admin_id,
                
            },
            success:function(resp){
               if(resp==0){
                $('#admin-id-'+admin_id).html('<i class="fas fa-toggle-off text-black" status="inactive"></i>');
               }else{
                $('#admin-id-'+admin_id).html('<i class="fas fa-toggle-on text-success" status="active"></i>');

               }
            },
            error:function(){
                console.log("error");
            }
        })
      
    })

    $("#section_id").on("change",function(){
        let section_id=$(this).val();
        $.ajax({
            type:"get",
            url:`/admin/management/catalogue/get-ajax-categories`,
            data:{
                "_token":$('meta[name="csrf_token"]').attr('content'),
                "section_id":section_id,
                
            },
            success:function(resp){
             $("#category_id").html(resp);
            },
            error:function(){
                console.log("error");
            }
    })
  
})
});



if(document.getElementById("user-img")){
    let user_img=document.getElementById("user_img");
let image=document.getElementById("image");

user_img.addEventListener('click',function(){
    image.click();
})

image.addEventListener("change",function(){
    let file=image.files[0];
    let reader= new FileReader();
    reader.addEventListener("load",function(){
        user_img.src=reader.result;
    })
    reader.readAsDataURL(file);
})
}
