<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\PaymentMethods;
use Illuminate\Http\Request;
use App\Traits\Helper;

class PaymentMethodController extends Controller
{


    use Helper;


    public function rules(){
        return [
            "title" => ["required", "max:255", "unique:payment_methods"],
        ];
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!hasPermissions(["create-payment-method" ,"edit-payment-method", "delete-payment-method"]))
            return abort("401");

        $data['payments'] = PaymentMethods::all();
        return view("payment_method.index",$data);
    }

    /**
     * Show the form for creating a new resource.
     *)
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!hasPermissions("create-payment-method" ))
            return abort("401");

        return view("payment_method.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!hasPermissions("create-payment-method" ))
            return abort("401");

        $request->validate($this->rules());
        $payment = new PaymentMethods();
        $payment->title = $request->title;
        $payment->save();
        $this->setPageMessage("The Peyment Method Has Been Added Successfully");
        return redirect()->route("payment_method.index");

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!hasPermissions("edit-payment-method" ))
            return abort("401");

        $data['payment'] = PaymentMethods::findOrFail($id);
        return view("payment_method.edit",$data);

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
        if(!hasPermissions("edit-payment-method" ))
            return abort("401");

        $payment = PaymentMethods::findOrFail($id);
        $rules = $this->rules();
        if($payment->title == $request->title)
            $rules["title"] = ["required", "max:255"];
        $request->validate($rules);
        $payment->title = $request->title;
        $payment->save();

        $this->setPageMessage("The Payment Method Has Been Updated Successfully");
        return redirect()->route("payment_method.index");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if(!hasPermissions("delete-payment-method" ))
            return abort("401");

        PaymentMethods::findOrFail($request->id)->delete();
        $this->setPageMessage("The Payment Method Has Been Deleted Successfully",0);
        return redirect()->route("payment_method.index");
    }
}
