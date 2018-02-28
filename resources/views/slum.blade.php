@extends('base')
@section('title')
  Data Kekumuhan
@endsection
<!-- Content -->
@section('content')
    <div class="page-header">
        <p id="pageTitle"><strong>Data Kekumuhan Wilayah Kabupaten Kepulauan Seribu</strong></p>
    </div>

    <div class="panel">
        <div class="panel-heading">
            <div class="panel-title">Data Kekumuhan <a href="{{url('slum-create')}}"><button class="btn btn-primary pull-right" >Tambah Data</button></a></div>
        </div>
        <div class="panel-body">
            <table class="table table-striped">
                <caption>Berdasarkan Kecamatan</caption>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Kecamatan</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody id="dataContainer">
                    <tr><td></td><td>Loading Data..</td><td></td></tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('inlinejs')
    <script type="text/javascript">
        var kekumuhan = db.collection('kekumuhan');
        var selectProvince = $('#selectProvince');
        var selectCity = $('#selectCity');
        var dataContainer = $('#dataContainer');
        var province='Dki Jakarta';
        var city='Kab. Kepulauan Seribu';

        kekumuhan.where('provinsi','==',province).where('kota','==',city).where('status','==',true).get().then(function(query){
            var counter=0;
            dataContainer.html('');
            query.forEach(function(doc){
                if(doc && doc.exists){
                    counter+=1;
                    var docId = doc.id;
                    var data = doc.data();
                    var prov = data.provinsi;
                    var kota = data.kota;
                    var kec = data.kecamatan;
                    dataContainer.append('<tr>'+
                        '<td>'+counter+'</td>'+
                        '<td><a href="/slum-detail/'+docId+'">'+kec+'</a></td>'+
                        '<td><a class="btn btn-success" href="/slum-detail/'+docId+'"  style="margin-right:5px">Detail</a><a class="btn btn-primary" href="/slum-edit/'+docId+'" style="margin-right:5px">Edit</a><a class="btn btn-warning" href="/slum-history/'+prov+'/'+kota+'/'+kec+'">Riwayat</a></td>'+
                    '</tr>');
                }
            });
        });

        function init(){

        }

    </script>
@endsection