<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopify to Papershift API</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>

    <!-- BUTTONS/LABELS -->
    <div class="div-buttons">
    <label class="btn-label">GETTER</label>
    <button class="btn-getter" id="get-btn-userById">Get User By Id from Papershift</button>
    <button class="btn-getter" id="get-btn-users">Get Users from Papershift</button>
    <button class="btn-getter" type="button" id="get-btn-shifts">Get Shifts from Papershift</button>
    <button class="btn-getter" id="get-btn-tags">Get Tags from Papershift</button>
    <button class="btn-getter" id="get-btn-locations">Get Locations from Papershift</button>
    <button class="btn-getter" id="get-btn-workingAreas">Get Working Areas from Papershift</button>
    <label class="btn-label">SETTER</label>
    <button class="btn-setter" id="set-btn-User">Create New User In Papershift</button>
    <button class="btn-setter" id="set-btn-Shift">Create New Shift In Papershift</button>
    <button class="btn-setter" id="set-btn-Absen">Create User Absence</button>
    <button class="btn-setter" id="set-btn-Tag">Create New Tag In Papershift</button>
    </div>
<!-- <form class="form-elements" method="post"> -->
    <!-- INPUT FIELDS -->
    <div class="div-input-fields">
        <input class="input-field" id="user_id" name="user_id" type="number" placeholder="user_id">
        <input class="input-field" id="username" name="username" type="text" placeholder="username">
        <input class="input-field" id="location_id" name="location_id" type="number" placeholder="location_id">
        <input class="input-field" id="working_area_id" name="working_area_id" type="number" placeholder="working_area_id">
        <input class="input-field" id="absence_type_id" name="absence_type_id" type="number" placeholder="absence_type_id">
        <input class="input-field" id="range_start" name="range_start" type="datetime" placeholder="range_start">
        <input class="input-field" id="range_end" name="range_end" type="datetime" placeholder="range_end">
        <input class="input-field" id="starts_at" name="starts_at" type="datetime" placeholder="starts_at">
        <input class="input-field" id="ends_at" name="ends_at" type="datetime" placeholder="ends_at">
        <input class="input-field" id="number_of_employees" name="number_of_employees" type="number" placeholder="number_of_employees">
        <input class="input-field" id="title" name="title" type="text" placeholder="filter_title">
        <input class="input-field" id="description" name="description" type="text" placeholder="description">
    </div>
