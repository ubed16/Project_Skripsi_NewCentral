@extends('layouts.admin_master')

@section('content')
    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                        <div class="card-header">
                            <h3 class="text-center font-weight-light my-4">Input Barang Masuk</h3>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('store.product') }}" enctype="multipart/form-data">
                                @csrf
                                {{-- <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputFirstName">Kode Barang</label>
                                        <input class="form-control py-4" name="code" type="text" placeholder="" />
                                    </div>
                                </div> --}}
                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="small mb-1" for="code">Kode Produk</label>
                                            <select id="code" name="code" class="form-control">
                                                <option selected>Masukan kode</option>

                                                @foreach ($item as $row)
                                                    {{-- @if ($row->quantity > 1) --}}
                                                    {{-- <option>{{ $row->product_code }}</option> --}}
                                                    <option value="{{ $row->id }}">{{ $row->product_code }}</option>
                                                    {{-- @endif --}}
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputFirstName">Ukuran Barang</label>
                                        <input class="form-control py-4" name="name" type="text" placeholder="" />
                                    </div>
                                </div> --}}
                                    <div class="col-md-6">
                                        <div class="form-group" id="ukuran">
                                            <label class="small mb-1" for="inputState">Ukuran Produk</label>
                                            <input class="form-control py-4" name="master_size" type="text" /
                                                value="" type="text"/ readonly>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="jenis">
                                            <label class="small mb-1" for="inputState">Jenis</label>
                                            <input class="form-control py-4" name="master_category" type="text" /
                                                value="" type="text"/ readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group" id="jumi">
                                            <label class="small mb-1" for="inputLastName">Jumlah</label>
                                            <input class="form-control py-4" name="Jumlah" id="jumlah" placeholder="" />

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group" id="hargai">
                                            <label class="small mb-1" for="inputState">Harga per box</label>
                                            <input class="form-control py-4" name="master_price" id="hargaPerBox"
                                                type="number" / value="" type="text"/ readonly>
                                        </div>
                                    </div>
                                    <div id="hasil"></div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputLastName">Tanggal</label>
                                            <input class="form-control py-4" name="tgl" type="date" placeholder="" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="total">
                                            <label class="small mb-1" for="inputState">Harga total</label>
                                            <input class="form-control py-4" name="sub_total" id="finalTotal" type="number"
                                                / value="" type="text"/ readonly="">
                                        </div>
                                    </div>

                                    <!-- <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="small mb-1" for="inputLastName">Gallery</label>
                                                        <input name="photo" type="file" />
                                                    </div>
                                                </div> -->
                                </div>

                                <div class="form-group mt-4 mb-0"><button class="btn btn-primary btn-block">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    {{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="http://code.jquery.com/jquery-latest.min.js" /></script> --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            // name();
            code();
            // sum();
            // $("#jumlah,#hargaPerBox").keyup(function() {

            //     // var total = 0;
            //     var x = Number($("#hargaPerBox").val());
            //     var y = Number($("#jumlah").val());

            //     // var total = x * y;

            //     $('#finalTotal').val(y);
            //     console.log(data);
            //     console.log(y);
            //     console.log(total);

            // });


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

                        // console.log(data);
                        // $("#email").html(
                        //     '<label class="small mb-1" for="inputFirstName">Email</label>'
                        //     );
                        // var x = '<input class="form-control py-4" name="email" value="' + data
                        //     .customer.email + '" type="text"/ readonly>';
                        // $("#email").append(x);

                        // $("#company").html(
                        //     '<label class="small mb-1" for="inputFirstName">Perusahaan</label>'
                        //     );
                        // var x = '<input class="form-control py-4" name="company" value="' + data
                        //     .customer.company + '" type="text"/ readonly>';
                        // $("#company").append(x);

                        // $("#phone").html(
                        //     '<label class="small mb-1" for="inputFirstName">No Hp</label>'
                        //     );
                        // var x = '<input class="form-control py-4" name="phone" value="' + data
                        //     .customer.phone + '" type="text"/ readonly>';
                        // $("#phone").append(x);

                        // $("#address").html(
                        //     '<label class="small mb-1" for="inputFirstName">Alamat</label>'
                        //     );
                        // var x = '<input class="form-control py-4" name="address" value="' + data
                        //     .customer.address + '" type="text"/ readonly>';
                        // $("#address").append(x);
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
                            '<input class="form-control py-4" name="master_size" type="text"  / value="' +
                            data.item.size + '" type="text"/ readonly >';
                        $("#ukuran").append(x);

                        $("#jenis").html(
                            '<label class="small mb-1" for="inputState">jenis</label>'
                        );
                        var x =
                            '<input class="form-control py-4" name="master_category" type="text"  / value="' +
                            data.item.type + '"type="text"/ readonly>';
                        $("#jenis").append(x);

                        $("#hargai").html(
                            '<label class="small mb-1" for="inputState">harga perbox</label>'
                        );
                        var x =
                            '<input class="form-control py-4" name="master_price" type="text"  / value="' +
                            data.item.price + '"id="hargaia" type="text"/ readonly>';
                        $("#hargai").append(x);

                        var harga = data.item.price;

                        $("#jumlah").keyup(function() {

                            // var total = 0;
                            var x = Number(harga);
                            var y = Number($("#jumlah").val());

                            var total = x * y;

                            $('#finalTotal').val(total);
                            // console.log(x);
                            // console.log(y);
                            // console.log(total);

                        });

                        // $("#total").html(
                        //     '<label class="small mb-1" for="inputState">harga total</label>'
                        // );
                        // var x =
                        //     '<input class="form-control py-4" name="harga" type="text"  / value="' +
                        //     data.product + '"type="text"/ readonly>';
                        // $("#total").append(x);

                        // $("#total").html(
                        //     '<label class="small mb-1" for="inputState">harga total</label>'
                        // );
                        // var x =
                        //     '<input class="form-control py-4" name="harga" type="text"  / value="' +
                        //     data.product.harga + '"type="text"/ readonly>';
                        // $("#total").append(x);

                        // //HARGA TOTAL//
                        // $("#total").html(
                        //     '<label class="small mb-1" for="inputState">Harga total</label>'
                        // );
                        // var x =
                        //     '<input class="form-control py-4" name="tampil" type="text"  / value="' +
                        //     data.product.harga + '"type="text"/ readonly>';

                        // $("#total").append(x);

                        // $("#company").html(
                        //     '<label class="small mb-1" for="inputFirstName">Customer company</label>'
                        //     );
                        // var x = '<input class="form-control py-4" name="company" value="' + data
                        //     .customer.company + '" type="text"/ readonly>';
                        // $("#company").append(x);

                        // $("#phone").html(
                        //     '<label class="small mb-1" for="inputFirstName">Customer Phone</label>'
                        //     );
                        // var x = '<input class="form-control py-4" name="phone" value="' + data
                        //     .customer.phone + '" type="text"/ readonly>';
                        // $("#phone").append(x);

                        // $("#address").html(
                        //     '<label class="small mb-1" for="inputFirstName">Customer Address</label>'
                        //     );
                        // var x = '<input class="form-control py-4" name="address" value="' + data
                        //     .customer.address + '" type="text"/ readonly>';
                        // $("#address").append(x);
                    }
                });
            });
        }
    </script>



    @include('sweetalert::alert')
@endsection
