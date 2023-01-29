<?php

namespace App\Controllers;

use App\Models\InvoiceDetailModel;
use App\Models\InvoiceModel;

class InvoiceController extends BaseController
{
    public function search()
    {
        $modelInvoice = new InvoiceModel();
        $invoice = $modelInvoice->findAll();

        for($i=0;$i<count($invoice);$i++) {
            $invoice[$i]['issue_date'] = date('d/m/Y',strtotime($invoice[$i]['issue_date']));
            $invoice[$i]['due_date'] = date('d/m/Y',strtotime($invoice[$i]['due_date']));
        }
        
        return json_encode($invoice);
    }

    public function insert()
    {
        $modelInvoice = new InvoiceModel();
        $modelDetailInvoice = new InvoiceDetailModel();
        $data = $this->request->getPost();

        // create invoice
        $insert_data = [
            'issue_date' => $data['issue_date'],
            'due_date' => $data['due_date'],
            'subject' => $data['subject'],
            'subtotal' => $data['subtotal'],
            'tax' => $data['tax'],
            'payments' => $data['payment'],
            'amount_due' => $data['amount_due'],
            'status' => $data['status']
        ];
        $modelInvoice->insert($insert_data);

        // insert invoice detail
        $insert_detail =[];
        foreach($data['array_count'] as $i) {
            $insert_detail = [
                'invoice_id' => $modelInvoice->getInsertID(),
                'item_type' => $data['item_type'.$i],
                'description' => $data['description'.$i],
                'quantity' => $data['quantity'.$i],
                'unit_price' => $data['unit_price'.$i],
                'amount' => $data['amount'.$i]
            ];
            $modelDetailInvoice->insert($insert_detail);
        }
        session()->setFlashdata('insert_success');
        return redirect()->to('/');
    }

    public function delete($id) {
        $modelInvoice = new InvoiceModel();
        $modelInvoice->delete($id);
        session()->setFlashdata('deleted');
        return redirect()->to('/');
    }
    
    public function update($id)
    {
        $modelInvoice = new InvoiceModel();
        $modelDetailInvoice = new InvoiceDetailModel();
        $data = $this->request->getPost();
        // dd($data);

        $data_update_invoice = [
            'id' => $id,
            'issue_date' => $data['issue_date'],
            'due_date' => $data['due_date'],
            'subject' => $data['subject'],
            'subtotal' => $data['subtotal'],
            'tax' => $data['tax'],
            'payments' => $data['payment'],
            'amount_due' => $data['amount_due'],
            'status' => $data['status']
        ];
        $modelInvoice->save($data_update_invoice);

        // insert invoice detail
        $insert_detail =[];
        $delete_detail  = $modelDetailInvoice->where('invoice_id',$id)->findAll();
        for($i=0;$i<count($delete_detail);$i++) {
            $modelDetailInvoice->delete($delete_detail[$i]['id']);
        }
        foreach($data['array_count'] as $i) {
            $update_detail = [
                'invoice_id' => $id,
                'item_type' => $data['item_type'.$i],
                'description' => $data['description'.$i],
                'quantity' => $data['quantity'.$i],
                'unit_price' => $data['unit_price'.$i],
                'amount' => $data['amount'.$i]
            ];
            $modelDetailInvoice->insert($update_detail);
        }
        return redirect()->to('/');
    }
}
