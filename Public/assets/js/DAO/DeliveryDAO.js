import server from './server.js';

export default class DeliveryDAO{

    async createDelivery(id_customer_order,address_delivery,date_delivery){
        let url= server + '/CustomersController.php?function=create';
        let formdata = new FormData();
        formdata.append('id_customer_order', id_customer_order);
        formdata.append('address_delivery', address_delivery);
        formdata.append('date_delivery', date_delivery);
        
        let config = {
            method: 'POST',
            body: formData
        };
    
        let response = await fetch(url, config);
        let data = await response.json();
        return data;
        }

        async getAll(){
            let url =   server + '/DeliveryController.php?function=getAll';
            let response = await fetch(url);
            let data = await response.json();
            return data;
        }

        async getById(id_delivery){
            let url =   server + '/DeliveryController.php?function=getByid&deliveryId'+ id_delivery;
           
            let response = await fetch(url);
            let data = await response.json();
            return data;
    
        } 

        async UpdateDelivery(id_delivery,address_delivery,date_delivery,status){
            let url= server + '/CustomersController.php?function=update';
            let formdata = new FormData();
            formdata.append('id_delivery', id_delivery);
            formdata.append('address_delivery', address_delivery);
            formdata.append('date_delivery', date_delivery);
            formdata.append('status', status);
            let config = {
                method: 'POST',
                body: formData
            };
    
            let response = await fetch(url, config);
            let data = await response.json();
            return data;
        }

        async deleteDelivery(id_delivery){
            let url= server + '/CustomersController.php?function=delete';
            let formdata = new FormData();
            formdata.append('id_delivery', id_delivery);
            let config = {
                method: 'POST',
                body: formData
            };
    
            let response = await fetch(url, config);
            let data = await response.json();
            return data;
        } 







}