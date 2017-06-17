<?php
/**
 * Created by PhpStorm.
 * User: seiryuukyuu
 * Date: 2017/6/17
 * Time: 下午11:45
 */
namespace App\Http\Service;
use App\Url;
class UrlStoreService {
    private $result = [];
    public function store($url,$shortKey){
        if(!$this->isStoreable($url,$shortKey)){
            return $this->result;
        }
        $u = new Url(parse_url($url));
        $u->uri = $url;
        $u->shortKey = $shortKey;
        $u->save();
        $this->result['url'] = url($shortKey);
        return $this->result;
    }

    public function isStoreable($url,$shortKey){

        $u = Url::where('shortKey',$shortKey)->first();
        if(!is_null($u)){
            $this->result['status'] = 'FAILED';
            $this->result['status_code'] = 403;
            $this->result['message'] = '噢~你发现了别人的宝藏！';
            $this->result['url'] = $u->uri;
            return false;
        }

        $u = Url::where('uri',$url)->first();
        if(!is_null($u)){
            $this->result['status'] = 'FAILED';
            $this->result['status_code'] = 403;
            $this->result['message'] = '来晚一步，这个 URL 已经有人转过啦！！哈哈哈哈！！';
            $this->result['url'] = url($u->shortKey);
            return false;
        }

        $this->result['status'] = 'SUCCESS';
        $this->result['status_code'] = 200;
        $this->result['msg'] = '创建成功！';
        return true;
    }
}