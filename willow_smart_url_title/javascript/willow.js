$(function() {
	var willow_smart_url_title_act = 0;
	var href = window.location.href;
	var entry_id = 0;
	var channel_id = 0;

	// Set the entry ID if on an edit page

	if (href.indexOf('/cp/publish/edit/') !== -1) entry_id = href.substr(href.lastIndexOf('/') + 1);

	// Set the channel ID if creating a new entry

	if (href.indexOf('/cp/publish/create/') !== -1) channel_id = href.substr(href.lastIndexOf('/') + 1);

	$('body').on('blur', 'input[name=title], input[name=url_title]', function (e) {
		var url_title = $('input[name=url_title]').val();
		var post_data = 'ACT=' + willow_smart_url_title_act + '&url_title=' + url_title + '&channel_id=' + channel_id + '&entry_id=' + entry_id;
		$.ajax({
		    url: '/',
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
		   				// Force EE to revalidate field
						$('input[name=url_title]').trigger('blur');
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
