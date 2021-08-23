@extends('backend.layouts.app')

@section('title')
    SubCategories
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
@endsection

@section('backend-content')

<div class="container mt-3">
    <div class="card">
        <div class="card-header">

            <h3 class="card-title">SubCategories</h3>

            <div class="container">
                <a href="{{ route('admin.subcategory.create') }}" class="btn btn-outline-success btn-sm float-right">
                   <i class="fas fa-plus-circle fa-w-20"></i><span> ADD</span>
                </a>
            </div>
        </div>

        <div class="card-body">
    <table id="subcategoriesTable" class="display" style="width:100%">
        <thead>
            <tr>
                <th>SL NO</th>    
                <th>SubCategory</th>          
                <th>SubCategory Image</th>        
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($subcategories as $subcat)

           <tr>
               <td>{{ $loop->index + 1 }}</td>
               <td>{{ $subcat->category->category_name }} --> {{ $subcat->subcat }}</td>
               <td>
                   @if($subcat->image != null)
                        <img src="{{  asset('frontend/images/SubCategoryImage/' .$subcat->image) }}" style="width: 100px;" class="img-fluid" alt="{{ $subcat->name }}" >
                    @else
                        —
                    @endif
               </td>
               <td>
                    <a href="{{ route('admin.subcategory.edit', $subcat->id) }}" class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-edit"></i></a>

                    <form action="{{ route('admin.subcategory.destroy', $subcat->id) }}" id="delete_form" method="POST">
                        @csrf

                        @method('DELETE')

                        <button type="submit" id="delete_subcategories" class="btn btn-outline-danger btn-sm mt-2"><i class="fas fa-trash"></i></button>
                    </form>

               </td>
           </tr>

           @endforeach

        </tbody>
        <tfoot>
            <tr>
                <th>SL NO</th>    
                <th>SubCategory</th>    
                <th>SubCategory Image</th>     
                <th>Action</th>
            </tr>
        </tfoot>
    </table>

        </div>
    </div>
</div>
   
@endsection

@section('js')
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> --}}
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>

    <script>

        // Datatable 

        $(document).ready(function() {
            $('#subcategoriesTable').DataTable();
        });

        // Delete function

            $(document).on('click', '#delete_subcategories', function (event) {
            event.preventDefault();
            var url = $(this).attr('href');
            $('#delete_form').attr('action', url);
            swal.fire({
                title: 'Are you sure?',
                text: 'This record and it`s details will be permanantly deleted!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then(function(result) {
                if (result.isConfirmed) {
                    $('#delete_form').submit();
                }else{
                    swal.fire('Your File is Safe!');
                }
            });
        });

    </script>

@endsection