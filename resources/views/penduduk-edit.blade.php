@extends('base')
@section('title')
     Ubah Detail Penduduk
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
                <div class="badge badge-success" style="display:block">
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
                Ubah Detail Penduduk <a href="/penduduk-detail/{{$id}}" class="btn btn-success pull-right">
                    <i class="fa fa-check fa-fw"></i> Selesai Ubah</a>
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
        console.log(id);

        var penduduk = db.collection('penduduk');
        var person = penduduk.doc(id);
        var storageRef = storage.ref();

        var dataContainer = $('#dataContainer');
        var counter = 1;
        var dataArray = [];
        var selectArray = [];
        var result = null;

        var districtOption = ["Kepulauan Seribu Selatan","Kepulauan Seribu Utara"];

        var subdistrictOptionU = ["Pulau Panggang","Pulau Kelapa","Pulau Harapan"];
        var subdistrictOptionS = ["Pulau Tidung","Pulau Pari","Pulau Untung Jawa"];

        var optionObject = {
          affirmative: ['Iya','Tidak'],
          marriage : ['Belum Kawin','Kawin','Cerai Hidup','Cerai Mati'],
          education : ['Tidak / Belum Sekolah','Belum tamat SD','SD','SLTP / Sederajad','SLTA / Sederajad','Diploma I / II','Diploma III / Sarjana Muda','Strata I','Strata II','Strata III'],
          status : ['Suami','Istri','Anak Laki-Laki','Anak Perempuan'],
          religion : ['Islam','Kristen Protestan','Katolik','Hindu','Buddha','Kong Hu Cu'],
          bloodType : ['A','B','AB','O'],
          gender:['Pria','Wanita'],
          jobField : ['Pelayanan Jasa Kesehatan','Pelayanan Jasa Transportasi','Jasa Perbaikan Alat Transportasi','Usaha Pariwisata','Jasa Pos dan Telekomunikasi','Jasa Penyediaan Tenaga Listrik','Jasa Jaringan Pelayanan Air Bersih (PAM)','Jasa Penyediaan Bahan Bakar Minyak dan Gas Bumi','Usaha Swalayan, Pusat Perbelanjaan, dan sejenisnya','Usaha Pusat Perbelanjaan, dan sejenisnya','Media Masa','Pengamanan','Lembaga Konservasi','Lainnya','Tidak Bekerja'],
          income:['Tidak Berpenghasilan','Dibawah Rp. 500.000','Rp 500.001 hingga Rp 2.000.000','Rp 2.000.001 hingga Rp 5.000.000','Rp 5.000.001 hingga Rp 10.000.000','Rp 10.000.001 hingga Rp 25.000.000','Diatas Rp 25.000.000'],
          nationality:['Indonesia','Warga Negara Asing'],
          area : [{value:'0 – 100 m2',score:6},{value:'101 – 500 m2',score:3},{value:'501 – 1000m2',score:2},{value:'>1001m2',score:1}],
          floor : [{value:'Keramik',score:1},{value:'Semen',score:2},{value:'Kayu keadaan jelek',score:5},{value:'Kayu keadaan bagus',score:1},{value:'Bambu kualitas rendah',score:3},{value:'Bambu kualitas tinggi',score:4}],
          wall : [{value:'Bambu',score:5},{value:'Tembok',score:1},{value:'Kayu keadaan jelek',score:3},{value:'Kayu keadaan bagus',score:2}],
          goods: [{value:'Tabungan',score:5},{value:'Ternak',score:4},{value:'Emas',score:2},{value:'Sepeda Motor',score:3},{value:'Tv Berwarna',score:1},{value:'Tidak mempunyai satupun',score:6}],
          houseStatus: [{value:'Milik sendiri / bebas sewa',score:1},{value:'Tidak',score:4}],
          facility : [{value:'Bersama / umum',score:6},{value:'Lainnya',score:3}],
          water : [{value:'Sumur atau air mata tak terlindung',score:7},{value:'Air sungai',score:5},{value:'Air hujan',score:6},{value:'Air kemasan',score:1},{value:'Air ledeng',score:3},{value:'Pompa',score:4},{value:'Mata air terlindung',score:2}],
          electricity : [{value:'Bukan listrik',score:4},{value:'Listrik PLN',score:1}],
          cooking: [{value:'Kayu/Arang',score:6},{value:'Minyak tanah',score:4},{value:'Gas / Listrik',score:2}],
          meat: [{value:'Dua kali dan lebih',score:1},{value:'Satu kali',score:5},{value:'Tidak pernah membeli',score:6}],
          meal : [{value:'Tiga kali dan lebih',score:1},{value:'Dua kali',score:4},{value:'Satu kali',score:6}],
          clothing : [{value:'Dua stel dan lebih',score:2},{value:'Satu stel',score:4},{value:'Tidak pernah membeli',score:6}],
          credit: [{value:'Ya',score:1},{value:'Tidak',score:5}],
          sickness: [{value:'Ya',score:3},{value:'Tidak',score:5}]
        };

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
                    subdistrictOption=[];
                    if(district=='Kepulauan Seribu Selatan'){
                      subdistrictOption = subdistrictOptionS;
                    }
                    else{
                      subdistrictOption = subdistrictOptionU;
                    }
                    var arrayData = [
                        {title:'Nama Lengkap',name:'name', content:name},
                        {title:'Jenis Kelamin', name:'gender',content:gender,options:optionObject.gender},
                        {title:'Kisaran Penghasilan', name:'income',content:income,options:optionObject.income},
                        {title:'Bidang Pekerjaan', name:'job_field',content:jobField,options:optionObject.jobField},

                        {title:'Pekerjaan', name:'job',content:job},
                        {title:'Pendidikan', name:'education',content:education,options:optionObject.education},
                        {title:'Kewarganegaraan', name:'nationality', content:nationality,options:optionObject.nationality},

                        {title:'Agama', name:'religion', content:religion,options:optionObject.religion},
                        {title:'Golongan Darah', name:'blood_type', content:bloodType,options:optionObject.bloodType},

                        {title:'Status Perkawinan', name:'marriage', content:marriage,options:optionObject.marriage},
                        {title:'Tempat Lahir', name:'birth_place', content:birthPlace},
                        {title:'Tanggal Lahir', name:'birth_date', content:birthDate},
                        {title:'Provinsi', name:'province', content:province,options:['DKI Jakarta']},
                        {title:'Kota/Kabupaten', name:'city', content:city,options:['Kab. Kepulauan Seribu']},
                        {title:'Kecamatan', name:'district', content:district,options:districtOption},
                        {title:'Kelurahan', name:'subdistrict', content:subdistrict,options:subdistrictOption},
                        {title:'RW', name:'rw', content:rw},
                        {title:'RT', name:'rt', content:rt},
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
                        '<table class="page-messages-items table m-a-0">'+
                                '<tbody>'+
                                    toAppend+
                                '</tbody>'+
                        '</table>'+
                        '<button style="margin:20px" class="btn btn-success pull-right" onclick="pendudukPersonalSave()">Simpan</button>'
                    );
                    $(document).find('[name="birth_date"]').datepicker({format: 'dd/mm/yyyy'});
                }
            });
        });

        var src = '';

        $('#familyInfoBtn').on('click',function(){
            var members = person.collection('anggota');
            // if(members && members.exists){
                console.log(id);
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
                                      '<a class="btn btn-sm delete-btn btn-danger pull-right" id="'+id+'" anggotaId="'+anggotaId+'" style="margin-left:5px;"><i class="fa fa-trash fa-fw"></i>&nbsp;Hapus</a>'+
                                      '<a href="/anggota-edit/'+id+'/'+anggotaId+'" class="btn btn-sm btn-primary pull-right"><i class="fa fa-pencil fa-fw"></i>&nbsp;Ubah</a>'+
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
                var luas_lantai,jenis_lantai,jenis_dinding,fasilitas,sumber_air,sumber_penerangan,bahan_bakar,berapa_kali_sepekan,berapa_kali_seminggu,berapa_kali_sekali,anggota_sakit,list_barang,kredit_usaha,status_bangunan,skor_anggota_sakit,skor_bahan_bakar,skor_berapa_kali_sekali,skor_berapa_kali_seminggu,skor_berapa_kali_sepekan,skor_fasilitas,skor_jenis_dinding,skor_jenis_lantai,skor_kredit_usaha,skor_list_barang,skor_luas_lantai,skor_status_bangunan,skor_sumber_air,skor_sumber_penerangan='';
                var list_barang_array=[];
                assetData.get().then((doc)=>{
                    if(doc && doc.exists){
                        var data = doc.data();
                        if(data.luas_lantai){luas_lantai=data.luas_lantai}
                        if(data.jenis_lantai){jenis_lantai=data.jenis_lantai}
                        if(data.jenis_dinding){jenis_dinding=data.jenis_dinding}
                        if(data.fasilitas){fasilitas=data.fasilitas}
                        if(data.sumber_air){sumber_air=data.sumber_air}
                        if(data.sumber_penerangan){sumber_penerangan=data.sumber_penerangan}
                        if(data.bahan_bakar){bahan_bakar=data.bahan_bakar}
                        if(data.berapa_kali_sepekan){berapa_kali_sepekan=data.berapa_kali_sepekan}
                        if(data.berapa_kali_seminggu){berapa_kali_seminggu=data.berapa_kali_seminggu}
                        if(data.berapa_kali_sekali){berapa_kali_sekali=data.berapa_kali_sekali}
                        if(data.anggota_sakit){anggota_sakit=data.anggota_sakit}
                        if(data.list_barang){
                          list_barang=data.list_barang;
                          list_barang_array = list_barang.split('|');
                          list_barang_array[list_barang_array.length-1]=list_barang_array[list_barang_array.length-1].split('|')[0];
                          console.log(list_barang_array);
                        }

                        if(data.kredit_usaha){kredit_usaha=data.kredit_usaha}
                        if(data.status_bangunan){status_bangunan=data.status_bangunan}

                        if(data.skor_anggota_sakit){skor_anggota_sakit=data.skor_anggota_sakit}
                        if(data.skor_bahan_bakar){skor_bahan_bakar=data.skor_bahan_bakar}
                        if(data.skor_berapa_kali_sekali){skor_berapa_kali_sekali=data.skor_berapa_kali_sekali}
                        if(data.skor_berapa_kali_seminggu){skor_berapa_kali_seminggu=data.skor_berapa_kali_seminggu}
                        if(data.skor_berapa_kali_sepekan){skor_berapa_kali_sepekan=data.skor_berapa_kali_sepekan}
                        if(data.skor_fasilitas){skor_fasilitas=data.skor_fasilitas}
                        if(data.skor_jenis_dinding){skor_jenis_dinding=data.skor_jenis_dinding}
                        if(data.skor_jenis_lantai){skor_jenis_lantai=data.skor_jenis_lantai}
                        if(data.skor_kredit_usaha){skor_kredit_usaha=data.skor_kredit_usaha}
                        if(data.skor_list_barang){skor_list_barang=data.skor_list_barang}
                        if(data.skor_luas_lantai){skor_luas_lantai=data.skor_luas_lantai}
                        if(data.skor_status_bangunan){skor_status_bangunan=data.skor_status_bangunan}
                        if(data.skor_sumber_air){skor_sumber_air=data.skor_sumber_air}
                        if(data.skor_sumber_penerangan){skor_sumber_penerangan=data.skor_sumber_penerangan}
                    }

                    var arrayData = [
                        {title:'Luas lantai bangunan tempat tinggal dengan satuan', content:luas_lantai,options:optionObject.area,name:'area',score:skor_luas_lantai},
                        {title:'Jenis lantai tempat tinggal yang terluas', content:jenis_lantai,options:optionObject.floor,name:'floor',score:skor_jenis_lantai},
                        {title:'Jenis dinding tempat tinggal yang terluas', content:jenis_dinding,options:optionObject.wall,name:'wall',score:skor_jenis_dinding},
                        {title:'Fasilitas tempat buang air besar', content:fasilitas,options:optionObject.facility,name:'facility',score:skor_fasilitas},
                        {title:'Sumber air minum', content:sumber_air,options:optionObject.water,name:'water',score:skor_sumber_air},
                        {title:'Sumber penerangan utama', content:sumber_penerangan,options:optionObject.electricity,name:'electricity',score:skor_sumber_penerangan},
                        {title:'Bahan bakar utama untuk memasak sehari-hari', content:bahan_bakar,options:optionObject.cooking,name:'cooking',score:skor_bahan_bakar},
                        {title:'Berapa kali dalam seminggu rumah tangga membeli daging/ayam/susu', content:berapa_kali_seminggu,options:optionObject.meat,name:'meat',score:skor_berapa_kali_seminggu},
                        {title:'Berapa kali dalam sehari biasanya anggota rumah tangga makan', content:berapa_kali_sekali,options:optionObject.meal,name:'meal',score:skor_berapa_kali_sekali},
                        {title:'Berapa stel pakaian baru dalam setahun biasanya dibeli oleh / untuk setiap / sebagian besar anggota rumah tangga', content:berapa_kali_sepekan,options:optionObject.clothing,name:'clothing',score:skor_berapa_kali_sepekan},
                        {title:'Apabila ada anggota keluarga yang sakit, apakah mampu berobat ke puskesmas, atau poliklinik', content:anggota_sakit,options:optionObject.sickness,name:'sickness',score:skor_anggota_sakit},
                        {title:'Barang yang dimiliki rumah tangga yang masing-masing bernilai paling sedikit Rp. 500.000,-', content:list_barang_array,options:optionObject.goods, type:'multiple',name:'goods',score:skor_list_barang},
                        {title:'Apakah rumah tangga pernah menerima kredit usaha ( seperti UKM/UMKM ) setahun yang lalu', content:kredit_usaha,options:optionObject.credit,name:'credit',score:skor_kredit_usaha},
                        {title:'Status penguasaan bangunan tempat tinggal yang ditempati', content:status_bangunan,options:optionObject.houseStatus,name:'house_status',score:skor_status_bangunan},
                    ];

                    var toAppend = '';
                    arrayData.forEach((data)=>{
                        var options = '';
                        var selectOption = '';

                        if(data.type=='multiple'){
                          data.options.forEach((option)=>{
                              if(contains(data.content,option.value)){
                                options+='<label><input type="checkbox" style="display:none" value="'+option.score+'" name="score_'+data.name+'" checked="checked" class="value-score"><input type="checkbox" value="'+option.value+'" checked="checked" name="'+data.name+'" class="multiple-value">'+option.value+'</label><br>';
                              }
                              else{
                                options+='<label><input type="checkbox" style="display:none" value="'+option.score+'" name="score_'+data.name+'" class="value-score"><input type="checkbox" value="'+option.value+'" name="'+data.name+'"  class="multiple-value">'+option.value+'</label><br>';
                              }
                          });
                          selectOption = '<div class="form-group">'+options+'</div>'

                        }
                        else{
                          data.options.forEach((option)=>{
                            if(option.value.toLowerCase()==data.content.toLowerCase()){
                              options+='<option  score="'+option.score+'" selected>'+option.value+'</option>';
                            }
                            else{
                              options+='<option score="'+option.score+'">'+option.value+'</option>';
                            }
                          });
                          selectOption = '<input type="hidden" value="'+data.score+'" name="score_'+data.name+'" class="value-score"><select name="'+data.name+'" class="select2 form-control select-value">'+options+'</select>';
                        }

                        toAppend+='<div class="row form-group">'+
                                    '<label class="control-label col-md-6">'+data.title+'</label>'+
                                    '<div class="col-md-6">'
                                        +selectOption+
                                    '</div>'+
                                '</div><hr>';
                    });

                    assetInfo.html('');
                    assetInfo.append('<input type="hidden" value="'+id+'" name="id">'+toAppend+'<div class="row form-group"><div class="col-md-12">'+'<button style="margin:20px" class="btn btn-success pull-right" onclick="pendudukAssetSave()">Simpan</button>');

                }).catch((error)=>{
                  var arrayData = [
                      {title:'Luas lantai bangunan tempat tinggal dengan satuan', content:luas_lantai,options:optionObject.area,name:'area',score:skor_luas_lantai},
                      {title:'Jenis lantai tempat tinggal yang terluas', content:jenis_lantai,options:optionObject.floor,name:'floor',score:skor_jenis_lantai},
                      {title:'Jenis dinding tempat tinggal yang terluas', content:jenis_dinding,options:optionObject.wall,name:'wall',score:skor_jenis_dinding},
                      {title:'Fasilitas tempat buang air besar', content:fasilitas,options:optionObject.facility,name:'facility',score:skor_fasilitas},
                      {title:'Sumber air minum', content:sumber_air,options:optionObject.water,name:'water',score:skor_sumber_air},
                      {title:'Sumber penerangan utama', content:sumber_penerangan,options:optionObject.electricity,name:'electricity',score:skor_sumber_penerangan},
                      {title:'Bahan bakar utama untuk memasak sehari-hari', content:bahan_bakar,options:optionObject.cooking,name:'cooking',score:skor_bahan_bakar},
                      {title:'Berapa kali dalam seminggu rumah tangga membeli daging/ayam/susu', content:berapa_kali_seminggu,options:optionObject.meat,name:'meat',score:skor_berapa_kali_seminggu},
                      {title:'Berapa kali dalam sehari biasanya anggota rumah tangga makan', content:berapa_kali_sekali,options:optionObject.meal,name:'meal',score:skor_berapa_kali_sekali},
                      {title:'Berapa stel pakaian baru dalam setahun biasanya dibeli oleh / untuk setiap / sebagian besar anggota rumah tangga', content:berapa_kali_sepekan,options:optionObject.clothing,name:'clothing',score:skor_berapa_kali_sepekan},
                      {title:'Apabila ada anggota keluarga yang sakit, apakah mampu berobat ke puskesmas, atau poliklinik', content:anggota_sakit,options:optionObject.sickness,name:'sickness',score:skor_anggota_sakit},
                      {title:'Barang yang dimiliki rumah tangga yang masing-masing bernilai paling sedikit Rp. 500.000,-', content:list_barang_array,options:optionObject.goods, type:'multiple',name:'goods',score:skor_list_barang},
                      {title:'Apakah rumah tangga pernah menerima kredit usaha ( seperti UKM/UMKM ) setahun yang lalu', content:kredit_usaha,options:optionObject.credit,name:'credit',score:skor_kredit_usaha},
                      {title:'Status penguasaan bangunan tempat tinggal yang ditempati', content:status_bangunan,options:optionObject.houseStatus,name:'house_status',score:skor_status_bangunan},
                  ];

                  var toAppend = '';
                  arrayData.forEach((data)=>{
                      var options = '';
                      var selectOption = '';

                      if(data.type=='multiple'){
                        data.options.forEach((option)=>{
                            if(contains(data.content,option.value)){
                              options+='<label><input type="checkbox" style="display:none" value="'+option.score+'" name="score_'+data.name+'" checked="checked" class="value-score"><input type="checkbox" value="'+option.value+'" checked="checked" name="'+data.name+'" class="multiple-value">'+option.value+'</label><br>';
                            }
                            else{
                              options+='<label><input type="checkbox" style="display:none" value="'+option.score+'" name="score_'+data.name+'" class="value-score"><input type="checkbox" value="'+option.value+'" name="'+data.name+'"  class="multiple-value">'+option.value+'</label><br>';
                            }
                        });
                        selectOption = '<div class="form-group">'+options+'</div>'

                      }
                      else{
                        data.options.forEach((option)=>{
                            options+='<option score="'+option.score+'">'+option.value+'</option>';
                        });
                        selectOption = '<input type="hidden" value="'+data.score+'" name="score_'+data.name+'" class="value-score"><select name="'+data.name+'" class="select2 form-control select-value">'+options+'</select>';
                      }

                      toAppend+='<div class="row form-group">'+
                                  '<label class="control-label col-md-6">'+data.title+'</label>'+
                                  '<div class="col-md-6">'
                                      +selectOption+
                                  '</div>'+
                              '</div><hr>';
                  });

                  assetInfo.html('');
                  assetInfo.append('<input type="hidden" value="'+id+'" name="id">'+toAppend+'<div class="row form-group"><div class="col-md-12">'+'<button style="margin:20px" class="btn btn-success pull-right" onclick="pendudukAssetSave()">Simpan</button>');
                });

                assetImage.get().then((doc)=>{
                    assetInfo.append(
                        '<br>'+
                        '<div class="form-group">'+
                            '<label class="control-label">Foto Kepala Keluarga</label>'+
                            '<br>'+
                            '<br>'+
                            '<input type="file" name="photo_family_head" class="form-control">'+
                            '<img src="/images/no-image.png" id="photoFamilyHead" style="width:40%;display:block"/>'+
                        '</div><hr>'+

                        '<div class="form-group">'+
                            '<label class="control-label">Foto Depan Rumah</label>'+
                            '<br>'+
                            '<br>'+
                            '<input type="file" name="photo_terrace" class="form-control">'+
                            '<img src="/images/no-image.png" id="photoTerrace" style="width:40%;display:block"/>'+
                        '</div><hr>'+

                        '<div class="form-group">'+
                            '<label class="control-label">Foto Ruang Tamu</label>'+
                            '<br>'+
                            '<br>'+
                            '<input type="file" name="photo_living_room" class="form-control">'+
                            '<img src="/images/no-image.png" id="photoLivingroom" style="width:40%;display:block"/>'+
                        '</div><hr>'+

                        '<div class="form-group">'+
                            '<label class="control-label">Foto Dapur</label>'+
                            '<br>'+
                            '<br>'+
                            '<input type="file" name="photo_kitchen" class="form-control">'+

                            '<img src="/images/no-image.png" id="photoKitchen" style="width:40%;display:block"/>'+
                        '</div><hr>'+

                        '<div class="form-group">'+
                            '<label class="control-label">Foto Belakang Rumah</label>'+
                            '<br>'+
                            '<br>'+
                            '<input type="file" name="photo_backyard" class="form-control">'+
                            '<img src="/images/no-image.png" id="photoBackyard" style="width:40%;display:block"/>'+
                        '</div>'
                        +'<button id="saveAssetImgBtn" class="btn btn-success pull-right">Simpan Gambar</button>'
                        // +'<input type="submit" value="Simpan Gambar" class="btn btn-success pull-right"></form>'
                    );
                    if(doc && doc.exists){
                        var data = doc.data();

                        var photoFamilyHead = data.foto_kepala_keluarga;
                        var photoTerrace = data.foto_depan_rumah;
                        var photoLivingroom = data.foto_ruang_tamu;
                        var photoKitchen = data.foto_dapur;
                        var photoBackyard = data.foto_belakang_rumah;

                        storageRef.child(photoFamilyHead).getDownloadURL().then((url)=>{
                            var image = assetInfo.find('#photoFamilyHead');
                            image.attr('src',url);
                            console.log('Menampilkan foto kepala keluarga');
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
                }).catch((error)=>{
                  console.log('Tidak dapat menampilkan gambar');
                });
        });

        $(document).on('change','.select-value',function(){
            var score = $(this).children('option:selected').attr('score');
            console.log($(this).attr('name')+':'+score);
            $(this).siblings('.value-score').val(score);
        });

        $(document).on('click','.multiple-value',function(){
            $(this).siblings('.value-score').click();
            console.log('checked? :' +$(this).siblings('.value-score').is(':checked')+'value: '+$(this).siblings('.value-score').val());
        });

        $(document).on('click','#saveAssetImgBtn',function(){
          $('#modalLoading').modal('show');
          var resident = penduduk.doc(id);
          var assetImg = resident.collection('rumah').doc('gambar');
          var filePath;
          if($(document).find('[name="photo_family_head"]').prop('files')[0]){
            var photoFamilyHead = $(document).find('[name="photo_family_head"]').prop('files')[0];
            var fhName = 'images/kk-'+id+'.jpg';
            var fhStorageRef=firebase.storage().ref(fhName);
            var fhTask = fhStorageRef.put(photoFamilyHead);
            fhTask.on('state_changed',
              function complete(){
                assetImg.update({foto_kepala_keluarga:fhName}).then(function(){
                  console.log('Berhasil mengunggah gambar');
                }).catch(function(error){
                    console.log('Gagal mengunggah gambar, terjadi kesalahan teknis.');
                });
              },
              function error(err){
                console.log('error: '+err);
              }
            );
          }
          if($(document).find('[name="photo_terrace"]').prop('files')[0]){
            var photoTerrace = $(document).find('[name="photo_terrace"]').prop('files')[0];
            var tName = 'images/dr-'+id+'.jpg';
            var tStorageRef=firebase.storage().ref(tName);
            var tTask = tStorageRef.put(photoTerrace);
            tTask.on('state_changed',
              function complete(){
                assetImg.update({foto_depan_rumah:tName}).then(function(){
                  console.log('Berhasil mengunggah gambar');
                }).catch(function(error){
                  console.log('Gagal mengunggah gambar, terjadi kesalahan teknis.');
                });
              },
              function error(err){
                console.log('error: '+err);
              }
            );
          }
          if($(document).find('[name="photo_living_room"]').prop('files')[0]){
            var photoLivingroom = $(document).find('[name="photo_living_room"]').prop('files')[0];
            var lrName = 'images/rt-'+id+'.jpg';
            var lrStorageRef=firebase.storage().ref(lrName);
            var lrTask = lrStorageRef.put(photoLivingroom);
            lrTask.on('state_changed',
              function complete(){
                assetImg.update({foto_ruang_tamu:lrName}).then(function(){
                  console.log('Berhasil mengunggah gambar');
                }).catch(function(error){
                  console.log('Gagal mengunggah gambar, terjadi kesalahan teknis.');
                });
              },
              function error(err){
                console.log('error: '+err);
              }
            );
          }
          if($(document).find('[name="photo_kitchen"]').prop('files')[0]){
            var photoKitchen = $(document).find('[name="photo_kitchen"]').prop('files')[0];
            var kName = 'images/d-'+id+'.jpg';
            var kStorageRef=firebase.storage().ref(kName);
            var kTask = kStorageRef.put(photoKitchen);
            kTask.on('state_changed',
              function complete(){
                assetImg.update({foto_dapur:kName}).then(function(){
                  console.log('Berhasil mengunggah gambar');
                }).catch(function(error){
                  console.log('Gagal mengunggah gambar, terjadi kesalahan teknis.');
                });
              },
              function error(err){
                console.log('error: '+err);
              }
            );
          }
          if($(document).find('[name="photo_backyard"]').prop('files')[0]){
            var photoBackyard = $(document).find('[name="photo_backyard"]').prop('files')[0];
            var bName = 'images/br-'+id+'.jpg';
            var bStorageRef=firebase.storage().ref(bName);
            var bTask = bStorageRef.put(photoBackyard);
            bTask.on('state_changed',
              function complete(){
                assetImg.update({foto_belakang_rumah:bName}).then(function(){
                  console.log('Berhasil mengunggah gambar');
                }).catch(function(error){
                  console.log('Gagal mengunggah gambar, terjadi kesalahan teknis.');
                });
              },
              function error(err){
                console.log('error: '+err);
              }
            );
          }
          setTimeout(function(){
            $(location).attr('href','/penduduk-edit/'+id);
          },10000);
        });


        $('#documentInfoBtn').on('click',function(){

                var documents = person.collection('dokumen');
                var coordinateText = "0,0";
                var nomor_kk,provinsi,kota,kecamatan,kelurahan,rw,rt,alamat = '';
                documents.get().then((querySnapshot)=>{
                    querySnapshot.forEach((doc)=>{
                        var data = doc.data();
                        coordinateText = data.koordinat;
                        var coordinateArray = coordinateText.split(',');
                        var coordinate = {lat:parseFloat(coordinateArray[0]),lng:parseFloat(coordinateArray[1])};
                        console.log(coordinate);
                        var arrayData = [
                            {title:'Nomor Kartu Keluarga', content:data.nomor_kk,type:'input',name:'kk_number'},
                            {title:'Provinsi', content:data.provinsi,type:'select',name:'province'},
                            {title:'Kota / Kabupaten', content:data.kota,type:'select',name:'city'},
                            {title:'Kecamatan', content:data.kecamatan,type:'select',name:'districtDoc'},
                            {title:'Kelurahan', content:data.kelurahan,type:'select',name:'subdistrictDoc'},
                            {title:'RW', content:data.rw,type:'input',name:'rw'},
                            {title:'RT', content:data.rt,type:'input',name:'rt'},
                            {title:'Alamat', content:data.alamat,type:'input',name:'address'}
                        ];

                        var toAppend = getDocEditor(arrayData,data.kecamatan);
                        documentInfo.html('');
                        var mapArea = getMapArea(coordinateText);
                        var kkPhoto = getFamilyHeadPhoto();

                        documentInfo.append(
                          '<div class="form-group">'+
                              '<input type="hidden" value="'+id+'" name="id">'+
                                toAppend+
                                mapArea+
                              '<div class="row form-group">'+
                              '<button style="margin:20px" class="btn btn-success pull-right" onclick="pendudukDocumentSave()">Simpan</button>'+
                            '</div><hr>'+
                            kkPhoto
                        );
                        var content = '<p>Nomor KK: '+data.nomor_kk+'</p>'+
                          '<p>Alamat: '+data.alamat+
                          ',RT '+data.rt+
                          '/RW '+data.rw+
                          ' Kelurahan '+data.kelurahan+
                          ', Kecamatan '+data.kecamatan+
                          '<br> '+data.kota+','+data.provinsi+'</p>';
                        initMap(coordinate,content);

                        storageRef.child(data.foto_kk).getDownloadURL().then((url)=>{
                            var image = documentInfo.find('#kkPhoto');
                            image.attr('src',url);
                        });
                    });
                });

        });

        $(document).on('change','input[type="file"]',function(){
            var ext=$(this).val().split('.');
            ext=ext[ext.length-1].toLowerCase();
            var allowedExt="jpg";
            if(ext!=allowedExt){
                alert('You can only upload jpg file!');
                $(this).val('');
            }
            var maxSize = 5024288;
            var fileSize = this.files[0].size;
            if(fileSize>maxSize){
                alert('You cannot upload file with size more than 5 MB!');
                $(this).val('');
            }
        });

        $(document).on('change','select[name="district"]',function(){
          var options = '';
          var select = $(document).find('select[name="district"]');
          var selectSubdistrict = $(document).find('select[name="subdistrict"]');
          selectSubdistrict.html('');
          if(select.val()=='Kepulauan Seribu Selatan'){
            subdistrictOptionS.forEach((option)=>{
              options+='<option>'+option+'</option>';
            });
            selectSubdistrict.append(options);
          }
          else if (select.val()=='Kepulauan Seribu Utara') {
            console.log(subdistrictOptionU);
            subdistrictOptionU.forEach((option)=>{
              options+='<option>'+option+'</option>';
            });
            selectSubdistrict.append(options);
          }
        });

        $(document).on('change','select[name="districtDoc"]',function(){
          var options = '';
          var select = $(document).find('select[name="districtDoc"]');
          var selectSubdistrict = $(document).find('select[name="subdistrictDoc"]');
          selectSubdistrict.html('');
          if(select.val()=='Kepulauan Seribu Selatan'){
            subdistrictOptionS.forEach((option)=>{
              options+='<option>'+option+'</option>';
            });
            selectSubdistrict.append(options);
          }
          else if (select.val()=='Kepulauan Seribu Utara') {
            console.log(subdistrictOptionU);
            subdistrictOptionU.forEach((option)=>{
              options+='<option>'+option+'</option>';
            });
            selectSubdistrict.append(options);
          }
        });

        $(document).on('click','#savePhotoKK',function(){
          var familyCard = $('#familyCardUpload').prop('files')[0];
          if(familyCard){
            $('#modalLoading').modal('show');
            var documents = penduduk.doc(id).collection('dokumen');
            var pName = 'images/fc-'+id+'.jpg';
            var pStorageRef=firebase.storage().ref(pName);
            var pTask = pStorageRef.put(familyCard);
            pTask.on('state_changed',
              function complete(){
                documents.get().then((querySnapshot)=>{
                  querySnapshot.forEach((doc)=>{
                    var docId = doc.id;
                    var documentation = penduduk.doc(id).collection('dokumen').doc(docId);
                    documentation.update({
                      foto_kk:pName
                    }).then(()=>{
                      $(location).attr('href','/penduduk-edit/'+id);
                    });
                  });
                });
              },
              function error(err){
                console.log('error: '+err);
              }
            );
          }
          else{
            alert('Anda belum memilih foto');
          }
        });

        $('#profileImgUploadBtn').on('click',function(){
          $('#modalLoading').modal('show');
          var photoProfile = $('#profileUpload').prop('files')[0];
          var photoId = $('#idUpload').prop('files')[0];
          var resident = penduduk.doc(id);
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
            $(location).attr('href','/penduduk-edit/'+id);
          },5000);


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

      function init(){
        $('#profileInfoBtn').click();
      }
      function contains(array,string){
        var contain = false;
        array.forEach((item)=>{
          if(item.toLowerCase()==string.toLowerCase()){
            contain = true;
            return contain;
          }
        });
        return contain;
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

      function initMap(coordinate,content){
          var map = new google.maps.Map(document.getElementById('map'),{
            center: coordinate,
            zoom: 10
          });

          var marker = new google.maps.Marker({
            position:coordinate,
            map:map,
            draggable:true,
            animation: google.maps.Animation.DROP,
            // position:results[0].geometry.location
            // icon:'/images/marker.png'
          });

          google.maps.event.addListener(marker,'dragend',function(){
              var geolocation = marker.getPosition();
              var inputGeo = $(document).find('input[name="geolocation"]');

              inputGeo.val(geolocation.lat()+','+geolocation.lng());

              console.log(inputGeo.val());
          });

          var infoWindow = new google.maps.InfoWindow({
            content:content
          });

          marker.addListener('click',function(){
            infoWindow.open(map,marker);
          });
      }

      function getDocEditor(arrayData,kecamatan){
        var toAppend = '';
        arrayData.forEach(function(item){
          var input = '';
           if(item.type=='select'){
             var options='';
             switch(item.name){
               case 'province':
                  options+='<option selected>DKI Jakarta</option>';
                  break;
               case 'city':
                  options+='<option selected>Kab. Kepulauan Seribu</option>';
                  break;
               case 'districtDoc':
                  districtOption.forEach((option)=>{
                    if(option.toLowerCase()==item.content.toLowerCase()){
                      options+='<option selected>'+option+'</option>';
                    }
                    else{
                      options+='<option>'+option+'</option>';
                    }
                  });
                  break;
              case 'subdistrictDoc':
                  if(kecamatan=='Kepulauan Seribu Selatan'){
                    subdistrictOptionS.forEach((option)=>{
                      if(option.toLowerCase()==item.content.toLowerCase()){
                        options+='<option selected>'+option+'</option>';
                      }
                      else{
                        options+='<option>'+option+'</option>';
                      }
                    });
                  }
                  else if (kecamatan=='Kepulauan Seribu Utara') {
                    subdistrictOptionU.forEach((option)=>{
                      if(option.toLowerCase()==item.content.toLowerCase()){
                        options+='<option selected>'+option+'</option>';
                      }
                      else{
                        options+='<option>'+option+'</option>';
                      }
                    });
                  }
                  else{
                    subdistrictOptionS.forEach((option)=>{
                      if(option.toLowerCase()==item.content.toLowerCase()){
                        options+='<option selected>'+option+'</option>';
                      }
                      else{
                        options+='<option>'+option+'</option>';
                      }
                    });
                  }
             }
             input = '<select name="'+item.name+'" class="form-control">'+options+'</select>';

           }
           else{
             input='<input class="form-control" value="'+item.content+'" name="'+item.name+'">'
           }
            toAppend+='<div class="row form-group">'+
                        '<label class="control-label col-md-5">'+item.title+'</label>'+
                        '<p class="col-md-7">'
                            +input+
                        '</p>'+
                    '</div>';
        });
        return toAppend;
      }

      function getMapArea(coordinateText){
        return '<div class="row form-group">'+
                    '<input type="hidden" name="geolocation" value="'+coordinateText+'">'+
                    '<label class="control-label col-md-12">Lokasi di Peta</label><br><br>'+
                    '<div id="map" class="col-md-12"style="width:100%;height:300px"></div>'+
                '</div>';
      }

      function getFamilyHeadPhoto(){
        return '<div class="form-group">'+
                '<label class="control-label">Foto Kartu Keluarga</label>'+
                '<br>'+
                '<br>'+
                '<input type="file" id="familyCardUpload" class="form-control">'+
                '<img src="/images/no-image.png" id="kkPhoto" style="width:100%;display:block"/>'+
            '</div>'+
            '<div class="row form-group"><div class="col-md-12"><button id="savePhotoKK" class="btn btn-warning pull-right">Simpan Foto KK</button></div></div>'+
            '<hr>';
      }

      function pendudukPersonalSave(){
        var id = $('[name="id"]').val();
        var resident = penduduk.doc(id);
        resident.update({
          agama:$('[name="religion"]').val(),
          bidang_pekerjaan:$('[name="job_field"]').val(),
          golongan_darah:$('[name="blood_type"]').val(),
          jenis_kelamin:$('[name="gender"]').val(),
          kecamatan:$('[name="district"]').val(),
          kelurahan:$('[name="subdistrict"]').val(),
          kewarganegaraan:$('[name="nationality"]').val(),
          kirasan_penghasilan:$('[name="income"]').val(),
          kota:$('[name="city"]').val(),
          nama_lengkap:$('[name="name"]').val(),
          pekerjaan:$('[name="job"]').val(),
          pendidikan:$('[name="education"]').val(),
          provinsi:$('[name="province"]').val(),
          rt:$('[name="rt"]').val(),
          rw:$('[name="rw"]').val(),
          status_perkawinan:$('[name="marriage"]').val(),
          tanggal_lahir:$('[name="birth_date"]').val(),
          tempat_lahir:$('[name="birth_place"]').val()
        }).then(function() {
          alert('Data pribadi berhasil diubah');
          $(location).attr('href','/penduduk-edit/'+id);
        })
        .catch(function(error) {
          alert('Data pribadi gagal diubah, terjadi kesalahan teknis');
          $(location).attr('href','/penduduk-edit/'+id);
        });


      }
      function pendudukAssetSave(){
        var id = $(document).find('[name="id"]').val();
        var resident = penduduk.doc(id);
        var asset = resident.collection('rumah').doc('data');
        var goods = [];
        $(document).find('[name="goods"]:checked').each(function(){
          goods.push($(this).val());
        });

        console.log(goods);
        var goodText ='';
        goods.forEach((good)=>{
          if(good){
            goodText+=good+'|';
          }
        });
        var scoreGoods = [];
        $(document).find('[name="score_goods"]:checked').each(function(){
          scoreGoods.push($(this).val());
        });
        var score_goodText ='';
        scoreGoods.forEach(function(scoreGood){
          if(scoreGood){
            score_goodText+=scoreGood+'|';
          }
        });
        var data = {
          luas_lantai:$(document).find('[name="area"]').val(),
          jenis_lantai:$(document).find('[name="floor"]').val(),
          jenis_dinding:$(document).find('[name="wall"]').val(),
          fasilitas:$(document).find('[name="facility"]').val(),
          sumber_air:$(document).find('[name="water"]').val(),
          sumber_penerangan:$(document).find('[name="electricity"]').val(),
          bahan_bakar:$(document).find('[name="cooking"]').val(),
          berapa_kali_sekali:$(document).find('[name="meal"]').val(),
          berapa_kali_seminggu:$(document).find('[name="meat"]').val(),
          berapa_kali_sepekan:$(document).find('[name="clothing"]').val(),
          anggota_sakit:$(document).find('[name="sickness"]').val(),
          list_barang:goodText,
          kredit_usaha:$(document).find('[name="credit"]').val(),
          status_bangunan:$(document).find('[name="house_status"]').val(),
          skor_luas_lantai:$(document).find('[name="score_area"]').val(),
          skor_jenis_lantai:$(document).find('[name="score_floor"]').val(),
          skor_jenis_dinding:$(document).find('[name="score_wall"]').val(),
          skor_fasilitas:$(document).find('[name="score_facility"]').val(),
          skor_sumber_air:$(document).find('[name="score_water"]').val(),
          skor_sumber_penerangan:$(document).find('[name="score_electricity"]').val(),
          skor_bahan_bakar:$(document).find('[name="score_cooking"]').val(),
          skor_berapa_kali_sekali:$(document).find('[name="score_meal"]').val(),
          skor_berapa_kali_seminggu:$(document).find('[name="score_meat"]').val(),
          skor_berapa_kali_sepekan:$(document).find('[name="score_clothing"]').val(),
          skor_anggota_sakit:$(document).find('[name="score_sickness"]').val(),
          skor_list_barang:score_goodText,
          skor_kredit_usaha:$(document).find('[name="score_credit"]').val(),
          skor_status_bangunan:$(document).find('[name="score_house_status"]').val(),
        };
        asset.update(data).then(function() {
          alert('Data aset berhasil diubah');
          $(location).attr('href','/penduduk-edit/'+id);
        })
        .catch(function(error) {
          asset.set(data).then(function(){
            alert('Data aset berhasil ditambahkan');
            $(location).attr('href','/penduduk-edit/'+id);

          }).catch(function(error){
            console.log('Data aset gagal diubah/ditambahkan, terjadi kesalahan teknis');
            $(location).attr('href','/penduduk-edit/'+id);
          });
        });

      }

      function pendudukDocumentSave(){
        var id = $(document).find('[name="id"]').val();
        var resident = penduduk.doc(id);
        var documents = resident.collection('dokumen');
        var provinsiDoc = $(document).find('[name="province"]').val();
        var kotaDoc = $(document).find('[name="city"]').val();
        var nomorKKDoc = $(document).find('[name="kk_number"]').val();
        var kecDoc = $(document).find('[name="districtDoc"]').val();
        var kelDoc = $(document).find('[name="subdistrictDoc"]').val();
        var rwDoc = $(document).find('[name="rw"]').val();
        var rtDoc = $(document).find('[name="rt"]').val();
        var alamatDoc = $(document).find('[name="address"]').val();
        var geoDoc = $(document).find('[name="geolocation"]').val();

        documents.get().then((querySnapshot)=>{
          querySnapshot.forEach((doc)=>{
            var doc_id = doc.id;
            var kkPhoto = doc.data().foto_kk;
            var coordinate = doc.data().koordinat;
            var document = documents.doc(doc_id);
            document.update({
              provinsi:provinsiDoc,
              nomor_kk:nomorKKDoc,
              kota:kotaDoc,
              kecamatan:kecDoc,
              kelurahan:kelDoc,
              rw:rwDoc,
              rt:rtDoc,
              alamat:alamatDoc,
              foto_kk:kkPhoto,
              koordinat:geoDoc
            }).then(function(){
              alert('Data dokumen berhasil diubah');
              $(location).attr('href','/penduduk-edit/'+id);


            }).catch(function(error){
              alert('Data dokumen gagal diubah, terjadi kesalahan teknis');
              $(location).attr('href','/penduduk-edit/'+id);

            });

          });
        });
      }

    </script>
@endsection
