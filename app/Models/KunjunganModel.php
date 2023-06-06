<?php

namespace App\Models;

use CodeIgniter\Model;

class KunjunganModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'kunjungan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'kode_kunjungan',
        'kode_pasien',
        'kode_dokter',
        'keluhan_utama',
        'riwayat_penyakit_sekarang',
        'riwayat_penyakit_dahulu',
        'keadaan_umum_pasien',
        'keterangan_penunjang',
        'diagnosa',
        'tindakan',
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

    public function getRekamMedis()
    {
        return $this->db->table('kunjungan')
            ->select('
                users.*,
                tandavital.*,
                antrian.*,
                item.*,
                kunjungan.*,
            ')
            ->join('users', 'kunjungan.kode_pasien = users.kode_user')
            ->join('tandavital', 'kunjungan.kode_kunjungan = tandavital.kode_kunjungan')
            ->join('antrian', 'kunjungan.kode_kunjungan = antrian.kode_kunjungan')
            ->join('item', 'kunjungan.kode_kunjungan = item.kode_kunjungan')
            ->where('antrian.status', 'selesai')
            ->get()
            ->getResultArray();
    }

    public function findAllAssociate()
    {
        return $this->db->table('kunjungan')
        ->select('
            users.*,
            item.*,
            obat.*,
            kunjungan.*,
            antrian.*
        ')
        ->join('antrian', 'kunjungan.kode_kunjungan = antrian.kode_kunjungan')
        ->join('users', 'kunjungan.kode_pasien = users.kode_user')
        ->join('item', 'kunjungan.kode_kunjungan = item.kode_kunjungan')
        ->join('obat', 'item.kode_obat = obat.kode_obat')
        ->where('antrian.status', 'selesai')
        ->get()
        ->getResultArray();
    }
}
