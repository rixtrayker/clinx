<?php

/**
 * Translate the given message.
 *
 * @param  string  $id
 * @param  array   $parameters
 * @param  string  $domain
 * @param  string  $locale
 * @return string
 */
//  function SaveActionLog($path){
//    $user=\App\Libs\Adminauth::user();
//    $data;
//    $data['admin_name']=$user['name'];
//    $data['admin_id']=$user['id'];
//    $slug=explode('/',$path);
//    $data['action']=$slug[2].' '.$slug[1];
//    \App\Models\ActionLog::create($data);
//  }
function authorize($action)
{
    if (\App\Libs\ACL::cant($action)) {
        return abort(403, 'Unauthorized action.');
//        flash()->error(trans("admin.You donot have the permission to access this page"));
//        return redirect("admin/dashboard");
    }
}
function authorizeSuperAdmin()
{
    $user = Adminauth::user();
    if (!$user->super_admin) {
        return abort(403, 'Unauthorized action.');
    }
}

function dual($object, $field)
{
    $language = session('language');
    $field_name = $field . "_" . $language;
    return @$object->$field_name;
}

function field($field)
{
    $language = Session::get('language');
    $field_name = $field . "_" . $language;
    return $field_name;
}

function youtubeId($link)
{
    if ($link) {
        if (strstr($link, '?v=')) {
            $query = parse_url($link, PHP_URL_QUERY);
            parse_str($query, $params);
            if (@$params['v']) {
                $id = $params['v'];
                return $id;
            }
        } else {
            if (strstr($link, 'embed')) {
                $id = trim(substr(strstr($link, 'embed'), 6));
            } else {
                $links = explode('/', $link);
                if (@$links[sizeof($links) - 1]) {
                    $id = trim($links[sizeof($links) - 1]);
                } else {
                    if (@$links[sizeof($links) - 2]) {
                        $id = trim($links[sizeof($links) - 2]);
                    }
                }
            }
        }
        if (strlen($id) > 11) {
            return substr($id, strlen($id) - 11, 11);
        } else {
            return $id;
        }
    }
    return false;
}

function vimeoId($link)
{
    $link = explode('/', $link);
    $link = $link[sizeof($link) - 1];
    return $link;
}

function slug($str, $options = array())
{
    // Make sure string is in UTF-8 and strip invalid UTF-8 characters
    $str = mb_convert_encoding((string) $str, 'UTF-8', mb_list_encodings());
    $defaults = array(
        'delimiter' => '-',
        'limit' => null,
        'lowercase' => true,
        'replacements' => array(),
        'transliterate' => false,
    );
    // Merge options
    $options = array_merge($defaults, $options);
    $char_map = array(
        // Latin
        'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A',
        'Æ' => 'AE', 'Ç' => 'C',
        'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I',
        'Î' => 'I', 'Ï' => 'I',
        'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O',
        'Ö' => 'O', 'Ő' => 'O',
        'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U',
        'Ý' => 'Y', 'Þ' => 'TH',
        'ß' => 'ss',
        'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a',
        'æ' => 'ae', 'ç' => 'c',
        'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i',
        'î' => 'i', 'ï' => 'i',
        'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o',
        'ö' => 'o', 'ő' => 'o',
        'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u',
        'ý' => 'y', 'þ' => 'th',
        'ÿ' => 'y',
        // Latin symbols
        '©' => '(c)',
        // Greek
        'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z',
        'Η' => 'H', 'Θ' => '8',
        'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3',
        'Ο' => 'O', 'Π' => 'P',
        'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X',
        'Ψ' => 'PS', 'Ω' => 'W',
        'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H',
        'Ώ' => 'W', 'Ϊ' => 'I',
        'Ϋ' => 'Y',
        'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z',
        'η' => 'h', 'θ' => '8',
        'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3',
        'ο' => 'o', 'π' => 'p',
        'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x',
        'ψ' => 'ps', 'ω' => 'w',
        'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h',
        'ώ' => 'w', 'ς' => 's',
        'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',
        // Turkish
        'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G',
        'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g',
        // Russian
        'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E',
        'Ё' => 'Yo', 'Ж' => 'Zh',
        'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M',
        'Н' => 'N', 'О' => 'O',
        'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F',
        'Х' => 'H', 'Ц' => 'C',
        'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '',
        'Э' => 'E', 'Ю' => 'Yu',
        'Я' => 'Ya',
        'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e',
        'ё' => 'yo', 'ж' => 'zh',
        'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm',
        'н' => 'n', 'о' => 'o',
        'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f',
        'х' => 'h', 'ц' => 'c',
        'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '',
        'э' => 'e', 'ю' => 'yu',
        'я' => 'ya',
        // Ukrainian
        'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',
        'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',
        // Czech
        'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S',
        'Ť' => 'T', 'Ů' => 'U',
        'Ž' => 'Z',
        'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's',
        'ť' => 't', 'ů' => 'u',
        'ž' => 'z',
        // Polish
        'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o',
        'Ś' => 'S', 'Ź' => 'Z',
        'Ż' => 'Z',
        'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o',
        'ś' => 's', 'ź' => 'z',
        'ż' => 'z',
        // Latvian
        'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k',
        'Ļ' => 'L', 'Ņ' => 'N',
        'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',
        'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k',
        'ļ' => 'l', 'ņ' => 'n',
        'š' => 's', 'ū' => 'u', 'ž' => 'z'
    );
    // Make custom replacements
    $str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);
    // Transliterate characters to ASCII
    if ($options['transliterate']) {
        $str = str_replace(array_keys($char_map), $char_map, $str);
    }
    // Replace non-alphanumeric characters with our delimiter
    $str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);
    // Remove duplicate delimiters
    $str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);
    // Truncate slug to max. characters
    $str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');
    // Remove delimiter from ends
    $str = trim($str, $options['delimiter']);

    return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
}

