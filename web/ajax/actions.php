<?php require_once("../config.php");

if (isset($_POST['id'])) $id = $_POST['id'];
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







