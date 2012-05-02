<!DOCTYPE html>
<html>
  <head>
    <meta charset='utf-8'>
    <meta content='chrome=1' http-equiv='X-UA-Compatible'>
    <title><?php echo $this->title;?>Fideloper Blog</title>
    <link href='/css/styles.css' rel='stylesheet'>
    <meta content='width=device-width, initial-scale=1, user-scalable=no' name='viewport'>
    <!--[if lt IE 9]>
      <script src='//html5shiv.googlecode.com/svn/trunk/html5.js'></script>
    <![endif]-->
  </head>
  <body>
    <div class='wrapper'>
      <header>
        <h1>Fideloper</h1>
        <!-- <p><img src="/img/colors_horiz.png" alt="" /></p> -->
        <p>
          <em>Publishing what I learn</em>
        </p>
      </header>
      <section>
        <?php if($this->date !== '') : ?><time><?php echo $this->date; ?></time><?php endif; ?>
        <?php echo $this->content?>
      </section>
      <footer>
        <p>
          <?php /* <a class='twitter-share-button' data-via='fideloper' href='https://twitter.com/share'>Tweet</a> */ ?>
           <a class='twitter-follow-button' data-show-count='false' href='https://twitter.com/fideloper'>Follow @fideloper</a>
        </p>
        <ul>
          <li>Find my code on <a href="https://github.com/fideloper">Github</a>.</li>
          <li>Follow me on <a href="https://twitter.com/fideloper">Twitter</a>.</li>
          <li>Created by <a href="http://chrisfidao.com">Chris Fidao</a>.</li>
          <li>Site design <em>borrowed</em> from Github <a href="http://pages.github.com">Pages</a>.</li>
        </ul>
      </footer>
    </div>
    <script src='/js/scale.fix.js'></script>
    <script src='//platform.twitter.com/widgets.js'></script>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-20914866-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
  </body>
</html>
