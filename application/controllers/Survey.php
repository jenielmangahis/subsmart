<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Survey extends MY_Controller
{
  public function __construct()
  {
      parent::__construct();

      $this->page_data['page']->title = 'Survey Features';
      $this->page_data['page']->menu = 'Survey';
      $this->load->model('Survey_model', 'survey_model');



      add_css(array(
        'https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css',
        'https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials-theme-minima.css',
        'https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.css',
        'assets/css/survey.css',
      ));

      add_footer_js(array(
        'https://cdnjs.cloudflare.com/ajax/libs/dragula/3.7.2/dragula.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/tributejs/5.1.3/tribute.min.js',
        'assets/js/survey.js',
        'assets/js/social.js',
      ));

      $this->checkLogin();
      $this->load->library('session');
      $user_id = getLoggedUserID();

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
    $this->page_data['surveys'] = $this->survey_model->list();
    $this->load->view('survey/list', $this->page_data);
  }

  public function add(){
    $data = array(
      'created_by' => $_SESSION['uid'],
      'title' => $this->input->post('title'),
    );
    $data = $this->survey_model->add($data);

    $result = array(
      'success' => 1,
      'data' => $data
    );
    echo json_encode($result);
    redirect('/survey', 'refresh');
    exit;
  }

  public function delete($id){
    $delete = $this->survey_model->delete($id);
    $result = array(
      'success' => 1
    );
    echo json_encode($result);
    exit;
  }

  public function view($id){
    $this->page_data['survey'] = $this->survey_model->view($id);
    $this->page_data['questions'] = $this->survey_model->getQuestions($id);
    $this->page_data['qTemplate'] = $this->survey_model->getTemplateQuestions();
    $this->load->view('survey/view', $this->page_data);
  }
  public function addQuestion($id, $tid){
    $data = $this->survey_model->addQuestion($id, $tid);
    $result = array(
      'success' => 1,
      'data' => $data,
    );
    add_footer_js(array(
        'assets/js/survey.js',
    ));
    echo json_encode($result);
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
      'image_position' =>$this->input->post('image_position')
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
      'data' => $data
    );
    echo json_encode($result);
    exit;
  }
  public function addQuestionUpload($id){
    $path = 'uploads/survey';
    $config = [
      'upload_path' 		=> $path,
      'allowed_types' 	=> '*',
      'overwrite' 		=> false
    ];
    $test = $this->upload->initialize($config);
    if ( ! $this->upload->do_upload('image_background') ){

    }else{
      $upload_data = $this->upload->data();
    }

    $data = array(
      'image_background' => $_FILES['image_background']['name'],
    );

    $this->survey_model->addQuestionImage($id, $data);
    echo json_encode(array(
      'success' => 1
    ));
    exit;
  }
  public function preview($id){

    add_css(array(
        'assets/dashboard/css/bootstrap.min.css',
    ));

    $this->page_data['survey'] = $this->survey_model->view($id);
    $this->page_data['questions'] = $this->survey_model->getQuestionsPreview($id);
    $this->load->view('survey/preview', $this->page_data);
  }


  public function answer($id){
    
    if($this->input->post('stripeToken') != NULL){
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
    }
   
   
    $answered = $this->survey_model->saveAnswer($_POST, $_FILES,$id);
    echo json_encode($answered);
    exit;
  }


  public function orderUpdate(){

    $data = $this->survey_model->orderUpdate($_POST['id']);
    $result = array(
      'success' => 1
    );
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
    $this->page_data['survey'] = $this->survey_model->view($id);
    $this->page_data['questions'] = $this->survey_model->getQuestions($id);
    $this->load->view('survey/result', $this->page_data);
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
}
