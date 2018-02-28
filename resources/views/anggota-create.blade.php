@extends('base')
@section('title')
     Menambah Anggota Keluarga
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

    <div class="col-md-12 col-lg-12">
        <h1 class="font-size-20 m-y-4">
            <span id="profileName">
                Tambah Anggota Keluarga
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
              <div class="row text-xs-center" style="padding:30px">
                <div class="col-md-6">
                  <h4 class="text-center" style="margin-top:0;margin-bottom:12px">Unggah Foto Profil</h4>
                  <img src="/demo/avatars/account.png" alt="" style="width:20%;border-radius:5px" id="profilePicture">
                  <br>
                  <br>
                  <input type="file" id="profileUpload" class="form-control">
                </div>
                <div class="col-md-6">
                  <h4 class="text-center" style="margin-top:0;margin-bottom:12px">Unggah Foto KTP</h4>
                  <img src="/images/card_container.png" alt="" style="width:30%;border-radius:5px" id="idPicture">
                  <br>
                  <br>
                  <input type="file" id="idUpload" class="form-control">
                  <br>
                  <!-- <button id="profileImgUploadBtn" class="btn btn-warning" style="width:100%">Unggah Gambar</button> -->
                </div>
              </div>
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
        var kkId = '{{$kkId}}';

        var penduduk = db.collection('penduduk');
        // var person = penduduk.doc(kkId).collection('anggota').doc(id);
        var storageRef = storage.ref();

        var dataContainer = $('#dataContainer');
        var counter = 1;
        var dataArray = [];
        var selectArray = [];
        var result = null;

        var ppName = '';
        var idName = '';

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
              var name,gender ,status ,income ,jobField ,bloodType ,job,education ,nationality,marriage ,birthPlace ,birthDate ,religion ='';

              var arrayData = [
                  {title:'Nama Lengkap', name:'name'},
                  {title:'Jenis Kelamin', options:optionObject.gender,name:'gender'},
                  {title:'Status dalam Keluarga',options:optionObject.status,name:'status'},
                  {title:'Kisaran Penghasilan', options:optionObject.income,name:'income'},
                  {title:'Bidang Pekerjaan', options:optionObject.jobField,name:'job_field'},
                  {title:'Pekerjaan', name:'job'},

                  {title:'Pendidikan', options:optionObject.education,name:'education'},
                  {title:'Kewarganegaraan', options:optionObject.nationality,name:'nationality'},

                  {title:'Agama', options:optionObject.religion,name:'religion'},
                  {title:'Golongan Darah', options:optionObject.bloodType,name:'blood_type'},


                  {title:'Status Perkawinan', options:optionObject.marriage,name:'marriage'},
                  {title:'Tempat Lahir', name:'birth_place'},
                  {title:'Tanggal Lahir', name:'birth_date'}
              ];

              console.log(arrayData);

              var toAppend = '';
              arrayData.forEach((data)=>{
                var input = '';
                if(!data.options){
                  input = '<input name="'+data.name+'" class="text-default form-control" required>';
                }
                else{
                  var options = '';
                  data.options.forEach((option)=>{
                      options+='<option>'+option+'</option>';
                  });
                  input = '<select name="'+data.name+'" class="select2 form-control" required>'+options+'</select>';
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
              profileInfo.append(
                  // '<form>'+
                  '<input type="hidden" value="'+kkId+'" name="kk_id">'+
                  '<table class="page-messages-items table m-a-0">'+
                          '<tbody>'+
                              toAppend+
                          '</tbody>'+
                  '</table>'+
                  '<button style="margin:20px" class="btn btn-success pull-right" type="submit" id="saveMember">Simpan</button>'
                  // '</form>'
              );
              $(document).find('[name="birth_date"]').datepicker({format: 'dd/mm/yyyy'});

        });


        $(document).on('click','#saveMember',function(){
          var isComplete = true;
          $(document).find('.form-control').each(function(input){
            if(!$(this).val()){
              isComplete = isComplete && false;
            }
          });
          if(isComplete){
            if($(document).find('#profileUpload').prop('files')[0]){
              var photoProfile = $(document).find('#profileUpload').prop('files')[0];
              ppName = 'images/pp-member-'+generateUid()+'.jpg';
              var ppStorageRef=firebase.storage().ref(ppName);
              // var ppTask =
              ppStorageRef.put(photoProfile).then(function(){
                if($(document).find('#idUpload').prop('files')[0]){
                  var photoId = $(document).find('#idUpload').prop('files')[0];
                  idName = 'images/id-member-'+generateUid()+'.jpg';
                  var idStorageRef=firebase.storage().ref(idName);
                  idStorageRef.put(photoId).then(function(){
                    saveData();
                  }).catch(function(error){
                    console.log(error);
                  });
                }
              }).catch(function(error){
                console.log(error);
              });
            }
          }
          else{
            console.log('berhasil');
            alert('Lengkapi semua data terlebih dahulu!');
          }
        });

        function init(){
            $('#profileInfoBtn').click();
        }

        function generateUid(){
          return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
            var r = Math.random() * 16 | 0, v = c == 'x' ? r : (r & 0x3 | 0x8);
            return v.toString(16);
          });
        }

        function saveData(){
          penduduk.doc(kkId).collection('anggota').add({
            agama:$(document).find('[name="religion"]').val(),
            bidang_pekerjaan:$(document).find('[name="job_field"]').val(),
            foto_ktp:idName,
            foto_orang:ppName,
            golongan_darah:$(document).find('[name="blood_type"]').val(),
            jenis:$(document).find('[name="status"]').val(),
            jenis_kelamin:$(document).find('[name="gender"]').val(),
            kewarganegaraan:$(document).find('[name="nationality"]').val(),
            kirasan_penghasilan:$(document).find('[name="income"]').val(),
            nama_lengkap:$(document).find('[name="name"]').val(),
            pekerjaan:$(document).find('[name="job"]').val(),
            pendidikan:$(document).find('[name="education"]').val(),
            status_perkawinan:$(document).find('[name="marriage"]').val(),
            tanggal_lahir:$(document).find('[name="birth_date"]').val(),
            tempat_lahir:$(document).find('[name="birth_place"]').val()
          }).then(function(){
            $(location).attr('href','/penduduk-detail/'+kkId);
          }).catch(function(error){
            alert(error+': Gagal menambahkan anggota keluarga!')
          });
        }

    </script>
@endsection
