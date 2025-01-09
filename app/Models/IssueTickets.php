<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IssueTickets extends Model
{
    //

    protected $fillable = ['tenant_contract_id','issue_raised_by','issue_ticket_type','issue_code','title','slug','description','is_urgent','status','need_update','updated_by','priority','assigned_to','assigned_by','issue_identification','issue_resolved_description','issue_created_by_admin'];
}
