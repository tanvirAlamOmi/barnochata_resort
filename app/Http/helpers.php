<?php

use App\Helpers\DateTimeAsReadableHelper;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Settings\Menu;
use App\Models\DataContent\Notice;

function appInfo()
{
	return json_decode(file_get_contents(config_path('app-info.json')), true);
}

function headerMenus()
{
	return Menu::select('id','name','slug','type','position','link_url')->where('parent_id',null)->where('display_options','LIKE','%'.'header'.'%')->where('status',true)->with('submenus')->orderBy('position','ASC')->get();
}

function footerMenus()
{
	return Menu::select('id','name','slug','type','position','link_url')->where('parent_id',null)->where('display_options','LIKE','%'.'footer'.'%')->where('status',true)->with('submenus')->orderBy('position','ASC')->get();
}

function allMenus()
{
	return Menu::select('id','name','slug','type','position','link_url')->where('parent_id',null)->where('status',true)->with('submenus')->orderBy('position','ASC')->get();
}

function getMenubySlug($slug)
{
	return Menu::select('id','name','slug','type','position','link_url')->where('slug',$slug)->with('submenus')->first();
}

function slugToTitle($slug)
{
	return ucwords(str_replace('-', ' ', str_replace('_', ' ', $slug)));
}

function titleToSlug($title)
{
	return strtolower((str_replace(' ', '-', $title)));
}

function weekDays()
{
	return ['saturday','sunday','monday','tuesday','wednesday','thursday','friday'];
}

function generateRandomString($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_+-=[]{}|;:,.<>?';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function getStatusCode($status = null)
{
	if(!empty($status))
	{
		if($status == 'ACCEPTED'){
			return 2;
		}elseif($status == 'ALTER'){
			return 3;
		}elseif($status == 'CANCELLED'){
			return 4;
		}elseif($status == 'ACTIVE'){
			return 5;
		}elseif($status == 'COMPLETED'){
			return 6;
		}
	}else{
		return false;
	}
}

function menusByLevel()
{
	$query = 'WITH RECURSIVE MenuHierarchy AS (
		SELECT
		   id,
		   name,
		   slug,
		   type,
		   link_url,
		   parent_id,
		   position,
		   0 AS level 
		FROM
		   menus 
		WHERE
		   parent_id IS NULL
		   AND status IS true
		UNION ALL
		SELECT
		   m.id,
		   m.name,
		   m.slug,
		   m.type,
		   m.link_url,
		   m.parent_id,
		   m.position,
		   mh.level + 1 
		FROM
		   menus m 
		   INNER JOIN
		      MenuHierarchy mh 
		      ON m.parent_id = mh.id 
		)
		SELECT
		   id,
		   name,
		   slug,
		   type,
		   link_url,
		   parent_id,
		   position,
		   level 
		FROM
		   MenuHierarchy 
		ORDER BY
		   parent_id,
		   position;
		';

	return DB::select($query);

}

function popupInfo()
{
	return json_decode(file_get_contents(config_path('popup.json')), true);
}

function dateTimeAsReadable($timestamp, $format = null)
{
	return (new DateTimeAsReadableHelper())->dateTimeAsReadable($timestamp, $format);
}
function getSeedMenus()
{
	return json_decode(file_get_contents(config_path('menus.json')), true);
}

function getNotices($limit = null)
{
	$notices = Notice::whereStatus(true)->orderBy('serial_no', 'asc');

	if($limit){
		$notices = $notices->limit($limit);
	}

	$notices = $notices->get();

	return $notices;
}

function getAllNotices($limit = null)
{
	$notices = Notice::whereStatus('1')->orderBy('serial_no', 'asc');

	if($limit){
		$notices = $notices->paginate($limit);
	}else{ 
		$notices = $notices->get();
	}

	return $notices;
}

function getGroupContentType($properties)
{
	if(strpos($properties, ','))
	{
		return ucfirst(str_replace('Content', '', explode(',', $properties)[0]));
	}
}

function getFullUrl()
{
	return $urls = url()->current();
}