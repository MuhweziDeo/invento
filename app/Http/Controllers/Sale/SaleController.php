<?php

namespace App\Http\Controllers\Sale;

use App\Events\SaleMade;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Item\ItemRepository;
use App\Http\Controllers\User\UserRepository;
use App\Models\Sale;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Http\Requests\CreateSaleRequest;

class SaleController extends Controller
{
    public $itemRepository;
    public $customerRepository;
    public $saleRepository;
    public function __construct(UserRepository $userRepository,
                                ItemRepository $itemRepository,
                                SaleRepository $saleRepository)
    {
        //TODO  register Repository DI in container
        $this->customerRepository = $userRepository;
        $this->itemRepository = $itemRepository;
        $this->saleRepository = $saleRepository;
        $this->middleware('is_admin')->only('destroy');

    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $sales = $this->saleRepository->model::with('customer', 'item', 'sold_by')->get();
        return view('sales.index')->with(['sales' => $sales]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        $items = $this->itemRepository->findAll();
        $customer = $this->customerRepository->findManyByKey('user_type', 'customer');
        return view('sales.create')->with(['items' => $items, 'customers' => $customer]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateSaleRequest $request
     * @return RedirectResponse
     */
    public function store(CreateSaleRequest $request)
    {

        $data = $request->only('customer_id', 'item_id', 'quantity');
        $data['staff_id'] = auth()->id();
        $item = $this->itemRepository->findOneOrFail($data['item_id']);
        if(!$item->saleable) {
            return back()->withErrors(['saleable' => 'Item is not in stock']);
        }
        $sale = Sale::create($data);
        event(new SaleMade($item, $sale->quantity));
        return redirect()->to('sales')->withSuccess('Sale Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param Sale $sale
     * @return Factory|View
     */
    public function show(Sale $sale)
    {
        $items = $this->itemRepository->findAll();
        $customer = $this->customerRepository->findManyByKey('user_type', 'customer');
        return view('sales.show')->with(['items' => $items, 'customers' => $customer, 'sale' => $sale]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Sale $sale
     * @return Factory|View
     */
    public function edit(Sale $sale)
    {
        $items = $this->itemRepository->findAll();
        $customer = $this->customerRepository->findManyByKey('user_type', 'customer');
        return view('sales.edit')->with(['items' => $items, 'customers' => $customer, 'sale' => $sale]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CreateSaleRequest $request
     * @param Sale $sale
     * @return RedirectResponse
     */
    public function update(CreateSaleRequest $request, Sale $sale)
    {
        $item = $this->itemRepository->findOneOrFail($request->get('item_id'));

        $sale->update( $request->only('customer_id', 'item_id', 'quantity'));

        //TODO check if new quantity is different from the current one and fire event
        event(new SaleMade($item, $request->get('quantity')));

        return redirect()->to('sales')->withSuccess('Sale updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Sale $sale
     * @return void
     * @throws \Exception
     */
    public function destroy(Sale $sale)
    {
        // Lets assume a sale is deleted but the item is not returned cases that the item  is deleted and return
        //we can fire an event to restore the returned stock
        $sale->delete();
        return redirect()->to('sales')->withSuccess('Sale deleted Successfully');
    }
}
