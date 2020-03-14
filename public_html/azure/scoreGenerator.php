<?php
    // Gerando array de vagas indicadas para o candidado
    function scoreGenerator($cand_cpf){

        $arrayKeys = "";
        $score = 0;
        $compatibleJobs = array();
        $compatibleJobsStr = "";

        $fileOpen = fopen("teste.json", "r");
        $content  = json_decode(fread($fileOpen, filesize("teste.json")));
        fclose($fileOpen);

        $arrayCandidates = $content->candidates;


        foreach ($arrayCandidates as $e) {
            if (strcasecmp($e->id, $cand_cpf) == 0) {
                $arrayKeys = $e->keyPhrases;
            }
        }

        $fileOpen = fopen("DescVaga.json", "r");
        $content  = json_decode(fread($fileOpen, filesize("DescVaga.json")));
        fclose($fileOpen);

        $arrayVagas = $content->JobRoles;
        //FALTA ARRUMAR SCORE
        foreach ($arrayVagas as $v) {
            $job = $v->keywords;
            $score = 0;
            foreach ($job as $j) {
                foreach ($arrayKeys as $k) {
                    if (strcasecmp($k, $j) == 0) {
                        $score += 50;
                    }
                }
            }
            if ($score >= 500) {
                array_push($compatibleJobs, $v->job_ID);
            }
        }
        foreach ($compatibleJobs as $c) {
            $compatibleJobsStr = $compatibleJobsStr . ", ". $c;
        }

        return $compatibleJobsStr;
    }
    ?>