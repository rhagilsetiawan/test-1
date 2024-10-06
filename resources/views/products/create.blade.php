@extends('layouts.dashboard-volt')
@section('styles')
@endsection

@section('content')
    @php
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 flex justify-center">
                <a href="{{ route('products.index') }}" class="btn btn-secondary btn-sm mb-2">&larr; Back</a>
            </div>
            <div class="col-md-6 mb-2">
                <div class="alert alert-success d-none" id="berhasil" role="alert">
                    Berhasil di scan 🤩 <span class="badge badge-lg bg-success" id="code"></span>
                </div>
                <div id="reader" class="mb-2"></div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div class="form-row mb-2">
                                    <label for="new_code" class="mb-1">Code</label>
                                    <input type="text" name="code" id="new_code"
                                        class="form-control @error('code') is-invalid @enderror" placeholder="digit di barcode..."
                                        value="{{ old('code') }}">
                                    @error('code')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-row mb-2">
                                    <label for="" class="mb-1">Product Name</label>
                                    <input type="text" name="name"
                                        class="form-control @error('name') is-invalid @enderror"
                                        placeholder="Product name here..." value="{{ old('name') }}">
                                    @error('name')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group float-right mt-4">
                                <button type="submit" class="btn btn-primary bg-black">Add Product</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    {{-- API search qr-code --}}
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

    <script>
        var productID = document.getElementById('new_code');
        var berhasil = document.getElementById('berhasil');
        var code = document.getElementById('code');
        let reader = document.getElementById('reader');

        console.log("product id: ", productID);
        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", {
                fps: 10,
                qrbox: {
                    width: 250,
                    height: 150
                }
            },
            /* verbose= */
            false);
        html5QrcodeScanner.render((decodedText, decodedResult) => {
            productID.value = decodedText;
            berhasil.classList.remove('d-none');
            code.innerText = decodedText;
            reader.classList.add('d-none');
        }, (error) => {
            console.warn(`Code scan error = ${error}`);
        });
    </script>
@endpush
