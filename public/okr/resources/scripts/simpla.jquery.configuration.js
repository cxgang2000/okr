$(document).ready(function(){
	var heights = $("#main-content").height();
	$(".main-sidebar").css("height",heights+"px");

	/*导航*/
	$(".treeview").hover(function(){
		$(this).find(".side_content").show();
	},function(){
		$(this).find(".side_content").hide();
	})
}); 