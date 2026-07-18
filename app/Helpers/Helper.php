<?php

use App\Models\Setting;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use App\Models\KPIQuestion;
use \Illuminate\Database\Eloquent\Model;

if (!function_exists('json_response')) {
    function json_response($data = null, $message = null, $code = 200, $errors = null)
    {
        $array = [
            'status' => $code,
            'message' => $message,
            'data' => $data,
            'errors' => $errors,
        ];
        return response()->json($array, $code);
    }
}

if (!function_exists('json_response_error')) {
    function json_response_error($code, $message = null, $messageKey = null, $customValidationError = null)
    {
        if ($messageKey == null) $messageKey = 'message';
        $array = [
            'status' => $code,
            'message' => $message,
            'data' => null,
            'errors' => [$messageKey => [$customValidationError]],
        ];
        return response()->json($array, $code);
    }
}

if (!function_exists('paginate_response')) {
    function paginate_response($data = null)
    {
        $array = [
            'total' => 0,
            'count' => 0,
            'per_page' => 0,
            'current_page' => 0,
            'total_pages' => 0
        ];
        if ($data) {
            $array = [
                'total' => $data->total() ?? 0,
                'count' => $data->count() ?? 0,
                'per_page' => $data->perPage() ?? 0,
                'current_page' => $data->currentPage() ?? 0,
                'total_pages' => $data->lastPage() ?? 0
            ];
        }
        return $array;
    }
}

if (!function_exists('ajax_response')) {
    function ajax_response($data = null, $message = null, $code = 200)
    {
        $array = [
            'status' => in_array($code, success_response()) ? true : false,
            'code' => $code,
            'data' => $data,
            'message' => $message,
        ];
        return response()->json($array);
    }

    function success_response()
    {
        return [
            200,   //OK. The standard success code and default option.
            201,   //Object created. Useful for the store actions.
            202,   //The request has been accepted for processing, but the processing has not been completed.
            204,   //No content. When an action was executed successfully, but there is no content to return.
            206,    //Partial content. Useful when you have to return a paginated list of resources.
        ];
    }

    /************** another http request codes **************/
    /* *
    *  400: Bad request. The standard option for requests that fail to pass validation.
    *  401: Unauthorized. The user needs to be authenticated.
    *  403: Forbidden. The user is authenticated, but does not have the permissions to perform an action.
    *  404: Not found. This will be returned automatically by Laravel when the resource is not found.
    *  405: Method Not Allowed.
    *  419: Authentication Timeout.
    *  422: Unprocessable Entity. validation failed.
    *  500: Internal server error. Ideally you're not going to be explicitly returning this, but if something unexpected breaks, this is what your user is going to receive.
    *  503: Service unavailable. Pretty self explanatory, but also another code that is not going to be returned explicitly by the application.
    * */

}

if (!function_exists('notification_count')) {
    function notification_count()
    {
        $notification = \Chatify\Http\Models\Message::where('to_id', Auth::id())->where('seen', 0)->distinct()->get(['from_id']);
        return $notification->count();
    }
}

if (!function_exists('str_limit')) {
    function str_limit(string $text = null, int $limit = 50, $end = null)
    {
        return !empty($text) ? Str::limit($text, $limit, $end) : null;
    }
}

if (!function_exists('replace_storage_folder')) {
    function replace_storage_folder($fileLink = null)
    {
        if ($fileLink != null) $fileLink = str_replace('storage/', 'public/', $fileLink);
        return $fileLink;
    }

}

if (!function_exists('status_value')) {
    function status_value(Model $object)
    {
        $modelClass = get_class($object);
        $statusArray = $modelClass::selectStatusList();

        return $statusArray[$object['status']];
    }
}

if (!function_exists('table_of_model_name')) {
    function table_of_model_name(string $object)
    {
        $object = new $object;
        return $object->getTable();
    }
}

if (!function_exists('status_trans')) {
    function status_trans($object, $value)
    {
        $modelClass = get_class($object);
        $statusArray = $modelClass::selectStatusList();
        dd($statusArray, $value);
        return $statusArray[$value];
    }
}


if (!function_exists('array_to_string')) {
    function array_to_string($array)
    {
        return implode(",", $array);
    }
}

if (!function_exists('user_id')) {
    function user_id()
    {
        return \Illuminate\Support\Facades\Auth::id() ?? null;
    }
}


