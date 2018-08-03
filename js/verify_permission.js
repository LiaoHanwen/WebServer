function verify_permission(){
    var permission = getCookie("permission");
    if(permission != "true"){
        alert("Permission denied")
        window.history.go(-1);
    }
}

function getCookie(cname)
{
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) 
    {
        var c = ca[i].trim();
        if (c.indexOf(name)==0) return c.substring(name.length,c.length);
    }
    return "";
}