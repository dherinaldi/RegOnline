<?php
$requestUrl = '';
function sendRequest($action = "", $method = "GET", $data = "", $token, $contenType = "application/json", $url = "http://localhost/webservice/registrasionline/plugins")
{
	$curl = curl_init();
	$headers[] = "Content-type: " . $contenType;
	$headers[] = "Content-length: " . strlen($data);
	$headers[] = "X-Token: " . $token;
	curl_setopt($curl, CURLOPT_URL, $url . "/" . $action);
	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
	$result = curl_exec($curl);
	return $result;
}

function getApiToken($action = "", $method = "POST", $data = "", $contenType = "application/json", $url = "http://localhost/webservice/registrasionline/plugins")
{
	$curl = curl_init();
	$dataUser = array();
	$dataUser['username'] = '';
	$dataUser['password'] = '';
	$record = json_encode($dataUser);
	$headers[] = "Content-type: " . $contenType;
	$headers[] = "Content-length: " . strlen($record);
	$headers[] = "X-Token: 1";
	curl_setopt($curl, CURLOPT_URL, $url . "/" . $action);
	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $record);

	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

	$result = curl_exec($curl);
	$response = json_decode($result);
	if ($response->metadata->code == 200) {
		return $response->response->token;
	} else {
		return $response->metadata->message;
	}
}

function getRequestDataBpjs($action = "", $method = "GET", $data = "", $token, $contenType = "application/json", $url = "http://localhost/webservice/registrasionline/bpjs")
{
	$curl = curl_init();
	$headers[] = "Content-type: " . $contenType;
	$headers[] = "Content-length: " . strlen($data);
	$headers[] = "X-Token: " . $token;
	curl_setopt($curl, CURLOPT_URL, $url . "/" . $action);
	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

	$result = curl_exec($curl);
	return $result;
}
function getRequestTokenBpjs($method = "GET", $user = "", $pass = "", $contenType = "application/json", $url = "http://localhost/registrasionline/bpjs")
{
	$curl = curl_init();
	$dataUser = array();
	$record = json_encode($dataUser);
	$headers[] = "Content-type: " . $contenType;
	$headers[] = "Content-length: " . strlen($record);
	$headers[] = "x-username: " . $user;
	$headers[] = "x-password: " . $pass;
	curl_setopt($curl, CURLOPT_URL, $url . "/getToken");
	curl_setopt($curl, CURLOPT_HEADER, false);
	curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $record);
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
	$result = curl_exec($curl);
	return json_decode($result);
}
