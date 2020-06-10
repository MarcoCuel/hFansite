function tooltip() {

	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	})

}

function toggleLogin() {

	// $(".btn-login").removeAttr('href');
	
	// $(".show-login").removeAttr('href');
	// $(".show-register").removeAttr('href');

	$('.show-register').on('click', function() {
		$('.toggle-login .login').hide();
		$('.toggle-login .register').show();
	});

	$('.show-login').on('click', function() {
		$('.toggle-login .register').hide();
		$('.toggle-login .login').show();
	});
}


function gifts() {

	function gifts() {
		return Math.floor((Math.random() * 10) + 1);
	}

	function decos() {
		return Math.floor((Math.random() * 6) + 1);
	}

	$(function () {
		$('.col-md-4:nth-child(1) .gift').addClass('box-' + gifts());
		$('.col-md-4:nth-child(1) .gift').addClass('deco-' + decos());
		$('.col-md-4:nth-child(2) .gift').addClass('box-' + gifts());
		$('.col-md-4:nth-child(2) .gift').addClass('deco-' + decos());
		$('.col-md-4:nth-child(3) .gift').addClass('box-' + gifts());
		$('.col-md-4:nth-child(3) .gift').addClass('deco-' + decos());
	})
}

function tags() {

	$('input#tags').selectize({
		delimiter: ',',
		persist: false,
		create: function(input) {
			return {
				value: input,
				text: input
			}
		}
	});

}

function swiper() {

	var swiper = new Swiper('.related', {
		slidesPerView: 1,
		spaceBetween: 16,
		breakpoints: {
			576: {
				slidesPerView: 2,
			},
			768: {
				slidesPerView: 3,
			}
		}
	});
}

function quoteComment() {

	jQuery(document).ready(function($){
		$('.quote-link').on('click',function(){
			var comment_content=$(this).parent().parent().parent().find('.comment-txt').html();
			var comment_author=$(this).parent().parent().parent().parent().find('.author-name').html();
			$('textarea#comment').html('<blockquote><strong>'+comment_author+':</strong>'+comment_content+'</blockquote>');

		});
	});

}

function darkTheme() {

	$('.theme-switch').click(function(e) {
		e.stopPropagation();
	});

	const toggleSwitch = document.querySelector('.theme-switch input[type="checkbox"]');

	function switchTheme(e) {
		if (e.target.checked) {
			document.documentElement.setAttribute('data-theme', 'dark');
			$.cookie('theme', 'dark', {'path': '/'})
		}
		else {
			document.documentElement.setAttribute('data-theme', 'light');
			$.cookie('theme', 'light', {'path': '/'})
		}
	}

	toggleSwitch.addEventListener('change', switchTheme, false);

}

function teste() {
	$('.play').on('click', function() {
		audio = $("#player");
		$('.play').toggleClass('pause');
		audio.prop("muted",!audio.prop("muted"));
	});
}


function audio() {
	if ('mediaSession' in navigator) {

		navigator.mediaSession.metadata = new MediaMetadata({
			title: 'Chuta que é macumba',
			artist: 'Moreno-bombom',
			album: 'Habbid',
			artwork: [
				{ src: 'http://localhost:10000/wp-content/themes/fansite/cover.jpg', sizes: '96x96', type: 'image/jpg' },
				{ src: 'http://localhost:10000/wp-content/themes/fansite/cover.jpg', sizes: '128x128', type: 'image/jpg' },
				{ src: 'http://localhost:10000/wp-content/themes/fansite/cover.jpg', sizes: '192x192', type: 'image/jpg' },
				{ src: 'http://localhost:10000/wp-content/themes/fansite/cover.jpg', sizes: '256x256', type: 'image/jpg' },
				{ src: 'http://localhost:10000/wp-content/themes/fansite/cover.jpg', sizes: '384x384', type: 'image/jpg' },
				{ src: 'http://localhost:10000/wp-content/themes/fansite/cover.jpg', sizes: '512x512', type: 'image/jpg' },
			]
		});

		navigator.mediaSession.setActionHandler('play', function() {});
		navigator.mediaSession.setActionHandler('pause', function() {});
	}
}


// Init

function init() {
	teste();
	tooltip();
	toggleLogin();
	tags();
	swiper();
	quoteComment();
	darkTheme();
	audio();
	// gifts();
}


init();

// var Main = {
// 	Inits: function(){
// 		init();
// 	}
// };

// $('main').page({
// 	'regenerate': function(){
// 		Main.Inits();
// 	}
// });
