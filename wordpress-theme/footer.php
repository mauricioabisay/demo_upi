</div>
<div id="mv-scrollify-footer" class="mv-scrollify" style="height: auto !important;">
    <footer class="mv-section">
      <div class="wrapper"></div>
        <div class="row map-site">
          <ul>
              <li>Terminos y Condiciones</li>
              <li>Golf</li>
              <li>Equitacion</li>
          </ul>
        </div>
        <div class="row sponsors">
            <h3>patrocinadores</h3>
            <div class="gallery">
                <div class="sponsor"></div>
                <div class="sponsor"></div>
                <div class="sponsor"></div>
                <div class="sponsor"></div>
                <div class="sponsor"></div>
            </div>
        </div>
    </footer>
</div>
<?php wp_footer(); ?>
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery.post(
            '<?php echo admin_url('admin-ajax.php');?>',
            {
                'action': 'getEvents'
            },
            function(response) {
                var data = JSON.parse(response);
                console.log(data);
            }
        );
    });
</script>
</body>
</html>