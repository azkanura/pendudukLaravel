@extends('base')
@section('title')
     Detail Penduduk
@endsection

@section('inlinecss')
<style>
    .page-profile-v1-avatar {
        max-width: 160px;
        border: 4px solid #fff;
    }
</style>
@endsection
<!-- Content -->
@section('content')
<div class="row m-t-1">
    <div class="col-md-4 col-lg-3">
        <div class="text-xs-center">
            <img src="/demo/avatars/account.png" alt="" class="page-profile-v1-avatar border-round" id="profilePicture">
            <br>
            <br>
            <img src="/images/card_container.png" alt="" style="width:100%;border-radius:5px" id="idPicture">
        </div>
        <div class="panel panel-transparent">
            <div class="panel-heading p-x-1">
                <p class="text-center" id="profileSummary">
                    <span style="background: #eeeeee;color:transparent;border-radius: 3px">Nama Penduduk Profilnya</span>
                </p>
            </div>
        </div>
        <div class="m-y-3 text-xs-center">
            <a href="#" class="btn btn-success">
                <i class="fa fa-check"></i>&nbsp;&nbsp;Kepala Keluarga</a>
            <!-- <a href="#" class="btn">
                <i class="fa fa-envelope"></i>
            </a> -->
        </div>
        <div class="m-y-3 text-xs-center">
            <a href="/penduduk-edit/{{$id}}" class="btn btn-default">
                <i class="fa fa-pencil fa-fw"></i> Ubah</a>&nbsp;&nbsp;
            <a class="btn btn-danger" name="delete_btn" id="{{$id}}">
                <i class="fa fa-trash fa-fw"></i> Hapus</a>
        </div>

    </div>

    <hr class="page-wide-block visible-xs visible-sm">

    <div class="col-md-8 col-lg-9">
        <h1 class="font-size-20 m-y-4">
            <span id="profileName">
                Detail Penduduk
            </span>
        </h1>

        <ul class="nav nav-tabs" id="profile-tabs">
            <li class="active">
                <a href="#profileInfo" data-toggle="tab" id="profileInfoBtn">
                    Data Pribadi
                </a>
            </li>
            <li>
                <a href="#familyInfo" data-toggle="tab" id="familyInfoBtn">
                    Data Keluarga
                </a>
            </li>
            <li>
                <a href="#assetInfo" data-toggle="tab" id="assetInfoBtn">
                    Data Aset
                </a>
            </li>
            <li>
                <a href="#documentInfo" data-toggle="tab" id="documentInfoBtn">
                    Data Dokumen
                </a>
            </li>
        </ul>

        <div class="tab-content tab-content-bordered p-a-0 bg-white">
            <div class="tab-pane fade in active" id="profileInfo">
                <h4 class="text-center" style="padding: 30px;">Loading Data..</h4>
            </div>
            <div class="tab-pane fade" id="familyInfo">
                <h4 class="text-center" style="padding: 30px;">Loading Data..</h4>
            </div>
            <div class="tab-pane fade" id="assetInfo" style="padding: 30px;">
                <h4 class="text-center">
                    Loading Data..
                </h4>
            </div>
            <div class="tab-pane fade" id="documentInfo" style="padding: 30px;">
                <h4 class="text-center">Loading Data..</h4>
            </div>
        </div>
        <!-- <div id="map" style="width:100%;height:300px;"></div> -->
    </div>
</div>
<div class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              Konfirmasi Menghapus
          </div>
          <div class="modal-body">
              Apakah anda yakin akan menghapus data?
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
              <a class="btn btn-danger btn-ok" id="confirmDeleteBtn">Hapus</a>
          </div>
      </div>
  </div>
</div>
<div class="modal fade" id="confirmDeleteMember" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header">
              Konfirmasi Menghapus
          </div>
          <div class="modal-body">
              Apakah anda yakin akan menghapus data anggota keluarga ini?
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
              <a class="btn btn-danger btn-ok" id="confirmDeleteMemberBtn">Hapus</a>
          </div>
      </div>
  </div>
