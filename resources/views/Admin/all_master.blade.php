@extends('layouts.admin_master')
@section('content')
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table mr-1"></i>
        Data Master Barang
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        {{-- <th>No</th> --}}
                        <th>Kode Barang</th>
                        <th>Ukuran Barang</th>
                        <th>Jenis</th>
                        <th>Harga per box</th>

                    </tr>
                </thead>
                <tbody>
                	@foreach($master as $row)
                    <tr>
                        {{-- <td>{{ $row->id }}</td> --}}
                        <td>{{ $row->master_code }}</td>
                        <td>{{ $row->master_size }}</td>
                        <td>{{ $row->master_category }}</td>
                        <td>{{ $row->master_price }}</td>

                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('script')
<link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />

<script>



   $('#dataTable').DataTable({
    columnDefs: [
    {bSortable: false, targets: [6]}
  ],
                dom: 'lBfrtip',
           buttons: [
               {
                   extend: 'excelHtml5',
                   exportOptions: {
                    modifier: {
                        page: 'current'
                    },
                    columns: [ 0,1,2,3,4,5 ]
                   }
               },
               {
                   extend: 'pdfHtml5',
                   exportOptions: {
                    modifier: {
                        page: 'current'
                    },
                    columns: [ 0,1,2,3,4,5 ]
                   }
               },
           ]
           });
       </script>
@include('sweetalert::alert')
@endsection
