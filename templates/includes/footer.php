<footer id="footer" class="clearfix">
  <div id="footer-section">
    <div class="content">
      <div class="footer-column">
        <div class="footer-inner-column">
        <?php print theme('links__system_main_menu', array(
          'links' => $main_menu,
          'attributes' => array(
            'id' => 'main-menu',
            'class' => array(
              'footer-menu-50',
              'links',
              'clearfix',
            ),
          ),
          'heading' => array(
            'text' => t('MAP'),
            'level' => 'h3',
            'class' => array(
              'footer-menu-heading',
            ),
          ),
        )); ?>
        <?php print theme('links', array(
          'links' => menu_navigation_links('menu-main-menu-level-2'),
          'attributes' => array(
            'class'=> array(
              'footer-menu-50',
              'right',
              'links',
              'clearfix',
            ),
          ),
          'heading' => array(
            'text' => t('MAP'),
            'level' => 'h3',
            'class' => array(
              'footer-menu-heading',
              'element-invisible',
            ),
          ),
        ));?>
        <?php print theme('links', array(
          'links' => menu_navigation_links('menu-agreements'),
          'attributes' => array(
            'class'=> array(
              'footer-menu-100',
              'links',
              'clearfix',
            )
          ),
          'heading' => array(
            'text' => t('AGREEMENTS'),
            'level' => 'h3',
            'class' => array(
              'footer-menu-heading',
            ),
          ),
        ));?>
        </div>
      </div>
      <div class="footer-column">
        <div class="footer-inner-column">
          <h3 class="footer-menu-heading">CONTACT</h3>
          <p>Office:</p>
          <p>6797 N. High Street</p>
          <p>Columbus, OH 43085</p>
          <h3 class="footer-menu-heading">614.888.7274</h3>
          <p>
            <span class="footer-note">Walk-in &amp; In-Person</span>
            <span class="footer-note">Service also available</span>
          </p>
        </div>
      </div>
      <div class="footer-column">
        <div class="footer-inner-column getting-started">
          <a href="#">Get Started Now</a><br />
          <span>or</span><br />
          <a href="user/login">LOGIN</a>
        </div>
      </div>
      <div class="footer-column">
        <div class="footer-inner-column">
          <h3 class="footer-menu-heading">GET CONNECTED</h3>
          <a href="#facebook">Facebook</a>
          <a href="#twitter">Twitter</a>
          <a href="#google-plus">Google+</a>
        </div>
      </div>
    </div>
    <div id="footer-bottom">
      <p>OhioDuiEval is a subsidiary of Directions Counceling Group<br>Copyright 2014, Directions Counceling Group<br>All Rights Reserved</p>
    </div>
  </div>
</footer>