import userDAO from './DAO/userDAO.js';

document.querySelector("#logout").addEventListener("click", async function(e){
    e.preventDefault();
    const result = await new userDAO().logoutSession();
        if(result.success){
            alert(result.message);
            location.href ="http://localhost/teymsas2/public/user/";

        }else{
            alert(result.message);
        }
})
