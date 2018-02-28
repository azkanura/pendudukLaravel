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
          Profil Pengguna
          <a href="/profile-edit" class="btn btn-success pull-right">
              <i class="fa fa-pencil fa-fw"></i> Ubah
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
                    <div class="page-messages-item-subject box-cell"><span class="text-default font-weight-bold" id="fullName"></span></div>
                 </div>
              </td>
           </tr>
           <tr>
              <td style="padding:20px">
                 <div class="box m-a-0 bg-transparent">
                    <span class="page-messages-item-from box-cell text-default">Email</span>
                    <div class="page-messages-item-subject box-cell"><span class="text-default font-weight-bold" id="email"></span></div>
                 </div>
              </td>
           </tr>
           <tr>
              <td style="padding:20px">
                 <div class="box m-a-0 bg-transparent">
                    <span class="page-messages-item-from box-cell text-default">Role</span>
                    <div class="page-messages-item-subject box-cell"><span class="text-default font-weight-bold" id="role"></span></div>
                 </div>
              </td>
           </tr>
           <tr>
              <td style="padding:20px">
                 <div class="box m-a-0 bg-transparent">
                    <span class="page-messages-item-from box-cell text-default">Area</span>
                    <div class="page-messages-item-subject box-cell"><span class="text-default font-weight-bold" id="area"></span></div>
                 </div>
              </td>
           </tr>
           <tr>
              <td style="padding:20px">
                 <div class="box m-a-0 bg-transparent">
                    <span class="page-messages-item-from box-cell text-default">Tingkat</span>
                    <div class="page-messages-item-subject box-cell"><span class="text-default font-weight-bold" id="level"></span></div>
                 </div>
              </td>
           </tr>
        </tbody>
     </table>
  </div>
@endsection
@section('inlinejs')
<script>
  function init(){
    $('#email').html(data.email);
    $('#fullName').html(data.full_name);
    $('#role').html(data.role);
    switch(data.level){
      case 'national':
        $('#area').html(data.area.country);
        $('#level').html('Nasional');
        break;
      case 'province':
        $('#area').html(data.area.province+', '+data.area.country);
        $('#level').html('Provinsi');
        break;
      case 'city':
        $('#area').html(data.area.city+'\n'+data.area.province+', '+data.area.country);
        $('#level').html('Kota/Kabupaten');
        break;
      case 'district':
        $('#area').html('Kecamatan '+data.area.district+', '+data.area.city+'\n'+data.area.province+', '+data.area.country);
        $('#level').html('Kecamatan');
        break;
      case 'subdistrict':
        $('#area').html('Kelurahan '+data.area.subdistrict+' Kecamatan '+data.area.district+', '+data.area.city+'\n'+data.area.province+', '+data.area.country);
        $('#level').html('Kelurahan');
        break;
    }
  }
</script>
@endsection
