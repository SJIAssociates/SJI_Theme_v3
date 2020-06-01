export default {
  init() {
    // JavaScript to be fired on all pages
    function menuMorph(){
			$('.sitewrapper').toggleClass('openNav');
			$('#menuToggle').toggleClass('open');
			$('#mega-nav').toggleClass('open');
		}
		$('#menuToggle').click(menuMorph);
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
