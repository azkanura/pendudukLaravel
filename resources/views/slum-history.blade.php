@extends('base')
@section('title')
  Data Kekumuhan
@endsection
<!-- Content -->
@section('content')
    <div class="page-header">
        <p><strong>Riwayat Data Kekumuhan Wilayah Kabupaten Kepulauan Seribu</strong> / Kecamatan {{$kec}}</p>
    </div>

    <div class="panel">
        <div class="panel-heading">
            <div class="panel-title">Data Kekumuhan <a href="{{url('slum-create')}}"><button class="btn btn-primary pull-right" >Tambah Data</button></a></div>
        </div>
        <div class="panel-body">
            <table class="table table-striped">
                <caption>Riwayat Data</caption>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Kecamatan</th>
                        <th>Periode</th>
                        <th>Status</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody id="dataContainer">
                    <tr><td></td><td>Loading Data..</td><td></td><td></td><td></td></tr>
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
        var province='{{$prov}}';
        var city='{{$kota}}';
        var district='{{$kec}}';

        kekumuhan.where('provinsi','==',province).where('kota','==',city).where('kecamatan','==',district).get().then(function(query){
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
                    var periode = data.periode;
                    var status;
                    if(data.status){
                        status = "Aktif";
                    }
                    else{
                        status = "Non Aktif"
                    }
                    dataContainer.append('<tr>'+
                        '<td>'+counter+'</td>'+
                        '<td><a href="/slum-detail/'+docId+'">'+kec+'</a></td>'+
                        '<td>'+periode+'</td>'+
                        '<td style="text-transform:capitalize">'+status+'</td>'+
                        '<td><a class="btn btn-success" href="/slum-detail/'+docId+'"  style="margin-right:5px">Detail</a><a class="btn btn-primary" href="/slum-edit/'+docId+'" style="margin-right:5px">Edit</a></td>'+
                    '</tr>');
                }
            });
        });

        function init(){

        }

    </script>
@endsection