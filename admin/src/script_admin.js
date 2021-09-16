//function landingBlock(){

//}

function storeCookie(cookieName, data){

    if(data == null || data == '' || data == '\0' || data =='-1' || data == '-1') return;

    document.cookie = cookieName + "=" + data + ";path=/";
}

function destroyCookie(cookieName){
    document.cookie = cookieName + "=" + ";path=/";
}

/*function getDataPrompt(){  //First Version, use function and directly return it back. Doesn't work well though ;(
    let message = String(prompt("กรุณาใส่ข้อความที่คุณต้องการส่ง"));

    if (message == null || message == ''){
        message = parseInt(-1);
    }

    return message;
}*/

function getDataPrompt()  //Second version, using cookie instead of directly return data back.
{
    let message = String(prompt("กรุณาใส่ข้อความที่คุณต้องการส่ง"));

    if (message == null || message == '' || message == '\0' || message == '-1' || message == 1){
        destroyCookie("lineMessage");
        return 0;
    }

    storeCookie("lineMessage", message);
}
