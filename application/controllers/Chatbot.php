<?php
class Chatbot extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Chatbot_model');
    }

    private $company_id = 31;

    private function findPresetWide($userInput, $combinedPresets)
    {
        $emptyQueries = [
            'is', 'a', 'what', 'when', 'how', 'who', 'why', 'the', 'i', 'you', 'am', 'do', 'are', 'it', 'in', 'to', 'for', 'and', 'but', 'or', 'nor', 'so', 'as', 'if', 'then', 'by', 'with', 'on', 'at', 'from', 'about', 'that', 'this', 'these', 'those', 'each', 'every', 'all', 'some', 'no', 'not', 'such', 'more', 'less', 'one', 'two', 'three', 'four', 'five', 'all', 'own', 'an', 'the', 'which', 'whose', 'off', 'out', 'into', 'during', 'between', 'under', 'above', 'after', 'before', 'while', 'until', 'without', 'within', 'along', 'through', 'across', 'against', 'along', 'among', 'behind', 'beyond', 'over', 'up', 'down', 'since', 'upon', 'to', 'for', 'of'
        ];        

        $normalize = function ($str) {
            $str = strtolower(trim(preg_replace('/[^a-z0-9 ]/i', '', $str)));

            $words = explode(' ', $str);
            foreach ($words as &$word) {
                if (substr($word, -3) === 'ies') {
                    $word = substr($word, 0, -3) . 'y';
                } elseif (substr($word, -2) === 'es') {
                    $word = substr($word, 0, -2);
                } elseif (substr($word, -1) === 's') {
                    $word = substr($word, 0, -1);
                }
            }
            return implode(' ', $words);
        };

        $normalizedInput = $normalize($userInput);

        if (empty($normalizedInput) || in_array($normalizedInput, $emptyQueries) || strlen($normalizedInput) <= 1) {
            return "It seems like you didn't ask a clear question. Could you please provide more details?";
        }

        $bestMatch = null;
        $bestScore = 0;

        foreach ($combinedPresets as $preset) {
            $titleNormalized = $normalize($preset['title']);
            $responseNormalized = $normalize($preset['response']);

            $titleScore = 0;
            $responseScore = 0;

            $inputWords = explode(' ', $normalizedInput);
            $titleWords = explode(' ', $titleNormalized);
            $responseWords = explode(' ', $responseNormalized);

            foreach ($inputWords as $word) {
                if (in_array($word, $titleWords)) {
                    $titleScore += 2;
                }
                if (in_array($word, $responseWords)) {
                    $responseScore += 1;
                }
            }

            $totalScore = $titleScore + $responseScore;

            if ($totalScore > $bestScore) {
                $bestScore = $totalScore;
                $bestMatch = $preset['response'];
            }
        }

        return $bestMatch ?? "My apologies, I could not find an appropriate match for this. Could you please help rephrase your question?";
    }

    
    public function request() 
    {
        $requestData = $this->input->post();
        $requestData['company_id'] = $this->company_id;
        $query = $this->Chatbot_model->fetchAllPreset($requestData);

        $presets = array();
        foreach ($query as $querys) {
            $presets["$querys->title"] = "$querys->response";
        }

        $combinedPresets = array();
        foreach ($query as $querys) {
            $combinedPresets[] = [
                'title' => $querys->title,
                'response' => $querys->response
            ];
        }

        $findAutoResponse = $this->findPresetWide($requestData['request'], $combinedPresets);

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