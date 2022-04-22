<!DOCTYPE html>
<html>
    <head>
        <title>Github Repository Retrieval</title>
    </head>
    <body>
    <p><strong>Warning:</strong> This code is protected under NDA (non-disclosure agreement). source is &copy; <?php print date('Y'); ?> Bellerose Web Media, LLC for exclusive use only. Free to use.</p>
    
    
    <form action="index.php">
        Topic: <input type="text" name="inputTopic" value="" />
        
    </form>
    
    <?php
    


$ch = curl_init();
/* cURL the github repository with the topic that is passed from the form */
/* input is sanitized as to not have invalid or bad data passed */
curl_setopt($ch, CURLOPT_URL,"https://api.github.com/search/repositories?q=topic:". htmlspecialchars($_POST['inputTopic']);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,$vars);  //Post Fields
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


/* Include the required headers to send to the Github API - set the MIME type to output JSON, and my github username as the user agent */
$headers = [
	'Accept: application/vnd.github.mercy-preview+json',
    'User-Agent: francescov',
];

curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$server_output = curl_exec ($ch);

curl_close ($ch);

print  $server_output ;
    

/* Save the repository information to a database */
    mysqli_connect(
        string $hostname = "localhost",
        string $username = "current_username",
        string $password = "current_password",
        string $database = "github_repository_listings",
        string $table = "github_data",
        int $port = 3306,
        string $socket = ""
    ):mysqli|false
            
    mysqli_query("INSERT INTO " . $table . "(repositoryID, repositoryTopic) VALUES (0, ".mysqli_real_escape_string(htmlspecialchars($_POST['inputTopic'])).")");
            
?>
    </body>
</html>