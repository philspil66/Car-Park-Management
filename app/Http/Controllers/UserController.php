<?php

namespace App\Http\Controllers;

use App\Classes\Role;
use App\Classes\UserHelper;
use App\Models\AddressModel;
use App\models\RoleModel;
use App\Models\UserModel;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\User;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class UserController extends EstController
{
    public function impersonate()
    {

        $data_ok = false;
        if (Input::get('order_id')) {

            $order_id = Input::get('order_id');
            $Order = \App\Models\OrderModel::find($order_id);

            if ($Order && $Order->user_id) {
                $user = User::find($Order->user_id);
                $data_ok = true;
            }

        } elseif (Input::get('user_id')) {

            $user = User::find(Input::get('user_id'));
            if ($user) {
                $data_ok = true;
            }

        }

        if ($data_ok) {

            // Guard against administrator impersonate
            if (!$user->isAdministrator()) {
                \Auth::user()->setImpersonating($user->id);
            } else {
                return redirect()->back();
            }
        }

        return Redirect::to('/account');
    }

    public function stopImpersonate()
    {
        \Auth::user()->stopImpersonating();
        return Redirect::to('/');
    }

    /**
     *  addAmendForm
     *  Populates form if the user exists else creates a blank form to populate
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @author     Keni Williams <kenneth.williams@estuk.co.uk>
     */

    public function addAmendForm()
    {
        $userId = Input::get('id');


        try {
            //list roles for use in the roles option
            $roles = Role::getAllRoles();
            //default form array
            $addAmendForm = [
                'mode' => 'Edit',
                'userId' => '',
                'firstname' => '',
                'lastname' => '',
                'telephone' => '',
                'role_id' => '',
                'email' => '',
                'roles' => $roles,
                'status' => 'active',
                'addresses' => [
                    'address1' => '',
                    'address2' => '',
                    'postcode' => '',
                    'town' => '',
                    'county' => '',
                    'country' => ''
                ]
            ];

            if ($userId) { // is Edit
                $addAmendForm['mode'] = 'Edit';
                $User = UserModel::find($userId);

                // build addresses array
                $addressesRaw = UserHelper::getUsersAddresses($userId);
                $addresses = [
                    'address1' => '',
                    'address2' => '',
                    'postcode' => '',
                    'town' => '',
                    'county' => '',
                    'country' => ''
                ];
                foreach ($addressesRaw as $address) {
                    $addresses["address_id"] = $address->id;
                    $addresses["address1"] = $address->address1;
                    $addresses["address2"] = $address->address2;
                    $addresses["postcode"] = $address->postcode;
                    $addresses["town"] = $address->town;
                    $addresses["county"] = $address->county;
                    $addresses["country"] = $address->country;
                    $addresses["status"] = $address->status;
                }

                // merge addresses with the form array
                $addAmendForm = array_merge($addAmendForm, [
                    'mode' => 'Edit',
                    'userId' => $userId,
                    'firstname' => $User->firstname,
                    'lastname' => $User->lastname,
                    'email' => $User->email,
                    'telephone' => $User->telephone,
                    'status' => $User->status,
                    'role_id' => $User->role_id,
                    'addresses' => (sizeof((array)$addresses) > 0) ? (array)$addresses : []
                ]);
//                dd($addAmendForm);

            } else { // Add user
                $addAmendForm['mode'] = 'Add';
            }
//            dd($addAmendForm);
        } catch (\Exception $ex) {
            \Log::info('Error in Add / Amend Form (Users). ' . __FILE__ . ' line ' . __LINE__ . ' --> ' . $ex->getMessage());
            Session::flash('error', 'Error in Add / Amend Form (Users).');
            die($ex->getMessage());
        }

        return view('admin.users.users-add-edit', compact('addAmendForm'));
    }

    /**
     *   addAmendUser
     *   Updates or Inserts a New or Existing user
     * @returns          Redirect::to(/admin/users/add-edit/?id=' . $userId)
     * @author     Keni Williams <kenneth.williams@estuk.co.uk>
     */

    public function addAmendUser()
    {

        $inputs = Input::all();
        // validate the input
        $validator = UserHelper::validateAddEditUserInput($inputs);
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors($validator);
        }
        try {
            $userId = Input::get('user_id');

            if ($userId) { // user exists so update the records
                $action = 'updated';
                // User model
                $User = UserModel::find($userId);
                $User->firstname = $inputs['user_firstname'];
                $User->lastname = $inputs['user_lastname'];
                $User->email = $inputs['email'];
                $User->role_id = $inputs['user_role'];
                $User->telephone = $inputs['telephone'];
                $User->status = $inputs['status'];
                $User->save();
                $addressId = $inputs['address_id'];
                $UserAddress = AddressModel::find($addressId);

                $UserAddress->address1 = $inputs['address1'];
                $UserAddress->address2 = $inputs['address2'];
                $UserAddress->postcode = $inputs['postcode'];
                $UserAddress->town = $inputs['town'];
                $UserAddress->county = $inputs['county'];
                $UserAddress->country = $inputs['country'];

                $UserAddress->save();
            } else { // user does not exist so insert the records
                $action = 'inserted';
                //insert address first to get the address_id

                $addressId = DB::table('addresses')
                    ->insertGetId([
                        'address1' => $inputs['address1'],
                        'address2' => $inputs['address2'],
                        'postcode' => $inputs['postcode'],
                        'town' => $inputs['town'],
                        'county' => $inputs['county'],
                        'country' => $inputs['country']
                    ]);

                $userId = DB::table('users')
                    ->insertGetId([
                        'firstname' => $inputs['user_firstname'],
                        'lastname' => $inputs['user_lastname'],
                        'address_id' => $addressId,
                        'email' => $inputs['email'],
                        'telephone' => $inputs['telephone'],
                        'role_id' => $inputs['user_role'],
                        'status' => $inputs['status']
                    ]);

            }
            Session::flash('success', 'User has been ' . $action . ' successfully.');
            return Redirect::to('/admin/users/add-edit/?id=' . $userId);
        } catch (\Exception $e) {
            \Log::info('Error in Add / Amend User. ' . __FILE__ . ' line ' . __LINE__ . ' --> ' . $e->getMessage());
            Session::flash('error', 'Error in Add / Amend User.');
            die($e->getMessage());
        }
    }
}
