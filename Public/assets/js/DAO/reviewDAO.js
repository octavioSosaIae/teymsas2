import server from './server.js';

export default class ReviewDAO{

    async createReview(*){
        let url = server + '/ReviewController.php?function=create'
        let formData = new FormData();
        
        formData.append('', *);
        formData.append('', *);
        formData.append('', *);
        formData.append('', *);
        formData.append('', *);
        let config = {
            method: 'POST',
            body: formData
        };

        let response = await fetch(url, config);
        let data = await response.json();
        return data;
    }

    async getById(){
        let url =   server + '/ReviewController.php?function=getById&*=' + id_category*;

        let response = await fetch(url);
        let data = await response.json();
        return data;
    }

    async getAll(){
        let url =   server + '/ReviewController.php?function=getAll';
        let response = await fetch(url);
        let data = await response.json();
        
        return data;
    }

    async updateReview(){
        let url =   server + '/ReviewController.php?function=update';
        formData.append('', *);
        formData.append('', *);


        let config = {
            method: 'POST',
            body: formData
        };

        let response = await fetch(url, config);
        let data = await response.json();
        return data;
    }

    async deletePurchase(){
        let url =   server + '/ReviewController.php?function=delete';
        formData.append('', *);

        let config = {
            method: 'POST',
            body: formData
        };

        let response = await fetch(url, config);
        let data = await response.json();
        return data;
    }

}