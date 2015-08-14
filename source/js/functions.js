function ajax_request(type, url, data) {
	$.ajax({
		type: type,
		url: url,
		data: data,
		success: function(data) {
	        $(".notice-box").hide().fadeIn().html(data);
	    },
	    error: function(xhr, ajaxOptions, thrownError) {
	        $(".notice-box").hide().html(thrownError).fadeIn();
	    }
	});
}