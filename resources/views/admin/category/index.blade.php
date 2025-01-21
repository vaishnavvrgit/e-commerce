@extends('layout.admin')
@section('title','Categorys List')
@section('content')

 <!-- ========== tab components start ========== -->
       <section class="table-components">
        <div class="container-fluid">
          <!-- ========== title-wrapper start ========== -->
          <div class="title-wrapper pt-30">
            <div class="row align-items-center">
              <div class="col-md-6">
                <div class="title">
                  <h2>Categories</h2>
                </div>
              </div>
              <!-- end col -->
              <div class="col-md-6">
                <div class="breadcrumb-wrapper">
                  <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item">
                        <a href="#0">Products</a>
                      </li>
                      <li class="breadcrumb-item active" aria-current="page">
                        Categories
                      </li>
                    </ol>
                  </nav>
                </div>
              </div>
        
            </div>
      
          </div>
          
          <div class="tables-wrapper">
            <div class="row">
              <div class="col-lg-12">
                <div class="card-style mb-30">
             
                  <div class="table-wrapper table-responsive">

                    <table class="table" id="category_table">
                      <thead>
                        <tr>
                          <th class="lead-info">
                            <h6>SlNo.</h6>
                          </th>
                          <th class="lead-email">
                            <h6>Category Name</h6>
                          </th>
                          <th class="lead-phone">
                            <h6>Created Date</h6>
                          </th>
                          <th>
                            <h6>Action</h6>
                          </th>
                        </tr>
                      </thead>

                      <tbody>
             
                      </tbody>

                    </table>
                  
                  </div>
                </div>
               
              </div>
      
            </div>
           
          </div>
         
        </div>
     
      </section>

@endsection

@push('script')
    
   <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>
<script>

  $(function () {
        
    var table = $('#category_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('admin.category.index') }}",
        columns: [

            {data: 'id',
             name: 'id'

            },
            {data: 'name',
             name: 'name'},

            {data: 'created_at',
             name: 'created_at'},


            {data: 'action',
             name: 'action',
              orderable: false,
               searchable: false
            },
        ]
    });
        
  });
</script>

@endpush