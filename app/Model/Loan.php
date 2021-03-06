<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $table = 'loans';
    protected $fillable = [
        'account_id',
        'cycle',
        'loan_amount',
        'rate',
        'interest',
        'terms',
        'date_applied',
        'date_approved',
        'date_maturity',
        'payment_mode_id',
        'loan_level_id',
        'loan_status_id',
        'first_payment',
        'grace',
        'date_release',
        'irr_rate',
        'approved_by',
        'override_user'
    ];

    // public function accounts()
    // {
    //     return $this->hasOne('App\Model\Account', 'id', 'account_id');
    // }

    // public function paymentMode()
    // {
    //     return $this->hasOne('App\Model\PaymentMode', 'id', 'payment_mode_id');
    // }

    // public function loanLevel()
    // {
    //     return $this->hasOne('App\Model\LoanLevel', 'id', 'loan_level_id');
    // }

    // public function loanStatus()
    // {
    //     return $this->hasOne('App\Model\LoanStatus', 'id', 'loan_status_id');
    // }

    // public function approvedBy()
    // {
    //     return $this->hasOne('App\Model\User', 'id', 'approved_by');
    // }

    // public function ovverideBy()
    // {
    //     return $this->hasOne('App\Model\User', 'id', 'override_user');
    // }
}