if (!function_exists('is_create')) {
    function is_create()
    {
        return strpos(\Request::route()->getName(), '.create') ? true : false;
    }
}


if (!function_exists('is_show')) {
    function is_show()
    {
        return strpos(\Request::route()->getName(), '.show') ? true : false;
    }
}

if (!function_exists('is_edit')) {
    function is_edit()
    {
        return strpos(\Request::route()->getName(), '.edit') ? true : false;
    }
}

if (!function_exists('main_api_route_name')) {
    function main_api_route_name($route)
    {
        $route = explode('.', $route);
        array_pop($route);
        return implode('.', $route);
    }
}

if (!function_exists('main_route_name')) {
    function main_route_name($route)
    {
        $route = str_replace('dashboard.v1.', null, $route);
        $route = explode('.', $route);
        array_pop($route);
        return $route[0];
    }
}

if (!function_exists('string_to_words')) {
    function string_to_words($string)
    {
        return ucfirst(str_replace('_', ' ', $string));
    }
}

if (!function_exists('custom_date')) {
    function custom_date($date)
    {
        if (!$date) return null;
        $date = \Carbon\Carbon::parseFromLocale($date, app()->getLocale());
//        return(Carbon\Carbon::parse($date)->locale(app()->$this->getLocale())->isoFormat('dddd, MMMM Do YYYY, h:mm a'));
//        return (Carbon\Carbon::parse($date)->locale(app()->getLocale())->isoFormat('Y/M/D h:m a'));
        return custom_date_only($date) . ' ' . custom_hour($date);

        return (Carbon\Carbon::parse($date)->locale(app()->getLocale())->format('Y-m-d H:i a'));
        return date('d-m-Y', strtotime($date))
            . ' ' . date('h:i A', strtotime($date));
    }
}

if (!function_exists('custom_date_only')) {
    function custom_date_only($date)
    {
        if (!$date) return null;
        return (Carbon\Carbon::parseFromLocale($date, app()->getLocale())->locale(app()->getLocale())->isoFormat('Y/M/D'));

    }
}

if (!function_exists('custom_hour')) {
    function custom_hour($date)
    {
        if (!$date) return null;
        return (Carbon\Carbon::parseFromLocale($date, app()->getLocale())->locale(app()->getLocale())->isoFormat('h:mm a'));
        return date('h:i A', strtotime($date));
    }
}

if (!function_exists('value_of')) {
    function value_of($array, $index)
    {
        if (array_key_exists($index, $array)) return $array[$index];
    }
}

if (!function_exists('trans_setting_key')) {
    function trans_setting_key($key)
    {
        return str_replace('_', ' ', $key);
    }
}

if (!function_exists('setting_value')) {
    function setting_value($key, $where = [])
    {
        $setting = \App\Models\Setting::get()->keyBy('key');
        if ($where != []) $setting = $setting->where($where['column'], $where['value']);
        $value = null;
        if (isset($setting[$key])) {
            if (in_array($key, ['logo', 'pre_loading_logo', 'fav_icon'])) {
                if ($setting[$key]->value != null) {
                    $value = asset($setting[$key]->value);
                } else {
                    if (\App::isLocale('ar')) {
                        $value = asset('assets/images/logo-ar.png');
                    } else {
                        $value = asset('assets/images/logo.png');
                    }
                    if ($key == 'pre_loading_logo') $value = asset('assets/images/logo-board.gif');
                }
            } else {
                $value = $setting[$key]->value;
                if (in_array($key, ['terms_content_ar', 'terms_content_en', 'about_content_ar', 'about_content_en'])) {
                    return html_entity_decode($value);
                }

//                if ($key == 'nexmo_key' && $setting[$key]->value == null) $value = 'c8cc7ddc';
//
//                if ($key == 'nexmo_api_secret' && $setting[$key]->value == null) $value = 'CX5s7KyzP6Kkpp7B ';
//
//                if ($key == 'default_message_from' && $setting[$key]->value == null) $value = 'ROQAY';
//
//                if ($key == 'default_mail_from' && $setting[$key]->value == null) $value = 'no-reply@sent.center';
            }
        }
        return $value;
    }
}


