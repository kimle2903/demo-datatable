@extends('layouts.app')
@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.25/datatables.min.css"/>

@endsection
@section('header')
    <h3 class="card-title text-left mb-0">Consumers</h3>
    <div class="d-flex align-items-center">
        {{ Breadcrumbs::render('customer') }}
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {{-- <div class="row"></div> --}}
                    <div>
                        <table id="table-consomer" class=" table table-bordered table-striped" style="width: 100%">
                            <thead>
                                <tr>
                                    <th class="text-center font-weight-bolder align-middle">No</th>
                                    <th class="text-center font-weight-bolder align-middle">Image</th>
                                    <th class="text-center font-weight-bolder align-middle">Email</th>
                                    <th class="text-center font-weight-bolder align-middle">Name</th>
                                    <th class="text-center font-weight-bolder align-middle">Language</th>
                                    <th class="text-center font-weight-bolder align-middle">Status</th>
                                    <th class="text-center font-weight-bolder align-middle">Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.25/datatables.min.js"></script>
    <script>
        
        $(document).ready(function(){
           var columnObject = [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, class:"text-center align-middle"},
                {data: 'profile_img_url', name: 'profile_img_url', searchable: false, class:"text-center align-middle", 
                    render: function( data, type, row, meta){
                        return `<img src="${data}" class="img-thumbnail" width="100px" height="auto" onerror="this.onerror=null;this.src='{{ asset('images/no-image.png') }}';"/>`
                    }
                },
                {data: 'email', name: 'email', searchable: true ,class:"text-center align-middle"},
                {data: 'full_name', name: 'full_name', searchable: true, class:"text-center align-middle"},
                {data: 'language', name: 'language', searchable: false, class:"text-center align-middle"},
                {data: 'status', name: 'status', searchable: false, class:"text-center align-middle"},
                {data: 'action', name: 'action', searchable: false, class:"text-center align-middle"},
           ]
           var dataTabble =  $("#table-consomer").DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                ajax: {
                    url: "{{route('customer.datatable')}}", 
                    data:function (d) {
                        d.status = $('#status').val()
                    },
                    
                }, 
                columns: columnObject, 
                drawCallback: function(){
                    addEventListener();
                },
                
            });
            var html = ''
                html += `<div class="col-sm-12 col-md-6 row">
                            <div class="col-md-4 col-12">
                                <div class="dataTables_length" id="table-consomer_length"><label>Show <select name="table-consomer_length" aria-controls="table-consomer" class="custom-select custom-select-sm form-control form-control-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select> entries</label>
                                </div>
                            </div>
                            <div class="col-md-8 col-12" style="position: relative;top: -25px;}">
                               <label class="ml-1" style="margin: auto 0px">Status:</label>
                                <select class="form-control" id="status" style="width: 200px;">
                                    <option value="">All</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select
                            </div>
                        </div>
                        </div>
                        <div class="col-sm-12 col-md-6"><div id="table-consomer_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control form-control-sm" placeholder="" aria-controls="table-consomer"></label></div></div>
                        `;

            $('#table-consomer_wrapper .row:nth-child(1)').html(html);
            $("#status").change(function(){
                 dataTabble.draw();
            })

            function addEventListener(){
               
            }
           
           
        })
    </script>   
@endpush