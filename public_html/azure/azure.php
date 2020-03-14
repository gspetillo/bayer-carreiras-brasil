 <?php
    include_once('FunctionJSON.php');
    include('conversionToText.php');
    
    
    
    function azureCandidate($cv_path, $cand_cpf){

        $textPDF = conversionToText($cv_path);
        $textPDF_Format = remove_accent($textPDF);

        // Gerando JSON de acordo com as espeficações da API Text Analytics
        /* Language por enquanto será fixo em pt-BR, futuramente poderá implementar a API de Detecção de Idioma do proprio Azure para
curriculos em outros idiomas*/
        $azure_identifier = array(
            'documents' => array(
                array('id' => $cand_cpf, 'language' => 'pt-BR', 'text' => $textPDF_Format)
            )
        );

        //Chamada das variaveis de ambiente da API Text Analytics 
        $subscription_key = ($_ENV['TEXT_ANALYTICS_SUBSCRIPTION_KEY']);
        $endpoint = ($_ENV['TEXT_ANALYTICS_ENDPOINT']);
        $path = '/text/analytics/v2.1/keyPhrases';

        $result = GetKeyPhrases($endpoint, $path, $subscription_key, $azure_identifier);
        $json_final = json_decode($result);
        $elemento = $json_final->documents;

        // Grava um JSON resultante do azure para comparar com a vaga cadastrada
        // Abre o arquivo para leitura, pegando array de candidatos
        $fileOpen = fopen("azure/jsonFiles/Candidates.json", "r");
        $content  = json_decode(fread($fileOpen, filesize("azure/jsonFiles/Candidates.json")));
        fclose($fileOpen);

        $arrayCandidates = $content->candidates;
        $newArr = array();

        foreach ($arrayCandidates as $k) {
            if (!(strcasecmp($k->id, $cand_cpf) == 0)) {
                array_push($newArr, $k);
            }
        }
        array_push($newArr, $elemento[0]);

        $document = array('candidates' => $newArr);

        // Abre o arquivo para gravação, adicionado os candidatos
        $fileClose = fopen("azure/jsonFiles/Candidates.json", "w");
        fwrite($fileClose, json_encode(new ArrayValue($document), JSON_PRETTY_PRINT));
        fclose($fileClose);
    }

    function azureJobs($job_ID, $description){
        $azure_identifier = array(
            'documents' => array(
                array('id' => $job_ID, 'language' => 'pt-BR', 'text' => $description)
            )
        );

        //Chamada das variaveis de ambiente da API Text Analytics 
        $subscription_key = ($_ENV['TEXT_ANALYTICS_SUBSCRIPTION_KEY']);
        $endpoint = ($_ENV['TEXT_ANALYTICS_ENDPOINT']);
        $path = '/text/analytics/v2.1/keyPhrases';

        $result = GetKeyPhrases($endpoint, $path, $subscription_key, $azure_identifier);
        $json_final = json_decode($result);
        $elemento = $json_final->documents;
        $key = $elemento[0];

        return $key->keyPhrases;
    }

    //Função para buscar palavras chaves
    function GetKeyPhrases($host, $path, $key, $data){
        $headers = "Content-type: text/json\r\n" .
            "Ocp-Apim-Subscription-Key: $key\r\n";

        $data = json_encode($data);

        // NOTE: Use the key 'http' even if you are making an HTTPS request. See:
        // https://php.net/manual/en/function.stream-context-create.php
        $options = array(
            'http' => array(
            'header' => $headers,
            'method' => 'POST',
            'content' => $data
            )
        );
         $context  = stream_context_create($options);
        $result = file_get_contents($host . $path, false, $context);
        return $result;
    }
    ?>