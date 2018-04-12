// $(function(){
// 	$('select').select2();
// });
// var db = firebase.firestore();
// var storage = firebase.storage();

var storageRef=storage.ref();
var currentUser;
var pr,ct,ds,sd='';
var uid;

firebase.auth().onAuthStateChanged(function(user) {
  if (user) {
    // User is signed in.
    var email = user.email;
    var users = db.collection('users');
    var level = '';
    users.where('email','==',email).limit(1).get().then((querySnapshot)=>{
        querySnapshot.forEach((doc)=>{

            data = doc.data();
            uid=doc.id;
            var firstname=data.full_name.split(" ")[0];

            $('#displayFirstname').html(firstname);
            $('#displayUsername').html(data.full_name);
            if(data.role=='user'){
                console.log(data.role);
               $('#userMenu').hide();
            }
            else if(data.role=='admin'){
                console.log(data.role);
               $('#userMenu').show();
            }
            setCurrentUser(data);
            pr=data.area.province;
            ct=data.area.city;
            ds=data.area.district;
            sd=data.area.subdistrict;
            init();
            storageRef.child(data.photo_url).getDownloadURL().then((url)=>{
                $('.profile-picture').attr('src',url);
            });


        });
    });
    // ...
  }

  else {
    // User is signed out.
    // ...
    $(location).attr('href','/login');
  }
});


$('#logoutBtn').on('click',function(){
	firebase.auth().signOut().catch((error)=>{
		var errorCode = error.code;
        var errorMessage = error.message;
        console.log('Error '+errorCode+': '+errorMessage);
        alert('Error '+errorCode+': '+errorMessage);
	});
});

function setCurrentUser(data){
    currentUser = data;
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

function anggotaPersonalSave(){
  var id = $('[name="id"]').val();
  var kkId = $('[name="kk_id"]').val();
  var resident = penduduk.doc(kkId).collection('anggota').doc(id);
  resident.update({
    agama:$('[name="religion"]').val(),
    bidang_pekerjaan:$('[name="job_field"]').val(),
    golongan_darah:$('[name="blood_type"]').val(),
    jenis:$('[name="status"]').val(),
    jenis_kelamin:$('[name="gender"]').val(),
    kewarganegaraan:$('[name="nationality"]').val(),
    kirasan_penghasilan:$('[name="income"]').val(),
    nama_lengkap:$('[name="name"]').val(),
    pekerjaan:$('[name="job"]').val(),
    pendidikan:$('[name="education"]').val(),
    status_perkawinan:$('[name="marriage"]').val(),
    tanggal_lahir:$('[name="birth_date"]').val(),
    tempat_lahir:$('[name="birth_place"]').val()
  }).then(function() {
    alert('Data anggota keluarga berhasil diubah');
    $(location).attr('href','/anggota-edit/'+kkId+'/'+id);

  })
  .catch(function(error) {
    alert('Data anggota keluarga gagal diubah, terjadi kesalahan teknis');
    $(location).attr('href','/anggota-edit/'+kkId+'/'+id);

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

  documents.get().then((querySnapshot)=>{
    querySnapshot.forEach((doc)=>{
      var doc_id = doc.id;
      var kkPhoto = doc.data().foto_kk;
      var coordinate = doc.data().koordinat;
      var document = documents.doc(doc_id);
      alert($(document).find('[name="kk_number"]').val());
      document.update({
        nomor_kk:$(document).find('[name="kk_number"]').val(),
        provinsi:$(document).find('[name="province"]').val(),
        kota:$(document).find('[name="city"]').val(),
        kecamatan:$(document).find('[name="district"]').val(),
        kelurahan:$(document).find('[name="subdistrict"]').val(),
        rw:$(document).find('[name="rw"]').val(),
        rt:$(document).find('[name="rt"]').val(),
        alamat:$(document).find('[name="address"]').val(),
        foto_kk:kkPhoto,
        koordinat:$(document).find('[name="geolocation"]').val()
      }).then(function(){
        alert('Data aset berhasil diubah');
        $(location).attr('href','/penduduk-edit/'+id);


      }).catch(function(error){
        alert('Data aset gagal diubah, terjadi kesalahan teknis');
        $(location).attr('href','/penduduk-edit/'+id);

      });

    });
  });
}

function saveUser(){
   var fullname=$('[name="full_name"]').val();
   var email=$('[name="email"]').val();
   console.log(email);
   var password=$('[name="password"]').val();
   var role=$('[name="role"]').val();
   var level=$('[name="level"]').val();
   var province='';
   var city='';
   var district='';
   var subdistrict='';
   if($('[name="province"]').val()){
       province = $('[name="province"]').val();
   }
   if($('[name="city"]').val()){
       city = $('[name="city"]').val();
   }
   if($('[name="district"]').val()){
       district = $('[name="district"]').val();
   }
   if($('[name="subdistrict"]').val()){
       subdistrict = $('[name="subdistrict"]').val();
   }

   var area = {
       country:'Indonesia',
       province:province,
       city:city,
       district:district,
       subdistrict:subdistrict
   }

   firebase.auth().createUserWithEmailAndPassword(email, password).then(()=>{
       users.add({
           full_name : fullname,
           email : email,
           role : role,
           level : level,
           area : area
       })
       .then(function(docRef) {
           alert("Document written with ID: ", docRef.id);
           $(location).attr('href','/user');

       })
       .catch(function(error) {
           alert('error! cannot save user');
           console.error("Error adding document: ", error);
       });
   }).catch(function(error) {
          alert('error! cannot save user');
         $(location).attr('href','/');
   });
}

// var clauseArray = [{title:'provinsi',content:'Dki Jakarta'},{title:'kota',content:' Kab. Kepulauan Seribu'},{title:'kecamatan',content:'Kepulauan Seribu Selatan'}];

// function whereClause(clauseArray){
//   var target = penduduk;
//   if(clauseArray.size){
//       clauseArray.forEach(function(clause){
//         target = target.where(clause.title,'==',clause.content);
//       });
//   }
//   return target;
// }

// function countKK(clauseArray){
//   var count=0;
//   whereClause(clauseArray).get().then(function(querySnapshot){
//     count+=querySnapshot.size;
//     console.log(count);
//   });

//   setTimeout(function(){
//     return count;
//   },3000);
// }

// function countAll(clauseArray){
//   var count=0;
//   whereClause(clauseArray).get().then(function(querySnapshot){
//     count+=querySnapshot.size;
//     querySnapshot.forEach(function(doc){
//       if(doc && doc.exists){
//         var docId=doc.id;
//         penduduk.doc(docId).collection('anggota').get().then(function(snapshot){
//           count+=snapshot.size;
//         });
//       }
//     });
//   });

//   setTimeout(function(){
//     return count;
//   },3000);
// }
