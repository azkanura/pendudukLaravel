@extends('base')
@section('title')
     Ubah User
@endsection
  <!-- Content -->
@section('content')
    <div class="page-header">
        <h3>
            <span class="text-muted font-weight-light">User</span> / Add User
        </h3>
    </div>

    <div class="row">
        <div class="col-md-6">
                <div class="panel-heading">
                    <div class="panel-title">Editor</div>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="control-label">Nama Lengkap</label>
                        <input type="text" class="form-control" name="full_name" required />
                    </div>
                    <div class="form-group">
                        <label class="control-label">Email</label>
                        <input type="email" class="form-control" name="email" required />
                    </div>
                    <div class="form-group">
                        <label class="control-label">Password</label>
                        <input type="password" class="form-control" name="password" required />
                    </div>
                    <div class="form-group">
                        <label class="control-label">Ulangi Password</label>
                        <input type="password" class="form-control" name="repeat_password" required />
                    </div>
                    <div class="form-group">
                        <label class="control-label">
                            Role
                        </label>
                        <select name="role" class="form-control">
                            <option value="admin">Admin</option>
                            <option value="user">User</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">
                            Tingkatan
                        </label>
                        <select name="level" class="form-control">
                            <option value="subdistrict" id="levelSubdistrict">Kelurahan</option>
                            <option value="district" id="levelDistrict">Kecamatan</option>
                            <option value="city" id="levelCity">Kota/Kabupaten</option>
                            <option value="province" id="levelProvince">Provinsi</option>
                            <option value="national" id="levelNational">Nasional</option>
                        </select>
                    </div>
                    <div id="selectArea" >
                        <br>
                        <hr style="margin:8px 0;border:1px solid #eee">
                        <div class="form-group" style="margin-bottom: 0">
                            <label class="control-label">
                                <small >Pilih Area</small>
                            </label>
                        </div>
                        <hr style="margin:8px 0;border:1px solid #eee">
                        <div class="form-group" id="selectProvinceContainer">
                            <label class="control-label">
                                Provinsi
                            </label>
                            <select name="province" class="form-control" required id="selectProvince">
                                <option value="">Loading data...</option>
                           </select>
                        </div>
                        <div class="form-group" id="selectCityContainer">
                            <label class="control-label">
                                Kota/Kabupaten
                            </label>
                            <select name="city" class="form-control" required id="selectCity">
                                <option value="">Loading data...</option>
                           </select>
                        </div>
                        <div class="form-group" id="selectDistrictContainer">
                            <label class="control-label">
                                Kecamatan
                            </label>
                            <select name="district" class="form-control" required id="selectDistrict">
                                <option value="">Loading data...</option>
                           </select>
                        </div>
                        <div class="form-group" id="selectSubdistrictContainer">
                            <label class="control-label">
                                Kelurahan
                            </label>
                            <select name="subdistrict" class="form-control" required id="selectSubdistrict">
                                <option value="">Loading data...</option>
                           </select>
                        </div>
                    </div>

                </div>
                <div class="panel-footer">
                    <button onclick="saveUser()" class="btn btn-primary">Simpan</button>
                </div>
        </div>
    </div>
@endsection
@section('inlinejs')
    <script src="/"></script>
    <script type="text/javascript">
        var password = $('[name="password"]')[0];
        var repeatPassword = $('[name="repeat_password"]')[0];
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

        password.onchange = validatePassword;
        repeatPassword.onchange = validatePassword;
        password.onkeyup = validatePassword;
        repeatPassword.onkeyup = validatePassword;

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
            $.getJSON("/city.json",function(data){
                selectCity.html('<option value="" readonly>Pilih Kota/Kabupaten</option>');
                $.each(data, function (index,value){
                    if(value.id_prov==idProv){
                        selectCity.append('<option id_kabkota="'+value.id+'" value="'+value.nama+'">'+value.nama+'</option>');
                    }

                });
            });
        });

        selectCity.on('change',function(){
            var idKabKota = parseInt($(this).children(':selected').attr('id_kabkota'));
            $.getJSON("/district.json",function(data){
                selectDistrict.html('<option value="" readonly>Pilih Kecamatan</option>');
                $.each(data, function (index,value){
                    if(value.id_kabkota==idKabKota){
                        selectDistrict.append('<option id_kecamatan="'+value.id+'" value="'+value.nama+'">'+value.nama+'</option>');
                    }

                });
            });
        });

        selectDistrict.on('change',function(){
            var idKecamatan = parseInt($(this).children(':selected').attr('id_kecamatan'));
            $.getJSON("/subdistrict.json",function(data){
                selectSubdistrict.html('<option value="" readonly>Pilih Desa/Kelurahan</option>');
                $.each(data, function (index,value){
                    if(value.id_kecamatan==idKecamatan){
                        selectSubdistrict.append('<option value="'+value.nama+'">'+value.nama+'</option>');
                    }

                });
            });
        });

        function init(){
            console.log('current User: '+currentUser.email);
            var province = currentUser.area.province;
            var city = currentUser.area.city;
            var district = currentUser.area.district;
            var subdistrict = currentUser.area.subdistrict;

            if(currentUser.role=='user'){
                $(location).attr('href','/');
            }

            $.getJSON("/province.json", function (data) {
                selectProvince.html('<option value="" readonly>Pilih Provinsi</option>');
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

        function validatePassword(){
            if(password.value==repeatPassword.value){
                repeatPassword.setCustomValidity('');
            }

            else{
                repeatPassword.setCustomValidity('Ulangi dengan password yang sesuai');
            }
        }
    </script>
@endsection
