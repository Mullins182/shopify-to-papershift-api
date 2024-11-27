<?php


//------------------------ GET FUNCTIONS ---------------------------------------------

function getUsersPapershift($api_token, $id = NULL, $external_id = NULL, $location_ids = NULL, $location_external_ids = NULL, $working_area_ids = NULL, $working_area_external_ids = NULL){
  $url = "https://app.papershift.com/public_api/v1/users?".http_build_query(buildBlock(__FUNCTION__, func_get_args()));
  return getPapershiftData($url, "users");
}

function getUserByIdPapershift($api_token, $id = NULL, $external_id = NULL, $location_ids = NULL, $location_external_ids = NULL, $working_area_ids = NULL, $working_area_external_ids = NULL){
  $url = "https://app.papershift.com/public_api/v1/users?".http_build_query(buildBlock(__FUNCTION__, func_get_args()));
  return getPapershiftData($url);
}

function getAbsencesPapershiftCheck($api_token, $id = NULL, $external_id = NULL, $range_start = NULL, $range_end = NULL, $user_id = NULL, $user_external_id = NULL){
  $url = "https://app.papershift.com/public_api/v1/absences?".http_build_query(buildBlock(__FUNCTION__, func_get_args()));
  return getPapershiftData($url);
}

function getAttendancesPapershift($api_token, $id = NULL, $external_id = NULL, $range_start = NULL, $range_end = NULL, $user_id = NULL, $user_external_id = NULL){
  $url = "https://app.papershift.com/public_api/v1/working_sessions?".http_build_query(buildBlock(__FUNCTION__, func_get_args()));
  return getPapershiftData($url, "working_sessions");
}

function getLocationsPapershift($api_token){
  $url = "https://app.papershift.com/public_api/v1/locations?".http_build_query(buildBlock(__FUNCTION__, func_get_args()));
  return getPapershiftData($url);
}

function getAbsencesPapershift($api_token, $id = NULL, $external_id = NULL, $range_start = NULL, $range_end = NULL, $user_id = NULL, $user_external_id = NULL){
  $url = "https://app.papershift.com/public_api/v1/absences?".http_build_query(buildBlock(__FUNCTION__, func_get_args()));
  return getPapershiftData($url, "absences");
}

function getTagsPapershift($api_token, $id = NULL, $external_id = NULL, $location_id = NULL, $location_external_id = NULL){
  $url = "https://app.papershift.com/public_api/v1/filters?".http_build_query(buildBlock(__FUNCTION__, func_get_args()));
  return getPapershiftData($url);
}
function getWorkingAreasPapershift($api_token, $id = NULL, $external_id = NULL, $location_id = NULL, $location_external_id = NULL ){
  $url = "https://app.papershift.com/public_api/v1/working_areas?".http_build_query(buildBlock(__FUNCTION__, func_get_args()));
  return getPapershiftData($url);
}

function getShiftsPapershift($api_token, $location_id = NULL, $location_external_id = NULL, $working_area_id = NULL, $working_area_external_id = NULL, $range_start = NULL, $range_end = NULL){
  $url = "https://app.papershift.com/public_api/v1/shifts?".http_build_query(buildBlock(__FUNCTION__, func_get_args()));
  return getPapershiftData($url, "shifts");
}
//--------------------------POST FUNCTIONS--------------------------------------------------

function postShiftPapershift($data){
  $url = "https://app.papershift.com/public_api/v1/shifts";
  return postPapershiftData($url, $data);
}

function postUserPapershift($data){
  $url = "https://app.papershift.com/public_api/v1/users";
  return postPapershiftData($url, $data);
}

function postAbsencePapershift($data){
  $url = "https://app.papershift.com/public_api/v1/absences";
  return postPapershiftData($url, $data);
}

function postAttendanceToPapershift($data){
  $url = "https://app.papershift.com/public_api/v1/working_sessions";
  return postPapershiftData($url, $data);
}

function createNewTagPapershift($data){
  $url = "https://app.papershift.com/public_api/v1/filters";
  return postPapershiftData($url, $data);
}

//-----------------------Update FUNCTIONS--------------------------------------------------------

function updateUserPapershift($data){
  $url = "https://app.papershift.com/public_api/v1/users";
  return updatePapershiftData($url, $data);
}

