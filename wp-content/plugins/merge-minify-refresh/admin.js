(function($){
	
	$(function(){
		
		var $mmr_processed = $('#mmr_processed'),
		$mmr_jsprocessed = $('#mmr_jsprocessed',$mmr_processed),
		$mmr_jsprocessed_ul = $('ul',$mmr_jsprocessed),
		$mmr_cssprocessed = $('#mmr_cssprocessed',$mmr_processed),
		$mmr_cssprocessed_ul = $('ul',$mmr_cssprocessed),
		$mmr_noprocessed = $('#mmr_noprocessed'),
		timeout = null,
		stamp = null;
		
		$($mmr_processed).on('click','.log',function(e){
			e.preventDefault();
			$(this).nextAll('pre').slideToggle();
		});
		
		$($mmr_processed).on('click','.purge',function(e){
			e.preventDefault();
			
			clearInterval(timeout);
			getFiles({purge:$(this).attr('href').substr(1)});
			
			$(this).parent().remove();
		});
		
		$('.purgeall',$mmr_processed).on('click',function(e){
			e.preventDefault();
			
			clearInterval(timeout);
			getFiles({purge:'all'});
			
			$mmr_noprocessed.show();
			$mmr_processed.hide();
			
			$mmr_jsprocessed_ul.html('');
			$mmr_cssprocessed_ul.html('');
		});
		
		function getFiles(extra) {
			stamp = new Date().getTime();
			var data = {
				'action': 'mmr_files',
				'stamp': stamp
			};
			if(extra) {
				for (var attrname in extra) { data[attrname] = extra[attrname]; }
			}
	
			
			$.post(ajaxurl, data, function(response) {

				if(stamp == response.stamp) {//only update when request is the latest
					if(response.js.length > 0) { 
						$mmr_jsprocessed.show();
						
						$(response.js).each(function(){
							var $li = $mmr_jsprocessed_ul.find('li.'+this.hash),
							scheduled = '';
							if(this.scheduled) {
								scheduled = ' <span class="dashicons dashicons-clock" title="Compression Scheduled"></span>';
							}
							if($li.length > 0) {
								var $filename = $li.find('.filename');
								if($filename.html() != this.filename+scheduled) {
									$filename.html(this.filename+scheduled);
								}
								if($li.find('pre').html() != this.log) {
									$li.find('pre').html(this.log);
								}
								if(this.error) {
									$filename.addClass('error');
								} else {
									$filename.removeClass('error');
								}
							} else {
								$mmr_jsprocessed_ul.append('<li class="'+this.hash+'"><span class="filename'+(this.error?' error':'')+'">'+this.filename+scheduled+'</span> <a href="#" class="log button button-primary">View Log</a> <a href="#'+this.hash+'" class="button button-secondary purge">Purge</a><pre>'+this.log+'</pre></li>');
							}
						});
						
					} else {
						$mmr_jsprocessed.hide();
					}
					if(response.css.length > 0) {
						$mmr_cssprocessed.show();
						
						$(response.css).each(function(){
							var $li = $mmr_cssprocessed_ul.find('li.'+this.hash),
							scheduled = '';
							if(this.scheduled) {
								scheduled = ' <span class="dashicons dashicons-clock" title="Compression Scheduled"></span>';
							}
							if($li.length > 0) {
								var $filename = $li.find('.filename');
								if($filename.html() != this.filename+scheduled) {
									$filename.html(this.filename+scheduled);
								}
								if($li.find('pre').html() != this.log) {
									$li.find('pre').html(this.log);
								}
								if(this.error) {
									$filename.addClass('error');
								} else {
									$filename.removeClass('error');
								}
							} else {
								$mmr_cssprocessed_ul.append('<li class="'+this.hash+'"><span class="filename'+(this.error?' error':'')+'">'+this.filename+scheduled+'</span> <a href="#" class="log button button-primary">View Log</a> <a href="#'+this.hash+'" class="button button-secondary purge">Purge</a><pre>'+this.log+'</pre></li>');
							}
						});
					} else {
						$mmr_cssprocessed.hide();
					}
					if(response.js.length == 0 && response.css.length == 0) {
						$mmr_noprocessed.show();
						$mmr_processed.hide();
					} else {
						$mmr_noprocessed.hide();
						$mmr_processed.show();
					}
					
					clearInterval(timeout);
					timeout = setTimeout(getFiles, 2000);
				}
			});
		}
		
		getFiles();
		
	});

})(jQuery);