<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Madmin extends CI_Model
{

    function create_data($tabel, $data)
    {
        $this->db->insert($tabel, $data);
    }

    function get_data($coloum, $where, $tabel)
    {
        $this->db->where($coloum, $where);
        $data = $this->db->get($tabel);
        if ($data->num_rows() > 0) {
            return $data->row();
        }
        return null;
    }
    function get_threewhere($coloum, $where, $coloum2, $where2, $coloum3, $where3, $tabel)
    {
        $this->db->where($coloum, $where);
        $this->db->where($coloum2, $where2);
        $this->db->where($coloum3, $where3);
        $data = $this->db->get($tabel);
        if ($data->num_rows() > 0) {
            return $data->row();
        }
        return null;
    }
    function getpenerima($tabel, $coloum, $where)
    {
        $this->db->select('*');
        $this->db->like($coloum, $where);
        $data = $this->db->get($tabel);
        if ($data->num_rows() > 0) {
            return $data->result();
        }
        return null;
    }
    function get_data_all($tabel, $orderby, $conf)
    {
        $this->db->order_by($orderby, $conf);
        $data = $this->db->get($tabel);
        if ($data->num_rows() > 0) {
            return $data->result();
        }
        return null;
    }

    function get_data_join3($tabel, $tabel2, $tabel3, $join, $join2, $orderby, $conf)
    {
        $this->db->join($tabel2, $join);
        $this->db->join($tabel3, $join2);
        $this->db->order_by($orderby, $conf);
        $data = $this->db->get($tabel);
        if ($data->num_rows() > 0) {
            return $data->result();
        }
        return null;
    }
    function get_data_join4($tabel, $tabel2, $tabel3, $tabel4)
    {
        $data = $this->db->query("SELECT a.*,b.*,c.*,d.total_angsuran from $tabel as a left join $tabel2 as b 
        on a.id_barang=b.id_barang Left join $tabel3 as c on a.id_pelanggan=c.id_pelanggan
        left join $tabel4 as d on a.id_kredit=d.id_kredit
        order by a.id_kredit DESC
        ");
        if ($data->num_rows() > 0) {
            return $data->result();
        }
        return null;
    }
    function get_data_row($coloum, $where, $tabel, $tabel2, $tabel3, $join, $join2)
    {
        $this->db->join($tabel2, $join);
        $this->db->join($tabel3, $join2);
        $this->db->where($coloum, $where);
        $data = $this->db->get($tabel);
        if ($data->num_rows() > 0) {
            return $data->row();
        }
        return null;
    }
    function get_data_join_strusers($coloum, $where, $tabel, $tabel2, $join, $orderby, $conf)
    {
        $this->db->join($tabel2, $join);
        $this->db->where($coloum, $where);
        $this->db->order_by($orderby, $conf);
        $data = $this->db->get($tabel);
        if ($data->num_rows() > 0) {
            return $data->result();
        }
        return null;
    }
    function get_data_join_str2($coloum, $where, $tgl_awal, $tgl_akhir, $tabel, $tabel2, $join)
    {
        $this->db->join($tabel2, $join);
        $this->db->where($coloum, $where);
        $this->db->where('tgl_awal >=', $tgl_awal);
        $this->db->where('tgl_akhir <=', $tgl_akhir);
        $data = $this->db->get($tabel);
        if ($data->num_rows() > 0) {
            return $data->result();
        }
        return null;
    }
    function get_data_join_str3(
        $coloum,
        $where,
        $coloum2,
        $where2,
        $tgl_awal,
        $tgl_akhir,
        $tabel,
        $tabel2,
        $join
    ) {

        $this->db->where($coloum, $where);
        $this->db->where($coloum2, $where2);
        $this->db->where('tgl_awal >=', $tgl_awal);
        $this->db->where('tgl_akhir <=', $tgl_akhir);
        $this->db->join($tabel2, $join);
        $data = $this->db->get($tabel);
        if ($data->num_rows() > 0) {
            return $data->result();
        }
        return null;
    }

    function get_twojoin($samecoloum, $tabel1, $tabel2)
    {
        $this->db->join($tabel2, $samecoloum);
        $data = $this->db->get($tabel1);
        if ($data->num_rows() > 0) {
            return $data->result();
        }
        return null;
    }
    function get_threejoin($samecoloum, $samecoloum2, $tabel1, $tabel2, $tabel3)
    {
        $this->db->join($tabel2, $samecoloum);
        $this->db->join($tabel3, $samecoloum2);
        $data = $this->db->get($tabel1);
        if ($data->num_rows() > 0) {
            return $data->result();
        }
        return null;
    }
    function get_data_allarray($coloum, $where, $tabel)
    {
        $this->db->where($coloum, $where);
        $data = $this->db->get($tabel);
        if ($data->num_rows() > 0) {
            return $data->result();
        }
        return null;
    }
    function get_data_threewhere($where, $where2, $tabel, $orderby, $conf)
    {
        $this->db->join('frm_usr_tugas', 'frm_usr_laporan.id_usr_tugas=frm_usr_tugas.id_user_tugas');
        $this->db->join('frm_create_tugas', 'frm_usr_tugas.id_tugas=frm_create_tugas.id_create_tugas');
        $this->db->where("frm_usr_laporan.id_auth", $where);
        $this->db->where("frm_usr_laporan.id_usr_tugas", $where2);
        $this->db->order_by($orderby, $conf);
        $data = $this->db->get($tabel);
        if ($data->num_rows() > 0) {
            return $data->result();
        }
        return null;
    }
    function get_laporan_earning($tahun)
    {
        $data = $this->db->query("SELECT month(tgl_submit_user) as bulan,
        year(tgl_submit_user)as tahun,sum(keterangan) as totalpengeluaran FROM `frm_usr_tugas` WHERE kirim_saldo=1 and 
        year(tgl_submit_user)='{$tahun}' 
        GROUP By year(tgl_submit_user), month(tgl_submit_user) order by month(tgl_submit_user) desc limit 6");
        if ($data->num_rows() > 0) {
            return $data->result();
        }
        return null;
    }

    function update_data($coloum, $where, $data, $tabel)
    {
        $this->db->where($coloum, $where);
        $this->db->update($tabel, $data);
    }

    function delete($coloum, $where, $tabel)
    {
        $this->db->where($coloum, $where);
        $this->db->delete($tabel);
    }
}
