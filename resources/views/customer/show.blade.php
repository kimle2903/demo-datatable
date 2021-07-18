@extends('layouts.app')
@section('css')
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
@endsection

@section('header')
    <h3 class="card-title text-left mb-0">Consumer detail</h3>
    <div class="d-flex align-items-center">
        {{ Breadcrumbs::render('customerDetail', $customerDetail->id) }}
    </div>
@endsection

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body row">
                    <div class="col-4 row">
                        <div class="col-6 offset-2">
                            <img src="{{Storage::url($customerDetail->profile_img_url)}}" class="w-100" style="max-width: 200px;" onerror="this.onerror=null;this.src='{{ asset('images/no-image.png') }}';" alt="">
                        </div>
                    </div>
                    <div class="col-4">
                        <p><label for="" class="text-right font-weight-bolder"> Name:</label> <span>{{$customerDetail->full_name}}</span></p>
                        <p> <label for="" class="text-right font-weight-bolder"> Language:</label> <span>{{$customerDetail->language}}</span></p>
                        <p ><label for="" class="text-right font-weight-bolder"> Description:</label> <span>{{$customerDetail->description}}</span></p>
                        <p ><label for="" class="text-right font-weight-bolder"> Created at:</label>  <span>{{$customerDetail->created_at}}</span></p>
                    </div>
                    <div class="col-4">
                        <p ><label for="" class="text-right font-weight-bolder"> Email:</label> <span>{{$customerDetail->accounts->email}}</span> </p>
                        <p ><label for="" class="text-right font-weight-bolder"> Currency:</label> <span>{{$customerDetail->currency}}</span></p>
                        <p> <label for="" class="text-right font-weight-bolder">Status: </label>
                            @php
                               $check =  $customerDetail->status == 1 ? 'checked' : ''
                            @endphp
                            <input id="check-status" type="checkbox" {{$check}} data-toggle="toggle" data-on="Active" data-off="Inactive" data-onstyle="success" data-offstyle="danger">
                        </p>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#check-status').bootstrapToggle();
            $("#check-status").change(function(){
               let status = $(this).prop('checked');
               let id = {!!$customerDetail->id !!}
               
               $.ajax({
                   url: "{{route('customer.change.status')}}", 
                   data: {
                       id: id, 
                       status: status,
                       _token: '{{csrf_token()}}', 
                       
                   }, 
                   method: 'POST', 
                   dataType: 'json',
                   success: function(data){
                        if(data['status'] == 200){
                             toastr.success(data.message);
                        }else{
                             toastr.error(data.message);
                        }
                   }, 
                   error: function(data){
                        toastr.error(data.message);
                   }
               })
               
            })
        })
    </script>
@endpush