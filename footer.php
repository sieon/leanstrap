  </main>
  <!-- 复用的底部 -->

  <hr>
  <footer>
    <div class="container">
      <p>&copy; 2012-2017 轻主题. <a href="http://www.miitbeian.gov.cn/publish/query/indexFirst.action" rel="nofollow">京ICP备13034327号-1</a></p>
    </div>
  </footer>



  <?php wp_footer(); ?>

  <script>
    var _content = []; //临时存储li循环内容
    var lean = {
      _default:20, //默认显示图片个数
      _loading:10,  //每次点击按钮后加载的个数
      init:function(){
        var lis = $(".main-content .hidden .entry");
        $(".main-content .more-list").html("");
        for(var n=0;n<lean._default;n++){
          lis.eq(n).appendTo(".main-content .more-list");
        }
        $(".main-content .more-list .entry").each(function(){
          $(this).attr('src',$(this).attr('realSrc'));
        })
        for(var i=lean._default;i<lis.length;i++){
          _content.push(lis.eq(i));
        }
        $(".main-content .hidden").html("");
      },
      loadMore:function(){
        var mLis = $(".main-content .more-list .entry").length;
        for(var i =0;i<lean._loading;i++){
          var target = _content.shift();
          if(!target){
            $('.main-content .load-more').html("<p>全部加载完毕...</p>");
            break;
          }
          $(".main-content .more-list").append(target);
          $(".main-content .more-list .entry").eq(mLis+i).each(function(){
            $(this).attr('src',$(this).attr('realSrc'));
          });
        }
      }
    }
    lean.init();
  </script>
    <!--代码部分end-->
</body>
</html>
