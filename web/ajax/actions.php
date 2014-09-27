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
    case 'getSchedulesByUserDate':
        getSchedulesByUserDate($idUsers,$dtStart,$dtEnd);
        break;
    case 'getLessonsByStatUserDate':
        getLessonsByStatUserDate($id,$idUsers,$dtStart,$dtEnd,$company->fk_country);
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

function getSchedulesByUserDate($idUsers,$dtStart,$dtEnd){

    $users = "";
    foreach($idUsers as $u) {
        $users .= $u.",";
    }
    $users = substr($users, 0, -1);

    $schedule = new schedule();
    $data = array();
    $i = 0;

    $list_schedules = $schedule->getByUserDate($users,$dtStart,$dtEnd);
    $html.= '<table id="datatables" class="table table-bordered table-striped responsive">';
    $html.= '   <thead>';
    $html.= '       <tr>';
    $html.= '           <th class="head0">User</th>';
    $html.= '           <th class="head1">Date</th>';
    $html.= '           <th class="head0">Month</th>';
    $html.= '           <th class="head1">Day</th>';
    $html.= '           <th class="head0">Hours</th>';
    $html.= '       </tr>';
    $html.= '   </thead>';
    $html.= '   <tbody>';
                foreach($list_schedules as $value){
                    $i = $i + 1;
    $html.= '       <tr src="schedule-report">';
    $html.= '           <td>'.$value['user'].'</td><input name="hdId" type="hidden" value="'.$value['id'].'"/>';
    $html.= '           <td>'.$value['date'].'</td>';
    $html.= '           <td>'.$value['month'].'</td>';
    $html.= '           <td>'.$value['day'].'</td>';
    $html.= '           <td><a href="#myModalHours" role="button" class="btn btn-link" data-toggle="modal" id="aHours">'.$value['hours'].'</a></td>';
    $html.= '       </tr>';
                }
    $html.= '   </tbody>';
    $html.= '</table>';

    $data['html'] = $html;
    $data['count'] = $i;

    echo json_encode($data);               
}

function getLessonsByStatUserDate($idStatus,$idUsers,$dtStart,$dtEnd,$idCountry){

    $country = new country();
    $country->open($idCountry);

    $users = "";
    foreach($idUsers as $u) {
        $users .= $u.",";
    }
    $users = substr($users, 0, -1);

    $lesson = new lesson();
    $data = array();
    $i = 0;

    $list_lessons = $lesson->getByStatUserDate($idStatus,$users,$dtStart,$dtEnd);
    $html.= '<table id="datatables" class="table table-bordered table-striped responsive">';
    $html.= '   <thead>';
    $html.= '       <tr>';
    $html.= '           <th class="head0">Date</th>';
    $html.= '           <th class="head1">User</th>';
    $html.= '           <th class="head0">Client</th>';
    $html.= '           <th class="head1">Discipline</th>';
    $html.= '           <th class="head0">Hours</th>';
    $html.= '           <th class="head1">Gross Value</th>';
    $html.= '           <th class="head0">Discount Value</th>';
    $html.= '           <th class="head1">Total Value</th>';
    $html.= '           <th class="head0">Evaluation</th>';
    $html.= '       </tr>';
    $html.= '   </thead>';
    $html.= '   <tbody>';
                foreach($list_lessons as $value){
                    $i = $i + 1;
    $html.= '       <tr src="lesson-report">';
    $html.= '           <td>'.$value['date'].'</td>';
    $html.= '           <td>'.$value['user'].'</td><input name="hdId" type="hidden" value="'.$value['id'].'"/><input name="hdIdMob" type="hidden" value="'.$value['fk_mobile'].'"/><input name="hdIdCli" type="hidden" value="'.$value['fk_client'].'"/>';
    $html.= '           <td>'.$value['client'].'</td>';
    $html.= '           <td>'.$value['discipline'].'</td>';
    $html.= '           <td><a href="#myModalHours" role="button" class="btn btn-link" data-toggle="modal" id="aHours">'.$value['hours'].'</a></td>';
    $html.= '           <td>('.$country->currency.') '.$value['value_wo_discount'].'</td>';
    $html.= '           <td>('.$country->currency.') '.$value['value_discount'].'</td>';
    $html.= '           <td>('.$country->currency.') '.$value['value_total'].'</td>';
    if($value->evaluation > 0){
        $html.= '           <td><a href="#myModalEval" role="button" class="btn btn-link" data-toggle="modal" id="aEval">See</a></td>';
    }else{
        $html.= '           <td>Not evaluated</td>';
    }
    $html.= '       </tr>';
                }
    $html.= '   </tbody>';
    $html.= '</table>';

    $data['html'] = $html;
    $data['count'] = $i;

    echo json_encode($data);               
}





