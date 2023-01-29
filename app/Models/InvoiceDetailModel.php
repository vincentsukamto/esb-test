<?php

namespace App\Models;

use CodeIgniter\Model;

class InvoiceDetailModel extends Model
{
    protected $table      = 'invoice_detail';
    protected $primaryKey = 'id';

    protected $allowedFields = ['invoice_id', 'item_type', 'description', 'quantity', 'unit_price', 'amount'];

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    
    protected $useSoftDeletes = true;

}