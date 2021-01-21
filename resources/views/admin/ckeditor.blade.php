<script src="/ckeditor/ckeditor.js"></script>
<script>
	CKEDITOR.editorConfig = function(config) {
		config.toolbarGroups = [
			{ name: 'clipboard', groups: ['clipboard', 'undo'] },
			{ name: 'editing', groups: ['find', 'selection', 'spellchecker'] },
			{ name: 'links' },
			{ name: 'insert' },
			{ name: 'forms' },
			{ name: 'tools' },
			{ name: 'document', groups: ['mode', 'document', 'doctools'] },
			{ name: 'others' },
			'/',
			{ name: 'basicstyles', groups: ['basicstyles', 'cleanup'] },
			{ name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi'] },
			{ name: 'styles' },
			{ name: 'colors' },
			{ name: 'about' }
		];
		config.removeButtons = 'Underline,Subscript,Superscript';
		config.format_tags = 'p;h1;h2;h3;pre';
		config.removeDialogTabs = 'image:advanced;link:advanced';
		config.allowedContent = true;
		config.extraPlugins = ['filebrowser', 'uploadimage'];
		config.uploadUrl = "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
		config.height = '400px';
	};
	const textarea = document.getElementById('ckeditor-textarea');
	if (textarea) {
		CKEDITOR.replace(textarea.id, {
			filebrowserBrowseUrl: "{{route('ckeditor.browse')}}",
			filebrowserUploadUrl : "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
		});
	}
</script>