if (!function_exists('array_paginator')) {
    function array_paginator($array, $request, $perPage = 1)
    {
        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        // Create a new Laravel collection from the array data
        $itemCollection = collect($array);

        // Define how many items we want to be visible in each page
//        $perPage = 1;

        // Slice the collection to get the items to display in current page
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();

        // Create our paginator and pass it to the view
        $paginatedItems = new LengthAwarePaginator($currentPageItems, count($itemCollection), $perPage);

        // set url path for generted links
        $paginatedItems->setPath($request->url());

        return $paginatedItems;
    }
}

if (!function_exists('yearly_meeting_attendance_report')) {
    function yearly_meeting_attendance_report($meetings, $month, $member)
    {
        $meetings = clone $meetings;
        $monthMeetings = $meetings->month($month);

//        dd($total);
        $total = $monthMeetings->count();
        if ($total == 0) return null;

        $monthMeetingsIds = $monthMeetings->pluck('id')->toArray();

        $monthAttendance = clone $member->meetingAttendance()->whereIn('meeting_id', $monthMeetingsIds)
            ->where('attendance', \App\Models\MeetingAttendance::STATUS_PRESENT)->get();

        return $monthAttendance->count() . '/' . $total;
    }
}

if (!function_exists('convert_number_ar')) {
    function convert_number_ar($number, $sex = 'male')
    {

        if (($number < 0) || ($number > 999999999999)) {
            throw new Exception("العدد خارج النطاق");
        }
        $return = "";
        //convert number into array of (string) number each case
        // -------number: 121210002876-----------//
        // 	0		1		2		3  //
        //'121'	  '210'	  '002'	  '876'
        $english_format_number = number_format($number);
        $array_number = explode(',', $english_format_number);
        //convert each number(hundred) to arabic
        for ($i = 0; $i < count($array_number); $i++) {
            $place = count($array_number) - $i;
            $return .= convert($array_number[$i], $place, $sex);
            if (isset($array_number[($i + 1)]) && $array_number[($i + 1)] > 0) $return .= ' و';
        }
        return $return;
    }

    //private function
    function convert($number, $place, $sex)
    {
        // take in charge the sex of NUMBERED

        //the number word in arabic for masculine and feminine
        $words = array(
            'male' => array(
                '0' => '', '1' => 'واحد', '2' => 'اثنان', '3' => 'ثلاثة', '4' => 'أربعة', '5' => 'خمسة',
                '6' => 'ستة', '7' => 'سبعة', '8' => 'ثمانية', '9' => 'تسعة', '10' => 'عشرة',
                '11' => 'أحد عشر', '12' => 'اثنا عشر', '13' => 'ثلاثة عشر', '14' => 'أربعة عشر', '15' => 'خمسة عشر',
                '16' => 'ستة عشر', '17' => 'سبعة عشر', '18' => 'ثمانية عشر', '19' => 'تسعة عشر', '20' => 'عشرون',
                '30' => 'ثلاثون', '40' => 'أربعون', '50' => 'خمسون', '60' => 'ستون', '70' => 'سبعون',
                '80' => 'ثمانون', '90' => 'تسعون', '100' => 'مئة', '200' => 'مائتان', '300' => 'ثلاثمائة', '400' => 'أربعمائة', '500' => 'خمسمائة',
                '600' => 'ستمائة', '700' => 'سبعمائة', '800' => 'ثمانمائة', '900' => 'تسعمائة'
            ),
            'female' => array(
                '0' => '', '1' => 'اولا', '2' => 'ثانيا', '3' => 'ثالثا', '4' => 'رابعا', '5' => 'خامسا',
                '6' => 'سادسا', '7' => 'سابعا', '8' => 'ثامنا', '9' => 'تاسعا', '10' => 'عاشرا',
                '11' => 'الحادي عشر', '12' => 'الثاني عشر', '13' => 'الثالث عشر', '14' => 'الرابع عشر', '15' => 'الخامس عشر',
                '16' => 'السادس عشر', '17' => 'السابع عشر', '18' => 'الثامن عشر', '19' => 'التاسع عشر', '20' => 'العشرون',
                '30' => 'الثلاثون', '40' => 'الاربعون', '50' => 'الخمسون', '60' => 'ستون', '70' => 'سبعون',
                '80' => 'ثمانون', '90' => 'تسعون', '100' => 'مئة', '200' => 'مائتان', '300' => 'ثلاثمائة', '400' => 'أربعمائة', '500' => 'خمسمائة',
                '600' => 'ستمائة', '700' => 'سبعمائة', '800' => 'ثمانمائة', '900' => 'تسعمائة'
            )
        );
        //take in charge the different way of writing the thousands and millions ...
        $mil = array(
            '2' => array('1' => 'ألف', '2' => 'ألفان', '3' => 'آلاف'),
            '3' => array('1' => 'مليون', '2' => 'مليونان', '3' => 'ملايين'),
            '4' => array('1' => 'مليار', '2' => 'ملياران', '3' => 'مليارات')
        );

        $mf = array('1' => $sex, '2' => 'male', '3' => 'male', '4' => 'male');
        $number_length = strlen((string)$number);
        if ($number == 0) return '';
        else if ($number[0] == 0) {
            if ($number[1] == 0) $number = (int)substr($number, -1);
            else $number = (int)substr($number, -2);
        }
        switch ($number_length) {
            case '1':
                {
                    switch ($place) {
                        case '1':
                            {
                                $return = $words[$mf[$place]][$number];
                            }
                            break;
                        case '2':
                            {

                                if ($number == 1) $return = 'ألف';
                                else if ($number == 2) $return = 'ألفان';
                                else {
                                    $return = $words[$mf[$place]][$number] . ' آلاف';
                                }
                            }
                            break;
                        case '3':
                            {
                                if ($number == 1) $return = 'مليون';
                                else if ($number == 2) $return = 'مليونان';
                                else $return = $words[$mf[$place]][$number] . ' ملايين';
                            }
                            break;
                        case '4':
                            {
                                if ($number == 1) $return = 'مليار';
                                else if ($number == 2) $return = 'ملياران';
                                else $return = $words[$mf[$place]][$number] . ' مليارات';
                            }
                            break;
                    }
                }
                break;
            case '2':
                {
                    if (isset($words[$mf[$place]][$number])) $return = $words[$mf[$place]][$number];
                    else {
                        $twoy = $number[0] * 10;
                        $ony = $number[1];
                        $return = $words[$mf[$place]][$ony] . ' و' . $words[$mf[$place]][$twoy];
                    }
                    switch ($place) {
                        case '2':
                            {
                                $return .= ' ألف';
                            }
                            break;
                        case '3':
                            {
                                $return .= ' مليون';
                            }
                            break;
                        case '4':
                            {
                                $return .= ' مليار';
                            }
                            break;
                    }
                }
                break;
            case '3':
                {
                    if (isset($words[$mf[$place]][$number])) {
                        $return = $words[$mf[$place]][$number];
                        if ($number == 200) $return = 'مئتا';
                        switch ($place) {
                            case '2':
                                {
                                    $return .= ' ألف';
                                }
                                break;
                            case '3':
                                {
                                    $return .= ' مليون';
                                }
                                break;
                            case '4':
                                {
                                    $return .= ' مليار';
                                }
                                break;
                        }
                        return $return;
                    } else {
                        $threey = $number[0] * 100;
                        if (isset($words[$mf[$place]][$threey])) {
                            $return = $words[$mf[$place]][$threey];
                        }
                        $twoyony = $number[1] * 10 + $number[2];
                        if ($twoyony == 2) {
                            switch ($place) {
                                case '1':
                                    $twoyony = $words[$mf[$place]]['2'];
                                    break;
                                case '2':
                                    $twoyony = 'ألفان';
                                    break;
                                case '3':
                                    $twoyony = 'مليونان';
                                    break;
                                case '4':
                                    $twoyony = 'ملياران';
                                    break;
                            }
                            if ($threey != 0) {
                                $twoyony = 'و' . $twoyony;
                            }
                            $return = $return . ' ' . $twoyony;
                        } else if ($twoyony == 1) {
                            switch ($place) {
                                case '1':
                                    $twoyony = $words[$mf[$place]]['1'];
                                    break;
                                case '2':
                                    $twoyony = 'ألف';
                                    break;
                                case '3':
                                    $twoyony = 'مليون';
                                    break;
                                case '4':
                                    $twoyony = 'مليار';
                                    break;
                            }
                            if ($threey != 0) {
                                $twoyony = 'و' . $twoyony;
                            }
                            $return = $return . ' ' . $twoyony;
                        } else {
                            if (isset($words[$mf[$place]][$twoyony])) $twoyony = $words[$mf[$place]][$twoyony];
                            else {
                                $twoy = $number[1] * 10;
                                $ony = $number[2];
                                $twoyony = $words[$mf[$place]][$ony] . ' و' . $words[$mf[$place]][$twoy];
                            }
                            if ($twoyony != '' && $threey != 0) $return = $return . ' و' . $twoyony;
                            switch ($place) {
                                case '2':
                                    {
                                        $return .= ' ألف';
                                    }
                                    break;
                                case '3':
                                    {
                                        $return .= ' مليون';
                                    }
                                    break;
                                case '4':
                                    {
                                        $return .= ' مليار';
                                    }
                                    break;
                            }
                        }
                    }
                }
                break;
        }
        return $return;
    }
}

