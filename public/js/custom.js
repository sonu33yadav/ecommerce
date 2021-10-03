(function($) {
    "use strict";

// ______________ PAGE LOADING
	$(window).on("load", function(e) {
		$("#global-loader").fadeOut("slow");
	})

	// ______________ BACK TO TOP BUTTON

	$(window).on("scroll", function(e) {
    	if ($(this).scrollTop() > 300) {
            $('#back-to-top').fadeIn('slow');
        } else {
            $('#back-to-top').fadeOut('slow');
        }
    });

    $("#back-to-top").on("click", function(e){
        $("html, body").animate({
            scrollTop: 0
        }, 600);
        return false;
    });

	$(".vscroll").mCustomScrollbar();
	$(".app-sidebar").mCustomScrollbar({
		theme:"minimal",
		autoHideScrollbar: true,
		scrollbarPosition: "outside"
	});
	if ($('.chart-circle').length) {
		$('.chart-circle').each(function() {
			let $this = $(this);

			$this.circleProgress({
			  fill: {
				color: $this.attr('data-color')
			  },
			  size: $this.height(),
			  startAngle: -Math.PI / 4 * 2,
			  emptyFill: '#e8f0fc',
			  lineCap: 'round'
			});
		});
	  }
})(jQuery);

$(function(e) {
		  /** Constant div card */
	  const DIV_CARD = 'div.card';
	  /** Initialize tooltips */
	  $('[data-toggle="tooltip"]').tooltip();

	  /** Initialize popovers */
	  $('[data-toggle="popover"]').popover({
		html: true
	  });
			 /** Function for remove card */
	  $('[data-toggle="card-remove"]').on('click', function(e) {
		let $card = $(this).closest(DIV_CARD);

		$card.remove();

		e.preventDefault();
		return false;
	  });

	  /** Function for collapse card */
	  $('[data-toggle="card-collapse"]').on('click', function(e) {
		let $card = $(this).closest(DIV_CARD);

		$card.toggleClass('card-collapsed');

		e.preventDefault();
		return false;
	  });
	  $('[data-toggle="card-fullscreen"]').on('click', function(e) {
		let $card = $(this).closest(DIV_CARD);

		$card.toggleClass('card-fullscreen').removeClass('card-collapsed');

		e.preventDefault();
		return false;
	  });

	  let url = window.location.href;
	  if(url.includes('login'))
	      $('#loginModal').modal('show');
      else if(url.includes('register'))
          $('#registerModal').modal('show');
      else if(url.includes('email/verify'))
          localStorage.removeItem('status');
      else if(url.includes('password/reset/'))
          $('#pResetModal').modal('show');
      else if(url.includes('password/reset'))
          $('#pEmailModal').modal('show');

      changeStatus();
  });

function showLoading() {
    $("#global-loader").fadeIn("slow");
}
function hideLoading() {
    $("#global-loader").fadeOut("slow");
}

function changeStatus() {
    let checked = $("#agree").is(':checked');
    if(checked){
        $('#btn_register').prop('disabled',false);
    }else{
        $('#btn_register').prop('disabled',true);
    }
}

function generateRandom(length) {
    var result           = '';
    var characters       = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for ( var i = 0; i < length; i++ ) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
}

