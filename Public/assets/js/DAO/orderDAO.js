import server from './server.js';

export default class orderDAO{

    async createOrder(description_status){
        let url= server + '/OrderController.php?function=create';
        let formData = new FormData();
        formData.append('description_status', description_status);
        let config = {
            method: 'POST',
            body: formData
        };
    
        let response = await fetch(url, config);
        let data = await response.json();
        return data;
        }

        async getAll(){
            let url =  server + '/OrderController.php?function=getAll';
            let response = await fetch(url);
            let data = await response.json();
            return data;
        }

        async getById(id_order_status){
            let url =   server + '/OrderController.php?function=getByid&order_statusId'+ id_order_status;
            let response = await fetch(url);
            let data = await response.json();
            return data;
        } 

        async updateOrder(description_status,id_order_status){
            let url= server + '/OrderController.php?function=update';
            let formData = new FormData();
            formData.append('description_status', description_status);
            formData.append('id_order_status', id_order_status);
            let config = {
                method: 'POST',
                body: formData
            };
    
            let response = await fetch(url, config);
            let data = await response.json();
            return data;
        }

        async deleteOrder(id_order_status){
            let url= server + '/OrderController.php?function=delete';
            let formData = new FormData();
            formData.append('id_order_status', id_order_status);
            let config = {
                method: 'POST',
                body: formData
            };
    
            let response = await fetch(url, config);
            let data = await response.json();
            return data;
        } 
}