if (!function_exists('committee_members_by_year')) {
    function committee_members_by_year($committee, $year)
    {

    }
}

if (!function_exists('clean_text')) {
    function clean_text($text)
    {
        $text = str_replace('_', ' ', $text);
        $text = str_replace('-', ' ', $text);
        $text = str_replace(',', ' ', $text);
        return $text;
    }
}

if (!function_exists('third_party_member_id_type_values')) {
    function third_party_member_id_type_values($input)
    {
        $customValue = explode('.', $input);
        $checkType = $customValue[0];
        $checkId = $customValue[1];
        return ['id' => $checkId, 'type' => $checkType];
    }
}

if (!function_exists('translate_date')) {
    function translate_date($date = null, $returnType = 'full', $returnLang = 'auto')
    {
        if ($date == null) $date = date('Y-m-d');
        $arabicDays = array('الاثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت', 'الأحد');
        $englishDays = array('Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun');
        $day = date('D', strtotime($date));
        $translatedDate = str_replace($englishDays, $arabicDays, $day);
        if ($returnLang == 'en') $translatedDate = $day;
        if ($returnType == 'day') return $translatedDate;

        $arabicMonths = array('يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو', 'يوليو', 'اغسطس', 'سبتمبر', 'اكتوبر', 'نوفمبر', 'ديسمبر');
        $englishMonths = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
        $month = date('M', strtotime($date));
        $translatedMonth = str_replace($englishMonths, $arabicMonths, $month);
        if ($returnLang == 'en') $translatedMonth = $month;
        if ($returnType == 'month') return $translatedMonth;

        $arabicTime = array('م', 'ص');
        $englishTime = array('PM', 'AM');
        $time = date('A', strtotime($date));
        $translatedTime = str_replace($englishTime, $arabicTime, $time);
        $translatedTime = date('h:i', strtotime($date)) . ' ' . $translatedTime;
        if ($returnLang == 'en') $translatedTime = $time;
        if ($returnType == 'time') return $translatedTime;

        $finalDate = $translatedDate . ' ' . date('d', strtotime($date)) . ' ' . $translatedMonth . ' ' . date('Y', strtotime($date));
        if ($returnType == 'date') return $finalDate;

        return $finalDate . ' ' . date('h:i', strtotime($date)) . ' ' . $translatedTime;
    }
}

