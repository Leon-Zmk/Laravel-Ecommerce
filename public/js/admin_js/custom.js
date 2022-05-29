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
})

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