<?php

class articleimg{
	public $width=null;
	public $height=null;
	public $cuttype=0;
	
	public static function getPics(&$article,$width,$height,$cuttype=0){
		global $zbp;
	
		/*
		$pattern="/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png]))[\'|\"].*?[\/]?>/";
		$pattern='/<img(.*?)src="(.*?)(?=")/';
    */
    $pattern='/<img.*?src="(.*?)(?=")/';

		$content = $article->Content;
		preg_match_all($pattern,$content,$matchContent);
		$arr = array();
		if(isset($matchContent[1][0]))
		{
			foreach($matchContent[1] as $url){
				if(articleimg::endWith(trim($url),'bmp')||articleimg::endWith(trim($url),'BMP') ){
					$arr[]=$url;
				}else{
					$arr[]=articleimg::getPicUrlBy($url,$width,$height,$cuttype);
				}
			}	
		}
		$article->IMAGE=$arr;
		$article->IMAGE_COUNT=count($arr);
		if($article->IMAGE_COUNT>0){
			$article->IMAGE_First=$arr[0];
		}else{
			$article->IMAGE_First=null;
		}
	}

	public static function getPicUrlBy($url,$width,$height,$cuttype=0){
		global $zbp;
		$flag=$zbp->Config('articleimg')->on;
		$changeurl=$zbp->Config('articleimg')->changeurl;
		if(isset($flag) && $flag==1){
      if(articleimg::startWith($url,$zbp->host)){
          if(isset($changeurl) && $changeurl==1){
            return $zbp->host.'static/'.urlencode(IMAGE_urlsafe_b64encode($url)).'-'.$width.'-'.$height.'-'.$cuttype.'-a.jpg';
          }else{
            return $zbp->host.'zb_users/plugin/articleimg/pic.php?src='.urlencode(IMAGE_urlsafe_b64encode($url)).'&width='.$width.'&height='.$height.'&cuttype='.$cuttype;
          }
      }elseif(!articleimg::startWith($url,$zbp->host)){
        if($zbp->Config('articleimg')->CacheExternalUrl){
            if(isset($changeurl) && $changeurl==1){
              return $zbp->host.'static/'.urlencode(IMAGE_urlsafe_b64encode($url)).'-'.$width.'-'.$height.'-'.$cuttype.'-a.jpg';
            }else{
              return $zbp->host.'zb_users/plugin/articleimg/pic.php?src='.urlencode(IMAGE_urlsafe_b64encode($url)).'&width='.$width.'&height='.$height.'&cuttype='.$cuttype;
            }
        }else{
          return $url;
        }
			}
		}else{
			return $url;
		}
  }
  
  function IMAGE_urlsafe_b64encode($string) {
    $data = base64_encode($string);
    $data = str_replace(array('+','/','='),array('~','_',''),$data);
    return $data;
  }

  function IMAGE_urlsafe_b64decode($string) {
    $data = str_replace(array('-','_'),array('+','/'),$string);
    $mod4 = strlen($data) % 4;
    if ($mod4) {
        $data .= substr('====', $mod4);
    }
    return base64_decode($data);
  } 

	public static function endWith($str, $needle) {
		if(strlen($str)==0){
			return false;
		}
		if(strlen($str)<strlen($needle)){
			return false;
		}
		if(strlen($str)==strlen($needle)){
			return $str==$needle;
		}
		$temp=substr($str,strlen($str)-strlen($needle));
		return strpos($temp, $needle) === 0;
	}
}
?>