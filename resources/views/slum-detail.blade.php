@extends('base')
@section('title')
     Detail Data Kekumuhan
@endsection
  <!-- Content -->
@section('content')
    <div class="page-header">
        <h3 style="width:100%">
            <span class="text-muted font-weight-light">Detail Data Kekumuhan <a class="pull-right" href="{{url('/slum-edit')}}/{{$id}}"><button class="btn btn-primary">Ubah Data</button></a>
        </h3>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="panel-body">
                <div id="selectArea" >
                    <hr class="primary" style="margin-top: 0">
                    <div class="form-group" style="margin-bottom: 0">
                        <label class="control-label">
                            <small >Area</small>
                        </label>
                    </div>
                    <hr class="primary">
                    <div class="row form-group" id="selectProvinceContainer">
                        <label class="control-label col-md-6">
                            Provinsi
                        </label>
                        <div class="col-md-6">
                            <p name="province" id="selectProvince">
                                
                           </p>
                       </div>
                    </div>
                    <div class="row form-group" id="selectCityContainer">
                        <label class="control-label col-md-6">
                            Kota/Kabupaten
                        </label>
                        <div class="col-md-6">
                            <p name="city" id="selectCity">
                                
                           </p>
                       </div>
                    </div>
                    <div class="row form-group" id="selectDistrictContainer">
                        <label class="control-label col-md-6">
                            Kecamatan
                        </label>
                        <div class="col-md-6">
                            <p name="district" id="selectDistrict">
                                
                           </p>
                       </div>
                    </div>
                </div>
                <hr class="primary">
                <div class="row form-group">
                    <label class="control-label col-md-6">Periode</label>
                    <div class="col-md-6">
                        <p  name="periode" ></p>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="control-label col-md-6">Luas Kawasan</label>
                    <div class="col-md-6">
                        <p type="number"  name="luas_kawasan" ><small> Hektar (Ha)</small></p>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="control-label col-md-6">Jumlah Penduduk</label>
                    <div class="col-md-6">
                        <p type="number"  name="jumlah_penduduk" ><small> Jiwa</small>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="control-label col-md-6">Jumlah Kepala Keluarga</label>
                    <div class="col-md-6">
                        <p type="number"  name="jumlah_kk" ><small> KK</small>

                    </div>
                </div>
                <div class="row form-group">
                    <label class="control-label col-md-6">Jumlah Bangunan</label>
                    <div class="col-md-6">
                        <p type="number"  name="jumlah_bangunan" ><small> Unit</small>
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
                        <p type="number"  name="bangunan_tak_teratur" ><small> Unit</small>
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
                        <p type="number"  name="bangunan_kepadatan" ><small> Hektar(Ha)</small>
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
                        <p type="number"  name="bangunan_tak_standar" ><small> Unit</small>
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
                        <p type="number"  name="jalan_tak_terlayani" ><small> Hektar(Ha)</small></p>
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
                        <p type="number"  name="jalan_total_panjang" ><small> Meter(m)</small></p>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="control-label col-md-6">Panjang jalan dengan permukaan jalan rusak</label>
                    <div class="col-md-6">
                        <p type="number"  name="jalan_rusak" ><small> Meter(m)</small></p>
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
                        <p type="number"  name="air_tanpa_akses" ><small> Jiwa</small>
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
                        <p type="number"  name="air_tak_terpenuhi" ><small> Jiwa</small>
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
                        <p type="number"  name="drainase_genangan" ><small> Hektar(Ha)</small></p>
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
                        <p type="number"  name="drainase_tanpa_prasarana" ><small> Hektar(Ha)</small></p>
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
                        <p type="number"  name="drainase_tak_terhubung" ><small> Hektar(Ha)</small></p>
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
                        <p type="number"  name="drainase_tak_terpelihara" ><small> Hektar(Ha)</small></p>
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
                        <p type="number"  name="drainase_konstruksi_buruk" ><small> Hektar(Ha)</small></p>
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
                        <p type="number"  name="limbah_tanpa_akses" ><small> Jiwa</small>
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
                        <p type="number"  name="limbah_tak_sesuai" ><small> Hektar(Ha)</small>
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
                        <p type="number"  name="sampah_tak_sesuai" ><small> Hektar(Ha)</small></p>
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
                        <p type="number"  name="sampah_tak_standar" ><small> Hektar(Ha)</small></p>
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
                        <p type="number"  name="sampah_tak_terpelihara" ><small> Hektar(Ha)</small></p>
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
                        <p type="number"  name="kebakaran_tanpa_prasarana" ><small> Hektar(Ha)</small></p>
                    </div>
                </div>

                <hr class="primary">
                <div class="form-group" style="margin-bottom: 0">
                    <label class="control-label">
                        <small >Tidak Adanya Sarana Proteksi Kebakaran (APAR, Mobil Pompa dan Sarana Pendukung Lainnya)</small></p>
                    </label>
                </div>
                <hr class="primary">
                <div class="row form-group">
                    <label class="control-label col-md-6">Luas area yang tidak memiliki sarana proteksi kebakaran</label>
                    <div class="col-md-6">
                        <p type="number"  name="kebakaran_tanpa_sarana" ><small> Hektar(Ha)</small></p>
                    </div>
                </div>
            </div>
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

            var kekumuhan = db.collection('kekumuhan');
            kekumuhan.doc('{{$id}}').get().then(function(doc){
                if(doc && doc.exists){
                    var data = doc.data();
                    $('[name="province"]').html(data.provinsi);
                    $('[name="city"]').html(data.kota);
                    $('[name="district"]').html(data.kecamatan);

                    $('[name="periode"]').html(data.periode);
                    $('[name="luas_kawasan"]').prepend(formatThousand(data.luas_kawasan));
                    $('[name="jumlah_penduduk"]').prepend(formatThousand(data.jumlah_penduduk));
                    $('[name="jumlah_kk"]').prepend(formatThousand(data.jumlah_kk));
                    $('[name="jumlah_bangunan"]').prepend(formatThousand(data.jumlah_bangunan));

                    $('[name="bangunan_tak_teratur"]').prepend(formatThousand(data.bangunan_tak_teratur));
                    $('[name="bangunan_kepadatan"]').prepend(formatThousand(data.bangunan_kepadatan));
                    $('[name="bangunan_tak_standar"]').prepend(formatThousand(data.bangunan_tak_standar));

                    $('[name="jalan_tak_terlayani"]').prepend(formatThousand(data.jalan_tak_terlayani));
                    $('[name="jalan_total_panjang"]').prepend(formatThousand(data.jalan_total_panjang));
                    $('[name="jalan_rusak"]').prepend(formatThousand(data.jalan_rusak));

                    $('[name="air_tanpa_akses"]').prepend(formatThousand(data.air_tanpa_akses));
                    $('[name="air_tak_terpenuhi"]').prepend(formatThousand(data.air_tak_terpenuhi));

                    $('[name="drainase_genangan"]').prepend(formatThousand(data.drainase_genangan));
                    $('[name="drainase_tanpa_prasarana"]').prepend(formatThousand(data.drainase_tanpa_prasarana));
                    $('[name="drainase_tak_terhubung"]').prepend(formatThousand(data.drainase_tak_terhubung));
                    $('[name="drainase_tak_terpelihara"]').prepend(formatThousand(data.drainase_tak_terpelihara));
                    $('[name="drainase_konstruksi_buruk"]').prepend(formatThousand(data.drainase_konstruksi_buruk));

                    $('[name="limbah_tanpa_akses"]').prepend(formatThousand(data.limbah_tanpa_akses));
                    $('[name="limbah_tak_sesuai"]').prepend(formatThousand(data.limbah_tak_sesuai));

                    $('[name="sampah_tak_sesuai"]').prepend(formatThousand(data.sampah_tak_sesuai));
                    $('[name="sampah_tak_standar"]').prepend(formatThousand(data.sampah_tak_standar));
                    $('[name="sampah_tak_terpelihara"]').prepend(formatThousand(data.sampah_tak_terpelihara));

                    $('[name="kebakaran_tanpa_prasarana"]').prepend(formatThousand(data.kebakaran_tanpa_prasarana));
                    $('[name="kebakaran_tanpa_sarana"]').prepend(formatThousand(data.kebakaran_tanpa_sarana));
                }
            });


        }

        function formatThousand(x){
          return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        }

    </script>
@endsection
