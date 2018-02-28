@extends('base')
@section('content')
    <style>
      .table>tbody>tr:first-child>td{
        border-top:none !important;
      }
      .page-header h3{
        display: block;
      }
    </style>
    <div class="page-header">
        <h3>
          Ubah Profil Pengguna
          <a href="#" id="saveBtn" class="btn btn-success pull-right">
              <i class="fa fa-check fa-fw"></i> Simpan
          </a>
        </h3>
    </div>

    <div id="dataContainer">
     <table class="page-messages-items table m-a-0">
        <tbody>
           <tr>
              <td style="padding:20px">
                 <div class="box m-a-0 bg-transparent">
                    <span class="page-messages-item-from box-cell text-default">Nama Lengkap</span>
                    <div class="page-messages-item-subject box-cell"><input class="form-control" id="fullName"></div>
                 </div>
              </td>
           </tr>
           <!-- <tr>
              <td style="padding:20px">
                 <div class="box m-a-0 bg-transparent">
                    <span class="page-messages-item-from box-cell text-default">Email</span>
                    <div class="page-messages-item-subject box-cell"><input class="form-control" id="email"></div>
                 </div>
              </td>
           </tr> -->
        </tbody>
     </table>
  </div>
@endsection
@section('inlinejs')
<script>
  var activeUser;
  var userId;
  var users=db.collection('users');
  var user = firebase.auth().currentUser;

  function init(){
    // $('#email').val(data.email);
    $('#fullName').val(data.full_name);
    activeUser = user;
    userId = uid;
    console.log(userId);
  }

  $('#saveBtn').on('click',function(){
    firebase.auth().onAuthStateChanged(function(user) {
      if (user) {
        // user.updateEmail($('#email').val()).then(function(){
          users.doc(userId).update({
            full_name:$('#fullName').val(),
            // email:$('#email').val()
          }).then((docRef)=>{
            console.log('sukses mengubah nama');
            $(location).attr('href','/profile');
          }).catch((error)=>{
            console.log('gagal mengubah nama');
          });
        // }).catch((error)=>{
        //   console.log(error);
        // });
      }
    });
  });
</script>
@endsection
