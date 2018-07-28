function countArticles(){
    var xmlhttp;
    if (window.XMLHttpRequest)
    {
    //  IE7+, Firefox, Chrome, Opera, Safari 浏览器执行代码
    xmlhttp=new XMLHttpRequest();
    }
    else
    {
    // IE6, IE5 浏览器执行代码
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
        document.getElementById("articles-buttom-number").innerHTML=xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET","/Articles/php/count_articles.php",true);
    xmlhttp.send();
}