if (!function_exists('array_flatten')) {
    function array_flatten(array $array)
    {
        return \Illuminate\Support\Arr::flatten($array);
    }
}

if (!function_exists('setting_tab_name')) {
    function setting_tab_name($name)
    {
        return str_replace('_', '-', $name);
    }
}

if (!function_exists('check_array_key_exists')) {
    function check_array_key_exists($key, $searchContainer)
    {
        if (is_null($key)) return true;
        if (is_object($searchContainer)) {
            return property_exists($searchContainer, $key);
        } else {
            return isset($searchContainer[$key]);
        }
    }
}

if (!function_exists('check_available_kpi_period')) {
    function check_available_kpi_period($type, $training = null)
    {
        $kpiSetting = [];

        if (in_array($type, [KPIQuestion::KPI_MEMBER, KPIQuestion::KPI_SECRETARY])) {
            $kpiSetting = Setting::whereIn('id', [Setting::KPI_KEY_START_BOARD_MEMBER, Setting::KPI_KEY_END_BOARD_MEMBER])
                ->get();
        }

        if (in_array($type, [KPIQuestion::KPI_CEO, KPIQuestion::KPI_CEO_SECRETARY])) {
            $kpiSetting = Setting::whereIn('id', [Setting::KPI_KEY_START_CEO, Setting::KPI_KEY_END_CEO])
                ->get();
        }

        if (in_array($type, [KPIQuestion::KPI_COMMITTEE, KPIQuestion::KPI_COMMITTEE_SECRETARY])) {
            $kpiSetting = Setting::whereIn('id', [Setting::KPI_KEY_START_COMMITTEE, Setting::KPI_KEY_END_COMMITTEE])
                ->get();
        }

        if ($type == KPIQuestion::KPI_BOARD_SECRETARY) {
            $kpiSetting = Setting::whereIn('id', [Setting::KPI_KEY_START_BOARD, Setting::KPI_KEY_END_BOARD])
                ->get();
        }

        if (in_array($type, [KPIQuestion::KPI_COMMITTEE_MEMBER, KPIQuestion::KPI_COMMITTEE_MEMBER_SECRETARY])) {
            $kpiSetting = Setting::whereIn('id', [Setting::KPI_KEY_START_COMMITTEE_MEMBER, Setting::KPI_KEY_END_COMMITTEE_MEMBER])
                ->get();
        }

        $today = date('Y-m-d');

        if ($kpiSetting != []) {
            $startDate = date('Y') . '-' . $kpiSetting[0]->value;
            $endDate = date('Y') . '-' . $kpiSetting[1]->value;
            if (($startDate != null) && ($startDate <= $today)) return true;
//            if (($startDate != null) && ($endDate != null) && ($startDate <= $today) && ($today <= $endDate)) return true;
        }

        if (($type == KPIQuestion::KPI_TRAINING) && ($training != null)) {
            if ($training['end_date'] != null) {
                $kpiSetting = Setting::find(Setting::KPI_KEY_START_TRAINING);
                $startDate = $training['end_date'];
                if (!in_array($kpiSetting['value'], [0, null])) {
                    $startDate = date('Y-m-d', strtotime('+' . $kpiSetting['value'] . ' days', strtotime($startDate)));
                }
                if ($startDate <= $today) return true;
            }
            // check today > end training + setting kpi days
        }
        return false;
    }
}

