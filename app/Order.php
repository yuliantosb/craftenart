<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use LaraTables;

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

	public function ScopeGetTables()
	{
		return LaraTables::recordsOf(Order::class);
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
			$status = 'Failure';
			$label = 'danger';
		}

		return collect(['status' => $status, 'label' => $label]);
		// return $status;

	}

	public function getTransactionStatusDetailAttribute()
	{
		if ($this->transaction_status == 'capture') {

			if ($this->fraud_status == 'challenge') {

				$status = 'Challenged by FDS';

			} else {

				if ($this->status) {

					$status = 'Order complete';

				} else {
					
					$status = 'Processed by Craftenart';
				}
			}

		} else if ($this->transaction_status == 'settlement') {

			if ($this->status) {

				$status = 'Order Complete';

			} else {
				$status = 'Processed by Craftenart';
			}

		} else if ($this->transaction_status == 'pending') {
			$status = 'Waiting customer to pay';

		} else if ($this->transaction_status == 'expire') {
			$status = 'Order Failure because expire';
		} else {
			$status = 'Order denied';
		}


		return $status;
	}

	public function scopeCountByType($query, $year, $month, $type)
	{
		return $query->whereYear('payment_date', $year)
					->whereMonth('payment_date', $month)
					->where('payment_type', $type)
					->count();
	}

	public function scopeCountOrderStatus($query, $status, $year)
	{
		if ($status == 'complete'){
			$result = $query->where('status', 1)
					->whereYear('payment_date', $year)
					->count();
		}
		else if ($status == 'process'){
			$result = $query->where(function($where) use ($status, $year){
						$where->where('transaction_status', 'settlement')
							->orWhere('fraud_status', 'accept');
					})
					->where('status', 0)
					->whereYear('payment_date', $year)
					->count();
		}
		else if ($status == 'pending'){
			$result = $query->where('transaction_status', 'pending')
					->where('status', 0)
					->whereYear('payment_date', $year)
					->count();
		}
		else if ($status == 'challenge'){
			$result = $query->where('fraud_status', 'challenge')
					->where('status', 0)
					->whereYear('payment_date', $year)
					->count();
		}
		else {
			$result = $query->where(function($where){
						$where->where('transaction_status', 'deny')
							->orWhere('transaction_status', 'expire');
					})
					->where('status', 0)
					->whereYear('payment_date', $year)
					->count();
		}

		return $result;
	}


	public function laratablesNumber()
	{
		return '<p class="text-primary"><a href="'.route('admin.order.show', $this->id).'">'.$this->number.'</a></p>
			<p>
			<a href="'.route('admin.order.show', $this->id).'" class="btn btn-primary btn-xs">View</a>
			<button class="btn btn-danger btn-xs" onClick="on_delete('.$this->id.')">Delete</button>
				
		    <form action="'. route('admin.order.destroy', $this->id) .'" method="POST" id="form-delete-'.$this->id.'" style="display:none">
		        '. method_field('DELETE') .'
		        '. csrf_field() .'
		    </form>

			</p>';
	}

	public function laratablesFirstName()
	{
		return "{$this->first_name} {$this->last_name}";
	}

}
