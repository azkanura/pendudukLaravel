<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

  <title>Login - Penduduk App</title>

  <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300&subset=latin" rel="stylesheet" type="text/css">
  <link href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css">
  <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

  <!-- DEMO ONLY: Function for the proper stylesheet loading according to the demo settings -->
  <script>function _pxDemo_loadStylesheet(a,b,c){var c=c||decodeURIComponent((new RegExp(";\\s*"+encodeURIComponent("px-demo-theme")+"\\s*=\\s*([^;]+)\\s*;","g").exec(";"+document.cookie+";")||[])[1]||"clean"),d="rtl"===document.getElementsByTagName("html")[0].getAttribute("dir");document.write(a.replace(/^(.*?)((?:\.min)?\.css)$/,'<link href="$1'+(c.indexOf("dark")!==-1&&a.indexOf("/css/")!==-1&&a.indexOf("/themes/")===-1?"-dark":"")+(!d||0!==a.indexOf("assets/css")&&0!==a.indexOf("assets/demo")?"":".rtl")+'$2" rel="stylesheet" type="text/css"'+(b?'class="'+b+'"':"")+">"))}</script>

  <!-- DEMO ONLY: Set RTL direction -->
  <script>"ltr"!==document.getElementsByTagName("html")[0].getAttribute("dir")&&"1"===decodeURIComponent((new RegExp(";\\s*"+encodeURIComponent("px-demo-rtl")+"\\s*=\\s*([^;]+)\\s*;","g").exec(";"+document.cookie+";")||[])[1]||"0")&&document.getElementsByTagName("html")[0].setAttribute("dir","rtl");</script>

  <!-- DEMO ONLY: Load PixelAdmin core stylesheets -->
  <script>
    _pxDemo_loadStylesheet("{{asset('css/bootstrap.min.css')}}", 'px-demo-stylesheet-bs');
    _pxDemo_loadStylesheet("{{asset('css/pixeladmin.min.css')}}", 'px-demo-stylesheet-core');
  </script>

  <!-- DEMO ONLY: Load theme -->
  <script>
    function _pxDemo_loadTheme(a){var b=decodeURIComponent((new RegExp(";\\s*"+encodeURIComponent("px-demo-theme")+"\\s*=\\s*([^;]+)\\s*;","g").exec(";"+document.cookie+";")||[])[1]||"clean");_pxDemo_loadStylesheet(a+b+".min.css","px-demo-stylesheet-theme",b)}
    _pxDemo_loadTheme("{{asset('css/themes/')}}");
  </script>

  <!-- Demo assets -->
  <script>_pxDemo_loadStylesheet("{{asset('demo/demo.css')}}");</script>
  <!-- / Demo assets -->

  <!-- Pace.js -->
  <script src="{{asset('pace/pace.min.js')}}"></script>

  <script src="{{asset('demo/demo.js')}}"></script>

  <!-- Custom styling -->
  <style>
    body{
      /*background: url('https://unsplash.com/photos/MyfSxRrKN9E/download?force=true');*/
      background: url("{{asset('images/bg-login.jpg')}}");
      background-size: cover;
      background-position: center;
    }
    .page-signin-header {
      box-shadow: 0 2px 2px rgba(0,0,0,.05), 0 1px 0 rgba(0,0,0,.05);
    }

    .page-signin-header .btn {
      position: absolute;
      top: 12px;
      right: 15px;
    }

    html[dir="rtl"] .page-signin-header .btn {
      right: auto;
      left: 15px;
    }

    .page-signin-container {
      width: auto;
      margin: 30px 10px;
      background: rgba(61,74,93,.8);
      padding: 30px;
      border-radius: 5px;
    }

    .page-signin-container form {
      border: 0;
      box-shadow: 0 2px 2px rgba(0,0,0,.05), 0 1px 0 rgba(0,0,0,.05);
    }

    @media (min-width: 544px) {
      .page-signin-container {
        width: 440px;
        margin: 3% auto;
        padding:50px
      }
    }

    .page-signin-social-btn {
      width: 40px;
      padding: 0;
      line-height: 40px;
      text-align: center;
      border: none !important;
    }

    #page-signin-forgot-form { display: none; }
    @font-face{
      font-family:nunito;
      src:url("{{asset('fonts/nunito/Nunito-Regular.ttf')}}");
    }
    body,h1,h2,h3,h4,h5,h6,p,label,a,small{
      font-family:nunito !important;
    }
  </style>
  <!-- / Custom styling -->
