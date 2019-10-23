$( document ).ready(function() {
    
    updateDateScreen();
    

    $("form").submit(function(event){     
      let field = $( this ).serializeArray();        
      let obj = {};
      jQuery.each(field, function(i, item){
        if (obj[item.name] === undefined) { // New
          obj[item.name] = item.value || '';
        } else {                            // Existing
            if (!obj[item.name].push) {
                obj[item.name] = [obj[item.name]];
            }
            obj[item.name].push(item.value || '');
        }
      }); 

      jQuery.ajax({
        cache: false,
        url: "save.php",
        data: obj,
        dataType: "json",
        type:"POST",        
        success: function(data){
            Swal.fire({
                title: 'บันทึกสำเร็จ',
                text: data.message,
                type: 'success',
                confirmButtonText: 'Close'
            });
        },
        error:function(data){
          //console.log(data.responseJSON.message);
          Swal.fire({
            title: 'Error!',
            text: data.responseJSON.message,
            type: 'error',
            confirmButtonText: 'Close'
        });
        }
      }); 
      event.preventDefault();
    });

    $("#accept").on('click', function() {
        if(this.checked) {
            Swal.fire({
                type: 'info',
                title: 'หากเอกสารประกอบการคัดกรองไม่ครบในวันคัดกรอง',
                text: 'ขอสงวนสิทธิในการพิจารณาคัดออกจากโครงการวิจัยฯ" \n และ "เอกสารทุกอย่างต้องทำสำเนามา 1 ชุด เพื่อมอบให้ทีมงานโครงการฯเก็บไว้"',               
                confirmButtonText: 'รับทราบแล้ว',
            });
        }
      });

    $("#cid").keyup(function(){
      if($(this).val().length == 13){
        //console.log($(this).val());
        let id = $(this).val();
        let sum = 0;
        for(i=0; i < 12; i++){
          sum += parseFloat(id.charAt(i))*(13-i);
        }          
        if((11-(sum%11))%10 !== parseFloat(id.charAt(12))){
            //ถ้าเลขบัตรประชาชนไม่ถูก border: 1px solid #dc3545;
            $(this).css("border","2px solid #dc3545");
          }else{
            $(this).css("border","2px solid #28a745");
          }
      }
    });

    let day = "";
    let month = "";      

    $("#day").keyup(function(){
      let val = $(this).val();
      if(val > 31 || val === '0'){
        $(this).val('');
        $($(this).popover('toggle'));
      }else{
        $($(this).popover('hide'));
        day = $(this).val();
      }
    });

    $("#month").keyup(function(){
      let val = $(this).val();
      if(val > 12 || val === '0'){
        $(this).val('');
        $($(this).popover('toggle'));
      }else{
        $($(this).popover('hide'));
        month = $(this).val();
      }
    });
    $("#year").keyup(function(){ //2537,2464
      let val = $(this).val();
      if(val.length > 4 || val === '0') $(this).val('');
      if(!((val >= $(this).attr('min')) && (val <= $(this).attr('max')))){          
        $($(this).popover('toggle'));
      }else{          
        $($(this).popover('hide'));          
          let age = new Date($(this).val() - 543, month, day);          
          $('#age').text(getAge(age));          
      }
    });
});

function updateDateScreen(){
    //1 วันที่ 4 พฤศจิกายน 2562
    setInterval(function(){    
        jQuery.ajax({
            cache: false,
            url: "status.php",
            data: {screening:$("#screening1").val()},
            dataType: "json",
            type:"GET",        
            success: function(data){
                $("#s1").text(data.total+" ราย");
                if(data.total >= 200) {                    
                    $("#screening1").prop("disabled", true);
                }else{
                    $("#screening1").prop("disabled", false);
                }
            },
            error:function(){
                $("#screening1").prop("disabled", false);
            }
        });    
        }, 3000);
    //2 วันที่ 5 พฤศจิกายน 2562
    setInterval(function(){    
        jQuery.ajax({
            cache: false,
            url: "status.php",
            data: {screening:$("#screening2").val()},
            dataType: "json",
            type:"GET",        
            success: function(data){
                $("#s2").text(data.total+" ราย");
                if(data.total >= 200) {
                    $("#screening2").prop("disabled", true);
                }else{
                    $("#screening2").prop("disabled", false);
                }
            },
            error:function(){
                $("#screening2").prop("disabled", false);
            }
        });    
        }, 3000);

    //3 วันที่ 6 พฤศจิกายน 2562
    setInterval(function(){    
        jQuery.ajax({
            cache: false,
            url: "status.php",
            data: {screening:$("#screening3").val()},
            dataType: "json",
            type:"GET",        
            success: function(data){
                $("#s3").text(data.total+" ราย");
                if(data.total >= 200) {
                    $("#screening3").prop("disabled", true);
                }else{
                    $("#screening3").prop("disabled", false);
                }
            },
            error:function(){
                $("#screening3").prop("disabled", false);
            }
        });    
        }, 3000);

    //4 วันที่ 7 พฤศจิกายน 2562
    setInterval(function(){    
        jQuery.ajax({
            cache: false,
            url: "status.php",
            data: {screening:$("#screening4").val()},
            dataType: "json",
            type:"GET",        
            success: function(data){
                $("#s4").text(data.total+" ราย");
                if(data.total >= 200) {
                    $("#screening4").prop("disabled", true);
                }else{
                    $("#screening4").prop("disabled", false);
                }
            },
            error:function(){
                $("#screening4").prop("disabled", false);
            }
        });    
        }, 3000);

    //5 วันที่ 8 พฤศจิกายน 2562
    setInterval(function(){    
        jQuery.ajax({
            cache: false,
            url: "status.php",
            data: {screening:$("#screening5").val()},
            dataType: "json",
            type:"GET",        
            success: function(data){
                $("#s5").text(data.total+" ราย");

                if(data.total >= 200) {
                    $("#screening5").prop("disabled", true);
                }else{
                    $("#screening5").prop("disabled", false);
                }
            },
            error:function(){
                $("#screening5").prop("disabled", false);
            }
        });    
        }, 3000);
}

function getAge(dateString) {
  var today = new Date();
  var DOB = new Date(dateString);
  var totalMonths = (today.getFullYear() - DOB.getFullYear()) * 12 + today.getMonth() - DOB.getMonth();
  totalMonths += today.getDay() < DOB.getDay() ? -1 : 0;
  var years = today.getFullYear() - DOB.getFullYear();
  if (DOB.getMonth() > today.getMonth())
      years = years - 1;
  else if (DOB.getMonth() === today.getMonth())
      if (DOB.getDate() > today.getDate())
          years = years - 1;

  var days;
  var months;

  if (DOB.getDate() > today.getDate()) {
      months = (totalMonths % 12);
      if (months == 0)
          months = 11;
      var x = today.getMonth();
      switch (x) {
          case 1:
          case 3:
          case 5:
          case 7:
          case 8:
          case 10:
          case 12: {
              var a = DOB.getDate() - today.getDate();
              days = 31 - a;
              break;
          }
          default: {
              var a = DOB.getDate() - today.getDate();
              days = 30 - a;
              break;
          }
      }

  }
  else {
      days = today.getDate() - DOB.getDate();
      if (DOB.getMonth() === today.getMonth())
          months = (totalMonths % 12);
      else
          months = (totalMonths % 12) + 1;
  }
  var age = years + ' ปี ' + months + ' เดือน ' + days + ' วัน';
  return age;
}
