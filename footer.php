  </main>
  <!-- 复用的底部 -->
  <footer class="footer mt-5">
    <div class="container">
      <p class="text-muted">&copy; 2012-2017 轻主题. <a href="http://www.miitbeian.gov.cn/" rel="external nofollow" target="_blank"><?php echo get_option( 'zh_cn_l10n_icp_num' );?></a></p>
    </div>
  </footer>

  <?php wp_footer(); ?>
  <script type="text/javascript">
    $(".sidebar").pin({
      containerSelector: ".container",
      minWidth: 980
    })
  </script>
</body>
</html>
