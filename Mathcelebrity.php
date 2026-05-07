<?php

class MathCelebrityAPI {
    private $apiKey;
    private $baseURL;

    public function __construct($apiKey, $baseURL = "https://api.mathcelebrity.com") {
        $this->apiKey = $apiKey;
        $this->baseURL = $baseURL;
    }

    private function request($endpoint, $data = []) {
        $url = $this->baseURL . "/" . $endpoint;

        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer " . $this->apiKey,
            "Content-Type: application/json"
        ]);

        $response = curl_exec($ch);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if ($status !== 200) {
            throw new Exception("API Error: " . $status);
        }

        return json_decode($response, true);
    }

    public function solve($problem) {
        return $this->request("solve", ["problem" => $problem]);
    }

    public function quiz($options = []) {
        return $this->request("quiz", $options);
    }

    public function random() {
        return $this->request("random");
    }

    public function sudoku() {
        return $this->request("sudoku");
    }
}
?>
