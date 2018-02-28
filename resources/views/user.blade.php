@extends('base')
@section('title')
     User
@endsection
  <!-- Content -->
@section('content')
    <div class="page-header">
        <h3 style="display: block;">
            <span class="text-muted font-weight-light">Users
            </span>
            <a class="btn btn-primary pull-right" href="/user-editor">
                Add User
            </a>
        </h3>
    </div>

    <div class="panel">
        <div class="panel-heading">
            <div class="panel-title">Daftar Pengguna</div>
        </div>
        <div class="panel-body">
            <table class="table table-striped">
                <caption>Daftar Pengguna Aplikasi Penduduk</caption>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Level</th>
                        <th>Area</th>
                    </tr>
                </thead>
                <tbody id="dataContainer">
                    <tr><td></td><td>Loading Data..</td><td></td></tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('inlinejs')
    <script type="text/javascript">
        var users = db.collection('users');
        var dataContainer = $('#dataContainer');
        var counter = 1;

        users.get().then((querySnapshot)=>{
            dataContainer.html('');
            querySnapshot.forEach((doc)=>{
                if(doc && doc.exists){
                    var data = doc.data();
                    var area = '-';
                    if (data.level == 'subdistrict'){
                        area = data.area.subdistrict;
                    }
                    else if (data.level == 'district'){
                        area = data.area.district;
                    }
                    else if (data.level == 'city'){
                        area = data.area.city;
                    }
                    else if (data.level == 'province'){
                        area = data.area.province;
                    }
                    else if (data.level=='national'){
                        area = data.area.country;
                    }
                    dataContainer.append(
                        '<tr>'+
                            '<th  scope="row">'+counter+'</th>'+
                            '<td><a href="#">'+data.full_name+'</a></td>'+
                            '<td>'+data.email+'</td>'+
                            '<td>'+data.role+'</td>'+
                            '<td>'+data.level+'</td>'+
                            '<td>'+area+'</td>'+
                        '</tr>'
                    );
                }
                counter++;
            });
        });

        function init(){
            console.log('current User: '+currentUser.email);
            if(currentUser.role=='user'){
                $(location).attr('href','/');
            }
        }
    </script>
@endsection