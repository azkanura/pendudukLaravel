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

// var clauseArray = [{title:'provinsi',content:'DKI Jakarta'},{title:'kota',content:' Kab. Kepulauan Seribu'},{title:'kecamatan',content:'Kepulauan Seribu Selatan'}];

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
