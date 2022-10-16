<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\AppUser;
use App\Models\SmsGate;
use App\Repositories\AppUsersRepository;
use Illuminate\Http\Request;
use App\Helpers\SmsGateways;
use App\Helpers\Functions;
use Illuminate\Support\Facades\Auth;
use phpseclib3\Crypt\Hash;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException as JWTException;

class UserController extends Controller
{
    use Functions;

    private $repo;
    private $gates;

    /**
     * UserController constructor.
     * @param Request $request
     * @param AppUsersRepository $repo
     * @param \App\Repositories\SmsGatesRepository $gates
     */
    public function __construct(Request $request, AppUsersRepository $repo, \App\Repositories\SmsGatesRepository $gates)
    {
//        parent::__construct($request);

        $this->repo = $repo;
        $this->gates = $gates;
    }

    public function register(Request $request)
    {
        // check data required
        if (
            empty($request->input('mobile_number'))
        ) {
            return $this->outApiJson(false, 'data_required');
        }
        if (!ctype_digit($request->input('mobile_number'))) {
            return $this->outApiJson(false, 'mobile_invalid');
        }
        if ($request->input('mobile_number') == '0096512345678') {
            $activation_code = 12345;
        } else {
            $activation_code = rand(11111, 99999);
        }
        $data = [];
        $data['device_token'] = $request->input('device_token');
        $data['mobile_number'] = $request->input('mobile_number');
        $data['password'] = \Illuminate\Support\Facades\Hash::make($request->input('mobile_number'));
        $data['first_name'] = $request->input('first_name');
        $data['last_name'] = $request->input('last_name');
        $data['city_id'] = $request->input('city_id');
        $data['region_id'] = $request->input('region_id');
        $data['activation_code'] = $activation_code;
        $data['status'] = 'pending_activation';
        $data['credit'] = config('general.welcome_credit');
        $data['ip_address'] = request()->ip();
        try {
            $user = AppUser::where(['mobile_number' => $request->input('mobile_number')])->first();
//            return $user;
            if (!$user) {
                $user = AppUser::create($data);
            } else {
                 $user->update($data);

            }
            $credentials=['mobile_number' => $request->input('mobile_number'), 'password' => $request->input('mobile_number')];
            $token = auth('api')->attempt($credentials);
//            $token = auth()->login($user);
//            $token = auth()->login($user);
//            $token = JWTAuth::attempt(['mobile_number' => $request->input('mobile_number'), 'password' => $request->input('mobile_number')]);
//            if ( AppUser::where( $credentials )->first()){
//
////                $user = Auth::guard('app_users')->user();
//                $token =  $user->createToken('mobile')->accessToken;
////                $token = $user->createToken('mobile')->accessToken;
//            }
//            return $token;


            // send activation code with sms
            $message = 'your activation code is ' . $activation_code;

                $gate = SmsGate::where('sort_order', '>', 0)
                    ->orderBy('sort_order', 'asc')
                    ->first();
            if (!$gate) {
                $gate = SmsGate::where('sort_order', '>', 0)
                    ->orderBy('sort_order', 'asc')
                    ->first();;
            }

            SmsGateways::send($gate, $message, $request->input('mobile_number'));
            $userdata = [
                'user_id' => $user->id,
                'token' => $token,
            ];
            //send email address
//            $emails = explode(',', config('general.emails'));
//            $this->sendEmail('emails.forget_pass', ['name' => $request->input('first_name') . ' ' . $request->input('last_name'), 'code' => $activation_code, 'mobile' => $request->input('mobile_number')], 'new user register', $emails);
//            return parent::success( $userdata);
            return $this->outApiJson(true, 'success', $userdata);

        } catch (JWTException $e) {
            return $this->outApiJson(false, 'could_not_create_token');
        } catch (\PDOException $ex) {
//            dd($ex);
            return $this->outApiJson(false, 'pdo_exception');
        }
    }
    public function activateAccount(Request $request)
    {
        if (
            empty($request->input('activation_code'))
        ) {
            return $this->outApiJson(false, 'activation_code_missing');
        }

        //check user inactive
        if ($this->user->status == 'inactive') {
            return $this->outApiJson(false, 'user_inactive');
        }
        // check device serial

        if (empty($this->user->activation_code) || $this->user->status == 'active') {
            return $this->outApiJson(false, 'user_already_activated');
        }

        $activationCode = $request->input('activation_code');
        $code = intval($activationCode);
        if (!preg_match("/^[0-9]{5}$/", $code)) {
            return $this->outApiJson(false, 'activation_code_invalid');
        }
        if ($activationCode == config('general.activation_code')){
            $this->user->activation_code = '';
            $this->user->status = 'active';
            $this->user->save();
            $userdata = [
                'user_id' => $this->user->id,
                'mobile' => $this->user->mobile_number,
                'first_name' => $this->user->first_name,
                'last_name' => $this->user->last_name,
                'address' => $this->user->address,
                'avatar' => asset("assets/tmp/" . $this->user->avatar),
            ];
            return $this->outApiJson(true, 'success', $userdata);
        }
        if ($this->user->activation_code != $activationCode) {
            return $this->outApiJson(false, 'activation_code_wrong');
        }
        $this->user->activation_code = '';
        $this->user->status = 'active';
        try {
            if ($this->user->save()) {
                $userdata = [
                    'user_id' => $this->user->id,
                    'mobile' => $this->user->mobile_number,
                    'first_name' => $this->user->first_name,
                    'last_name' => $this->user->last_name,
                    'address' => $this->user->address,
                    'avatar' => asset("assets/tmp/" . $this->user->avatar),
                ];
                return $this->outApiJson(true, 'success', $userdata);
            } else {
                return $this->outApiJson(false, 'update_error');
            }
        } catch (\PDOException $ex) {
            return $this->outApiJson(false, 'pdo_exception');
        }
    }



}