function preparePragraphs($rows)
{
    $data = [];
    if ($rows) {
        foreach ($rows as $row) {
            $data[$row->id] = $row;
        }
    }
    return $data;
}

function getConfigs()
{
    $configs = \App\Models\Config::get();
    if ($configs) {
        foreach ($configs as $c) {
            $key = $c->field_name;
            $arr[$key] = $c->value;
        }
        if (@$arr) {
            return $arr;
        }
    }
}

function googleMapUrl($url)
{
    $query = parse_url($url);
    $query = @$query['query'];
    $query = str_replace("&", "&amp;", $query);
    $url = "https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=" . $query . "&amp;output=embed";
    return $url;
}

function followLink($url)
{
    $link = "http://api.longurl.org/v2/expand?format=json&url=" . urlencode($url) . "&all-redirects=1&title=1&meta-keywords=1&meta-description=1";
    $response = @file_get_contents($link);
    if ($response) {
        $obj = json_decode($response, true);
    }
    $obj = $obj['long-url'];
    if ($obj) {
        return $obj;
    }
}

function getCountry($ip)
{
    $curlURL = @sprintf('http://freegeoip.net/json/%s', trim($ip));
    $ch = curl_init();
    @curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);                  // Return the actual result
    @curl_setopt($ch, CURLOPT_URL, $curlURL);                      // Use the URL constructed previously
    @curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5); // Set the timeout so we don't take forever to load the page
    $data = @curl_exec($ch);                                     // Execute the call
    curl_close($ch);
    // The call returns JSON, convert it to a stdClass object
    $geo = @json_decode($data);
    return @$geo;
}

function relativeTime($time)
{
    $second = 1;
    $minute = 60 * $second;
    $hour = 60 * $minute;
    $day = 24 * $hour;
    $month = 30 * $day;
    //$time=strtotime($time);
    $delta = strtotime('+0 hours') - $time;
    if ($delta < 2 * $minute) {
        return "1 min ago";
    }
    if ($delta < 45 * $minute) {
        return floor($delta / $minute) . " min ago";
    }
    if ($delta < 90 * $minute) {
        return "1 hour ago";
    }
    if ($delta < 24 * $hour) {
        return floor($delta / $hour) . " hours ago";
    }
    if ($delta < 48 * $hour) {
        return "yesterday";
    }
    if ($delta < 30 * $day) {
        return floor($delta / $day) . " days ago";
    }
    if ($delta < 12 * $month) {
        $months = floor($delta / $month / 30);
        return $months <= 1 ? "1 month ago" : $months . " months ago";
    } else {
        $years = floor($delta / $month / 365);
        return $years <= 1 ? "1 year ago" : $years . " years ago";
    }
}

