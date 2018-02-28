@extends('base')
@section('title')
  Penduduk
@endsection
<!-- Content -->
@section('content')
    <div class="page-header">
        <h3>
            <span class="text-muted font-weight-light">Indonesia
        </h3>
    </div>

    <div class="panel">
        <div class="panel-heading">
            <div class="panel-title">Daftar Penduduk <a href="/penduduk-create"><button class="btn btn-primary pull-right" >Tambah Penduduk</button></a></div>
        </div>
        <div class="panel-body">
            <table class="table table-striped">
                <caption>Berdasarkan Provinsi</caption>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Provinsi</th>
                        <th>Total Keluarga</th>
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
        var penduduk = db.collection('penduduk');
        var dataContainer = $('#dataContainer');
        var counter = 1;
        var dataArray = [];
            
        function init(){
            console.log('current User: '+currentUser.email);
            var province = currentUser.area.province;
            var city = currentUser.area.city;
            var district = currentUser.area.district;
            var subdistrict = currentUser.area.subdistrict;
            console.log(province);

            // province=province.replace(' ','-');
            // city=city.replace(' ','-');
            // district=district.replace(' ','-');
            // sundistrict=subdistrict.replace(' ','-');

            switch(currentUser.level){
                case 'province':
                    $(location).attr('href','{{url("/provinsi")}}/'+province);
                    break;
                case 'city':
                    $(location).attr('href','{{url("/kota")}}/'+province+'/'+city);
                    break;
                case 'district':
                    $(location).attr('href','{{url("/kecamatan")}}/'+province+'/'+city+'/'+district);
                    break;
                case 'subdistrict':
                    $(location).attr('href','{{url("/kelurahan")}}/'+province+'/'+city+'/'+district+'/'+subdistrict);
                    break;
            }

            penduduk.get().then((querySnapshot)=>{
                 querySnapshot.forEach((doc)=>{
                     if(doc && doc.exists){
                        var data = doc.data();
                        var exist = exists(data.provinsi,dataArray);
                        console.log(exist);
                        if(!exist){
                            addData(data.provinsi, dataArray);
                        }         
                     }
                 });

                 dataContainer.html('');
                    dataArray.forEach((data)=>{
                    console.log(data.name);

                    dataContainer.append(
                        '<tr>'+
                            '<th  scope="row">'+counter+'</th>'+
                            '<td><a href="/provinsi/'+data.name+'">'+data.name+'</a></td>'+
                            '<td>'+data.count+'</td>'+
                        '</tr>'
                    );
                    counter++;
                });
            });

        }


        function exists(str, dataArray){
            var exist = false;
            dataArray.forEach((data)=>{
                if(str==data.name){
                    data.count=data.count+1;
                    exist = true;
                    return exist;
                }
            });
            return exist;
        }

        function addData(str, dataArray){
            dataArray.push({name:str,count:1});
        }

        console.log('hahaha');
        console.log(dataArray);
    </script>
@endsection