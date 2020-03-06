<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Friendship extends Model
{
    // friendship that this user started
	protected function friendsOfThisUser()
	{
		return $this->belongsToMany(User::class, 'friendships', 'user_id', 'recipient_id')
		->withPivot('status')
		->wherePivot('status', 'confirmed');
	}

	// friendship that this user was asked for
	protected function thisUserFriendOf()
	{
		return $this->belongsToMany(User::class, 'friendships', 'recipient_id', 'user_id')
		->withPivot('status')
		->wherePivot('status', 'confirmed');
	}

	// accessor allowing you call $user->friends
	public function getFriendsAttribute()
	{
		if ( ! array_key_exists(‘friends’, $this->relations)) $this->loadFriends();
		return $this->getRelation('friends');
	}

	protected function loadFriends()
	{
		if ( ! array_key_exists('friends', $this->relations))
		{
		$friends = $this->mergeFriends();
		$this->setRelation('friends', $friends);
	}
	}

	protected function mergeFriends()
	{
		if($temp = $this->friendsOfThisUser)
		return $temp->merge($this->thisUserFriendOf);
		else
		return $this->thisUserFriendOf;
	}

 
}
