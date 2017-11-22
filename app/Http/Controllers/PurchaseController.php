<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Payment;
use Illuminate\Http\Request;
use Carbon\Carbon;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Lang;
use Omnipay\Omnipay;

class PurchaseController extends Controller
{

    public function index()
    {
        return view('mollie');
    }

    public function create()
    {
        // get list of issuers
        $gateway = Omnipay::create('Mollie');
        $gateway->setApiKey('test_GrDfeDt5B7VvkrWNTvbQu3q9wtCezn');

        $payment = $gateway->fetchPaymentMethods()->send();
        if($payment->isSuccessful()){
            $pay = $payment->getPaymentMethods();
        }


        $henk = $gateway->fetchIssuers()->send();
        if($henk->isSuccessful()){
            $issuers = $henk->getIssuers();
        }

        return View('omnipay.pay')
            ->with(['issuers'=>$issuers,'pay'=>$pay]);
    }

    public function store()
    {
        // make payment
        $gateway = Omnipay::create('Mollie');
        $gateway->setApiKey('test_GrDfeDt5B7VvkrWNTvbQu3q9wtCezn');

        $order_id = time();
        $params = array(
            'amount'=>'10.00',
            'description'=> time(),
            'method'=>Input::get('paymentmethod'),
            'returnUrl'=>URL::route('purchase.show', [$order_id]),
            'redirectUrl'=>URL::route('purchase.show'),
            'metadata'=> array(
                'order_id' => $order_id,
            ),
            'issuer'=>Input::get('issuer'),
        );
        $response = $gateway->purchase($params)->send();

        if ($response->getTransactionReference()) {
           // $this->setTransactionID($response->getTransactionReference());
        }

        //$details['transactionReference'] = $response->getTransactionReference();

        Log::error('blablalllll');

        if($response->isRedirect()){
            $response->redirect();
        } elseif($response->isPending()) {
            return "Pending, Reference: ". $response->getTransactionReference();
            //return Redirect::away($response->getData()['links']['paymentUrl']);
        } else {
            return "Error " .$response->getCode() . ': ' .$response->getMessage();
        }
    }

    public function show($id)
    {
        dd($id);

        $gateway = Omnipay::create('Mollie');
        $gateway->setApiKey('test_GrDfeDt5B7VvkrWNTvbQu3q9wtCezn');

        $transactionReference = $_POST['id'];  //coming from webhook

        $response = $gateway->completePurchase(
            array(

                'transactionReference'   => $transactionReference,

            )
        )->send();

        //$response = $gateway->completePurchase()->send();

        $data = $response->getData();

        print_r($data);

    }

}
