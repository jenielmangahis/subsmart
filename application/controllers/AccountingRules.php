<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AccountingRules extends MY_Controller
{
    public function apiSaveRule()
    {
        header('content-type: application/json');

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

        $this->db->db_debug = false;
        $savedRule = $this->db->insert('accounting_rules', $payload);

        if (!$savedRule) {
            $error = $this->db->error();
            echo json_encode([
                'error' => $error,
                'success' => false,
                'message' => $error['code'] === 1062 ? 'Duplicate name.' : 'Something went wrong.',
            ]);
            return;
        }

        $this->db->where('id', $this->db->insert_id());
        $newRule = $this->db->get('accounting_rules')->row();

        $conditions = array_map(function ($condition) use ($newRule) {
            $condition['rule_id'] = $newRule->id;
            return $condition;
        }, $conditions);
        $this->db->insert_batch('accounting_rules_conditions', $conditions);

        $assignments = array_map(function ($assignment) use ($newRule) {
            $assignment['rule_id'] = $newRule->id;
            return $assignment;
        }, $assignments);
        $this->db->insert_batch('accounting_rule_assignments', $assignments);

        echo json_encode(['data' => $newRule]);
    }

    public function apiGetRules()
    {
        header('content-type: application/json');
        echo json_encode(['data' => $this->getRules()]);
    }

    private function getRules()
    {
        $this->db->where('user_id', logged('id'));
        $this->db->order_by('priority', 'ASC');
        $rules = $this->db->get('accounting_rules')->result();

        foreach ($rules as $rule) {
            $this->db->where('rule_id', $rule->id);
            $rule->conditions = $this->db->get('accounting_rules_conditions')->result();

            $this->db->where('rule_id', $rule->id);
            $rule->assignments = $this->db->get('accounting_rule_assignments')->result();
        }

        return $rules;
    }

    public function apiEditRule($id)
    {
        header('content-type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);

        if (!array_key_exists('conditions', $payload) &&
            !array_key_exists('conditions', $payload)) {
            $this->db->where('id', $id);
            $this->db->update('accounting_rules', $payload);

            $this->db->where('id', $id);
            $record = $this->db->get('accounting_rules')->row();
            echo json_encode(['data' => $record]);
            return;
        }

        // Remove unsupported columns on `accounting_rules` table.
        ['conditions' => $conditions, 'assignments' => $assignments] = $payload;
        unset($payload['conditions']);
        unset($payload['assignments']);

        $separate = function ($data) use ($id) {
            $default = ['new' => [], 'existing' => []];
            return array_reduce($data, function ($carry, $currData) use ($id) {
                $currData['rule_id'] = $id;
                $hasId = array_key_exists('id', $currData);
                $carry[$hasId ? 'existing' : 'new'][] = $currData;
                return $carry;
            }, $default);
        };

        $this->db->where('id', $id);
        $this->db->update('accounting_rules', $payload);

        ['new' => $newConditions, 'existing' => $existingConditions] = $separate($conditions);
        ['new' => $newAssignments, 'existing' => $existingAssignments] = $separate($assignments);

        if (!empty($newConditions)) {
            $this->db->insert_batch('accounting_rules_conditions', $newConditions);
        }
        if (!empty($existingConditions)) {
            $this->db->update_batch('accounting_rules_conditions', $existingConditions, 'id');
        }

        if (!empty($newAssignments)) {
            $this->db->insert_batch('accounting_rule_assignments', $newAssignments);
        }
        if (!empty($existingAssignments)) {
            $this->db->update_batch('accounting_rule_assignments', $existingAssignments, 'id');
        }

        $this->db->where('id', $id);
        $record = $this->db->get('accounting_rules')->row();
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

        if (count($updates) <= 0) {
            return [];
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
            $this->db->where('rule_id', $rule->id);
            $rule->conditions = $this->db->get('accounting_rules_conditions')->result();

            $this->db->where('rule_id', $rule->id);
            $rule->assignments = $this->db->get('accounting_rule_assignments')->result();
        }

        header('content-type: application/json');
        echo json_encode(['data' => $rule]);
    }

    public function apiExportRules()
    {
        $storePath = FCPATH . 'uploads/rulesxlsx/';
        if (!file_exists($storePath)) {
            mkdir($storePath, 0777, true);
        }

        $rules = $this->getRules();
        $results = [];

        foreach ($rules as $rule) {
            $result = [];
            $result['name'] = $rule->rules_name;
            $conditions = [];
            $actions = [];

            foreach ($rule->conditions as $condition) {
                $conditions[] = [
                    'type' => $condition->description,
                    'equation' => $condition->contain,
                    'value' => $condition->comment,
                ];
            }

            foreach ($rule->assignments as $assignment) {
                $actions[] = [
                    'type' => $assignment->type,
                    'percentage' => $assignment->percentage,
                    'value' => $assignment->value,
                ];
            }

            $result['conditions'] = json_encode($conditions);
            $result['actions'] = json_encode($actions);
            $results[] = $result;
        }

        require_once FCPATH . 'packages/xlsxwriter/xlsxwriter.class.php';
        $fileName = md5(uniqid(logged('id'), true)) . '.xlsx';
        $filePath = $storePath . '/' . $fileName;
        $sheetname = 'Worksheet';
        $header = [
            'Rule Name' => 'string',
            'Rule Conditions' => 'string',
            'Rule Outputs' => 'string',
        ];

        $writer = new XLSXWriter();
        $writer->writeSheetHeader($sheetname, $header);
        $writer->writeSheet($results, $sheetname);
        $writer->writeToFile($filePath);

        if (file_exists($filePath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filePath));
            readfile($filePath);
            unlink($filePath);
            exit;
        }
    }

    public function apiPrepare()
    {
        header('content-type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $files = $_FILES['files'];
        $count = count($files['name']);

        if ($count !== 1) {
            echo json_encode(['success' => false, 'message' => 'No file']);
            return;
        }

        require_once FCPATH . 'packages/simplexlsx/src/SimpleXLSX.php';

        $file = $files['tmp_name'][0];
        $xlsx = new SimpleXLSX($file);
        if (!$xlsx->success()) {
            echo json_encode(['success' => false, 'message' => 'Parsing failed']);
            return;
        }

        $headers = [];
        $rows = [];

        foreach ($xlsx->rows() as $key => $row) {
            if ($key === 0) {
                $headers = $row;
                continue;
            }

            $rows[] = array_combine($headers, $row);
        }

        $validHeaders = [
            'Rule Name',
            'Rule Conditions',
            'Rule Outputs',
        ];

        if ($headers !== $validHeaders) {
            echo json_encode(['success' => false, 'message' => 'Invalid header format']);
            return;
        }

        $rowsDecoded = [];
        $hasError = false;
        foreach ($rows as $row) {
            if ($hasError) {
                break;
            }

            $conditions = [];
            if (!empty($row['Rule Conditions'])) {
                $conditions = json_decode($row['Rule Conditions']);

                if (is_null($conditions)) {
                    $hasError = true;
                }
            }

            $outputs = [];
            if (!empty($row['Rule Outputs'])) {
                $outputs = json_decode($row['Rule Outputs']);

                if (is_null($outputs)) {
                    $hasError = true;
                }
            }

            $row['Rule Conditions'] = $conditions;
            $row['Rule Outputs'] = $outputs;
            array_push($rowsDecoded, $row);
        }

        if ($hasError) {
            echo json_encode(['success' => false, 'message' => 'Invalid row format']);
            return;
        }

        echo json_encode(['success' => true, 'data' => $rowsDecoded]);
    }

    public function apiImportRules()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['success' => false]);
            return;
        }

        $payload = json_decode(file_get_contents('php://input'), true);
        ['rules' => $rules] = $payload;

        $failed = [];
        $success = [];

        $this->db->where('user_id', logged('id'));
        $this->db->select_max('priority', 'value');
        $maxPrio = $this->db->get('accounting_rules')->row();
        $maxPrio = is_null($maxPrio->value) ? 0 : ((int) $maxPrio->value) + 1;

        $this->db->db_debug = false;

        foreach ($rules as $rule) {
            $newRule = $this->db->insert('accounting_rules', [
                'user_id' => logged('id'),
                'rules_name' => $rule['Rule Name'],
                'priority' => $maxPrio,
            ]);

            if (!$newRule) {
                $failed[] = $rule;
                continue;
            }

            $maxPrio += 1;
            $success[] = $rule;
            $newRuleId = $this->db->insert_id();

            if (array_key_exists('Rule Conditions', $rule) && is_array($rule['Rule Conditions'])) {
                $conditions = array_map(function ($condition) use ($newRuleId) {
                    return [
                        'rule_id' => $newRuleId,
                        'description' => $condition['type'],
                        'contain' => $condition['equation'],
                        'comment' => $condition['value'],
                    ];
                }, $rule['Rule Conditions']);

                if (count($conditions) > 0) {
                    $this->db->insert_batch('accounting_rules_conditions', $conditions);
                }
            }

            if (array_key_exists('Rule Outputs', $rule) && is_array($rule['Rule Outputs'])) {
                $assignments = array_map(function ($assignment) use ($newRuleId) {
                    return [
                        'rule_id' => $newRuleId,
                        'type' => $assignment['type'],
                        'value' => $assignment['value'],
                        'percentage' => $assignment['percentage'],
                    ];
                }, $rule['Rule Outputs']);

                if (count($conditions) > 0) {
                    $this->db->insert_batch('accounting_rule_assignments', $assignments);
                }
            }
        }

        echo json_encode(['failed' => $failed, 'success' => $success]);
    }
}
