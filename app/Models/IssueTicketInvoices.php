<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IssueTicketInvoices extends Model
{
    protected $fillable = ['issue_ticket_id','cost','paid','remark','paid_by'];
}
