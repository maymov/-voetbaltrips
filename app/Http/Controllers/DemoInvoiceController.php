<?php

namespace App\Http\Controllers;

use Activation;
use App\Cities;
use App\Club;
use App\Http\Requests;
use App\Http\Requests\UserRequest;
use App\Invoice;
use App\Stadium;
use App\Tournament;
use App\User;
use Barryvdh\DomPDF\PDF;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use File;
use Hash;
use Illuminate\Http\Request;
use Lang;
use Mail;
use Redirect;
use Reminder;
use Sentinel;
use URL;
use View;
use App\Match;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
class DemoInvoiceController extends JoshController
{



    /**
     * Index.
     *
     * @return View
     */
    public function Index($invoiceId)
    {

        $invoice = Invoice::findOrFail($invoiceId);

        //dd($invoice);

        $invoice_total_excl = $invoice->lines->sum('product_price');
        $invoice_total_vat = ($invoice->lines->sum('product_price') * 0.21);
        $invoice_total_incl = $invoice_total_excl + $invoice_total_vat;

        $html = View::make('pdf.invoice2', compact('invoice', 'invoice_total_excl', 'invoice_total_vat', 'invoice_total_incl'))->render();

        $data = array();
        //$pdf = \PDF::loadView($html, $data);

        return \PDF::loadHTML($html, 'A4', 'portrait')->stream();

       // return $pdf->download('invoice.pdf');

        //return View::make('voetbaltrips_frontend.match', compact('match'));

    }


}
