class Notification{
    success(message){
        new Noty({
            type:'success',
            layout: 'topRight',
            text: message,
            timeout: 2000,
        }).show();
    }
    alert(message){
        new Noty({
            type:'alert',
            layout: 'topRight',
            text: message,
            timeout: 2000,
        }).show();
    }
    error(message){
        new Noty({
            type:'error',
            layout: 'topRight',
            text: message,
            timeout: 2000,
        }).show();
    }
    info(message){
        new Noty({
            type:'info',
            layout: 'topRight',
            text: message,
            timeout: 2000,
        }).show();
    }
}
export default  Notification = new Notification();