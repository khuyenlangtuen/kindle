
function number_format(number, decimals, dec_point, thousands_sep) {
		  number = (number + '')
			.replace(/[^0-9+\-Ee.]/g, '');
		  var n = !isFinite(+number) ? 0 : +number,
			prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
			sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
			dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
			s = '',
			toFixedFix = function(n, prec) {
			  var k = Math.pow(10, prec);
			  return '' + (Math.round(n * k) / k)
				.toFixed(prec);
			};
		  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
		  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
			.split('.');
		  if (s[0].length > 3) {
			s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
		  }
		  if ((s[1] || '')
			.length < prec) {
			s[1] = s[1] || '';
			s[1] += new Array(prec - s[1].length + 1)
			  .join('0');
		  }
		  return s.join(dec);
		}
function refreshDistrict(id)
{
	$.ajax({
		url: index_script+"user/getDistrict",
		type: 'post',
		data: {id:id},
		success: function (data) {
				$("#district").html(data);
			},
		error: function () {}
	});
}
function refreshWard(id)
{
	$.ajax({
		url: index_script+"user/getWard",
		type: 'post',
		data: {id:id},
		success: function (data) {
				$("#ward").html(data);
			},
		error: function () {}
	});
}
function show_image(no,index)
      {
         var flag = ValidateSingleInput(no);
          if(flag)
          {
            readURL(no,index);
          }
        
      }
function readURL(input,id) {
      if (input.files && input.files[0]) {
        var size = parseFloat(input.files[0].size / 1024).toFixed(2);
        if(size > 1024)
        {
            alert("Hình ảnh không được lớn hơn 1MB");
            $('#id_images'+id).attr('src', index_script+'images/no-image.png');
            input.value="";
            return;
        }
        var reader = new FileReader();
        reader.onload = function(e) {
	        $('#show_image').show();
          $('#id_images'+id).attr('src', e.target.result);
        }
    
        reader.readAsDataURL(input.files[0]);
      }
    }
    var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"];    
    function ValidateSingleInput(oInput) {
        if (oInput.type == "file") {
            var sFileName = oInput.value;
             if (sFileName.length > 0) {
                var blnValid = false;
                for (var j = 0; j < _validFileExtensions.length; j++) {
                    var sCurExtension = _validFileExtensions[j];
                    if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                        blnValid = true;
                        break;
                    }
                }
                 
                if (!blnValid) {
                    alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
                    oInput.value = "";
                    return false;
                }
            }
        }
        return true;
    }
