<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Service\ServiceRepository;
use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ServiceController extends Controller
{
    public $serviceRepository;

    public function __construct(ServiceRepository $serviceRepository)
    {
        $this->serviceRepository = $serviceRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $services = $this->serviceRepository->paginate(10);
        return view('services.index')->with(['services' => $services]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('services.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ServiceRequest $request
     * @return Response
     */
    public function store(ServiceRequest $request)
    {
        $data = $request->only('name', 'labor');
        Service::create($data);
        return redirect()->to('services')->withSuccess('Service added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Service $service
     * @return Factory|View
     */
    public function edit(Service $service)
    {
        return view('services.edit')->with(['service' => $service]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ServiceRequest $request
     * @param Service $service
     * @return void
     */
    public function update(ServiceRequest $request, Service $service)
    {
        $service->update($request->only('name', 'labor'));
        return redirect()->to('services')->withSuccess('Service Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Service $service
     * @return void
     * @throws Exception
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->to('services')->withSuccess('Service Removed Successfully');
    }
}
