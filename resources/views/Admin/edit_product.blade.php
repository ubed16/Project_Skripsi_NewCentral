@extends('layouts.admin_master')

@section('content')

<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Update Barang</h3></div>
                    <div class="card-body">
                        <form method="POST" action="{{route('all_product.update',$product->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputFirstName">Ukuran Barang</label>
                                        <input class="form-control py-4" name="name" type="text" placeholder="" / value="{{old('name') ?? $product->name}} ">
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputFirstName">Jumlah</label>
                                        <input class="form-control py-4" name="jumlah" type="text" placeholder="" / value="{{old('jumlah') ?? $product->stock}} ">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputLastName">Jenis</label>
                                        <input class="form-control py-4" name="Jenis" type="text" placeholder="" / value="{{old('jenis') ?? $product->category}} ">
                                    </div>
                                </div>

                            </div>

                            {{-- <button data-toggle="modal" data-target="{{$product->id }}" class="btn btn-sm btn-primary">Submit</button> --}}
                            <button data-toggle="modal"  class="btn btn-sm btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@include('sweetalert::alert')
@endsection
