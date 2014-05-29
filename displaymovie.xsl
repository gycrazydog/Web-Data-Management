<?xml version="1.0" encoding="UTF-8"?>

<!--
    Document   : displaymovie.xsl
    Created on : 2014年5月29日, 下午6:42
    Author     : crazydog
    Description:
        Purpose of transformation follows.
-->

<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="1.0">
    <xsl:output method="html"/>

    <!-- TODO customize transformation rules 
         syntax recommendation http://www.w3.org/TR/xslt 
    -->
    <xsl:template match="movie">
        <html>
            <head>
                <title>displaymovie.xsl</title>
            </head>
            <body bgcolor="#FFCC99">
                <h2>Movie:</h2>
                <table ALIGN="center" BORDER="1" CELLPADDING="4">                  
                                <tr>
                                <td>title</td>
                                <td>year</td>
                                <td>genre</td>
                                <td>director</td>
                                <td>summary</td>
                                </tr>
                                <tr>
                                <td><xsl:value-of select="title"/></td>
                                <td><xsl:value-of select="year"/></td>
                                <td><xsl:value-of select="genre"/></td>
                                <td><xsl:value-of select="director"/></td>
                                <td><xsl:value-of select="summary"/></td>
                                </tr>
                </table>
                <h2 ALIGN="center">Actors:</h2>
                <table ALIGN="center" BORDER="1" CELLPADDING="4">    
                <tr>  
                                <td>name</td>
                                <td>brith_date</td>
                                <td>role</td>
                </tr>
                                     <xsl:for-each select="actor">
                                         <tr>
                                            <td><xsl:value-of select="first_name"/> <xsl:value-of select="last_name"/></td>
                                            <td><xsl:value-of select="birth_date"/> </td>
                                            <td><xsl:value-of select="role"/> </td>
                                        </tr>
                                     </xsl:for-each>
                 </table>
            </body>
        </html>
    </xsl:template>

</xsl:stylesheet>
