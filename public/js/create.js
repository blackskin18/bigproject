$('#btnAdd').click(function (e) {
  	var nextTab = $('#tabs li').size()+1;
	
  	// create the tab
  	$('<li><a href="#tab'+nextTab+'" data-toggle="tab">Tab '+nextTab+'</a></li>').appendTo('#tabs');
  	
  	// create the tab content
  	$('<div class="tab-pane" id="tab'+nextTab+'">tab' +nextTab+' content</div>').appendTo('.tab-content');
  	
  	// make the new tab active
  	$('#tabs a:last').tab('show');
}); 	