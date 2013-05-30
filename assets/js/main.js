$(function(){
	app = new App()
	app.begin();
});

var App = (function(){
	
	function App(){
		this.isEditing = $('#userbar').length != 0;
		this.userbar = null;
	};
	
	App.prototype = {
		begin: function(){
			// Initialize a UserBar if there is one placed in the DOM for us
			if (this.isEditing == true)
				this.userbar = new UserBar($('#userbar'))
			
			
		},
	};
	
	return App;
})();

var UserBar = (function(){
	
	function UserBar(element){
		this.ele = element;
		this.isOpen = false;
		var self = this;
		this.ele.click(function(e){
			if (e.target === this)
				self.click();
		});
		this.ele.find('a').click(function(){
			self[$(this).data('action')]($(this));
		});
	};
	
	UserBar.prototype = {
		click: function(){
			if (this.isOpen)
				this.close()
			else
				this.open()
		},
		
		open: function(){
			this.isOpen = true;
			this.ele.addClass('active');
		},
		
		close: function(){
			this.isOpen = false;
			this.ele.removeClass('active');
			this.ele.find('.posts, .pages').hide()
		},
		
		showPosts: function(btn){
			var posts = this.ele.find('.posts');
			var pos = btn.position();
			this.ele.find('.pages').hide();
			posts.css({
        position: "absolute",
        top: pos.top + "px",
        left: (pos.left + this.ele.width()) + 40 + "px"
	    }).show();
		},
		
		showPages: function(btn){
			var pages = this.ele.find('.pages');
			var pos = btn.position();
			this.ele.find('.posts').hide();
			pages.css({
        position: "absolute",
        top: pos.top + "px",
        left: (pos.left + this.ele.width()) + 40 + "px"
	    }).show();
		}
	};
	
	return UserBar;
})();