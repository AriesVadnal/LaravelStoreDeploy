@extends('layouts.admin')

@section('title')
   Product
@endsection

@section('content')
<div
            class="section-content section-dashboard-home"
            data-aos="fade-up"
          >
            <div class="container-fluid">
              <div class="dashboard-heading">
                <h2 class="dashboard-title">Product</h2>
                <p class="dashboard-subtitle">
                  List of Product
                </p>
              </div>
              <div class="dashboard-content">
                <div class="row">
                  <div class="col-md-12">
                    <div class="card">
                      <div class="card-body">
                        <a href="{{ route('product.create')}}" class="btn btn-primary mb-3">
                         + Tambah Product Baru
                        </a>
                        <div class="table-responsive">
                         <table class="table table-hover scroll-horizontal-vertical w-100">
                          <thead>
                           <tr>
                            <th>ID</th>
                            <th>Nama</th>
                            <th>Pemilik</th>
                            <th>Kategory</th>
                            <th>Harga</th>
                            <th>Aksi</th>a
                           </tr>
                          </thead>
                          <tbody>
                          @foreach ( $items as $item )
                            <tr>
                              <td>{{ $item->id }}</td>
                              <td>{{ $item->name }}</td>
                              <td>{{ $item->user->name }}</td>
                              <td>{{ $item->category->name }}</td>
                              <td>{{ $item->price }}</td>
                              <td>
                                <a href="{{ route('product.edit', $item->id ) }} " class="btn btn-warning text-white btn-sm mb-1">
                                Sunting
                                </a>
                                <form action="{{route('product.destroy', $item->id )}}" method="POST">
                                @method('DELETE')
                                @csrf 
                                <button class="btn btn-danger text-white btn-sm" type="submit">
                                    Hapus
                                </button>
                                </form>
                              </td>
                            </tr>
                          @endforeach
                          </tbody>
                         </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
@endsection

@push('addon_style')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
@endpush

@push('addon_script')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
 <script>
    $(document).ready(function(){
      $('#table_id').DataTable();
    });
 </script>
@endpush
