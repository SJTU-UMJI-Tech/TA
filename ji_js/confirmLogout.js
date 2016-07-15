/**
 * Created by user on 4/7/16.
 */
function confirmLogout(url) {
    if (confirm("Are you sure to log out?")==true){
        location.href="/logout?url="+Base64.encodeURI(url);
    }
    else {
        location.href="#";
    }
}