<!-- </form> -->

    <?php
        error_reporting(E_ALL);
        ini_set('display_errors', 'On');

        include_once "papershiftFunctions.php";

        
        //************** Var-Init **************

            $dataShopify = ['orders_amount'];

            $data = setValues();
        
        
        //************** PHP-Script Logic **************
            
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])){

            if ($_POST['action'] === 'getShiftsFromPapershift') {


                if ($data['api_token'] == null || $data['shift']['location_id'] == null 
                    || $data['shift']['range_start'] == null || $data['shift']['range_end'] == null){
                        inputError(setValues(), "getShifts");
                    }
                    else{
                        try {
        
                            // echo json_encode($data, JSON_PRETTY_PRINT);
                            $response = getShiftsFromPapershift(setValues());
                            echo json_encode($response, JSON_PRETTY_PRINT);
        
                        } catch (\Throwable $th) {
                            
                            $message = ["EIN ODER MEHRERE DER EINGABEFELDER ENTHALTEN UNGUELTIGE DATEN", "(DATUM MUSS IN DIESEM 
                            FORMAT EINGETRAGEN WERDEN: [1998-12-23] ODER [23.12.1998]", "UND ACHTEN SIE AUF DIE EINGABE EINER GUELTIGEN [location_id] !"];

                            echo $th;
                            // echo json_encode(['error' => $th->getMessage()]);        
                        }
                    }                                

                exit;
            }
            if ($_POST['action'] === 'getTagsFromPapershift') {
                try {
        
                    // echo json_encode($data, JSON_PRETTY_PRINT);
                    $response = getTagsFromPapershift($data);
                    echo json_encode($response, JSON_PRETTY_PRINT);

                } catch (\Throwable $th) {
                    
                    $message = ["EIN ODER MEHRERE DER EINGABEFELDER ENTHALTEN UNGUELTIGE DATEN", "(DATUM MUSS IN DIESEM 
                    FORMAT SEIN: '1998-12-23' ODER '23.12.1998'", "UND ACHTEN SIE AUF DIE EINGABE EINER GUELTIGEN 'location_id' !"];

                    // echo $message;
                    echo $th;

                    // echo json_encode(['error' => $th->getMessage()]);        
                }
                
            }
            if ($_POST['action'] === 'getUserByIdFromPapershift') {      

                if ($data['api_token'] == null || $data['id'] == null){
                    inputError($data, "getUserById");
                }
                else{
                    try {
    
                        // echo json_encode($data, JSON_PRETTY_PRINT);
                        $response = getUserByIdFromPapershift($data);
                        echo json_encode($response, JSON_PRETTY_PRINT);
    
                    } catch (\Throwable $th) {
                        // echo $th;
                        echo $th;
                        // echo json_encode(['error' => $th->getMessage()]);        
                    }
                }

            exit;


            }
            if ($_POST['action'] === 'getUsersFromPapershift') {

        
                try {

                    $response = getUsersFromPapershift($data);
                    echo json_encode($response, JSON_PRETTY_PRINT);
                    
                } catch (\Throwable $th) {

                    echo json_encode(['error' => $th->getMessage()]);

                }

                exit;
            }
            if ($_POST['action'] === 'getWorkingAreasFromPapershift') {
        
                try {

                    $response = getWorkingAreasFromPapershift($data);
                    echo json_encode($response, JSON_PRETTY_PRINT);
                    
                } catch (\Throwable $th) {

                    echo json_encode(['error' => $th->getMessage()]);
                }

                exit;
            }
            if ($_POST['action'] === 'getLocationsFromPapershift') {
        
                try {

                    $response = getLocationsFromPapershift($data);
                    echo json_encode($response, JSON_PRETTY_PRINT);
                    
                } catch (\Throwable $th) {

                    echo json_encode(['error' => $th->getMessage()]);
                }

                exit;
            }
            if ($_POST['action'] === 'setUserInPapershift') {
                setUserInPapershift();
            }
            if ($_POST['action'] === 'setShiftInPapershift') {
                setShiftInPapershift();
            }
            if ($_POST['action'] === 'setUserabsenceInPapershift') {

                if ($data['api_token'] == null || $data['absence']['user_id'] == null || $data['absence']['starts_at'] == null
                    || $data['absence']['absence_type_id'] == null || $data['absence']['ends_at'] == null){
                        inputError(setValues(), "setAbsence");
                    }
                    else{
                        try {
        
                            // echo json_encode($data, JSON_PRETTY_PRINT);
                            $response = postAbsencePapershift($data);
                            echo json_encode($response, JSON_PRETTY_PRINT);
        
                        } catch (\Throwable $th) {
                            
                            echo json_encode(['error' => $th->getMessage()]);
        
                        }
                    }                                

                exit;
            }
            if ($_POST['action'] === 'setTagInPapershift') {

                try {

                    $response = setTagInPapershift($data);
                    echo json_encode($response, JSON_PRETTY_PRINT);
                    
                } catch (\Throwable $th) {

                    echo json_encode(['error' => $th->getMessage()]);
                }

                exit;
            }
        }

        //************** PAPERSHIFT GETTER **************
        function getUserByIdFromPapershift($array): array {

            $response = getUserByIdPapershift($array['api_token'], $array['id']);

            return $response;
        }
        function getShiftsFromPapershift($array): array {

            $response = getShiftsPapershift($array['api_token'], 
             location_id: $array['shift']['location_id'], 
             range_start: $array['shift']['range_start'], 
             range_end: $array['shift']['range_end']);

            return $response;
        }

        function getTagsFromPapershift($array){

            $response = getTagsPapershift($array['api_token'], location_id: $array['location_id']);

            return $response;
        }
        function getUsersFromPapershift($array): array {

            $response = getUsersPapershift($array['api_token']);

            return $response;
        }
        function getWorkingAreasFromPapershift($array): array{

            $response = getWorkingAreasPapershift($array['api_token']);

            return $response;
        }
        function getLocationsFromPapershift(): array{

            $response = getLocationsPapershift("uDQNXUbJRlQuVDawBVS7bxZ0YLFH4ocXYc1yQpOp");

            return $response;
        }
        
        //************** PAPERSHIFT SETTER **************
        function setUserInPapershift(){
            // $data['api_token'] = "uDQNXUbJRlQuVDawBVS7bxZ0YLFH4ocXYc1yQpOp";
            // $data['user']['username'] = "Peter Bond";
            // $data['user']['location_ids'] = "208585";
            // $data['user']['data_profiles']['desc'] = "Mein Name ist Bond, und ich bin nicht blond :)";

            $response = postUserPapershift(setValues());

            echo "<pre>";
            var_dump($response);
            echo "</pre>";
        }

        function setShiftInPapershift(){
            // $data['api_token'] = "uDQNXUbJRlQuVDawBVS7bxZ0YLFH4ocXYc1yQpOp";
            // $data['shift']['location_id'] = 208585;
            // $data['shift']['working_area_id'] = 540799;
            // $data['shift']['starts_at'] = "2024-11-12T09:30:00Z";
            // $data['shift']['ends_at'] = "2024-11-12T15:30:00Z";
            // $data['shift']['number_of_employees'] = 3;

            $response = postShiftPapershift(setValues());

            echo "<pre>";
            var_dump($response);
            echo "</pre>";
        }

        function setUserabsenceInPapershift(){
            // $data['api_token'] = "uDQNXUbJRlQuVDawBVS7bxZ0YLFH4ocXYc1yQpOp";
            // $data['shift']['location_id'] = 208585;
            // $data['shift']['working_area_id'] = 540799;
            // $data['shift']['starts_at'] = "2024-11-12T09:30:00Z";
            // $data['shift']['ends_at'] = "2024-11-12T15:30:00Z";
            // $data['shift']['number_of_employees'] = 3;
            
            $response = postAbsencePapershift(setValues());

            echo "<pre>";
            var_dump($response);
            echo "</pre>";
        }

        function setTagInPapershift($array): string{

            $response = createNewTagPapershift($array);

            return $response;
        }

        //************** Set Array Values **************

        function setValues(): array{
            $data['api_token'] = isset($_POST['api_token']) ? $_POST['api_token'] : null;
            $data['id'] = isset($_POST['id']) ? $_POST['id'] : null;
            $data['user']['username'] = isset($_POST['username']) ? $_POST['username'] : null;
            $data['user']['data_profiles']['desc'] = isset($_POST['description']) ? $_POST['description'] : null;
            $data['location_id'] = isset($_POST['location_id']) ? (int)$_POST['location_id'] : null;
            $data['absence']['user_id'] = isset($_POST['user_id']) ? (int)$_POST['user_id'] : null;
            $data['absence']['absence_type_id'] = isset($_POST['absence_type_id']) ? (int)$_POST['absence_type_id'] : null;
            $data['shift']['location_id'] = isset($_POST['location_id']) ? (int)$_POST['location_id'] : null;
            $data['shift']['range_start'] = isset($_POST['range_start']) ? $_POST['range_start'] : null;
            $data['shift']['range_end'] = isset($_POST['range_end']) ? $_POST['range_end'] : null;
            $data['shift']['starts_at'] = isset($_POST['starts_at']) ? $_POST['starts_at'] : null;
            $data['shift']['ends_at'] = isset($_POST['ends_at']) ? $_POST['ends_at'] : null;
            $data['shift']['working_area_id'] = isset($_POST['working_area_id']) ? $_POST['working_area_id'] : null;
            $data['shift']['number_of_employees'] = isset($_POST['number_of_employees']) ? $_POST['number_of_employees'] : null;
            $data['filter']['title'] = isset($_POST['title']) ? $_POST['title'] : null;

            return $data;
        }

        //************** ERROR HANDLING **************

        function inputError($data, $type){
            $errors = [];
        
            if ($type === "getShifts"){
                if ($data['shift']['location_id'] == null){
                    $errors[] = '[location_id] must be set !';
                }
                if ($data['shift']['range_start'] == null){
                    $errors[] = '[range_start] must be set !';
                }
                if ($data['shift']['range_end'] == null){
                    $errors[] = '[range_end] must be set !';
                }
            }
            else if ($type === "getUserById"){
                if ($data['id'] == null){
                    $errors[] = '[user_id] must be set !';
                }
            }
            else if ($type === "setAbsence"){
                if ($data['absence']['user_id'] == null){
                    $errors[] = '[user_id] must be set !';
                }
                if ($data['absence']['absence_type_id'] == null){
                    $errors[] = '[absence_type_id] must be set !';
                }
                if ($data['absence']['starts_at'] == null){
                    $errors[] = '[starts_at] must be set !';
                }
                if ($data['absence']['ends_at'] == null){
                    $errors[] = '[ends_at] must be set !';
                }
            }
        
            if (!empty($errors)) {
                echo json_encode(['errors' => $errors], JSON_PRETTY_PRINT);
                exit;
            }
        }    
    ?>

    <script src="script.js"></script>

</body>
</html>