<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Dotenv\Util\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */    public function Service(Request $request)
    {
        if ($request->ajax()) {
            $data = Service::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $btn = '<div class="action__buttons">';
                    // $btn = $btn . '<a href="' . route('admin.Service.edit', $data->id) . '" class="btn-action" title="Edit"><i class="fas fa-pen-to-square"></i></a>';

                    // if ($data->Status == 1) {
                    //     $btn = $btn . '<a href="' . route('admin.Service.inactive', $data->id) . '" class="btn-action" title="Inactive"><i class="fas fa-toggle-on"></i></a>';
                    // } else {
                    //     $btn = $btn . '<a href="' . route('admin.Service.active', $data->id) . '" class="btn-action" title="Active"><i class="fas fa-toggle-off"></i></a>';
                    // }

                    $btn = $btn . '<a href="' . route('admin.Service.delete', $data->id) . '" class="btn-action delete" title="Delete"><i class="fas fa-trash-alt"></i></a>';
                    $btn = $btn . '</div>';
                    return $btn;
                })
                ->editColumn('Service_Name', function ($data) {
                    return $data->en_Service_Name;
                })
                ->editColumn('Service_image', function ($data) {
                    return $data->en_Service_Slug;
                })
                ->editColumn('Status', function ($data) {
                    if ($data->Status == 1) {
                        $active = "Active";
                        return '<span class="status active">' . $active . '</span>';
                    } else {
                        $active = "Inactive";
                        return '<span class="status blocked">' . $active . '</span>';
                    }
                })
                ->editColumn('Description', function ($data) {
                    return Str::limit($data->en_Description, 10);
                })
                ->editColumn('Service_image', function ($data) {
                    return $data->Service_Icon;
                })
                ->rawColumns(['action', 'Service_Name', 'Status', 'Description'])
                ->make(true);
        }
        $data['title'] = __('Service List');
        return view('admin.pages.Service.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ServiceStore(Request $request)
    {
        $Service = Service::create([
            'en_Service_Name' => $request->en_Service_name,
            'en_Description' => $request->en_description,
         
            'fr_Service_Name' => $request->fr_Service_name,
            'fr_Description' => $request->fr_description,
            'location' => $request->location,
            'start_data' => $request->start_data,
            'end_data' => $request->end_data,

            'Service_image' => $request->Service_image,
        ]);
        if ($Service) {
            return redirect()->route('admin.Service')->with('success', __('Successfully Stored !'));
        }
        return redirect()->route('admin.Service')->with('error', __('Does not Stored !'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function ServiceUpdate(Request $request)
    {
        $id = $request->id;
        $cat = Service::whereid($id)->first();
        $update = $cat->update([
            'en_Service_Name' => is_null($request->en_Service_name) ? $cat->en_Service_Name : $request->en_Service_name,
            'en_Description' => is_null($request->en_description) ? $cat->en_Description : $request->en_description,
            'fr_Service_Name' => is_null($request->fr_Service_name) ? $cat->fr_Service_Name : $request->fr_Service_name,
            'fr_Description' => is_null($request->fr_description) ? $cat->fr_Description : $request->fr_description,

            'start_data' => is_null($request->start_data) ? null : $request->start_data,
            'end_data' => is_null($request->end_data) ? null : $request->end_data,
            'location' => is_null($request->location) ? null : $request->location,



            'Service_image' => is_null($request->Service_image) ? null : $request->Service_image,
        ]);
        if ($update) {
            return redirect()->route('admin.Service')->with('success', __('Successfully Updated!'));
        }
        return redirect()->back()->with('error', __('Does not Update  !'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function ServiceDelete($id)
    {
        $delete = Service::Where('id', $id)->delete();
        if ($delete) {
            return redirect()->route('admin.Service')->with('success', __('Successfully Deleted !'));
        }
        return redirect()->route('admin.Service')->with('error', __('Does Not Delete!'));
    }
}
