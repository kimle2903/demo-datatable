<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Storage;


class ConsomerController extends Controller
{
    public function index(){
        return view('customer.list');
    }

    public function detail(Request $request, $id, Customer $customer){
        $customerDetail = $customer->with(['customerAddress', 'accounts'])->find($id);
        if($customerDetail){
            return view('customer.show', compact('customerDetail'));
        }
        return abort(404);
    }
    public function changeStatus(Request $request, Customer $customer){
        
        if($request->ajax()){
            $customerDetail = $customer->with(['customerAddress','accounts'])->find($request->id);
            if($customerDetail){
                $data = [
                    'status' => $request->status == 'true' ? 1 : 0,
                ];
                $result = $customerDetail->update($data);
             
                if($result){
                    return response()->json([
                        'message' => 'Change status successful',
                        'status' => '200'
                    ]);
                }
                return response()->json([
                    'message' => 'Change status fail',
                    'status' => '500'
                ]);
            }

            return response()->json([
                'message' => 'Change status fail',
                'status' => '500'
            ]);
        }
    }

    public function getDataTable(Request $request, Customer $customer){
        if($request->ajax()){
            $data = $customer->with(['customerAddress','accounts']);
            if($request->status != ''){
                $data = $data->where('status', $request->status);
            }
            $data = $data->orderBy('id', 'desc')->get();
            return DataTables::of($data)
            ->addIndexColumn()
            ->editColumn('profile_img_url', function($data){
                return Storage::url($data->profile_img_url);
            })
            ->addColumn('email', function($data){
                return @$data->accounts->email;
            })
            ->editColumn('full_name', function($data){
                return $data->full_name;
            })
            ->editColumn('status', function($data){
                if($data->status == 1){
                    return '<span class="p-2 bg-success text-white">Active</span>';
                }
                return '<span class="p-2 bg-danger text-white" width="100px">Inactive</span>';
            })
            ->addColumn('action', function($data){
                return view('elements.detail', [
                    'model' => $data,
                    'url_detail' => route('customer.detail', ['id' => $data->id]),
                ]);
                    
            })
                ->rawColumns(['profile_img_url', 'status', 'action'])
                ->make(true);
            
                }
       
    }
}
