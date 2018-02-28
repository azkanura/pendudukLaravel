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
            <a href="#" class="btn btn-success" id="memberStatus">
                <span style="background: #eeeeee;color:transparent;border-radius: 3px">Nama Penduduk Profilnya</span>
            </a>
        </div>
        <div class="m-y-3 text-xs-center">
            <a href="/anggota-edit/{{$kkId}}/{{$id}}" class="btn btn-default">
                <i class="fa fa-pencil fa-fw"></i> Ubah</a>
                &nbsp;&nbsp;<a class="btn btn-danger" name="delete_btn" kkId="{{$kkId}}" id="{{$id}}">
                <i class="fa fa-trash fa-fw"></i> Hapus</a>
        </div>

    </div>

    <hr class="page-wide-block visible-xs visible-sm">

    <div class="col-md-8 col-lg-9">
        <h1 class="font-size-20 m-y-4">
            <span id="profileName">
                <a href="/penduduk-detail/{{$kkId}}">Detail Penduduk</a> > Detail Anggota Keluarga
            </span>

        </h1>

        <ul class="nav nav-tabs" id="profile-tabs">
            <li class="active">
                <a href="#profileInfo" data-toggle="tab" id="profileInfoBtn">
                    Data Pribadi
                </a>
            </li>
        </ul>

        <div class="tab-content tab-content-bordered p-a-0 bg-white">
            <div class="tab-pane fade in active" id="profileInfo">
                <h4 class="text-center" style="padding: 30px;">Loading Data..</h4>
            </div>
        </div>
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
@endsection
@section('inlinejs')
    <script type="text/javascript">
        var profileInfo = $('#profileInfo');
        var familyInfo = $('#familyInfo');
        var assetInfo = $('#assetInfo');
        var id = '{{$id}}';
        var kkId = '{{$kkId}}';

        var penduduk = db.collection('penduduk');
        var person = penduduk.doc(kkId).collection('anggota').doc(id);
        var storageRef = storage.ref();

        var dataContainer = $('#dataContainer');
        var counter = 1;
        var dataArray = [];
        var selectArray = [];
        var result = null;

        console.log(dataArray);

        $(document).on('click','[name="delete_btn"]',function(){
          $('#confirmDeleteBtn').attr('idDelete',$(this).attr('id'));
          $('#confirmDeleteBtn').attr('kkIdDelete',$(this).attr('kkId'));
          $('#confirmDelete').modal('show');
        });

        $('#confirmDeleteBtn').on('click',function(){
          var idDelete = $(this).attr('idDelete');
          var kkIdDelete = $(this).attr('kkIdDelete');
          penduduk.doc(kkIdDelete).collection('anggota').doc(idDelete).delete().then(function(){
            console.log("Document successfully deleted!");
            $(location).attr('href','/penduduk-detail/'+kkIdDelete);
          }).catch(function(error){
            alert('Terjadi error: ', error);
            console.error("Error removing document: ", error);
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

                    var status = data.jenis;
                    $('#memberStatus').html('<i class="fa fa-check"></i>&nbsp;&nbsp;'+status);

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

                    var religion ='';
                    if(data.agama){religion = data.agama;}
                    // var province = data.provinsi;
                    // var city = data.kota;
                    // var district = data.kecamatan;
                    // var subdistrict = data.kelurahan;
                    // var rw = data.rw;
                    // var rt = data.rt;

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
                        // {title:'Provinsi', content:province},
                        // {title:'Kota/Kabupaten', content:city},
                        // {title:'Kecamatan', content:district},
                        // {title:'Kelurahan', content:subdistrict},
                        // {title:'RT/RW', content:rt+'/'+rw},
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




    </script>
@endsection
