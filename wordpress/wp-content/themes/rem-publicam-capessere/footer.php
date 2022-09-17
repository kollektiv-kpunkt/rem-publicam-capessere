<?php
// get_template_part("/templates/partials/footerCtA");
?>
</div>
<?php
get_template_part("/templates/partials/footer");
?>

<?php
if ($_ENV["DEV"] == 1):
    ?>
    <script src="http://localhost:35729/livereload.js"></script>
<?php
endif;

if (isset($_ENV["MATOMOID"]) && $_ENV["MATOMOID"] != ""):
    ?>
<script>
  var _paq = window._paq = window._paq || [];
  _paq.push(['requireConsent']);
  /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
  _paq.push(['trackPageView']);
  _paq.push(['enableLinkTracking']);
  (function() {
    var u="<?= $_ENV["MATOMOURL"] ?>";
    _paq.push(['setTrackerUrl', u+'matomo.php']);
    _paq.push(['setSiteId', '<?= $_ENV["MATOMOID"] ?>']);
    var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
    g.async=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
  })();
</script>
<?php
endif;
?>


<?php
wp_footer();
?>

</body>
</html>