import server from "./server.js";

export default class userDAO {
    async login(email_user, ){
        let url  = server+"/controllers/userController.php?function=login";
        let formData = new FormData();
        formData.append("email_user", email_user);
        formData.append("password_user", password_user);
        let config = {
            method: "POST",
            body: formData
        }
        let response = await fetch(url, config);
        let json = await response.json();
        if(json.status){
            localStorage.setItem("session", true);
        }
        return json;
    }

     getSession(){
        let session = localStorage.getItem("session");
        if(session){
            return true;
        }else{
            return null;
        }    
    }
}