</head>
<body>
  <div class="page-signin-header p-a-2 text-sm-center bg-white">
    <img src='{{asset("images/logo-kepseribu.png")}}' style='width:150px;padding:10px;margin-right:300px;'/>
    <a class="px-demo-brand px-demo-brand-lg text-default" href="/" style='font-size:'>Aplikasi Penduduk | Kepulauan Seribu</a>
    <img src='{{asset("images/logo-nr.png")}}' style='width:300px;padding:10px;margin-left:150px'/>
    <!-- <a href="about.html" class="btn btn-primary">Tentang</a> -->
  </div>

  <!-- Sign In form -->
  <div class='col-md-6'>
    <iframe style='margin:5%;border-radius:5px' width="95%" height="360" src="https://www.youtube.com/embed/bsIGRhXwgPw?rel=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
  </div>
  <div class='col-md-6'>
    <div style='margin:9% auto 2%;text-align:center'>
      <!-- <img src='{{asset("images/logo-kepseribu.png")}}' style='width:140px;padding:10px'/>
      <img src='{{asset("images/logo-nr.png")}}' style='width:282px;padding:10px'/> -->
    </div>
    <div class="page-signin-container" id="page-signin-form">
      <h2 class="m-t-0 m-b-4 text-xs-center font-weight-semibold font-size-20" style="color: #fff;" >Sign In to your Account</h2>

      <!-- <form action="/" class="panel p-a-4"> -->
        <fieldset class=" form-group form-group-lg">
          <input type="text" name="email" class="form-control" placeholder="Username or Email">
        </fieldset>

        <fieldset class=" form-group form-group-lg">
          <input type="password" name="password" class="form-control" placeholder="Password">
        </fieldset>

        <div class="clearfix">
          <!-- <label class="custom-control custom-checkbox pull-xs-left">
            <input type="checkbox" class="custom-control-input">
            <span class="custom-control-indicator"></span>
            Remember me
          </label>
          <a href="" class="font-size-12 text-muted pull-xs-right" id="page-signin-forgot-link">Forgot your password?</a> -->
        </div>

        <a class="btn btn-block btn-lg btn-primary m-t-3" id="loginBtn">Sign In</a>
      <!-- </form> -->

    </div>
  </div>

  <!-- / Sign In form -->

  <!-- Reset form -->

  <div class="page-signin-container" id="page-signin-forgot-form">
    <h2 class="m-t-0 m-b-4 text-xs-center font-weight-semibold font-size-20">Password reset</h2>

    <form action="index.html" class="panel p-a-4">
      <fieldset class="form-group form-group-lg">
        <input type="email" class="form-control" placeholder="Your Email" name="email">
      </fieldset>

      <button type="submit" class="btn btn-block btn-lg btn-primary m-t-3">Send password reset link</button>
      <div class="m-t-2 text-muted">
        <a href="#" id="page-signin-forgot-back">&larr; Back</a>
      </div>
    </form>
  </div>

  <script src="https://www.gstatic.com/firebasejs/4.8.0/firebase.js"></script>
  <script>
    // Initialize Firebase

    var config = {
      apiKey: "AIzaSyAOyzUWIUMHE3YVx64KicRUjcMCbsn6gZQ",
      authDomain: "penduduk-app.firebaseapp.com",
      databaseURL: "https://penduduk-app.firebaseio.com",
      projectId: "penduduk-app",
      storageBucket: "penduduk-app.appspot.com",
      messagingSenderId: "216960976294"
    };
    firebase.initializeApp(config);
  </script>

  <!-- / Reset form -->

  <!-- ==============================================================================
  |
  |  SCRIPTS
  |
  =============================================================================== -->

  <!-- jQuery -->
  <script src="{{asset('vendor/jquery/dist/jquery.js')}}"></script>
  <script type="text/javascript">
      firebase.auth().onAuthStateChanged(function(user) {
        if (user) {
          $(location).attr('href','/');
        }
      });

      $('#loginBtn').on('click',function(){
          login();
      });

      $(document).keypress(function(e) {
          if(e.which == 13) {
              login();
          }
      });


      function login(){
        var email = $('[name="email"]').val();
        var password = $('[name="password"]').val();

        firebase.auth().signInWithEmailAndPassword(email, password).then(()=>{
            $(location).attr('href','/');
        })
          .catch(function(error){
          var errorCode = error.code;
          var errorMessage = error.message;
          console.log('Error '+errorCode+': '+errorMessage);
          alert('Error '+errorCode+': '+errorMessage);
        });
      }
  </script>

  <script src="{{asset('js/bootstrap.min.js')}}"></script>
  <script src="{{asset('js/pixeladmin.min.js')}}"></script>

</body>
</html>
