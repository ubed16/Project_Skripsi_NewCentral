@extends('layouts.admin_master')
@section('content')
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table mr-1"></i>
        Stok Barang Keluar
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Barang</th>
                        <th>ukuran Barang</th>
                        <th>Jenis</th>
                        <th>Jumlah</th>
                        <th>Harga per box</th>
                        <th>Total Harga</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                        {{-- <th>Customer</th>
                        <th>Email</th>--}}

                    </tr>
                </thead>
                <tbody>

                    @foreach($orders as $row)
                    <tr>
                        <td>{{ $row->id }}</td>
                        <td>{{ $row->product_code }}</td>
                        <td>{{ $row->product_name }}</td>
                        <td>{{ $row->customer_name }}</td>
                        <td>{{ $row->email }}</td>
                        <td>{{ $row->quantity }}</td>



                        {{-- <td>
                            @if($row->order_status=='0')
                                <a href="{{ 'add-invoice/'.$row->id }}" class="btn btn-sm btn-info">create Invoice</a>
                            @else
                                <a href="#" class="btn btn-sm btn-info">Invoiced</a>
                            @endif

                        </td> --}}
                    </tr>
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
@endsection
