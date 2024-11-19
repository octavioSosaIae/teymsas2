import userDAO from "./DAO/userDAO.js";
Sesion();

 async function Sesion(){
    const session = await new userDAO().getSessionAdmin();
if (!session) {
    console.log("hola");
    location.href = "http://192.168.10.12/teymsas2/public/user"
}    

}
