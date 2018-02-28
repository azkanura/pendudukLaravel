@extends('base')
@section('title')
    Halaman Utama
@endsection
@section('inlinejstop')
  <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/holder/2.9.0/holder.js"></script>
  <script src="../demo/demo.js"></script>
@endsection
@section('inlinecss')
  <link href="css/widgets.min.css" rel="stylesheet" type="text/css">
@endsection
<!-- Content -->
@section('content')
<div class="page-header">
  <h1 style="display: block;">Statistik Penduduk<small id="area" style="line-height: 30px" class="pull-right"></small></h1>
</div>

<div class="page-wide-block">
  <div class="box m-a-0 border-radius-0" id="metrics">
    <div class="box-row valign-top">
      <div class="box-cell col-md-12 p-x-4 p-t-3 p-b-4">
        <div class="m-b-1 text-muted font-weight-semibold font-size-11">Agama</div>
        <div id="religionChart" style="min-height: 120px"></div>
      </div>
      <div class="box-cell col-md-12 p-x-4 p-t-3 p-b-4">
        <div class="m-b-1 text-muted font-weight-semibold font-size-11">Golongan Darah</div>
        <div id="bloodtypeChart" style="min-height: 120px"></div>
      </div>
      <div class="box-cell col-md-12 p-x-4 p-t-3 p-b-4">
        <div class="m-b-1 text-muted font-weight-semibold font-size-11">Pernikahan</div>
        <div id="marriageChart" style="min-height: 120px"></div>
      </div>
    </div>
    <div class="box-row valign-top">
      <div class="box-cell col-md-12 p-x-4 p-t-3 p-b-4">
        <div class="m-b-1 text-muted font-weight-semibold font-size-11">Jenis Kelamin</div>
        <div id="genderChart" style="min-height: 120px"></div>
      </div>
      <div class="box-cell col-md-12 p-x-4 p-t-3 p-b-4">
        <div class="m-b-1 text-muted font-weight-semibold font-size-11">Pekerjaan</div>
        <div id="jobChart" style="min-height: 120px"></div>
      </div>
      <div class="box-cell col-md-12 p-x-4 p-t-3 p-b-4">
        <div class="m-b-1 text-muted font-weight-semibold font-size-11">Jenjang Studi</div>
        <div id="studyChart" style="min-height: 120px"></div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('inlinejs')
<script type="text/javascript">
  
function init(){
  var chartColors = pxDemo.getRandomColors(12);

  var penduduk = db.collection('penduduk');

  var religionArray = [];
  var bloodtypeArray = [];
  var marriageArray = [];
  var genderArray = [];
  var jobArray = [];
  var studyArray = [];
  var clauseArray = [];

  console.log('current User: '+currentUser.email);
  var province = currentUser.area.province;
  var city = currentUser.area.city;
  var district = currentUser.area.district;
  var subdistrict = currentUser.area.subdistrict;
  switch(currentUser.level){
      case 'province':
          clauseArray.push({title:'provinsi',value:province});
          $('#area').html('Indonesia / '+province);
          break;
      case 'city':
          clauseArray.push({title:'provinsi',value:province});
          clauseArray.push({title:'kota',value:city});
          $('#area').html('Indonesia / '+province+' / '+city);
          break;
      case 'district':
          clauseArray.push({title:'provinsi',value:province});
          clauseArray.push({title:'kota',value:city});
          clauseArray.push({title:'kecamatan',value:district});
          $('#area').html('Indonesia / '+province+' / '+city+' / '+district);
          break;
      case 'subdistrict':
          clauseArray.push({title:'provinsi',value:province});
          clauseArray.push({title:'kota',value:city});
          clauseArray.push({title:'kecamatan',value:district});
          clauseArray.push({title:'kelurahan',value:subdistrict});
          $('#area').html('Indonesia / '+province+' / '+city+' / '+district+' / '+subdistrict);            
          break;
      default:
          $('#area').html('Indonesia');
  }

  generateData('religion',religionArray,'#religionChart',chartColors,clauseArray);
  generateData('bloodtype',bloodtypeArray,'#bloodtypeChart',chartColors,clauseArray);
  generateData('gender',genderArray, '#genderChart',chartColors,clauseArray);
  generateData('marriage',marriageArray,'#marriageChart',chartColors,clauseArray);
  generateData('gender',genderArray, '#genderChart',chartColors,clauseArray);
  generateData('job',jobArray, '#jobChart',chartColors,clauseArray);
  generateData('study',studyArray, '#studyChart',chartColors,clauseArray);
}

function getPropertyData(property,data){
  switch(property){
          case 'religion':
            return data.agama;
          case 'bloodtype':
            return data.golongan_darah;
          case 'marriage':
            return data.status_perkawinan;
          case 'gender':
            return data.jenis_kelamin;
          case 'job':
            return data.bidang_pekerjaan;
          case 'study':
            return data.pendidikan;
  }
}

function generateData(property,dataArray,objectId,chartColors,clauseArray){
   whereClause(penduduk,clauseArray).get().then((querySnapshot)=>{
    querySnapshot.forEach((doc)=>{
      if(doc && doc.exists){
        var id = doc.id;
        var data = getPropertyData(property,doc.data());
        console.log(property+': '+data);
        var exist = dataExists(data,dataArray);
        if(!exist){
          addData(data, dataArray);
        }
        var members = penduduk.doc(id).collection('anggota');
        // if(members){
          members.get().then((query)=>{
            query.forEach((member)=>{
              var memberData = getPropertyData(property,member.data());
              console.log(property+': '+memberData);
              var memberExist = dataExists(memberData,dataArray);
              if(!memberExist){
                addData(memberData, dataArray);
              }
            });
          });        
        // }
      }
    });

    var chartData = {
      columns : dataArray,
      type : 'pie'
    };
    setTimeout(function(){
      c3.generate({
        size:{
          height: 400
        },
        bindto : objectId,
        color: { pattern: chartColors },
        data: chartData,
        legend: { position: 'bottom' }
      });
    },2000);

  });
}

function whereClause(doc,array){
    if(array.length){
        array.forEach((data)=>{
            doc = doc.where(data.title,'==',data.value);
        });
    }
    return doc;
}

function dataExists(str, dataArray){
  var exist = false;
  dataArray.forEach((data)=>{
      if(str.toLowerCase()==data[0].toLowerCase()){
          data[1]=data[1]+1;
          exist = true;
          return exist;
      }
  });
  return exist;
}

function addData( str, dataArray){
  dataArray.push([str,1]);
} 

</script>
@endsection