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
        ['conditions' => $conditions, 'assignments' => $assignments] = $payload;
        unset($payload['conditions']);
        unset($payload['assignments']);

        $this->db->select_max('priority', 'value');
        $this->db->where('user_id', $payload['user_id']);
        $maxPrio = $this->db->get('accounting_rules')->row();
        $payload['priority'] = is_null($maxPrio->value) ? 0 : ((int) $maxPrio->value) + 1;

        $this->db->insert('accounting_rules', $payload);
        $this->db->where('id', $this->db->insert_id());
        $newRule = $this->db->get('accounting_rules')->row();

        $conditions = array_map(function ($condition) use ($newRule) {
            $condition['rules_id'] = $newRule->id;
            return $condition;
        }, $conditions);
        $this->db->insert_batch('accounting_rules_conditions', $conditions);

        $assignments = array_map(function ($assignment) use ($newRule) {
            $assignment['rule_id'] = $newRule->id;
            return $assignment;
        }, $assignments);
        $this->db->insert_batch('accounting_rule_assignments', $assignments);

        header('content-type: application/json');
        echo json_encode(['data' => $newRule]);
    }

    public function apiGetRules()
    {
        $this->db->where('user_id', logged('id'));
        $this->db->order_by('priority', 'ASC');
        $rules = $this->db->get('accounting_rules')->result();

        foreach ($rules as $rule) {
            $this->db->where('rules_id', $rule->id);
            $rule->conditions = $this->db->get('accounting_rules_conditions')->result();

            $this->db->where('rule_id', $rule->id);
            $rule->assignments = $this->db->get('accounting_rule_assignments')->result();
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

    public function apiBatchEditRule()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);
        ['ids' => $ids] = $payload;
        unset($payload['ids']);

        $rules = array_map(function ($id) use ($payload) {
            return array_merge(['id' => $id], $payload);
        }, $ids);
        $this->db->update_batch('accounting_rules', $rules, 'id');

        header('content-type: application/json');
        echo json_encode(['data' => $rules]);
    }

    public function apiBatchDeleteRule()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);
        ['ids' => $ids] = $payload;

        $this->db->where_in('id', $ids);
        $this->db->delete('accounting_rules');

        $this->resetPriorities();

        header('content-type: application/json');
        echo json_encode(['data' => $ids]);
    }

    public function apiDeleteRule($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
            echo json_encode(['success' => false]);
            return;
        }

        $this->db->where('id', $id);
        $this->db->delete('accounting_rules');

        $this->resetPriorities();

        header('content-type: application/json');
        echo json_encode(['data' => $id]);
    }

    private function resetPriorities()
    {
        $this->db->where('user_id', logged('id'));
        $this->db->select('id');
        $this->db->order_by('priority', 'ASC');
        $rules = $this->db->get('accounting_rules')->result();

        $updates = [];
        foreach ($rules as $key => $rule) {
            $updates[] = ['id' => $rule->id, 'priority' => $key];
        }

        $this->db->update_batch('accounting_rules', $updates, 'id');
        return $updates;
    }

    public function apiEditRulePriorities()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);
        $this->db->update_batch('accounting_rules', $payload, 'id');

        header('content-type: application/json');
        echo json_encode(['data' => $payload]);
    }

    public function apiGetRule($id)
    {
        $this->db->where('id', $id);
        $rule = $this->db->get('accounting_rules')->row();

        if (!is_null($rule)) {
            $this->db->where('rules_id', $rule->id);
            $rule->conditions = $this->db->get('accounting_rules_conditions')->result();

            $this->db->where('rule_id', $rule->id);
            $rule->assignments = $this->db->get('accounting_rule_assignments')->result();
        }

        header('content-type: application/json');
        echo json_encode(['data' => $rule]);
    }
}
