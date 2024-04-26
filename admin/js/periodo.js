function set_periodo(codigo){
    let request = new XMLHttpRequest();
    request.open('POST', "./acciones/periodo_actual.php");
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    request.onload = function(){
        if (this.status === 200) { // Check for successful response (status code 200)
            let respuesta = this.responseText;
            let string = "";
            switch(respuesta){
                case '200':
                    string = "Periodo modificado exitosamente";
                    successLog(string);
                    break;
                case '100':
                    string = "Ha habido un error al configurar el periodo actual";
                    errorLog(string);
                    break;
                case '101':
                    string = "No ha sido posible quitar el periodo actual";
                    errorLog(string);
                    break;
                default:
                    string = "Ha ocurrido un error!";
                    console.log(this.responseText);
                    errorLog(string);
                    break;
            }
          } else {
            console.error("Error:", this.statusText); // Log error message if request fails
          }
    }
    request.send(`periodo=${codigo}`);
}

function errorLog(string){
    swal({
        type: "warning",
        title: "Error",
        text: string
    });
}

function successLog(string){
    swal({
        type: "success",
        title: "Periodo actualizado",
        text: string
    },
    function(isConfirm){
        if(isConfirm){
            buildTable();
        }
    });
}

function buildTable(){
    let request = new XMLHttpRequest();
    request.open('GET', `./acciones/construirTabla.php`);
    request.onload = function(){
        let content = "";
        JSON.parse(this.responseText).forEach(periodo => {
            let id = (periodo.actual == 1) ? "id='periodo_actual'" : "";
            let accion = (periodo.actual == 0)? "onclick='set_periodo("+ periodo.codigo_periodo +")'" : ""
            content += `
            <tr `+ id +`>
                <th>`+ periodo.codigo_periodo +`</th>
                <th>`+ periodo.nombre +`</th>
                <th>`+ periodo.fecha_inicio+`</th>
                <th>`+ periodo.fecha_fin +`</th>
                <th>
                    <a class='btn btn-success btn-sm'href='acciones/editar_periodo.php?id=`+ periodo.codigo_periodo +`'><i class='fa fa-edit'></i></a>
                    <a class='btn btn-success btn-sm'
                    `+ accion +`
                    ><i class='fa fa-edit'></i></a>
                </th>
            </tr>`
        });
        const table = document.getElementById('table');
        table.innerHTML = content;
    }
    request.send();
}