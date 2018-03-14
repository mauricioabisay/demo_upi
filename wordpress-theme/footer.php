</div>
<div id="mv-scrollify-footer" class="mv-scrollify" style="height: auto !important;">
    <footer class="mv-section">
      <div class="wrapper"></div>
        <div class="row map-site">
            <div class="col">
                <ul>
                    <a href="#"><li>Terminos y Condiciones</li></a>
                    <?php
                      $categories = get_categories(array(
                        'hide_empty' => 0,
                        'orderby' => 'term_id',
                        'order' => 'ASC'
                      ));
                      foreach ($categories as $category) :
                        if ( $category->term_id!==1 && !stristr($category->slug, 'logros') && !stristr($category->slug, 'menu') ):
                    ?>
                          <a href="#<?php echo $category->slug;?>"><li><?php echo $category->name;?></li></a>
                    <?php
                        endif;
                      endforeach;
                    ?>
                </ul>
            </div>
        </div>
        <div class="row sponsors">
            <div class="col"></div>
        </div>
        <div class="row logos">
            <div class="gallery col">
                <?php
                    $sponsors = new WP_Query(array(
                        'post_type' => 'mv-sponsor'
                    ));
                    while($sponsors->have_posts()):
                        $sponsors->the_post();
                        $link = get_post_meta(get_the_ID(), 'mv-sponsor-link', true);
                ?>
                <a href="<?php echo $link;?>"><div class="sponsor" style="background-image: url(<?php echo get_the_post_thumbnail_url();?>);background-size: contain;background-position: center;background-repeat: no-repeat;"></div></a>
                <?php
                    endwhile;
                    wp_reset_postdata();
                ?>
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
    <?php if(is_home()): ?>
    jQuery(document).ready(function () {
      jarallax(document.querySelectorAll('.jarallax'), {
          speed: 0.2
      });
      <?php if (get_option('contact_lat') && get_option('contact_lng')) :?>
      var currentLat = <?php echo get_option('contact_lat');?>;
      var currentLng = <?php echo get_option('contact_lng');?>;
      currentMarker = L.marker([currentLat, currentLng]);

      map = new L.Map('mv-map-contact');
      var osmUrl='http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
      var osmAttrib='Map data © <a href="http://openstreetmap.org">OpenStreetMap</a> contributors';
      var osm = new L.TileLayer(osmUrl, {minZoom: 10, maxZoom: 18, attribution: osmAttrib});

      map.setView(new L.LatLng(currentLat, currentLng), 13);
      map.addLayer(osm);
      map.addLayer(locationsLayer);
      var currentPopup = L.popup({
        autoClose: false,
        closeOnClick: false,
        className: 'current-popup'
      }).setContent("Tú estás aquí");

      currentMarker.addTo(map);//.bindPopup(currentPopup).openPopup();
      map.scrollWheelZoom.disable();
      <?php endif;?>
      var token = '<?php echo get_option('itg-token');?>';
      <?php
        $account = explode('/', get_option('itg'));
        $len = sizeof($account)-2;
      ?>
      var numPhotos = 5;
      jQuery.ajax({
        url: 'https://api.instagram.com/v1/users/search',
        data: {access_token: token, q: '<?php echo $account[$len];?>'},
        type: 'GET',
        success: function(userData) {
          jQuery.ajax({
            url: 'https://api.instagram.com/v1/users/'+userData.data[0].id+'/media/recent',
            dataType: 'jsonp',
            type: 'GET',
            data: {access_token: token, count: numPhotos},
            success: function(data) {
              var i = 1;
              for(x in data.data) {
                jQuery('#mv-itg-'+i).attr('src', ''+data.data[x].images.thumbnail.url+'');
                i++;
              }
            },
            error: function() {
              console.log('Error retrieving data from user account');
            }
          });
        },
        error: function() {
          console.log('Error connecting to Instagram or finding user account');
        }
      });
    });
    <?php endif;?>
</script>
</body>
</html>