  </main>
  <!-- 复用的底部 -->
  <footer class="footer">
    <div class="container">
      <div class="row">
        <div class="col-12">
            <?php wp_nav_menu(
              array(
                'theme_location'  => 'about',
                'container_class' => 'text-left',
                'container_id'    => 'about',
                'menu_class'      => 'nav',
                'fallback_cb'     => '',
                'menu_id'         => 'about',
                'walker'          => new WP_Bootstrap_Navwalker(),
              )
            ); ?>
        </div>

        <div class="col-12">
        <p class="text-muted">&copy; 2012-2017 轻主题. <a href="http://www.miitbeian.gov.cn/publish/query/indexFirst.action" rel="nofollow">京ICP备13034327号-1</a></p>
        </div>
      </div>
    </div>
  </footer>

  <?php wp_footer(); ?>
</body>
</html>
