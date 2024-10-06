@extends('layouts.dashboard-volt')
@section('styles')
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" />
    <style>
        #mapid {
            height: 60vmin;
        }
    </style>
@endsection

@section('content')
    @php
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            @if (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{ session('error') }}
                </div>
            @endif
            <div class="col-12 d-flex justify-content-center">
                <a href="{{ route('transactions.index') }}" class="btn btn-secondary btn-sm mb-2">&larr; Back</a>
            </div>
            {{-- <div class="col-md-6 mb-2">
                <div class="card">
                    <div id="mapid"></div>
                </div>
            </div> --}}
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('transactions.store') }}" method="post" enctype="multipart/form-data"
                            class="form-group">
                            @csrf
                            <div class="form-row mb-2">
                                <label class="my-1" for="product">Select Product</label>
                                <select class="form-select @error('prod_id') is-invalid @enderror" name="prod_id"
                                    id="product">
                                    <option selected>Open this select menu</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->id }}">{{ $product->code }} | {{ $product->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('prod_id')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-row">
                                <label for="">Select Shop</label>
                                <select class="form-select @error('shop_id') is-invalid @enderror" name="shop_id"
                                    id="shop">
                                    <option selected>Open this select menu</option>
                                    @foreach ($shops as $shop)
                                        <option value="{{ $shop->id }}">{{ $shop->name }} | {{ $shop->address }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('shop_id')
                                    <span class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-row">
                                <label for="showNumber">Price</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="fa-solid fa-rupiah-sign"></i>
                                    </span>
                                    <input type="text" class="form-control @error('price') is-invalid @enderror"
                                        id="showNumber" placeholder="Input Price Here 💸">
                                    <input type="number" name="price" id="realPrice" hidden>
                                    @error('price')
                                        <span class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group float-right mt-4">
                                <button type="submit" class="btn btn-primary bg-black">Make Transaction</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.6.0/cleave.min.js"></script>

    <script>
        // menandai input angka ribuah
        window.cleave = new Cleave('#showNumber', {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand'
        });

        document.getElementById('showNumber').addEventListener('input', function() {
            var rawValue = cleave.getRawValue();

            // Check if rawValue is a number or can be converted to a valid number
            if (!isNaN(rawValue) && rawValue.trim() !== '') {
                // Convert the rawValue to a number and assign it to the realPrice field
                let number = Number(rawValue);
                // console.log(number);
                document.getElementById('realPrice').value = number;
            } else {
                // Handle the case when it's not a valid number (optional)
                document.getElementById('realPrice').value = '';
                console.log('Invalid number input');
            }
        })
    </script>
@endpush
