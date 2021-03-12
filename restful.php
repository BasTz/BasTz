<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body onload = "loadDoc()" >
    <div id = "out"></div>
    <script>
        function loadDoc(){
            let xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function(){
                console.log(this.readyState);
                if(this.readyState == 4 && this.status == 200){
                    console.log(this.responseText);
                    data = JSON.parse(this.responseText);
                    doc = document.getElementById("out");
                    Test = "<table border = '1'>";
                    for(i = 0;i<data.length;i++){
                        Test += "<tr>";
                        for(key in data[i]){
                            Test += "<td>" + data[i][key] + "</td>";
                        }
                        Test += "</tr>";
                    }
                    Test += "</table>";
                    doc.innerHTML = Test;
                }
            }
            xhttp.open("GET","rest.php",true);
            xhttp.send();
        }
    </script>
</body>
</html>