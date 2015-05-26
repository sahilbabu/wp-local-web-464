// JavaScript Document
(function ($) {
    if ($("#modal-content").length) {
        jQuery(function ($) {
            var $info = $("#modal-content");
            $info.dialog({
                'dialogClass': 'wp-dialog',
                'modal': true,
                'autoOpen': false,
                'closeOnEscape': false,
                'width': "600px",
                'buttons': {
                    "Close": function () {
                        $(this).dialog('close');
                    }
                }
            });
            $("#open-modal").click(function (event) {
                event.preventDefault();
                $info.dialog('open');
            });
        });
        function validateEmail(email) {
            var reg = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))jQuery/;
            return reg.test(email);
        }

        jQuery(document).ready(function () {
            jQuery("#contact").submit(function (event) {
                event.preventDefault();
                return false;
            });

            jQuery("#send").on("click", function () {
                var emailval = jQuery("#email").val();
                var msgval = jQuery("#msg").val();
                var msglen = msgval.length;
                //                                    var mailvalid = validateEmail(emailval);
                //
                //                                    if (mailvalid == false) {
                //                                        jQuery("#email").addClass("error");
                //                                    }
                //                                    else if (mailvalid == true) {
                //                                        jQuery("#email").removeClass("error");
                //                                    }
                //
                //                                    if (msglen < 4) {
                //                                        jQuery("#msg").addClass("error");
                //                                    }
                //                                    else if (msglen >= 4) {
                //                                        jQuery("#msg").removeClass("error");
                //                                    }

                // if (mailvalid == true && msglen >= 4) {
                // if both validate we attempt to send the e-mail
                // first we hide the submit btn so the user doesnt click twice
                jQuery("#send").replaceWith("<em>sending...</em>");
                jQuery.ajax({
                    type: 'POST',
                    url: '/report-image.php',
                    data: jQuery("#contact").serialize(),
                    success: function (data) {
                        if (data == "true") {
                            jQuery("#contact").fadeOut("fast", function () {
                                jQuery(this).before("<p><strong>Success! Your feedback has been sent, thanks :)</strong></p>");
                                jQuery("#modal-content").dialog('close');
                            });
                        }
                    }
                });
                //    }
            });
        });
    }
    if ($(".mansoryItem").length) {
        $(".mansoryItem img").lazyload({
            effect: 'fadeIn'
        });
    }
    if ($("#mansoryContainer").length) {
        $(window).load(function () {
            setTimeout(function () {
                var container = document.querySelector('#mansoryContainer');
                var msnry = new Masonry(container, {
                    // columnWidth: 10,
                    // gutter: 3,
                    itemSelector: '.mansoryItem'
                });
            }, 1000);
        });
    }
})(jQuery);