var kekumuhan = db.collection('kekumuhan');
var count;
var total_score;
var final_score;

kekumuhan.where('provinsi','==','DKI Jakarta').where('kota','==','Kab. Kepulauan Seribu').where('status','==',true).get().then(function(snapshot){
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
		            b_tak_teratur ,
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

            total_score+=countAllScore(percentageArray);

		}
	});
	final_score=total_score/count;
});

function countAllScore(percentageArray){
	var count=0;
	if(percentageArray.size){
		percentageArray.forEach(function(percentage){
			count+=countScore(percentage);
		});
	}
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