if (!function_exists('array_string_to_int')) {
    function array_string_to_int($array = [])
    {
        return array_map('intval', $array);
    }
}

if (!function_exists('array_remove_value')) {
    function array_remove_value($array = [], $value = null)
    {
        if (($key = array_search($value, $array)) !== false) unset($array[$key]);
        return $array;
    }
}

if (!function_exists('clean_html_input_value')) {
    function clean_html_input_value(string $value = null)
    {
        if ($value != null) {
            // Order of replacement
            $order = array("\r\n", "\n", "\r");
            $replace = '<br>';

            // Processes \r\n's first so they aren't converted twice.
            $value = str_replace($order, $replace, $value);

            $value = str_replace('\t', '   ', $value);

            return $value;
        }
    }
}

if (!function_exists('html_to_text')) {
    function html_to_text(string $value = null)
    {
        if ($value != null) {
            return clean_html_input_value(html_entity_decode(strip_tags($value)));
        }
    }
}

if (!function_exists('get_id_of_route')) {
    function get_id_of_route($route = null, $initValue = null)
    {
        if ($route) {
            $routeAsArray = explode('/', $route);
            $routeAsArray = array_slice($routeAsArray, 3);
            foreach ($routeAsArray as $routePart) {
                if (!is_numeric($routePart)) continue;
                if ($initValue == null) $initValue = (int)$routePart;
                break;
            }
        }

        return $initValue;
    }
}


if (!function_exists('sync_with_soft_deletes')) {
    function sync_with_soft_deletes(Model $model, string $relationName, $requestValues = [], $relatedColumn = 'id')
    {
        $requestValues = array_unique(array_string_to_int($requestValues));
        $beforeSyncItems = $model->$relationName;
        $beforeSyncRelatedIds = $beforeSyncItems->pluck($relatedColumn)->toArray();
        $missingItems = array_diff($beforeSyncRelatedIds, $requestValues);

        // remove missing items in request
        $model->$relationName()->updateExistingPivot($missingItems, ['deleted_at' => \Carbon\Carbon::now()]);

        // new added items
        $newItems = array_diff($requestValues, $beforeSyncRelatedIds);
        $model->$relationName()->attach($newItems);
    }
}
if (!function_exists('shortNumber')) {
    function shortNumber($num)
    {
        $units = ['', 'K', 'M', 'B', 'T'];
        for ($i = 0; $num >= 1000; $i++) {

            $num /= 1000;
        }
        return $i < 5 ? round($num, 2) . $units[$i] : "Infinite";
    }
}