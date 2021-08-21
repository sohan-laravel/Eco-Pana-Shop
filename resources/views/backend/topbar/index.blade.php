@extends('backend.layouts.app')

@section('title')
  Topbar
@endsection

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
@endsection

@section('backend-content')

<div class="container mt-3">
    <div class="card">
        <div class="card-header">

            <h3 class="card-title"> Topbar</h3>

            <div class="container">
                <a href="{{ route('admin.topbar.create') }}" class="btn btn-outline-success btn-sm float-right">
                   <i class="fas fa-plus-circle fa-w-20"></i><span> ADD</span>
                </a>
            </div>
        </div>

        <div class="card-body">
    <table id="topbarTable" class="display" style="width:100%">
        <thead>
            <tr>
                <th>SL NO</th>
                <th>Number</th>    
                <th>Facebook</th>     
                <th>Twitter</th>     
                <th>Instagram</th>     
                <th>Whatsapp</th>     
                <th>Action</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($topbar as $row)

           <tr>
               <td>{{ $loop->index + 1 }}</td>
               <td>
                   <span class="badge rounded-pill bg-success">
                       {{ $row->number }}
                   </span>
                </td>
               <td>
                   <span class="badge rounded-pill bg-primary">
                       {{ substr($row->facebook, 0,  30)  }}
                   </span>
                </td>
               <td>
                   <span class="badge rounded-pill bg-primary">
                       {{ substr($row->twitter, 0,  30)  }}
                   </span>
                </td>
               <td>
                   <span class="badge rounded-pill bg-primary">
                       {{ substr($row->instagram, 0,  30)  }}
                   </span>
                </td>
               <td>
                   <span class="badge rounded-pill bg-primary">
                       {{ substr($row->whatsapp, 0,  30)  }}
                   </span>
                </td>
               
               <td>
                    <a href="{{ route('admin.topbar.edit', $row->id) }}" class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-edit"></i></a>

                    <form action="{{ route('admin.topbar.destroy', $row->id) }}" id="delete_form" method="POST">
                        @csrf

                        @method('DELETE')

                        <button type="submit" id="delete_topbar" class="btn btn-outline-danger btn-sm mt-2"><i class="fas fa-trash"></i></button>
                    </form>

               </td>
           </tr>

           @endforeach

        </tbody>
        <tfoot>
            <tr>
                <th>SL NO</th>
                <th>Number</th>    
                <th>Facebook</th>     
                <th>Twitter</th>     
                <th>Instagram</th>     
                <th>Whatsapp</th>     
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
            $('#topbarTable').DataTable();
        });

        // Delete function

            $(document).on('click', '#delete_topbar', function (event) {
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


        //

        

    </script>

@endsection