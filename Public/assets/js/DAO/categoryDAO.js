import server from './server.js';

export default class categoryDAO{

    async createCategory(description_category){
        let url = server + '/CategoriesController.php?function=create'
        let formData = new FormData();
        
        formData.append('description_category', description_category);
        let config = {
            method: 'POST',
            body: formData
        };

        let response = await fetch(url, config);
        let data = await response.json();
        return data;
    }

    async getById(id_category){
        let url =   server + '/CategoriesController.php?function=getById';
        formData.append('id_category', id_category);

        let config = {
            method: 'POST',
            body: formData
        };

        let response = await fetch(url);
        let data = await response.json();
        return data;
    }

    async getAll(){
        let url =   server + '/CategoriesController.php?function=getAll';
        let response = await fetch(url);
        let data = await response.json();
        
        return data;
    }


}