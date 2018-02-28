@extends('base') @section('title') Laporan @endsection @section('inlinecss')
<link href="css/custom.css" rel="stylesheet" type="text/css"> @endsection
<!-- Content -->
@section('content')
<div class="page-header m-b-0">
    <h1 style="display: block;">Laporan Statistik Kepulauan Seribu
        <small id="area" style="line-height: 30px" class="pull-right"></small>
    </h1>
</div>
<br>
<div class="row">
    <div class="col-md-4">
        <a href="{{url('/penduduk')}}" class="box bg-primary">
          <div class="box-cell p-a-3 valign-middle">
            <i class="box-bg-icon middle right ion-person-stalker"></i>
            <span class="font-size-15">Jumlah Penduduk</span><br>
            <span class="font-size-24"><strong id="penduduk"></strong> Jiwa</span>
          </div>
        </a>
        <a href="{{url('/penduduk')}}" class="box bg-primary">
          <div class="box-cell p-a-3 valign-middle">
            <i class="box-bg-icon middle right ion-ios-people"></i>
            <span class="font-size-15">Jumlah Keluarga</span><br>
            <span class="font-size-24"><strong id="kk"></strong> Keluarga</span>
          </div>
        </a>
    </div>
    <div class="col-md-4">
        <a href="{{url('/')}}" class="box bg-success">
          <div class="box-cell p-a-3 valign-middle">
            <i class="box-bg-icon middle right ion-man"></i>
            <span class="font-size-15">Jumlah Laki-laki</span><br>
            <span class="font-size-24"><strong id="pria"></strong> Jiwa</span>
          </div>
        </a>
        <a href="{{url('/')}}" class="box bg-warning">
          <div class="box-cell p-a-3 valign-middle">
            <i class="box-bg-icon middle right ion-woman"></i>
            <span class="font-size-15">Jumlah Perempuan</span><br>
            <span class="font-size-24"><strong id="wanita"></strong> Jiwa</span>
          </div>
        </a>
    </div>
        <div class="col-md-4">
        <a href="{{url('/slum')}}" class="box bg-danger">
          <div class="box-cell p-a-3 valign-middle">
            <i class="box-bg-icon middle right ion-waterdrop"></i>
            <span class="font-size-15">Tingkat Kekumuhan</span><br>
            <span class="font-size-24"><strong id="skor_kekumuhan"></strong></span>
          </div>
        </a>
        <a href="{{url('/slum')}}" class="box bg-danger">
          <div class="box-cell p-a-3 valign-middle">
            <i class="box-bg-icon middle right ion-waterdrop"></i>
            <span class="font-size-15">Kriteria Kekumuhan</span><br>
            <span class="font-size-24"><strong id="kriteria_kekumuhan"></strong></span>
          </div>
        </a>
    </div>
</div>

@endsection @section('inlinejstop')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCHtdj4L66c05v1UZm-nte1FzUEAN6GKBI&callback=initMap&sensor=false"
    async defer></script> @endsection @section('inlinejs')