function metaKeyword($text)
{
    $string = strip_tags(trim($text));
    $string = str_replace(".", " ", $string);
    $stopWords = array('.', 'i', 'a', 'about', 'an', 'and', 'are', 'as', 'at',
        'be', 'by', 'com', 'de', 'en', 'for', 'from', 'how', 'in', 'is', 'it',
        'la', 'of', 'on', 'or', 'that', 'the', 'this', 'to', 'was', 'what', 'when',
        'where', 'who', 'will', 'with', 'und', 'the', 'www', 'and/or', '{', '}',
        ')', '(', 'that\'s');
    $arr = explode(" ", $string);
    $words = array();
    if ($arr) {
        foreach ($arr as $r) {
            $r = strtolower($r);
            if (!empty($r) and ! in_array($r, $words) and ! in_array($r, $stopWords) and ! is_numeric($r)) {
                $words[] = trim($r);
            }
        }
    }
    if ($words) {
        return implode(', ', $words);
    }
}

function exploreDirectory($dirPath)
{
    if ($handle = @opendir($dirPath)) {
        while (false !== ($file = @readdir($handle))) {
            if ($file != "." && $file != "..") {
                if (@is_dir("$dirPath/$file")) {
                    $arr[] = "$file";
                }
            }
        }
        closedir($handle);
    }
    if (@$arr) {
        return $arr;
    }
}

function deleteImage($file_name = "", $path = "uploads/")
{
    if (!@$file_name) {
        return false;
    }
    $directories = exploreDirectory($path);
    if ($directories) {
        if (file_exists($path . $file_name)) {
            unlink($path . $file_name);
        }
        foreach ($directories as $dir) {
            if (file_exists($path . $dir . '/' . $file_name)) {
                unlink($path . $dir . '/' . $file_name);
            }
        }
    }
}

function deleteFile($file_name = "", $path = "uploads/")
{
    if (!@$file_name) {
        return false;
    }
    if (file_exists($path . $file_name)) {
        unlink($path . $file_name);
    }
}

function viewValue($value, $type, $params=[])
{
    $suffix = "";
    if ($value) {
        if ($type == "image") {
            if (file_exists("uploads/small/" . $value)) {
                $suffix.='<div style="background-color:#aeb2b7; width:80px;">';
                $suffix.='<img class="cropped_preview" src="uploads/small/' . $value . '" width="80">';
                $suffix.='</div>';
            }
        } elseif ($type == "more_images") {
            if (file_exists("uploads/small/" . $value)) {
                $suffix.='<div class="col-xs-4 col-sm-4 col-md-3">';
                $suffix.='<p class="image_preview">';
                $suffix.='<img class="cropped_preview" src="uploads/small/' . $value . '" width="80">';
//                    $suffix.='<p><a class="btn btn-danger" href="admin/images/delete/' . $value . '" data-confirm="' . trans("admin.Are you sure you want to delete this item") . '?' . '" data-title="' . trans('admin.Confirmation message') . '"><i class="fa fa-trash-o"></i> ' . trans('admin.Delete') . '</a></p>';
                $suffix.='<p><a class="delete_image btn btn-danger" href='.$params['url'].'><i class="fa fa-trash-o"></i> ' . trans('admin.Delete') . '</a></p>';
                $suffix.='</p>';
                $suffix.='</div>';
            }
        } elseif ($type == "file") {
            if (file_exists("uploads/" . $value)) {
                //$suffix.='<img class="cropped_preview" src="'.URL::base()."/uploads/50x50/".$value.'">';
                $suffix.=$value . ' <a href="uploads/' . $value . '" class="btn btn-success" target="_blank">' . trans("admin.Download") . '</a>';
            }
        } elseif ($type = "youtube") {
            $value = youtubeId($value);
            $suffix = '<iframe width="150" height="113" src="http://www.youtube.com/embed/' . $value . '?rel=0;showinfo=0;controls=0" frameborder="0" allowfullscreen></iframe>';
        } elseif ($type = "vimeo") {
            $value = vimeoId($value);
            $suffix = '<iframe src="http://player.vimeo.com/video/' . $value . '?byline=0&portrait=0" width="150" height="113" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
        }
    }
    return $suffix;
}
