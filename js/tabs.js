$(document).ready(function () {
	$("#txt_foto").on('change', function() {
          //Get count of selected files
          var countFiles = $(this)[0].files.length;
          var imgPath = $(this)[0].value;
          var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
          var image_holder = $("#image-holder");
          image_holder.empty();
          if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
            if (typeof(FileReader) != "undefined") {
              //loop for each file selected for uploaded.
              for (var i = 0; i < countFiles; i++) 
              {
                var reader = new FileReader();
                reader.onload = function(e) {
                  $("<img />", {
					  id: 'dynamic',
						width:180,
						height:130,
                    "src": e.target.result,
                    "class": "img-rounded"
                  }).appendTo(image_holder);
                }
                image_holder.show();
                reader.readAsDataURL($(this)[0].files[i]);
              }
            } else {
              alert("This browser does not support FileReader.");
            }
          } else {
            alert("Pls select only images");
          }
        });
	
	
    //Initialize tooltips
    $('.nav-tabs > li a[title]').tooltip();
    
    //Wizard
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

        var $target = $(e.target);
    
        if ($target.parent().hasClass('disabled')) {
            return false;
        }
    });

    $(".next-step").click(function (e) {
		if ($("#txt_nombre") && $("#txt_app_p") && $("#txt_app_m").val()!="") { 
			e.preventDefault();
			var $active = $('.board .nav-tabs li.active');
			$active.next().removeClass('disabled');
			nextTab($active);
		  }
    });
	 $(".next-step-contacto").click(function (e) {
		if ($("#txt_email") && $("#txt_psw") && $("#txt_conf_psw").val()!="") {
			e.preventDefault();
			var $active = $('.board .nav-tabs li.active');
			$active.next().removeClass('disabled');
			nextTab($active);
		  }
    });
	 $(".next-step-organismo").click(function (e) {
		if ($("#txt_organismos") && $("#txt_uni_respon").val()!="") {
			e.preventDefault();
			var $active = $('.board .nav-tabs li.active');
			$active.next().removeClass('disabled');
			nextTab($active);
		  }
    });
	$(".next-step-final").click(function (e) {
		if ($("#txt_nombre").val()=="") {
			    e.preventDefault();
				if($("#txt_nombre").val()==""){error('#1');}if($("#txt_app_p").val()==""){error('#2');}if($("#txt_app_m").val()==""){error('#3');}				
				prevTab('.board .nav-tabs li.contacto');
				msg();
		  }else if ($("#txt_app_p").val()=="") {
			    e.preventDefault();
				if($("#txt_nombre").val()==""){error('#1');}if($("#txt_app_p").val()==""){error('#2');}if($("#txt_app_m").val()==""){error('#3');}				
				prevTab('.board .nav-tabs li.contacto');
				msg();
		  }else if ($("#txt_app_m").val()=="") {
				e.preventDefault();
				if($("#txt_nombre").val()==""){error('#1');}if($("#txt_app_p").val()==""){error('#2');}if($("#txt_app_m").val()==""){error('#3');}				
				prevTab('.board .nav-tabs li.contacto');
				msg();
		  }else if ($("#txt_email").val()=="") {
			    e.preventDefault();
				if($("#txt_email").val()==""){error('#4');}if($("#txt_psw").val()==""){error('#5');}if($("#txt_conf_psw").val()==""){error('#6');}	
				prevTab('.board .nav-tabs li.organismo');
				msg();
		  }else if ($("#txt_psw") && $("#txt_conf_psw").val()=="") {
			    e.preventDefault();
				if($("#txt_email").val()==""){error('#4');}if($("#txt_psw").val()==""){error('#5');}if($("#txt_conf_psw").val()==""){error('#6');}	
				prevTab('.board .nav-tabs li.organismo');
				msg();
		  }else if ($("#txt_organismos").val()=="") {
			    e.preventDefault();
				if($("#txt_organismos").val()==""){errorCombo('#7');}if($("#txt_uni_respon").val()==""){errorCombo('#8');}
				prevTab('.board .nav-tabs li.credencial');
				msg();
		  }
		  else if ($("#txt_uni_respon").val()=="") {
			    e.preventDefault();
				if($("#txt_organismos").val()==""){errorCombo('#7');}if($("#txt_uni_respon").val()==""){errorCombo('#8');}
				prevTab('.board .nav-tabs li.credencial');
				msg();
		  }
    });
    $(".prev-step").click(function (e) {
        var $active = $('.board .nav-tabs li.active');
        prevTab($active);
    });
	
});

function nextTab(elem) {
    $(elem).next().find('a[data-toggle="tab"]').click();
}
function prevTab(elem) {
    $(elem).prev().find('a[data-toggle="tab"]').click();
}
function msg() {
	toastr.options = {
		closeButton: true,
		progressBar: true,
		positionClass: 'toast-top-center',
		showMethod: 'slideDown',
		timeOut: 6000
	};
	toastr.warning('LLenar todos los campos', '<h3>(*) Campos Obligatorios</h3>');
}
function error(elem){
	$(elem).addClass('has-feedback has-error');
}
function errorCombo(elem){
	$(elem).append( "<i class=\"form-control-feedback glyphicon glyphicon-remove\" style=\"display: block;\"></i>" );
	$(elem).addClass('has-feedback has-error');
}
function msgUser() {
	toastr.options = {
		onclick: null,
		closeButton: true,
		progressBar: true,
		positionClass: 'toast-top-center',
		showMethod: 'slideDown',
		timeOut: 19000 
	};
	toastr.error('<a href="/ptfma_recuperar_pwd.php" role="button" class="btn btn-large btn-danger pull-left\">Recuperar Contraseña</a>', '<h4>Ya existe el Usuario o su Número de Licencia es Incorrecto</h4>');
}

function msgUserLic() {
	toastr.options = {
		onclick: null,
		closeButton: true,
		progressBar: true,
		positionClass: 'toast-top-center',
		showMethod: 'slideDown',
		timeOut: 19000 
	};
	toastr.error('<a href="#" role="button" class="btn btn-large btn-danger pull-left\">Recuperar Contraseña</a>', '<h4>Número de Licencia ya fue Asignado</h4>');
}