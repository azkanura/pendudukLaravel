@extends('base')
@section('title')
     Input Data Kekumuhan
@endsection
  <!-- Content -->
@section('content')
    <div class="page-header">
        <h3>
            <span class="text-muted font-weight-light">Data Kekumuhan</span> / Tambah Data
        </h3>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="panel-body">
                <!-- <div class="row form-group">
                    <label class="control-label col-md-6">
                        Tingkatan
                    </label>
                    <div class="col-md-6">
                        <select name="level" class="form-control">
                            <option value="subdistrict" id="levelSubdistrict">Kelurahan</option>
                            <option value="district" id="levelDistrict">Kecamatan</option>
                            <option value="city" id="levelCity">Kota/Kabupaten</option>
                            <option value="province" id="levelProvince">Provinsi</option>
                            <option value="national" id="levelNational">Nasional</option>
                        </select>
                    </div>
                </div> -->
                <div id="selectArea" >
                    <hr class="primary" style="margin-top: 0">
                    <div class="form-group" style="margin-bottom: 0">
                        <label class="control-label">
                            <small >Pilih Area</small>
                        </label>
                    </div>
                    <hr class="primary">
                    <div class="row form-group" id="selectProvinceContainer">
                        <label class="control-label col-md-6">
                            Provinsi
                        </label>
                        <div class="col-md-6">
                            <select name="province" class="form-control" required id="selectProvince">
                                <option value="">Loading data...</option>
                           </select>
                       </div>
                    </div>
                    <div class="row form-group" id="selectCityContainer">
                        <label class="control-label col-md-6">
                            Kota/Kabupaten
                        </label>
                        <div class="col-md-6">
                            <select name="city" class="form-control" required id="selectCity">
                                <option value="">Loading data...</option>
                           </select>
                       </div>
                    </div>
                    <div class="row form-group" id="selectDistrictContainer">
                        <label class="control-label col-md-6">
                            Kecamatan
                        </label>
                        <div class="col-md-6">
                            <select name="district" class="form-control" required id="selectDistrict">
                                <option value="">Loading data...</option>
                           </select>
                       </div>
                    </div>
                    <!-- <div class="row form-group" id="selectSubdistrictContainer">
                        <label class="control-label col-md-6">
                            Kelurahan
                        </label>
                        <div class="col-md-6">
                            <select name="subdistrict" class="form-control" required id="selectSubdistrict">
                                <option value="">Loading data...</option>
                           </select>
                       </div>
                    </div> -->
                </div>
                <hr class="primary">
                <div class="row form-group">
                    <label class="control-label col-md-6">Periode</label>
                    <div class="col-md-6">
                        <input class="form-control" name="periode" required />
                    </div>
                </div>
                <div class="row form-group">
                    <label class="control-label col-md-6">Luas Kawasan</label>
                    <div class="col-md-6">
                        <input type="number" class="form-control" name="luas_kawasan" required />
                        <small>Dalam satuan Hektar (Ha)</small>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="control-label col-md-6">Jumlah Penduduk</label>
                    <div class="col-md-6">
                        <input type="number" class="form-control" name="jumlah_penduduk" required />
                        <small>Dalam satuan Jiwa</small>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="control-label col-md-6">Jumlah Kepala Keluarga</label>
                    <div class="col-md-6">
                        <input type="number" class="form-control" name="jumlah_kk" required  />
                        <small>Dalam satuan KK</small>

                    </div>
                </div>
                <div class="row form-group">
                    <label class="control-label col-md-6">Jumlah Bangunan</label>
                    <div class="col-md-6">
                        <input type="number" class="form-control" name="jumlah_bangunan" required />
                        <small>Dalam satuan Unit</small>
                    </div>
                </div>

                <h5>Kondisi Bangunan Gedung</h5>
                <hr class="primary">
                <div class="form-group" style="margin-bottom: 0">
                    <label class="control-label">
                        <small >Ketidakteraturan Bangunan</small>
                    </label>
                </div>
                <hr class="primary">
                <div class="row form-group">
                    <label class="control-label col-md-6">Jumlah bangunan yang tidak memiliki keteraturan</label>
                    <div class="col-md-6">
                        <input type="number" class="form-control" name="bangunan_tak_teratur" required />
                        <small>Dalam satuan Unit</small>
                    </div>
                </div>

                <hr class="primary">
                <div class="form-group" style="margin-bottom: 0">
                    <label class="control-label">
                        <small >Tingkat kepadatan bangunan</small>
                    </label>
                </div>
                <hr class="primary">
                <div class="row form-group">
                    <label class="control-label col-md-6">Untuk kota besar dan metropolitan, luas area yang dengan kepadatan lebih dari 250 unit/hektar. Untuk kota sedang dan kecil, Luas area yang dengan kepadatan lebih dari 200 unit/hektar.
                    </label>
                    <div class="col-md-6">
                        <input type="number" class="form-control" name="bangunan_kepadatan" required />
                        <small>Dalam satuan Hektar(Ha)</small>
                    </div>
                </div>

                <hr class="primary">
                <div class="form-group" style="margin-bottom: 0">
                    <label class="control-label">
                        <small >Ketidaksesuaian dengan Standar Teknis</small>
                    </label>
                </div>
                <hr class="primary">
                <div class="row form-group">
                    <label class="control-label col-md-6">Jumlah unit bangunan yang tidak sesuai standar teknis</label>
                    <div class="col-md-6">
                        <input type="number" class="form-control" name="bangunan_tak_standar" required />
                        <small>Dalam satuan Unit</small>
                    </div>
                </div>

                <h5>Kondisi Jalan Lingkungan</h5>
                <hr class="primary">
                <div class="form-group" style="margin-bottom: 0">
                    <label class="control-label">
                        <small >Cakupan Layanan Jalan Lingkungan</small>
                    </label>
                </div>
                <hr class="primary">
                <div class="row form-group">
                    <label class="control-label col-md-6">Luas area yang belum terlayani prasarana jalan lingkungan</label>
                    <div class="col-md-6">
                        <input type="number" class="form-control" name="jalan_tak_terlayani" required />
                        <small>Dalam satuan Hektar(Ha)</small>
                    </div>
                </div>

                <hr class="primary">
                <div class="form-group" style="margin-bottom: 0">
                    <label class="control-label">
                        <small >Kualitas Jalan Lingkungan</small>
                    </label>
                </div>
                <hr class="primary">
                <div class="row form-group">
                    <label class="control-label col-md-6">Total panjang jalan lingkungan</label>
                    <div class="col-md-6">
                        <input type="number" class="form-control" name="jalan_total_panjang" required />
                        <small>Dalam satuan Meter(m)</small>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="control-label col-md-6">Panjang jalan dengan permukaan jalan rusak</label>
                    <div class="col-md-6">
                        <input type="number" class="form-control" name="jalan_rusak" required />
                        <small>Dalam satuan Meter(m)</small>
                    </div>
                </div>

                <h5>Kondisi penyediaan air minum</h5>
                <hr class="primary">
                <div class="form-group" style="margin-bottom: 0">
                    <label class="control-label">
                        <small >Akses Penduduk terhadap Air Minum yang Aman</small>
                    </label>
                </div>
                <hr class="primary">
                <div class="row form-group">
                    <label class="control-label col-md-6">Jumlah penduduk yang tidak terakses air minum yang aman</label>
                    <div class="col-md-6">
                        <input type="number" class="form-control" name="air_tanpa_akses" required />
                        <small>Dalam satuan Jiwa</small>
                    </div>
                </div>

                <hr class="primary">
                <div class="form-group" style="margin-bottom: 0">
                    <label class="control-label">
                        <small >Kecukupan Kuantitas Air Minum</small>
                    </label>
                </div>
                <hr class="primary">
                <div class="row form-group">
                    <label class="control-label col-md-6">Jumlah penduduk yg belum terpenuhi kebutuhan air minum 60 liter/hari</label>
                    <div class="col-md-6">
                        <input type="number" class="form-control" name="air_tak_terpenuhi" required />
                        <small>Dalam satuan Jiwa</small>
                    </div>
                </div>
            </div>                    
        </div>
        <div class="col-md-6">
            <div class="panel-body">
                <h5 style="margin-top:0">Kondisi drainase lingkungan</h5>
                <hr class="primary">
                <div class="form-group" style="margin-bottom: 0">
                    <label class="control-label">
                        <small >Genangan dengan >30cm, >2 jam , > 2x Per Tahun </small>
                    </label>
                </div>
                <hr class="primary">
                <div class="row form-group">
                    <label class="control-label col-md-6">Luas area yang terkena genangan</label>
                    <div class="col-md-6">
                        <input type="number" class="form-control" name="drainase_genangan" required />
                        <small>Dalam satuan Hektar(Ha)</small>
                    </div>
                </div>

                <hr class="primary">
                <div class="form-group" style="margin-bottom: 0">
                    <label class="control-label">
                        <small >Ketidaktersediaan Prasarana Drainase lingkungan</small>
                    </label>
                </div>
                <hr class="primary">
                <div class="row form-group">
                    <label class="control-label col-md-6">Luas area yang tidak terlayani prasarana drainase lingkungan</label>
                    <div class="col-md-6">
                        <input type="number" class="form-control" name="drainase_tanpa_prasarana" required />
                        <small>Dalam satuan Hektar(Ha)</small>
                    </div>
                </div>

                <hr class="primary">
                <div class="form-group" style="margin-bottom: 0">
                    <label class="control-label">
                        <small >Ketidakterhubungan dengan Sistem Drainase Kota</small>
                    </label>
                </div>
                <hr class="primary">
                <div class="row form-group">
                    <label class="control-label col-md-6">Luas area dengan sistem drainase tidak terhubung ke sistem kota</label>
                    <div class="col-md-6">
                        <input type="number" class="form-control" name="drainase_tak_terhubung" required />
                        <small>Dalam satuan Hektar(Ha)</small>
                    </div>
                </div>

                <hr class="primary">
                <div class="form-group" style="margin-bottom: 0">
                    <label class="control-label">
                        <small >Tidak Terpeliharanya Sistem Drainase</small>
                    </label>
                </div>
                <hr class="primary">
                <div class="row form-group">
                    <label class="control-label col-md-6">Luas area yang sistem drainasenya tidak terpelihara</label>
                    <div class="col-md-6">
                        <input type="number" class="form-control" name="drainase_tak_terpelihara" required />
                        <small>Dalam satuan Hektar(Ha)</small>
                    </div>
                </div>

                <hr class="primary">
                <div class="form-group" style="margin-bottom: 0">
                    <label class="control-label">
                        <small >Kualitas Konstruksi Sistem Drainase</small>
                    </label>
                </div>
                <hr class="primary">
                <div class="row form-group">
                    <label class="control-label col-md-6">Luas area yang konstruksi prasarana drainasenya buruk</label>
                    <div class="col-md-6">
                        <input type="number" class="form-control" name="drainase_konstruksi_buruk" required />
                        <small>Dalam satuan Hektar(Ha)</small>
                    </div>
                </div>

                <h5>Kondisi pengolahan air limbah</h5>
                <hr class="primary">
                <div class="form-group" style="margin-bottom: 0">
                    <label class="control-label">
                        <small >Akses Penduduk terhadap Sistem Air Limbah Layak</small>
                    </label>
                </div>
                <hr class="primary">
                <div class="row form-group">
                    <label class="control-label col-md-6">Jumlah penduduk yang tidak terakses pada sistem air limbah</label>
                    <div class="col-md-6">
                        <input type="number" class="form-control" name="limbah_tanpa_akses" required />
                        <small>Dalam satuan Jiwa</small>
                    </div>
                </div>

                <hr class="primary">
                <div class="form-group" style="margin-bottom: 0">
                    <label class="control-label">
                        <small >Sistem Pengolahan Air Limbah Sesuai dengan Persyaratan</small>
                    </label>
                </div>
                <hr class="primary">
                <div class="row form-group">
                    <label class="control-label col-md-6">Luas area yang sistem air limbah tidak sesuai persyaratan teknis</label>
                    <div class="col-md-6">
                        <input type="number" class="form-control" name="limbah_tak_sesuai" required />
                        <small>Dalam satuan Hektar(Ha)</small>
                    </div>
                </div>

                <h5>Kondisi sistem pengelolaan persampahan</h5>
                <hr class="primary">
                <div class="form-group" style="margin-bottom: 0">
                    <label class="control-label">
                        <small >Sarana dan Prasarana Persampahan</small>
                    </label>
                </div>
                <hr class="primary">
                <div class="row form-group">
                    <label class="control-label col-md-6">Luas area yg tdk memiliki sarpras persampahan sesuai syarat teknis (Bin sampah dg pemilahan, gerobak sampah, TPS 3R, TPST)</label>
                    <div class="col-md-6">
                        <input type="number" class="form-control" name="sampah_tak_sesuai" required />
                        <small>Dalam satuan Hektar(Ha)</small>
                    </div>
                </div>

                <hr class="primary">
                <div class="form-group" style="margin-bottom: 0">
                    <label class="control-label">
                        <small >Sistem Pengolahan Sampah Tidak Sesuai Persyaratan Teknis</small>
                    </label>
                </div>
                <hr class="primary">
                <div class="row form-group">
                    <label class="control-label col-md-6">Luas area dengan sistem pengolahan sampah yang tidak standar (pewadahan, pengumpulan, pengangkutan, pengolahan)</label>
                    <div class="col-md-6">
                        <input type="number" class="form-control" name="sampah_tak_standar" required />
                        <small>Dalam satuan Hektar(Ha)</small>
                    </div>
                </div>
                <hr class="primary">
                <div class="form-group" style="margin-bottom: 0">
                    <label class="control-label">
                        <small >Tidak Terpeliharanya Sarana dan Prasarana Persampahan</small>
                    </label>
                </div>
                <hr class="primary">

                <div class="row form-group">
                    <label class="control-label col-md-6">Luas area yang sarpras persampahannya tidak terpelihara (pemeliharaan rutin dan berkala)</label>
                    <div class="col-md-6">
                        <input type="number" class="form-control" name="sampah_tak_terpelihara" required />
                        <small>Dalam satuan Hektar(Ha)</small>
                    </div>
                </div>

                <h5>Kondisi proteksi kebakaran</h5>
                <hr class="primary">
                <div class="form-group" style="margin-bottom: 0">
                    <label class="control-label">
                        <small >Tidak Adanya Prasarana Proteksi Kebakaran (Sumber Air, Jalan, Komunikasi, Data Sistem Proteksi dan Pos Kebakaran) </small>
                    </label>
                </div>
                <hr class="primary">
                <div class="row form-group">
                    <label class="control-label col-md-6">Luas area yang tidak memiliki prasarana proteksi kebakaran</label>
                    <div class="col-md-6">
                        <input type="number" class="form-control" name="kebakaran_tanpa_prasarana" required />
                        <small>Dalam satuan Hektar(Ha)</small>
                    </div>
                </div>

                <hr class="primary">
                <div class="form-group" style="margin-bottom: 0">
                    <label class="control-label">
                        <small >Tidak Adanya Sarana Proteksi Kebakaran (APAR, Mobil Pompa dan Sarana Pendukung Lainnya)</small>
                    </label>
                </div>
                <hr class="primary">
                <div class="row form-group">
                    <label class="control-label col-md-6">Luas area yang tidak memiliki sarana proteksi kebakaran</label>
                    <div class="col-md-6">
                        <input type="number" class="form-control" name="kebakaran_tanpa_sarana" required />
                        <small>Dalam satuan Hektar(Ha)</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div clas="row">
        <div class="col-md-12">
            <button onclick="saveData()" class="btn btn-primary">Simpan</button>
        </div>
    </div>
