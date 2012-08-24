//==============================================================
// CUSTOM SCRIPTS
// Author: Last Door Solutions (http://lastdoorsolutions.com)
// 2011
// ==============================================================


jQuery(document).ready(function() {
	
// For Primary Navigation	
var minHt = 28; // Minimum height for Navigation
var ulHt = getTotalHt(jQuery('#primary-nav').find('ul')); // Getting the height of Navigation
//alert(ulHt);

if( minHt < ulHt ) {
	jQuery('#btn-nav-opt').show();
	}

//==============================================================
// WordPress specialist:
// get Widget title as a widget class
// ==============================================================

jQuery('.widget').each( function(){
	var widgetTitle = jQuery(this).find('.widget-title').text();
	var widgetTitleSlug = widgetTitle.replace(/ /gi, "-");
	widgetTitleSlug = widgetTitleSlug.toLowerCase();
	widgetTitleSlug = "widget-" + widgetTitleSlug;
	jQuery(this).addClass(widgetTitleSlug);
});


//==============================================================
// get Sticky menu
// ==============================================================
jQuery(window).scroll( function() {
	if (jQuery(window).scrollTop() > getTotalHt('#header')){
		jQuery('#primary-nav').addClass('fixed');
		jQuery('.btn-top').addClass('fixed');
		
	} else {
		jQuery('#primary-nav').removeClass('fixed');
		jQuery('.btn-top').removeClass('fixed');
	}
} );


//==============================================================
// Toggle Height of the Primary Navigation
// =============================================================
jQuery('#btn-nav-opt').toggle(
	function(){
		jQuery('#primary-nav .sixteen').animate({ 'height' : ulHt });
		jQuery(this).addClass('up');
	},
function(){
	jQuery('#primary-nav .sixteen').animate({ 'height' : minHt } );
	jQuery(this).removeClass('up');
	}
);

	

	
});
// end ready function here.

//==============================================================
// Goto Perticular Point
// ==============================================================
function pageScroll(scrollPoint){ // obj: click object, scrollPoint:Location to reach on page scroll
    var divOffset = jQuery(scrollPoint).offset().top;      
    jQuery('html,body').animate({scrollTop: divOffset}, 500); 
}

//==============================================================
// jQuery isotope
// ==============================================================

  jQuery.Isotope.prototype._masonryResizeChanged = function() {
    return true;
  };

  jQuery.Isotope.prototype._masonryReset = function() {
    // layout-specific props
    this.masonry = {};
    this._getSegments();
    var i = this.masonry.cols;
    this.masonry.colYs = [];
    while (i--) {
      this.masonry.colYs.push( 0 );
    }
  
    if ( this.options.masonry.cornerStampSelector ) {
      var $cornerStamp = this.element.find( this.options.masonry.cornerStampSelector ),
          stampWidth = $cornerStamp.outerWidth(true) - ( this.element.width() % this.masonry.columnWidth ),
          cornerCols = Math.ceil( stampWidth / this.masonry.columnWidth ),
          cornerStampHeight = $cornerStamp.outerHeight(true);
    //  for ( i = Math.max( this.masonry.cols - cornerCols, cornerCols ); i < this.masonry.cols; i++ ) {
		for ( i = ( this.masonry.cols - cornerCols ); i < this.masonry.cols; i++ ) {
        this.masonry.colYs[i] = cornerStampHeight;
      }
    }
  };

jQuery(function(){
var $container = jQuery('#post-listing');
$container.isotope({
	 itemSelector: '.item',
	// resizable: false,
	 masonry : {
        cornerStampSelector: '.corner-stamp',
		//columnWidth: 240
		columnWidth: $container.width() / 4
		
      }
});

var selector = '';
jQuery('.nav-listing li a').click(function(){

  selector = jQuery(this).attr('data-filter');
  $container.isotope({ filter: selector });
  
  
  
 jQuery('.nav-listing li a').removeClass('selected');
	jQuery(this).addClass('selected');
	
	//calling append function
	appenditem(this.id);
  return false;
});


jQuery('#get-cats').change(function(){

  var selector = jQuery(this).val();
  $container.isotope({ filter: selector });
  
  return false;
}); 
 
});

// update columnWidth on window resize
    jQuery(window).smartresize(function(){
		var $container = jQuery('#post-listing');
      $container.isotope({
        // set columnWidth to a percentage of container width
        masonry: {
          columnWidth: $container.width() / 4
        }
      });
    });


//==============================================================
// Get Total Height
// ==============================================================

function getTotalHt(obj, addPadding, addMargin, addBorder){
    addPadding = typeof addPadding == 'undefined' ? 1 : addPadding;
    addMargin = typeof addMargin == 'undefined' ? 1 : addMargin;
    addBorder = typeof addBorder == 'undefined' ? 1 : addBorder;
    
    var totalHt = jQuery(obj).height();
    if( addPadding == 1){
    totalHt += parseInt(jQuery(obj).css('padding-top'));
    totalHt += parseInt(jQuery(obj).css('padding-bottom'));
    }
    if( addMargin == 1){
    totalHt += parseInt(jQuery(obj).css('margin-top'));
    totalHt += parseInt(jQuery(obj).css('margin-bottom'));
    }
    if( addBorder == 1){
    totalHt += parseInt(jQuery(obj).css('borderTopWidth'));
    totalHt += parseInt(jQuery(obj).css('borderBottomWidth'));
    }
    
    return totalHt;
}

//==============================================================
// iPhone Safari viewport scaling bug fixing
// ==============================================================
(function(doc) {

	var addEvent = 'addEventListener',
	    type = 'gesturestart',
	    qsa = 'querySelectorAll',
	    scales = [1, 1],
	    meta = qsa in doc ? doc[qsa]('meta[name=viewport]') : [];

	function fix() {
		meta.content = 'width=device-width,minimum-scale=' + scales[0] + ',maximum-scale=' + scales[1];
		doc.removeEventListener(type, fix, true);
	}

	if ((meta = meta[meta.length - 1]) && addEvent in doc) {
		fix();
		scales = [.25, 1.6];
		doc[addEvent](type, fix, true);
	}

}(document));