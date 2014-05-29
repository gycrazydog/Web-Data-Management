<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php session_start();?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>First</title>
        <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script>
      $(function () {
        $('form').bind('submit', function () {
          $.ajax({
            type: 'post',
            url: 'search.php',
            data: $('form').serialize(),
            success: function (data) {
              $('#result').html(data);
              alert(data);
            }
          });
          return false;
        });
      });
    </script>
    </head>
    <body bgcolor="#FFCC99">
    <h2 style="font-family:verdana;color:#99CC33"align="center">Movie Search Enginee</h2>
    <h3 style="font-family:verdana;color:#99CC33"align="center">Web application with PHP Exist API</h3>
        <hr>
        <h4 align="center">Please filter your search criteria:</h4>
        <form>
            Title: <input type="text" name="title">
            Director: <input type="text" name="director">
            Actor: <input type="text" name="actor">
            Genre:<select name="genres">
            <option> </option> 
            <option value="Crime">Crime</option>
            <option value="Western">Western</option>
            <option value="Drama">Drama</option>
            <option value="Action">Action</option>
            </select>
            Later than:<select name = "year" id="selectYear"></select>
            <script language="javascript">
            <!--
                var startYear=1900;//起始年份
                var endYear=new Date().getUTCFullYear();//终止年份（当前年份）
                var obj=document.getElementById('selectYear')
                onload=function(){
                for (var i=startYear;i<=endYear;i++)obj.options.add(new Option(i,i));
                obj.options[0].selected=1
            }
            //-->
            </script>
            Keyword in summary: <input type="text" name="keyword">
        <br><br><br>
        <input type ="submit" style="width:120px;height:40px;font-size:20px;">
        </form>
        <p>Movies: <span id="result"></span></p>
    </body>
</html>