@endsection
@section('inlinejs')
    <script src="/"></script>
    <script type="text/javascript">
        var selectLevel = $('[name="level"]');
        var selectArea = $('#selectArea');

        var provinceContainer = $('#selectProvinceContainer');
        var selectProvince = $('[name="province"]');

        var cityContainer = $('#selectCityContainer');
        var selectCity = $('[name="city"]');

        var districtContainer = $('#selectDistrictContainer');
        var selectDistrict = $('[name="district"]');

        var subdistrictContainer = $('#selectSubdistrictContainer');
        var selectSubdistrict = $('[name="subdistrict"]');

        var countKK=0;
        var countMember=0;
        var countAll=0;

        selectLevel.on('change',function(){
            var selectedLevel = $(this).val();
            switch(selectedLevel){
                case 'national':
                    selectArea.hide();
                    disableSelect(selectProvince,provinceContainer);
                    disableSelect(selectCity,cityContainer);
                    disableSelect(selectDistrict,districtContainer);
                    disableSelect(selectSubdistrict,subdistrictContainer);

                    break;

                case 'province':
                    selectArea.show();

                    enableSelect(selectProvince,provinceContainer);
                    disableSelect(selectCity,cityContainer);
                    disableSelect(selectDistrict,districtContainer);
                    disableSelect(selectSubdistrict,subdistrictContainer);

                    break;

                case 'city':
                    selectArea.show();

                    enableSelect(selectProvince,provinceContainer);
                    enableSelect(selectCity,cityContainer);
                    disableSelect(selectDistrict,districtContainer);
                    disableSelect(selectSubdistrict,subdistrictContainer);

                    break;

                case 'district':
                    selectArea.show();

                    enableSelect(selectProvince,provinceContainer);
                    enableSelect(selectCity,cityContainer);
                    enableSelect(selectDistrict,districtContainer);
                    disableSelect(selectSubdistrict,subdistrictContainer);

                    break;

                case 'subdistrict':
                    selectArea.show();

                    enableSelect(selectProvince,provinceContainer);
                    enableSelect(selectCity,cityContainer);
                    enableSelect(selectDistrict,districtContainer);
                    enableSelect(selectSubdistrict,subdistrictContainer);

                    break;
            }
        });

        selectProvince.on('change',function(){
            var idProv = parseInt($(this).children(':selected').attr('id_prov'));
            $.getJSON("/city-seribu.json",function(data){
                selectCity.html('<option value="" >Pilih Kota/Kabupaten</option>');
                $.each(data, function (index,value){
                    if(value.id_prov==idProv){
                        selectCity.append('<option id_kabkota="'+value.id+'" value="'+value.nama+'">'+value.nama+'</option>');
                    }

                });
            });
        });

        selectCity.on('change',function(){
            var idKabKota = parseInt($(this).children(':selected').attr('id_kabkota'));
            $.getJSON("/district-seribu.json",function(data){
                selectDistrict.html('<option value="" >Pilih Kecamatan</option>');
                $.each(data, function (index,value){
                    if(value.id_kabkota==idKabKota){
                        selectDistrict.append('<option id_kecamatan="'+value.id+'" value="'+value.nama+'">'+value.nama+'</option>');
                    }

                });
            });
        });

        selectDistrict.on('change',function(){
            countKK=0;
            countMember=0;
            var provinsi=selectProvince.val();
            var kota=selectCity.val();
            var kecamatan=$(this).val();
            console.log(provinsi);
            console.log(kota);
            console.log(kecamatan);

            penduduk.where('provinsi','==',provinsi).where('kota','==',kota).where('kecamatan','==',kecamatan).get().then(function(querySnapshot){
                countKK+=querySnapshot.size;
                querySnapshot.forEach(function(doc){
                  if(doc && doc.exists){
                    var docId=doc.id;
                    penduduk.doc(docId).collection('anggota').get().then(function(snapshot){
                      countMember+=snapshot.size;
                      // snapshot.forEach(function(docu){
                      //   if(docu && docu.exists){
                      //       countMember+=1;
                      //       console.log(countMember);
                      //   }
                      // });
                    });
                  }
                });
            });

          setTimeout(function(){
            console.log(countKK);
            console.log(countMember);
            countAll=countKK+countMember;
            $('[name="jumlah_penduduk"]').val(countAll);
            $('[name="jumlah_kk"]').val(countKK);

          },3000);

        });

        function init(){
            console.log('current User: '+currentUser.email);
            var province = currentUser.area.province;
            var city = currentUser.area.city;
            var district = currentUser.area.district;
            var subdistrict = currentUser.area.subdistrict;
            $('[name="periode"]').datepicker({format: 'dd/mm/yyyy'});

            if(currentUser.role=='user'){
                $(location).attr('href','/');
            }

            $.getJSON("/province-dki.json", function (data) {
                selectProvince.html('<option value="" >Pilih Provinsi</option>');
                $.each(data, function (index, value) {
                   selectProvince.append('<option id_prov="'+value.id+'" value="'+value.nama+'">'+value.nama+'</option>');
                });
            });

            switch(currentUser.level){
                case 'province':
                    $('#levelNational').hide();

                    $('#selectProvince').val(province).trigger('change');
                    console.log('Provinsi: '+province);
                    break;
                case 'city':
                    $('#levelNational').hide();
                    $('#levelProvince').hide();

                    $('#selectProvince').val(province);
                    $('#selectProvince').trigger('change');
                    $('#selectCity').val(city);
                    $('#selectCity').trigger('change');
                    break;

                case 'district':
                    $('#levelNational').hide();
                    $('#levelProvince').hide();
                    $('#levelCity').hide();

                    $('#selectProvince').val(province);
                    $('#selectProvince').trigger('change');
                    $('#selectCity').val(city);
                    $('#selectCity').trigger('change');
                    $('#selectDistrict').val(district);
                    $('#selectDistrict').trigger('change');
                    break;

                case 'subdistrict':
                    $('#levelNational').hide();
                    $('#levelProvince').hide();
                    $('#levelCity').hide();
                    $('#levelDistrict').hide();

                    $('#selectProvince').val(province);
                    $('#selectProvince').trigger('change');
                    $('#selectCity').val(city);
                    $('#selectCity').trigger('change');
                    $('#selectDistrict').val(district);
                    $('#selectDistrict').trigger('change');
                    $('#selectSubdistrict').val(subdistrict);
                    $('#selectSubdistrict').trigger('change');
                    break;

            }


        }

        function enableSelect(selector,container){
            container.show();
            selector.attr('required',true);
            selector.val('');
            selector.trigger('change');
        }

        function disableSelect(selector,container){
            container.hide();
            selector.removeAttr('required');
            selector.val('');
            selector.trigger('change');
        }

        function saveData(){
            var kekumuhan = db.collection('kekumuhan');
            var provinsi = $('[name="province"]').val();
            var kota = $('[name="city"]').val();
            var kecamatan = $('[name="district"]').val();

            var periode = $('[name="periode"]').val();
            var luas_kawasan = $('[name="luas_kawasan"]').val();
            var jumlah_penduduk = $('[name="jumlah_penduduk"]').val();
            var jumlah_kk = $('[name="jumlah_kk"]').val();
            var jumlah_bangunan = $('[name="jumlah_bangunan"]').val();

            var bangunan_tak_teratur = $('[name="bangunan_tak_teratur"]').val();
            var bangunan_kepadatan = $('[name="bangunan_kepadatan"]').val();
            var bangunan_tak_standar = $('[name="bangunan_tak_standar"]').val();

            var jalan_tak_terlayani = $('[name="jalan_tak_terlayani"]').val();
            var jalan_total_panjang = $('[name="jalan_total_panjang"]').val();
            var jalan_rusak = $('[name="jalan_rusak"]').val();

            var air_tanpa_akses = $('[name="air_tanpa_akses"]').val();
            var air_tak_terpenuhi = $('[name="air_tak_terpenuhi"]').val();

            var drainase_genangan = $('[name="drainase_genangan"]').val();
            var drainase_tanpa_prasarana = $('[name="drainase_tanpa_prasarana"]').val();
            var drainase_tak_terhubung = $('[name="drainase_tak_terhubung"]').val();
            var drainase_tak_terpelihara = $('[name="drainase_tak_terpelihara"]').val();
            var drainase_konstruksi_buruk = $('[name="drainase_konstruksi_buruk"]').val();

            var limbah_tanpa_akses = $('[name="limbah_tanpa_akses"]').val();
            var limbah_tak_sesuai = $('[name="limbah_tak_sesuai"]').val();

            var sampah_tak_sesuai = $('[name="sampah_tak_sesuai"]').val();
            var sampah_tak_standar = $('[name="sampah_tak_standar"]').val();
            var sampah_tak_terpelihara = $('[name="sampah_tak_terpelihara"]').val();

            var kebakaran_tanpa_prasarana = $('[name="kebakaran_tanpa_prasarana"]').val();
            var kebakaran_tanpa_sarana = $('[name="kebakaran_tanpa_sarana"]').val();

            if(provinsi && kota && kecamatan && periode && luas_kawasan && jumlah_penduduk && jumlah_kk && jumlah_bangunan && bangunan_tak_teratur && bangunan_kepadatan && bangunan_tak_standar && jalan_tak_terlayani && jalan_total_panjang && jalan_rusak && air_tanpa_akses && air_tak_terpenuhi && drainase_genangan && drainase_tanpa_prasarana && drainase_tak_terhubung && drainase_tak_terpelihara && drainase_konstruksi_buruk && limbah_tanpa_akses && limbah_tak_sesuai && sampah_tak_sesuai && sampah_tak_standar && sampah_tak_terpelihara && kebakaran_tanpa_prasarana && kebakaran_tanpa_sarana) {

                var data = {
                    provinsi:provinsi,
                    kota:kota,
                    kecamatan:kecamatan,
                    periode:periode,
                    luas_kawasan:luas_kawasan,
                    jumlah_penduduk:jumlah_penduduk,
                    jumlah_kk:jumlah_kk,
                    jumlah_bangunan:jumlah_bangunan,
                    bangunan_tak_teratur:bangunan_tak_teratur,
                    bangunan_kepadatan:bangunan_kepadatan,
                    bangunan_tak_standar:bangunan_tak_standar,
                    jalan_tak_terlayani:jalan_tak_terlayani,
                    jalan_total_panjang:jalan_total_panjang,
                    jalan_rusak:jalan_rusak,
                    air_tanpa_akses:air_tanpa_akses,
                    air_tak_terpenuhi:air_tak_terpenuhi,
                    drainase_genangan:drainase_genangan,
                    drainase_tanpa_prasarana:drainase_tanpa_prasarana,
                    drainase_tak_terhubung:drainase_tak_terhubung,
                    drainase_tak_terpelihara:drainase_tak_terpelihara,
                    drainase_konstruksi_buruk:drainase_konstruksi_buruk,
                    limbah_tanpa_akses:limbah_tanpa_akses,
                    limbah_tak_sesuai:limbah_tak_sesuai,
                    sampah_tak_sesuai:sampah_tak_sesuai,
                    sampah_tak_standar:sampah_tak_standar,
                    sampah_tak_terpelihara:sampah_tak_terpelihara,
                    kebakaran_tanpa_prasarana:kebakaran_tanpa_prasarana,
                    kebakaran_tanpa_sarana:kebakaran_tanpa_sarana,
                    status:true
                };

                var slums = kekumuhan.where('provinsi','==',provinsi).where('kota','==',kota).where('kecamatan','==',kecamatan).where('status','==',true);
                slums.get().then(function(querySnapshot){
                    querySnapshot.forEach(function(doc){
                        if(doc && doc.exists){
                            var docId=doc.id;
                            kekumuhan.doc(docId).update({
                                status:false
                            });
                        }
                    });
                    kekumuhan.add(data).then(function(){
                        alert('Berhasil menambahkan data!');
                        $(location).attr('href','/slum');
                    }).catch(function(error){
                        alert('Gagal menambahkan data!');
                    });

                });
                
            }

            else{
                console.log(provinsi );
                console.log( kota );
                console.log( kecamatan );
                console.log( periode );
                console.log( luas_kawasan );
                console.log( jumlah_penduduk );
                console.log( jumlah_kk );
                console.log( jumlah_bangunan );
                console.log( bangunan_tak_teratur );
                console.log( bangunan_kepadatan );
                console.log( bangunan_tak_standar );
                console.log( jalan_tak_terlayani );
                console.log( jalan_total_panjang );
                console.log( jalan_rusak );
                console.log( air_tanpa_akses );
                console.log( air_tak_terpenuhi );
                console.log( drainase_genangan );
                console.log( drainase_tanpa_prasarana );
                console.log( drainase_tak_terhubung );
                console.log( drainase_tak_terpelihara );
                console.log( drainase_konstruksi_buruk );
                console.log( limbah_tanpa_akses );
                console.log( limbah_tak_sesuai );
                console.log( sampah_tak_sesuai );
                console.log( sampah_tak_standar );
                console.log( sampah_tak_terpelihara );
                console.log( kebakaran_tanpa_prasarana );
                console.log( kebakaran_tanpa_sarana);

                alert('Mohon isi seluruh data terlebih dahulu!');
            }


        }
    </script>
@endsection
