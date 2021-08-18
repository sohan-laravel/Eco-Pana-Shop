@extends('backend.layouts.app')

@section('title')
    SubCategories
@endsection

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">
@endsection

@section('backend-content')

<div class="container mt-3">
    <div class="card">
        <div class="card-header">

            <h3 class="card-title">SubCategories</h3>

            {{-- href="{{ route('admin.category.create') }}" --}}

            <div class="container">
                 <button class="btn btn-outline-success btn-sm float-right" data-toggle="modal" data-target="#addModal">
                <i class="fas fa-plus-circle fa-w-20"></i><span> ADD</span>
            </button>
            </div>
        </div>

        <div class="card-body">
    <table id="subcategoryTable" class="display" style="width:100%">
        <thead>
            <tr>
                <th>SL NO</th>
                <th>Category Name</th>  
                <th>SubCategory Name</th>  
                <th>Image</th>  
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

           {{-- <tr>
               <td></td>
               <td></td>
               <td></td>
           </tr> --}}

        </tbody>
        <tfoot>
            <tr>
                <th>SL NO</th>
                <th>Category Name</th>  
                <th>SubCategory Name</th>  
                <th>Image</th>  
                <th>Action</th>
            </tr>
        </tfoot>
    </table>

        <form action="" method="post" id="delete_form">
          @method('DELETE')
          @csrf
        </form>

        </div>
    </div>
</div>

<!-- Add Category Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="categoryAddLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title" id="categoryAddLabel">Add SubCategory</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form action="{{ route('admin.subcategory.store') }}" method="post" id="addSubCategoryForm">

                @csrf

                <div class="form-group">
                    <label for="category_name">Category Name</label>
                    <select class="form-control" name="category_id" id="category_id">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="category_name">SubCategory Name</label>
                    <input type="text" class="form-control" name="subcategory_name" id="subcategory_name" placeholder="Enter SubCategory Name">
                </div>

                <div class="form-group">
                    <label for="category_name">SubCategory Image</label>
                    <input type="file" class="dropify" name="image" id="image" 
                    data-max-file-size="2M" data-allowed-file-extensions="jpg png jpeg" />
                </div>

                <button type="submit" class="btn btn-outline-primary btn-sm float-right submit_button"><span class="loading d-none">....</span>Submit</button>
            </form>
      </div>
    </div>
  </div>
</div>

<!-- Edit Category Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="categoryEditLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title" id="categoryEditLabel">Edit Category</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="edit_part">
        
      </div>
    </div>
  </div>
</div>
   
@endsection


@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>

    <script>
    $(document).ready(function(){
        $('.dropify').dropify();

    //     messages: {
    //     'default': 'Drag and drop a file here or click',
    //     'replace': 'Drag and drop or click to replace',
    //     'remove':  'Remove',
    //     'error':   'Ooops, something wrong happended.'
    // }

    });
    </script>
    
    <script>
       
        $(function category(){
        table =$('#subcategoryTable').DataTable({
        processing:true,
        serverSide:true,
        search:true,
        ajax:"{{ route('admin.subcategory.index') }}",
        columns:[
            { data:'DT_RowIndex', name:'DT_RowIndex'},
            { data:'category_name', name:'category_name'},
            { data:'subcategory_name', name:'subcategory_name'},
            { data:'image', name:'image'},
            { data:'action', name:'action'},
        ]
    });

}); 


    // Add Category

       $('#addSubCategoryForm').submit(function(e){
        e.preventDefault();
        $('.loading').removeClass('d-none');
        var url = $(this).attr('action');
        var request = $(this).serialize();
        $('.submit_button').prop('type', 'button');

         $.ajax({
             url:url,
             type:'post',
             data:new FormData(this),
             contentType:false,
             cache:false,
             processData:false,
             success:function(data){
                 toastr.success(data);
                 $('#addSubCategoryForm')[0].reset();
                 $('.loading').hide();
                 $('.submit_button').prop('type', 'submit');
                 //$('#addModal').modal('hide');
                 $('#addModal').hide();
                 $(".modal-backdrop").remove();
                 $('#subcategoryTable').DataTable().ajax.reload();
             }
         });

    });


    // Edit Category

       $('body').on('click', '.edit', function () {
         var id = $(this).data('id');
         var url = "{{ url('admin/subcategory/edit') }}/"+id;

         $.ajax({
             url:url,
             type:'get',
             success:function(data){
                $('#edit_part').html(data);
             }
         });
    });

    // Delete Category

    $(document).ready(function(){

      $(document).on('click', '#delete_subcategory', function (event) {
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

  // Data Passed Through Here
    $('#delete_form').submit(function(e){
         e.preventDefault();
         var url = $(this).attr('action');
         var request = $(this).serialize();

         $.ajax({
             url:url,
             type:'post',
             async:false,
             data:request,
             success:function(data){
                 toastr.success(data);
                 $('#delete_form')[0].reset();
                 $('#addModal').hide();
                 $(".modal-backdrop").remove();
                 $('#subcategoryTable').DataTable().ajax.reload();
             }
         });

    });

});

    </script>

@endsection