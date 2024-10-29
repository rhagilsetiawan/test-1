@extends('layouts.dashboard-volt')

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css">

    <!-- Tambahkan CSS Responsif DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div>Daftar Produk</div>
                        <a href="{{ route('products.create') }}" class="btn btn-primary btn-sm float-right"><i
                                class="fa-solid fa-plus"></i> Tambah Produk</a>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif
                        <table class="table table-hovered" id="tableProducts">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Code</th>
                                    <th>Nama</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form action="" method="post" id="deleteForm">
        @csrf
        @method('DELETE')
        <input type="submit" value="Hapus" style="display:none">
    </form>
@endsection

@push('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

    <!-- Tambahkan JavaScript Responsif DataTables -->
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script>
        function getWindowWidth() {
            return window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
        }

        if (getWindowWidth() < 768) {
        // if (true) {
            $(function() {
                $('#tableProducts').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('data.product-small') }}',
                    responsive: {
                        details: {
                            renderer: function(api, rowIdx, columns) {
                                var data = $.map(columns, function(col, i) {
                                    return col.hidden ?
                                        '<tr data-dt-row="' +
                                        col.rowIndex +
                                        '" data-dt-column="' +
                                        col.columnIndex +
                                        '">' +
                                        '<td>' +
                                        col.title +
                                        ':' +
                                        '</td> ' +
                                        '<td>' +
                                        col.data +
                                        '</td>' +
                                        '</tr>' :
                                        '';
                                }).join('');

                                return data ? $('<table/>').append(data) : false;
                            }
                        }
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            orderable: false,
                            searchable: true
                        }, {
                            data: 'code'
                        }, {
                            data: 'name'
                        },
                        {
                            data: 'action'
                        }
                    ]
                })
            })
        } else {
            $(function() {
                $('#tableProducts').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('data.product-big') }}',
                    responsive: {
                        details: {
                            renderer: function(api, rowIdx, columns) {
                                var data = $.map(columns, function(col, i) {
                                    return col.hidden ?
                                        '<tr data-dt-row="' +
                                        col.rowIndex +
                                        '" data-dt-column="' +
                                        col.columnIndex +
                                        '">' +
                                        '<td>' +
                                        col.title +
                                        ':' +
                                        '</td> ' +
                                        '<td>' +
                                        col.data +
                                        '</td>' +
                                        '</tr>' :
                                        '';
                                }).join('');

                                return data ? $('<table/>').append(data) : false;
                            }
                        }
                    },
                    columns: [{
                            data: 'DT_RowIndex',
                            orderable: false,
                            searchable: true
                        }, {
                            data: 'code'
                        }, {
                            data: 'name'
                        },
                        {
                            data: 'action'
                        }
                    ]
                })
            })
        }
    </script>
@endpush
