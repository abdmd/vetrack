    $( document ).ready(function() {
        $('#navtoggler').click(function () {
            //$('.navbar-nav').toggleClass('slide-in');
            $('.navbar-nav').toggleClass('slide-in');
            $('.side-body').toggleClass('body-slide-in');
            //$('#search').removeClass('in').addClass('collapse').slideUp(200);

            /// uncomment code for absolute positioning tweek see top comment in css
            //$('.absolute-wrapper').toggleClass('slide-in');
            
        });
       
       // Remove menu for searching
       /* $('#search-trigger').click(function () {
            $('.navbar-nav').removeClass('slide-in');
            $('.side-body').removeClass('body-slide-in'); 

            /// uncomment code for absolute positioning tweek see top comment in css
            //$('.absolute-wrapper').removeClass('slide-in');

        }); */

    //confirm dialog
        $( "#dialog" ).dialog({ //set dialog properties
            modal: true,
            bgiframe: true,
            height: 160,
            resizable: false,
            autoOpen: false,
            show: {
                effect: "fade",
                duration: 300
            },
            hide: {
                effect: "drop",
                duration: 500
            }
        });

        $(".confirmDelete").click(function(e) { //if class="confirmDelete", trigger this
            e.preventDefault();
            var theHREF = $(this).attr("href");

            $("#dialog").dialog('option', 'buttons', {
                "Confirm" : function() {
                    window.location.href = theHREF;
                },
                "Cancel" : function() {
                    $(this).dialog("close");
                }
            });

            $("#dialog").dialog("open");
       });
    });