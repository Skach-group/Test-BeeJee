		
        tinymce.init({
            selector: ".editor",			
			theme: 'silver',
			height: 200,
			language: 'ru',
			relative_urls : false,
            remove_script_host : false,
			document_base_url : "/",
			convert_urls:false,
			relative_urls:false,
			branding: false,
			content_style: ".mce-content-body {font-size:14px; font-family:Arial,sans-serif;}",
			fontsize_formats: '8px 10px 12px 14px 16px 18px 20px 22px 24px 26px 28px 30px 32px 34px 36px',			
			verify_html : false,
			extended_valid_elements : 'iframe[*], div[class|style],p[*],object[width|height|classid|codebase|embed|param],param[name|value],embed[param|src|type|width|height|flashvars|wmode]',
			cleanup : false,
			forced_root_block : false,
			force_br_newlines : false,
			force_p_newlines : true,
			plugins : 'paste advlist autolink link lists charmap print preview code hr anchor save insertdatetime table nonbreaking fullscreen wordcount searchreplace',
			paste_remove_styles: true,
			paste_postprocess: function(plugin, args) {
				jQuery(args.node).find('*').each(function(){
					jQuery(this).removeAttr('class');
					jQuery(this).removeAttr('style');
				});
				var whitelist = 'div, p, a, img, table, thead, tbody, tr, td, ul, ol, li, b, em, br';
				jQuery(args.node).find('*').not(whitelist).each(function() {
					var content = jQuery(this).contents();
					jQuery(this).replaceWith(content);
				});				
				jQuery(args.node).find('table').each(function(){
					jQuery(this).addClass('table table-sm table-responsive');
				});				
			},
			image_class_list: [
				{title: 'Default', value: 'img-fluid'},
				{title: 'Изображение в краткое содержание', value: 'img-preview img-fluid'},
				{title: 'Изображение в текст материала', value: 'img-content img-fluid'}],
			resizing : true,
			table_class_list: [
				{title: 'Default', value: 'table table-sm table-responsive'},
				{title: 'Striped', value: 'table table-sm table-responsive table-striped'},
				{title: 'Hover', value: 'table table-sm table-responsive table-hover'}
			],
			table_default_attributes: {
				'class': 'table table-sm table-responsive'
			},
			table_default_styles: {
				'border-collapse': 'collapse',
				'width': '100%'
			},
			table_responsive_width: true,			
			media_filter_html: false,
			contextmenu: "link image imagetools table spellchecker",
			toolbar_drawer: 'sliding',
            toolbar: "paste pastetext | undo redo save | alignleft aligncenter alignright alignjustify | bold italic | link unlink anchor | hr table | fontselect fontsizeselect | bullist numlist | forecolor backcolor | outdent indent blockquote | insertdatetime | nonbreaking code | preview fullscreen | searchreplace wordcount|"						
	});
	
