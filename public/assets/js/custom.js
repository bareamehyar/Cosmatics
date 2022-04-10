(function () {
    "use strict";

    if(getCookie("direction") != null){



        var direction =getCookie("direction"),
         sliderRight =getCookie("sliderRight"),
         sliderLeft =getCookie("sliderLeft"),
         marginRight =getCookie("marginRight"),
         marginLeft =getCookie("marginLeft"),
         labelFlex =getCookie("labelFlex");

       setProperty('--direction',direction);
       setProperty('--sliderRight',sliderRight);
       setProperty('--sliderLeft',sliderLeft);
       setProperty('--marginRight',marginRight);
       setProperty('--marginLeft',marginLeft);
       setProperty('--labelFlex',labelFlex);


    }


    $(".change-status input[type=\"checkbox\"]").on("click",function (){
        let val = $(this).data("val");
        let userId = $(this).data("userid");
        let status = val == 0 ? 1 : 0;
        let checkBox = $(this);
        $.ajax({
            type: "POST",
            url:"/api/users/app/change_status",
            data:{userStatus: status, userId: userId}, // serializes the form's elements.
            success: function(response)
            {
                if(response.status == 1){
                    if(status == 1)
                        checkBox.attr('checked', true);
                    else
                        checkBox.attr('checked', false);
                    checkBox.attr("data-val",status);
                }
            },
            error:function(){
                console.error("you have error");
            }
        });
    });

    $('.navigateType').on("change",function (){
        let select = $($(this).data("select"));
        select.siblings(".selects").fadeOut(500,function (){
            select.fadeIn(500);
        });
    });
    $('.delete-slider').on('click',function(){
        let branchId = $(this).data("branchid"),
        sliderId = $(this).data("imageid"),
        sliderBox = $(this).parent();

        $.ajax({
            type: "POST",
            url:"/api/branch/slider/delete",
            data:{branchId: branchId, sliderId: sliderId}, // serializes the form's elements.
            success: function(response)
            {
                if(response.status == 1){
                    sliderBox.fadeOut().remove();
                }
            },
            error:function(){
                console.error("you have error");
            }
        });
    });


    $(".form-confirm").on("click",function(event){
        event.preventDefault();
        let form = $($(this).data("form-id"));
        let title = form.data("swal-title");
        let text = form.data("swal-text");
        console.log($(this).data("formid"));

        swal({
            title: title,
            text: text,
            icon: "warning",
            buttons: [form.data("no"),form.data("yes")],
            dangerMode: true,
          })
          .then((willDelete) => {
            if (willDelete) {
              swal(form.data("success-msg"), {
                icon: "success",
              });
              setTimeout(function(){form.submit();},1000);
            } else {

            }
          });
    });

    $(".show-uploaded").on("change",function(){
        let imgsContainerClass = $(this).data("imgs-container-class");

        if($(this).data("upload-type") == "single"){
            let imgBox = document.createElement("div");
            imgBox.classList.add(["img-container"]);
            let img = document.createElement("img");
            var reader = new FileReader();
            reader.onload = function (e) {
                img.setAttribute("src", e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
            imgBox.appendChild(img);
            imgBox.style.display = "none";
            imgBox = $(imgBox);
            $("." + imgsContainerClass).empty().append(imgBox);
            imgBox.fadeIn();
        }else  if($(this).data("upload-type") == "multi"){
            let container = $("." + imgsContainerClass);
            container.empty();
            for (let index = 0; index < this.files.length; index++) {
                let imgBox = document.createElement("div");
                imgBox.classList.add(["img-container"]);
                let img = document.createElement("img");
                var reader = new FileReader();
                reader.onload = function (e) {
                    img.setAttribute("src", e.target.result);
                }
                reader.readAsDataURL(this.files[index]);
                imgBox.appendChild(img);
                imgBox.style.display = "none";
                imgBox = $(imgBox);
                container.append(imgBox);
                imgBox.fadeIn();
            }

        }

    });


})();

function getCookie(key) {
    var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
    return keyValue ? keyValue[2] : null;
}

function setCookie(key, value, expiry) {
    var expires = new Date();
    expires.setTime(expires.getTime() + (expiry * 24 * 60 * 60 * 1000));
    document.cookie = key + '=' + value + ';expires=' + expires.toUTCString();
}
function setProperty(variable,value){
    document.documentElement.style.setProperty(variable,value);
}
