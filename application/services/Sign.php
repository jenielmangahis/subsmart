<?php

class Sign {
    
    /**
     * Upload file
     * 
     * @param   array $data
     * @return  true
     */
    public static function upload($data) {
        $user = Auth::user();
        // get usage data
        if ($user->role == "user") {
            $fileUsage = Database::table("files")->where("uploaded_by" , $user->id)->count("id", "files")[0]->files;
            $diskUsage = Database::table("files")->where("uploaded_by" , $user->id)->sum("id", "size")[0]->size / 1000;
            // check file usage limits
            if ($fileUsage > env("PERSONAL_FILE_LIMIT")) {
                return responder("error", "Limit Exceeded!", "You have exceeded your limit of ".env("PERSONAL_FILE_LIMIT")." files.");
            }
            // check disk usage limits
            if ($diskUsage > env("PERSONAL_DISK_LIMIT")) {
                return responder("error", "Limit Exceeded!", "You have exceeded your limit of ".env("PERSONAL_DISK_LIMIT")." MBs.");
            }
        }else{
            $fileUsage = Database::table("files")->where("company" , $user->company)->count("id", "files")[0]->files;
            $diskUsage = Database::table("files")->where("company" , $user->company)->sum("id", "size")[0]->size / 1000;
            // check file usage limits
            if ($fileUsage > env("BUSINESS_FILE_LIMIT")) {
                return responder("error", "Limit Exceeded!", "You have exceeded your limit of ".env("BUSINESS_FILE_LIMIT")." files.");
            }
            // check disk usage limits
            if ($diskUsage > env("BUSINESS_DISK_LIMIT")) {
                return responder("error", "Limit Exceeded!", "You have exceeded your limit of ".env("BUSINESS_DISK_LIMIT")." MBs.");
            }
        }
        if ($user->company == 0) {
            $files = Database::table("files")->where("name", $data["name"])->where("folder", $data["folder"])->first();
        }else{
            $files = Database::table("files")->where("name", $data["name"])->where("folder", $data["folder"])->where("company", $user->company)->first();
        }
        if (!empty($files) && $data["source"] == "form") {
            return responder("error", "Already Exists!", "File name '".$data["name"]."' already exists.");
        }
        if(env("ALLOW_NON_PDF") == "Enabled"){
            $allowedExtensions = "pdf, doc, docx, ppt, pptx, xls, xlsx";
        }else{
            $allowedExtensions = "pdf";
        }
        if ($data['source'] == "googledrive") {
            $upload = array(
                                "status" => "success",
                                "info" => array(
                                                    "name" => $data['file'],
                                                    "size" => $data['size'],
                                                    "extension" => "pdf"
                                                )
                            );
        }else{
            $upload = File::upload(
                $data['file'], 
                "files",
                array(
                    "source" => $data['source'],
                    "allowedExtensions" => $allowedExtensions
                )
            );
        }

        if ($upload['status'] == "success") {
            self::keepcopy($upload['info']['name']);
            $data["filename"] = $upload['info']['name'];
            $data["size"] = $upload['info']['size'];
            $data["extension"] = $upload['info']['extension'];
            $activity = $data['activity'];
            unset($data['file'], $data['source'], $data['activity']);
            Database::table("files")->insert($data);
            $documentId = Database::table("files")->insertId();
            $document = Database::table("files")->where("id", $documentId)->get("document_key");
            Database::table("history")->insert(array("company" => $data['company'], "file" => $document[0]->document_key, "activity" => $activity, "type" => "default"));
            return responder("success", "Upload Complete", "File successfully uploaded.");
        }else{
            return responder("error", "Oops!", $upload['message']);
        }
    }

