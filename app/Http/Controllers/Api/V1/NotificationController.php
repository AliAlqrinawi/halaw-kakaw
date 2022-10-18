<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Notifications;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Repositories\NotificationRepository;
use App\Helpers\Functions;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\Criteria\AdvancedSearchCriteria;
class NotificationController extends ApiController
{

    use Functions;
    private $repo;

    public function __construct(Request $request, NotificationRepository $repo)
    {
        parent::__construct($request);
        $this->repo = $repo;
    }

    public function getData(Request $request)
    {

        $user = auth('api')->user();
//            return $user;
        if (empty($user)){

            return $this->outApiJson(false, 'user_not_found');
        }

        $id =  $user->id;
        try {
            $length = ($request->input('count')) ? $request->input('count') : 10;
            $count= Notifications::where('user_id',$id)->where('status',0)->where('created_at', '>=',  $user->created_at)->count();
            $notifications = Notifications::where(function ($q) use ($id) {
                $q->where('user_id', $id);
                $q->orWhere('user_id', 0);
            })->where('created_at', '>=',  $user->created_at)->orderBy('id','desc')->paginate($length);
            $data=[];
            foreach($notifications as $kk=>$item){
                $data[$kk]['id']=$item->id;
                $data[$kk]['created_at']=$item->created_at->diffForHumans();
                $data[$kk]['title']=$item->title;
                $data[$kk]['message']=$item->message;
                $data[$kk]['read']=$item->status;
                $data[$kk]['product_id']=$item->product_id;
                $data[$kk]['order_id']=$item->order_id;
                $data[$kk]['url']=$item->url;
                $data[$kk]['cat_id']=$item->cat_id;
            }
            return $this->outApiJson(true,'success',['un_read' => $count,'count_total' => $notifications->total(), 'nextPageUrl' => $notifications->nextPageUrl(),'pages'=>ceil($notifications->total()/$length),'data'=>$data]);
        } catch (\Exception $ex) {
            return $this->outApiJson(false,'unexpected_error');
        } catch (\PDOException $ex){
            return $this->outApiJson(false,'pdo_exception');
        }
    }

    public function read(Request $request,$id)
    {

        $user = auth('api')->user();
//            return $user;
        if (empty($user)) {

            return $this->outApiJson(false, 'user_not_found');
        }
            try {
            $item= Notifications::where('id',$id)->first();
            if(!$item){
                return $this->outApiJson(false,'not_found');
            }
            $item->status = 1;
            $item->save();
            return $this->outApiJson(true,'success');
        } catch (\Exception $ex) {
            return $this->outApiJson(false,'unexpected_error');
        } catch (\PDOException $ex){
            return $this->outApiJson(false,'pdo_exception');
        }

    }

    public function delete(Request $request,$id)
    {
        try {
            Notifications::where('id',$id)->delete();
            return $this->outApiJson(true,'success');
        } catch (\Exception $ex) {
            return $this->outApiJson(false,'unexpected_error');
        } catch (\PDOException $ex){
            return $this->outApiJson(false,'pdo_exception');
        }

    }
}
