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
}