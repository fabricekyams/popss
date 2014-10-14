(function($){
	
	$("").click(function(){
		console.log("je en devrai pas recharger");
		
		$.ajax({
			url: "",
			success: function (data){
				console.log(data);
				}
			});
		
		return false;
	});

})(jQuery);
