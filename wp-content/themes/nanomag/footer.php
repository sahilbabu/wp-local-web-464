<!-- Start footer -->
<footer id="footer-container<?php
if (of_get_option('footer_columns') == 'footer0col') {
    echo esc_attr("_no_footer");
}
?>">

    <?php
    if (of_get_option('footer_columns') == 'footer0col') {
        
    } else {
        ?>
        <div class="footer-columns">
            <div class="row">
                <?php if (of_get_option('footer_columns') == 'footer2col' || of_get_option('footer_columns') == 'footer3col') { ?>
                    <div class="<?php
                    if (of_get_option('footer_columns') == 'footer2col') {
                        echo esc_attr("six columns");
                    } elseif (of_get_option('footer_columns') == 'footer3col') {
                        echo esc_attr("four columns");
                    }
                    ?>"><?php
                             if (is_active_sidebar('footer1-sidebar')) : dynamic_sidebar('footer1-sidebar');
                             endif;
                             ?></div>
                    <div class="<?php
                    if (of_get_option('footer_columns') == 'footer2col') {
                        echo esc_attr("six columns");
                    } elseif (of_get_option('footer_columns') == 'footer3col') {
                        echo esc_attr("four columns");
                    }
                    ?>"><?php
                             if (is_active_sidebar('footer2-sidebar')) : dynamic_sidebar('footer2-sidebar');
                             endif;
                             ?></div>
                <?php } ?>
                <?php if (of_get_option('footer_columns') == 'footer1col' || of_get_option('footer_columns') == 'footer3col') { ?>
                    <div class="<?php
                    if (of_get_option('footer_columns') == 'footer1col') {
                        echo esc_attr("twelve columns");
                    } elseif (of_get_option('footer_columns') == 'footer3col') {
                        echo esc_attr("four columns");
                    }
                    ?>"><?php
                             if (is_active_sidebar('footer3-sidebar')) : dynamic_sidebar('footer3-sidebar');
                             endif;
                             ?></div>
                <?php } ?>
            </div>
        </div>
    <?php } ?>
    <?php
    if (of_get_option('disable_footer_copyright_menu')) {
        
    } else {
        ?>
        <div class="footer-bottom">
            <div class="row">
                <div class="six columns footer-left"> <?php echo esc_attr(of_get_option('copyright')); ?></div>
                <div class="six columns footer-right">                  
                    <?php $footer_menu = array('theme_location' => 'Footer_Menu', 'depth' => 1, 'container' => false, 'menu_class' => 'menu-footer', 'menu_id' => '', 'fallback_cb' => false); ?>
                    <?php wp_nav_menu($footer_menu); ?>             
                </div>
            </div>  
        </div>
    <?php } ?>  
</footer>
<!-- End footer -->
<?php
$tracking_code = of_get_option('google_analytics_code');
if (!empty($tracking_code)) {
    echo '<script>' . esc_js($tracking_code) . '</script>';
}
?>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-63060236-1', 'auto');
  ga('send', 'pageview');
</script>

<!-- Histats.com  START (hidden counter)-->
<script type="text/javascript">document.write(unescape("%3Cscript src=%27http://s10.histats.com/js15.js%27 type=%27text/javascript%27%3E%3C/script%3E"));</script>
<a href="http://www.histats.com" target="_blank" title="free hit counter" ><script  type="text/javascript" >
try {Histats.start(1,3039393,4,0,0,0,"");
Histats.track_hits();} catch(err){};
</script></a>
<noscript><a href="http://www.histats.com" target="_blank"><img  src="http://sstatic1.histats.com/0.gif?3039393&101" alt="free hit counter" border="0"></a></noscript>
<!-- Histats.com  END  -->

</div>

<div id="go-top"><a href="#go-top"><i class="fa fa-chevron-up"></i></a></div>
<?php wp_footer(); ?>
<?php if (!is_front_page()) { ?>
    <div id="fb-root"></div>
    <script>(function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id))
                return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&appId=1459918874245839&version=v2.0";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
<?php } ?>
</body>
</html>