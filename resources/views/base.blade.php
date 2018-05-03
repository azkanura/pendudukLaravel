<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

    <title>@yield('title')  - Penduduk App</title>

    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,600,700,300&subset=latin"
        rel="stylesheet" type="text/css">
    <link href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css">

    <!-- Core stylesheets -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/pixeladmin.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('css/widgets.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('vendor/font-awesome/css/font-awesome.css')}}" rel="stylesheet" type="text/css">
    <!-- <link href="/vendor/css/select2.min.css" rel="stylesheet" type="text/css"> -->
    <!-- <script src="/vendor/js/select2.min.js"></script> -->
    <script src="https://cdn.jsdelivr.net/algoliasearch/3/algoliasearch.min.js"></script>


    <!-- Theme -->
    <link href="{{asset('css/themes/clean.min.css')}}" rel="stylesheet" type="text/css">
    <style>
      select.form-control{
          margin-bottom: 15px;
      }
      #pageTitle{
        border-bottom: 1px solid #eee;
        padding-bottom: 15px;
        margin-bottom: 15px;
        color: #3d4a5d;
      }
      .control-label{
        color:#707070;
      }

      hr.primary{
        margin:8px 0;
        border:1px solid #eee;
      }
      @font-face{
        font-family:nunito;
        src:url("{{asset('fonts/nunito/Nunito-Regular.ttf')}}");
      }
      body,h1,h2,h3,h4,h5,h6,p,label,a,small{
        font-family:nunito !important;
      }
      .page-profile-v1-avatar{
        object-fit:cover;
        width:160px;
        height:160px;
      }
      small{
        color:#6c5ce7;
      }
    </style>

    <!-- Pace.js -->
    <script src="{{asset('pace/pace.min.js')}}"></script>
    @yield('inlinejstop')
    @yield('inlinecss')
</head>

