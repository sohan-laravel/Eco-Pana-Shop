<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">

<form action="{{ route('admin.update.subcategory') }}" method="post" id="editCategoryForm" enctype="multipart/form-data">
    
    @csrf

     <div class="form-group">
        <input type="hidden" name="id" value="{{ $data->id }}">
        <label for="category_name">Category Name</label>
        <select class="form-control" name="category_id" id="category_id">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @if($category->id == $data->category_id) selected @endif>{{ $category->category_name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="category_name">SubCategory Name</label>
        <input type="text" class="form-control" name="subcategory_name" value="{{ $data->subcategory_name }}" id="subcategory_name" placeholder="Enter SubCategory Name">
    </div>

    <div class="form-group">
        <label for="image">SubCategory Image</label>
        

        <input type="file" name="image" id="image" />
        <input type="hidden" name="old_image" value="{{ $data->image }}">
        
    </div>

    <div class="form-group">
         <label for="image">SubCategory Current Image</label>
         {{-- <img src="" name="current_image" id="current_image" width="30px" height="30px" alt=""> --}}
         <img src="{{  asset('backend/images/SubCategoryImage/' .$data->image) }}" width="150" class="img-fluid mt-2" alt="{{ $data->subcategory_name }}" >
    </div>

    <input type="hidden" name="action" id="action" />
            <input type="hidden" name="hidden_id" id="hidden_id" />

    <button type="submit" class="btn btn-outline-primary btn-sm float-right submit_button"><span class="loading d-none">....</span>Update</button>
</form>

<!-- jQuery -->
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>

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

<script type="text/javascript">

    //edit form submit

    $('#editCategoryForm').submit(function(e){
         e.preventDefault();
         $('.loading').removeClass('d-none');
         var url = $(this).attr('action');
         var request = $(this).serialize();
         //$('.submit_button').prop('type', 'button');

         $.ajax({
             url:url,
             type:'post',
             async:false,
             data:request,
             success:function(data){
                 toastr.success(data);
                 $('#editCategoryForm')[0].reset();
                 $('.loading').hide();
                 //$('.submit_button').prop('type', 'submit');
                 //$('#addModal').modal('hide');
                 $('#editModal').hide();
                 $(".modal-backdrop").remove();
                 $('#subcategoryTable').DataTable().ajax.reload();
             }
         });

    });
</script>