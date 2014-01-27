<?php

// *************
// Utility APIs
// For setting up new REST infrastructure for APIs
// Everything runs of the 
//
// updateuser
// updateuserapis
// updateindex
//
// If it is a valid user in the manifest it will run through all their sites and rebuild server infrastructure for them
// *************

$route = '/utility/updateuser/';
$app->get($route, function ()  use ($app,$manifest){
				
	// Incoming Github User
	if(isset($_REQUEST['user'])){ $user = $_REQUEST['user']; } else { $user = '';}

	// Pulls Manifest
	$manifestResult = file_get_contents($manifest);
	$manifestArray = json_decode($manifestResult,true);

	// Loop through each API entry in manifest
	foreach($manifestArray as $Manifest)
		{
		
		// If user is match with incoming
		$account = $Manifest['account'];	
		if($Manifest['account']==$user)
			{
			$repo = $Manifest['template'];
			$cleanrepo = str_replace("api-","",$repo);
			//echo $repo . "<br />";
			
			$SwaggerJSON = file_get_contents("https://raw.github.com/" . $account . "/" . $repo . "/gh-pages/" . $cleanrepo);	
			$SwaggerArray = json_decode($SwaggerJSON,true);
				
			// See if this account swagger folder exists			
			$AccountFolder = API_ROOT_PATH."swagger/" . $account;
			//echo "1) " . $AccountFolder . "<br />";
			
			if(!is_dir($AccountFolder)){
				mkdir($AccountFolder);
				}							
			
			$SPIFolder = $AccountFolder . "/" . $repo;
			//echo "2) " . $SPIFolder . "<br />";
			if(!is_dir($SPIFolder)){
				mkdir($SPIFolder);
				}				
			
			// Add the core swagger for this user and api template									
			$SwaggerFile = $SPIFolder . "/" . $cleanrepo;
			//echo "Swagger: " . $SwaggerFile . "<br />";
			$fp = fopen($SwaggerFile, "w+");				
			fwrite($fp, $SwaggerJSON);
			fclose($fp);		
			
			$Type = $SwaggerArray['apis'][0]['operations'][0]['type'];
			//echo $Type . "<br />";					
			
			$Parameters = $SwaggerArray['apis'][0]['operations'][0]['parameters'];
			//var_dump($Parameters); 
			
			$Models = $SwaggerArray['models'][$cleanrepo]['properties'];
			//echo "<br />;Models:<br />";
			//var_dump($Models); 			
			
			//See if Methohd folder exists
			$AccountFolder = API_ROOT_PATH."methods/" . $account;
			if(!is_dir($AccountFolder)){
				mkdir($AccountFolder);
				}
			
			
			//Method 1				
			$Method = "";
			$Method .= "<?php" . chr(13);
			$Method .= chr(36) . "route = '/" . $account . "/" . $cleanrepo . "/';" . chr(13);
			$Method .= chr(36) . "app->get(" . chr(36) . "route, function ()  use (" . chr(36) . "app){" . chr(13) . chr(13);
			
			foreach($Parameters as $Parameter){
				$Parameter_Name = $Parameter['name'];						
				$Method .= chr(9) . "if(isset(" . chr(36) . "_REQUEST['" . $Parameter_Name . "'])){ " . chr(36) . $Parameter_Name . " = " . chr(36) . "_REQUEST['" . $Parameter_Name . "']; } else { " . chr(36) . $Parameter_Name . " = '';}" . chr(13);
				}
			
			$Method .= chr(9) . chr(36) . "ObjectText = file_get_contents('https://raw.github.com/" . $account . "/" . $repo . "/gh-pages/" . $cleanrepo . ".json');" . chr(13);
			$Method .= chr(9) . chr(36) . "ObjectResult = json_decode(" . chr(36) . "ObjectText,true);" . chr(13);
			$Method .= chr(9) . chr(36) . "ReturnObject = array();" . chr(13) . chr(13);
			$Method .= chr(9) . "foreach(" . chr(36) . "ObjectResult as " . chr(36) . "Object){" . chr(13) . chr(13);			
			$Method .= chr(9) . chr(9) . chr(36) . "IncludeRecord = 1;" . chr(13);			
			
			foreach($Models as $Key => $Value){
				$Method .= chr(9) . chr(9) . chr(36) . $Key . " = " . chr(36) . "Object['" . $Key . "'];" . chr(13);					
				}
			$Method .= chr(13);
			foreach($Parameters as $Parameter){
				$Parameter_Name = $Parameter['name'];
				$ApplyTo = $Parameter['applyTo'];								
				$Method .= chr(9) . chr(9) . "if(" . chr(36) . "query!=''){" . chr(13);
				$Method .= chr(9) . chr(9) . chr(36) . "IncludeRecord = 0;" . chr(13);
				$Method .= chr(9) . chr(9) . chr(9) . "if(";
				$ParamLength = count($ApplyTo);
				//echo "length: " . $ParamLength . "<br />";
				$ParamCount = 1;
				foreach($ApplyTo as $Apply){
					$property = $Apply['property'];					
					$Method .= "strpos(strtolower(" . chr(36) . $property . "),strtolower(" . chr(36) . $Parameter_Name . ")) === 0";
					//echo $ParamCount . "<=" . $ParamLength . "<br />";
					if($ParamCount<$ParamLength){ $Method .= " || "; } 
					$ParamCount++;
					}
				$Method .= ")" . chr(13);
				$Method .= chr(9) . chr(9) . chr(9) . chr(9) . "{" . chr(13);
				$Method .= chr(9) . chr(9) . chr(9) . chr(9) . chr(36) . "IncludeRecord = 1;" . chr(13);
				$Method .= chr(9) . chr(9) . chr(9) . chr(9) . "}". chr(13);
				$Method .= chr(9) . chr(9) . chr(9) . "}" . chr(13);			
				}
			$Method .= chr(13);
			$Method .= chr(9) . chr(9) . "if(" . chr(36) . "IncludeRecord==1)" . chr(13);
			$Method .= chr(9) . chr(9) . chr(9) . "{" . chr(13);	
			$Method .= chr(9) . chr(9) . chr(9) . chr(36) . "F = array();". chr(13);
					
			foreach($Models as $Key => $Value){
				$Method .= chr(9) . chr(9) . chr(9) . chr(36) . "F['" . $Key . "'] = " . chr(36) . $Key . ";" . chr(13);			
				}
			
			$Method .= chr(9) . chr(9) . chr(9) . "array_push(" . chr(36) . "ReturnObject, " . chr(36) . "F);" . chr(13);
			$Method .= chr(9) . chr(9) . chr(9) . "}" . chr(13);		
			
			$Method .= chr(9) . chr(9) . "}" . chr(13);	
			$Method .= chr(13);
			$Method .= chr(9) . chr(9) . chr(36) . 'app->response()->header("Content-Type", "application/json");' . chr(13);
			$Method .= chr(9) . chr(9) . 'echo format_json(json_encode(' . chr(36) . 'ReturnObject));' . chr(13);
			$Method .= chr(9) . "});" . chr(13);	

			$Method .= chr(13) . chr(13);

			//Method 2
			$Method .= chr(36) . "route = '/" . $account . "/" . $cleanrepo . "/:id';" . chr(13);
			$Method .= chr(36) . "app->get(" . chr(36) . "route, function (" . chr(36) . "IncomingID)  use (" . chr(36) . "app){" . chr(13) . chr(13);
			
			$Method .= chr(9) . chr(36) . "ObjectText = file_get_contents('https://raw.github.com/" . $account . "/" . $repo . "/gh-pages/" . $cleanrepo . ".json');" . chr(13);
			$Method .= chr(9) . chr(36) . "ObjectResult = json_decode(" . chr(36) . "ObjectText,true);" . chr(13);
			$Method .= chr(9) . chr(36) . "ReturnObject = array();" . chr(13) . chr(13);
			$Method .= chr(9) . "foreach(" . chr(36) . "ObjectResult as " . chr(36) . "Object){" . chr(13) . chr(13);			
			$Method .= chr(9) . chr(9) . chr(36) . "IncludeRecord = 0;" . chr(13);			
			
			foreach($Models as $Key => $Value){
				$Method .= chr(9) . chr(9) . chr(36) . $Key . " = " . chr(36) . "Object['" . $Key . "'];" . chr(13);
				if($Key == "id") { $ModelID = $Key; }					
				}
			$Method .= chr(13);

			$Method .= chr(9) . chr(9) . "if(" . chr(36) . "IncomingID==" . chr(36) . "id)" . chr(13);
			$Method .= chr(9) . chr(9) . chr(9) . "{" . chr(13);
			$Method .= chr(9) . chr(9) . chr(9) . chr(36) . "IncludeRecord=1;" . chr(13);	
			$Method .= chr(9) . chr(9) . chr(9) . "}" . chr(13);

			$Method .= chr(13);
			$Method .= chr(9) . chr(9) . "if(" . chr(36) . "IncludeRecord==1)" . chr(13);
			$Method .= chr(9) . chr(9) . chr(9) . "{" . chr(13);	
			$Method .= chr(9) . chr(9) . chr(9) . chr(36) . "F = array();". chr(13);
					
			foreach($Models as $Key => $Value){
				$Method .= chr(9) . chr(9) . chr(9) . chr(36) . "F['" . $Key . "'] = " . chr(36) . $Key . ";" . chr(13);			
				}
			
			$Method .= chr(9) . chr(9) . chr(9) . "array_push(" . chr(36) . "ReturnObject, " . chr(36) . "F);" . chr(13);
			$Method .= chr(9) . chr(9) . chr(9) . "}" . chr(13);		
			
			$Method .= chr(9) . chr(9) . "}" . chr(13);	
			$Method .= chr(13);
			$Method .= chr(9) . chr(9) . chr(36) . 'app->response()->header("Content-Type", "application/json");' . chr(13);
			$Method .= chr(9) . chr(9) . 'echo format_json(json_encode(' . chr(36) . 'ReturnObject));' . chr(13);
			$Method .= chr(9) . "});" . chr(13);					
			$Method .= "?>" . chr(13);
			
			// Add the core swagger for this user and api template									
			$MethodFile = $AccountFolder . "/" . $cleanrepo . ".php";
			//echo "Swagger: " . $SwaggerFile . "<br />";
			$fp = fopen($MethodFile, "w+");				
			fwrite($fp, $Method);
			fclose($fp);			
								
			}		
		}

	$Utility = array();
	$Utility['response'] = "updated: " . $user;
	
	$app->response()->header("Content-Type", "application/json");
	echo format_json(json_encode($Utility));			
});

