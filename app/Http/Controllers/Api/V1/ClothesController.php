<?php

namespace App\Http\Controllers\Api\V1;

use App\Helpers\PusherApp;
use App\Models\Charge;
use App\Models\Clothes;
use App\Models\Contact;
use App\Models\Delivery;
use App\Models\Fav;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use App\Repositories\ClothesRepository;
use App\Repositories\SliderRepository;
use App\Repositories\CategoriesRepository;
use App\Repositories\ContactRepository;
use App\Repositories\FavRepository;
use App\Repositories\AdsRepository;
use App\Repositories\AppUsersChargeRepository;
use App\Repositories\DeliveryRepository;
use App\Repositories\PaymentRepository;
use App\Helpers\Functions;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Repositories\Criteria\AdvancedSearchCriteria;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth as JWTAuth;

class ClothesController extends ApiController
{

    use Functions;
    private $repo;
    private $cat;
    private $contact;
    private $fav;
    private $ads;
    private $address;
    private $dev;
    private $pay;
    private $slider;
    public function __construct(Request $request, ClothesRepository $repo,CategoriesRepository $cat,ContactRepository $contact, FavRepository $fav,AdsRepository $ads,AppUsersChargeRepository $address,DeliveryRepository $dev,PaymentRepository $pay,SliderRepository $slider)
    {
        parent::__construct($request);
        $this->repo = $repo;
        $this->cat = $cat;
        $this->contact = $contact;
        $this->fav = $fav;
        $this->ads = $ads;
        $this->address = $address;
        $this->dev = $dev;
        $this->pay = $pay;
        $this->slider = $slider;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $user=null;
        try{
            $user = JWTAuth::parseToken()->authenticate();
        }catch (JWTException $e) {

        }

        $length = ($request->input('count')) ? $request->input('count') : 10;
        $perPage = ($request->input('page')) ? $request->input('page') : 1;
        LengthAwarePaginator::currentPageResolver(function () use ($perPage)
        {
            return $perPage;
        });
        $where_obj = new \App\Repositories\Criteria\WhereObject();
        if($request->input('cat_id')) {
            $where_obj->pushWhere('cat_id', $request->input('cat_id'), 'eq');
        }
        //$where_obj->pushWhere('end_date',Carbon::now(),'gte');
        $where_obj->pushWhere('status',1,'eq');
        $where_obj->pushWhere('confirm',1,'eq');
        if($request->input('keyword')){
            $where_obj->pushWhere('title_'.app()->getLocale(),$request->input('keyword'),'contain');
        }
        if($request->input('order')){
           if($request->input('order')==1){
                $where_obj->pushOrder('id','desc');
            }elseif($request->input('order')==2){
                $where_obj->pushOrder('id','asc');
            }elseif($request->input('order')==3){
                $where_obj->pushOrder('price','desc');
            }elseif($request->input('order')==4){
                $where_obj->pushOrder('price','asc');
            }
        }else{
            $where_obj->pushOrder('sort_order','asc');
        }
        $where_obj_cat = new \App\Repositories\Criteria\WhereObject();
        $where_obj_cat->pushWhere('status',1,'eq');
        $where_obj->pushHas('cat',$where_obj_cat);

        $push = new \App\Repositories\Criteria\AdvancedSearchCriteria;
        $push::setWhereObject($where_obj);
        $this->repo->pushCriteria(new AdvancedSearchCriteria());
        $paginate = $this->repo->paginate($length);
        $d['data'] = [];
        $title='title_'.app()->getLocale();
        foreach($paginate->items() as $k=>$row){
            $d['data'][$k]['id'] = $row->id;
            $d['data'][$k]['title'] = $row->$title;
            $d['data'][$k]['end_date'] = $row->end_date;
            $d['data'][$k]['price_before'] = $row->price;
            $d['data'][$k]['price_after'] = $row->price_after;
            $d['data'][$k]['end_offer'] = $row->end_offer;
            $d['data'][$k]['order_limit'] = $row->order_limit;
            $d['data'][$k]['quntaty'] = $row->quntaty;
            $d['data'][$k]['order_limit'] = $row->order_limit;
            $d['data'][$k]['image']=url('/').'/assets/tmp/thumb/'.$row->image;
            if($user) {
                $d['data'][$k]['fav'] = ($row->favorites->where('user_id', $user->id) ->count() > 0)?true: false;
            }
        }
        $d['recordsTotal'] = $paginate->total();
        $d['recordsFiltered'] = $paginate->total();
        return $this->outApiJson(true,'success',['count_total' => $paginate->total(),'nextPageUrl' => $paginate->nextPageUrl(),'pages'=>ceil($paginate->total()/$length),'data'=>$d['data']]);
    }

