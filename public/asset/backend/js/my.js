jQuery.noConflict();

(function ( $ ) {
	$.fn.multiLang = function( options ) {
		var settings = $.extend({
			target: ".myLanguage",
		}, options );

		var elem = this;

		this.find('a').on('click', function( e ) {
			var index = $(this).attr('data-index');
			elem.find('a').removeClass('pj-form-langbar-item-active');
			$(this).addClass('pj-form-langbar-item-active');
			elem.find('a.pj-form-langbar-item[data-index="'+index+'"]').addClass('pj-form-langbar-item-active');
			$(settings.target).hide();
			$(settings.target+'[data-id="'+index+'"]').show();
			return false;
		})

		return this;
	};

	$.fn.tambahData = function( options ) {
		var settings = $.extend({
			targetHtml: '',
			html: '',
			tambahkan: '',
		}, options );

		var elem = this;
		if (settings.targetHtml == '') {
			var targetHtml = settings.html;
		} else{
			var targetHtml = $(settings.targetHtml).html();
		};
		$(settings.targetHtml).html('');
		$(settings.tambahkan).append(targetHtml);

		this.on('click', function( e ) {
			$(settings.tambahkan).append(targetHtml);

			return false;
		})

		return this;
	};

	$.fn.setStatusAjax = function( options ) {
		var settings = $.extend({
			content: '',
			contentOK: '',
			class: '',
			classOK: '',
		}, options );

		var elem = this;
		// console.log(elem);
		jQuery.each( elem, function( i, val ) {
			if ($(val).attr('data-id')==1) {
				$(val).html(settings.contentOK);
				$(val).removeClass(settings.class);
				$(val).addClass(settings.classOK);
			} else{
				$(val).html(settings.content);
				$(val).removeClass(settings.classOK);
				$(val).addClass(settings.class);
			};
			var url = $(val).attr('href');
			$(val).on('click', function( e ) {
				var element = this;
				$.ajax({
					type: "POST",
					url: url,
					data: '&ajax=ok',
					dataType: 'json',
				})
				.done(function( msg ) {
					if (msg==1) {
						$(element).html(settings.contentOK);
						$(element).removeClass(settings.class);
						$(element).addClass(settings.classOK);
					} else{
						$(element).html(settings.content);
						$(element).removeClass(settings.classOK);
						$(element).addClass(settings.class);
					};
				});
				return false;
			})
		});


		return false;
	};

	$.fn.validationAjax = function( options ) {
		var settings = $.extend({
			// target: ".myLanguage",
			success : function() {},
		}, options );

		var elem = this;

		this.on('submit', function( e ) {
			url = elem.attr('action');
			$("#"+elem.attr('id'))
				.find('.control-group')
				.removeClass('error')
				.find('._em_').hide();
			$("#"+elem.attr('id')+"_es_").hide();
			$.ajax({
				type: "POST",
				url: url,
				data: elem.serialize()+'&ajax='+elem.attr('id'),
				dataType: 'json',
			})
			.done(function( msg ) {
				$('#'+elem.attr('id')+'_es_').show();
				$('#'+elem.attr('id')+'_es_').find('ul').html('');
				var error = true;
				$.each(msg, function( index, value ) {
					if (index >= 0) {
						$.each(value, function( i, v ) {
							error = false;
							$('#'+elem.attr('id')+'_es_').find('ul').append('<li>'+v+'</li>');
							$('#'+i).parent().addClass('error').find('._em_').show().html(v);
						});

					}else{
						error = false;
						$('#'+elem.attr('id')+'_es_').find('ul').append('<li>'+value+'</li>');
						$('#'+index).parent().addClass('error').find('._em_').show().html(v);
					};

				});				
				if (error == true) {
					$('#'+elem.attr('id')+'_es_').hide();
					settings.success.call( elem );
					return e;
				}else{
					e.preventDefault();
				};
			});
			return false;
			
		})

		return this;
	};

	$.fn.deleteAjax = function( options ) {
		var elem = this;
		jQuery.each( elem, function( i, val ) {
			var url = $(val).attr('href');
			$(val).on('click', function( e ) {
				if(!confirm('Are you sure you want to delete this item?')) return false;
				var element = this;
				$.ajax({
					type: "POST",
					url: url,
					data: '&ajax=ok',
					dataType: 'json',
				})
				.done(function( msg ) {
					location.reload(true);
				});
				return false;
			})
		});


		return false;
	};

}( jQuery ));