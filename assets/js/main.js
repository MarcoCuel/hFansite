$(function () {
	$('[data-toggle="tooltip"]').tooltip()
})


$(".show-register").removeAttr('href');
$(".show-login").removeAttr('href');

$('.show-register').on('click', function() {
	$('.toggle-login .login').hide();
	$('.toggle-login .register').show();
});

$('.show-login').on('click', function() {
	$('.toggle-login .register').hide();
	$('.toggle-login .login').show();
});



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


tinymce.init({
	selector: 'textarea.teste',
	menubar: false,
	toolbar: 'bold italic underline strikethrough | fontsizeselect | alignleft aligncenter alignright | numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen	preview save print | insertfile image media template link anchor codesample | ltr rtl',
	toolbar_sticky: true,
});


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