</div>
@endsection
@section('inlinejs')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBuZNWjvPHba3Trl2m_pNSPmYxRjxK8AR4"
async defer></script>
    <script type="text/javascript">
        var profileInfo = $('#profileInfo');
        var familyInfo = $('#familyInfo');
        var assetInfo = $('#assetInfo');
        var documentInfo = $('#documentInfo');
        var id = '{{$id}}';

        var penduduk = db.collection('penduduk');
        var person = penduduk.doc(id);
        var storageRef = storage.ref();

        var dataContainer = $('#dataContainer');
        var counter = 1;
        var dataArray = [];
        var selectArray = [];
        var result = null;

        console.log(dataArray);

        $('#profileInfoBtn').on('click',function(){
                person.get().then((doc)=>{
                if(doc && doc.exists){
                    var data = doc.data();

                    var name='';
                    if(data.nama_lengkap){
                      name = data.nama_lengkap;
                    }
                    // $('#profileName').html(name+'<span class="font-weight-normal">\'s profile</span>');

                    var gender = '';
                    if(data.jenis_kelamin){
                      gender = data.jenis_kelamin;
                    }

                    var income = '';
                    if(data.kirasan_penghasilan){income = data.kirasan_penghasilan;}

                    var jobField = '';
                    if(data.bidang_pekerjaan){jobField = data.bidang_pekerjaan;}

                    var bloodType = '';
                    if(data.golongan_darah){bloodType = data.golongan_darah;}

                    var job='';
                    if(data.pekerjaan){job = data.pekerjaan;}

                    var education = '';
                    if(data.pendidikan){education = data.pendidikan;}

                    $('#profileSummary').html('<strong><h4 style="margin-top:0;border-top:1px solid #eee;padding-top:20px">'+name+'</h4></strong>'+job+' | '+education)

                    var nationality = '';
                    if(data.kewarganegaraan){nationality = data.kewarganegaraan;}

                    var marriage = '';
                    if(data.status_perkawinan){marriage = data.status_perkawinan;}

                    var birthPlace = '';
                    if(data.tempat_lahir){birthPlace = data.tempat_lahir;}

                    var birthDate = '';
                    if(data.tanggal_lahir){birthDate = data.tanggal_lahir;}

                    var idPicture = '';
                    if(data.foto_ktp){idPicture = data.foto_ktp;}

                    var profilePicture = '';
                    if(data.foto_orang){profilePicture = data.foto_orang;}

                    var province = '';
                    if(data.provinsi){province = data.provinsi;}

                    var city = '';
                    if(data.kota){city = data.kota;}

                    var district = '';
                    if(data.kecamatan){district = data.kecamatan;}

                    var subdistrict = '';
                    if(data.kelurahan){subdistrict = data.kelurahan;}

                    var rw='';
                    if(data.rw){rw = data.rw;}

                    var rt='';
                    if(data.rt){rt = data.rt;}

                    var religion ='';
                    if(data.agama){religion = data.agama;}

                    if(profilePicture){
                      storageRef.child(profilePicture).getDownloadURL().then((url)=>{
                          var image = $('#profilePicture');
                          image.attr('src',url);
                      }).catch(function(error){
                          console.log('Cannot get picture!');
                      });
                    }

                    if(idPicture){
                      storageRef.child(idPicture).getDownloadURL().then((url)=>{
                          var image = $('#idPicture');
                          image.attr('src',url);
                      }).catch(function(error){
                          console.log('Cannot get picture!');
                      });
                    }


                    var arrayData = [
                        {title:'Nama Lengkap', content:name},
                        {title:'Jenis Kelamin', content:gender},
                        {title:'Kisaran Penghasilan', content:income},
                        {title:'Bidang Pekerjaan', content:jobField},

                        {title:'Pekerjaan', content:job},
                        {title:'Pendidikan', content:education},
                        {title:'Kewarganegaraan', content:nationality},

                        {title:'Agama', content:religion},
                        {title:'Golongan Darah', content:bloodType},

                        {title:'Status Perkawinan', content:marriage},
                        {title:'Tempat dan Tanggal Lahir', content:birthPlace+', '+birthDate},
                        {title:'Provinsi', content:province},
                        {title:'Kota/Kabupaten', content:city},
                        {title:'Kecamatan', content:district},
                        {title:'Kelurahan', content:subdistrict},
                        {title:'RT/RW', content:rt+'/'+rw},
                    ];

                    console.log(arrayData);

                    var toAppend = '';
                    arrayData.forEach((data)=>{
                        toAppend+='<tr>'+
                                    '<td style="padding:20px">'+
                                      '<div class="box m-a-0 bg-transparent">'+
                                        '<span class="page-messages-item-from box-cell text-default">'+
                                            data.title+
                                        '</span>'+
                                        '<div class="page-messages-item-subject box-cell">'+
                                            '<span class="text-default font-weight-bold">'+
                                                data.content+
                                            '</span>'+
                                        '</div>'+
                                      '</div>'+
                                    '</td>'+
                                  '</tr>';
                    });

                    profileInfo.html('');
                    profileInfo.append(
                        '<table class="page-messages-items table m-a-0">'+
                                '<tbody>'+
                                    toAppend+
                                '</tbody>'+
                        '</table>'
                    );
                }
            });
        });

        var src = '';

        $('#familyInfoBtn').on('click',function(){
            var members = person.collection('anggota');
            // if(members && members.exists){

                members.get().then((query)=>{
                    familyInfo.html('');
                    familyInfo.append(
                      '<div class="row form-group"><div class="col-md-12" style="padding:15px 24px 0"><a id="addMember" href="/anggota-create/'+id+'"class="btn btn-success pull-right">Tambah Anggota</a></div></div><hr>'
                    );
                    query.forEach((doc)=>{
                        data=doc.data();
                        var anggotaId = doc.id;
                        var type = data.jenis;
                        var name = data.nama_lengkap;
                        var gender = data.jenis_kelamin;
                        var profilePicture = data.foto_orang;

                        if(profilePicture){
                            storageRef.child(profilePicture).getDownloadURL().then((url)=>{
                                familyInfo.append(
                                    '<div class="widget-followers-item">'+
                                        '<img src="'+url+'" alt="" class="widget-followers-avatar">'+
                                        '<div class="widget-followers-controls">'+
                                            '<a href="/anggota-detail/'+id+'/'+anggotaId+'" class="btn btn-sm btn-outline">'+type+'</a>'+
                                        '</div>'+
                                        '<a href="/anggota-detail/'+id+'/'+anggotaId+'" class="widget-followers-name">'+name+'</a>'+
                                        '<a href="/anggota-detail/'+id+'/'+anggotaId+'" class="widget-followers-username">'+gender+'</a>'+
                                        '<a class="btn btn-sm delete-btn btn-danger pull-right" id="'+id+'" anggotaId="'+anggotaId+'" style="margin-left:5px;"><i class="fa fa-trash fa-fw"></i>&nbsp;Hapus</a>'+
                                        '<a href="/anggota-edit/'+id+'/'+anggotaId+'" class="btn btn-sm btn-primary pull-right"><i class="fa fa-pencil fa-fw"></i>&nbsp;Ubah</a>'+
                                    '</div>'
                                );
                            }).catch((error)=>{
                                familyInfo.append(
                                    '<div class="widget-followers-item">'+
                                        '<img src="/demo/avatars/account.png" alt="" class="widget-followers-avatar">'+
                                        '<div class="widget-followers-controls">'+
                                            '<a href="/anggota-detail/'+id+'/'+anggotaId+'" class="btn btn-sm btn-outline">'+type+'</a>'+
                                        '</div>'+
                                        '<a href="/anggota-detail/'+id+'/'+anggotaId+'" class="widget-followers-name">'+name+'</a>'+
                                        '<a href="/anggota-detail/'+id+'/'+anggotaId+'" class="widget-followers-username">'+gender+'</a>'+
                                        '<a href="/anggota-edit/'+id+'/'+anggotaId+'" class="btn btn-sm btn-primary pull-right"><i class="fa fa-pencil fa-fw"></i>&nbsp;Ubah Data</a>'+
                                    '</div>'
                                );
                            });
                        }
                        else{
                            familyInfo.append(
                                    '<div class="widget-followers-item">'+
                                        '<img src="/demo/avatars/account.png" alt="" class="widget-followers-avatar">'+
                                        '<div class="widget-followers-controls">'+
                                            '<a href="/anggota-detail/'+id+'/'+anggotaId+'" class="btn btn-sm btn-outline">'+type+'</a>'+
                                        '</div>'+
                                        '<a href="/anggota-detail/'+id+'/'+anggotaId+'" class="widget-followers-name">'+name+'</a>'+
                                        '<a href="/anggota-detail/'+id+'/'+anggotaId+'" class="widget-followers-username">'+gender+'</a>'+
                                        '<a href="/anggota-edit/'+id+'/'+anggotaId+'" class="btn btn-sm btn-primary pull-right"><i class="fa fa-pencil fa-fw"></i>&nbsp;Ubah Data</a>'+
                                    '</div>'
                                );
                        }


                    });
                });
            // }


        });

        $('#assetInfoBtn').on('click',function(){
                var asset = person.collection('rumah');

                var assetData = asset.doc('data');
                var assetImage = asset.doc('gambar');
                console.log('Asset data:');
                console.log(assetData);
                console.log('asset image:');
                console.log(assetImage);
                assetData.get().then((doc)=>{
                    if(doc && doc.exists){
                        var data = doc.data();
                        var luas_lantai,jenis_lantai,jenis_dinding,fasilitas,sumber_air,sumber_penerangan,bahan_bakar,berapa_kali_sepekan,berapa_kali_seminggu,beberapa_kali_sekali,anggota_sakit,list_barang,kredit_usaha,status_bangunan='-';
                        if(data.luas_lantai){luas_lantai=data.luas_lantai}
                        if(data.jenis_lantai){jenis_lantai=data.jenis_lantai}
                        if(data.jenis_dinding){jenis_dinding=data.jenis_dinding}
                        if(data.fasilitas){fasilitas=data.fasilitas}
                        if(data.sumber_air){sumber_air=data.sumber_air}
                        if(data.sumber_penerangan){sumber_penerangan=data.sumber_penerangan}
                        if(data.bahan_bakar){bahan_bakar=data.bahan_bakar}
                        if(data.berapa_kali_seminggu){berapa_kali_seminggu=data.berapa_kali_seminggu}
                        if(data.berapa_kali_sepekan){berapa_kali_sepekan=data.berapa_kali_sepekan}
                        if(data.berapa_kali_sekali){berapa_kali_sekali=data.berapa_kali_sekali}
                        if(data.anggota_sakit){anggota_sakit=data.anggota_sakit}
                        if(data.list_barang){list_barang=data.list_barang}
                        if(data.kredit_usaha){kredit_usaha=data.kredit_usaha}
                        if(data.status_bangunan){status_bangunan=data.status_bangunan}

                        var arrayData = [
                            {title:'Luas lantai bangunan tempat tinggal dengan satuan', content:luas_lantai},
                            {title:'Jenis lantai tempat tinggal yang terluas', content:jenis_lantai},
                            {title:'Jenis dinding tempat tinggal yang terluas', content:jenis_dinding},
                            {title:'Fasilitas tempat buang air besar', content:fasilitas},
                            {title:'Sumber air minum', content:sumber_air},
                            {title:'Sumber penerangan utama', content:sumber_penerangan},
                            {title:'Bahan bakar utama untuk memasak sehari-hari', content:bahan_bakar},
                            {title:'Berapa kali dalam seminggu rumah tangga membeli daging/ayam/susu', content:berapa_kali_seminggu},
                            {title:'Berapa kali dalam sehari biasanya anggota rumah tangga makan', content:berapa_kali_sekali},
                            {title:'Berapa stel pakaian baru dalam setahun biasanya dibeli oleh / untuk setiap / sebagian besar anggota rumah tangga', content:berapa_kali_sepekan},
                            {title:'Apabila ada anggota keluarga yang sakit, apakah mampu berobat ke puskesmas, atau poliklinik', content:anggota_sakit},
                            {title:'Barang yang dimiliki rumah tangga yang masing-masing bernilai paling sedikit Rp. 500.000,-', content:list_barang},
                            {title:'Apakah rumah tangga pernah menerima kredit usaha ( seperti UKM/UMKM ) setahun yang lalu', content:kredit_usaha},
                            {title:'Status penguasaan bangunan tempat tinggal yang ditempati', content:status_bangunan},
                        ];

                        var toAppend = '';
                        arrayData.forEach((data)=>{
                            toAppend+='<div class="row form-group">'+
                                        '<label class="control-label col-md-6">'+data.title+'</label>'+
                                        '<p class="col-md-6">'
                                            +data.content+
                                        '</p>'+
                                    '</div><hr>';
                        });

                        assetInfo.html('');
                        assetInfo.append(toAppend);
                    }

                    else{
                      assetInfo.html('');
                      assetInfo.append('<h4 class="text-center">'+
                        'Tidak ada data rumah'+
                      '</h4>');
                    }
                }).catch((error)=>{
                  assetInfo.html('');
                  assetInfo.append('<h4 class="text-center">'+
                    'Tidak ada data rumah'+
                  '</h4>');
                });

                assetImage.get().then((doc)=>{
                    if(doc && doc.exists){
                        assetInfo.append(
                            '<br>'+
                            '<div class="form-group">'+
                                '<label class="control-label">Foto Kepala Keluarga</label>'+
                                '<br>'+
                                '<br>'+
                                '<img src="/images/no-image.png" id="photoFamilyHead" style="width:70%;display:block"/>'+
                            '</div><hr>'+

                            '<div class="form-group">'+
                                '<label class="control-label">Foto Depan Rumah</label>'+
                                '<br>'+
                                '<br>'+
                                '<img src="/images/no-image.png" id="photoTerrace" style="width:70%;display:block"/>'+
                            '</div><hr>'+

                            '<div class="form-group">'+
                                '<label class="control-label">Foto Ruang Tamu</label>'+
                                '<br>'+
                                '<br>'+
                                '<img src="/images/no-image.png" id="photoLivingroom" style="width:70%;display:block"/>'+
                            '</div><hr>'+

                            '<div class="form-group">'+
                                '<label class="control-label">Foto Dapur</label>'+
                                '<br>'+
                                '<br>'+
                                '<img src="/images/no-image.png" id="photoKitchen" style="width:70%;display:block"/>'+
                            '</div><hr>'+

                            '<div class="form-group">'+
                                '<label class="control-label">Foto Belakang Rumah</label>'+
                                '<br>'+
                                '<br>'+
                                '<img src="/images/no-image.png" id="photoBackyard" style="width:70%;display:block"/>'+
                            '</div>'
                        );

                        var data = doc.data();

                        var photoFamilyHead = data.foto_kepala_keluarga;
                        var photoTerrace = data.foto_depan_rumah;
                        var photoLivingroom = data.foto_ruang_tamu;
                        var photoKitchen = data.foto_dapur;
                        var photoBackyard = data.foto_belakang_rumah;

                        storageRef.child(photoFamilyHead).getDownloadURL().then((url)=>{
                            var image = assetInfo.find('#photoFamilyHead');
                            image.attr('src',url);
                        });

                        storageRef.child(photoTerrace).getDownloadURL().then((url)=>{
                            var image = assetInfo.find('#photoTerrace');
                            image.attr('src',url);

                        });

                        storageRef.child(photoLivingroom).getDownloadURL().then((url)=>{
                            var image = assetInfo.find('#photoLivingroom');
                            image.attr('src',url);

                        });

                        storageRef.child(photoKitchen).getDownloadURL().then((url)=>{
                            var image = assetInfo.find('#photoKitchen');
                            image.attr('src',url);

                        });

                        storageRef.child(photoBackyard).getDownloadURL().then((url)=>{
                            var image = assetInfo.find('#photoBackyard');
                            image.attr('src',url);

                        });
                    }

                    else{
                      assetInfo.append('<hr><h4 class="text-center">'+
                        'Tidak ada gambar rumah'+
                      '</h4>');
                    }
                }).catch((error)=>{
                  assetInfo.append('<h4 class="text-center">'+
                    'Tidak ada gambar rumah'+
                  '</h4>')
                });


        });


        $('#documentInfoBtn').on('click',function(){

                var documents = person.collection('dokumen');

                documents.get().then((querySnapshot)=>{
                    querySnapshot.forEach((doc)=>{
                        var data = doc.data();
                        var coordinateText = data.koordinat;
                        var coordinateArray = coordinateText.split(',');
                        var coordinate = {lat:parseFloat(coordinateArray[0]),lng:parseFloat(coordinateArray[1])};
                        console.log(coordinate);
                        var arrayData = [
                            {title:'Nomor Kartu Keluarga', content:data.nomor_kk},
                            {title:'Provinsi', content:data.provinsi},
                            {title:'Kota / Kabupaten', content:data.kota},
                            {title:'Kecamatan', content:data.kecamatan},
                            {title:'Kelurahan', content:data.kelurahan},
                            {title:'RT/RW', content:data.rt+'/'+data.rw},
                            {title:'Alamat', content:data.alamat}
                        ];

                        var toAppend = '';
                        arrayData.forEach((data)=>{
                            toAppend+='<div class="row form-group">'+
                                        '<label class="control-label col-md-5">'+data.title+'</label>'+
                                        '<p class="col-md-7">'
                                            +data.content+
                                        '</p>'+
                                    '</div>';
                        });

                        documentInfo.html('');
                        documentInfo.append(toAppend);
                        documentInfo.append('<div class="row form-group">'+
                                    '<label class="control-label col-md-12">Lokasi di Peta</label><br><br>'+
                                    '<div id="map" style="width:100%;height:300px"></div>'+
                                '</div>');

                        initMap();
                        function initMap(){
                            var map = new google.maps.Map(document.getElementById('map'),{
                              center: coordinate,
                              zoom: 10
                            });

                            var marker = new google.maps.Marker({
                              position:coordinate,
                              map:map,
                              // icon:'/images/marker.png'
                            });

                            var infoWindow = new google.maps.InfoWindow({
                              content:'<p>Nomor KK: '+data.nomor_kk+'</p>'+
                                '<p>Alamat: '+data.alamat+
                                ',RT '+data.rt+
                                '/RW '+data.rw+
                                ' Kelurahan '+data.kelurahan+
                                ', Kecamatan '+data.kecamatan+
                                '<br> '+data.kota+','+data.provinsi+'</p>'
                            });

                            marker.addListener('click',function(){
                              infoWindow.open(map,marker);
                            });
                        }

                        // initMap();

                        documentInfo.append(
                            '<br>'+
                            '<div class="form-group">'+
                                '<label class="control-label">Foto Kartu Keluarga</label>'+
                                '<br>'+
                                '<br>'+
                                '<img src="/images/no-image.png" id="kkPhoto" style="width:70%;display:block"/>'+
                            '</div><hr>'
                        );

                        storageRef.child(data.foto_kk).getDownloadURL().then((url)=>{
                            var image = documentInfo.find('#kkPhoto');
                            image.attr('src',url);
                        });
                    });
                });

        });

        $(document).on('click','.delete-btn',function(){
          $('#confirmDeleteMemberBtn').attr('kkIdDelete',$(this).attr('id'));
          $('#confirmDeleteMemberBtn').attr('idDelete',$(this).attr('anggotaId'));
          $('#confirmDeleteMember').modal('show');
        });

        $('#confirmDeleteMemberBtn').on('click',function(){
          var idDelete = $(this).attr('idDelete');
          var kkIdDelete = $(this).attr('kkIdDelete');
          penduduk.doc(kkIdDelete).collection('anggota').doc(idDelete).delete().then(function(){
            console.log("Document successfully deleted!");
            location.reload(true);
          }).catch(function(error){
            alert('Terjadi error: ', error);
            console.error("Error removing document: ", error);
          });
        });

        $(document).on('click','[name="delete_btn"]',function(){
          $('#confirmDeleteBtn').attr('idDelete',$(this).attr('id'));
          $('#confirmDelete').modal('show');
        });

        $('#confirmDeleteBtn').on('click',function(){
          var idDelete = $(this).attr('idDelete');
          penduduk.doc(idDelete).get().then(function(doc){
            if(doc && doc.exists){
              data=doc.data();
              var province = data.provinsi;
              var city = data.kota;
              var district = data.kecamatan;
              var subdistrict = data.kelurahan;
              var rw =data.rw;
              var rt = data.rt;

              penduduk.doc(idDelete).delete().then(function(){
                console.log("Document successfully deleted!");
                $(location).attr('href','/rt/'+province+'/'+city+'/'+district+'/'+subdistrict+'/'+rw+'/'+rt);
              }).catch(function(error){
                alert('Terjadi error: ', error);
                console.error("Error removing document: ", error);
              });

            }
            else{
              alert('Data does not exist!');
            }
          });


        });

        function init(){
          $('#profileInfoBtn').click();
        }

        function addData(id,name,count){
            dataContainer.append(
            '<tr>'+
                '<th  scope="row">'+counter+'</th>'+
                '<td><a href="/penduduk-detail/'+id+'">'+name+'</a></td>'+
                '<td>'+count+'</td>'+
            '</tr>'
            );
            counter++;
        }
    </script>
@endsection