$route = '/utility/updateuserapis/';
$app->get($route, function ()  use ($app,$manifest){
				
	$ValidUser = 0;			
				
	// Input parameters
	if(isset($_REQUEST['user'])){ $user = $_REQUEST['user']; } else { $user = '';}

	$manifestResult = file_get_contents($manifest);
	$manifestArray = json_decode($manifestResult,true);

	$AllAPIs = array();
	$AllAPIs['apiVersion'] = "1.0";
	$AllAPIs['espiVersion'] = "1.1";
	$AllAPIs['apis'] = array();

	foreach($manifestArray as $Manifest)
		{
		$account = $Manifest['account'];			
		
		if($Manifest['account']==$user)
			{
			$ValidUser = 1;			
				
			$AccountFolder = API_ROOT_PATH."swagger/" . $account;
			if(!is_dir($AccountFolder)){
				mkdir($AccountFolder);
				}							
				
			///echo "Processing: " . $account . "<br />";	
			$repo = $Manifest['template'];
			$cleanrepo = str_replace("api-","",$repo);
			$name = str_replace("-"," ",$cleanrepo);

			// See if this account swagger folder exists			
			$APIFolder = $AccountFolder . "/" . $repo;
			if(!is_dir($APIFolder)){
				mkdir($APIFolder);
				}							
			
			$SingleAPI = array();
			$SingleAPI['apiVersion'] = "1.0";
			$SingleAPI['espiVersion'] = "1.1";
			$SingleAPI['apis'] = array();	
			
			$ThisAPI = array();
			$ThisAPI['name'] = $name;
			$ThisAPI['path'] = "http://api.gsa.apievangelist.com/swagger/" . $account . "/" . $repo . "/" . $cleanrepo;
			$ThisAPI['description'] = "";					
			
			array_push($SingleAPI['apis'], $ThisAPI);
			array_push($AllAPIs['apis'], $ThisAPI);
			
			$SingleAPIJSON = prettyPrint(json_encode($SingleAPI));
			
			// Add the core swagger for this user and api template									
			$SingleAPIFile = $APIFolder . "/api.json";
			//echo "Swagger: " . $SwaggerFile . "<br />";
			$fp = fopen($SingleAPIFile, "w+");				
			fwrite($fp, $SingleAPIJSON);
			fclose($fp);			
								
			}		
		}

	if($ValidUser==1)
		{
		$AllAPIJSON = prettyPrint(json_encode($AllAPIs));
		
		// Add the core swagger for this user and api template									
		$AllAPIFile = $AccountFolder . "/api.json";
		//echo "all: " . $AllAPIFile . "<br />";
		$fp = fopen($AllAPIFile, "w+");				
		fwrite($fp, $AllAPIJSON);
		fclose($fp);	
	
		$Utility = array();
		$Utility['response'] = "updated apis";
		}
	else 
		{
		$Utility = array();
		$Utility['response'] = "not valid user";		
		}
		
	$app->response()->header("Content-Type", "application/json");
	echo format_json(json_encode($Utility));			
});

