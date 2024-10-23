import server from './server.js';

export default class customerDAO{

    async createCity(id_user_customer,document_customer,address_customer,business_name_customer,rut_customer,id_city){
        let url= server + '/CustomersController.php?function=create';
        let formdata = new FormData();
        formdata.append('id_user_customer', id_user_customer);
        formdata.append('document_customer', document_customer);
        formdata.append('address_customer', address_customer);
        formdata.append('business_name_customer', business_name_customer);
        formdata.append('rut_customer', rut_customer);
        formdata.append('id_city', id_city);
        let config = {
            method: 'POST',
            body: formData
        };
    
        let response = await fetch(url, config);
        let data = await response.json();
        return data;
        }

        async getAll(){
            let url =   server + '/CustomersController.php?function=getAll';
            let response = await fetch(url);
            let data = await response.json();
            return data;
        }

        async getById(id_user){
            let url =   server + '/CustomersController.php?function=getByid&userId'+ id_user;
           
            let response = await fetch(url);
            let data = await response.json();
            return data;
    
        } 

        async UpdateCity(document_customer,address_customer,businessName_customer,rut_customer,id_city_customer,id_user){
            let url= server + '/CustomersController.php?function=update';
            let formdata = new FormData();
            formdata.append('document_customer', document_customer);
            formdata.append('address_customer', address_customer);
            formdata.append('businessName_customer', businessName_customer);
            formdata.append('rut_customer', rut_customer);
            formdata.append('id_city_customer', id_city_customer);
            formdata.append('id_user', id_user);
            let config = {
                method: 'POST',
                body: formData
            };
    
            let response = await fetch(url, config);
            let data = await response.json();
            return data;
        }

        async deleteCity(id_user){
            let url= server + '/CustomersController.php?function=delete';
            let formdata = new FormData();
            formdata.append('id_user', id_user);
            let config = {
                method: 'POST',
                body: formData
            };
    
            let response = await fetch(url, config);
            let data = await response.json();
            return data;
        } 







}