function confirmPapershift($data, $name, $type = "confirm"){
  $url = "https://app.papershift.com/public_api/v1/$name/$type";
  return updatePapershiftData($url, $data);
}

//----------------------DELETE FUNCTIONS-------------------------------------------------------------

function deleteAttendancePapershift($data){
  $url = "https://app.papershift.com/public_api/v1/working_sessions";
  return deletePapershiftData($url, $data);
}

function deleteAbsencePapershift($data){
  $url = "https://app.papershift.com/public_api/v1/absences";
  return deletePapershiftData($url, $data);
}

function deleteUserPapershift($data){ //TODO brauch ich das?
  $url = "https://app.papershift.com/public_api/v1/users";
  return deletePapershiftData($url, $data);
}

//-------------------------------BASE FUNCTIONS-------------------------------------


function getPapershiftData($url, $key = NULL){
  $pageArr = [];

  while($url != null){
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Accept: application/json'));
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
      
    $resp = curl_exec($curl);
    curl_close($curl);
    $res = json_decode($resp, true); // Decode as associative array

    //------- Debugging output -------
    // $outputFile = 'debug/papershift_output_' . date('Y-m-d_H-i-s') . '.txt';
    // $formattedOutput = print_r($res, true);
    // file_put_contents($outputFile, $formattedOutput);

    // -------------END----------------

    if(!isset($res['next_page']) && empty($pageArr)) {
      return isset($key) ? (isset($res[$key]) ? $res[$key] : []) : $res;
    }

    if(isset($key) && isset($res[$key]) && is_array($res[$key])) {
      $pageArr = array_merge($pageArr, $res[$key]);
    } elseif(!isset($key) && is_array($res)) {
      $pageArr = array_merge($pageArr, $res);
    }

    $url = isset($res['next_page']) ? $res['next_page'] : null;
  }

  return $pageArr;
}

function postPapershiftData($url, $data){   

  $curl = curl_init($url);
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_POST, true);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Accept: application/json'));
  curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
  curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

  $resp = curl_exec($curl);

  curl_close($curl);
  return $resp;
}

