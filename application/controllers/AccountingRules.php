<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AccountingRules extends MY_Controller
{
    public function apiSaveRule()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);
        $payload['user_id'] = logged('id');

        // Remove unsupported columns on `accounting_rules` table.
        ['conditions' => $conditions, 'assignment' => $assignment] = $payload;
        unset($payload['conditions']);
        unset($payload['assignment']);

        $this->db->insert('accounting_rules', $payload);
        $this->db->where('id', $this->db->insert_id());
        $newRule = $this->db->get('accounting_rules')->row();

        $conditions = array_map(function ($condition) use ($newRule) {
            $condition['rules_id'] = $newRule->id;
            return $condition;
        }, $conditions);
        $this->db->insert_batch('accounting_rules_conditions', $conditions);

        $assignment['rule_id'] = $newRule->id;
        $this->db->insert('accounting_rule_assignments', $assignment);

        header('content-type: application/json');
        echo json_encode(['data' => $newRule]);
    }

    public function apiGetRules()
    {
        $this->db->where('user_id', logged('id'));
        $rules = $this->db->get('accounting_rules')->result();

        foreach ($rules as $rule) {
            $this->db->where('rules_id', $rule->id);
            $rule->conditions = $this->db->get('accounting_rules_conditions')->result();
        }

        header('content-type: application/json');
        echo json_encode(['data' => $rules]);
    }

    public function apiEditRule($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);

        $this->db->where('id', $id);
        $this->db->update('accounting_rules', $payload);

        $this->db->where('id', $id);
        $record = $this->db->get('accounting_rules')->row();

        header('content-type: application/json');
        echo json_encode(['data' => $record]);
    }
}
