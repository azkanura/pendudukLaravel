@extends('base') @section('title') Cari Penduduk @endsection

<!-- Content -->
@section('content')
<style media="screen">
  .card{
    background: white;
    padding: 20px;
    box-shadow: 1px 1px 3px 2px #eeeeee;
    -moz-box-shadow: 1px 1px 3px 2px #eeeeee;
    -webkit-box-shadow: 1px 1px 3px 2px #eeeeee;
  }
</style>
<div class="page-header m-b-0">
    <h1 style="display: block;">Cari Penduduk
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

</div>
<p id="resultText" style="padding:15px 0 5px 0;"></p>

<div id="dataContainer">
  <!-- <div class="card">
      Hello
  </div> -->
</div>

@endsection @section('inlinejstop')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCHtdj4L66c05v1UZm-nte1FzUEAN6GKBI&sensor=false"
    async defer></script> @endsection @section('inlinejs')
<script>
    var penduduk = db.collection('penduduk');

    var client = algoliasearch(
      'HD3FUMIQJF',
      '632cd6090f2f70f2ac2da1ba9421b1ad'
    );

    var index = client.initIndex('penduduk');
    
    // var records = [];
    //
    // penduduk.get().then((query)=>{
    //   query.forEach((doc)=>{
    //     if(doc && doc.exists){
    //       var childKey = doc.id;
    //       var childData = doc.data();
    //       childData.objectID = childKey;
    //       records.push(childData)
    //     }
    //   });
    //
    //   index.saveObjects(records).then(()=>{
    //     console.log('Penduduk imported into Algolia');
    //   }).catch((error)=>{
    //     console.error('Error when importing penduduk into Algolia', error);
    //     process.exit(1);
    //   });
    // });


    var map = '';
    // var markers =[];
    // var keyword;
    var dataContainer = $('#dataContainer');

    $('#searchBtn').on('click',function(){
      dataContainer.html('<div class="card"><h3 class="text-center">Loading Data</h3></div>');
      searchData();
    });

    $(document).keypress(function(e) {
        if(e.which == 13) {
          dataContainer.html('<div class="card"><h3 class="text-center">Loading Data...</h3></div>');
          searchData();
        }
    });

    function searchData(){
      var keyword = $('[name="s"]').val();
      console.log(keyword);
      index.search({query:keyword},function searchDone(err, content){
        if (err){
          console.error(err);
          $('#resultText').html('Tidak ditemukan hasil untuk pencarian penduduk dengan nama <strong>'+keyword+'</strong>');
          return;
        }
        dataContainer.html('');
        if(!content.hits.length){
          $('#resultText').html('Tidak ditemukan hasil untuk pencarian penduduk dengan nama <strong>'+keyword+'</strong>');
        }
        else{
          $('#resultText').html('Menampilkan hasil pencarian penduduk dengan nama <strong>'+keyword+'</strong>');
        }
        for (var h in content.hits){
          console.log(`Hit(${content.hits[h].objectID}):${content.hits[h].nama_lengkap}`);
          var data = content.hits[h];
          var id=content.hits[h].objectID;
          var name = data.nama_lengkap;
          dataContainer.append('<a href="/penduduk-detail/'+id+'"><div class="card"><a href="/penduduk-detail/'+id+'"><h5 style="margin-top:0">'+name+'</h5></a>'+
              '<p>RW '+data.rt+' / RW '+data.rw+'</p>'+
              '<p>Kelurahan '+data.kelurahan+', Kecamatan '+data.kecamatan+'</p>'+
              '<p>'+data.kota+', '+data.provinsi+'</p>'+
          '</div></a>');


        }
      });
    }


    function init() {

    }

    // function searchData(){
    //   console.log('wuehehehe');
    //   var keyword = $('[name="s"]').val();
    //
    //   penduduk.where('nama_lengkap','==',keyword).get().then((querySnapshot)=>{
    //     var counter = 0;
    //     dataContainer.html('');
    //     querySnapshot.forEach((doc)=>{
    //       if(doc && doc.exists){
    //         counter+=1;
    //         var data = doc.data();
    //         var id=doc.id;
    //         var name = data.nama_lengkap;
    //         dataContainer.append('<a href="/penduduk-detail/'+id+'"><div class="card"><a href="/penduduk-detail/'+id+'"><h5 style="margin-top:0">'+name+'</h5></a>'+
    //             '<p>RW '+data.rt+' / RW '+data.rw+'</p>'+
    //             '<p>Kelurahan '+data.kelurahan+', Kecamatan '+data.kecamatan+'</p>'+
    //             '<p>'+data.kota+', '+data.provinsi+'</p>'+
    //         '</div></a>');
    //
    //         $('#resultText').html('Menampilkan hasil pencarian penduduk dengan nama <strong>'+keyword+'</strong>');
    //       }
    //       else{
    //         console.log('Yuhu');
    //         $('#resultText').html('Tidak dapat menemukan penduduk dengan nama <strong>'+keyword+'/ </strong>');
    //       }
    //     });
    //   }).catch((error)=>{
    //     console.log(error);
    //     $('#resultText').html('Tidak dapat menemukan penduduk dengan nama <strong>'+keyword+'</strong>');
    //   });
    // }

</script> @endsection
