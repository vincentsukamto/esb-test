<?php

namespace App\Controllers;

use App\Models\InvoiceDetailModel;
use App\Models\InvoiceModel;

class Home extends BaseController
{
    public function index()
    {
        return view('index.php');
    }

    public function create()
    {
        return view('create.php');
    }

    public function view($id)
    {
        $modelInvoice = new InvoiceModel();
        $modelDetailInvoice = new InvoiceDetailModel();

        $invoice = $modelInvoice->where('id',$id)->first();
        $detail_invoice = $modelDetailInvoice->where('invoice_id',$id)->findAll();

        $data_invoice['data_invoice'] = [
            'invoice' => $invoice,
            'detail_invoice' => $detail_invoice
        ];

        return view('view.php', $data_invoice);
    }

    public function edit($id)
    {
        $modelInvoice = new InvoiceModel();
        $modelDetailInvoice = new InvoiceDetailModel();

        $invoice = $modelInvoice->where('id',$id)->first();
        $detail_invoice = $modelDetailInvoice->where('invoice_id',$id)->findAll();

        $data_invoice['data_invoice'] = [
            'invoice' => $invoice,
            'detail_invoice' => $detail_invoice
        ];

        return view('edit.php', $data_invoice);
    }
}
