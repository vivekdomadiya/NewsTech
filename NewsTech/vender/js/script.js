// copy alert

$(document).ready(function(){
  	$("#copy-btn").on("click", function(){
		let msg= `<div data-notify="container" class="col-xs-11 col-sm-4 alert alert-success animated fadeInDown copy-alt" role="alert" data-notify-position="top-center">`;
		msg += `<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>`;
		msg += `<i class="far fa-check-circle"></i></span> <span data-notify="title">Link copied to clipboard:</span>`;
		msg += `<span data-notify="message">https://drive.google.com/uc?export=download&amp;id=1SwIjmi-3hxmEDNU1OMCU2m3RQdsrkPVO</span>`;
		msg += `<a href="https://drive.google.com/uc?export=download&amp;id=1SwIjmi-3hxmEDNU1OMCU2m3RQdsrkPVO" target="_blank" data-notify="url"></a>`;
		msg += `</div>`; 

		$("body").append(msg);
	});
});
