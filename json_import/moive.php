<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie</title>
</head>
<body>
    <?php
        $jsonfile = file_get_contents("movies.json");
    ?>

    <div>
        Year : <br>
        <select id = "year" onchange = "update_movie()">
        </select><br>
        Movie Name : <br>
        <select id = "movie" onchange = "update_detail()">
            <option value="N/A">N/A</option>
        </select><br><br>
    </div>

    <script>
        var jsonEx = <?php echo $jsonfile ?>;
        var doc = document.getElementById("year");
        var m = document.getElementById("movie");
        var Test = new Set();

        for(i = 0;i < jsonEx.length ; i++){
            Test.add(jsonEx[i].year);
        }
        var temp = Test.values(); 

        for(i = 0;i < Test.size ; i++){
            var option = document.createElement("option");
            option.text = temp.next().value;
            doc.add(option);
        }
        
        function update_movie(){
            m.innerHTML = "";
            for(i = 0;i < jsonEx.length ; i++){
                if(jsonEx[i].year == doc.value){
                    var option = document.createElement("option");
                    option.text = jsonEx[i].title;
                    m.add(option);
                }
            }
            update_text();
        }

        function update_detail(){
            update_text();
        }

        function update_text(){
            document.getElementById("Year").value = doc.value;
            document.getElementById("Year").size = doc.value.length;
            document.getElementById("Name").value = m.value;
            document.getElementById("Name").size = m.value.length;
            document.getElementById("Cast").value = "";
            for(i = 0;i < jsonEx.length ; i++){
                if(jsonEx[i].title == m.value){
                    document.getElementById("Cast").value += jsonEx[i].cast;
                    document.getElementById("Cast").value += "\n";
                }
            }
            document.getElementById("Genres").value = "";
            for(i = 0;i < jsonEx.length ; i++){
                if(jsonEx[i].title == m.value){
                    document.getElementById("Genres").value += jsonEx[i].genres;
                    document.getElementById("Genres").value += "\n";
                }
            }
        }
    </script>

    <div>
        <label> Year of Movie </label> <br>
        <input type="text" id="Year"><br>
        <label> Name of Movie </label> <br>
        <input type="text" id="Name"><br>
        <label> List of Cast </label> <br>
        <textarea id="Cast" cols="30" rows="10" style="resize:none"></textarea><br>
        <label> Genres </label> <br>
        <textarea id="Genres" cols="30" rows="10" style="resize:none"></textarea><br>
    </div>
</body>
</html>