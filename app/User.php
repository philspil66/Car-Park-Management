<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function AllOrders() {
        return $this->hasMany('App\Models\OrderModel', 'user_id')->orderBy('created_at', 'desc');
    }
    public function Address() {
        return $this->belongsTo('App\Models\AddressModel', 'address_id');
    }
    
    /**
     * Returns full name of a user in the form of 'Firstname Lastname'
     *
     * @var string
     * 
     * @author Ayyaz Hussain
     */
    public function getFullname() {

        return $this->firstname. ' ' .$this->lastname;
        
    }

    /**
     * Returns role object for user
     *
     * @var obj
     * 
     * @author Scott Turner
     */
    public function role() {

        return $this->belongsTo('App\Models\RoleModel');   

    }
    
    public function isAdministrator() {    
        return (BOOL)($this && $this->role_id == _ROLE_ADMIN_);
    }
    
    public function setImpersonating($id)
    {
        \Session::put('impersonate', $id);
    }

    public function stopImpersonating()
    {
        $User = User::find(\Session::get('impersonate'));
        \Session::forget('impersonate');
        \Log::info('Impersonating of '.$User->getFullname().' now stopped.');
    }

    public function isImpersonating()
    {
        return \Session::has('impersonate');
    }    

}