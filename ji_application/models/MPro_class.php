<?php

class Mpro_class extends CI_Model
{
    public function getclass() //获取课程全部信息
    {
        $sql = 'SELECT * FROM ji_course_info INNER JOIN ji_course_open WHERE ji_course_info.BSID = ji_course_open.BSID ORDER BY ji_course_info.KCDM';
        $res = $this->db->query($sql);
        return $res->result();
    }

    public function getclasslist() //仅获取课程列表
    {
        $sql = 'SELECT BSID,KCDM FROM ji_course_info ORDER BY KCDM';
        $res = $this->db->query($sql);
        return $res->result();
    }

    public function getapp1() //获取未处理的申请
    {
        $sql = 'SELECT * FROM ji_ta_appinfo WHERE status = 0 ORDER BY app_time';
        $res = $this->db->query($sql);
        return $res->result();
    }

    public function getapp2() //获取已处理的申请,最晚申请者在前
    {
        $sql = 'SELECT * FROM ji_ta_appinfo WHERE NOT status = 0 ORDER BY app_time DESC';
        $res = $this->db->query($sql);
        return $res->result();
    }

    public function Msetstatus($data, $BSID)
    {
        return $this->db->update('ji_course_info', $data, "BSID=$BSID");
    }

    public function Msetcourseinfo($data, $data2, $BSID)
    {
        return $this->db->update('ji_course_info', $data, "BSID=$BSID") && $this->db->update('ji_course_open', $data2, "BSID=$BSID");
    }

    public function Msetappinfo($data, $id)
    {
        return $this->db->update('ji_ta_appinfo', $data, "id=$id");
    }
}