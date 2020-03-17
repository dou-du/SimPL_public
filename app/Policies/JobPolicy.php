<?php

namespace App\Policies;

use App\User;
use App\Job;
use App\Policy;
use Illuminate\Auth\Access\HandlesAuthorization;

class JobPolicy
{
	use HandlesAuthorization;

	public function create(User $user){
		$policy = Policy::where('type',$user->policy)->first();
		return $policy->own_data_create == 1;
	}
	public function read(User $user,$data){
		$policy = Policy::where('type',$user->policy)->first();
		if($data->author == $user->id){
			return $policy->own_data_read == 1;
		}else{
			return $policy->oth_data_read == 1;
		}
	}
	public function update(User $user,$data){
		$policy = Policy::where('type',$user->policy)->first();
		if($data->author == $user->id){
			return $policy->own_data_update == 1;
		}else{
			return $policy->oth_data_update == 1;
		}
	}
	public function delete(User $user,$data){
		$policy = Policy::where('type',$user->policy)->first();
		if($data->author == $user->id){
			return $user->policy === 'admin' || $user->policy === 'editor';
		}else{
			return $user->policy === 'admin';
		}
	}
}
