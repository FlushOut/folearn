<?php require_once("../config.php");

if (isset($_POST['id'])) $id = $_POST['id'];
if (isset($_POST['idMob'])) $id = $_POST['idMob'];
if (isset($_POST['idUsers'])) $idUsers = $_POST['idUsers'];
if (isset($_POST['dtStart'])) $dtStart = $_POST['dtStart'];
if (isset($_POST['dtEnd'])) $dtEnd = $_POST['dtEnd'];
if (isset($_POST['dt'])) $dt = $_POST['dt'];
if (isset($_POST['data'])) $data = $_POST['data'];

switch ($_POST['action']) {
    case 'getProfiles':
		getProfiles($id);
		break;
    case 'getScheduleDetails':
        getScheduleDetails($id,$dt);
        break;
    case 'getSchedulesByIdMonth':
        getSchedulesByIdMonth($id,$dt);
        break;
    case 'getDisciplinesUser':
        getDisciplinesUser($id,$company->fk_country);
        break;
    case 'getLessonDetails':
        getLessonDetails($id,$idMob);
        break;
	default:
        # code...
        break;

}

function getProfiles($idUser){
	$user = new user();
	$html = "";
	$user->open($idUser);
	$list_profiles = $user->list_profiles();
    foreach ($list_profiles as $item) {
    	$html.= '<label class="checkbox">';
    	$html.= '<input type="checkbox" data-form="uniform" name="prof[]" value="'.$item['_id'].'"';
    	foreach($user->profiles as $p){
            if ($item['_id'] == $p) { 
            	$html.=	' checked ';
            } 
        } 
    	$html.=' />';
    	$html.= $item['description'];
    	$html.= '</label>';
    }
    echo $html;
}

function getScheduleDetails($idUser,$dtSchedule){
    $schedule = new schedule();
    $html = "";
    $schedule->openByUserDate($idUser,$dtSchedule);
    
    $count = 0;
    $html.= '<div id="column1-wrap">';
    $html.= '<div id="column1">';
    foreach ($schedule->list_hours as $key=>$item) {
        if($count == 12){
            $html.= '</div>';
            $html.= '</div>';
            $html.= '<div id="column2">';    
        }
        $html.= '<label class="checkbox">';
        $html.= '<input type="checkbox" data-form="uniform" name="scheDet[]" value="'.$key.'"';

        foreach($schedule->hours as $sd){            
            if ($key == $sd) { 
                $html.= ' checked ';
            } 
        } 
        $html.=' />';
        $html.= $key;
        $html.= '</label>';
        $count++;
    }
    $html.= '</div>';        
    $html.= '<div id="clear"></div>';

    $data['html'] = $html;
    if($schedule->id){
        $data['id'] = $schedule->id;
    }else{
        $data['id'] = 0;
    }
    echo json_encode($data);
}

function getSchedulesByIdMonth($idUser,$month){
    $schedule = new schedule();
    $data['schedule'] = $schedule->getSchedulesByIdMonth($idUser,$month);
    echo json_encode($data);

}

function getDisciplinesUser($idUser,$idCountry){
    $user = new user();
    $country = new country();
    $discipline_type = new disciplinetype();
    $discipline =  new discipline();
    $html = "";
    $htmlcontent = "";
    $user->open($idUser);
    $list_discipline_types = $discipline_type->list_disc_types();
    $country->open($idCountry);

    $count = 0;
    $html.='<ul class="nav nav-tabs">';
    $htmlcontent.='<div class="control-group">';
    $htmlcontent.='<div class="controls form-inline">';
    $htmlcontent.='<div class="tab-content">';
    foreach ($list_discipline_types as $item) {
        $count++;
        if($count == 1){
            $html.='<li class="active">';
            $htmlcontent.= '<div class="tab-pane fade in active" id="'.$item->id.'-'.$item->description.'">';
        }else{
            $html.='<li>';
            $htmlcontent.= '<div class="tab-pane fade" id="'.$item->id.'-'.$item->description.'">';
        }
        $html.='<a data-toggle="tab" href="#'.$item->id.'-'.$item->description.'">'.$item->description.'</a>';
        $html.='</li>';
        $list_discipline = $discipline->listByType($item->id);
        foreach ($list_discipline as $itemDisc) {
            $priceDisc = "";
            $htmlcontent.= '<label style="margin-left: 10px !important; margin-bottom: 20px !important; margin-bottom-right: 0px !important; width:210px;" class="checkbox">';
            $htmlcontent.= '<input type="checkbox" data-form="uniform" name="discPrice[]" value="'.$itemDisc->id.'"';
            foreach ($user->disciplines as $ud){
                list($disc, $price) = split(' - ', $ud);
                if ($disc == $itemDisc->id) { 
                    $htmlcontent = substr($htmlcontent, 0,-1);
                    $htmlcontent.= ' - '.$price.'" checked';
                    $priceDisc = ' - ('.$country->currency.') '.$price;
                }
            }
            $htmlcontent.= ' />';
            $htmlcontent.= $itemDisc->description.$priceDisc;
            $htmlcontent.= '</label>';
        }
        $htmlcontent.='</div>';
    }
    $htmlcontent.='</div>';
    $htmlcontent.='</div>';
    $htmlcontent.='</div>';
    $html.='</ul>';
    
    echo $html.$htmlcontent;
}

function getLessonDetails($idCli,$idMob){
    $lesson = new lesson();
    $html = "";
    $list_lesson_details = $lesson->list_lesson_details($idCli,$idMob);
    foreach ($list_lesson_details as $item) {
        $html.= '<label class="control-label">';
        $html.= '• '.$item['interval'];
        $html.= '</label>';
    }
    echo $html;

}





