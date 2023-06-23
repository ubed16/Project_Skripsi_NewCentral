@extends('layouts.admin_master')

@section('content')
    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="card shadow-lg border-0 rounded-lg mt-5">
                        <div class="card-header">
                            <h3 class="text-center font-weight-light my-4">Update Barang</h3>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('update.product', $product->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="form-row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="small mb-1" for="code">Kode Produk</label>
                                            <select id="code" name="code" class="form-control">

                                                @foreach ($item as $row)
                                                    <option value="{{ $row->id }}" {{$row->product_code == $product->product_code ? 'selected' : ''}}>{{ $row->product_code }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="ukuran">
                                            <label class="small mb-1" for="inputState">Ukuran Produk</label>
                                            <input class="form-control py-4" name="master_size" type="text" /
                                                value="{{ old('name') ?? $product->size }}" type="text"/ readonly>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="jenis">
                                            <label class="small mb-1" for="inputState">Jenis</label>
                                            <input class="form-control py-4" name="master_category" type="text" /
                                                value="{{ old('master_category') ?? $product->category }}" type="text"/
                                                readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group" id="jumi">
                                            <label class="small mb-1" for="inputLastName">Jumlah</label>
                                            <input class="form-control py-4" name="Jumlah" id="jumlah" placeholder=""
                                                value="{{ old('Jumlah') ?? $product->stock }}" />

                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group" id="hargai">
                                            <label class="small mb-1" for="inputState">Harga per box</label>
                                            <input class="form-control py-4" name="master_price" id="hargaPerBox"
                                                type="number" /
                                                value="{{ old('master_price') ?? $product->harga / $product->stock }}"
                                                type="text"/ readonly>
                                        </div>
                                    </div>
                                    <div id="hasil"></div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="small mb-1" for="inputLastName">Tanggal</label>
                                            <input class="form-control py-4" name="tgl" type="date" placeholder=""
                                                value="{{ old('tgl') ?? $product->tgl }}" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" id="total">
                                            <label class="small mb-1" for="inputState">Harga total</label>
                                            <input class="form-control py-4" name="sub_total" id="finalTotal" type="number"
                                                / value="{{ old('harga') ?? $product->harga }}" type="text"/
                                                readonly="">
                                        </div>
                                    </div>

                                    {{-- <button data-toggle="modal" data-target="{{$product->id }}" class="btn btn-sm btn-primary">Submit</button> --}}
                                    <button data-toggle="modal" class="btn btn-sm btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            code();
        });

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

                        var totalPrice = $('#jumlah').val() != null ? data.item.price * $('#jumlah').val() : data.item.price;
                        $('#finalTotal').val(totalPrice);
                        $("#jumlah").keyup(function() {
                            var x = Number(harga);
                            var y = Number($("#jumlah").val());

                            var total = x * y;

                            $('#finalTotal').val(total);

                        });
                    }
                });
            });
        }
    </script>
        @include('sweetalert::alert')
    @endsection