function updatePapershiftData($url, $data){

  $curl = curl_init($url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
  curl_setopt($curl, CURLOPT_POSTFIELDS, JSON_encode($data));
  curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Accept: application/json'));
    
  $resp = curl_exec($curl);

  curl_close($curl);
  return $resp;
}

function deletePapershiftData($url, $data){     
          
  $curl = curl_init($url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
  curl_setopt($curl, CURLOPT_POSTFIELDS, JSON_encode($data));
  curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Accept: application/json'));
  
  $resp = curl_exec($curl);

  curl_close($curl);
  return $resp;
}

//-------------------------------HELPER FUNCTIONS-------------------------------------

function buildBlock($function, $params){
  $result = array();

  $reflectionFunc = new ReflectionFunction($function);
  $paramsNames = $reflectionFunc->getParameters();

  foreach ($params as $key => $value) {
    $param_name = $paramsNames[$key]->name;
    $result[$param_name] = $value;
  }
  return $result;
}

function getPapershiftId($apikeyPapershift, $user, $contentManager){

  $papershiftUsers = getUsersPapershift($apikeyPapershift);
  foreach ($papershiftUsers as $papershiftUser) {
      if ($papershiftUser->email == $user->email) {
          $contentManager->createCustomAttribute("user_iduser", "papershiftId", $papershiftUser->id, $user->iduser);
          return $papershiftUser->id;
      }
  }

return NULL;
}

function deleteConfirmAbsencePapershift($apikeyPapershift, $type, $absencePapershift){

  $confirmData['api_token'] = $apikeyPapershift;
  $confirmData['absence']['id'] = $absencePapershift->id;
  confirmPapershift($confirmData, $type, "reset");
  
  $deleteData['api_token'] = $apikeyPapershift;
  $deleteData['absence']['id'] = $absencePapershift->id;
  deleteAbsencePapershift($deleteData);
}

function deleteConfirmAttendancePapershift($apikeyPapershift, $type, $attendance){

  $confirmData['api_token'] = $apikeyPapershift;
  $confirmData['working_session']['id'] = $attendance->id;
  confirmPapershift($confirmData, $type, "reset");

  $deleteData['api_token'] = $apikeyPapershift;
  $deleteData['working_session']['id'] = $attendance->id;
  deleteAttendancePapershift($deleteData);
}


function getAttributPapershiftHelper($attribute, $matchAttributes){
  foreach($matchAttributes as $key => $value){
    if($key == $attribute->name) $attribute->papershiftId = $value;
  }
  return $attribute;
}

function matchTagsPapershift($attribute, $tagsPapershift, $papershiftLocation, $apikeyPapershift){
 
  foreach($tagsPapershift as $tag){
  
    if(strtolower(trim($tag->title)) == strtolower(trim($attribute->value))) return $tag->id;
  }
  $data['api_token'] = $apikeyPapershift;
  $data['location_id'] = $papershiftLocation;
  
  $data['title'] = strtolower(trim($attribute->value));
  $newTag = createNewTagPapershift($data);
  return json_decode($newTag)->id;
}

function matchWorkingAreaPapershift($apikeyPapershift, $locationIdPapershift, $searchValue){
  $allWorkingAreas = getWorkingAreasPapershift($apikeyPapershift, location_id : $locationIdPapershift);

  foreach($allWorkingAreas as $area){
    if(strtolower(trim($area->name)) == strtolower(trim($searchValue))) return $area->id;
  }
}

function formatPapershiftDateForDatabase($papershiftDate, $halfDayStartTime, $halfDayEndTime, $dayStart, $dayEnd){

  $absenceTmp = [];
  $absenceArray = [];

  $start = (new dateTime($papershiftDate->starts_at))->setTimezone(new DateTimeZone('Europe/Berlin'))->format('Y-m-d');
  $end = (new dateTime($papershiftDate->ends_at))->setTimezone(new DateTimeZone('Europe/Berlin'))->format('Y-m-d');
  $startTmp = (new dateTime($papershiftDate->starts_at))->setTimezone(new DateTimeZone('Europe/Berlin'))->format('H');
  $endTmp = (new dateTime($papershiftDate->ends_at))->setTimezone(new DateTimeZone('Europe/Berlin'))->format('H');
  
  $data['start'] = (new DateTime($papershiftDate->starts_at))->setTimezone(new DateTimeZone('Europe/Berlin'));
  $data['end'] = (new DateTime($papershiftDate->ends_at))->setTimezone(new DateTimeZone('Europe/Berlin'));
  $data['full_day'] = 1;
  array_push($absenceTmp, $data);

  if($startTmp >= $halfDayStartTime){
    $data['start'] = (new DateTime($papershiftDate->starts_at))->setTimezone(new DateTimeZone('Europe/Berlin'))->format('Y-m-d H:i:s');
    $data['end'] = (new DateTime($start))->setTime($dayEnd, 0)->setTimezone(new DateTimeZone('Europe/Berlin'))->format('Y-m-d H:i:s');
    $data['full_day'] = 0;
    array_push($absenceArray, $data);
    $absenceTmp[0]["start"] = (new dateTime($papershiftDate->starts_at))->modify('+1 day')->setTime($dayStart, 0);
  }

  if($endTmp <= $halfDayEndTime){
    $data['start'] = (new DateTime($papershiftDate->ends_at))->setTime($dayStart, 0)->format('Y-m-d H:i:s');
    $data['end'] = (new DateTime($papershiftDate->ends_at))->setTimezone(new DateTimeZone('Europe/Berlin'))->format('Y-m-d H:i:s');
    $data['full_day'] = 0;
    array_push($absenceArray, $data);
    $absenceTmp[0]["end"] = (new dateTime($papershiftDate->ends_at))->modify('-1 day')->setTime($dayEnd, 0);
  }

  if($start == $end && !empty($absenceArray)) return $absenceArray;

  if($absenceTmp[0]["end"] < $absenceTmp[0]["start"]) return $absenceArray;

  $data['start'] = $absenceTmp[0]["start"]->format('Y-m-d H:i:s');
  $data['end'] = $absenceTmp[0]["end"]->format('Y-m-d H:i:s');
  $data['full_day'] = 1;
  array_push($absenceArray, $data);

 return $absenceArray;
}

function validateDate($date, $format = 'Y-m-d'){
    $res = DateTime::createFromFormat($format, $date);
    return $res && $res->format($format) == $date;
}