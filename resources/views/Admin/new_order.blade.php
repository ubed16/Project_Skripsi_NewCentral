@extends('layouts.admin_master')

@section('content')
    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                        <div class="card-header">
                            <h3 class="text-center font-weight-light my-4">Input Barang Keluar</h3>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('store.order') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputFirstName">Customer</label>
                                            <select id="name" name="id_customer" class="form-control">
                                                <option selected>Pilih Customer</option>
                                                @foreach ($customers as $c)
                                                    <option value="{{ $c->id }}">{{ $c->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group" id="email">
                                            <label class="small mb-1" for="inputFirstName">Email</label>
                                            <input class="form-control py-4" name="email" type="text" readonly/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="company">
                                            <label class="small mb-1" for="inputLastName">Perusahaan</label>
                                            <input class="form-control py-4" name="company" type="text"  readonly/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="address">
                                            <label class="small mb-1" for="inputState">Alamat</label>
                                            <input class="form-control py-4" name="address" type="text" readonly/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="phone">
                                            <label class="small mb-1" for="inputState">No.Hp</label>
                                            <input class="form-control py-4" name="phone" type="text" readonly/>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="small mb-1" for="code">Kode Produk</label>
                                            <select id="code" name="code" class="form-control">
                                                <option selected>Masukan kode</option>
                                                @foreach ($items as $row)
                                                    <option value="{{ $row->id }}">{{ $row->product_code }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="ukuran">
                                            <label class="small mb-1" for="inputState">ukuran Produk</label>
                                            <input class="form-control py-4" name="size" type="text" / value=""
                                                type="text"/ readonly>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="jenis">
                                            <label class="small mb-1" for="inputLastName">Jenis</label>
                                            <input class="form-control py-4" name="item_type" type="text" / value=""
                                                type="text"/ readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputLastName">Quantity</label>
                                            <input class="form-control py-4" name="quantity" id="qty" type="text">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="price">
                                            <label class="small mb-1" for="inputLastName">Harga per box</label>
                                            <input class="form-control py-4" name="harga_item" type="text" / value=""
                                                type="text"/ readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputLastName">Tanggal</label>
                                            <input class="form-control py-4" name="tgl" type="date"
                                                placeholder="" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputLastName">Total Harga</label>
                                            <input class="form-control py-4" name="harga" id="total_price" type="text" /
                                                value="" type="text"/ readonly>
                                        </div>
                                    </div>

                                </div>

                                <div class="form-group mt-4 mb-0"><button
                                        class="btn btn-primary btn-block">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.js"></script>
    <script>
        $(document).ready(function() {
            name();
            code();
        });

        function name() {
            $("#name").change(function() {
                var c_name = $("#name").val();
                console.log(c_name);
                $.ajax({
                    type: 'POST',
                    url: "http://127.0.0.1:8000/api/get-customer",
                    dataType: 'json',
                    data: {
                        "id": c_name
                    },
                    success: function(data) {


                        console.log(data);
                        $("#email").html(
                            '<label class="small mb-1" for="inputFirstName">Email</label>'
                        );
                        var x = '<input class="form-control py-4" name="email" value="' + data
                            .customer.email + '" type="text"/ readonly>';
                        $("#email").append(x);

                        $("#company").html(
                            '<label class="small mb-1" for="inputFirstName">Perusahaan</label>'
                        );
                        var x = '<input class="form-control py-4" name="company" value="' + data
                            .customer.company + '" type="text"/ readonly>';
                        $("#company").append(x);

                        $("#phone").html(
                            '<label class="small mb-1" for="inputFirstName">No Hp</label>'
                        );
                        var x = '<input class="form-control py-4" name="phone" value="' + data
                            .customer.phone + '" type="text"/ readonly>';
                        $("#phone").append(x);

                        $("#address").html(
                            '<label class="small mb-1" for="inputFirstName">Alamat</label>'
                        );
                        var x = '<input class="form-control py-4" name="address" value="' + data
                            .customer.address + '" type="text"/ readonly>';
                        $("#address").append(x);
                    }
                });
            });
        }

        function code() {
            $("#code").change(function() {
                var k_code = $("#code").val();
                console.log(k_code);
                $.ajax({
                    type: 'POST',
                    url: "http://127.0.0.1:8000/api/get-item",
                    dataType: 'json',
                    data: {
                        "id": k_code
                    },
                    success: function(data) {
                        console.log(data);
                        $("#ukuran").html(
                            '<label class="small mb-1" for="inputState">ukuran Produk</label>'
                        );
                        var x =
                            '<input class="form-control py-4" name="size" type="text"  value="' +
                            data.item.size + '" type="text"/ readonly >';
                        $("#ukuran").append(x);

                        $("#jenis").html(
                            '<label class="small mb-1" for="inputLastName">Jenis</label>'
                        );
                        var x = '<input class="form-control py-4" name="item_type" value="' + data.item.type + '" type="text"/ readonly>';
                        $("#jenis").append(x);

                        $("#price").html(
                            '<label class="small mb-1" for="inputLastName">Harga per box</label>'
                        );
                        var x = '<input class="form-control py-4" name="item_price" value="' + data
                            .item.price + '" type="text"/ readonly>';
                        $("#price").append(x);

                        var harga = data.item.price;

                        $("#qty").keyup(function() {

                            // var total = 0;
                            var x = Number(harga);
                            var y = Number($("#qty").val());

                            var total = x * y;

                            $('#total_price').val(total);
                            // console.log(x);
                            // console.log(y);
                            // console.log(total);

                        });
                    }
                });
            });
        }
    </script>
    @include('sweetalert::alert')
@endsection
