@extends('base') @section('title') Data Survey @endsection

<!-- Content -->
@section('content')
<div class="page-header m-b-0">
    <h1 style="display: block;">Data Survey
        <small id="area" style="line-height: 30px" class="pull-right"></small>
    </h1>
</div>
<div class="page-header panel m-b-0 p-y-0 b-a-0 border-radius-0">
    <div class="input-group input-group-lg p-y-3">
        <input type="text" name="s" class="form-control" placeholder="Cari berdasarkan nama">
        <span class="input-group-btn">
            <button type="submit" class="btn btn-primary" id="searchBtn">
                <i class="fa fa-search"></i>
            </button>
        </span>
    </div>

    <hr class="page-wide-block m-y-0">
    <p id="resultText" style="padding-top:15px;"></p>

</div>

<div class="page-wide-block">
    <div>

    </div>
    <div class="box border-radius-0 m-a-0">

        <div class="box-cell" style="height: 600px;">
            <div class="widget-maps" id="map"></div>
        </div>
    </div>
</div>


@endsection @section('inlinejstop')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCHtdj4L66c05v1UZm-nte1FzUEAN6GKBI&sensor=false"
    async defer></script> @endsection @section('inlinejs')
<script>
    var map = '';
    var markers =[];
    var penduduk = db.collection('penduduk');
    var keyword;

    var client = algoliasearch(
      'HD3FUMIQJF',
      '632cd6090f2f70f2ac2da1ba9421b1ad'
    );

    var index = client.initIndex('penduduk');

    $('#searchBtn').on('click',function(){
      searchData();
    });

    $(document).keypress(function(e) {
        if(e.which == 13) {
            searchData();
        }
    });

    function searchData(){
      console.log('wuehehehe');
      var keyword = $('[name="s"]').val();
      for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(null);
      }
      markers = [];

      // penduduk.where('nama_lengkap','==',keyword).get().then((querySnapshot)=>{
      //   querySnapshot.forEach((doc)=>{
      //     if(doc && doc.exists){
      //       var data = doc.data();
      //       var id=doc.id;
      //       var name = data.nama_lengkap;
      //       penduduk.doc(doc.id).collection('dokumen').get().then((query)=>{
      //         query.forEach((dokumen)=>{
      //             var dok = dokumen.data();
      //             var coordinateText = dok.koordinat;
      //             var coordinateArray = coordinateText.split(',');
      //             var coordinate = {lat:parseFloat(coordinateArray[0]),lng:parseFloat(coordinateArray[1])};
      //             addMarker(name,id,dok,coordinate);
      //         });
      //       }).catch((error)=>{
      //         console.log('Tidak dapat menemukan lokasi penduduk dengan nama <strong>'+name+'</strong>');
      //       });
      //       $('#resultText').html('Menampilkan hasil pencarian penduduk dengan nama <strong>'+keyword+'</strong>');
      //     }
      //     else{
      //       console.log('Yuhu');
      //       $('#resultText').html('Tidak dapat menemukan penduduk dengan nama <strong>'+keyword+'</strong>');
      //     }
      //   });
      // }).catch((error)=>{
      //   console.log(error);
      //   $('#resultText').html('Tidak dapat menemukan penduduk dengan nama <strong>'+keyword+'</strong>');
      // });

      index.search({query:keyword},function searchDone(err,content){
        if(err){
          console.error(err);
          $('#resultText').html('Tidak dapat menemukan penduduk dengan nama <strong>'+keyword+'</strong>');
          return;
        }
        if(!content.hits.length){
          $('#resultText').html('Tidak dapat menemukan penduduk dengan nama <strong>'+keyword+'</strong>');
        }
        else{
          $('#resultText').html('Menampilkan hasil pencarian penduduk dengan nama <strong>'+keyword+'</strong>');
        }

        for ( var h in content.hits){
          var data=content.hits[h];
          var name=data.nama_lengkap;
          var id=data.objectID;
          var coordinateText = data.koordinat;
          var coordinateArray = coordinateText.split(',');
          var coordinate = {lat:parseFloat(coordinateArray[0]),lng:parseFloat(coordinateArray[1])};
          addMarker(name,id,data,coordinate);
        }
      });
    }


    function init() {
      initMap();
      for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(null);
      }
      markers = [];
      penduduk.get().then((querySnapshot)=>{
        querySnapshot.forEach((doc)=>{
          if(doc && doc.exists){
            var data = doc.data();
            var id=doc.id;
            var name = data.nama_lengkap;
            penduduk.doc(doc.id).collection('dokumen').get().then((query)=>{
              query.forEach((dokumen)=>{
                  var dok = dokumen.data();
                  var coordinateText = dok.koordinat;
                  var coordinateArray = coordinateText.split(',');
                  var coordinate = {lat:parseFloat(coordinateArray[0]),lng:parseFloat(coordinateArray[1])};
                  addMarker(name,id,dok,coordinate);
              });
            }).catch((error)=>{
              console.log('Tidak dapat menemukan lokasi penduduk dengan nama <strong>'+name+'</strong>');
            });
            // $('#resultText').html('Menampilkan hasil pencarian penduduk dengan nama <strong>'+keyword+'</strong>');
          }
          else{
            console.log('Yuhu');
            $('#resultText').html('Tidak dapat menemukan penduduk dengan nama <strong>'+keyword+'</strong>');
          }
        });
      }).catch((error)=>{
        console.log(error);
        // $('#resultText').html('Tidak dapat menemukan penduduk dengan nama <strong>'+keyword+'</strong>');
      });
    }

    function initMap() {
        var coordinates = { lat: -6.070446827312626, lng: 106.79143108427523 };

        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 8,
            center: coordinates,
            // scrollwheel: false,
        });
    }

    function addMarker(name,id,doc,coordinate){
      var marker = new google.maps.Marker({
        position:coordinate,
        map:map,
        label:name
      });

      markers.push(marker);

      var infoWindow = new google.maps.InfoWindow({
        content:'<a href="/penduduk-detail/'+id+'"><h3 style="margin:10px 0"><strong>'+name+'<strong></h4></a>'+
          '<p>Nomor KK: '+doc.nomor_kk+'</p>'+
          '<p>Alamat: <br>'+
          doc.alamat+', '+
          'RT '+doc.rt+
          '/RW '+doc.rw+
          ', Kelurahan '+doc.kelurahan+
          ', Kecamatan '+doc.kecamatan+
          '<br> '+doc.kota+', '+doc.provinsi+'</p>'
      });

      marker.addListener('click',function(){
        infoWindow.open(map,marker);
      });

      map.setCenter(coordinate);

      console.log(coordinate);
    }

</script> @endsection
