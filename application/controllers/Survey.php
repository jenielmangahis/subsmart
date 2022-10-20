<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Survey extends MY_Controller
{
  public function __construct(){
      parent::__construct();

      $this->page_data['page']->title = 'Survey Wizard';
      $this->page_data['page']->menu = 'Survey';
      $this->load->model('Survey_model', 'survey_model');

      /*add_css(array(
        'https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css',
        'https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials-theme-minima.css',
        'https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.css',
        'https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css',
        'assets/css/survey.css',
      ));*/

      /*add_footer_js(array(
        'https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.2/dragula.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/tributejs/5.1.3/tribute.min.js',
        'assets/js/survey.js',
        'assets/js/social.js',
      ));*/

      add_css(array(
        'https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css',
        'assets/plugins/jssocial/jssocials-theme-flat.css',
        'assets/plugins/jssocial/jssocials.css',
        'https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.0.0/animate.min.css',
        'assets/css/survey.css',
      ));

      add_footer_js(array(
        'assets/plugins/jssocial/jssocials.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/tributejs/5.1.3/tribute.min.js',
        'assets/js/survey.js'        
      ));

      if(!isset($_GET['st'])){
        $this->checkLogin();
        $this->load->library('session');
        $user_id = getLoggedUserID();
      }
      // $this->checkLogin();
      // $this->load->library('session');
      // $user_id = getLoggedUserID();

      // concept
      $uid = $this->session->userdata('uid');

      if (empty($uid)) {

          $this->page_data['uid'] = md5(time());
          $this->session->set_userdata(['uid' => $this->page_data['uid']]);

      } else {

          $uid = $this->session->userdata('uid');
          $this->page_data['uid'] = $uid;
      }
  }

  public function index(){
    $this->page_data['page']->title = 'Survey Wizard';
    $this->page_data['page']->parent = 'Marketing';
    $this->page_data['page']->message = 'What would you like to do?';

    $templates = file_get_contents('application/views/survey/survey_templates.json')    ;

    $this->page_data['surveys'] = $this->survey_model->list();
    foreach($this->page_data["surveys"] as $survey){
      $survey->survey_theme = $this->survey_model->getThemes($survey->theme_id);
    }
    
    $company_id = logged('company_id');
    $this->page_data['survey_workspaces'] = $this->survey_model->getWorkspacesByCompanyId($company_id);
    $this->page_data['survey_templates'] = json_decode($templates);
    $this->page_data['survey_question_templates'] = $this->survey_model->getTemplateQuestions();
    $this->page_data['template_categories'] = array_unique(array_column(json_decode($templates), 'category'));
    $this->page_data["survey_themes"] = $this->survey_model->getThemesByCompanyIdAndIsDefault($company_id);
    // $this->load->view('survey/index.php', $this->page_data);
    $this->load->view('v2/pages/survey/index.php', $this->page_data);
  }

  public function add($settings = null){        
    $data = array(
      'created_by' => $_SESSION['uid'],
      'title' => $this->input->post('title'),
      'workspace_id' => $this->input->post('workspace_id'),
      'theme_id' => $this->input->post('theme_id'),
      'backgroundImage' => $this->input->post('backgroundImage')
    );
    $data = $this->survey_model->add($data);
    
    $result = array(
      'success' => 1,
      'data' => $data
    );
    echo json_encode($result);
      if(!isset($settings->hasTemplate)){
        redirect('/survey/workspace', 'refresh');
      }
    exit;
  }

  public function delete($id){
    $deleteSurvey = $this->survey_model->delete($id);
    $deleteQuestions = $this->survey_model->deleteQuestion($id, "survey");
    $result = array(
      'success' => 1,

    );
    
    redirect('/survey', 'refresh');
    echo json_encode($result);
    exit;
  }

  public function edit($id){        
    $this->page_data['survey'] = $this->survey_model->view($id);
    $this->page_data['survey_theme'] = $this->survey_model->getThemes($this->page_data['survey']->theme_id);
    $this->page_data['survey_workspaces'] = $this->survey_model->getWorkspaces();
    $this->page_data['survey_logic'] = $this->survey_model->getSurveyLogics($id);
    $this->page_data['questions'] = $this->survey_model->getQuestions($id);
    $this->page_data['qTemplate'] = $this->survey_model->getEnabledTemplateQuestions();
    $this->page_data['themes'] = $this->survey_model->getThemes();
    $this->load->view('v2/pages/survey/edit', $this->page_data);
  }

  public function updateSurvey($id, $settings = null, $value = null){
    $error = false;
    
    if($settings == null && $value == null){
      foreach($_POST as $key => $value){
        $data = array($key => $value);
        $this->survey_model->update($id, $data);
      }
    }else{
      
      $data = array($settings => $value);
      $this->survey_model->update($id, $data);
    }


    
    if($error === true){
      $result = array(
        'success' => 0
      );
      echo json_encode($result);
    }else{
      $result = array(
        'success' => 1
      );
      echo json_encode($result);
    }
    exit;
  }

  public function uploadCustomBackgroundImage($id){
    $path = 'uploads/survey/image_custom_background_db';
    $config = [
      'upload_path' 		=> $path,
      'allowed_types' 	=> '*',
      'overwrite' 		=> true
    ];

    
    $_FILES['useCustomBackgroundImage']["name"] = "CB".$id.".". explode('.', $_FILES['useCustomBackgroundImage']['name'])[1];

    $test = $this->upload->initialize($config);
    if ( ! $this->upload->do_upload('useCustomBackgroundImage') ){

    }else{
      $upload_data = $this->upload->data();
    }

    $data["customBackgroundImage"] = $_FILES["useCustomBackgroundImage"]["name"];

    $this->survey_model->update($id, $data);
    
    echo json_encode(array(
      'success' => 1
    ));
    exit;
  }

  public function addQuestion($id, $tid){
    $data = $this->survey_model->addQuestion($id, $tid);
    $result = array(
      'success' => 1,
      'data' => $data,
      'sid' => $id,
    );
    // add_footer_js(array(
    //     'assets/js/survey.js',
    // ));
    echo json_encode($result);
    exit;
  }

  public function addAndUpdateQuestion($id, $tid){
    $data = $this->survey_model->addAndUpdateQuestion($id, $tid);
    
    $result = array(
      'success' => 1,
      'data' => $data,
      'sid' => $id
    );
    // add_footer_js(array(
    //     'assets/js/survey.js',
    // ));
    echo json_encode($result);
    exit;
  }

  public function addAndUpdateQuestionChoices($id, $tid){
    $data = $this->survey_model->addAndUpdateQuestionChoices($id, $tid);
    $result = array(
      'success' => 1,
      'data' => $data,
    );
    // add_footer_js(array(
    //     'assets/js/survey.js',
    // ));
    echo json_encode($result);
    exit;
  }

  public function addTemplateChoices($survey_id){
    $this->survey_model->saveTemplateQuestionChoices($survey_id, $this->input->post('choices'));
    exit;
  }



  public function updateQuestion(){
    
    $id = $this->input->post('survey_id');
    if(isset($_POST['description_label'])){
      $description_label = $_POST['description_label'];
    }else{
      $description_label = "";
    }
    $data = array(
      'question' => $this->input->post('question'),
      'description_label' => $description_label,
      'image_position' =>$this->input->post('image_position'),
      'custom_button_text' => $this->input->post('txtCustomButtonText'),
      'correctAnswer' => $this->input->post('txtCorrectAnswerText'),
      
    );
    $data = $this->survey_model->updateQuestion($id,$data, $_POST);
    $result = array(
      'success' => 1
    );
    echo json_encode($result);
    exit;
  }

  public function deleteQuestion($id){
    $data = $this->survey_model->deleteQuestion($id);
    $result = array(
      'success' => 1
    );
    echo json_encode($result);
    exit;
  }

  public function addQuestionChoice($id, $tid){
    $data = $this->survey_model->addQuestionChoice($id, $tid);
    $result = array(
      'success' => 1,
      'data' => $data,
      'tid' => $tid
    );
    echo json_encode($result);
    exit;
  }

  public function addQuestionUpload($id){   
    $data = array(
      'image_background' => $this->moveUploadedFile($id),
    );

    $this->survey_model->addQuestionImage($id, $data);
    echo json_encode(array(
      'success' => 1
    ));
    exit;
  }

  public function moveUploadedFile( $survey_id ) {
      if(isset($_FILES['file']) && $_FILES['file']['tmp_name'] != '') {
          $target_dir = "./uploads/survey/image_db/" . $survey_id . "/";
          if(!file_exists($target_dir)) {
              mkdir($target_dir, 0777, true);
          }

          $tmp_name = $_FILES['file']['tmp_name'];
          $extension = strtolower(end(explode('.',$_FILES['file']['name'])));
          $name = 'attached_image_'.time().".".$extension;
          move_uploaded_file($tmp_name, $target_dir . $name);

          return $name;
      }
  }

  public function preview($id){
    add_css(array(
        'assets/dashboard/css/bootstrap.min.css',
    ));

    $this->page_data['survey'] = $this->survey_model->view($id);
    $this->page_data['questions'] = $this->survey_model->getQuestions($id);
    $this->page_data['survey_theme'] = $this->survey_model->getThemes($this->page_data['survey']->theme_id);
    $this->load->view('survey/preview', $this->page_data);
  }

  public function answer($id){
    // payment
    /*if($this->input->post('stripeToken') != NULL){
      require_once('application/libraries/stripe-php/init.php');
      \Stripe\Stripe::setApiKey("sk_test_mMoB3fX3PZwWzdDGj1EwGr9E004bgLdyLv");
      
      \Stripe\Charge::create ([
        "amount" => 100 * 100,
        "currency" => "usd",
        "source" => $this->input->post('stripeToken'),
        "description" => "Test payment from itsolutionstuff.com." 
        ]);
      
      unset($_POST['answer']);
      unset($_POST['stripeToken']);
    }*/
    $answered = $this->survey_model->saveAnswer($_POST, $_FILES,$id);
    echo json_encode($answered);
    exit;
  }


  public function orderUpdate(){

    if( $_POST['id'] ){
      $data = array_unique($_POST['id']);
      $data = $this->survey_model->orderUpdate($data);
      $result = array(
        'success' => 1
      );  
    }else{
      $result = array(
        'success' => 0
      );  
    }
    
    echo json_encode($result);
    exit;
  }

  public function addQuestionSettings($settings, $id,$is){
    $data = array($settings => $is);
    $data = $this->survey_model->addQuestionSettings($data, $id);
    $result = array(
      'success' => 1,
    );
    echo json_encode($result);
    exit;
  }

  public function result($id){
    $templates = file_get_contents('application/views/survey/survey_templates.json')    ;
    $this->page_data['survey'] = $this->survey_model->view($id);
    $this->page_data['questions'] = $this->survey_model->getQuestions($id);
    $this->page_data['survey_templates'] = json_decode($templates);
    $this->page_data['survey_question_templates'] = $this->survey_model->getTemplateQuestions();
    $this->page_data['template_categories'] = array_unique(array_column(json_decode($templates), 'category'));
    $this->page_data['survey_templates'] = $this->survey_model->getThemes();
    $this->page_data['survey_theme'] = $this->survey_model->getThemes($this->page_data['survey']->theme_id);
    $this->load->view('v2/pages/survey/result', $this->page_data);
  }
  
  public function share($id){
    $this->page_data['survey'] = $this->survey_model->view($id);
    $this->load->view('survey/shared_preview', $this->page_data);
  }

  public function getQuestions(){
    $questions = $this->survey_model->getQuestions($_GET['id']);
    $data = array();
    foreach ($questions as $key => $value) {
      $question_number = $key;
      $question = array('id'=> $value->survey_id ,'key' => "".$value->question."", 'value' => "[shortcode-".$question_number."]");
      $data[] = $question;
    }
    echo json_encode($data);
    exit;
  }

  public function addSurvey(){
    $templates = file_get_contents('application/views/survey/survey_templates.json');
    $this->page_data['survey_themes'] = $this->survey_model->getThemes();
    $this->page_data['survey_workspaces'] = $this->survey_model->getWorkspaces();
    $this->page_data['survey_templates'] = json_decode($templates);
    $this->page_data['survey_question_templates'] = $this->survey_model->getTemplateQuestions();
    $this->page_data['template_categories'] = array_unique(array_column(json_decode($templates), 'category'));
    $this->load->view('v2/pages/survey/add', $this->page_data);
  }

  /* THEMES */
  public function themeIndex(){
    
    $company_id = logged('company_id');
    $this->page_data['themes'] = $this->survey_model->getThemesByCompanyId($company_id);
    $this->load->view('survey/themes/list', $this->page_data);
  }
  

  public function themeView($id){
    
    $this->page_data['theme'] = $this->survey_model->getThemes($id);
    $this->load->view('survey/themes/view', $this->page_data);
  }

  public function themeCreate(){        
    $this->load->view('v2/pages/survey/themes/create', $this->page_data);
  }

  public function themeEdit($id){    
    $this->page_data['theme'] = $this->survey_model->getThemes($id);
    $this->load->view('v2/pages/survey/themes/edit',$this->page_data);
  }

  public function selectTheme($survey_id, $theme_id){
    $this->db->set('theme_id', $theme_id);
    $this->db->where('id', $survey_id);
    $this->db->update('survey');
    redirect('survey/edit/'.$survey_id);
  }

  public function addTheme(){
    
    //$filename   = $_POST["sth_theme_name"];
    $filename   = 'theme_image_'.time();
    $company_id = logged('company_id');

    //$path = 'uploads/survey/themes';
    $path = "./uploads/survey/themes/$company_id/";
      
    if(!file_exists($path)) {
      mkdir($path, 0777, true);
    }

    $config = [
      'file_name' => strtolower($filename),
      'upload_path' 		=> $path,
      'allowed_types' 	=> '*',
      'overwrite' 		=> false,
    ];

    $_POST['company_id'] = $company_id;
    $_POST["sth_primary_image"] = strtolower($filename).".jpg";
    $test = $this->upload->initialize($config);
    $this->upload->do_upload('filePrimaryImage');
    unset($_POST['name-button']);
    $this->survey_model->addTheme($_POST);
    redirect('survey');
  }

  public function updateTheme($id){

    $theme = $this->survey_model->getThemes($id);

    $filename   = 'theme_image_'.time();
    $company_id = logged('company_id');

    $path = "./uploads/survey/themes/$company_id/";
    if(!file_exists($path)) {
      mkdir($path, 0777, true);
    }

    if($_FILES["filePrimaryImage"]["name"] !== "" || $_FILES["filePrimaryImage"]["size"] !== 0){
      $config = [
        'file_name' => strtolower($filename),
        'upload_path'     => $path,
        'allowed_types'   => '*',
        'overwrite'     => false,
      ];

      $_POST['company_id'] = $company_id;
      $_POST["sth_primary_image"] = strtolower($filename).".jpg";
      $test = $this->upload->initialize($config);
      $this->upload->do_upload('filePrimaryImage');
    }else{
      $_POST["sth_primary_image"] = $theme->sth_primary_image;
    }

    unset($_POST['name-button']);
    $this->survey_model->updateTheme($id, $_POST);
    redirect('survey');
  }  


  
  /** WORKSPACES **/

  public function workspaceList(){
    
    $this->page_data['survey_workspaces'] = $this->survey_model->getWorkspaces();
    $this->load->view('survey/workspace', $this->page_data);
  }

  public function addWorkspace(){
    
    $data = array(
      "name" => $this->input->post('txtWorkspaceName'),
      "users" => '',
      "company_id" => logged('company_id')

    );
    $this->survey_model->addWorkspace($data);
    $result = array(
      'success' => 1,
      'id' => $this->db->insert_id()
    );
    echo json_encode($result);
    if(isset($_GET['redirect'])){
      //redirect('survey/workspace');
      redirect('survey');
    }
  }

  public function deleteWorkspace($id){
    $deleteWorkspace = $this->survey_model->deleteWorkspace($id);
    $result = array(
      'success' => 1,
    );
    
    redirect('survey/workspace', 'refresh');
    echo json_encode($result);
    exit;
  }

  public function editWorkspace($id){
    $data = array(
      "name" => $this->input->post('txtWorkspaceName')
    );
    $this->survey_model->editWorkspace($id, $data);
    $result = array(
      'success' => 1,
    );
    echo json_encode($result);
    exit;
  }

  // survey logic

  public function surveyLogicList($survey_id){
    $logics = $this->survey_model->getSurveyLogics($survey_id);
    echo json_encode($logics);
    exit;
  }

  public function addLogicJump(){    

    $data = array(
      "si_survey_id" => $this->input->post('surveyId')
    );
    
    $this->survey_model->addToSurveyLogic($data);

    $result = array(
      "success" => 1
    );
    echo json_encode($result);
    exit;
  }

  public function ajax_load_survey_questions()
  {
    $post       = $this->input->post();
    $survey_id = $post['survey_id'];
    $this->page_data['questions'] = $this->survey_model->getQuestions($survey_id);
    $this->load->view('v2/pages/survey/ajax_load_survey_questions', $this->page_data);
  }

  public function ajax_delete_template_answer()
  {
    $post = $this->input->post();    
    $this->survey_model->deleteSurveyTemplateAnswer($post['staid']);

    $result = array(
      'success' => 1
    );

    echo json_encode($result);
    exit;
  }

  public function ajax_update_settings()
  {
      $is_success = false;
      $post = $this->input->post();   

      if( $post['sid'] > 0 ){
        $survey = $this->survey_model->view($post['sid']);
        if( $survey ){

          $isScoreMonitored = 0;
          if( isset($post['isScoreMonitored']) ){
            $isScoreMonitored = 1;
          }

          $canRedirectOnComplete = 0;
          $redirectionLink = '';
          if( isset($post['can_redirect_oncomplete']) ){
            $canRedirectOnComplete = 1;
            $redirectionLink = $post['txtRedirectionLink'];
          }

          $hasProgressBar = 0;
          if( isset($post['show_progress']) ){
            $hasProgressBar = 1;
          }

          $data = [
            'title' => $post['txtSurveyTitle'],
            'workspace_id' => $post['selWorkspace'],
            'isScoreMonitored' => $isScoreMonitored,
            'hasProgressBar' => $hasProgressBar,
            'canRedirectOnComplete' => $canRedirectOnComplete,
            'redirectionLink' => $redirectionLink,
          ];

          $this->survey_model->update($post['sid'], $data);

          $is_success = true;
        }
      }

      $json_data = ['is_success' => $is_success];
      echo json_encode($json_data);
  }

  public function ajax_delete_survey()
  {
    $is_success = 0;

    $post = $this->input->post();
    $survey = $this->survey_model->view($post['survey_id']);
    if( $survey ){
      $deleteSurvey = $this->survey_model->delete($post['survey_id']);
      $deleteQuestions = $this->survey_model->deleteQuestion($post['survey_id'], "survey");

      $is_success = 1;
    }
    
    $json_data = ['is_success' => $is_success];

    echo json_encode($json_data);
  }

  public function ajax_delete_theme()
  {
    $is_success = 0;

    $post = $this->input->post();    
    $theme      = $this->survey_model->getThemes($post['tid']);
    $company_id = logged('company_id');

    if( $theme ){
      if( $theme->company_id == $company_id ){
        $this->survey_model->deleteThemeBySthRecNo($post['tid']); 
        $is_success = 1;   
      }
    }    

    $result = array(
      'success' => $is_success
    );

    echo json_encode($result);
    exit;
  }

  public function ajax_load_survey_logic_jump()
  {
    $post = $this->input->post();    

    $id = $post['survey_id'];    
    $this->page_data['survey'] = $this->survey_model->view($id);
    $this->page_data['survey_logic'] = $this->survey_model->getSurveyLogics($id);
    $this->page_data['questions'] = $this->survey_model->getQuestions($id);
    $this->load->view('v2/pages/survey/ajax_load_survey_logic_jump', $this->page_data);
  }

  public function ajax_logic_add()
  {
    $post = $this->input->post();    

    $id = $post['survey_id'];    
    $this->page_data['survey'] = $this->survey_model->view($id);
    $this->page_data['questions'] = $this->survey_model->getQuestions($id);
    $this->load->view('v2/pages/survey/ajax_logic_add', $this->page_data);
  }

  public function ajax_update_survey_logic()
  {
    $is_success = 0;
    $msg        = '';

    $post = $this->input->post();

    foreach( $post['selectIfQuestionFrom'] as $key => $value ){
      if( $post['selectCondition'][$key] != '' && $post['selectAnswer'][$key] != '' && $post['selectAnswer'][$key] != '' ){
        $data[] = [
          'sl_survey_id' => $post['survey_id'],
          'sl_question_id_from' => $value,
          'sl_question_id_to' => $post['selectJumpQuestion'][$key],
          'sl_value' => $post['selectAnswer'][$key],
          'sl_condition' => $post['selectCondition'][$key]
        ];

      }else{
        $msg = 'Please check your entries and try again.';
        break;
      }
    }

    if( $msg == '' ){
      $this->survey_model->deleteAllSurveyLogicBySurveyId($post['survey_id']);
      foreach($data as $values){
        $this->survey_model->addSurveyLogic($values);
        $is_success = 1;
      }  
    }

    $json_data = ['is_success' => $is_success, 'msg' => $msg];
    echo json_encode($json_data);

  }

  public function ajax_load_themes_list()
  {
    $company_id = logged('company_id');
    $this->page_data['themes'] = $this->survey_model->getThemesByCompanyId($company_id);
    $this->load->view('v2/pages/survey/themes/list', $this->page_data);
  }

}
