var $loading = ' <i class="fa fa-spinner fa-spin"></i>';
var app = {
	config: {
		title: 'Bot Music'
	},
	page: {},
	login: {},
	loading: {
		show: function(callback){
			$('body').addClass('no-scroll');
			$('.be-loading-content').fadeIn('fast', function(){
				typeof callback == 'function' ? callback() : '';
			});
		},
		hide: function(callback){
			$('body').removeClass('no-scroll');
			$('.be-loading-content').fadeOut('fast', function(){
				typeof callback == 'function' ? callback() : '';
			});
		}
	},
};
function ChangeUser(){
	setTimeout(function(){
		ChangeUser();
	}, 5 * 1000);
	$.get($base_url  + 'api/auth/info', function(data) {
		$('.user-point').html('<span class="fa fa-money fa-lg"></span> ยอดเงินคงเหลือ: <b>' + data.msg + '.00</b> Point');
	},'json');
}
function ChangePage(page){
	window.history.pushState(app.config.title, '', '#page/' + page);
	PageController();
}
function getPage(){
	var page = window.location.hash.replace('#', '').split('&');
	app.page = {};
	app.page.page = 'dashboard';
	for(i in page){
		page[i] = page[i].split('/');
		app.page[page[i][0]] = (typeof page[i][1] != 'undefined') ? page[i][1] : '';
	}
	delete page;
}
function RenderPage(){
	if($isLogin){
		app.login = true;
	}else{
		app.login = false;
	}
	if($isLogin == false && app.page.page != 'login'){
		ChangePage('login');
		return false;
	}
	if($isLogin == true && app.page.page == 'login'){
		ChangePage('dashboard');
		return false;
	}
	loadPage(app.page.page);
}
function loadPage(page, param, callback){
	if(app.login){
		$('#Nav').removeClass('hidden');
	}else{
		$('#Nav').addClass('hidden');
	}
	app.loading.show();

	if(typeof param == 'function'){
		callback = param;
		param = {};
	}else if(typeof param == 'undefined'){
		param = {};
	}
	var $titlePage = $('a[href="' + app.page.page + '"]').text();
	if(typeof $titlePage == 'undefined'){
		if(app.page.page == 'login'){
			$titlePage = 'เข้าสู่ระบบ';
		}else{
			$titlePage = $('a[href="' + app.page.page + '"]').text();
		}
	}
	$('#Nav > #mainNavbar > ul > li > a').removeClass('active');
	$('a[href="' + app.page.page + '"]').addClass('active');
	$('title').html(app.config.title + ' :: ' + $titlePage);
	if(page == 'control'){
		$.get($base_url + 'control/' + app.page.id + '/page', function(data) {
			$('.main-content').html(data);
			setTimeout(function(){
				app.loading.hide();
			}, 250);
		});
	}else{
		$.get($base_url + 'api/getpage/' + page, param, function(data){
			$('.main-content').html(data);
			setTimeout(function(){
				app.loading.hide();
			}, 250);
		});
	}
	ChangeUser();
	typeof callback == 'function' ? callback() : '';
}
function PageController(){
	getPage();
	RenderPage();
}
function Alert($alert, $type, $message, $hide = true){
	$alert.removeClass('alert-success alert-danger alert-info alert-warning');
	switch($type){
		case 'success':
		$message = '<i class="fa fa-check"></i> ' + $message;
		break;
		case 'danger':
		$message = '<i class="fa fa-warning"></i> ' + $message;
		break;
		case 'warning':
		$message = '<i class="fa fa-warning"></i> ' + $message;
		break;
		case 'info':
		$message = '<i class="fa fa-info-circle"></i> ' + $message;
		break;
		default:
		$message = '<i class="fa fa-info-circle"></i> ' + $message;
		break;
	}
	$alert.addClass('alert-' + $type).html($message).removeClass('hidden');
	if($hide == true){
		setTimeout(function(){
			$alert.addClass('hidden');
		}, 10 * 1000);
	}else{
		
	}

}
function tmpay($e,$txid){
	$.get($base_url + 'api/payment/checktrue/' + $txid, function(data){
		if(data.msg == 'pending'){
			Alert($e, 'info', 'ระบบกำลังตรวจสอบบัตร ' + $loading);
			setTimeout(function(){
				tmpay($e,$txid);
			}, 2000);
		}else{
			if(data){
				$('input[name="' + data.csrf.name + '"]').val(data.csrf.hash);
				Alert($e, 'info', data.msg);
				ChangeUser();
				$('button[type="submit"]').attr('disabled', false);
				return true;
			}else{
				location.reload();
				return false;
			}
		}
	}, 'json');
}
$(document).ready(function(){
	PageController();
	$('body').on('submit', 'form.engine', function(event) {
		event.preventDefault();
		var $this = $(this);
		var $btn = $('button');
		var $alert = $this.find('.alert');
		$btn.attr('disabled', true);
		Alert($alert, 'info', 'ระบบกำลังทำงาน ' + $loading);
		$.post($base_url + $this.attr('action'), $this.serializeArray(), function(data) {
			$('input[name="' + data.csrf.name + '"]').val(data.csrf.hash);
			if(data.status == "checktruemoney"){
				tmpay($alert,data.txid);
				ChangeUser();
				return false;
			}
			if(data.msg){
				if(data.status == true){
					Alert($alert, 'success', data.msg);
				}else{
					Alert($alert, 'danger', data.msg);
				}
			}
			if(data.reload){
				PageController();
			}
			if(data.redirect){
				switch(data.redirect){
					case 'back':
					window.history.back();
					break;
					case window.location:
					case 'reload':
					location.reload();
					break;
					default:
					location.href = data.redirect;
					break;
				}
			}
			$btn.attr('disabled', false);
		}, 'json').fail(function(xhr, status, error){
			if(error == "Forbidden"){
				PageController();
			}
			Alert($alert, 'danger', 'Ajax Request : ' + error);
			$btn.attr('disabled', false);
		});
	});
	$('body').on('click', '.change-page', function(event) {
		event.preventDefault();
		var $act = $(this).attr('href');
		ChangePage($act);
	});
	$('body').on('click', '.btn-password', function(e){
		e.preventDefault();
		var $target = $('#regis_password');
		if($target.attr('type') == 'password'){
			$target.attr('type', 'text');
		}else{
			$target.attr('type', 'password');
		}
	});



});
