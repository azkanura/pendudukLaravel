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
      <br>
      <div class="panel panel-transparent">
          <div class="panel-heading p-x-1">
              <p class="text-center" id="profileSummary">
                  <span style="background: #eeeeee;color:transparent;border-radius: 3px">Nama Penduduk Profilnya</span>
              </p>
              <div class="badge badge-success" style="display:block" id="memberStatus">
                  Kepala Keluarga</div>
          </div>
      </div>

      <div class="text-xs-center">
          <h4 class="text-center" style="margin-top:0;margin-bottom:12px">Ubah Foto Profil</h4>
          <img src="/demo/avatars/account.png" alt="" style="width:60%;border-radius:5px" id="profilePicture">
          <br>
          <br>
          <input type="file" id="profileUpload" class="form-control">
          <br>
          <hr>
          <h4 class="text-center" style="margin-top:0;margin-bottom:12px">Ubah Foto KTP</h4>
          <img src="/images/card_container.png" alt="" style="width:80%;border-radius:5px" id="idPicture">
          <br>
          <br>
          <input type="file" id="idUpload" class="form-control">
          <br>
          <button id="profileImgUploadBtn" class="btn btn-warning" style="width:100%">Unggah Gambar</button>

      </div>
      <hr>

  </div>

    <hr class="page-wide-block visible-xs visible-sm">

    <div class="col-md-8 col-lg-9">
        <h1 class="font-size-20 m-y-4">
            <span id="profileName">
                Edit Anggota Keluarga <a href="/anggota-detail/{{$kkId}}/{{$id}}" class="btn btn-success pull-right">
                    <i class="fa fa-check fa-fw"></i> Selesai Ubah</a>
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
<div class="modal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true" style="padding-top: 15%; overflow-y: visible;" id="modalLoading">
  <div class="modal-dialog modal-m">
    <div class="modal-content">
      <div class="modal-header">
        <h3 style="margin:0;">Sedang mengunggah gambar..</h3>
      </div>
      <div class="modal-body">
        <div class="progress progress-striped active" style="margin-bottom:0;">
          <div class="progress-bar" style="width: 100%">
          </div>
        </div>
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
        var optionObject = {
          affirmative: ['Iya','Tidak'],
          marriage : ['Belum Kawin','Kawin','Cerai Hidup','Cerai Mati'],
          education : ['Tidak / Belum Sekolah','Belum tamat SD','SD','SLTP / Sederajad','SLTA / Sederajad','Diploma I / II','Diploma III / Sarjana Muda','Strata I','Strata II','Strata III'],
          status : ['Suami','Istri','Anak Laki-Laki','Anak Perempuan'],
          religion : ['Islam','Kristen Protestan','Katolik','Hindu','Buddha','Kong Hu Cu'],
          bloodType : ['A','B','AB','O'],
          gender:['Pria','Wanita'],
          jobField : ['Pelayanan Jasa Kesehatan','Pelayanan Jasa Transportasi','Jasa Perbaikan Alat Transportasi','Usaha Pariwisata','Jasa Pos dan Telekomunikasi','Jasa Penyediaan Tenaga Listrik','Jasa Jaringan Pelayanan Air Bersih (PAM)','Jasa Penyediaan Bahan Bakar Minyak dan Gas Bumi','Usaha Swalayan, Pusat Perbelanjaan, dan sejenisnya','Usaha Pusat Perbelanjaan, dan sejenisnya','Media Masa','Pengamanan','Lembaga Konservasi'],
          income:['Tidak Berpenghasilan','Dibawah Rp. 500.000','Rp 500.001 hingga Rp 2.000.000','Rp 2.000.001 hingga Rp 5.000.000','Rp 5.000.001 hingga Rp 10.000.000','Rp 10.000.001 hingga Rp 25.000.000','Diatas Rp 25.000.000'],
          nationality:['Indonesia','Warga Negara Asing']
        };

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

                    var income = '-';
                    if(data.kirasan_penghasilan){income = data.kirasan_penghasilan;}

                    var jobField = '-';
                    if(data.bidang_pekerjaan){jobField = data.bidang_pekerjaan;}

                    var bloodType = '-';
                    if(data.golongan_darah){bloodType = data.golongan_darah;}

                    var job='-';
                    if(data.pekerjaan){job = data.pekerjaan;}

                    var education = '-';
                    if(data.pendidikan){education = data.pendidikan;}

                    $('#profileSummary').html('<strong><h4 style="margin-top:0;border-top:1px solid #eee;padding-top:20px">'+name+'</h4></strong>'+job+' | '+education)
                    var nationality = '-';
                    if(data.kewarganegaraan){nationality = data.kewarganegaraan;}

                    var marriage = '-';
                    if(data.status_perkawinan){marriage = data.status_perkawinan;}

                    var birthPlace = '-';
                    if(data.tempat_lahir){birthPlace = data.tempat_lahir;}

                    var birthDate = '-';
                    if(data.tanggal_lahir){birthDate = data.tanggal_lahir;}

                    var idPicture = '-';
                    if(data.foto_ktp){idPicture = data.foto_ktp;}

                    var profilePicture = '-';
                    if(data.foto_orang){profilePicture = data.foto_orang;}

                    var religion ='-';
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
                        {title:'Nama Lengkap', content:name,name:'name'},
                        {title:'Jenis Kelamin', content:gender,options:optionObject.gender,name:'gender'},
                        {title:'Status dalam Keluarga', content:status,options:optionObject.status,name:'status'},
                        {title:'Kisaran Penghasilan', content:income,options:optionObject.income,name:'income'},

                        {title:'Bidang Pekerjaan', content:jobField,options:optionObject.jobField,name:'job_field'},
                        {title:'Pekerjaan', content:job, name:'job'},

                        {title:'Pendidikan', content:education,options:optionObject.education,name:'education'},
                        {title:'Kewarganegaraan', content:nationality,options:optionObject.nationality,name:'nationality'},

                        {title:'Agama', content:religion,options:optionObject.religion,name:'religion'},
                        {title:'Golongan Darah', content:bloodType,options:optionObject.bloodType,name:'blood_type'},


                        {title:'Status Perkawinan', content:marriage,options:optionObject.marriage,name:'marriage'},
                        {title:'Tempat Lahir', content:birthPlace,name:'birth_place'},
                        {title:'Tanggal Lahir', content:birthDate,name:'birth_date'}
                    ];

                    console.log(arrayData);

                    var toAppend = '';
                    arrayData.forEach((data)=>{
                      var input = '';
                      if(!data.options){
                        input = '<input name="'+data.name+'" class="text-default form-control" value="'+data.content+'">';
                      }
                      else{
                        var options = '';
                        data.options.forEach((option)=>{
                          if(option.toLowerCase()==data.content.toLowerCase()){
                            options+='<option selected>'+option+'</option>';
                          }
                          else{
                            options+='<option>'+option+'</option>';
                          }
                        });
                        input = '<select name="'+data.name+'" class="select2 form-control">'+options+'</select>';
                      }

                      toAppend+='<tr>'+
                                  '<td style="padding:20px">'+
                                    '<div class="box m-a-0 bg-transparent">'+
                                      '<span class="page-messages-item-from box-cell text-default">'+
                                          data.title+
                                      '</span>'+
                                      '<div class="page-messages-item-subject box-cell">'+
                                          input+
                                      '</div>'+
                                    '</div>'+
                                  '</td>'+
                                '</tr>';
                    });

                    profileInfo.html('');
                    profileInfo.append(
                        '<input type="hidden" value="'+id+'" name="id">'+
                        '<input type="hidden" value="'+kkId+'" name="kk_id">'+
                        '<table class="page-messages-items table m-a-0">'+
                                '<tbody>'+
                                    toAppend+
                                '</tbody>'+
                        '</table>'+
                        '<button style="margin:20px" class="btn btn-success pull-right" onclick="anggotaPersonalSave()">Simpan</button>'
                    );
                    $(document).find('[name="birth_date"]').datepicker({format: 'dd/mm/yyyy'});
                }
            });
        });

        $('#profileImgUploadBtn').on('click',function(){
          $('#modalLoading').modal('show');
          var photoProfile = $('#profileUpload').prop('files')[0];
          var photoId = $('#idUpload').prop('files')[0];
          var resident = penduduk.doc(kkId).collection('anggota').doc(id);
          if(photoProfile){
            var pName = 'images/p-'+id+'.jpg';
            var pStorageRef=firebase.storage().ref(pName);
            var pTask = pStorageRef.put(photoProfile);
            pTask.on('state_changed',
              function complete(){
                resident.update({
                  foto_orang:pName
                });
              },
              function error(err){
                console.log('error: '+err);
              }
            );
          }

          if(photoId){
            var iName = 'images/i-'+id+'.jpg';
            var iStorageRef=firebase.storage().ref(iName);
            var iTask = iStorageRef.put(photoId);
            iTask.on('state_changed',
              function complete(){
                resident.update({
                  foto_ktp:iName
                });
              },
              function error(err){
                console.log('error: '+err);
              }
            );
          }

          setTimeout(function(){
            $(location).attr('href','/anggota-edit/'+kkId+'/'+id);
          },5000);


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
