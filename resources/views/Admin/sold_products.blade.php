@extends('layouts.admin_master')
@section('content')
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table mr-1"></i>
        Pemakaian Barang
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Ukuran Barang</th>
                        <th>Jumlah di pakai</th>
                    </tr>
                </thead>
                
                <tbody>
                	@foreach($products as $row)
                    <tr>
                        <td>{{ $row->product_name }}</td>
                        <td>{{ $row->count }}</td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection