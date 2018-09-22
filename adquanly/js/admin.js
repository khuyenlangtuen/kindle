$(document).ready(function() {

			$("a[rel=example_group]").fancybox({
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'titlePosition' 	: 'over',
				'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
					return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
				}
			});
			$("#abc").fancybox({
				'width'				: 900,
				'height'			: 600,
				'autoScale'			: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'type'				: 'iframe'
			});
			$("#abc1").fancybox({
				'width'				: 900,
				'height'			: 600,
				'autoScale'			: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'type'				: 'iframe'
			});
			$("#abc2").fancybox({
				'width'				: 900,
				'height'			: 600,
				'autoScale'			: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'type'				: 'iframe'
			});
              $(".sl_change").each(function(){
                var id=$(this).attr('val');
                var url=$(this).attr('url');
				$(this).change(function(){
				    var status=$(this).val();
                    update_status(id,status,url);
				//	alert(id);
                });
                
            });
            $(".del").each(function(){
                var id=$(this).attr('val');
                 
				$(this).click(function(){
				    if (confirm("Are you sure ???") == true) {
                        del_group_member(id);
                    } 
                });
                
            });
            $(".del_demuc").each(function(){
                var id=$(this).attr('val');
                var url=$(this).attr('url');
				$(this).click(function(){
				    if (confirm("Are you sure ???") == true) {
                        del_demuc(id,url);
                    } 
                });
                
            });
            $( ".cm-check-items" ).click( function(){
                if($(this).is(':checked'))
                  {
                    $(".cm-item").attr('checked', true);
                  }
                  else{
                    $(".cm-item").removeAttr('checked');
                  }
            } );
            $("#frm_add_new_admin input[name*=username]").blur(function(){
                check_email_exist($(this).val());
            });
            $(".admin_sl_change").each(function(){
                var id=$(this).attr('val');
				$(this).change(function(){
				    var status=$(this).val();
                    update_status_admin(id,status);
				//	alert(id);
                });
                
            });
            $(".del_amin").each(function(){
                var id=$(this).attr('val');
				$(this).click(function(){
				    if (confirm("Are you sure ???") == true) {
                        del_admin(id);
                    } 
                });
                
            });
            $(".chk_group").each(function(){
                var id_group=$(this).val();
                var id_admin=$('#id_admin').val();
				$(this).click(function(){
				    if($(this).is(':checked'))
                    {
                        set_group_for_admin(id_group,id_admin,'add');
                    }
                    else{
                        set_group_for_admin(id_group,id_admin,'del');
                    }
                    
                });
                
            });
            /*$("#uploadBtn").each(function(){
                var index=$(this).attr('val');
                $(this).change(function() {
                  var flag = ValidateSingleInput(this);
                  if(flag)
                  {
                    readURL(this,index);
                  }
                });
            });*/
      jQuery("#lean_overlay").click(function(){
            jQuery(this).hide();
            jQuery('#show_popup').hide();
            jQuery('#id_content_popup').html("");
        });
             
            
		});
  function update_status(id,status,url)
  {
    $.ajax({
      type: "POST",
      url: url,
      data: {id: id,status:status}
    }).done(function( msg ) {
      });/**/   
  }
  function del_group_member(id)
  {
    $.ajax({
      type: "POST",
      url: index_script+"index.php?r=quantri/delGroup",
      data: {id: id}
    }).done(function( msg ) {
        if(msg=='1')
        {
            window.location.href=index_script+"index.php?r=quantri/group";
        }
      });/**/   
  }
  var countChecked = function() {
      //var n = $( "input:checked" ).length;
      //$('.cm-item').is(':checked');
      if($('.cm-check-items').is(':checked'))
      {
        $(".cm-item").attr('checked', true);
      }
      else{
        $(".cm-item").attr('checked', false);
      }
       // Deprecated
      //alert( n + (n === 1 ? " is" : " are") + " checked!" );
    };
    function check_form_add_admin(form)
    {
         //console.log($(form+" input[name*=fullname]").val());
         //return false;
        var valid=true;
        if($(form+" input[name*=fullname]").val()=="")
        {
            $(form+" input[name*=fullname]").css("border","1px solid red");
            $(form+" .fullname").html("* Tên không được rỗng");
            valid=false;
        }
        else{
            $(form+" input[name*=fullname]").css("border","1px solid #ccc");
            $(form+" .fullname").html("");
        }
        var rege = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
						
        if($(form+" input[name*=username]").val()=="")
        {
            $(form+" input[name*=username]").css("border","1px solid red");
            $(form+" .username").html("* Email không được rỗng.");
            valid=false;
        }
        else{
            if(!rege.test($(form+" input[name*=username]").val()))
			{
				$(form+" input[name*=username]").css("border","1px solid red");
                $(form+" .username").html("* Email không đúng định dạng.");
				valid=false;
			}
            else{
                if($('#id_email_exist').val()=='1')
                {
                    $(form+" input[name*=username]").css("border","1px solid red");
                    $(form+" .username").html("* Email này đã sử dụng rồi.");
    				valid=false;
                }
                else{
                    
                    $(form+" input[name*=username]").css("border","1px solid #ccc");
                    $(form+" .username").html("");
                }
                
            }
            
        }
        if($(form+" input[name*=password]").val()=="")
        {
            $(form+" input[name*=password]").css("border","1px solid red");
            $(form+" .password").html("* Mật khẩu không được rỗng");
            valid=false;
        }
        else{
            $(form+" input[name*=password]").css("border","1px solid #ccc");
            $(form+" .password").html("");
        }
        if($(form+" input[name*=phone]").val()=="")
        {
            $(form+" input[name*=phone]").css("border","1px solid red");
            $(form+" .phone").html("* Số phone không được rỗng.");
            valid=false;
        }
        else{
            $(form+" input[name*=phone]").css("border","1px solid #ccc");
            $(form+" .phone").html("");
        }
        
        return valid;
    }
    function check_email_exist(email)
    {
        $.ajax({
          type: "POST",
          url: index_script+"index.php?r=quantri/checkEmailExist",
          data: {email: email}
        }).done(function( msg ) {
            if(msg=='1'){
                $('#id_email_exist').val(1);
                $("#frm_add_new_admin input[name*=username]").css("border","1px solid red");
                $("#frm_add_new_admin .username").html("* Email này đã sử dụng rồi.");
            }
            else{
                $('#id_email_exist').val(0);
            } 
          });/**/ 
    }
     function update_status_admin(id,status)
  {
    $.ajax({
      type: "POST",
      url: index_script+"index.php?r=quantri/updateStatusAdmin",
      data: {id: id,status:status}
    }).done(function( msg ) {
      });/**/   
  }
  function del_admin(id)
  {
    $.ajax({
      type: "POST",
      url: index_script+"index.php?r=quantri/delAdmin",
      data: {id: id}
    }).done(function( msg ) {
        if(msg=='1')
        {
            window.location.href=index_script+"index.php?r=quantri/admin";
        }
      });/**/   
  }
  function set_group_for_admin(id_group,id_admin,type){
     $.ajax({
      type: "POST",
      url: index_script+"index.php?r=quantri/setGroupForAdmin",
      data: {id_group: id_group,id_admin:id_admin,type:type},
      beforeSend: function( xhr ) {
        $('.loader').show();
      }
    }).done(function( msg ) {
        console.log(msg);
        $('.loader').hide();
      });/**/
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
     function del_demuc(id,url)
      {
        $.ajax({
          type: "POST",
          url: url,
          data: {id: id}
        }).done(function( msg ) {
            if(msg=='1')
            {
                window.location.href=location.href;
            }
          });/**/   
      }
      function expand_demuc(id)
      {
        if (!$('#cat_'+id).children().get(0))
        {
            $.ajax({
              type: "POST",
              url: index_script+"index.php?r=category/index",
              data: {cid: id}
            }).done(function( msg ) {
                //console.log(msg);
                $('#cat_'+id).fadeIn(300);
                $('#cat_'+id).html(msg);
                $("#colpand_"+id).show();
                $("#expand_"+id).hide();
                
              });/**/   
        }
         
      }
      function expand_demuc2(id)
      {
        if (!$('#cat_'+id).children().get(0))
        {
            $.ajax({
              type: "POST",
              url: index_script+"index.php?r=category/content",
              data: {cid: id}
            }).done(function( msg ) {
                //console.log(msg);
                $('#cat_'+id).fadeIn(300);
                $('#cat_'+id).html(msg);
                $("#colpand_"+id).show();
                $("#expand_"+id).hide();
                
              });/**/   
        }
         
      }
      function collapse_demuc(id)
      {
         
         $('#cat_'+id).fadeOut(300);
         $('#cat_'+id).html("");
         $("#colpand_"+id).hide();
         $("#expand_"+id).show();
      }
      function update_status_demuc(id)
      {
        var url=$("#sl_change_"+id).attr('url');
        var status=$("#sl_change_"+id).val();
        $.ajax({
          type: "POST",
          url: url,
          data: {id: id,status:status}
        }).done(function( msg ) {
          });/**/   
      }
      function del_demuc2(id)
      {
        var url=$("#id_del_"+id).attr('url');
        if (confirm("Are you sure ???") == true) {
            $.ajax({
              type: "POST",
              url: url,
              data: {id: id}
            }).done(function( msg ) {
                if(msg=='1')
                {
                    window.location.href=location.href;
                }
              });/**/   
          }
      }
      function add_image(id,ob_type)
      {
            var next_id=id+1;
            $.ajax({
              type: "POST",
              url: index_script+"index.php?r=production/addimage",
              data: {id: id,object_type:ob_type}
            }).done(function( msg ) {
                $("#add_image").append(msg);
                $("#btn_add_image").html('<a href="javascript:" onclick="add_image('+next_id+',\''+ob_type+'\');"><i class="fa fa-plus"></i></a>');
              });/**/   
          
      }
      function del_add_image(id,ob_type)
      {
        if(id > 0)
        {
             var prev_id=id-1;
             if(prev_id==0) prev_id=1;
             $("#add_image_"+id).remove();
             $("#btn_add_image").html('<a href="javascript:" onclick="add_image('+prev_id+',\''+ob_type+'\');"><i class="fa fa-plus"></i></a>');
        }
      }
      function show_image(no,index)
      {
         var flag = ValidateSingleInput(no);
          if(flag)
          {
            readURL(no,index);
          }
        
      }
      function del_update_image(id,id_image,ob_type)
      {
        if(id > 0)
        {
             var prev_id=id-1;
             if(prev_id==0) prev_id=1;
             $.ajax({
              type: "POST",
              url: index_script+"index.php?r=production/delimage",
              data: {id: id,id_image:id_image}
            }).done(function( msg ) {
                $("#add_image_"+id).remove();
               $("#btn_add_image").html('<a href="javascript:" onclick="add_image('+prev_id+',\''+ob_type+'\');"><i class="fa fa-plus"></i></a>');
              });/**/ 
             
        }
      }
      function phantrang(page)
      {
            var index=page-1;
            var id_cur='trang_'+index;
            var block_type=$('#block_type').val();
            var id_ten_sanpham=$('#id_ten_sanpham').val();
            var id_theloai=$('#id_theloai').val();
            var id_gia_tu=$('#id_gia_tu').val();
            var id_gia_den=$('#id_gia_den').val();
            var option_id=$('#option_id').val();
            
            $.ajax({
              type: "POST",
              url: index_script+"index.php?r=production/ajaxpicker",
              data: {page: page,block_type:block_type,id_ten_sanpham:id_ten_sanpham,id_theloai:id_theloai,id_gia_tu:id_gia_tu,id_gia_den:id_gia_den,option_id:option_id}
            }).done(function( msg ) {
                $("#panel-body").html(msg);
                $('.paginate_button').removeClass('active');
                $('.paginate_button').each(function(){
                    var id=$(this).attr('id');
                    
                    if(id==id_cur)
                    {
                        
                        $('#'+id).addClass('active');
                    }
                })
              });/**/   
          
      }
      function add_product_picker()
      {
        var chuoi_id='';
        var block_type=$('#block_type').val();
         $(".chk_id_product").each(function(){
            var id_product=$(this).attr('val');
            if($(this).is(':checked'))
            {
                chuoi_id=chuoi_id+id_product+'|';
            }
         });
         console.log(chuoi_id);
         if(chuoi_id)
         {
             $.ajax({
              type: "POST",
              url: index_script+"index.php?r=production/addproductpicker",
              data: {chuoi_id: chuoi_id,block_type:block_type}
            }).done(function( msg ) {
                $("#list_product").html(msg);
               /* $('#modal_add_product').hide();
                 $('#modal_add_product').attr('aria-hidden',true);
                 $('#modal_add_product').removeClass('in');
                 $('.modal-dialog').removeClass('in');
                 $('.modal-dialog').removeClass('fade');
                 $('.modal-backdrop').removeClass('in');
                 $('.modal-backdrop').removeClass('fade');
                 
                 
                 $('body').removeClass('modal-open');*/
                
              });/**/   
         }
         else{
            alert("Bạn chưa chọn sản phẩm !!!");
         }
        
      }
      function add_product_picker_and_option()
      {
        var chuoi_id='';
        var block_type=$('#block_type').val();
        var option_name=$('#option_name').val();
        if(option_name=="")
        {
          alert("Bạn chưa Nhập tên option !!!");
          return;
        }
        var option_id=$('#option_id').val();
        var product_id=$('#product_id').val();
        var option_priority=$('#option_priority').val();
        if(option_priority=="")
        {
          option_priority=1;
        }
         $(".chk_id_product").each(function(){
            var id_product=$(this).attr('val');
            if($(this).is(':checked'))
            {
                chuoi_id=chuoi_id+id_product+'|';
            }
         });
         console.log(chuoi_id);
         if(chuoi_id)
         {
             $.ajax({
              type: "POST",
              url: index_script+"index.php?r=production/addproductpickeroption",
              data: {chuoi_id: chuoi_id,block_type:block_type,option_name:option_name,option_priority:option_priority,option_id:option_id,product_id:product_id}
            }).done(function( msg ) {
                window.location=window.location.href;
                
              });/**/   
         }
         else{
            alert("Bạn chưa chọn sản phẩm !!!");
         }
        
      }
	  function show_list_sp(id)
		{
			$(".modal-body").html('');
			$.ajax({
			  type: "POST",
			  url: index_script+"index.php?r=donhang/viewDetail",
			  data: { id_dh: id }
			}).done(function( msg ) {
			    
				 $(".modal-body").html(msg);
			  });
		}
		function show_list_sp2(id)
		{
			$(".modal-body").html('');
			$.ajax({
			  type: "POST",
			  url: index_script+"index.php?r=donhang/viewDetail2",
			  data: { id_dh: id }
			}).done(function( msg ) {
			    
				 $(".modal-body").html(msg);
			  });
		}
    function show_them_tuychon(product_id)
    {
      $("#show_popup").show();
      $("#lean_overlay").show();
      $("#id_content_popup").html('');
      $("#id_title_popup").html('Thêm tùy chọn');
      $.ajax({
        type: "POST",
        url: index_script+"index.php?r=production/showthemtuychon",
        data: {product_id:product_id}
      }).done(function( msg ) {
          
         $("#id_content_popup").html(msg);
        });
    }
    function show_them_tuychon(product_id,option_id)
    {
      $("#show_popup").show();
      $("#lean_overlay").show();
      $("#id_content_popup").html('');
      $("#id_title_popup").html('Cập nhật tùy chọn');
      $.ajax({
        type: "POST",
        url: index_script+"index.php?r=production/showthemtuychon",
        data: {product_id:product_id,option_id:option_id}
      }).done(function( msg ) {
          
         $("#id_content_popup").html(msg);
        });
    }