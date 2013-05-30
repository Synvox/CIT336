var compile = function(name, data){
	return $(new EJS({text: $('#ejs-'+name).html()}).render(data));
};

$(function(){
	new Admin();
});

var Admin = (function(){
	
	function Admin(){
		this.begin();
	}
	
	Admin.prototype = {
		begin:function(){
			if (page === null) return;
			$('body').addClass('admin');
			compile('toolbar').prependTo('body')
			this.editables();
			this.toolbar();
		},
		editables: function(){
			var edits = $('[data-page-key]');
			edits.each(function(i,edit){
				edit = $(edit);
				var bars = edit.attr('data-page-key').split('|');
				var attr = {
					id: bars[0],
					key: bars[1],
					markdown: !!Number(bars[2]),
					value: page[bars[1]]
				};
				edit.click(function(){
					var pane = compile('text-editor',attr).appendTo('body');
					pane.find('[data-action="cancel"]').click(function(){
						pane.remove();
					});
				});
			});
		},
		toolbar: function(){
			var toolbar = $('#toolbar');
			$('#toolbar-handle-link').click(function(){
				$('body').toggleClass('open');
			});
			toolbar.find('[data-toggle-action]').each(function(i,ele){
				ele = $(ele);
				var action = ele.attr('data-toggle-action');
				ele.click(function(){
					$.post(relativePath+'page/update',{
						id: page.id,
						key: action,
						value: Number(!Number(page[action]))
					},function(a){
						window.location.reload();
					});
				});
			});
		}
	};
	
	return Admin;
	
})();