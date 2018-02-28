    @extends('base')
    @section('content')
        <div class="page-header">
            <h3>Cari</h3>
        </div>

        <form class="panel">
            <div class="panel-heading">Filter</div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">Provinsi</label>
                            <select class="form-control">
                                <option selected>Pilih Semua</option>
                                <option>Aceh</option>
                                <option>Jakarta</option>
                            </select>
                            <p class="helper-text">Pilih salah satu</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">RT</label>
                            <input type="text" class="form-control" placeholder="001" />
                            <p class="helper-text">Kosongkan untuk pilih semua</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="control-label">RW</label>
                            <input type="text" class="form-control" placeholder="001" />
                            <p class="helper-text">Kosongkan untuk pilih semua</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="control-label" >Cari Nama</label>
                            <input type="text" class="form-control" placeholder="ex : sutinah" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <button type="submit" class="btn btn-primary">Cari</button>
            </div>
        </form>
        <div class="panel">
            <div class="panel-heading">Hasil Cari</div>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama</th>
                    </tr>
                </thead>
            </table>
        </div>
    @endsection
