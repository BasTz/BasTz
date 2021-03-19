<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restful</title>
</head>
<body onload = "loadContent()" >

    <h3>Add Id & Name :</h3>
    <input type="text" id = "u_id"><input type="text" id = "u_name">
    <button onclick="add_data()">Add</button>
    <hr>
    <div id = "out"></div>
    
    <script>
        function loadContent(){
            let xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function(){
                console.log(this.readyState + ", " + this.status);
                if(this.readyState == 4 && this.status == 200){
                    console.log(this.responseText);
                    data = JSON.parse(this.responseText);
                    console.log(data.length);
                    create_table(data);
                }
            }
            xhttp.open("GET","rest.php",true);
            xhttp.send();
        }

        function create_table(data){
            out = document.getElementById("out");
            out.innerHTML = "";
            text = "<table border = 1>";
            for(i = 0;i < data.length;i++){
                for(inf in data[i]){
                    text += "<td>" + data[i][inf] + "</td>";
                }
                text += "<td> <button onclick=del_data(this.id) id="+data[i]["id"]+">Delete</button> </td>";
                text = "<tr>" + text + "</tr>";
            }
            out.innerHTML = text + "</table>";
        }

        function add_data(){
            let xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    console.log(this.responseText);
                    data = JSON.parse(this.responseText);
                    console.log(data.length);
                    create_table(data);
                }
            }
            u_id = document.getElementById("u_id");
            u_name = document.getElementById("u_name");
            xhttp.open("POST","rest.php",true);
            xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            xhttp.send("u_id="+u_id.value+"&u_name='"+u_name.value+"'");
            document.getElementById("u_id").value = "";
            document.getElementById("u_name").value = "";
        }

        function del_data(clicked_id){
            let xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    console.log(this.responseText);
                    data = JSON.parse(this.responseText);
                    console.log(data.length);
                    create_table(data);
                }
            }
            xhttp.open("POST","rest.php",true);
            xhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            xhttp.send("id="+clicked_id);
        }

    </script>
</body>
</html>