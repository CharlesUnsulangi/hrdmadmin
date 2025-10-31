<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MsEmployee extends Model
{
    protected $table = 'ms_employee';
    protected $primaryKey = 'emp_id';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'rec_usercreated',
        'rec_userupdate',
        'rec_datecreated',
        'rec_dateupdate',
        'rec_status',
        'emp_id',
        'emp_iddivision',
        'emp_name',
        'emp_inactive',
        'emp_subdivision',
        'emp_upahpokok',
        'emp_tunjangan',
        'emp_datejoin',
        'emp_dateresign',
        'emp_born',
        'emp_nokontrak',
        'emp_expdatekontrak',
        'emp_numkontrak',
        'emp_npwp',
        'emp_bank',
        'emp_norek',
        'emp_address',
        'emp_idktp',
        'emp_kotalahir',
        'emp_childno',
        'emp_namaistri',
        'emp_jamsostek',
        'emp_includepajak',
        'emp_telp',
        'emp_lastedu',
        'emp_lastcom',
        'emp_telplastcom',
        'emp_lastjabatan',
        'emp_lastsalary',
        'emp_cutitotal',
        'emp_com',
        'emp_status',
        'emp_religion',
        'emp_citizen',
        'emp_desc',
        'emp_levelclass',
        'emp_leveljabatan',
        'emp_lastjobdesk',
        'emp_apprlast',
        'emp_gender',
        'emp_typepayroll',
        'emp_reason_nonactive',
        'emp_aksesuser',
        'emp_email',
        'emp_statuskaryawan',
        'card_id',
        'emp_no_drt',
        'emp_name_drt',
        'emp_akn_fb',
        'emp_akn_ig',
        'emp_last_contract',
        'emp_state_appr',
        'emp_nik',
    ];
}
