(function( $ ) {
    "use strict";

    $(document).ready(function () {
        // Create the search box and link it to the UI element.
        $.each($('.ct-marker-search-form'), function (index, el) {
        	var input = $(el).find('.ct-marker-search-input').get(0);
	        var searchBox = new google.maps.places.SearchBox(input);

	        // Listen for the event fired when the user selects a prediction and retrieve
	        // more details for that place.
	        searchBox.addListener('places_changed', function() {
	            var places = searchBox.getPlaces();
                console.log(places);

	            places.forEach(function(place, index) {
	                if (!place.geometry || index > 0) {
	                    return;
	                }
	                $(el).find("#ct-marker-search-lat").val(place.geometry.location.lat());
	                $(el).find("#ct-marker-search-lng").val(place.geometry.location.lng());
	            });
	        });
        });

        $(".btn-marker-category").on("click", function () {
        	$(".btn-marker-category").removeClass("active");
        	$(this).addClass("active");
        	var target = $(this).data("target");
        	$(target).trigger("click");
        });

        $(".ct-marker-search-button").on("click", function () {
            if($("#ct-marker-search-input").val() === ""){
                $("#ct-marker-search-input").addClass("input-empty");
                return false;
            }
            $("#ct-marker-search-input").removeClass("input-empty");
        	var form = $(this).parents("form").get(0);
        	var formData = new FormData(form);
        	for(var pair of formData.entries()) {
			   console.log(pair[0]+ ', '+ pair[1]); 
			}
			formData.append("action", "get_search_result_ajax");
        	$.ajax({
	            url: cat_ajax_url,
	            type: "POST",
	            beforeSend: function () {
	                
	            },
	            data: formData,
                contentType: false,
                processData: false,
            }).done(function (res) {
           		if(res.status){
           			window.location.href = res.url;
           		}
           		else{
           			alert(res.message);
           		}
            }).fail(function (res) {
            	console.error(res);
            }).always(function () {
                
            });
        });

        $(".ct-marker-search-results .ct-marker-pagination a").on("click", function () {
        	var _this = $(this);
        	if(_this.hasClass("disable")){
        		return false;
        	}
        	var page = _this.data("page");
        	var limit = $("#results-limitation").val();
        	var radius = $("#search-within-radius").val();
        	var url = window.location.origin + window.location.pathname;
        	var formatted_url = URI(url).search({
				page: page,
				limit: limit,
				radius: radius,
			}).toString();
			window.location.href = formatted_url;
        });

        $("#results-limitation").on("change", function () {
        	var page = $("#results-page-input").data("page");
        	var limit = $(this).val();
        	var radius = $("#search-within-radius").val();
        	var url = window.location.origin + window.location.pathname;
        	var formatted_url = URI(url).search({
				page: page,
				limit: limit,
				radius: radius,
			}).toString();
			window.location.href = formatted_url;
        });

        $("#search-within-radius").on("change", function () {
        	var page = $("#results-page-input").data("page");
        	var limit = $("#results-limitation").val();
        	var radius = $(this).val();
        	var url = window.location.origin + window.location.pathname;
        	var formatted_url = URI(url).search({
				page: page,
				limit: limit,
				radius: radius,
			}).toString();
			window.location.href = formatted_url;
        });

        $("#results-page-input").keypress(function (e) {
            if(e.which === 13){
                var page = $("#results-page-input").data("page");
                var limit = $("#results-limitation").val();
                var radius = $("#search-within-radius").val();
                var url = window.location.origin + window.location.pathname;
                var formatted_url = URI(url).search({
                    page: page,
                    limit: limit,
                    radius: radius,
                }).toString();
                window.location.href = formatted_url;
            }
        });
    });

})( jQuery );