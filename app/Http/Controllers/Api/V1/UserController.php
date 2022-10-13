<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\AppUser;
use App\Repositories\AppUsersRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//use App\Helpers\Functions;

class UserController extends Controller
{
//    use Functions;

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
            return parent::error('data required');
//            return $this->outApiJson(false, 'data_required');
        }
        if (!ctype_digit($request->input('mobile_number'))) {
            return parent::error(false, 'mobile_invalid');
        }
        if ($request->input('mobile_number') == '0096512345678') {
            $activation_code = 12345;
        } else {
            $activation_code = rand(11111, 99999);
        }
        $data = [];
        $data['device_token'] = $request->input('device_token');
        $data['mobile_number'] = $request->input('mobile_number');
        $data['password'] = \Hash::make($request->input('mobile_number'));
        $data['first_name'] = $request->input('first_name');
        $data['last_name'] = $request->input('last_name');
        $data['city_id'] = $request->input('city_id');
        $data['region_id'] = $request->input('region_id');
        $data['activation_code'] = $activation_code;
        $data['status'] = 'pending_activation';
        $data['credit'] = config('general.welcome_credit');
        $data['ip_address'] = request()->ip();
//        try {
            $user = AppUser::where(['mobile_number' => $request->input('mobile_number')])->first();
            if (!$user) {
                $user = AppUser::create($data);
            } else {
                $user =  AppUser::update($data, $user->id);
            }
//            return $user;
//            $token = JWTAuth::attempt(['mobile_number' => $request->input('mobile_number'), 'password' => $request->input('mobile_number')]);
            if (Auth::attempt(['mobile_number' => $request->input('mobile_number'), 'password' => $request->input('password') ]) ) {
//                $user = Auth::user();
                // return $user;
                $user['accessToken'] = $user->createToken('mobile')->accessToken;



                $message= __('api.ok');

                return parent::success( $user);
//

            }
//            // send activation code with sms
//            $message = 'your activation code is ' . $activation_code;
//            $gate = $this->gates->getNextGate(0);
//            if (!$gate) {
//                $gate = $this->gates->getNextGate(0);
//            }
//            SmsGateways::send($gate, $message, $request->input('mobile_number'));
//            $userdata = [
//                'user_id' => $user->id,
//                'token' => $token,
//            ];
//            //send email address
//            $emails = explode(',', config('general.emails'));
//            $this->sendEmail('emails.forget_pass', ['name' => $request->input('first_name') . ' ' . $request->input('last_name'), 'code' => $activation_code, 'mobile' => $request->input('mobile_number')], 'new user register', $emails);
//            return $this->outApiJson(true, 'success', $userdata);

//        } catch (JWTException $e) {
//            return $this->outApiJson(false, 'could_not_create_token');
//        } catch (\PDOException $ex) {
//            dd($ex);
//            return $this->outApiJson(false, 'pdo_exception');
//        }
    }
}
