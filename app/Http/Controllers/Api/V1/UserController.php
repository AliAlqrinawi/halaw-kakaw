<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\AppUser;
use App\Models\Setting;
use App\Models\SmsGate;
use App\Repositories\AppUsersRepository;
use Illuminate\Http\Request;
use App\Helpers\SmsGateways;
use App\Helpers\Functions;
use Illuminate\Support\Facades\Auth;
use phpseclib3\Crypt\Hash;
use App\Http\Controllers\ApiController;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException as JWTException;
use Twilio;

class UserController extends ApiController
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
        $user = auth('api')->user();

        if (empty($user)){
            return $this->outApiJson(false, 'user_not_found');
        }
        if (
            empty($request->input('activation_code'))
        ) {
            return $this->outApiJson(false, 'activation_code_missing');
        }


        //check user inactive
        if ($user->status == 'inactive') {
            return $this->outApiJson(false, 'user_inactive');
        }

        // check device serial

        if (empty($user->activation_code) || $user->status == 'active') {
            return $this->outApiJson(false, 'user_already_activated');
        }

        $activationCode = $request->input('activation_code');
        $code = intval($activationCode);
        if (!preg_match("/^[0-9]{5}$/", $code)) {
            return $this->outApiJson(false, 'activation_code_invalid');
        }

        $activation_code=Setting::where('key_id','activation_code')->first();

        if ($activationCode == $activation_code->value){

            $user->activation_code = '';
            $user->status = 'active';
            $user->save();
            $userdata = [
                'user_id' =>  $user->id,
                'mobile' =>  $user->mobile_number,
                'first_name' =>  $user->first_name,
                'last_name' =>  $user->last_name,
                'address' =>  $user->address,
                'avatar' => asset("assets/tmp/" .  $user->avatar),
            ];
            return $this->outApiJson(true, 'success', $userdata);
        }

        if ($user->activation_code != $activationCode) {
            return $this->outApiJson(false, 'activation_code_wrong');
        }

        $user->activation_code = '';
        $user->status = 'active';
        try {
            if ( $user->save()) {
                $userdata = [
                    'user_id' =>  $user->id,
                    'mobile' =>  $user->mobile_number,
                    'first_name' =>  $user->first_name,
                    'last_name' =>  $user->last_name,
                    'address' =>  $user->address,
                    'avatar' => asset("assets/tmp/" .  $user->avatar),
                ];
                return $this->outApiJson(true, 'success', $userdata);
            } else {
                return $this->outApiJson(false, 'update_error');
            }
        } catch (\PDOException $ex) {
            return $this->outApiJson(false, 'pdo_exception');
        }
    }

    public function resendActivation(Request $request)
    {
        $user = auth('api')->user();

        if (empty($user)){

            return $this->outApiJson(false, 'user_not_found');
        }

//        $mesage=Twilio::message('+201090730088', 'test');
//        dd($mesage);
//        check user inactive
        if ( $user->status == 'inactive') {
            return $this->outApiJson(false, 'user_inactive');
        }

        if (empty( $user->activation_code) ||  $user->status == 'active') {
            return $this->outApiJson(false, 'user_already_activated');
        }
        $activation_code=Setting::where('key_id','activation_code')->first();
        // check user max resend count
        if ( $user->resend_code_count >= $activation_code->value) {
            return $this->outApiJson(false, 'exceed_activition_code');
        }
         $user->status = 'pending_activation';
         $user->resend_code_count =  $user->resend_code_count + 1;
        try {
            if ( $user->save()) {
                $message = 'your activation code is ' .  $user->activation_code;

//                $gate = $this->gates->getNextGate(0);
                $gate = SmsGate::where('sort_order', '>', 0)
                    ->orderBy('sort_order', 'asc')
                    ->first();
                if (!$gate) {
                    $gate = SmsGate::where('sort_order', '>', 0)
                        ->orderBy('sort_order', 'asc')
                        ->first();
                }
                SmsGateways::send($gate, $message,  $user->mobile_number);
                $userdata = [
                    'resend_code_count' =>  $user->resend_code_count,
                ];
                return $this->outApiJson(true, 'success', $userdata);
            } else {
                return $this->outApiJson(false, 'update_error');
            }
        } catch (\PDOException $ex) {
            return $this->outApiJson(false, 'pdo_exception');
        }
    }
    public function updateInfo(Request $request)
    {

        $user = auth('api')->user();

        if (empty($user)){

            return $this->outApiJson(false, 'user_not_found');
        }
        //check user inactive
//        if ( $user->status != 'active') {
//            return $this->outApiJson(false, 'user_inactive');
//        }
         $user->first_name = $request->input('first_name');
         $user->last_name = $request->input('last_name');
         $user->address = $request->input('address');

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $ext = strtolower($file->getClientOriginalExtension());
            if (!in_array($ext, ['gif', 'jpg', 'jpeg', 'png'])) {
                return $this->outApiJson(false, 'allow_extention_error');
            }
            $destinationPath = 'assets/tmp';
            $fileName = md5($file->getClientOriginalName()) . '-' . rand(9999, 9999999) .
                '-' . rand(9999, 9999999) . '.' . $file->getClientOriginalExtension();
            $file->move($destinationPath, $fileName);
             $user->avatar = $fileName;
        }
        try {
            if ( $user->save()) {
                $userdata = [
                    'user_id' =>  $user->id,
                    'mobile' =>  $user->mobile_number,
                    'first_name' =>  $user->first_name,
                    'last_name' =>  $user->last_name,
                    'address' =>  $user->address,
                    'avatar' => asset("assets/tmp/" .  $user->avatar),
                ];
                return $this->outApiJson(true, 'success', $userdata);
            } else {
                return $this->outApiJson(false, 'update_error');
            }
        } catch (\PDOException $ex) {
            return $this->outApiJson(false, 'pdo_exception');
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile(Request $request)
    {

        $user = auth('api')->user();
//        return $user;
        if (empty($user)){

            return $this->outApiJson(false, 'user_not_found');
        }
        if ( $user->status != 'active') {
            return $this->outApiJson(false, 'user_inactive');
        }
        $title = 'title_' . app()->getLocale();
        $region = null;
        if ( $user->addres) {
            if ( $user->addres->regionData) {
                $region = [
                    'id' =>  $user->addres->regionData->id,
                    'title' =>  $user->addres->regionData->$title,
                    'delivery_cost' =>  $user->addres->regionData->delivery_cost,
                    'order_limit' =>  $user->addres->regionData->order_limit,
                ];
            }
        }
        $user_data = [
            'user_id' =>  $user->id,
            'mobile' =>  $user->mobile_number,
            'first_name' =>  $user->first_name,
            'last_name' =>  $user->last_name,
            'address' =>  $user->addres,
            'credit' =>  $user->credit,
            'avatar' => asset("assets/tmp/" .  $user->avatar),
            'region' => $region,
        ];
        return $this->outApiJson(true, 'success', $user_data);

    }


}
