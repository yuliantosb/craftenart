<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
	public $fillable = ['*'];

    public function details()
    {
    	return $this->hasMany('App\OrderDetails');
    }

    public function ship()
    {
    	return $this->hasOne('App\Ship');
    }

    public function getFullNameAttribute()
	{
	    return "{$this->first_name} {$this->last_name}";
	}

	public function user()
	{
		return $this->belongsTo('App\User', 'user_id');
	}

	public function scopeCountOrder($query)
	{
		// return $query->where('user_id', auth()->user()->id)->where('status', 0)->count();
		return 0;
	}

	public function getStatusTransactionAttribute()
	{
		if ($this->transaction_status == 'capture') {

			if ($this->fraud_status == 'challenge') {

				$status = 'Challenge';
				$label = 'warning';

			} else {

				if ($this->status) {

					$status = 'Complete';
					$label = 'success';

				} else {
					
					$status = 'Processed';
					$label = 'primary';
				}
			}

		} else if ($this->transaction_status == 'settlement') {

			if ($this->status) {

				$status = 'Complete';
				$label = 'success';

			} else {
				$status = 'Processed';
				$label = 'primary';
			}

		} else if ($this->transaction_status == 'pending') {
			$status = 'Pending';
			$label = 'warning';

		} else {
			$status = 'Deny';
			$label = 'danger';
		}

		return collect(['status' => $status, 'label' => $label]);
		// return $status;

	}

	public function scopeCountByType($query, $year, $month, $type)
	{
		return $query->whereYear('payment_date', $year)
					->whereMonth('payment_date', $month)
					->where('payment_type', $type)
					->count();
	}

}
