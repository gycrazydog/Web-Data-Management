<?php session_start();
            include 'EXIST-API/Client.class.php';
            include 'EXIST-API/Query.class.php';
            include 'EXIST-API/ResultSet.class.php';
            include 'EXIST-API/SimpleXMLResultSet.class.php';
            include 'EXIST-API/DOMResultSet.class.php';
//            ini_set('display_errors', '0');     # don't show any errors...
//            error_reporting(E_ALL | E_STRICT);  # ...but do log them
            echo "what the hell!";
            if(sizeof($_POST)>0){
                foreach ($_POST as $key => $value) {
                    echo $key."  ";
                    echo $value."<br>";
                }
                 $clause = "where ";
                    if ($_POST["title"]!="") {
                        $clause .= "contains(\$m/title/text(),\$name)";
                    }
                    else{
                        $clause .= "\$m/title=\$m/title";
                    }
                    if ($_POST["actor"]!=""){
                        $clause = "for \$a in \$m/actor let \$actor_name:=concat(\$a/first_name/text(),' ',\$a/last_name/text())".$clause." and contains(\$actor_name,\$an)";
                    }
                    if($_POST["director"]!=""){
                        $clause = $clause." and contains(concat(\$m/director/first_name/text(),' ',\$m/director/last_name/text()),\$dn)";
                    }
                    if($_POST["year"]!=""){
                        $clause .= " and \$m/year>\$selectYear";
                    }
                    if($_POST["keyword"]!=""){
                        $clause .= " and contains(\$m/summary/text(),\$keyword)";
                    }
                    if($_POST['genres']!=""){
                        $clause .= " and \$m/genre=\$genres";
                    }
                    $connConfig = array(
                        'protocol'=>'http',
                        'host'=>'localhost',
                        'port'=>'8080',
                        'user'=>'admin',
                        'password'=>'admin',
                        'collection'=>'/exist'
                    );
                    $conn = new \ExistDB\Client($connConfig);
                    echo $clause;
                    $xql = <<<EOXQL
                                for \$m in doc('/db/movie/movies.xml')//movie
                                    $clause
                                    return \$m
EOXQL;
                    $stmt = $conn->prepareQuery($xql);
                    $stmt->bindVariable('name', $_POST['title']);
                    $stmt->bindVariable('an', $_POST['actor']);
                    $stmt->bindVariable('dn', $_POST['director']);
                    $stmt->bindVariable('selectYear', $_POST['year']);
                    $stmt->bindVariable('keyword', $_POST['keyword']);
                    $stmt->bindVariable('genres', $_POST['genres']);
                    $resultPool = $stmt->execute();
                    $results = $resultPool->getAllResults();
        //            header('Content-type: text/xml');
                    echo sizeof($results);
                    $ans = "";
                    foreach($results as $result)
                    {
                        $doc = new DOMDocument();
                        $doc->loadXML($result);  
//                        $doc->saveXML();
                        $xsl = new DOMDocument();
                        $xsl->load("moviestyle.xsl");
                        $proc = new XSLTProcessor();
                        $proc->importStylesheet($xsl);
//                        echo $result;
//                        echo $result;
                        echo ($proc->transformToXml($doc));
                    }
                    $_SESSION['movies'] = $results;
            }
            
?>