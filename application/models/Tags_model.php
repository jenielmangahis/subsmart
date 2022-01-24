<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tags_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function add($data){
		$this->db->insert('job_tags', $data);
		$insert_id = $this->db->insert_id();
        return $this->db->insert_id();
	}

    public function addtagGroup($data){
		$this->db->insert('tags_group', $data);
		$insert_id = $this->db->insert_id();
        return $this->db->insert_id();
	}

    public function delete($id, $type = "tag") {
        if ($type == "tag" || $type == "group-tag") {
            return $this->db->where('id', $id)
                ->update('job_tags', ['status' => 0, 'updated_at' => date('Y-m-d h:i:s')]);
        }

        $this->db->where('group_tag_id', $id)
                ->update('job_tags', ['group_tag_id' => NULL, 'updated_at' => date('Y-m-d h:i:s')]);

        return $this->db->where('id', $id)
                ->update('tags_group', ['status' => 0, 'updated_at' => date('Y-m-d h:i:s')]);
    }

    public function update($id, $name, $type = "tag") {
        if ($type == "tag" || $type === "group-tag") {
            return $this->db->where('id', $id)
                ->update('job_tags', ['name' => $name, 'updated_at' => date('Y-m-d h:i:s')]);
        }

        return $this->db->where('id', $id)
                ->update('tags_group', ['name' => $name, 'updated_at' => date('Y-m-d h:i:s')]);
    }

    public function getGroup() {
        $groups = $this->db->where(['company_id' => getLoggedCompanyID(), 'status' => 1])->order_by('created_at', 'DESC')
            ->get('tags_group')->result_array();

        return $groups;
    }

    public function getTags() {
        $groups = $this->db->where(['company_id' => getLoggedCompanyID(), 'status' => 1])->order_by('name', 'asc')
            ->get('tags_group')->result_array();

        $regroup = [];

        foreach ($groups as $gKey => $group) {
            $tags = $this->db->where(['company_id' => getLoggedCompanyID(), 'group_tag_id' => $group['id'],'status' => 1])->order_by('name', 'asc')
                    ->get('job_tags')->result_array();
                    $group['tags'] = $tags;
                    $group['type'] = "group";
            $regroup[] = $group;
            foreach($tags as $tag) {
                $tag['type'] = "group-tag";
                $tag['parentIndex'] = array_key_last(array_filter($regroup, function($value, $key) use ($tag) { return ($tag['group_tag_id'] === $value['id'] && $value['type'] === 'group'); }, ARRAY_FILTER_USE_BOTH));
                $regroup[] = $tag;
            }
        }

        $tags = $this->db->where(['company_id' => getLoggedCompanyID(), 'group_tag_id' => NULL, 'status' => 1])->order_by('name', 'asc')
            ->get('job_tags')->result_array();

        foreach ($tags as $tKey => $tag) {
            $tag['type'] = "tag";
            $regroup[] = $tag;
        }

        return array_filter($regroup, function ($value) { return !is_null($value) && $value !== ''; });
    }

    public function getCompanyTags() {
        $tags = $this->db->where(['company_id' => getLoggedCompanyID(), 'status' => 1])->order_by('name', 'asc')
            ->get('job_tags')->result_array();

        return $tags;
    }

    public function getGroupById($id) {
        $group = $this->db->where(['company_id' => getLoggedCompanyID(), 'status' => 1, 'id' => $id])->get('tags_group')->row();

        return $group;
    }

    public function getTagById($id) {
        return $this->db->where(['company_id' => getLoggedCompanyID(), 'status' => 1, 'id' => $id])->get('job_tags')->row();
    }

    public function link_tag($data) {
        $this->db->insert('accounting_transaction_tags', $data);
	    return $this->db->insert_id();
    }

    public function get_transaction_tags($transactionType, $transactionId) {
		$this->db->select('job_tags.*');
        $this->db->from('job_tags');
        $this->db->where('accounting_transaction_tags.transaction_type', $transactionType);
        $this->db->where('accounting_transaction_tags.transaction_id', $transactionId);
        $this->db->order_by('accounting_transaction_tags.order_no', 'asc');
		$this->db->join('accounting_transaction_tags', 'accounting_transaction_tags.tag_id = job_tags.id');
        $query = $this->db->get();
        return $query->result();
    }

    public function unlink_tag($data)
    {
        $this->db->where('transaction_type', $data['transaction_type']);
		$this->db->where('transaction_id', $data['transaction_id']);
		$this->db->where('tag_id', $data['tag_id']);
		return $this->db->delete('accounting_transaction_tags');
    }

    public function update_link($data)
    {
        $this->db->where('transaction_type', $data['transaction_type']);
		$this->db->where('transaction_id', $data['transaction_id']);
		$this->db->where('order_no', $data['order_no']);
		$update = $this->db->update('accounting_transaction_tags', ['tag_id' => $data['tag_id']]);
		return $update ? true : false;
    }

    public function get_ungrouped()
    {
        $this->db->where('company_id', logged('company_id'));
        $this->db->where('group_tag_id', null);
        $this->db->where('status', 1);
        $query = $this->db->get('job_tags');
        return $query->result();
    }

    public function get_group_tags($groupId)
    {
        $this->db->where('company_id', logged('company_id'));
        $this->db->where('group_tag_id', $groupId);
        $this->db->where('status', 1);
        $query = $this->db->get('job_tags');
        return $query->result();
    }

    public function get_deposits($filters = [])
    {
        if(count($filters['tags']) > 0) {
            $taggedIds = $this->get_ids_with_tags($filters['tags'], 'Deposit');
        }
        $transactionsWithTags = $this->get_tagged_ids('Deposit');
        if(!is_null($filters['contact_id'])) {
            $ids = $this->get_deposit_ids_with_contact($filters['contact_type'], $filters['contact_id']);
        }

        $this->db->select('accounting_bank_deposit.*');
        $this->db->from('accounting_bank_deposit');
        $this->db->where('accounting_bank_deposit.company_id', $filters['company_id']);
        $this->db->where('accounting_bank_deposit.status', 1);
        if(isset($filters['from']) && !is_null($filters['from'])) {
            $this->db->where('accounting_bank_deposit.date >=', $filters['from']);
        }
        if(isset($filters['to']) && !is_null($filters['to'])) {
            $this->db->where('accounting_bank_deposit.date <=', $filters['to']);
        }
        if(!is_null($filters['contact_id'])) {
            $this->db->where_in('accounting_bank_deposit.id', $ids);
            $this->db->where('accounting_bank_deposit_funds.received_from_key', $filters['contact_type']);
            $this->db->where('accounting_bank_deposit_funds.received_from_id', $filters['contact_id']);
        }
        if(intval($filters['untagged']) === 1) {
            $this->db->where_not_in('accounting_bank_deposit.id', $transactionsWithTags);
        } else {
            $this->db->where_in('accounting_bank_deposit.id', $transactionsWithTags);
        }
        if(count($filters['tags']) > 0) {
            if(intval($filters['untagged']) === 1) {
                $this->db->or_where_in('accounting_bank_deposit.id', $taggedIds);
                $this->db->where('accounting_bank_deposit.company_id', $filters['company_id']);
                if(isset($filters['from']) && !is_null($filters['from'])) {
                    $this->db->where('accounting_bank_deposit.date >=', $filters['from']);
                }
                if(isset($filters['to']) && !is_null($filters['to'])) {
                    $this->db->where('accounting_bank_deposit.date <=', $filters['to']);
                }
                if(!is_null($filters['contact_id'])) {
                    $this->db->where('accounting_bank_deposit_funds.received_from_key', $filters['contact_type']);
                    $this->db->where('accounting_bank_deposit_funds.received_from_id', $filters['contact_id']);
                }
            } else {
                $this->db->where_in('accounting_bank_deposit.id', $taggedIds);
            }
        }
        $this->db->group_by('accounting_bank_deposit.id');
        $this->db->join('accounting_bank_deposit_funds', 'accounting_bank_deposit_funds.bank_deposit_id = accounting_bank_deposit.id');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_expenses($filters = [])
    {
        if(count($filters['tags']) > 0) {
            $taggedIds = $this->get_ids_with_tags($filters['tags'], 'Expense');
        }
        $transactionsWithTags = $this->get_tagged_ids('Expense');

        $this->db->select('*');
        $this->db->from('accounting_expense');
        $this->db->where('company_id', $filters['company_id']);
        $this->db->where('accounting_expense.status', 1);
        if(isset($filters['from']) && !is_null($filters['from'])) {
            $this->db->where('payment_date >=', $filters['from']);
        }
        if(isset($filters['to']) && !is_null($filters['to'])) {
            $this->db->where('payment_date <=', $filters['to']);
        }
        if(!is_null($filters['contact_id'])) {
            $this->db->where('payee_type', $filters['contact_type']);
            $this->db->where('payee_id', $filters['contact_id']);
        }
        if(intval($filters['untagged']) === 1) {
            $this->db->where_not_in('id', $transactionsWithTags);
        } else {
            $this->db->where_in('id', $transactionsWithTags);
        }
        if(count($filters['tags']) > 0) {
            if(intval($filters['untagged']) === 1) {
                $this->db->or_where_in('id', $taggedIds);
                $this->db->where('company_id', $filters['company_id']);
                if(isset($filters['from']) && !is_null($filters['from'])) {
                    $this->db->where('payment_date >=', $filters['from']);
                }
                if(isset($filters['to']) && !is_null($filters['to'])) {
                    $this->db->where('payment_date <=', $filters['to']);
                }
                if(!is_null($filters['contact_id'])) {
                    $this->db->where('payee_type', $filters['contact_type']);
                    $this->db->where('payee_id', $filters['contact_id']);
                }
            } else {
                $this->db->where_in('id', $taggedIds);
            }
        }
        $this->db->group_by('accounting_expense.id');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_checks($filters = [])
    {
        if(count($filters['tags']) > 0) {
            $taggedIds = $this->get_ids_with_tags($filters['tags'], 'Check');
        }
        $transactionsWithTags = $this->get_tagged_ids('Check');

        $this->db->select('*');
        $this->db->from('accounting_check');
        $this->db->where('company_id', $filters['company_id']);
        $this->db->where('accounting_check.status', 1);
        if(isset($filters['from']) && !is_null($filters['from'])) {
            $this->db->where('payment_date >=', $filters['from']);
        }
        if(isset($filters['to']) && !is_null($filters['to'])) {
            $this->db->where('payment_date <=', $filters['to']);
        }
        if(!is_null($filters['contact_id'])) {
            $this->db->where('payee_type', $filters['contact_type']);
            $this->db->where('payee_id', $filters['contact_id']);
        }
        if(intval($filters['untagged']) === 1) {
            $this->db->where_not_in('id', $transactionsWithTags);
        } else {
            $this->db->where_in('id', $transactionsWithTags);
        }
        if(count($filters['tags']) > 0) {
            if(intval($filters['untagged']) === 1) {
                $this->db->or_where_in('id', $taggedIds);
                $this->db->where('company_id', $filters['company_id']);
                if(isset($filters['from']) && !is_null($filters['from'])) {
                    $this->db->where('payment_date >=', $filters['from']);
                }
                if(isset($filters['to']) && !is_null($filters['to'])) {
                    $this->db->where('payment_date <=', $filters['to']);
                }
                if(!is_null($filters['contact_id'])) {
                    $this->db->where('payee_type', $filters['contact_type']);
                    $this->db->where('payee_id', $filters['contact_id']);
                }
            } else {
                $this->db->where_in('id', $taggedIds);
            }
        }
        $this->db->group_by('accounting_check.id');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_bills($filters = [])
    {
        if(count($filters['tags']) > 0) {
            $taggedIds = $this->get_ids_with_tags($filters['tags'], 'Bill');
        }
        $transactionsWithTags = $this->get_tagged_ids('Bill');

        $this->db->select('*');
        $this->db->from('accounting_bill');
        $this->db->where('company_id', $filters['company_id']);
        $this->db->where_in('accounting_bill.status', [1, 2]);
        if(isset($filters['from']) && !is_null($filters['from'])) {
            $this->db->where('bill_date >=', $filters['from']);
        }
        if(isset($filters['to']) && !is_null($filters['to'])) {
            $this->db->where('bill_date <=', $filters['to']);
        }
        if(!is_null($filters['contact_id']) && $filters['contact_type'] === 'vendor') {
            $this->db->where('vendor_id', $filters['contact_id']);
        }
        if(intval($filters['untagged']) === 1) {
            $this->db->where_not_in('id', $transactionsWithTags);
        } else {
            $this->db->where_in('id', $transactionsWithTags);
        }
        if(count($filters['tags']) > 0) {
            if(intval($filters['untagged']) === 1) {
                $this->db->or_where_in('id', $taggedIds);
                $this->db->where('company_id', $filters['company_id']);
                if(isset($filters['from']) && !is_null($filters['from'])) {
                    $this->db->where('bill_date >=', $filters['from']);
                }
                if(isset($filters['to']) && !is_null($filters['to'])) {
                    $this->db->where('bill_date <=', $filters['to']);
                }
                if(!is_null($filters['contact_id']) && $filters['contact_type'] === 'vendor') {
                    $this->db->where('vendor_id', $filters['contact_id']);
                }
            } else {
                $this->db->where_in('id', $taggedIds);
            }
        }
        $this->db->group_by('accounting_bill.id');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_purchase_orders($filters = [])
    {
        if(count($filters['tags']) > 0) {
            $taggedIds = $this->get_ids_with_tags($filters['tags'], 'Purchase Order');
        }
        $transactionsWithTags = $this->get_tagged_ids('Purchase Order');
        
        $this->db->select('*');
        $this->db->from('accounting_purchase_order');
        $this->db->where('company_id', $filters['company_id']);
        $this->db->where_in('accounting_purchase_order.status', [1, 2]);
        if(isset($filters['from']) && !is_null($filters['from'])) {
            $this->db->where('purchase_order_date >=', $filters['from']);
        }
        if(isset($filters['to']) && !is_null($filters['to'])) {
            $this->db->where('purchase_order_date <=', $filters['to']);
        }
        if(!is_null($filters['contact_id']) && $filters['contact_type'] === 'vendor') {
            $this->db->where('vendor_id', $filters['contact_id']);
        }
        if(intval($filters['untagged']) === 1) {
            $this->db->where_not_in('id', $transactionsWithTags);
        } else {
            $this->db->where_in('id', $transactionsWithTags);
        }
        if(count($filters['tags']) > 0) {
            if(intval($filters['untagged']) === 1) {
                $this->db->or_where_in('id', $taggedIds);
                $this->db->where('company_id', $filters['company_id']);
                if(isset($filters['from']) && !is_null($filters['from'])) {
                    $this->db->where('purchase_order_date >=', $filters['from']);
                }
                if(isset($filters['to']) && !is_null($filters['to'])) {
                    $this->db->where('purchase_order_date <=', $filters['to']);
                }
                if(!is_null($filters['contact_id']) && $filters['contact_type'] === 'vendor') {
                    $this->db->where('vendor_id', $filters['contact_id']);
                }
            } else {
                $this->db->where_in('id', $taggedIds);
            }
        }
        $this->db->group_by('accounting_purchase_order.id');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_vendor_credits($filters = [])
    {
        if(count($filters['tags']) > 0) {
            $taggedIds = $this->get_ids_with_tags($filters['tags'], 'Vendor Credit');
        }
        $transactionsWithTags = $this->get_tagged_ids('Vendor Credit');

        $this->db->select('*');
        $this->db->from('accounting_vendor_credit');
        $this->db->where('company_id', $filters['company_id']);
        $this->db->where_in('accounting_vendor_credit.status', [1, 2]);
        if(isset($filters['from']) && !is_null($filters['from'])) {
            $this->db->where('payment_date >=', $filters['from']);
        }
        if(isset($filters['to']) && !is_null($filters['to'])) {
            $this->db->where('payment_date <=', $filters['to']);
        }
        if(!is_null($filters['contact_id']) && $filters['contact_type'] === 'vendor') {
            $this->db->where('vendor_id', $filters['contact_id']);
        }
        if(intval($filters['untagged']) === 1) {
            $this->db->where_not_in('id', $transactionsWithTags);
        } else {
            $this->db->where_in('id', $transactionsWithTags);
        }
        if(count($filters['tags']) > 0) {
            if(intval($filters['untagged']) === 1) {
                $this->db->or_where_in('id', $taggedIds);
                $this->db->where('company_id', $filters['company_id']);
                if(isset($filters['from']) && !is_null($filters['from'])) {
                    $this->db->where('payment_date >=', $filters['from']);
                }
                if(isset($filters['to']) && !is_null($filters['to'])) {
                    $this->db->where('payment_date <=', $filters['to']);
                }
                if(!is_null($filters['contact_id']) && $filters['contact_type'] === 'vendor') {
                    $this->db->where('vendor_id', $filters['contact_id']);
                }
            } else {
                $this->db->where_in('id', $taggedIds);
            }
        }
        $this->db->group_by('accounting_vendor_credit.id');
        $query = $this->db->get();
        return $query->result();
    }
    
    public function get_cc_credits($filters = [])
    {
        if(count($filters['tags']) > 0) {
            $taggedIds = $this->get_ids_with_tags($filters['tags'], 'CC Credit');
        }
        $transactionsWithTags = $this->get_tagged_ids('CC Credit');

        $this->db->select('*');
        $this->db->from('accounting_credit_card_credits');
        $this->db->where('company_id', $filters['company_id']);
        $this->db->where('accounting_credit_card_credits.status', 1);
        if(isset($filters['from']) && !is_null($filters['from'])) {
            $this->db->where('payment_date >=', $filters['from']);
        }
        if(isset($filters['to']) && !is_null($filters['to'])) {
            $this->db->where('payment_date <=', $filters['to']);
        }
        if(!is_null($filters['contact_id'])) {
            $this->db->where('payee_type', $filters['contact_type']);
            $this->db->where('payee_id', $filters['contact_id']);
        }
        if(intval($filters['untagged']) === 1) {
            $this->db->where_not_in('id', $transactionsWithTags);
        } else {
            $this->db->where_in('id', $transactionsWithTags);
        }
        if(count($filters['tags']) > 0) {
            if(intval($filters['untagged']) === 1) {
                $this->db->or_where_in('id', $taggedIds);
                $this->db->where('company_id', $filters['company_id']);
                if(isset($filters['from']) && !is_null($filters['from'])) {
                    $this->db->where('payment_date >=', $filters['from']);
                }
                if(isset($filters['to']) && !is_null($filters['to'])) {
                    $this->db->where('payment_date <=', $filters['to']);
                }
                if(!is_null($filters['contact_id'])) {
                    $this->db->where('payee_type', $filters['contact_type']);
                    $this->db->where('payee_id', $filters['contact_id']);
                }
            } else {
                $this->db->where_in('id', $taggedIds);
            }
        }
        $this->db->group_by('accounting_credit_card_credits.id');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_ids_with_tags($tags, $type = '')
    {
        $this->db->select('transaction_id');
        $this->db->where('transaction_type', $type);
        $this->db->where_in('tag_id', $tags);
        $this->db->group_by('transaction_id');
        $query = $this->db->get('accounting_transaction_tags');
        $result = $query->result();

        $return = [
            0,
            ''
        ];
        foreach($result as $res) {
            $return[] = $res->transaction_id;
        }

        return $return;
    }

    public function get_tagged_ids($type = '')
    {
        $this->db->select('transaction_id');
        $this->db->where('transaction_type', $type);
        $this->db->group_by('transaction_id');
        $query = $this->db->get('accounting_transaction_tags');
        $result = $query->result();

        $return = [
            0,
            ''
        ];
        foreach($result as $res) {
            $return[] = $res->transaction_id;
        }

        return $return;
    }

    public function get_deposit_ids_with_contact($type, $id)
    {
        $this->db->select('bank_deposit_id, COUNT(*) as cnt');
        $this->db->where('received_from_key', $type);
        $this->db->where('received_from_id', $id);
        $this->db->group_by('bank_deposit_id');
        $query = $this->db->get('accounting_bank_deposit_funds');
        $result = $query->result();

        $return = [];
        foreach($result as $res) {
            $this->db->where('bank_deposit_id', $res->bank_deposit_id);
            $q = $this->db->get('accounting_bank_deposit_funds');
            $funds = $q->result();

            if(count($funds) === intval($res->cnt)) {
                $return[] = $res->bank_deposit_id;
            }
        }

        return $return;
    }

    public function get_tag_by_ids_and_group_id($tags = [0, ""], $groupId)
    {
        $this->db->where_in('id', $tags);
        $this->db->where('status', 1);
        if(is_null($groupId)) {
            $this->db->where('group_tag_id', null);
            $this->db->or_where_in('id', $tags);
            $this->db->where('status', 1);
            $this->db->where('group_tag_id', 0);
            $this->db->or_where_in('id', $tags);
            $this->db->where('status', 1);
            $this->db->where('group_tag_id', "");
        } else {
            $this->db->where('group_tag_id', $groupId);
        }
        $query = $this->db->get('job_tags');

        return $query->result();
    }

    public function unlink_multiple_transaction_tags($transactionType, $transactionId, $tags)
    {
        $this->db->where('transaction_type', $transactionType);
        $this->db->where('transaction_id', $transactionId);
        $this->db->where_in('tag_id', $tags);
        $delete = $this->db->delete('accounting_transaction_tags');
        return $delete ? true : false;
    }
}