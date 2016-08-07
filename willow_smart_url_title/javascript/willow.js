$(function() { 
	var willow_smart_url_title_act = 0;
	var href = window.location.href;
	var entry_id = href.substr(href.lastIndexOf('/') + 1);	
	$('input[name=title], input[name=url_title]').focusout(function() {
		var channel_id = $('select[name=channel_id]').val();
		var url_title = $('input[name=url_title]').val();
		var post_data = 'url_title=' + url_title + '&channel_id=' + channel_id + '&entry_id=' + entry_id;
		$.ajax({
		    url: '/?ACT=' + willow_smart_url_title_act,
		    type: "POST",
		    dataType: "json",
		    data: post_data,
		    success: function(data) 
		    {
		    	var json = $.parseJSON(data);
		    	if (json.found == true)
		    	{
		    		if (json.not_changed == false)
		    		{
		   				$('input[name=url_title]').val(json.url_title);
		    			$('input[name=url_title]').parents('fieldset.col-group').addClass('warned');
						if ($('input[name=url_title]').nextAll('.w-url-warn').length == 0) $('input[name=url_title]').after('<em class="w-url-warn">URL title changed to avoid duplicate</em>');
		   			}

		    		if (json.not_changed == true) 
		    		{
		    			$('input[name=url_title]').parents('fieldset.col-group').addClass('invalid');		    			
						if ($('input[name=url_title]').nextAll('.w-url-error').length == 0) $('input[name=url_title]').after('<em class="w-url-error">Could not change duplicate URL title. Please change it manually.</em>');
		    		}
		    	}
		    },
		});				
		if ($(this).attr('name') == 'url_title')
		{
			$('input[name=url_title]').parents('fieldset.col-group').removeClass('warned');					
			$('input[name=url_title]').nextAll('.w-url-warn, .w-url-error').remove();
		}
	});
});