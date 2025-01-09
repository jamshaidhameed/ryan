<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class IssueTickets extends Model
{
    //

    protected $fillable = ['tenant_contract_id','issue_raised_by','issue_ticket_type','issue_code','title','slug','description','is_urgent','status','need_update','updated_by','priority','assigned_to','assigned_by','issue_identification','issue_resolved_description','issue_created_by_admin','photo'];

    public static function issue_tickets($tenant_contract_id){

        return DB::select("SELECT concat(t.first_name,' ',t.last_name) as tenant,it.* FROM `issue_tickets` it left JOIN tenant_contracts tc ON it.tenant_contract_id = tc.id left JOIN users t ON tc.user_id = t.id WHERE it.tenant_contract_id = ".$tenant_contract_id);

    }
}