<script>
    function init() {
        var kekumuhan = db.collection('kekumuhan');
        var penduduk = db.collection('penduduk');
        var count;
        var total_score;
        var final_score;
        var criteria;

        var countKK=0;
        var countMember=0;
        var countAll=0;
        var countMale=0;
        var countFemale=0;

        var provinsi='Dki Jakarta';
        var kota='Kab. Kepulauan Seribu';

        kekumuhan.where('provinsi','==',provinsi).where('kota','==',kota).where('status','==',true).get().then(function(snapshot){
            count=0;
            total_score=0;
            snapshot.forEach(function(doc){
                if(doc && doc.exists){
                    count+=1
                    var data = doc.data();
                    var luas_kawasan = data.luas_kawasan;
                    var jumlah_penduduk = data.jumlah_penduduk;
                    var jumlah_kk = data.jumlah_kk;
                    var jumlah_bangunan = data.jumlah_bangunan;

                    var bangunan_tak_teratur = data.bangunan_tak_teratur;
                    var bangunan_kepadatan = data.bangunan_kepadatan;
                    var bangunan_tak_standar = data.bangunan_tak_standar;

                    var jalan_tak_terlayani = data.jalan_tak_terlayani;
                    var jalan_total_panjang = data.jalan_total_panjang;
                    var jalan_rusak = data.jalan_rusak;

                    var air_tanpa_akses = data.air_tanpa_akses;
                    var air_tak_terpenuhi = data.air_tak_terpenuhi;

                    var drainase_genangan = data.drainase_genangan;
                    var drainase_tanpa_prasarana = data.drainase_tanpa_prasarana;
                    var drainase_tak_terhubung = data.drainase_tak_terhubung;
                    var drainase_tak_terpelihara = data.drainase_tak_terpelihara;
                    var drainase_konstruksi_buruk = data.drainase_konstruksi_buruk;

                    var limbah_tanpa_akses = data.limbah_tanpa_akses;
                    var limbah_tak_sesuai = data.limbah_tak_sesuai;
                    var sampah_tak_sesuai = data.sampah_tak_sesuai;
                    var sampah_tak_standar = data.sampah_tak_standar;
                    var sampah_tak_terpelihara = data.sampah_tak_terpelihara;
                    var kebakaran_tanpa_prasarana = data.kebakaran_tanpa_prasarana;
                    var kebakaran_tanpa_sarana = data.kebakaran_tanpa_sarana;

                    var b_tak_teratur = parseFloat(bangunan_tak_teratur)/parseFloat(jumlah_bangunan);
                    var b_kepadatan = parseFloat(bangunan_kepadatan)/parseFloat(luas_kawasan);
                    var b_tak_standar =parseFloat(bangunan_tak_standar)/parseFloat(jumlah_bangunan);

                    var j_tak_terlayani=parseFloat(jalan_tak_terlayani)/parseFloat(luas_kawasan);
                    var j_rusak=parseFloat(jalan_rusak)/parseFloat(luas_kawasan);

                    var a_tanpa_akses=parseFloat(air_tanpa_akses)/parseFloat(jumlah_penduduk);
                    var a_tak_terpenuhi=parseFloat(air_tak_terpenuhi)/parseFloat(jumlah_penduduk);

                    var d_genangan=parseFloat(drainase_genangan)/parseFloat(luas_kawasan);
                    var d_tanpa_prasarana=parseFloat(drainase_tanpa_prasarana)/parseFloat(luas_kawasan);
                    var d_tak_terhubung=parseFloat(drainase_tak_terhubung)/parseFloat(luas_kawasan);
                    var d_tak_terpelihara=parseFloat(drainase_tak_terpelihara)/parseFloat(luas_kawasan);
                    var d_konstruksi_buruk=parseFloat(drainase_konstruksi_buruk)/parseFloat(luas_kawasan);

                    var l_tanpa_akses=parseFloat(limbah_tanpa_akses)/parseFloat(jumlah_penduduk);
                    var l_tak_sesuai=parseFloat(limbah_tak_sesuai)/parseFloat(luas_kawasan);

                    var s_tak_sesuai=parseFloat(sampah_tak_sesuai)/parseFloat(luas_kawasan);
                    var s_tak_standar=parseFloat(sampah_tak_standar)/parseFloat(luas_kawasan);
                    var s_tak_terpelihara=parseFloat(sampah_tak_terpelihara)/parseFloat(luas_kawasan);

                    var k_tanpa_prasarana=parseFloat(kebakaran_tanpa_prasarana)/parseFloat(luas_kawasan);
                    var k_tanpa_sarana=parseFloat(kebakaran_tanpa_sarana)/parseFloat(luas_kawasan);
                    var percentageArray=[
                            b_tak_teratur,
                            b_kepadatan,
                            b_tak_standar,
                            j_tak_terlayani,
                            j_rusak,
                            a_tanpa_akses,
                            a_tak_terpenuhi,
                            d_genangan,
                            d_tanpa_prasarana,
                            d_tak_terhubung,
                            d_tak_terpelihara,
                            d_konstruksi_buruk,
                            l_tanpa_akses,
                            l_tak_sesuai,
                            s_tak_sesuai,
                            s_tak_standar,
                            s_tak_terpelihara,
                            k_tanpa_prasarana,
                            k_tanpa_sarana
                    ];
                    console.log(percentageArray);

                    total_score+=countAllScore(percentageArray);
                    console.log(total_score);

                }
            });
            final_score=total_score/count;
            criteria=displayCriteria(final_score);
            $('#skor_kekumuhan').html(final_score);
            $('#kriteria_kekumuhan').html(criteria);
        });

        penduduk.where('provinsi','==',provinsi).where('kota','==',kota).get().then(function(querySnapshot){
                countKK+=querySnapshot.size;
                querySnapshot.forEach(function(doc){
                  if(doc && doc.exists){
                    var docId=doc.id;
                    var kkGender=doc.data().jenis_kelamin;
                    if(kkGender=='Pria'){
                        countMale+=1;
                    }
                    else{
                        countFemale+=1;
                    }
                    penduduk.doc(docId).collection('anggota').get().then(function(snapshot){
                      countMember+=snapshot.size;
                      snapshot.forEach(function(docu){
                        if(docu && docu.exists){
                            var memberGender=docu.data().jenis_kelamin;
                            if(memberGender=='Pria'){
                                countMale+=1;
                            }
                            else{
                                countFemale+=1;
                            }
                        }
                      });
                    });
                  }
                });
            });

        setTimeout(function(){
            countAll=countKK+countMember;
            $('#penduduk').html(countAll);
            $('#kk').html(countKK);
            $('#pria').html(countMale);
            $('#wanita').html(countFemale);
        },5000);

    }

    function countAllScore(percentageArray){
        var count=0;
        if(percentageArray.length){
            percentageArray.forEach(function(percentage){
                count+=countScore(percentage);
            });
        }
        console.log(percentageArray.length);
        return count;
    }

    function countScore(percentage){
        if(percentage<=1 && percentage>(75/100)){
            return 5;
        }
        else if(percentage<=(75/100)&&percentage>(50/100)){
            return 3;
        }
        else{
            return 1;
        }
    }

    function displayCriteria(score){
        if(score<=95 && score>70){
            return 'Kumuh Berat';
        }
        else if(score<=70 && score>44){
            return 'Kumuh Sedang';
        }
        else if(score<=44 && score>=19){
            return 'Kumuh Ringan';
        }
        else{
            return 'Tidak Kumuh';
        }

    }

</script> @endsection