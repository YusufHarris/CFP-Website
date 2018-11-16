/*
 * Scrolls to the anchors on the page
 */
$(".scroll").click(function(event){
        event.preventDefault();
        //calculate destination place
        var dest=0;
        if($(this.hash).offset().top > $(document).height()-$(window).height()){
             dest=$(document).height()-$(window).height();
        }else{
             dest=$(this.hash).offset().top - 40;
        }
        //go to destination
        $('html,body').animate({scrollTop:dest}, 1000,'swing');
    });

/*
 * Inserts the leaflet map into the Contact section
 */
var map = L.map('office-map').setView([-5.046, 39.716], 10);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
}).addTo(map);

L.marker([-5.046, 39.716]).addTo(map)
    .bindPopup('CFP\'s<br> Rural Innovation Campus')
    .openPopup();

/*
 * Changes the background color of the navigation bar when the user scrolls
 */
$(document).ready(function(){
    var scroll_start = 0;
    var startchange = $('#cfp-title');
    var offset = startchange.offset();
    if (startchange.length){
        $(document).scroll(function() {
            scroll_start = $(this).scrollTop();
            if(scroll_start > offset.top) {
                $('.nav-welcome-bg').css('background', 'linear-gradient(to top,  rgba(0,0,0,0) 0%,rgba(0,0,0,0.1) 60%)');
                $('.nav-welcome-bg').css('background-color', '#28a745');
                $('.nav-welcome-bg').css('transition', 'background-color 200ms linear');
            } else {
                $('.nav-welcome-bg').css('background-color', 'transparent');
                $('.nav-welcome-bg').css('background', 'linear-gradient(to top,  rgba(0,0,0,0) 0%,rgba(0,0,0,0.5) 30%)');
                $('.nav-welcome-bg').css('transition', 'background-color 200ms linear');
            }
        });
    }
});
