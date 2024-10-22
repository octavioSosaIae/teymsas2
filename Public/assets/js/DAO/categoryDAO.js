import server from './server.js';

export default class categoryDAO{
    async getAll(){
        let url =   server + '/CategoriesController.php?function=getAll';
        let response = await fetch(url);
        let data = await response.json();
        return data;
    }

    async createCategory(description_category){
        let url = 'http://localhost/teymsas2/app/api/controllers/CategoriesController.php?function=create'
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

}