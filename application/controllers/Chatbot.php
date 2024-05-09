<?php
class Chatbot extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Chatbot_model');
    }

    private $company_id = 31;

    private function findPreset($userInput, $predefinedQuestions) 
{
    // Function to normalize a string: remove punctuation, convert to lowercase, and trim spaces
    function normalize($str) {
        return strtolower(trim(preg_replace('/[^a-z0-9 ]/i', '', $str)));
    }

    // Step 1: Exact match with normalization to remove special characters and spaces
    $normalizedInput = normalize($userInput);

    foreach ($predefinedQuestions as $question => $response) {
        $normalizedQuestion = normalize($question);

        if ($normalizedInput === $normalizedQuestion) { // Exact match after normalization
            return $response; // Return immediately if an exact match is found
        }
    }

    // Step 2: Fallback to normalized pattern matching if exact match fails
    foreach ($predefinedQuestions as $question => $response) {
        $normalizedQuestion = normalize($question); // Normalize predefined question

        // Create a regex pattern with word boundaries to match keywords in the predefined question
        $keywords = explode(' ', $normalizedQuestion);  
        $regexPattern = '/\\b(' . implode('|', $keywords) . ')\\b/i';  

        // Check if regex matches normalized user input
        if (preg_match($regexPattern, $normalizedInput)) {  
            return $response; // Return if there's a pattern match
        }
    }

    // Default response when no match is found
    return "My apologies, I could not find an appropriate match for this. Could you please help rephrase your question?";
}

    
    public function request() 
    {
        $requestData = $this->input->post();
        $requestData['company_id'] = $this->company_id;
        $query = $this->Chatbot_model->fetchAllPreset($requestData);

        $presets = array();
        foreach($query as $querys) {
            $presets["$querys->title"] = "$querys->response";
        }

        // // Find the most similar answer based on the user's input
        $findAutoResponse = $this->findPreset($requestData['request'], $presets);
        
        // // Outputs the answer for the most similar question
        echo json_encode($findAutoResponse);
    }

    public function testing() 
    {
        $samplePreset = [
            "What is your contact?" => "testContact",
            "What is your location?" => "testLocation",
        ];

        // // Find the most similar answer based on the user's input
        $findAutoResponse = $this->findPreset("What is your Subscription?", $samplePreset);
        
        // // Outputs the answer for the most similar question
        echo json_encode($findAutoResponse);
    }

    public function preference()
    {
        // nsmartrac 
        $preference = $this->Chatbot_model->fetchPreference($this->company_id);
        echo json_encode($preference);
    }

    public function searchInput()
    {

    }
}