    public static function sign($document_key, $actions, $docWidth, $signing_key, $public = false) {
        if (!empty($signing_key)) {
            $request = Database::table("requests")->where("signing_key", $signing_key)->first();
            $sender = Database::table("users")->where("id", $request->sender)->first();
            $userName = $request->email;
            $user = Auth::user();
            $userName = $user->fname.' '.$user->lname;
            $signature = config("app.storage")."signatures/".$user->signature;
        }else if ($public) {
            $userName = "Guest";
            $signature = null;
        }else{
            $user = Auth::user();
            $userName = $user->fname.' '.$user->lname;
            $signature = config("app.storage")."signatures/".$user->signature;
        }
        
        $document = Database::table("files")->where("document_key", $document_key)->first();
        $pdf = new PDF(null, 'px');
        $pdf->SetAutoPageBreak(FALSE, PDF_MARGIN_BOTTOM);
        $inputPath = config("app.storage")."files/".$document->filename;
        $outputName = Str::random(32).".pdf";
        $outputPath = config("app.storage")."/files/". $outputName;
        $pdf->numPages = $pdf->setSourceFile($inputPath);
        $actions = json_decode($actions, true);
        $templateFields = array($docWidth);
        $signed = $updatedFields = $editted = false;
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        if (env("PKI_STATUS") == "Enabled") {
            $certificate = 'file://'.realpath(config("app.storage").'/credentials/tcpdf.crt');
            $reason = $document->sign_reason.' • Digital Signature | '.$userName.', '.self::ipaddress().','.date("F j, Y H:i");
            $info = array( 'Name' => $userName,  'Location' => env("APP_URL"), 'Reason' => $reason, 'ContactInfo' => env("APP_URL") );
            $pdf->setSignature($certificate, $certificate, 'information', '', 1, $info, true);
        }
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        foreach(range(1, $pdf->numPages, 1) as $page) {
            $rotate = false;
            $degree = 0;
            try {
              $pdf->_tplIdx = $pdf->importPage($page);
            }
            catch(\Exception $e) {
              return false;
            }
            foreach($actions as $action) {
                if(((int) $action['page']) === $page && $action['type'] == "rotate") {
                    $rotate = $editted = true;
                    $degree = $action['degree'];
                    break;
                }
            }
            $size = $pdf->getTemplateSize($pdf->_tplIdx);
            $scale = round($size['w'] / $docWidth, 3);
            $pdf->AddPage(self::orientation($size['w'], $size['h']), array($size['w'], $size['h'], 'Rotate'=>$degree), true);
            $pdf->useTemplate($pdf->_tplIdx);
            foreach($actions as $action) {
                if(((int) $action['page']) === $page) {
                    if ($action['group'] == "input") {
                        $updatedFields = true;
                        $templateFields[] = $action;
                        continue;
                    }elseif ($action['type'] == "image") {
                        $editted = true;
                        $imageArray = explode( ',', $action['image'] );
                        $imgdata = base64_decode($imageArray[1]);
                        $pdf->Image('@'.$imgdata, self::scale($action['xPos'], $scale), self::scale($action['yPos'], $scale), self::scale($action['width'], $scale), self::scale($action['height'], $scale), '', '', '', false);
                    }elseif ($action['type'] == "symbol" || $action['type'] == "shape") {
                        $editted = true;
                        $content = str_replace("%22", '"', $action['image']);
                        $svg = File::write("system.svg", $content);
                        $pdf->ImageSVG($svg, self::scale($action['xPos'], $scale), self::scale($action['yPos'], $scale), self::scale($action['width'], $scale), self::scale($action['height'], $scale), '', '', '', 0, false);
                    }else if ($action['type'] == "drawing") {
                        $editted = true;
                        $imageArray = explode( ',', $action['drawing'] );
                        $imgdata = base64_decode($imageArray[1]);
                        $pdf->Image('@'.$imgdata, 0, 0, $size['w'], $size['h'], '', '', '', false);
                    }else if ($action['type'] == "signature") {
                        $signed = true;
                        if (!$public) {
                            $pdf->Image($signature, self::scale($action['xPos'], $scale), self::scale($action['yPos'], $scale), self::scale($action['width'], $scale), self::scale($action['height'], $scale), '', '', '', false);
                        }else{
                            $imageArray = explode( ',', $action['image'] );
                            $imgdata = base64_decode($imageArray[1]);
                            $pdf->Image('@'.$imgdata, self::scale($action['xPos'], $scale), self::scale($action['yPos'], $scale), self::scale($action['width'], $scale), self::scale($action['height'], $scale), '', '', '', false);
                        }
                    }elseif ($action['type'] == "text") {
                        $editted = true;
                        $pdf->SetFont($action['font'], $action['bold'].$action['italic'], $action['fontsize'] - 1);
                        $pdf->writeHTMLCell( self::scale($action['width'] + 50, $scale), self::scale($action['height'], $scale), self::scale($action['xPos'], $scale) - 3, self::scale($action['yPos'], $scale), str_replace("%22", '"', $action['text']), 0, 0, false, true, '', true );
                    }
                }
            }
        }
        $pdf->Output($outputPath, 'F');
        if (count($templateFields) > 1) {
            Database::table("files")->where("document_key", $document_key)->update(array("filename" => $outputName, "editted" => "Yes", "template_fields" => json_encode($templateFields)));
        }else{
            Database::table("files")->where("document_key", $document_key)->update(array("filename" => $outputName, "editted" => "Yes"));
        }
        if (!empty($signing_key)) {
            $request = Database::table("requests")->where("signing_key", $signing_key)->first();
            $sender = Database::table("users")->where("id", $request->sender)->first();
            Database::table("requests")->where("signing_key", $signing_key)->update(array("status" => "Signed"));
            $notification = '<span class="text-primary">'.escape($userName).'</span> accepted a signing invitation of this <a href="'.url("Document@open").$request->document.'">document</a>.';
            Signer::notification($sender->id, $notification, "accept");
            $documentLink = env("APP_URL")."/document/".$request->document;
            $send = Mail::send(
                $sender->email, "Signing invitation accepted by ".$userName,
                array(
                    "title" => "Signing invitation accepted.",
                    "subtitle" => "Click the link below to view document.",
                    "buttonText" => "View Document",
                    "buttonLink" => $documentLink,
                    "message" => $userName." has accepted and signed the signing invitation you had sent. Click the link above to view the document.<br><br>Cheers!<br>".env("APP_NAME")." Team"
                ),
                "withbutton"
            );
        }
        if ($updatedFields) { 
            $activity = '<span class="text-primary">'.escape($userName).'</span> updated template fields document.'; 
            self::keephistory($document_key, $activity, "default");
        }
        if ($editted) {
            $activity = '<span class="text-primary">'.escape($userName).'</span> editted the document.'; 
            self::keephistory($document_key, $activity);
        }
        if ($signed) { 
            Database::table("files")->where("document_key", $document_key)->update(array("status" => "Signed"));
            $activity = '<span class="text-primary">'.escape($userName).'</span> signed the document.'; 
            self::keephistory($document_key, $activity, "success");
        }
        self::deletefile($document->filename, "original");
        self::renamecopy($document->filename, $outputName);
        return true;
    }
    

?>