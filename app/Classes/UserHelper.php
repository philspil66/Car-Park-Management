<?php namespace App\Classes;

use Log;
use Carbon\Carbon;
use App\Models\EventModel;

use App\Models\UserModel;
use App\Models\AddressModel;


use phpDocumentor\Reflection\Types\Object_;
use Validator;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class UserHelper extends EST
{

    /**
     *   validateUserInput
     *   Validates all inputs sent back to controller
     * @param      array $input Input form fields
     * @return    object      Validator
     * @author     Keni Williams <kenneth.williams@estuk.co.uk>
     */

    public static function validateAddEditUserInput($input)
    {
        //
        $rules = [
            'user_role' => 'required',
            'email' => 'required|email',
            'email.min' => '255'
        ];
        $messages = [
            'user_role' => 'Role as not been selected',
            'email' => 'Email is not valid'
        ];
//        $customAttributes = [
//
//        ];
        $isValid = Validator::make(
            $input,
            $rules,
            $messages
//            $customAttributes
        );

        return $isValid;
    }

    /**
     * Get raw users data for datatables (e.g. /admin/users)
     *
     * @return Array
     */

    public static function getAllUsers()
    {

        $users_all = array();

        $search_column = Input::get('search_column');
        $search_term = Input::get('search');
        $search_term = $search_term['value'];

        $users = DB::table('users')
            ->leftjoin('addresses', 'addresses.id', '=', 'users.address_id')
            ->leftjoin('roles', 'roles.id', '=', 'users.role_id')
            ->leftjoin('roles_lang', 'roles_lang.role_id', '=', 'roles.id')
            ->selectRaw('users.id
                        , addresses.postcode
                        , users.firstname
                        , users.lastname
                        , users.email
                        , roles_lang.name as role'
            )
            ->orderBy('users.created_at');

        // add optional where clause if 'search_column' parameter is set
        if ($search_column != '') {
            if ($search_column == 'role') {
                $search_column = 'roles_lang.name';
            }
            $users = $users->where($search_column, 'like', '%' . $search_term . '%');
        }

        /**
         * @todo REMOVE THIS OR YOU wILL ONLY SEE 100 RESULTS
         */
        $users->take(100);

        $users = $users->get();

        foreach ($users as $user) {
            $user->firstname = (isset($user->firstname)) ? mb_strtolower($user->firstname, 'UTF8') : '';
            $user->lastname = (isset($user->email)) ? mb_strtolower($user->lastname, 'UTF8') : '';
            $user->email = (isset($user->email)) ? mb_strtolower($user->email, 'UTF8') : '';
            $user->role = (isset($user->role)) ? mb_strtolower($user->role, 'UTF8') : '';
            $users_all[$user->id] = $user;
        }
        return $users_all;
    }

    /**
     *   getUsersAddresses
     *   Gets all addresses owned by user
     * @param      int $user_id User id
     * @returns    object      $addresses      Returns an object of addresses
     * @author     Keni Williams <kenneth.williams@estuk.co.uk>
     */

    public static function getUsersAddresses($user_id)
    {
        $addresses = DB::table('users')
            ->join('addresses', 'users.address_id', '=', 'addresses.id')
            ->select(
                'addresses.id',
                'addresses.address1',
                'addresses.address2',
                'addresses.postcode',
                'addresses.town',
                'addresses.county',
                'addresses.country',
                'addresses.status'
            )
            ->where('users.id', '=', $user_id);
        $addresses = $addresses->get();
        return $addresses;
    }

    /**
     *   getAllCarParkOwners
     *   Reads all car park owners from the users table
     * @param int $carParkId Currrent carpark id
     * @return object $carParkOwners      Returns an object of car park owners.
     * @author     Keni Williams <kenneth.williams@estuk.co.uk>
     */

    public static function getAllCarParkOwners(int $carParkId = null)
    {
        $currentOwner = new Object_();
        $owners = DB::table('users')
            ->leftJoin('roles', 'users.role_id', '=', 'roles.id')
            ->leftJoin('roles_lang', 'roles_lang.role_id', '=', 'roles.id')
            ->select(
                'users.id', 'users.firstname', 'users.lastname', 'users.email', 'roles_lang.name'
            )
//            ->where(
//                'roles_lang.language_id','=','1'
//            )
            ->whereRaw(
                "roles_lang.name='Car Park Owner'"
            );

        $carParkOwners = $owners->get();

        $ownersArray = [];
        foreach ($carParkOwners as $owner) {
            $ownersArray[$owner->id] = $owner->firstname . ' ' . $owner->lastname;
        }
        if ($carParkId != null) {
            $ownerTable = DB::table('car_park_owners')
                ->select('user_id')
                ->where('car_park_id', '=', $carParkId)->first();
            $currentOwner = ($ownerTable)?$ownerTable->user_id:null;
        }
        return ['owners' => $ownersArray, 'owner' => $currentOwner];
    }
}