<?php

namespace App\Models;

use CodeIgniter\Model;

class InvoiceModel extends Model
{
    protected $table      = 'invoice';
    protected $primaryKey = 'id';

    protected $allowedFields = ['issue_date', 'due_date', 'subject', 'subtotal', 'tax', 'payments', 'amount_due', 'status'];

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';
    
    protected $useSoftDeletes = true;

}