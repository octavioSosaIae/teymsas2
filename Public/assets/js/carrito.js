
window.onload = async()=>{
    
    var respuesta= await fetch('http://localhost/teymsas2/app/api/controllers/DepartmentController.php?function=getAll');
    
       let datos = await respuesta.json();
        
    
    
    let micaja = document.querySelector("#micaja");
    console.log(datos.Departamentos)
    datos.Departamentos.forEach(departamento => {
        micaja.innerHTML+=departamento.name_department;
    });
    
}
function eliminarproductocarrito(){

    
}

