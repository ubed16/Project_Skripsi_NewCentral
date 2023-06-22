@extends('layouts.admin_master')
@section('content')
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table mr-1"></i>
        Stok Barang Gudang
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
                        <th>Quantity</th>
                        {{-- <th>Customer</th> --}}
                        {{-- <th>Aksi</th> --}}

                    </tr>
                </thead>
                <tbody>

                    @foreach($item as $row)
                    <tr>
                        <td>{{ $row->id }}</td>
                        <td>{{ $row->product_code }}</td>
                        <td>{{ $row->size }}</td>
                        <td>{{ $row->type }}</td>
                        <td>{{ $row->quantity }}</td>
                        {{-- <td>{{ $row->customer }}</td> --}}



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
     {bSortable: false, targets: [5]}
   ],
                 dom: 'lBfrtip',
            buttons: [

                {
                    extend: 'excelHtml5',
                    exportOptions: {
                     modifier: {
                         page: 'current'
                     },
                     columns: [ 0, ':visible' ]
                    }
                },
                {
                    extend: 'pdfHtml5',
                    exportOptions: {
                     modifier: {
                         page: 'current'
                     },
                        columns: [ 0, 1, 2, 5 ]
                    }
                }

            ],

            });
        </script>
@endsection