    /**
     * @param Request $request
     * @param $type
     * @return \Illuminate\Http\JsonResponse
     */
    public function dataType(Request $request,$type)
    {

        if($type=='hot'){
            $deal=1;
        }elseif($type=='flash'){
            $deal=2;
        }else{
            $deal=3;
        }
        $length = ($request->input('count')) ? $request->input('count') : 10;
        $perPage = ($request->input('page')) ? $request->input('page') : 1;
        LengthAwarePaginator::currentPageResolver(function () use ($perPage)
        {
            return $perPage;
        });
        $where_obj = new \App\Repositories\Criteria\WhereObject();
        $where_obj->pushWhere('type',$deal,'eq');
        //$where_obj->pushWhere('end_date',Carbon::now(),'gte');
        $where_obj->pushWhere('status',1,'eq');
        $where_obj->pushWhere('confirm',1,'eq');
        $where_obj->pushOrder('id','desc');
        $push = new \App\Repositories\Criteria\AdvancedSearchCriteria;
        $push::setWhereObject($where_obj);
        $this->repo->pushCriteria(new AdvancedSearchCriteria());
        $paginate = $this->repo->paginate($length);
        $d['data'] = [];
        $title='title_'.app()->getLocale();
        foreach($paginate->items() as $k=>$row){
            $d['data'][$k]['id'] = $row->id;
            $d['data'][$k]['title'] = $row->$title;
            $d['data'][$k]['end_date'] = $row->end_date;
            $d['data'][$k]['price_before'] = $row->price;
            $d['data'][$k]['price_after'] = $row->price_after;
            $d['data'][$k]['quntaty'] = $row->quntaty;
            $d['data'][$k]['image']=url('/').'/assets/tmp/thumb/'.$row->image;
        }
        $d['recordsTotal'] = $paginate->total();
        $d['recordsFiltered'] = $paginate->total();
        return $this->outApiJson(true,'success',['count_total' => $paginate->total(),'nextPageUrl' => $paginate->nextPageUrl(),'pages'=>ceil($paginate->total()/$length),'data'=>$d['data']]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRow(Request $request)
    {
        $user=null;
        try{
            $user = JWTAuth::parseToken()->authenticate();
        }catch (JWTException $e) {

        }

        if(empty($request->input('id'))){
            return $this->outApiJson(false,'data_required');
        }
        try{
            $repose = Clothes::find($request->input('id'));
            $data=[];
            if ($repose) {
                $title='title_'.$request->header('lang');
                $note='note_'.$request->header('lang');
                $data['id']=$repose->id;
                $data['title']=$repose->$title;
                $data['image']=url('/').'/assets/tmp/'.$repose->image;
                $data['note']=$repose->$note;
                $data['price_before']=$repose->price;
                $data['price_after']=$repose->price_after;
                $data['end_offer']=$repose->end_offer;
                $data['order_limit']=$repose->order_limit;
                $data['category']=($repose->cat)?$repose->cat->$title:'';
                $data['end_date']=$repose->end_date;
                $data['quntaty']=$repose->quntaty;
                $data['order_limit']=$repose->order_limit;
                $data['lat']=$repose->lat;
                $data['lng']=$repose->lng;
                if($user) {
                $data['fav'] = ($repose->favorites->where('user_id', $user->id) ->count() > 0)?true: false;
                }
                $data['images']=[];
                $kk=0;
                foreach($repose->charityImages as $kk=>$item){
                    //$data['images'][$kk]['id']=$item->id;
                    $data['images'][$kk]['image']=url('/').'/assets/tmp/'.$item->image;
                    $kk++;
                }
                $data['images'][$kk]=['image'=>url('/').'/assets/tmp/'.$repose->image];
                return $this->outApiJson(true,'success',$data);
            }
            return $this->outApiJson(false,'pdo_exception');
        } catch (\PDOException $ex) {
            dd($ex);
            return $this->outApiJson(false,'pdo_exception');
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getData(Request $request)
    {
        $length = ($request->input('count')) ? $request->input('count') : 20;
        $perPage = ($request->input('page')) ? $request->input('page') : 1;
        $parent_id = ($request->input('parent_id')) ? $request->input('parent_id') : 0;
        LengthAwarePaginator::currentPageResolver(function () use ($perPage)
        {
            return $perPage;
        });
        $where_obj = new \App\Repositories\Criteria\WhereObject();
        $where_obj->pushWhere('parent_id',$parent_id,'eq');
        $where_obj->pushWhere('status',1,'eq');
        //$where_obj->pushWhere('confirm',1,'eq');
        if($request->input('keyword')){
            $where_obj->pushWhere('title_'.app()->getLocale(),$request->input('keyword'),'contain');
        }
        $where_obj->pushOrder('sort_order','asc');
        $push = new \App\Repositories\Criteria\AdvancedSearchCriteria;
        $push::setWhereObject($where_obj);
        $this->cat->pushCriteria(new AdvancedSearchCriteria());
        $paginate = $this->cat->paginate($length);
        $d['data'] = [];
        $title='title_'.app()->getLocale();
        foreach($paginate->items() as $k=>$row){
            $d['data'][$k]['id'] = $row->id;
            $d['data'][$k]['title'] = $row->$title;
            $d['data'][$k]['image']=url('/').'/assets/tmp/thumb/'.$row->image;
            $d['data'][$k]['products']=$row->products->count();
            $d['data'][$k]['subCategory']=$row->sub->count();
        }
        //$d['data'] = $paginate->items();
        $d['recordsTotal'] = $paginate->total();
        $d['recordsFiltered'] = $paginate->total();
        return $this->outApiJson(true,'success',['count_total' => $paginate->total(),'nextPageUrl' => $paginate->nextPageUrl(),'pages'=>ceil($paginate->total()/$length),'data'=>$d['data']]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function slider(Request $request)
    {
        $length = ($request->input('count')) ? $request->input('count') : 20;
        $perPage = ($request->input('page')) ? $request->input('page') : 1;
        $parent_id = ($request->input('parent_id')) ? $request->input('parent_id') : 0;
        LengthAwarePaginator::currentPageResolver(function () use ($perPage)
        {
            return $perPage;
        });
        $where_obj = new \App\Repositories\Criteria\WhereObject();
        $where_obj->pushWhere('status',1,'eq');
        if($request->input('keyword')){
            $where_obj->pushWhere('title_'.app()->getLocale(),$request->input('keyword'),'contain');
        }
        $where_obj->pushOrder('id','desc');
        $push = new \App\Repositories\Criteria\AdvancedSearchCriteria;
        $push::setWhereObject($where_obj);
        $this->slider->pushCriteria(new AdvancedSearchCriteria());
        $paginate = $this->slider->paginate($length);
        $d['data'] = [];
        $title='title_'.app()->getLocale();
        foreach($paginate->items() as $k=>$row){
            $d['data'][$k]['id'] = $row->id;
            $d['data'][$k]['title'] = $row->$title;
            $d['data'][$k]['image']=url('/').'/assets/tmp/'.$row->image;
        }
        //$d['data'] = $paginate->items();
        $d['recordsTotal'] = $paginate->total();
        $d['recordsFiltered'] = $paginate->total();
        return $this->outApiJson(true,'success',['count_total' => $paginate->total(),'nextPageUrl' => $paginate->nextPageUrl(),'pages'=>ceil($paginate->total()/$length),'data'=>$d['data']]);
    }

    public function delivery(Request $request)
    {
        $length = ($request->input('count')) ? $request->input('count') : 20;
        $perPage = ($request->input('page')) ? $request->input('page') : 1;
        LengthAwarePaginator::currentPageResolver(function () use ($perPage)
        {
            return $perPage;
        });
//        $where_obj = new \App\Repositories\Criteria\WhereObject();
//        $where_obj->pushWhere('status',1,'eq');
//        $where_obj->pushOrder('id','desc');
//        $push = new \App\Repositories\Criteria\AdvancedSearchCriteria;
//        $push::setWhereObject($where_obj);
//        $this->dev->pushCriteria(new AdvancedSearchCriteria());
//        $paginate = $this->dev->all();
        $paginate =Delivery::where('status','1')->orderby('id','desc')->get();

        $d['data'] = [];
        $title='title_'.app()->getLocale();
        foreach($paginate as $k=>$row){
            $d['data'][$k]['id'] = $row->id;
            $d['data'][$k]['title'] = $row->$title;
            $d['data'][$k]['price'] = $row->cost;
            $d['data'][$k]['order_limit'] = $row->order_limit;
        }
        //$d['data'] = $paginate->items();
        // $d['recordsTotal'] = $paginate->total();
        // $d['recordsFiltered'] = $paginate->total();
        return $this->outApiJson(true,'success',['data'=>$d['data']]);
    }
    public function payment(Request $request)
    {
        $length = ($request->input('count')) ? $request->input('count') : 20;
        $perPage = ($request->input('page')) ? $request->input('page') : 1;
        LengthAwarePaginator::currentPageResolver(function () use ($perPage)
        {
            return $perPage;
        });
        $where_obj = new \App\Repositories\Criteria\WhereObject();
        $where_obj->pushWhere('status',1,'eq');
        $where_obj->pushWhere('id',4,'neq');
        $where_obj->pushOrder('id','desc');
        $push = new \App\Repositories\Criteria\AdvancedSearchCriteria;
        $push::setWhereObject($where_obj);
        $this->pay->pushCriteria(new AdvancedSearchCriteria());
        $paginate = $this->pay->paginate($length);
        $d['data'] = [];
        $title='title_'.app()->getLocale();
        foreach($paginate->items() as $k=>$row){
            $d['data'][$k]['id'] = $row->id;
            $d['data'][$k]['title'] = $row->$title;
        }
        //$d['data'] = $paginate->items();
        $d['recordsTotal'] = $paginate->total();
        $d['recordsFiltered'] = $paginate->total();
        return $this->outApiJson(true,'success',['count_total' => $paginate->total(),'nextPageUrl' => $paginate->nextPageUrl(),'pages'=>ceil($paginate->total()/$length),'data'=>$d['data']]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function contactUs(Request $request)
    {

        if(
            empty($request->input('name'))||
            empty($request->input('email'))||
            empty($request->input('subject'))||
            empty($request->input('message'))
        ){
            return $this->outApiJson(false,'data_required');
        }

        $data=[
            'name'=>$request->input('name'),
            'mobile'=>$request->input('subject'),
            'email'=>$request->input('email'),
            'message'=>$request->input('message'),
        ];

        try{
            $repose=Contact::create($data);
            if ($repose) {
//                PusherApp::pushNotifications([
//                    'message' => $request->input('message'),
//                    'type' => 'contact-us',
//                    'id' => null
//                ]);
                return $this->outApiJson(true,'success');
            }
            return $this->outApiJson(false,'create_error');
        } catch (\PDOException $ex) {
            return $this->outApiJson(false,'pdo_exception');
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function about(Request $request)
    {

        try{
            $s=Setting::where('key_id','about_ar')->first()->value;

            $data=[

                'about'=>Setting::where('key_id','about_'.$request->header('lang'))->first()->value,
                'help'=>Setting::where('key_id','help_'.$request->header('lang'))->first()->value,
                'privacy'=>Setting::where('key_id','privacy_'.$request->header('lang'))->first()->value,
                'conditions'=>Setting::where('key_id','conditions_'.$request->header('lang'))->first()->value,

            ];
            return $this->outApiJson(true,'success',$data);
        } catch (\PDOException $ex) {
            return $this->outApiJson(false,'pdo_exception');
        }
    }
    public function home(Request $request)
    {
    $user = null;
    try{
            $user = JWTAuth::parseToken()->authenticate();
        }catch (JWTException $e) {

        }

        try{
            $up_banner=$this->ads->findWhere(['layout'=>4,'status'=>1])->take(1);
            $down_banner=$this->ads->findWhere(['layout'=>2,'status'=>1])->first();
            $hot=$this->repo->getHomeAds(1,50);
            $flash=$this->repo->getHomeAds(2,50);
            $newest=$this->repo->getHomeAds(3,50);
            $d = [];
            $title='title_'.app()->getLocale();
            foreach($hot as $k=>$row){
                $d[$k]['id'] = $row->id;
                $d[$k]['title'] = $row->$title;
                $d[$k]['end_date'] = $row->end_date;
                $d[$k]['price_before'] = $row->price;
                $d[$k]['price_after'] = $row->price_after;
                $d[$k]['end_offer'] = $row->price_after;
                $d[$k]['quntaty'] = $row->quntaty;
                $d[$k]['order_limit'] = $row->order_limit;
                if($user) {
                $d[$k]['fav'] = ($row->favorites->where('user_id', $user->id) ->count() > 0)?true: false;
            }
                $d[$k]['image']=url('/').'/assets/tmp/'.$row->image;
            }
            $dd = [];
            foreach($flash as $k=>$row){
                $dd[$k]['id'] = $row->id;
                $dd[$k]['title'] = $row->$title;
                $dd[$k]['end_date'] = $row->end_date;
                $dd[$k]['price_before'] = $row->price;
                $dd[$k]['price_after'] = $row->price_after;
                $dd[$k]['end_offer'] = $row->end_offer;
                $dd[$k]['quntaty'] = $row->quntaty;
                $dd[$k]['order_limit'] = $row->order_limit;

                if($user) {
                $dd[$k]['fav'] = ($row->favorites->where('user_id', $user->id) ->count() > 0)?true: false;
            }
                $dd[$k]['image']=url('/').'/assets/tmp/'.$row->image;
            }
            $ddd = [];
            foreach($newest as $k=>$row){
                $ddd[$k]['id'] = $row->id;
                $ddd[$k]['title'] = $row->$title;
                $ddd[$k]['end_date'] = $row->end_date;
                $ddd[$k]['price_before'] = $row->price;
                $ddd[$k]['price_after'] = $row->price_after;
                $ddd[$k]['end_offer'] = $row->price_after;
                $ddd[$k]['quntaty'] = $row->quntaty;
                $ddd[$k]['order_limit'] = $row->order_limit;

                if($user) {
                $ddd[$k]['fav'] = ($row->favorites->where('user_id', $user->id) ->count() > 0)?true: false;
            }
                $ddd[$k]['image']=url('/').'/assets/tmp/'.$row->image;
            }
            $ban=[];
            foreach($up_banner as $up){
                $ban[]=['url'=>$up->url,'image'=>url('/').'/assets/tmp/'.$up->image];
            }
            $data=[
                'up_banner'=>$ban,
                'down_banner'=>($down_banner)?['url'=>$down_banner->url,'image'=>url('/').'/assets/tmp/'.$down_banner->image]:'',
                'hot'=>$d,
                'flash'=>$dd,
                'newest'=>$ddd,
            ];
            return $this->outApiJson(true,'success',$data);
        } catch (\PDOException $ex) {
            return $this->outApiJson(false,'pdo_exception');
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addFav(Request $request)
    {
        $user = auth('api')->user();
//        return $user;
        if (empty($user)){

            return $this->outApiJson(false, 'user_not_found');
        }
        //check user inactive
        if ( $user->status != 'active') {
            return $this->outApiJson(false,'user_inactive');
        }

        if(empty($request->input('id'))){
            return $this->outApiJson(false,'data_required');
        }

        $add=Fav::where(['user_id'=> $user->id,'charity_id'=>$request->input('id')])->first();
        if($add){
            return $this->outApiJson(false,'fav_exists');
        }
        $data=[
            'charity_id'=>$request->input('id'),
            'user_id'=> $user->id,
        ];

        try{

            $repose=Fav::create($data);

            if ($repose) {
                return $this->outApiJson(true,'success');
            }
            return $this->outApiJson(false,'create_error');
        } catch (\PDOException $ex) {
            dd($ex);
            return $this->outApiJson(false,'pdo_exception');
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteFav(Request $request)
    {
        $user=auth('api')->user();

        if (empty($user)){

            return $this->outApiJson(false, 'user_not_found');
        }
        //check user inactive
//        if ( $user->status != 'active') {
//            return $this->outApiJson(false,'user_inactive');
//        }

        if(
        empty($request->input('id'))
        ){
            return $this->outApiJson(false,'data_required');
        }

        $add=Fav::where(['user_id'=> $user->id,'charity_id'=>$request->input('id')])->first();

        if(!$add){
            return $this->outApiJson(false,'fav_id_not_exists');
        }

        try{
            $repose=Fav::where('charity_id', $request->input('id'))->where('user_id', $user->id)->delete();

            if ($repose) {
                return $this->outApiJson(true,'success');
            }
            return $this->outApiJson(false,'pdo_exception');
        } catch (\PDOException $ex) {
            return $this->outApiJson(false,'pdo_exception');
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getFav(Request $request)
    {
        $user=auth('api')->user();

        if (empty($user)){

            return $this->outApiJson(false, 'user_not_found');
        }
//        return $user;
        //check user inactive
//        if ( $user->status != 'active') {
//            return $this->outApiJson(false,'user_inactive');
//        }

        $length = ($request->input('count')) ? $request->input('count') : 6;
        $perPage = ($request->input('page')) ? $request->input('page') : 1;
        LengthAwarePaginator::currentPageResolver(function () use ($perPage)
        {
            return $perPage;
        });

//        $where_obj = new \App\Repositories\Criteria\WhereObject();
//        $where_obj->pushOrder('id','desc');
//        $where_obj->pushOrWhere('user_id', $user->id,'eq');
//        $push = new \App\Repositories\Criteria\AdvancedSearchCriteria;
//        $push::setWhereObject($where_obj);
//        $this->fav->pushCriteria(new AdvancedSearchCriteria());
        $paginate = Fav::where('user_id',$user->id)->with('charity','user')->orderBy('id', 'DESC')->paginate($length);

//        $paginate = $this->fav->paginate($length);
        $d['data'] = [];
        $title='title_'.app()->getLocale();
        foreach($paginate->items() as $k=>$row){
            if ($row->charity){
                if ($row->charity->status==1 && $row->charity->quntaty > 0) {
                    $d['data'][]=[
                        'id'=>($row->charity)?$row->charity->id:'',
                        'title'=>($row->charity)?$row->charity->$title:'',
                        'quntaty'=>($row->charity) ? $row->charity->quntaty : '',
                        'order_limit'=>($row->charity) ? $row->charity->order_limit : '',
                        'end_date'=>($row->charity)?$row->charity->end_date:'',
                        'end_offer'=>($row->charity)?$row->charity->end_offer:'',
                        'price_before'=>($row->charity)?$row->charity->price:'',
                        'price_after'=>($row->charity)?$row->charity->price_after:'',
                        'fav'=>true,
                        'image'=>$row->charity?url('/').'/assets/tmp/'.$row->charity->image:'',
                    ];
                }
            }
        }
        $d['recordsTotal'] = $paginate->total();
        $d['recordsFiltered'] = $paginate->total();
        return $this->outApiJson(true,'success',['count_total' => $paginate->total(),'nextPageUrl' => $paginate->nextPageUrl(),'pages'=>ceil($paginate->total()/$length),'data'=>$d['data']]);
    }

    public function addAdd(Request $request)
    {
        $user=auth('api')->user();
        if (empty($user)){

            return $this->outApiJson(false, 'user_not_found');
        }
        //check user inactive
//        if ( $user->status != 'active') {
//            return $this->outApiJson(false,'user_inactive');
//        }

        if(empty($request->input('title'))){
            return $this->outApiJson(false,'data_required');
        }


        $data=[
            'lat'=>$request->input('lat'),
            'lng'=>$request->input('lng'),
            'address'=>$request->input('address'),
            'title'=>$request->input('title'),
            'street'=>$request->input('street'),
            'block'=>$request->input('block'),
            'city'=>$request->input('city'),
            'governate'=>$request->input('governate'),
            'floor'=>$request->input('floor'),
            'flat'=>$request->input('flat'),
            'building'=>$request->input('building'),
            'avenue'=>$request->input('avenue'),
            'city_id'=>$request->input('city_id'),
            'region_id'=>$request->input('region_id'),
            'type'=>$request->input('type'),
            'notes'=>$request->input('notes'),
            'user_id'=> $user->id,
        ];
        try{

            $repose=Charge::create($data);
            if ($repose) {
                return $this->outApiJson(true,'success');
            }
            return $this->outApiJson(false,'create_error');
        } catch (\PDOException $ex) {
            return $this->outApiJson(false,'pdo_exception');
        }
    }
    public function getAdd(Request $request)
    {
        $user=auth('api')->user();
        if (empty($user)){

            return $this->outApiJson(false, 'user_not_found');
        }
        ini_set('precision', 10);
        ini_set('serialize_precision', 10);
        //check user inactive
        if ( $user->status != 'active') {
            return $this->outApiJson(false,'user_inactive');
        }

        $length = ($request->input('count')) ? $request->input('count') : 6;
        $perPage = ($request->input('page')) ? $request->input('page') : 1;
        LengthAwarePaginator::currentPageResolver(function () use ($perPage)
        {
            return $perPage;
        });
//        $where_obj = new \App\Repositories\Criteria\WhereObject();
//        $where_obj->pushOrder('id','desc');
//        $where_obj->pushOrWhere('user_id', $user->id,'eq');
//        $push = new \App\Repositories\Criteria\AdvancedSearchCriteria;
//        $push::setWhereObject($where_obj);
//        $this->address->pushCriteria(new AdvancedSearchCriteria());
//        $paginate = $this->address->all();
        $paginate=Charge::where('user_id',$user->id)->orderBy('id', 'DESC')->get()  ;
        $d['data'] = [];
        $title='title_'.$request->header('lang');
        foreach($paginate as $k=>$row){
            if( $user->address==$row->id){
                $d['data'][$k]['default']=true;
            }
            $d['data'][$k]['id'] = $row->id;
            $d['data'][$k]['address'] = $row->address;
            $d['data'][$k]['lat'] = $row->lat;
            $d['data'][$k]['lng'] = $row->lng;
            $d['data'][$k]['title'] = $row->title;
            $d['data'][$k]['street'] = $row->street;
            $d['data'][$k]['block'] = $row->block;
            $d['data'][$k]['city'] = $row->city;
            $d['data'][$k]['governate'] = $row->governate;
            $d['data'][$k]['floor'] = $row->floor;
            $d['data'][$k]['flat'] = $row->flat;
            $d['data'][$k]['building'] = $row->building;
            $d['data'][$k]['avenue'] = $row->avenue;
            $d['data'][$k]['type'] = $row->type;
            $d['data'][$k]['notes'] = $row->notes;
            $d['data'][$k]['city_id'] = $row->city_id;
            $d['data'][$k]['region_id'] = $row->region_id;
            $d['data'][$k]['region'] = $row->regionData?[
                'title'=>$row->regionData->$title,
                'delivery_cost'=>$row->regionData->delivery_cost,
                'order_limit'=>$row->regionData->order_limit,
            ]:null;
        }
        return $this->outApiJson(true,'success',['data'=>$d['data']]);
    }
    public function deleteAdd(Request $request)
    {
        $user=auth('api')->user();
        if (empty($user)){

            return $this->outApiJson(false, 'user_not_found');
        }
        //check user inactive
//        if ( $user->status != 'active') {
//            return $this->outApiJson(false,'user_inactive');
//        }

        if(
        empty($request->input('id'))
        ){
            return $this->outApiJson(false,'data_required');
        }
        $add=Charge::where(['user_id'=> $user->id,'id'=>$request->input('id')])->first();
        if(!$add){
            return $this->outApiJson(false,'fav_id_not_exists');
        }
        try{
            $repose=Charge::where('id', $request->input('id'))->delete();

            if ($repose) {
                return $this->outApiJson(true,'success');
            }
            return $this->outApiJson(false,'pdo_exception');
        } catch (\PDOException $ex) {
            return $this->outApiJson(false,'pdo_exception');
        }
    }
    public function editAdd(Request $request)
    {
        $user=auth('api')->user();
        if (empty($user)){

            return $this->outApiJson(false, 'user_not_found');
        }
        if(empty($request->input('id'))){
            return $this->outApiJson(false,'data_required');
        }
        //check user inactive
        if ( $user->status != 'active') {
            return $this->outApiJson(false,'user_inactive');
        }

        if(empty($request->input('title'))){
            return $this->outApiJson(false,'data_required');
        }


        $data=[
            'lat'=>$request->input('lat'),
            'lng'=>$request->input('lng'),
            'address'=>$request->input('address'),
            'title'=>$request->input('title'),
            'street'=>$request->input('street'),
            'block'=>$request->input('block'),
            'city'=>$request->input('city'),
            'governate'=>$request->input('governate'),
            'floor'=>$request->input('floor'),
            'flat'=>$request->input('flat'),
            'building'=>$request->input('building'),
            'avenue'=>$request->input('avenue'),
            'city_id'=>$request->input('city_id'),
            'region_id'=>$request->input('region_id'),
            'type'=>$request->input('type'),
            'notes'=>$request->input('notes'),
            'user_id'=> $user->id,
        ];
        try{
            $repose=Charge::find($request->input('id'));
            $repose->update($data);
            if ($repose) {
                return $this->outApiJson(true,'success');
            }
            return $this->outApiJson(false,'create_error');
        } catch (\PDOException $ex) {
            return $this->outApiJson(false,'pdo_exception');
        }
    }
}
