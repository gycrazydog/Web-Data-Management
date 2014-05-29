<?php session_start();
    $results = $_SESSION['movies'];
    $title = $_GET['title'];
    foreach($results as $result){
        $doc = simplexml_load_string($result);
        $ans = $doc->xpath("//title/text()");
        if($ans[0]==$title){            
            $xsl = new DOMDocument();
            $xsl->load("displaymovie.xsl");
            $proc = new XSLTProcessor();
            $proc->importStylesheet($xsl);
            echo ($proc->transformToXml($doc));
        }
    }
?>