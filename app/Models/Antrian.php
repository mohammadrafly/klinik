<?php

namespace App\Models;

use CodeIgniter\Model;

class Antrian extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'antrian';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'kode_pasien',
        'kode_pembayaran',
        'kode_kunjungan',
        'nomor_antrian',
        'status',
        'type_antrian',
        'created_at',
        'updated_at'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getLastQueueNumber()
    {
        $today = date('Y-m-d');
        $query = $this->selectMax('nomor_antrian')->where('created_at', $today)->get();
        $row = $query->getRow();

        if ($row && isset($row->nomor_antrian)) {
            return (int) $row->nomor_antrian;
        }

        return 0;
    }

    public function getLastQueueNumberByStatus($status)
    {
        $today = date('Y-m-d');
        $query = $this->selectMax('nomor_antrian')->where('status', $status)->where('created_at', $today)->get();
        $row = $query->getRow();

        if ($row && isset($row->nomor_antrian)) {
            return (int) $row->nomor_antrian;
        }
    }

    public function getQueueByKodePasien($kodePasien)
    {
        return $this->where('created_at', date('Y-m-d'))->where('kode_pasien', $kodePasien)->get()->getRow();
    }

    function getDetails($id)
    {
        return $this->db->table('antrian')
                    ->select('
                        users.name as nama_lengkap,
                        users.*,
                        antrian.*,
                        antrian.id as id_antrian,
                    ')
                    ->join('users', 'antrian.kode_pasien = users.kode_user')
                    ->where('antrian.id', $id)
                    ->get()->getResultArray();
    }

    public function getForPembayaran()
    {
        return $this->db->table('antrian')
            ->select('
                item.*,
                obat.*,
                antrian.*,
                users.name as nama_lengkap
            ')
            ->join('users', 'antrian.kode_pasien = users.kode_user')
            ->join('item', 'antrian.kode_kunjungan = item.kode_kunjungan')
            ->join('obat', 'item.kode_obat = obat.kode_obat')
            ->where('antrian.status', 'pembayaran')
            ->where('antrian.created_at', date('Y-m-d'))
            ->get()
            ->getResultArray();
    }

    public function getForPembayaranByKode($kode)
    {
        return $this->db->table('antrian')
            ->select('
                item.*,
                obat.*,
                antrian.*,
                users.name as nama_lengkap
            ')
            ->join('users', 'antrian.kode_pasien = users.kode_user')
            ->join('item', 'antrian.kode_kunjungan = item.kode_kunjungan')
            ->join('obat', 'item.kode_obat = obat.kode_obat')
            ->where('antrian.kode_kunjungan', $kode)
            ->get()
            ->getResultArray();
    }
}