function show_errors(mes,er)
{
	if(er)
	{
		$("#id_errors_code").css({"color":"red"});
	}
	else{
		$("#id_errors_code").css({"color":"#337ab7"});
	}
	$("#id_errors_code").html(mes);
	$("#id_errors_mess").modal("show");
		
}
function reset_form()
{
	$('#full_name').val("");
	$('#email').val("");
	$('#phone').val("");
	$('#address').val("");
	$('#delivery_address').val("");
	$('#delivery_quantity').val("");
	
}
function check_form(id)
{
	if($('#full_name').val()=='')
	{
		$("#full_name").css({"border":"1px dashed #f0877c"});
		show_errors("Vui lòng nhập họ tên của bạn.",true);
		return false;
	}
	if($('#email').val()=='')
	{
		$("#email").css({"border":"1px dashed #f0877c"});
		show_errors("Vui lòng nhập email của bạn.",true);
		return false;
	}
	else{
		var rege = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
		if(!rege.test($("#email").val()))
		{
			$("#email").css({"border":"1px dashed #f0877c"});
			show_errors("Email của bạn không đúng định dạng, vui lòng nhập lại.",true);
			return false;
		}
	}
	if($('#phone').val()=='')
	{
		$("#phone").css({"border":"1px dashed #f0877c"});
		show_errors("Vui lòng nhập số điện thoại của bạn.",true);
		return false;
	}
	else{
		var regex = /[0-9]/;  
		if(!regex.test($("#phone").val())) 
		{  
			$("#phone").css({"border":"1px dashed #f0877c"});
			show_errors("Số điện thoại không đúng định dạng, Vui lòng nhập lại.",true);
			return false;
		}
	}
	
	if($('#address').val()=='')
	{
		$("#address").css({"border":"1px dashed #f0877c"});
		show_errors("Vui lòng nhập địa chỉ của bạn.",true);
		return false;
	}
	if($('#delivery_address').val()=='')
	{
		$("#delivery_address").css({"border":"1px dashed #f0877c"});
		show_errors("Vui lòng nhập địa chỉ giao hàng của bạn.",true);
		return false;
	}
	if($('#delivery_quantity').val()=='')
	{
		$("#delivery_quantity").css({"border":"1px dashed #f0877c"});
		show_errors("Vui lòng nhập số lượng sách đặt hàng.",true);
		return false;
	}
	if($('#pay_method').val()=='')
	{
		//$("#id_cod").css({"border":"1px dashed #f0877c"});
		//$("#id_atm").css({"border":"1px dashed #f0877c"});
		show_errors("Bạn chưa chọn phương thức thanh toán",true);
		return false;
	}
	var hash = $(':input', id).serializeArray();
	$.ajax({
		url: index_script+"cart/adddathang",
		type: 'post',
		data: hash,
		success: function (data) {
			if(data=="0")
			{
				reset_form();
				show_errors("Bạn đặt sách thành công",false);
			}
			 else{
				 show_errors("Bạn đặt sách không thành công",true);
			 }
		},
		error: function () {}
	});
	return false;
}
function phantrang(page)
{
	 var index=page-1;
     var id_cur='trang_'+index;
	$.ajax({
		url: index_script+"content/ajaxTonvinh",
		type: 'post',
		data: {page:page},
		success: function (data) {
			$("#page_tonvinh").html(data);
			$('.page').removeClass('active');
                $('.page').each(function(){
                    var id=$(this).attr('id');
                    
                    if(id==id_cur)
                    {
                        
                        $('#'+id).addClass('active');
                    }
                })
		},
		error: function () {}
	});
}
function phantrang2(page)
{
	 var index=page-1;
     var id_cur='sktrang_'+index;
	$.ajax({
		url: index_script+"content/ajaxSukien",
		type: 'post',
		data: {page:page},
		success: function (data) {
			$("#page_sukien").html(data);
			$('.page').removeClass('active');
                $('.page').each(function(){
                    var id=$(this).attr('id');
                    
                    if(id==id_cur)
                    {
                        
                        $('#'+id).addClass('active');
                    }
                })
		},
		error: function () {}
	});
}
function show_t(id)
{
     var id_cur='tv_row_'+id;
	$.ajax({
		url: index_script+"content/detailTonvinh",
		type: 'post',
		data: {id:id},
		success: function (data) {
			$("#detail_tonvinh").fadeIn('slow');
			$("#detail_tonvinh").html(data);
			$('.post').removeClass('active');
                $('.post').each(function(){
                    var id=$(this).attr('id');
                    
                    if(id==id_cur)
                    {
                        
                        $('#'+id).addClass('active');
                    }
                });
		},
		error: function () {}
	});
}
function validate_amount(evt) {
                    var theEvent = evt || window.event;
                    var key = theEvent.keyCode || theEvent.which;
                    key = String.fromCharCode( key );
					
                    //var regex = /[0-9]/;
                    var regex=/^[0-9\b]+$/;
					
                    if( !regex.test(key) ) {
						theEvent.returnValue = false;
						if(theEvent.preventDefault) theEvent.preventDefault();
					}
				
            }
$(document).ready(function() {
	var radios = $('input:radio[name=cash]');
	 $(".cash").change(function(){
	 	var val=$(this).attr('val');
	 	if(radios.is(':checked') === true) {
			$("#id_cash").val(val);
		}
	 });
});