<body>
    <!-- Nav -->
    <nav class="px-nav px-nav-left">
        <button type="button" class="px-nav-toggle" data-toggle="px-nav">
            <span class="px-nav-toggle-arrow"></span>
            <span class="navbar-toggle-icon"></span>
            <span class="px-nav-toggle-label font-size-11">HIDE MENU</span>
        </button>

        <ul class="px-nav-content">
            <li class="px-nav-box p-a-3 b-b-1" id="demo-px-nav-box">
                <img src="{{asset('/demo/avatars/account.png')}}" alt="" class="pull-xs-left m-r-2 border-round profile-picture" style="width: 54px; height: 54px;">
                <div class="font-size-16">
                    <span class="font-weight-light">Welcome, </span>
                    <strong id="displayFirstname"><span style="background: #dddddd;color:transparent;border-radius:3px">Username</span></strong>
                </div>
                <!-- <div class="btn-group" style="margin-top: 4px;">
                    <a href="#" class="btn btn-xs btn-primary btn-outline">
                        <i class="fa fa-envelope"></i>
                    </a>
                    <a href="#" class="btn btn-xs btn-primary btn-outline">
                        <i class="fa fa-user"></i>
                    </a>
                    <a href="#" class="btn btn-xs btn-primary btn-outline">
                        <i class="fa fa-cog"></i>
                    </a>
                    <a href="/login.html" class="btn btn-xs btn-danger btn-outline">
                        <i class="fa fa-power-off"></i>
                    </a>
                </div> -->
            </li>
            <li class="px-nav-item px-nav-dropdown">
                <a href="#">
                    <i class="px-nav-icon fa fa-pie-chart"></i>
                    <span class="px-nav-label">Dashboard</span>
                </a>

                <ul class="px-nav-dropdown-menu">
                    <li class="px-nav-item">
                        <a href="{{url('/')}}">
                            <span class="px-nav-label">Statistik</span>
                        </a>
                    </li>
                    <li class="px-nav-item">
                        <a href="{{url('/laporan')}}">
                            <span class="px-nav-label">Laporan</span>
                        </a>
                    </li>
                    <!-- <li class="px-nav-item">
                        <a href="/analitik">
                            <span class="px-nav-label">Analitik</span>
                        </a>
                    </li> -->
                </ul>
            </li>
            <li class="px-nav-item">
                <a href="{{url('/survey')}}">
                    <i class="px-nav-icon fa fa-map-marker"></i>
                    <span class="px-nav-label">Survey</span>
                </a>
            </li>
            <li class="px-nav-item">
                <a href="{{url('/penduduk')}}">
                    <i class="px-nav-icon fa fa-area-chart"></i>
                    <span class="px-nav-label">Penduduk</span>
                </a>
            </li>
            <li class="px-nav-item">
                <a href="{{url('/slum')}}">
                    <i class="px-nav-icon ion-pie-graph"></i>
                    <span class="px-nav-label">Kekumuhan</span>
                </a>
            </li>
            <li class="px-nav-item px-nav-dropdown" id="userMenu" style="display: none">
                <a href="#">
                    <i class="px-nav-icon fa fa-users"></i>
                    <span class="px-nav-label">User</span>
                </a>

                <ul class="px-nav-dropdown-menu">
                    <li class="px-nav-item">
                        <a href="{{url('/user')}}">
                            <span class="px-nav-label">Daftar</span>
                        </a>
                    </li>
                    <li class="px-nav-item">
                        <a href="{{url('/user-editor')}}">
                            <span class="px-nav-label">Tambah</span>
                        </a>
                    </li>
                </ul>
            </li>


        </ul>
        <img src="{{asset('images/logo-kepseribu.png')}}" style='width:60%;display:block;margin:40px auto 10px'/>
        <img src="{{asset('images/logo-nr.png')}}" style='width:60%;display:block;margin:10px auto'/>
    </nav>

    <!-- Navbar -->
    <nav class="navbar px-navbar">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{url('/')}}">
              Penduduk App
              <!-- <img src="{{asset('images/logo-kepseribu.png')}}" style='height:20px;margin-right:10px;margin-top:5px'/>
              <img src="{{asset('images/logo-nr.png')}}" style='height:20px;margin-right:10px;margin-top:5px'/> -->
            </a>
        </div>

        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#px-navbar-collapse" aria-expanded="false">
            <i class="navbar-toggle-icon"></i>
        </button>

        <div class="collapse navbar-collapse" id="px-navbar-collapse">
            <ul class="nav navbar-nav">
                <li>
                    <a href="{{url('/cari')}}">Pencarian</a>
                  </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <!-- <li>
                  <img src="{{asset('images/logo-kepseribu.png')}}" style='height:40px;margin-right:10px;margin-top:5px'/>
                  <img src="{{asset('images/logo-nr.png')}}" style='height:40px;margin-right:10px;margin-top:5px'/>
                </li> -->
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <img src="/demo/avatars/account.png" alt="" class="px-navbar-image profile-picture">
                        <span id="displayUsername" class="hidden-md"><span style="background: #3d4a70;color:transparent;border-radius:3px">Username</span></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{url('/profile')}}">
                                <span class="label label-warning pull-xs-right">
                                    <!-- <i class="fa fa-asterisk"></i> -->
                                </span>Profile</a>
                        </li>
                        <!-- <li>
                            <a href="/profile/change-password">
                                <span class="label label-warning pull-xs-right">
                                </span>Change Password</a>
                        </li> -->
                        <!-- <li>
                            <a href="/pages-account.html">Account</a>
                        </li>
                        <li>
                            <a href="/pages-messages-list.html">
                                <i class="dropdown-icon fa fa-envelope"></i>&nbsp;&nbsp;Messages</a>
                        </li> -->
                        <li class="divider"></li>
                        <li style="display:none">
                            <a href="#" id="uploadJSON" style="background:#1abc9c;color:#fff,padding:8px;margin:10px">
                                Upload JSON
                            </a>
                        </li>
                        <li>
                            <a href="#" id="logoutBtn">
                                <i class="dropdown-icon fa fa-power-off"></i>&nbsp;&nbsp;Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Content -->
    <div class="px-content">
    	@yield('content')
    </div>

    <!-- Footer -->
      <footer class="px-footer px-footer-bottom">
        Copyright © 2017 Penduduk App.
    </footer>
    <script src="https://www.gstatic.com/firebasejs/4.8.0/firebase.js"></script>
    <script src="https://www.gstatic.com/firebasejs/4.6.0/firebase-firestore.js"></script>
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
        if(!firebase){
            alert('Cannot connect to database. Please check your internet connection!')
        }
        var db = firebase.firestore();
        var storage = firebase.storage();
        var penduduk = db.collection('penduduk');
    </script>

    <!-- ==============================================================================
  |
  |  SCRIPTS
  |
  =============================================================================== -->

    <!-- Load jQuery -->
    <script src="{{asset('vendor/jquery/dist/jquery.js')}}"></script>
	  <script src="{{asset('js/index.js')}}"></script>
    <script type="text/javascript">
      var kk = [];
      var anggota = [];
      $('#uploadJSON').on('click',function(){
        console.log('debugging');
         $.getJSON("/dst.json",function(data){
           console.log('debugging2');
           $.each(data, function (index,value){
              var kepalaKel = value["HubKepalaKeluarga"].toLowerCase();
              var kepalaRumta = value["HubKepalaRumahTangga"].toLowerCase();

              if((kepalaKel=='kepala keluarga'||kepalaKel=='kepala rumah tangga')||(kepalaRumta=='kepala keluarga'||kepalaRumta=='kepala rumah tangga')){
                kk.push(value);
              }
              else{
                anggota.push(value);
              }
           });

           console.log('Kepala Keluarga:');
           console.log(kk);
           console.log(anggota);
           var counter=1;
           kk.forEach((data)=>{
             penduduk.add({
               nomor_kk: data.NomorKK,
               nama_lengkap: data.NamaLengkap,
               pekerjaan: data.StatusPekerjaanKepala,
               jenis_kelamin: data.JenisKelamin,
               provinsi: data.Provinsi,
               kota: data.KabupatenKota,
               kecamatan: data.Kecamatan,
               kelurahan: data.Kelurahan,
               rw: data.RW,
               rt:data.RT,
               nama_jalan:data.NamaJalan,
               tanggal_lahir:data.BulanLahirKepala+' '+data.TahunLahirKepala,
             }).then(function(docRef) {
                  console.log("("+counter+")Document written with ID: ", docRef.id);
                  counter++;
              })
              .catch(function(error) {
                  console.error("Error adding document: ", error);
              });
           });


           setTimeout(function(){
             var counter=1;
             kk.forEach((data)=>{
               penduduk.where('nomor_kk','==',data.NomorKK).limit(1).get().then((querySnapshot)=>{
                 querySnapshot.forEach((doc)=>{
                   var document = penduduk.doc(doc.id).collection('dokumen');
                   document.add({
                     nomor_kk: data.NomorKK,
                     alamat: data.NamaJalan,
                     provinsi: data.Provinsi,
                     kota: data.KabupatenKota,
                     kecamatan: data.Kecamatan,
                     kelurahan: data.Kelurahan,
                     rw: data.RW,
                     rt: data.RT
                   }).then(function(docRef) {
                        console.log("("+counter+")Dokumennya ditulis dengan ID: ", docRef.id);
                        counter++;
                    })
                    .catch(function(error) {
                        console.error("Error adding document: ", error);
                    });

                 });
               });
             });
            var countera=1;
             anggota.forEach((data)=>{
               penduduk.where('nomor_kk','==',data.NomorKK).limit(1).get().then((querySnapshot)=>{
                 querySnapshot.forEach((doc)=>{
                   var member = penduduk.doc(doc.id).collection('anggota');
                   member.add({
                     nama_lengkap:data.NamaLengkap,
                     jenis_kelamin:data.JenisKelamin,
                     jenis: data.HubKepalaKeluarga
                   }).then(function(docRef) {
                        console.log("("+countera+")Anggota ditulis dengan ID: ", docRef.id);
                        countera++;
                    })
                    .catch(function(error) {
                        console.error("Error adding document: ", error);
                    });
                 });

               });
             });
          },20000);

         }).catch((error)=>{
           console.log(error);
         });
      });

    </script>

    <!-- Core scripts -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/pixeladmin.min.js')}}"></script>

    <!-- Your scripts -->
    <script src="{{asset('js/app.js')}}"></script>
    <!-- <script  type="text/javascript">
    $(function(){
      $(document).find('select').select2();
      console.log('masuk');
    });
    </script> -->

    @yield('inlinejs')
</body>

</html>
