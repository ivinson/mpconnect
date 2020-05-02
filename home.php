<!doctype html> 
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="description" content="Sample illustrating the use of the Web Application Manifest.">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>MPC Connect</title>

    <link rel="manifest" href="manifest.json">
    <!-- See https://developers.google.com/web/updates/2014/11/Support-for-theme-color-in-Chrome-39-for-Android -->
    <meta name="theme-color" content="#db5945">

    <link rel="icon" href="favicon.ico">

    <link rel="stylesheet" href="../styles/main.css">
  </head>

  <body>
    <h1>MPC Connect</h1>
    <p>Available in <a href="https://www.chromestatus.com/feature/6488656873259008">Chrome 39+</a></p>

    <h3>Hey! I'm a web app!</h3>

    <p>
      In lieu of the <code>&lt;meta></code> and <code>&lt;link></code> elements used in
      <a href="https://github.com/GoogleChrome/samples/blob/gh-pages/placeholder-name/index.html#L31">other samples</a>,
      I'm using a <a href="http://w3c.github.io/manifest/">web application manifest</a> via a
      <code>&lt;link rel="manifest" href="<a href="manifest.json">manifest.json</a>"></code> tag in my <code>&lt;head></code>.
    </p>


    <p>
      Try me out in Chrome 39+ on Android: from Chrome's menu, select
      <strong>Add to homescreen</strong>.
    </p>

    <p>
      When you tap the new icon on your homescreen, I'll launch as a standalone app,
      with the page displayed in landscape orientation.
    </p>

    <script>
      /* jshint ignore:start */
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
      ga('create', 'UA-53563471-1', 'auto');
      ga('send', 'pageview');
      /* jshint ignore:end */
    </script>
    <!-- Built with love using Web Starter Kit -->
  </body>
</html>