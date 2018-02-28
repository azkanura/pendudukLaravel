@extends('base')
@section('title')
  Kota {{$kota}}
@endsection
<!-- Content -->
@section('content')
    <div class="page-header">
        <p id="pageTitle"><strong>Cakupan Wilayah</strong></p>
        <div class="form-group" id="filter">
            <div class="row">
                <div class="col-md-4" id="filterProvince">
                    <label class="control-label">Provinsi</label>
                    <select class="form-control" id="selectProvince">
                        <option>Loading Data..</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="control-label">Kota/Kabupaten</label>
                    <select class="form-control" id="selectCity">
                        <option>Loading Data..</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="panel">
        <div class="panel-heading">
            <div class="panel-title">Daftar Penduduk <a href="/penduduk-create"><button class="btn btn-primary pull-right" >Tambah Penduduk</button></a></div>
        </div>
        <div class="panel-body">
            <table class="table table-striped">
                <caption>Berdasarkan Kecamatan</caption>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Kecamatan</th>
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
        var province = '{{$provinsi}}';
        var city ='{{$kota}}';
        console.log('kota : '+city);

        var dataContainer = $('#dataContainer');
        var counter = 1;
        var dataArray = [];
        var selectArray = [];

        // for filtering
        var arrayProvince = [];
        var arrayCity = [];
        // Filtering Category DOM
        var selectProvince = $('#selectProvince');
        var selectCity = $('#selectCity');
        var clauseArray = [];
        
        initiateData (penduduk, [], arrayProvince, selectProvince, 'province',province);
        clauseArray = [{title:'provinsi',value:province}];
        initiateData (penduduk, clauseArray,arrayCity,selectCity,'city',city);
        clauseArray.push({title:'kota',value:city});

        whereClause(penduduk,clauseArray).get().then((querySnapshot)=>{
             dataContainer.html('');
             querySnapshot.forEach((doc)=>{
                 if(doc && doc.exists){
                    var data = doc.data();
                    var exist = dataExists(data.kecamatan
                        ,dataArray);
                    if(!exist){
                        addData(data.kecamatan, dataArray);
                    }
                } 
             });

            dataContainer.html('');
            dataArray.forEach((data)=>{
                console.log(data.name);

                dataContainer.append(
                    '<tr>'+
                        '<th  scope="row">'+counter+'</th>'+
                        '<td><a href="/kecamatan/'+province+'/'+city+'/'+data.name+'">'+data.name+'</a></td>'+
                        '<td>'+data.count+'</td>'+
                    '</tr>'
                );
                counter++;
            });

             $('#pageTitle').html('<strong>Cakupan Wilayah : </strong> '+province+' > '+city);
        });   
        function init(){
            console.log('current User: '+currentUser.email);
            var province = currentUser.area.province;
            var city = currentUser.area.city;
            var district = currentUser.area.district;
            var subdistrict = currentUser.area.subdistrict;
            switch(currentUser.level){
                case 'province':
                    $('#filterProvince').hide();
                    break;
                case 'city':
                    $('#filter').hide();
                    break;
                case 'district':
                    $(location).attr('href','/kecamatan/'+province+'/'+city+'/'+district);
                    break;
                case 'subdistrict':
                    $(location).attr('href','/kelurahan/'+province+'/'+city+'/'+district+'/'+subdistrict);
                    break;
            }  


        }
        

        selectProvince.on('change',function(){
            var selectedProvince = $(this).val();
            var arrayClause = [
                {title:'provinsi',value:selectedProvince}
            ];

            populateData(penduduk,arrayClause,arrayCity, selectCity, 'city');
        });

        selectCity.on('change',function(){
            var selectedProvince = selectProvince.val();
            var selectedCity = $(this).val();
            var arrayClause = [
                {title:'provinsi',value:selectedProvince},
                {title:'kota',value:selectedCity}
            ];
                       
            whereClause(penduduk,arrayClause).get().then((querySnapshot)=>{
                 counter = 1;
                 dataContainer.html('');
                 dataArray = [];
                 querySnapshot.forEach((doc)=>{
                     if(doc && doc.exists){
                        var data = doc.data();
                        var exist = dataExists(data.kecamatan,dataArray);
                        if(!exist){
                            addData(data.kecamatan,dataArray);
                        }
                    } 
                 });

                dataContainer.html('');
                dataArray.forEach((data)=>{
                    console.log(data.name);
                    dataContainer.append(
                        '<tr>'+
                            '<th  scope="row">'+counter+'</th>'+
                            '<td><a href="/kecamatan/'+selectedProvince+'/'+selectedCity+'/'+data.name+'">'+data.name+'</a></td>'+
                            '<td>'+data.count+'</td>'+
                        '</tr>'
                    );
                    counter++;
                });

            });

            $('#pageTitle').html('<strong>Cakupan Wilayah : </strong> '+selectedProvince+' > '+selectedCity);

        });

        function whereClause(doc,array){
            if(array.length){
                array.forEach((data)=>{
                    doc = doc.where(data.title,'==',data.value);
                });
            }
            return doc;
        }

        function filterType(data, typeData){
            switch(typeData){
                case 'province':
                    return data.provinsi;
                case 'city':
                    return data.kota;
                case 'district':
                    return data.kecamatan;
                case 'subdistrict':
                    return data.kelurahan;
                case 'rw':
                    return data.rw;
                case 'rt':
                    return data.rt;
            }
        }

        function initiateData (doc, arrayClause, arrayData, selectData, typeData, initialData){
            whereClause(doc,arrayClause).get().then((querySnapshot)=>{
                arrayData = [];
                querySnapshot.forEach((d)=>{
                    if(d && d.exists){
                        var data = d.data();
                        var name = filterType(data,typeData);
                        var exist = exists(name,arrayData);
                        if(!exist){
                            arrayData.push(name);
                        }
                    }
                });

                selectData.html('<option readOnly>Pilih Data</option>');
                arrayData.forEach((data)=>{
                    if(data.toLowerCase()==initialData.toLowerCase()){
                        selectData.append('<option value="'+data+'" selected>'+data+'</option>');
                    }
                    else{
                        selectData.append('<option value="'+data+'">'+data+'</option>');
                    }
                });
            });
        }

        function populateData (doc, arrayClause, arrayData, selectData, typeData){
            whereClause(doc,arrayClause).get().then((querySnapshot)=>{
                arrayData = [];
                querySnapshot.forEach((d)=>{
                    if(d && d.exists){
                        var data = d.data();
                        var name = filterType(data,typeData);
                        var exist = exists(name,arrayData);
                        if(!exist){
                            arrayData.push(name);
                        }
                    }
                });

                selectData.html('<option readOnly>Pilih Data</option>');
                arrayData.forEach((data)=>{
                    selectData.append('<option value="'+data+'">'+data+'</option>');
                });
            });
        }
        //for filtering            

        function exists(name,array){
            var size = array.length;
            var exist = false;
            if(size){
                for(var i=0;i<(size+1)/2;i++){
                    if(name.toLowerCase()==array[i].toLowerCase() || name.toLowerCase()==array[size-i-1].toLowerCase()){
                        exist = true;
                        return exist;
                    }
                }
            }
            return exist;
        }

        function dataExists(str, dataArray){
            var exist = false;
            dataArray.forEach((data)=>{
                if(str.toLowerCase()==data.name.toLowerCase()){
                    data.count=data.count+1;
                    exist = true;
                    return exist;
                }
            });
            return exist;
        }

        function addData( str, dataArray){
            dataArray.push({name:str,count:1});
        }
    </script>
@endsection