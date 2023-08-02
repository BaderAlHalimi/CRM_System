<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

use function PHPUnit\Framework\isNull;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $customers = Customer::where('user_id', Auth::id())->get();
        return view('dashboard.customers', ['customers' => $customers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('dashboard.createcustomer');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerRequest $request)
    {
        //
        $validated = $request->validated();
        $validated['user_id'] = Auth::id();
        // dd($validated);
        Customer::create($validated);
        return redirect()->route('customer.index')->with('success', 'customer ' . $validated['firstname'] . ', add successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
        if (Auth::id() == $customer->user_id) {
            return view('dashboard.editcustomer', ['customer' => $customer]);
        } else {
            return redirect()->route('customer.index');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerRequest $request, Customer $customer)
    {
        //
        $validated = $request->validated();
        $customer->update($validated);
        return redirect()->route('customer.index')->with('success', 'customer ' . $validated['firstname'] . ', Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
        $customer->delete();
        return redirect()->route('customer.index')->with('success', 'customer ' . $customer['firstname'] . ', deleted successfully');
    }
    public function trash()
    {
        $customers = Customer::onlyTrashed()->where('user_id', Auth::id())->orderBy('deleted_at')->get();
        return view('dashboard.trashedcustomers', ['customers' => $customers]);
    }
    public function restore($customer)
    {
        // dd($customer);
        $ctm = Customer::onlyTrashed()->where('user_id', Auth::id())->where('id', $customer)->first();
        // dd($ctm);
        if ($ctm->id) {
            $ctm->restore();
            return redirect()->route('customer.trash')->with('success', 'restored successfully');
        } else {
            return redirect()->route('customer.trash');
        }
    }
    public function forcedelete($customer)
    {
        $ctm = Customer::onlyTrashed()->where('id', $customer)->first();
        // dd($customer);
        if ($ctm->user_id == Auth::id()) {
            $ctm->forceDelete();
            return redirect()->route('customer.trash')->with('success', 'Deleted successfully');
        } else {
            return redirect()->route('customer.trash');
        }
    }
    public function sort(Request $request)
    {
        switch ($request->sort_method) {
            case 1: {
                    $ctm = Customer::where('user_id', Auth::id())->orderBy('firstname')->get();
                    break;
                };
            case 2: {
                    $ctm = Customer::where('user_id', Auth::id())->orderBy('firstname', 'desc')->get();
                    break;
                };
            case 3: {
                    $ctm = Customer::where('user_id', Auth::id())->orderBy('birthdate')->get();
                    break;
                };
            case 4: {
                    $ctm = Customer::where('user_id', Auth::id())->orderBy('birthdate', 'desc')->get();
                    break;
                };
            default: {
                    $ctm = Customer::where('user_id', Auth::id())->get();
                };
                break;
        }
        return view('dashboard.customers')->with('customers',$ctm);
    }
}
