<?php
/**
 * Created by PhpStorm.
 * User: saura
 * Date: 12/26/2018
 * Time: 2:45 PM
 */
?>
<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<script src="assets/jquery/jquery-3.2.1.min.js"></script>
<script src="assets/bootstrap/js/popper.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<script src="assets/js/FileSaver.js"></script>
<script src="assets/js/shim.min.js"></script>
<script src="assets/js/xlsx.full.min.js"></script>
<script>

    function export_data(type, fn, dl) {
        type = "xlsx";
        var elt = document.getElementById('table');
        var wb = XLSX.utils.table_to_book(elt, {sheet: "Symbol Number", raw: true});

        return dl ?
            XLSX.write(wb, {bookType: type, bookSST: true, type: 'base64', width: 90}) :
            XLSX.writeFile(wb, fn || ('Random Symbol Number.' + (type || 'xlsx')), {cellStyles: true});
    }


</script>
<style>
    .size {
        font-size: 30px;
    }
</style>
<?php



function randomGen($min, $max, $quantity)
{
    $numbers = range($min, $max);
    shuffle($numbers);
    return array_slice($numbers, 0, $quantity);
}


if (isset($_POST['submit'])) {
    $batch = $_POST['batch'];
    $semester = $_POST['semester'];
    $term = $_POST['term'];
    $nos = $_POST['nos'];

    $batch = substr($batch, -2);
    $count = 0;
    $array = randomGen(0, 999, $nos);

    echo "
   <div class='container' style='padding: 2%; width: 60%'>  
   <button onclick='export_data();' class='btn btn-success btn-primary text-justify size text-bold' id='download' style='margin-bottom: 20px;'><i class='fa fa-download'></i> Download Table</button>  
   
            <table id='table' class='table table-striped table-bordered table-success'> 
              <thead class='thead-dark'>
                <tr>
                  <th scope='col' class='size'>S.N.</th>
                  <th scope='col' class='size'>Symbol Number</th>
                </tr>
              </thead>
              <tbody>";
    foreach ($array as $arr) {
        $count++;
        $rand = (string)sprintf("%03d", $arr);

        echo "
                <tr>
                  <th scope='row' class='size'>$count</th>
                  <td class='size'>$batch$semester$term$rand</td>
                </tr>
            ";
    }

    echo "
                </tbody>
                </table></div>";

} else {
    header("Location: index.php");
}
?>
