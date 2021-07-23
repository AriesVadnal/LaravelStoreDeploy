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
                  Create New Product
                </p>
              </div>
              <div class="dashboard-content">
                <div class="row">
                  <div class="col-md-12">
                  @if($errors->any())
                   <div class="alert alert-danger">
                     <ul>
                       @foreach($errors->all() as $error)
                         <li>{{ $error }}</li>
                       @endforeach
                     </ul>
                   </div>
                  @endif
                    <div class="card">
                      <div class="card-body">
                       <form action="{{ route('product.store')}}" method="POST" enctype="multipart/form-data">
                         @csrf 
                         <div class="row">

                           <div class="col-md-12">
                             <div class="form-group">
                               <label for="">Product Name</label>
                               <input type="text" name="name" class="form-control" required>
                             </div>
                           </div>

                           <div class="col-md-12">
                             <div class="form-group">
                               <label for="">Pemilik Product</label>
                               <select name="users_id" id="" class="form-control">
                                 @foreach ( $users as $user )
                                   <option value="{{ $user->id }}">{{ $user->name }}</option>
                                 @endforeach
                               </select>
                             </div>
                           </div>

                           <div class="col-md-12">
                             <div class="form-group">
                               <label for="">Category Product</label>
                               <select name="categories_id" id="" class="form-control">
                                 @foreach ( $categories as $category )
                                   <option value="{{ $category->id }}">{{ $category->name }}</option>
                                 @endforeach
                               </select>
                             </div>
                           </div>

                           <div class="col-md-12">
                             <div class="form-group">
                               <label for="">Harga Product</label>
                               <input type="number" name="price" class="form-control" required>
                             </div>
                           </div>

                           <div class="col-md-12">
                             <div class="form-group">
                               <label for="">Description Product</label>
                               <textarea name="description" id="editor" cols="30" rows="10"></textarea>
                             </div>
                           </div>

                         </div>
                         <div class="row">
                           <div class="col text-right">
                             <button class="btn btn-success px-5" type="submit">
                               Save Now
                             </button>
                           </div>
                         </div>
                       </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
@endsection

@push('addon_script')
  <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
  <script>
    CKEDITOR.replace( 'editor' );
  </script>
@endpush