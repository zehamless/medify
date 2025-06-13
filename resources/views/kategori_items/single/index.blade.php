@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="form-group mb-2">
                    <a href="{{url('master-items')}}" class="btn btn-secondary">Kembali ke Daftar Item</a>
                </div>
                <div class="card">
                    <div class="card-header">Master Item</div>

                    <div class="card-body">
                        <table>
                            <tr>
                                <th>Nama</th>
                                <td>:</td>
                                <td>{{$data->nama}}</td>
                            </tr>

                            <tr>
                                <th colspan="3" class="pt-3">Daftar Item:</th>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <table class="table mt-2">
                                        <thead>
                                        <tr>
                                            <th>Kode</th>
                                            <th>Nama Item</th>
                                            <th>Jenis</th>
                                            <th>Supplier</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($data->masterItems as $item)
                                            <tr>
                                                <td>{{$item->kode}}</td>
                                                <td>{{$item->nama}}</td>
                                                <td>{{$item->jenis}}</td>
                                                <td>{{$item->supplier}}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">Tidak ada item</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </td>
                            </tr>

                        </table>
                        <a class="btn btn-info"
                           href="{{route('kategori.form', ['method' => 'edit', 'id' => $data->id])}}">Edit</a>
                        <a class="btn btn-danger" href="{{route('kategori.delete', ['id'=> $data->id])}}"
                           onclick="return confirm('Are you sure you want to delete this item?');">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
@endsection