$route = '/utility/updateindex/';
$app->get($route, function ()  use ($app,$manifest){
				
	$ValidUser = 0;				
				
	// Input parameters
	if(isset($_REQUEST['user'])){ $user = $_REQUEST['user']; } else { $user = '';}

	$manifestResult = file_get_contents($manifest);
	$manifestArray = json_decode($manifestResult,true);
	
	foreach($manifestArray as $Manifest)
		{
		$account = $Manifest['account'];			
		
		if($Manifest['account']==$user)
			{
			$ValidUser = 1;			

			$IndexContent = "";
			$IndexContent .= "<?php" . chr(13);	
			
			$IndexContent .= "require 'config.php';" . chr(13);	
			$IndexContent .= "require 'Slim/Slim.php';" . chr(13) . chr(13);	
			
			$IndexContent .= "\Slim\Slim::registerAutoloader();" . chr(13);	
			$IndexContent .= chr(36) . "app = new \Slim\Slim();" . chr(13) . chr(13);	
		
			$IndexContent .= chr(36) . "route = '/';" . chr(13);	
			$IndexContent .= chr(36) . "app->get(" . chr(36) . "route, function () {	" . chr(13);		    
			$IndexContent .= "});	" . chr(13) . chr(13);		
		
			foreach($manifestArray as $Manifest)
				{
				$account = $Manifest['account'];
				$repo = $Manifest['template'];
				$cleanrepo = str_replace("api-","",$repo);	
				
				$IndexContent .= 'include "methods/' . $account . '/' . $cleanrepo . '.php";' . chr(13);	
				
				}
			$IndexContent .= chr(13);
			$IndexContent .= 'include "methods/utility.php";' . chr(13);	
			$IndexContent .= chr(13);	
			$IndexContent .= chr(36) . "app->run();" . chr(13);		
			
			$IndexContent .= "?>" . chr(13);
												
			$IndexFile = API_ROOT_PATH.'index.php';
		
			$fp = fopen($IndexFile, "w+");				
			fwrite($fp, $IndexContent);
			fclose($fp);
			
			}
		}	

	if($ValidUser==1)
		{
			
		$Utility = array();
		$Utility['response'] = "updated index.";
		}
	else 
		{
		$Utility = array();
		$Utility['response'] = "not valid user";		
		}
				
	$app->response()->header("Content-Type", "application/json");
	echo format_json(json_encode($Utility));
});