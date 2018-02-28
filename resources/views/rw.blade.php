@extends('base')
@section('title')
     RW {{$rw}}
@endsection
  <!-- Content -->
@section('content')
    <div class="page-header">
        <p id="pageTitle"><strong>Cakupan Wilayah</strong></p>
        <div class="form-group">
            <div class="row" style="margin-bottom:20px">
                <div class="col-md-4" id="filterProvince">
                    <label class="control-label">Provinsi</label>
                    <select class="form-control" id="selectProvince">
                        <option>Loading Data..</option>
                    </select>
                </div>
                <div class="col-md-4" id="filterCity">
                    <label class="control-label">Kota/Kabupaten</label>
                    <select class="form-control" id="selectCity">
                        <option>Loading Data..</option>
                    </select>
                </div>
                <div class="col-md-4" id="filterDistrict">
                    <label class="control-label">Kecamatan</label>
                    <select class="form-control" id="selectDistrict">
                        <option>Loading Data..</option>
                    </select>
                </div>
<!--             </div>
            <div class="row"> -->
                <div class="col-md-4" id="filterSubdistrict">
                    <label class="control-label">Kelurahan</label>
                    <select class="form-control" id="selectSubdistrict">
                        <option>Loading Data..</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="control-label">RW</label>
                    <select class="form-control" id="selectRW">
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
                <caption>Berdasarkan Rukun Tetangga</caption>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>RT</th>
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
        var district ='{{$kecamatan}}';
        var subdistrict ='{{$kelurahan}}';
        var rw ='{{$rw}}';

        var dataContainer = $('#dataContainer');
        var counter = 1;
        var dataArray = [];
        var selectArray = [];

        // for filtering
        var arrayProvince = [];
        var arrayCity = [];
        var arrayDistrict = [];
        var arraySubdistrict = [];
        var arrayRW = [];
        var arrayRT = [];
        // Filtering Category DOM
        var selectProvince = $('#selectProvince');
        var selectCity = $('#selectCity');
        var selectDistrict = $('#selectDistrict');
        var selectSubdistrict = $('#selectSubdistrict');
        var selectRW = $('#selectRW');

        initiateData (penduduk, [], arrayProvince, selectProvince, 'province',province);
        var clauseArray = [{title:'provinsi',value:province}];
        initiateData (penduduk, clauseArray,arrayCity,selectCity,'city',city);
        clauseArray.push({title:'kota',value:city});
        initiateData (penduduk, clauseArray,arrayDistrict, selectDistrict,'district',district);
        clauseArray.push({title:'kecamatan',value:district});
        initiateData (penduduk, clauseArray,arraySubdistrict, selectSubdistrict,'subdistrict',subdistrict);
        clauseArray.push({title:'kelurahan',value:subdistrict});
        initiateData (penduduk, clauseArray,arrayRW, selectRW,'rw',rw);
        clauseArray.push({title:'rw',value:rw});
        whereClause(penduduk,clauseArray).get().then((querySnapshot)=>{
             dataContainer.html('');
             querySnapshot.forEach((doc)=>{
                 if(doc && doc.exists){
                    var data = doc.data();
                    var exist = dataExists(data.rt,dataArray);
                    if(!exist){
                        addData(data.rt, dataArray);
                    }
                } 
             });

            dataContainer.html('');
            dataArray.forEach((data)=>{
                console.log(data.name);

                dataContainer.append(
                    '<tr>'+
                        '<th  scope="row">'+counter+'</th>'+
                        '<td><a href="/rt/'+province+'/'+city+'/'+district+'/'+subdistrict+'/'+rw+'/'+data.name+'">'+data.name+'</a></td>'+
                        '<td>'+data.count+'</td>'+
                    '</tr>'
                );
                counter++;
            });

             $('#pageTitle').html('<strong>Cakupan Wilayah : </strong> '+province+' > '+city+' > '+district+' > '+subdistrict+' > RW '+rw);
        });        

        function init(){
            switch(currentUser.level){
                case 'province':
                    $('#filterProvince').hide();
                    break;
                case 'city':
                    $('#filterProvince').hide();
                    $('#filterCity').hide();
                    break;
                case 'district':
                    $('#filterProvince').hide();
                    $('#filterCity').hide();
                    $('#filterDistrict').hide();
                    break;
                case 'subdistrict':
                    $('#filterProvince').hide();
                    $('#filterCity').hide();
                    $('#filterDistrict').hide();
                    $('#filterSubdistrict').hide();
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
            populateData(penduduk,arrayClause,arrayDistrict, selectDistrict, 'district');
        });

        selectDistrict.on('change',function(){
            var selectedProvince = selectProvince.val();
            var selectedCity = selectCity.val();
            var selectedDistrict = $(this).val();
            var arrayClause = [
                {title:'provinsi',value:selectedProvince},
                {title:'kota',value:selectedCity},
                {title:'kecamatan',value:selectedDistrict}
            ];
            populateData(penduduk,arrayClause,arraySubdistrict, selectSubdistrict, 'subdistrict');
        });

        selectSubdistrict.on('change',function(){
            var selectedProvince = selectProvince.val();
            var selectedCity = selectCity.val();
            var selectedDistrict = selectDistrict.val();
            var selectedSubdistrict = $(this).val();
            var arrayClause = [
                {title:'provinsi',value:selectedProvince},
                {title:'kota',value:selectedCity},
                {title:'kecamatan',value:selectedDistrict},
                {title:'kelurahan',value:selectedSubdistrict}
            ];
            populateData(penduduk,arrayClause,arrayRW, selectRW, 'rw');
        });

        selectRW.on('change',function(){
            var selectedProvince = selectProvince.val();
            var selectedCity = selectCity.val();
            var selectedDistrict = selectDistrict.val();
            var selectedSubdistrict = selectSubdistrict.val();
            var selectedRW = $(this).val();
            var arrayClause = [
                {title:'provinsi',value:selectedProvince},
                {title:'kota',value:selectedCity},
                {title:'kecamatan',value:selectedDistrict},
                {title:'kelurahan',value:selectedSubdistrict},
                {title:'rw',value:selectedRW}
            ];

            whereClause(penduduk,arrayClause).get().then((querySnapshot)=>{
                 counter = 1;
                 dataContainer.html('');
                 dataArray = [];
                 querySnapshot.forEach((doc)=>{
                     if(doc && doc.exists){
                        var data = doc.data();
                        var exist = dataExists(data.rt,dataArray);
                        if(!exist){
                            addData(data.rt,dataArray);
                        }
                    } 
                 });

                dataContainer.html('');
                dataArray.forEach((data)=>{
                    console.log(data.name);
                    dataContainer.append(
                        '<tr>'+
                            '<th  scope="row">'+counter+'</th>'+
                            '<td><a href="/rt/'+selectedProvince+'/'+selectedCity+'/'+selectedDistrict+'/'+selectedSubdistrict+'/'+selectedRW+'/'+data.name+'">'+data.name+'</a></td>'+
                            '<td>'+data.count+'</td>'+
                        '</tr>'
                    );
                    counter++;
                });

            });

            $('#pageTitle').html('<strong>Cakupan Wilayah : </strong> '+selectedProvince+' > '+selectedCity+' > '+selectedDistrict+' > '+selectedSubdistrict+' > RW '+selectedRW);

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