// Custom sorting plugin
(function($) {
  $.fn.sorted = function(customOptions) {
    var options = {
      reversed: false,
      by: function(a) { return a.text(); }
    };
    $.extend(options, customOptions);
    $data = $(this);
    arr = $data.get();
    arr.sort(function(a, b) {
      var valA = options.by($(a));
      var valB = options.by($(b));
      if (options.reversed) {
        return (valA < valB) ? 1 : (valA > valB) ? -1 : 0;				
      } else {		
        return (valA < valB) ? -1 : (valA > valB) ? 1 : 0;	
      }
    });
    return $(arr);
  };
})(jQuery);


$(document).ready(function(){

  var $filterType = $('#people_filter li');
  var $applications = $('#list');
  var $data = $applications.clone();
  
  // attempt to call Quicksand on every form change
    if ($('#people_filter li.selected').attr('data-value') != 'all') {
	  $('#list li').hide();
	  $('#list li.'+$('#people_filter li.selected').attr('data-value')).show();
    }

  $filterType.click(function(e) {
	$('#people_filter li').removeClass('selected');
	$(this).addClass('selected');
    if ($(this).attr('data-value') == 'all') {
		var $filteredData = $data.find('li');
		//$('#list').find('li').show();
    } else {
		var $filteredData = $data.find('li.' + $(this).attr('data-value'));
		//$('#list li').hide();
		//$('#list').find('li.' + $(this).attr('data-value')).show(500);
    }
	
    //call quicksand
    $applications.quicksand($filteredData, {
      duration: 800,
      //easing: 'easeInOutQuad',
	  adjustHeight: 'auto',
	  useScaling: false
    });
  });
});