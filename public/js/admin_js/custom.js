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

    $(document).on("click",".prodtoggleStatus",function(){
        

        let status=$(this).children("i").attr("status");
        let product_id=$(this).attr("product_id");
      
        $.ajax({
            type:"Post",
            url:`/admin/management/product/status`,
            data:{
                "_token":$('meta[name="csrf_token"]').attr('content'),
                "status":status,
                "product_id":product_id,
                
            },
            success:function(resp){
               if(resp==0){
                $('#product-id-'+product_id).html('<i class="fas fa-toggle-off text-black" status="inactive"></i>');
               }else{
                $('#product-id-'+product_id).html('<i class="fas fa-toggle-on text-success" status="active"></i>');

               }
            },
            error:function(){
                console.log("error");
            }
        })
      
    })

    $(document).on("click",".attrtoggleStatus",function(){
        

        let status=$(this).children("i").attr("status");
        let attribute_id=$(this).attr("attribute_id");
      
        $.ajax({
            type:"Post",
            url:`/admin/management/attributes/status`,
            data:{
                "_token":$('meta[name="csrf_token"]').attr('content'),
                "status":status,
                "attribute_id":attribute_id,
                
            },
            success:function(resp){
               if(resp==0){
                $('#attribute-id-'+attribute_id).html('<i class="fas fa-toggle-off text-black" status="inactive"></i>');
               }else{
                $('#attribute-id-'+attribute_id).html('<i class="fas fa-toggle-on text-success" status="active"></i>');

               }
            },
            error:function(){
                console.log("error");
            }
        })
      
    })

    $(document).on("click",".imagetoggleStatus",function(){
        

        let status=$(this).children("i").attr("status");
        let image_id=$(this).attr("image_id");
      
        $.ajax({
            type:"Post",
            url:`/admin/management/images/status`,
            data:{
                "_token":$('meta[name="csrf_token"]').attr('content'),
                "status":status,
                "image_id":image_id,
                
            },
            success:function(resp){
               if(resp==0){
                $('#image-id-'+image_id).html('<i class="fas fa-toggle-off text-black" status="inactive"></i>');
               }else{
                $('#image-id-'+image_id).html('<i class="fas fa-toggle-on text-success" status="active"></i>');

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




    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = `
    
        <div class="mb-4">
            <input style="width: 120px" type="text" placeholder="Size" name="sizes[]" value=""/>
            <input style="width: 120px" type="text" placeholder="Sku" name="skus[]" value=""/>
            <input style="width: 120px" type="number" placeholder="Price" name="prices[]" value=""/>
            <input style="width: 120px" type="number" placeholder="Stock" name="stocks[]" value=""/>
            <a href="javascript:void(0);" class="remove_button mt-2 btn btn-sm btn-danger">Remove</a>
        </div>

    
`; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });

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



