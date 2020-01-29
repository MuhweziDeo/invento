<?php

namespace App\Http\Controllers\ServiceSale;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Item\ItemRepository;
use App\Http\Controllers\Service\ServiceRepository;
use App\Http\Controllers\User\UserRepository;
use App\Http\Requests\ServiceSaleRequest;
use App\Models\ServiceSale;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ServiceSaleController extends Controller
{
    public $serviceRepository;
    public $itemRepository;
    public $userRepository;
    public $serviceSaleRepository;

    public function __construct(ServiceRepository $serviceRepository,
                                ItemRepository $itemRepository,
                                UserRepository $userRepository,
                                ServiceSaleRepository $serviceSaleRepository)
    {
        $this->serviceRepository = $serviceRepository;
        $this->itemRepository = $itemRepository;
        $this->userRepository = $userRepository;
        $this->serviceSaleRepository = $serviceSaleRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $services = $this->serviceRepository->findAll();
        $items = $this->itemRepository->findAll();
        $sales = $this->serviceSaleRepository->model::with('customer', 'service', 'item')->paginate(10);
        return view('service-sales.index')->with(['sales'=>$sales]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $services = $this->serviceRepository->findAll();
        $items = $this->itemRepository->findAll();
        $customers =  $this->userRepository->findManyByKey('user_type', 'customer');
        return view('service-sales.create')->with(['services' => $services,
            'items' => $items, 'customers'=> $customers]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceSaleRequest $request)
    {
        $data = array();
        $service = $this->serviceRepository->findOneOrFail($request->get('service_id'));
        $items = $request->get('item_id');
        $optional = $request->get('optional');
        $now = Carbon::now()->toDateTimeString();
        foreach ($items as $key=>$item_id) {
            $isOptional = $optional && $optional[$key] ? false: true;
            $data[$key] = ['item_id' => $item_id, 'service_id'=> $service->id,
                'customer_id' => $request->get('customer_id'),
              'optional' => $isOptional, 'created_at' => $now, 'updated_at' => $now];

        }
        ServiceSale::insert($data);
        return redirect()->to('service-sales')->withSuccess('Service Sale Made');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
