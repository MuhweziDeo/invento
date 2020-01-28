<?php

namespace App\Http\Controllers\Item;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Contracts\View\Factory;
use App\Models\Item;
use App\Http\Requests\CreateItemRequest;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ItemController extends Controller
{
    private $itemRepository;

    public function __construct(ItemRepository $itemRepository)
    {
        $this->itemRepository = $itemRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $items = $this->itemRepository->paginate(10);
        return view('items.index')->with(['items' => $items]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('items.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateItemRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreateItemRequest $request)
    {
        //TODO make sure quantity is not less than minimum quantity
        $data = $request->all();
        $data['code'] = $request->get('code');
        //assuming a person enters a brand as one string there are edge cases if the enter spaced string
        $data['name'] = strtoupper($data['size'] . "' " . $data['code'] . ' ' . $data['brand']);
        Item::create($data);
        return redirect()->to('items')->withSuccess('Item Added');
    }

    /**
     * Display the specified resource.
     *
     * @param Item $item
     * @return Factory|View
     */
    public function show(Item $item)
    {
        return view('items.show')->with(['item' => $item]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Item $item
     * @return Factory|View
     */
    public function edit(Item $item)
    {
        return view('items.edit')->with(['item' => $item]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CreateItemRequest $request
     * @param Item $item
     * @return Response
     */
    public function update(CreateItemRequest $request, Item $item)
    {
        //TODO make sure quantity is not less than minimum quantity
        // TODO what is the brand or size are changed should the code be regenerated as well
        $item->update($request->all());
        if($item->quantity > $item->minimum_quantity) {
            $item->update(['saleable' => true]);
        }else {
            $item->update(['saleable' => false]);
        }
        return redirect()->to('items')->withSuccess('Item Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Item $item
     * @return Response
     * @throws Exception
     */
    public function destroy(Item $item)
    {
        $item->delete();
        return redirect()->to('items')->withSuccess('Item Deleted');
    }
}
