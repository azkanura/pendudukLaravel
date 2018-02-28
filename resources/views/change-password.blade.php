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
          Ubah Password Pengguna
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
                    <span class="page-messages-item-from box-cell text-default">Password Lama</span>
                    <div class="page-messages-item-subject box-cell"><input type="password" class="form-control" id="oldPassword"></div>
                 </div>
              </td>
           </tr>
           <tr>
              <td style="padding:20px">
                 <div class="box m-a-0 bg-transparent">
                    <span class="page-messages-item-from box-cell text-default">Password Baru</span>
                    <div class="page-messages-item-subject box-cell"><input type="password" class="form-control" id="newPassword"></div>
                 </div>
              </td>
           </tr>
           <tr>
              <td style="padding:20px">
                 <div class="box m-a-0 bg-transparent">
                    <span class="page-messages-item-from box-cell text-default">Ketik Ulang Password Baru</span>
                    <div class="page-messages-item-subject box-cell"><input type="password" class="form-control" id="repeatPassword"></div>
                 </div>
              </td>
           </tr>
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
    // $('#fullName').val(data.full_name);
    // activeUser = user;
    // userId = id;
  }

  $('#saveBtn').on('click',function(){
    firebase.auth().onAuthStateChanged(function(user) {
      if (user) {
        user.updatePassword($('#newPassword').val()).then(function(){
          console.log('Berhasil mengubah password');
          $(location).attr('href','/profile');
        }).catch((error)=>{
          console.log(error);
        });
      }
    });
  });
</script>
@endsection
